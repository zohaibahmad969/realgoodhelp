<?php

add_action('wp_ajax_check_user_logged_in', 'check_user_logged_in');
add_action('wp_ajax_nopriv_check_user_logged_in', 'check_user_logged_in');
function check_user_logged_in()
{
	echo is_user_logged_in() ? "yes" : "no";
	die();
}