<?php

/*
 * Reminder functions
*/

// Telegram bot config
require_once get_template_directory() . "/inc/reminder-assets/realgh-telegram-config.php";

// Telegram bot functions
require_once get_template_directory() . "/inc/reminder-assets/realgh-telegram-functions.php";

// Push notifications functions
require_once get_template_directory() . "/inc/reminder-assets/realgh-push-notifications.php";

wp_schedule_single_event( time(), 'realgh_hourly_event' );
add_action('realgh_hourly_event', 'realgh_reminder');

function realgh_reminder() {
	global $wpdb;

	$todays = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}reminders WHERE next_reminder = CURRENT_DATE");

	if (!$todays) return;

	$sent_reminders = [];

	foreach ($todays as $reminder) {
		$server_time = new DateTime();
		$server_time = new DateTime(round_time($server_time->format('H:i:s'), 1));
		$reminder_time = new DateTime($reminder->reminder_time);

		if ($reminder_time != $server_time) continue;
		if (!$sent_reminders || !realgh_find_same_reminders($sent_reminders, $reminder)) {
			$sent_reminders[] = $reminder;

			switch ($reminder->method) {
				case 'telegram':
					realgh_telegram_remider($reminder);
					break;
			}
		}

		$next_reminder = new DateTime();
		$next_reminder = $next_reminder->add(new DateInterval('P' . $reminder->days_interval . 'D'));

		$wpdb->update(
			$wpdb->prefix . 'reminders',
			['next_reminder' => $next_reminder->format('Y-m-d')],
			['id' => $reminder->id]
		);
	}
}

// Checking for double sending of the post
function realgh_find_same_reminders($sent_reminders, $reminder) {
	$exist = false;
	foreach ($sent_reminders as $past_rem) {
		if (
			$past_rem->user_id == $reminder->user_id &&
			$past_rem->post_id == $reminder->post_id
		) {
			$exist = true;
			break;
		}
	}

	return $exist;
}



/*
 * Telegram bot logic
*/

// Telegram send reminder
function realgh_telegram_remider($reminder) {
	global $wpdb;

	$user = $wpdb->get_row("SELECT us.telegram_id FROM {$wpdb->prefix}users_settings us WHERE us.user_id = {$reminder->user_id}");
	$post = get_post($reminder->post_id);

	realgh_telegram_api('sendPhoto', array(
		'photo' => realgh_get_lesson_thumbnail($post->ID),
		'caption' => realgh_format_telegram_message(
			'Hi, you wanted to be reminded to review this lesson again: {post}. Good luck!',
			(array) $post
		),
		'parse_mode' => 'HTML',
		'chat_id' => $user->telegram_id
	));
}

// Telegram identify command
function realgh_command_identify($message) {
	$text = $message['text'];
	$chat_id = $message['chat']['id'];

	if (str_starts_with($text, '/start')) {
		realgh_bot_message(
			realgh_format_telegram_message(
				'Hello, here\'s your id: {id}',
				array('telegram_id' => $chat_id)
			),
			$chat_id
		);
	}
	else {
		realgh_bot_message('I don\'t know such a command: ' . $text, $chat_id);
	}
}

$event = json_decode(file_get_contents('php://input'), true);
// file_put_contents(get_template_directory() . '/realgh_log.txt', print_r($event, 1)."\n", FILE_APPEND);

if ($event['message']['entities'][0]['type'] == 'bot_command') {
	realgh_command_identify($event['message']);
}
else {
	realgh_bot_message(
		'Sorry, so far I only understand commands',
		$event['message']['chat']['id']
	);
}



/*
 * Database logic
*/

// Reminders DB table
require_once get_template_directory() . "/inc/reminder-assets/realgh-reminders-table.php";

add_action('wp_ajax_reminder', 'realgh_reminder_data');
// add_action('wp_ajax_nopriv_reminder', 'realgh_reminder_data');

function realgh_reminder_data() {
	global $wpdb;

	for ($i = 0; $i < count($_POST['reminder_id']); $i++) {
		if ($_POST['reminder_id'][$i]) {
			realgh_update_reminder($_POST, $i);
		}
		else {
			realgh_new_reminder($_POST, $i);
		}
	}

	if ($_POST['save_timezone']) {
		$wpdb->update(
			$wpdb->prefix . 'users_data',
			['time_zone' => $_POST['timezone']],
			['user_id' => $_POST['user_id']]
		);
	}

	$wpdb->update(
		$wpdb->prefix . 'users_settings',
		[ $_POST['method'] . '_id' => $_POST[$_POST['method'] . '_id'] ],
		['user_id' => $_POST['user_id']]
	);
	
	wp_send_json_success();
}