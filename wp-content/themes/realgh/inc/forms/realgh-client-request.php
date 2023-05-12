<?php

add_action('wp_ajax_request', 'realgh_client_request');
add_action('wp_ajax_nopriv_request', 'realgh_client_request');
function realgh_client_request() {
	global $wpdb;

	$to = 'support@realgoodhelp.com';
	$subject = "Client's request";
	$headers = array("From: Client's request Notification! <" . SMTP_FROM . ">", "Content-Type: text/html; charset=UTF-8");
	$mail_body = "";

	foreach ($_POST as $key => $value) {
		if ($key == 'action') continue;
		$mail_body .= "<strong>$key:</strong> $value <br>";
	}

	//Here put your Validation and send mail
	$result = wp_mail($to, $subject, $mail_body, $headers);

	if ($result) {
		wp_send_json_success();
	}
	else {
		wp_send_json_error();
	}
}