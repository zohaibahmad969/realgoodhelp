<?php

add_action('wp_ajax_support_to_user', 'realgh_send_support_to_user');
add_action('wp_ajax_nopriv_support_to_user', 'realgh_send_support_to_user');
function realgh_send_support_to_user() {
	global $rlgh_data;

	$mailBody = email_template(
		$rlgh_data['support_email_title'],
		$rlgh_data['support_email_text'],
		$rlgh_data['support_email_image']['url']
	);

	$headers = array(
		'From: RealGoodHelp Admin <' . SMTP_FROM . '>',
		'content-type: text/html'
	);

	$result = wp_mail( $_POST['email'], $rlgh_data['support_email_title'], $mailBody, $headers);

	if ($result) {
		wp_send_json_success(array('email' => $_POST['email'], 'body' => $mailBody));
	}
	else {
		wp_send_json_error(array('email' => $_POST['email'], 'body' => $mailBody));
	}
}