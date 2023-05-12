<?php

/*
 * Ajax get a filtered list of therapists
*/
add_action('wp_ajax_filtration', 'realgh_get_filtered_psycho');
add_action('wp_ajax_nopriv_filtration', 'realgh_get_filtered_psycho');
function realgh_get_filtered_psycho() {
	global $wpdb;
	global $rlgh_data;

	$st_query = "SELECT ud.user_id, ud.user_profile_pic, ud.first_name, ud.last_name, ud.about_myself, td.money_back_guarantee, td.qualification, td.specialization, td.experience, td.main_method, td.half_rate, td.hourly_rate FROM {$wpdb->prefix}users_data ud INNER JOIN {$wpdb->prefix}therapists_data td ON ud.user_id = td.therapist_id JOIN {$wpdb->prefix}therapists_settings ts ON ud.user_id = ts.therapist_id ";
	$where = "WHERE td.account_status = 'verified' AND ts.availability_hours <> '[]' && ts.availability_hours IS NOT NULL ";

	// if (!empty($_POST['search']))
	// Conditions
	foreach ($_POST as $key => $value) {
		switch ($key) {
			case 'price':
				$where .= realgh_get_price_request($value);
				break;
			case 'qualification':
				for ($i = 0; $i < count($value); $i++) {
					if ($i == 0) $where .= 'AND (';

					$where .= "td.$key = '{$value[$i]}'";

					if ($i == count($value) - 1) {
						$where .= ') ';
					}
					else {
						$where .= ' OR ';
					}
				}
				break;
			case 'specialization':
			case 'main_method':
			case 'additional_education':
				for ($i = 0; $i < count($value); $i++) {
					if ($i == 0) $where .= 'AND (';

					$where .= "td.$key LIKE '%{$value[$i]}%'";

					if ($i == count($value) - 1) {
						$where .= ') ';
					}
					else {
						$where .= ' OR ';
					}
				}
				break;
			case 'experience':
				for ($i = 0; $i < count($value); $i++) {
					if ($i == 0) $where .= 'AND (';

					if (str_contains($value[$i], '-')) {
						[$low, $high] = explode('-', $value[$i]);
						$where .= "td.experience BETWEEN $low AND $high";
					}
					if (str_contains($value[$i], '>')) {
						$where .= "td.experience {$value[$i]}";
					}

					if ($i == count($value) - 1) {
						$where .= ') ';
					}
					else {
						$where .= ' OR ';
					}
				}
				break;
		}
	}

	// Order by
	$order_by;
	switch ($_POST['sort-by']) {
		case 'price_asc':
			$order_by = "ORDER BY LEAST(IFNULL(td.half_rate, 1000), IFNULL(td.hourly_rate, 1000), IFNULL(td.chat_rate, 1000));";
			break;
		case 'price_desc':
			$order_by = "ORDER BY GREATEST(IFNULL(td.half_rate, 0), IFNULL(td.hourly_rate, 0), IFNULL(td.chat_rate, 0)) DESC;";
			break;
		case 'exp_asc':
			$order_by = "ORDER BY td.experience;";
			break;
		case 'exp_desc':
			$order_by = "ORDER BY td.experience DESC;";
			break;
		default:
			$order_by = "ORDER BY ud.first_name, ud.last_name;";
	}

	$query = $st_query . $where . $order_by;
	$result = $wpdb->get_results($query, ARRAY_A);

	if ( $wpdb->last_error ) {
		wp_send_json_error(array('response' => 'Something has gone wrong'));
	}
	else if (count($result) === 0) {
		wp_send_json_success(array('response' => 'Sorry we don\'t have anyone matching your search query.<br>Please try adjusting your search parameters.'));
	}
	else {
		wp_send_json_success($result);
	}
}

function realgh_get_price_request($value) {
	$request = '';
	for ($i = 0; $i < count($value); $i++) {
		if ($i == 0) $request .= 'AND (';

		if (str_contains($value[$i], '<')) {
			$request .= "(td.half_rate <> '' AND td.half_rate {$value[$i]}) OR (td.hourly_rate <> '' AND td.hourly_rate {$value[$i]}) OR (td.chat_rate <> '' AND td.chat_rate {$value[$i]})";
		}
		if (str_contains($value[$i], '-')) {
			[$low, $high] = explode('-', $value[$i]);
			$request .= "td.half_rate BETWEEN $low AND $high OR td.hourly_rate BETWEEN $low AND $high OR td.chat_rate BETWEEN $low AND $high";
		}
		if (str_contains($value[$i], '>')) {
			$request .= "td.half_rate {$value[$i]} OR td.hourly_rate {$value[$i]} OR td.chat_rate {$value[$i]}";
		}

		if ($i == count($value) - 1) {
			$request .= ') ';
		}
		else {
			$request .= ' OR ';
		}
	}

	 return $request;
}