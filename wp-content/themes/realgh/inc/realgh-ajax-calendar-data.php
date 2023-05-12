<?php

/*
 * Get psychologist sessions data
*/

add_action('wp_ajax_calendar_data', 'realgh_get_calendar_data');
add_action('wp_ajax_nopriv_calendar_data', 'realgh_get_calendar_data');

function realgh_get_calendar_data() { 
	$therapist_id = $_POST['id'];

	global $wpdb;
	$result = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}users_data a JOIN {$wpdb->prefix}therapists_settings b ON a.user_id = b.therapist_id WHERE a.user_id = $therapist_id");
	if ( $wpdb->last_error ) {
		echo 'wpdb error: ' . $wpdb->last_error;
	} else {
		$time = new DateTime('now', new DateTimeZone($result->time_zone));
		$offset_min = $time->getOffset() / 60;
		
		// timezone (num) in mins, break (num) in mins, reservation (num) in hours
		wp_send_json_success(array('intervals' => $result->availability_hours, 'timezone' => $offset_min, 'break' => intval($result->break_time), 'reservation' => intval($result->min_session_time)));
	}

	die();
}