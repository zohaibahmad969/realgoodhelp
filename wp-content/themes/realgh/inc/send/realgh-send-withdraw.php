<?php

add_action('wp_ajax_withdraw', 'realgh_send_withdraw');
add_action('wp_ajax_nopriv_withdraw', 'realgh_send_withdraw');
function realgh_send_withdraw() {
	global $rlgh_data;

	$mailBody = '<p><strong>Therapist\'s id:</strong> ' . $_POST['id'] . '</p>';
	$mailBody .= '<p><strong>Email:</strong> ' . $_POST['email'] . '</p>';
	$mailBody .= '<p><strong>Currency:</strong> ' . $_POST['currency'] . '</p>';

	$headers = array(
		'From: RealGoodHelp Admin <' . SMTP_FROM . '>',
		'content-type: text/html'
	);

	$result = wp_mail($rlgh_data['mail_to'], 'Therapist requests withdrawal', $mailBody, $headers);
	
	if ($result) {
		wp_send_json_success();
	}
	else {
		wp_send_json_error();
	}
}