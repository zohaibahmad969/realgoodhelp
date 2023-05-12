<?php

/*
 * Insert data in DB
*/

// add_action('admin_init','realgh_insert_data');

function realgh_insert_data() {
	global $wpdb;

	$users = get_users(array(
		'role__in'   => ['client', 'therapist'],
	));
	foreach ($users as $user) {
		$user_meta = get_user_meta($user->ID);
		$tmd = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}therapist_meta_data tmd WHERE tmd.user_id = {$user->ID}", ARRAY_A);

		$timezone = $tmd[0]['time_zone'];
		$picture = $tmd[0]['user_profile_pic'];

		if (!$timezone) $timezone = 'UTC';
		if (!$picture) $picture = get_template_directory_uri() . '/assets/img/dummy-profile-image.png';

		$users_data_arr = array(
			'user_id' 					=> $user->ID,
			'first_name' 				=> $user_meta['first_name'][0],
			'last_name' 				=> $user_meta['last_name'][0],
			'about_myself' 			=> $user_meta['description'][0],
			'user_profile_pic' 		=> $picture,
			'phone' 						=> $tmd[0]['phone'],
			'date_of_birth' 			=> $tmd[0]['date_of_birth'],
			'time_zone' 				=> $timezone,
			'accept_privacy_terms' 	=> $tmd[0]['accept_privacy_terms'],
			'country' 					=> $tmd[0]['country_of_residence']
		);
		$user_data_r = $wpdb->insert(
			$wpdb->prefix . 'users_data',
			$users_data_arr,
			['%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%s']
		);
		var_dump($users_data_arr);
		var_dump('users_data', $user_data_r);
		echo '<br>';

		$users_settings_r = $wpdb->insert(
			$wpdb->prefix . 'users_settings',
			['user_id' => $user->ID],
			['%d']
		);
		// var_dump('users_settings', $users_settings_r);
		// echo '<br>';


		if ($user->roles[0] == 'client') {
			$clients_data_r = $wpdb->insert(
				$wpdb->prefix . 'clients_data',
				[
					'client_id' 			=> $user->ID,
					'money_back_count' 	=> 0
				],
				['%d', '%d']
			);
			// var_dump('clients_data', $clients_data_r);
			// echo '<br>';
		}

		if ($user->roles[0] == 'therapist') {
			$half = round($tmd[0]['psychologist_30_min_rate'] * 0.7);
			$hour = round($tmd[0]['psychologist_hourly_rate'] * 0.7);
			$chat = round($tmd[0]['psychologist_hourly_chat_rate'] * 0.7);

			$therapists_data_r = $wpdb->insert(
				$wpdb->prefix . 'therapists_data',
				[
					'therapist_id' 			=> $user->ID,
					'account_status' 			=> $tmd[0]['account_status'],
					'top_therapists' 			=> $tmd[0]['featured_psychologist'] == 'featured' ? 1 : 0,
					'qualification' 			=> $tmd[0]['qualification'],
					'specialization' 			=> $tmd[0]['specialization'],
					'experience' 				=> $tmd[0]['years_consulting'],
					'languages' 				=> $tmd[0]['additional_education'],
					'work_with' 				=> $tmd[0]['workWith'],
					'phylosophy' 				=> $tmd[0]['phylosophy'],
					'main_method' 				=> $tmd[0]['my_main_method'],
					'about_main_method' 		=> $tmd[0]['about_my_method'],
					'basic_education' 		=> $tmd[0]['basic_education'],
					'higher_education' 		=> $tmd[0]['higher_education'],
					'uploaded_certificates' => $tmd[0]['uploaded_certificates'],
					'introduction_video' 	=> $tmd[0]['introduction_video'],
					'is_video_public' 		=> $tmd[0]['video_public'],
					'half_rate' 				=> !$half ? NULL : $half,
					'hourly_rate' 				=> !$hour ? NULL : $hour,
					'chat_rate' 				=> !$chat ? NULL : $chat,
					'money_back_guarantee' 	=> $tmd[0]['money_back_guarantee']
				],
				['%d', '%s', '%d', '%s', '%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%d', '%d', '%d', '%d']
			);
			// var_dump('therapists_data', $therapists_data_r);
			// echo '<br>';

			$therapists_settings_r = $wpdb->insert(
				$wpdb->prefix . 'therapists_settings',
				[
					'therapist_id' 		=> $user->ID,
					'availability_hours' => $tmd[0]['availability_hours'],
					'break_time' 			=> $tmd[0]['break_time'],
					'min_session_time' 	=> $tmd[0]['minimum_session_time'],
					'pending_balance' 	=> 0,
					'available_balance' 	=> 0,
					'warnings' 				=> 0
				],
				['%d', '%s', '%d', '%d', '%d', '%d', '%d']
			);
			// var_dump('therapists_settings', $therapists_settings_r);
			// echo '<br>';
		}
	}
}

// users_data
// +user_id, +first_name, +last_name, +about_myself, +user_profile_pic, +phone, +date_of_birth, +time_zone, +accept_privacy_terms, +country

// users_settings
// +user_id

// clients_data
// +client_id, +money_back_count

// therapists_data
// +therapist_id, +account_status, +top_therapists, +qualification, +specialization, +experience, +languages, +work_with, +phylosophy, +main_method, +about_main_method, +basic_education, +higher_education, +uploaded_certificates, +introduction_video, +is_video_public, +half_rate, +hourly_rate, +chat_rate, +money_back_guarantee

// therapists_settings
// +therapist_id, +availability_hours, +break_time, +min_session_time, +pending_balance, +available_balance, +warnings