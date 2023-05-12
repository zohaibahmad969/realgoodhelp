<?php

add_action('wp_ajax_reset-pass', 'realgh_send_reset');
add_action('wp_ajax_nopriv_reset-pass', 'realgh_send_reset');
function realgh_send_reset() {
	global $rlgh_data;

	// Comming:
	// $_POST['email']

	if ($_POST['email']) {
		wp_send_json_success();
	}
	else {
		wp_send_json_error();
	}

	// $headers = array(
	// 	'From: RealGoodHelp Admin <' . SMTP_FROM . '>',
	// 	'content-type: text/html'
	// );

	// wp_mail($_POST['email'], $rlgh_data['mail_theme'], $mailBody, $headers);
}