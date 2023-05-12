<?php

/**
 * Create/update several custom tables
*/
add_action('admin_init','realgh_is_update_tables');

function realgh_is_update_tables() {
	if (wp_doing_ajax()) return;

	$cur_ver_ud = '2.01';
	$cur_ver_us = '2.04';
	$cur_ver_cd = '2.01';
	$cur_ver_td = '2.02';
	$cur_ver_ts = '2.01';
	$cur_ver_s 	= '2.01';
	$cur_ver_c 	= '2.01';
	$cur_ver_rv = '2.02';
	$cur_ver_rm = '0.10';

	$old_ver_ud = get_option('users_data_ver');
	$old_ver_us = get_option('users_settings_ver');
	$old_ver_cd = get_option('clients_data_ver');
	$old_ver_td = get_option('therapists_data_ver');
	$old_ver_ts = get_option('therapists_settings_ver');
	$old_ver_s 	= get_option('sessions_ver');
	$old_ver_c 	= get_option('coupons_ver');
	$old_ver_rv = get_option('reviews_ver');
	$old_ver_rm = get_option('reminders_ver');

	if ($cur_ver_ud > $old_ver_ud) create_ud_table($cur_ver_ud, 'users_data');
	if ($cur_ver_us > $old_ver_us) create_us_table($cur_ver_us, 'users_settings');
	if ($cur_ver_cd > $old_ver_cd) create_cd_table($cur_ver_cd, 'clients_data');
	if ($cur_ver_td > $old_ver_td) create_td_table($cur_ver_td, 'therapists_data');
	if ($cur_ver_ts > $old_ver_ts) create_ts_table($cur_ver_ts, 'therapists_settings');
	if ($cur_ver_s > $old_ver_s) create_s_table($cur_ver_s, 'sessions');
	if ($cur_ver_c > $old_ver_c) create_c_table($cur_ver_c, 'coupons');
	if ($cur_ver_rv > $old_ver_rv) create_rv_table($cur_ver_rv, 'reviews');
	if ($cur_ver_rm > $old_ver_rm) create_rm_table($cur_ver_rm, 'reminders');
}



// users_data table
function create_ud_table($version, $name) {
	global $wpdb;
	require_once ABSPATH . 'wp-admin/includes/upgrade.php';

	$tName = $wpdb->prefix . $name;
	$userImg = get_template_directory_uri() . '/assets/img/dummy-profile-image.png';
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $tName (
		id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		user_id bigint(20) UNSIGNED NOT NULL UNIQUE,
		first_name varchar(40) NOT NULL,
		last_name varchar(40) DEFAULT '',
		about_myself varchar(3000) DEFAULT '',
		user_profile_pic varchar(255) NOT NULL,
		phone varchar(40) DEFAULT NULL,
		date_of_birth date DEFAULT NULL,
		time_zone varchar(100) NOT NULL,
		accept_privacy_terms BOOLEAN NOT NULL DEFAULT 0,
		country varchar(100) DEFAULT NULL,
		PRIMARY KEY  (id),
		KEY first_name (first_name),
		KEY last_name (last_name),
		KEY about_myself (about_myself),
		FOREIGN KEY (user_id)
			REFERENCES {$wpdb->prefix}users (ID)
			ON UPDATE CASCADE ON DELETE CASCADE
	) $charset_collate;";

	dbDelta($sql);
	update_option($name . '_ver', $version);
}

// users_settings table
function create_us_table($version, $name) {
	global $wpdb;
	require_once ABSPATH . 'wp-admin/includes/upgrade.php';

	$tName = $wpdb->prefix . $name;
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $tName (
		id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		user_id bigint(20) UNSIGNED NOT NULL UNIQUE,
		saved_lessons TEXT,
		lessons_answer TEXT,
		themes_suggest TEXT,
		themes_added TEXT,
		show_cards_tutorial TEXT,
		questionaire_results TEXT,
		telegram_id INT UNSIGNED DEFAULT NULL,
		PRIMARY KEY  (id),
		FOREIGN KEY (user_id)
			REFERENCES {$wpdb->prefix}users_data (user_id)
			ON UPDATE CASCADE ON DELETE CASCADE
	) $charset_collate;";

	dbDelta($sql);
	update_option($name . '_ver', $version);
}

// clients_data table
function create_cd_table($version, $name) {
	global $wpdb;
	require_once ABSPATH . 'wp-admin/includes/upgrade.php';

	$tName = $wpdb->prefix . $name;
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $tName (
		id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		client_id bigint(20) UNSIGNED NOT NULL UNIQUE,
		money_back_count tinyint(1) DEFAULT 0,
		PRIMARY KEY  (id),
		FOREIGN KEY (client_id)
			REFERENCES {$wpdb->prefix}users_data (user_id)
			ON UPDATE CASCADE ON DELETE CASCADE
	) $charset_collate;";

	dbDelta($sql);
	update_option($name . '_ver', $version);
}

// therapists_data table
function create_td_table($version, $name) {
	global $wpdb;
	require_once ABSPATH . 'wp-admin/includes/upgrade.php';

	$tName = $wpdb->prefix . $name;
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $tName (
		id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		therapist_id bigint(20) UNSIGNED NOT NULL UNIQUE,
		account_status varchar(20) DEFAULT 'unverified',
		top_therapists BOOLEAN DEFAULT 0,
		qualification varchar(50) DEFAULT NULL,
		specialization varchar(2000) DEFAULT NULL,
		experience tinyint(2) UNSIGNED DEFAULT 1,
		languages varchar(255) DEFAULT '[\"English\"]',
		work_with varchar(255) DEFAULT NULL,
		phylosophy varchar(3000) DEFAULT NULL,
		main_method varchar(100) DEFAULT NULL,
		about_main_method varchar(3000) DEFAULT NULL,
		basic_education varchar(3000) DEFAULT NULL,
		higher_education varchar(3000) DEFAULT NULL,
		uploaded_certificates TEXT DEFAULT NULL,
		introduction_video varchar(255) DEFAULT NULL,
		is_video_public BOOLEAN DEFAULT 0,
		half_rate tinyint(4) UNSIGNED DEFAULT NULL,
		hourly_rate tinyint(4) UNSIGNED DEFAULT NULL,
		chat_rate tinyint(4) UNSIGNED DEFAULT NULL,
		money_back_guarantee BOOLEAN DEFAULT 0,
		PRIMARY KEY  (id),
		KEY account_status (account_status),
		KEY top_therapists (top_therapists),
		KEY qualification (qualification),
		KEY specialization (specialization),
		KEY experience (experience),
		KEY languages (languages),
		FOREIGN KEY (therapist_id)
			REFERENCES {$wpdb->prefix}users_data (user_id)
			ON UPDATE CASCADE ON DELETE CASCADE
	) $charset_collate;";

	dbDelta($sql);
	update_option($name . '_ver', $version);
}

// therapists_settings table
function create_ts_table($version, $name) {
	global $wpdb;
	require_once ABSPATH . 'wp-admin/includes/upgrade.php';

	$tName = $wpdb->prefix . $name;
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $tName (
		id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		therapist_id bigint(20) UNSIGNED NOT NULL UNIQUE,
		availability_hours TEXT DEFAULT NULL,
		break_time tinyint(3) UNSIGNED DEFAULT 10,
		min_session_time tinyint(3) UNSIGNED DEFAULT 24,
		pending_balance SMALLINT(5) UNSIGNED DEFAULT 0,
		available_balance SMALLINT(5) UNSIGNED DEFAULT 0,
		warnings tinyint(2) UNSIGNED DEFAULT 0,
		PRIMARY KEY  (id),
		FOREIGN KEY (therapist_id)
			REFERENCES {$wpdb->prefix}therapists_data (therapist_id)
			ON UPDATE CASCADE ON DELETE CASCADE
	) $charset_collate;";

	dbDelta($sql);
	update_option($name . '_ver', $version);
}

// sessions table
function create_s_table($version, $name) {
	global $wpdb;
	require_once ABSPATH . 'wp-admin/includes/upgrade.php';

	$tName = $wpdb->prefix . $name;
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $tName (
		id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		client_id bigint(20) UNSIGNED NOT NULL,
		therapist_id bigint(20) UNSIGNED NOT NULL,
		session_status varchar(20) NOT NULL DEFAULT 'pending',
		session_date date NOT NULL,
		session_start time NOT NULL,
		session_end time NOT NULL,
		duration tinyint(3) NOT NULL,
		consultation_type varchar(40) NOT NULL,
		communication_method varchar(25) NOT NULL,
		video_call_link varchar(255) NOT NULL,
		payment_status varchar(20) NOT NULL,
		payment_method varchar(20) NOT NULL,
		transaction_id varchar(255) NOT NULL,
		payment_key varchar(255) NOT NULL,
		amount_total tinyint(3) UNSIGNED NOT NULL,
		coupon_id mediumint(8) UNSIGNED DEFAULT NULL,
		discount_price tinyint(3) UNSIGNED DEFAULT NULL,
		cancelled_by varchar(200) DEFAULT NULL,
		therapist_balance tinyint(3) UNSIGNED NOT NULL,
		total_price_discount tinyint(3) UNSIGNED DEFAULT NULL,
		created_at timestamp NOT NULL DEFAULT current_timestamp(),
		updated_at timestamp NOT NULL DEFAULT current_timestamp(),
		PRIMARY KEY  (id),
		KEY client_id (client_id),
		KEY therapist_id (therapist_id),
		KEY session_status (session_status),
		KEY session_date (session_date),
		KEY payment_status (payment_status)
	) $charset_collate;";

	dbDelta($sql);
	update_option($name . '_ver', $version);
}

// coupons table
function create_c_table($version, $name) {
	global $wpdb;
	require_once ABSPATH . 'wp-admin/includes/upgrade.php';

	$tName = $wpdb->prefix . $name;
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $tName (
		id MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
		coupon_name VARCHAR(35) NOT NULL,
		coupon_code VARCHAR(35) NOT NULL,
		percentage_amount TINYINT(3) UNSIGNED NOT NULL,
		PRIMARY KEY  (id),
		KEY coupon_name (coupon_name)
	) $charset_collate;";

	dbDelta($sql);
	update_option($name . '_ver', $version);
}

// reviews table
function create_rv_table($version, $name) {
	global $wpdb;
	require_once ABSPATH . 'wp-admin/includes/upgrade.php';

	$tName = $wpdb->prefix . $name;
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $tName (
		id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		therapist_id bigint(20) UNSIGNED NOT NULL,
		client_id bigint(20) UNSIGNED NOT NULL,
		scores varchar(255) NOT NULL,
		total_score decimal(3,2) NOT NULL,
		review_text varchar(1000) DEFAULT NULL,
		display_consent BOOLEAN DEFAULT 0,
		PRIMARY KEY  (id),
		KEY therapist_id (therapist_id),
		KEY client_id (client_id)
	) $charset_collate;";

	dbDelta($sql);
	update_option($name . '_ver', $version);
}

// reminders table
function create_rm_table($version, $name) {
	global $wpdb;
	require_once ABSPATH . 'wp-admin/includes/upgrade.php';

	$tName = $wpdb->prefix . $name;
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $tName (
		id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		user_id bigint(20) UNSIGNED NOT NULL,
		post_id bigint(20) UNSIGNED NOT NULL,
		next_reminder DATE,
		reminder_time TIME,
		days_interval TINYINT(3) UNSIGNED default 0,
		method VARCHAR(25) default '',
		PRIMARY KEY  (id),
		KEY post_id (post_id),
		FOREIGN KEY (user_id)
			REFERENCES {$wpdb->prefix}users_data (user_id)
			ON UPDATE CASCADE ON DELETE CASCADE
	) $charset_collate;";

	dbDelta($sql);
	update_option($name . '_ver', $version);
}