<?php

/*
 * Save one step of questionnaire
*/

add_action('wp_ajax_questionnaire', 'realgh_save_questionnaire');
add_action('wp_ajax_nopriv_questionnaire', 'realgh_save_questionnaire');
function realgh_save_questionnaire() {
	// Coming:
	// $_POST with field names corresponding to those on the form
	// $_FILES with field names corresponding to those on the form
	// $_POST['step'] with current step number 

	wp_send_json_success();
}