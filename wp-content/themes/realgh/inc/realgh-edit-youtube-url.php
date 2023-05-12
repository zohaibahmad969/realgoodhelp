<?php

/*
 * Edit YouTube url watch to embed
*/
add_filter('youtube_url', 'wellbeing_change_youtube_url');

function wellbeing_change_youtube_url($url) {
	return 'https://www.youtube.com/embed/' . get_youtube_id($url) . '?enablejsapi=1';
}