<?php
/*
 * Get thumbnail from YouTube url
*/

add_filter('youtube_thumbnail', 'wellbeing_get_youtube_thumbnail');

function wellbeing_get_youtube_thumbnail($url) {
   return 'https://img.youtube.com/vi/' . get_youtube_id($url) . '/default.jpg';
}