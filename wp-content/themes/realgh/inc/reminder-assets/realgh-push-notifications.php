<?php

/*
 * Push notifications functions
*/

function realgh_push_remider() {
	$url = 'https://fcm.googleapis.com/fcm/send';

	$fields = array(
		'to' => $_REQUEST['token'],
		'notification' => array(
			'body' => $_REQUEST['message'],
			'title' => $_REQUEST['title'],
			'icon' => $_REQUEST['icon'],
			'click_action' => 'https://google.com'
		)
	);

	$headers = array(
		'Authorization: key=AAAALUso-J8:APA91bE-HGI3bIgBkB3EYMvSLNgeo6jSJ2rmSTdKUf8-D4BaReyw6JVeR69RRegsGHBY864c8LpmbQ2HgF4FlzO8IpR5ZMTo60uGbcVEFasSLNCWXqvxe1uxHJbkaniv4Gsui3YhBzKk',
		'Content-Type:application/json'
	);

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
	$result = curl_exec($ch);

	curl_close($ch);
}

// realgh_push_remider();