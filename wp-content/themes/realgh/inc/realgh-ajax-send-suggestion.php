<?php

add_action('wp_ajax_suggestion', 'wellbeing_send_suggestion');
add_action('wp_ajax_nopriv_suggestion', 'wellbeing_send_suggestion');
function wellbeing_send_suggestion() {
	global $rlgh_data;

	$mailBody = '<p><strong>Suggestion:</strong> ' . esc_html($_POST['suggestion']) . '</p>';

	$headers = array(
		'From: RealGoodHelp Admin <' . SMTP_FROM . '>',
		'content-type: text/html'
	);

	wp_mail( $rlgh_data['mail_to'], $rlgh_data['mail_theme'], $mailBody, $headers );
}