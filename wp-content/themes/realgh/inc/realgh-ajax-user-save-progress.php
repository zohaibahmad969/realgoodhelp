<?php
/*
 * Ajax save user progress
 */

add_action('wp_ajax_user_save_progress', 'user_save_progress');
add_action('wp_ajax_nopriv_user_save_progress', 'user_save_progress');
function user_save_progress()
{
	if(is_user_logged_in() && isset($_POST['data_type']) && $_POST['data_type'] !== ""){
		global $wpdb;
		$table_name = $wpdb->prefix . "users_settings";

		$cur_user_id = get_current_user_id();
		$current_user_settings = $wpdb->get_row("SELECT * FROM $table_name WHERE user_id = $cur_user_id");

		if(empty($current_user_settings)){
			$wpdb->insert($table_name, array('user_id' => $cur_user_id ,$_POST['data_type'] => stripslashes($_POST['data'])));
		}else{
			$wpdb->update($table_name, array($_POST['data_type'] => stripslashes($_POST['data'])), array('user_id' => $cur_user_id));
		}

		if ( $wpdb->last_error ) {
			wp_send_json_error(array('response' => 'Something has gone wrong in saving data in DB.'));
		}
		else {
			wp_send_json_success(array('response' => 'LocalStorage Data saved in DB.'));
		}
	}

}


/*
 * Ajax get user progress
 */

add_action('wp_ajax_user_get_saved_progress', 'user_get_saved_progress');
add_action('wp_ajax_nopriv_user_get_saved_progress', 'user_get_saved_progress');
function user_get_saved_progress()
{
	if(is_user_logged_in() && isset($_POST['data_type']) && $_POST['data_type'] !== ""){
		global $wpdb;
		$table_name = $wpdb->prefix . "users_settings";

		$cur_user_id = get_current_user_id();
		$dataType = $_POST['data_type'];
		$current_user_settings = $wpdb->get_row("SELECT $dataType FROM $table_name WHERE user_id = $cur_user_id");
		
		if ( $wpdb->last_error ) {
			wp_send_json_error(array('response' => 'Something has gone wrong in getting data in DB.'));
		}
		else {
			wp_send_json_success(array('response' => 'success' , 'DB_data' => $current_user_settings -> $dataType));
		}
	}

}