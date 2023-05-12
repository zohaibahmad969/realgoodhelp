<?php

/*
 * Get psychologist sessions data
*/

add_action('wp_ajax_session_data', 'realgh_get_session_data');
add_action('wp_ajax_nopriv_session_data', 'realgh_get_session_data');

function realgh_get_session_data() {
	// comming:
	// $_POST['id'] - psychologist id
	// $_POST['day'] - the date on which the week begins
	// $_POST['month'] - the month in which the data is requested
	// $_POST['year'] - the year in which the data are requested
	// $_POST['for'] - is the data requested for the client/psycho

	// If for a psychologist, return also a link to the client, a link to his thumbnail, his name and how to contact him (zoom, meet)

	global $wpdb;

	$table_name = $wpdb->prefix . "sessions";
	$users_data = $wpdb->prefix . 'users_data';
	$start_date = new DateTimeImmutable($_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day']);

	$end_date = $start_date->add(new DateInterval("P7D"));
	$interval = new DateInterval("P1D");
	$interval->invert = 1;
	$start_date = $start_date->add($interval);

	$request = "SELECT s.client_id, s.session_date, s.session_start, s.duration, s.communication_method, ud.user_profile_pic, ud.first_name, ud.last_name FROM $table_name s JOIN $users_data ud ON ud.user_id = s.client_id WHERE s.session_status IN ('pending', 'done') AND s.therapist_id = {$_POST['id']} AND s.session_date BETWEEN '" . $start_date->format('Y-m-d') . "' AND '" . $end_date->format('Y-m-d') . "'";
	$sessions = $wpdb->get_results($request);

	if ( $wpdb->last_error ) {
		echo 'wpdb error: ' . $wpdb->last_error;
		
	} else {
		$session_array = [];

		if ($_POST['for'] == 'client') {
			foreach($sessions as $single_session){
				$session_array[] = array(
					'date' 		=> $single_session->session_date, 
					'duration' 	=> intval($single_session->duration),
					'method'		=> $single_session->communication_method,
					'start'		=> $single_session->session_start,
				);
			}

			wp_send_json_success($session_array);
		} else {
			foreach($sessions as $single_session){
				$userImg;
				if(isset($single_session->user_profile_pic)){
					$userImg  = $single_session->user_profile_pic;
				}
				
				if(!$userImg){
					if(get_avatar_url($single_session->client_id)){
						$userImg = get_avatar_url($single_session->client_id);
					} else {
						$userImg = get_template_directory_uri() . "/assets/img/dummy-profile-image.png";
					}
				}

				$client_url = get_permalink( get_page_by_path('client-profile') ) . '?client_id=' . $single_session->client_id;
				$session_array[] = array(
							'name' 		=> $single_session->first_name . ' ' . $single_session->last_name,
							'date' 		=> $single_session->session_date, 
							'duration' 	=> intval($single_session->duration),
							'method'		=> $single_session->communication_method,
							'url'	 		=> $client_url,
							'img'	 		=> $userImg,
							'start' 		=> $single_session->session_start 
				);
			}
	
			wp_send_json_success($session_array);
		}
	}

	die();
}