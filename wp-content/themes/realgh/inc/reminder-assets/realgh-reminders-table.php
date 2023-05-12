<?php

/*
 * Reminders DB table
*/

// Create new reminder
function realgh_new_reminder($data, $i) {
	global $wpdb;

	$rem_time = new DateTime($data['date'][$i] . $data['time'][$i], new DateTimeZone($data['timezone']));
	$rem_time->setTimezone(new DateTimeZone(date_default_timezone_get()));

	$wpdb->insert(
		$wpdb->prefix . 'reminders',
		[
			'user_id' => $data['user_id'],
			'post_id' => $data['post_id'],
			'next_reminder' => $rem_time->format('Y-m-d'),
			'reminder_time' => $rem_time->format('H:i:s'),
			'days_interval' => $data['repeat'][$i],
			'method' => $data['method']
		]
	);
}

// Update an existing reminder
function realgh_update_reminder($data, $i) {
	global $wpdb;
	
	$rem_time = new DateTime($data['date'][$i] . $data['time'][$i], new DateTimeZone($data['timezone']));
	$rem_time->setTimezone(new DateTimeZone(date_default_timezone_get()));

	$wpdb->update(
		$wpdb->prefix . 'reminders',
		[
			'next_reminder' => $rem_time->format('Y-m-d'),
			'reminder_time' => $rem_time->format('H:i:s'),
			'days_interval' => $data['repeat'][$i],
			'method' => $data['method']
		],
		['id' => $data['reminder_id'][$i]]
	);
}

// Remove an existing reminder
add_action('wp_ajax_remove_reminder', 'realgh_remove_reminder');

function realgh_remove_reminder() {
	global $wpdb;

	$wpdb->delete(
		$wpdb->prefix . 'reminders',
		['id' => $_POST['id']]
	);

	if($wpdb->last_error){
		wp_send_json_error();
	}
	else {
		wp_send_json_success();
	}
}