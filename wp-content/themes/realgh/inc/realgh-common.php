<?php

/*
 * Returns the video identifier from the YouTube link
*/
function get_youtube_id($url) {
	$id;

	if (str_contains($url, 'watch?v')) {
		$path = explode('?', $url)[1];
		$idVal = explode('&', $path)[0];
		$id = explode('=', $idVal)[1];
	}
	else if (str_contains($url, 'shorts')) {
		$path = explode('shorts/', $url)[1];
		$id = explode('?', $path)[0];
	}
	else {
		$id = explode('/', $url)[3];
	}

	return $id;
}

/*
 * Round time
*/
function round_time($tstr, $min) {
    $t = round( strtotime($tstr) / ($min * 60) ) * $min * 60;

    return strftime('%H:%M', $t);
}