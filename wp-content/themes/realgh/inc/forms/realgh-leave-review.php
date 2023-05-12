<?php

add_action('wp_ajax_review', 'realgh_leave_review');
add_action('wp_ajax_nopriv_review', 'realgh_leave_review');
function realgh_leave_review() {
	global $wpdb;

	$request_data = $_POST;
	$reviews_array = [];
	$reviews_sum = 0;
	foreach($request_data as $key => $single_data){
		if(strpos($key, '_score') !== false){
			$reviews_array[$key] = $single_data;
			$reviews_sum += $single_data;
		}
	}

	$average_rating = $reviews_sum / count($reviews_array);
	$insert_data = array(
		'therapist_id' => $_POST['therapist_id'],
		'client_id'	=> $_POST['client_id'],
		'scores'		=> json_encode($reviews_array),
		'total_score'	=> $average_rating,
		'review_text'	=> $_POST['review_text'],
		'display_consent'	=> $_POST['review_сoncord']
	);

    $insert_response = $wpdb->insert($wpdb->prefix . "reviews", $insert_data);

    if(!empty($insert_response)){
        wp_send_json_success();
    } else{
        wp_send_json_error();
    }
	die;
}