<?php

add_action('wp_ajax_booking', 'realgh_send_booking');
add_action('wp_ajax_nopriv_booking', 'realgh_send_booking');
function realgh_send_booking() {
	global $rlgh_data;

	$mailBody = '<p><strong>Psychologist id:</strong> ' . $_POST['id'] . '</p>';
	$mailBody .= '<p><strong>Name:</strong> ' . $_POST['name'] . '</p>';
	if (!empty($_POST['last_name'])){
		$mailBody .= '<p><strong>Last Name:</strong> ' . $_POST['last_name'] . '</p>';
	}
	$mailBody .= '<p><strong>Email:</strong> ' . $_POST['email'] . '</p>';
	if (!empty($_POST['tymezone'])){
		$mailBody .= '<p><strong>Timezone:</strong> ' . $_POST['tymezone'] . '</p>';
	}
	$mailBody .= '<p><strong>Description:</strong> ' . $_POST['desc'] . '</p>';
	$mailBody .= '<p><strong>Method:</strong> ' . $_POST['method'] . '</p>';

	$headers = array(
		'From: RealGoodHelp Admin <' . SMTP_FROM . '>',
		'content-type: text/html'
	);
	
	wp_mail( $rlgh_data['mail_to'], $rlgh_data['mail_theme'], $mailBody, $headers );
}