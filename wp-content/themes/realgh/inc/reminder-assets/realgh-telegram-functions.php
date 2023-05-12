<?php
/*
 * Telegram bot functions
*/

// Format a telegram message
function realgh_format_telegram_message($message, $data) {
	$search = array(
		'{id}',
		'{post}'
	);
	$replace = array(
		$data['telegram_id'],
		'<a href="' . get_permalink($data['ID']) . '">' . $data['post_title'] . '</a>'
	);

	return str_replace($search, $replace, $message);
}

// Send a telegram request using the specified method
function realgh_telegram_api($method, $options = null) {
	$str_request = API_URL . TOKEN . '/' . $method;

	if ($options) {
		$str_request .= '?' . http_build_query($options);
	}
	
	$request = file_get_contents($str_request);

	return json_decode($request, 1);
}

// Send an ordinary message
function realgh_bot_message($message, $id) {
    realgh_telegram_api('sendMessage', array(
		'text' => $message,
		'parse_mode' => 'HTML',
		'chat_id' => $id
	));
}