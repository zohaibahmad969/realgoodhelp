<?php

/*
 * Shortcodes for email template
*/

// rlgh_first_name
add_shortcode('rlgh_first_name', 'realgh_first_name_shortcode');

function realgh_first_name_shortcode($atts) {
	return get_user_meta($atts['id'])['first_name'][0];
}



// rlgh_full_name
add_shortcode('rlgh_full_name', 'realgh_full_name_shortcode');

function realgh_full_name_shortcode($atts) {
	$user_data = get_user_meta($atts['id']);
	return $user_data['first_name'][0] . ' ' . $user_data['last_name'][0];
}



// rlgh_ses_type
add_shortcode('rlgh_ses_type', 'realgh_ses_type_shortcode');

function realgh_ses_type_shortcode($atts) {
	global $wpdb;
	$result = $wpdb->get_results ( "SELECT * FROM " . $wpdb->get_blog_prefix() . "sessions WHERE id = " . $atts['ses_id']);
	return $result[0]->consultation_type;
}



// rlgh_ses_time
add_shortcode('rlgh_ses_time', 'realgh_ses_time_shortcode');

function realgh_ses_time_shortcode($atts) {
	global $wpdb;
	$session = $wpdb->get_results ( "SELECT * FROM " . $wpdb->get_blog_prefix() . "sessions WHERE id = " . $atts['ses_id']);
	$user = $wpdb->get_results ( "SELECT * FROM " . $wpdb->get_blog_prefix() . "users_data WHERE user_id = " . $atts['id']);

	$ses_time = new DateTime($session[0]->session_date . ' ' . $session[0]->session_start);
	$ses_time->setTimezone(new DateTimeZone($user[0]->time_zone));

	return $ses_time->format('g:i a') . ' on ' . $ses_time->format('F j, Y');
}



// rlgh_ses_money
add_shortcode('rlgh_ses_money', 'realgh_ses_money_shortcode');

function realgh_ses_money_shortcode($atts) {
	global $wpdb;
	$result = $wpdb->get_results ( "SELECT * FROM " . $wpdb->get_blog_prefix() . "sessions WHERE id = " . $atts['ses_id']);

	return $result->amount_total;
}



// rlgh_link
add_shortcode('rlgh_link', 'realgh_link_shortcode');

function realgh_link_shortcode($atts) {
	return '<a href="' . $atts['value'] . '">' . $atts['text'] . '</a>';
}



// rlgh_list
add_shortcode('rlgh_list', 'realgh_list_shortcode');

function realgh_list_shortcode($atts, $content) {
	global $rlgh_data;

	$mark = $rlgh_data['mail_list_mark']['url'];
	$content = do_shortcode($content);

	return <<<HTML
<table cellpadding="0" cellspacing="0" style="width: 100%;">
	<tbody>
		<tr>
			<td width="20" style="vertical-align: top;"><img src="$mark" alt="List"></td>
			<td class="list">$content</td>
		</tr>
	</tbody>
</table>
HTML;
}