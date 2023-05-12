<?php
/**
* Plugin Name: Schedule Sessions
* Plugin URI: 
* Description: This plugin is related with schedule sessions for therapist and client
* Version: 1.1
* Author: Sunil
**/

require_once dirname(__FILE__) . '/functions.php';

function include_assets() {
    wp_enqueue_style('session_style', plugins_url('assets/css/style.css',__FILE__ ));
}

add_action( 'admin_init','include_assets');

function my_admin_menu() {
    add_menu_page( 'Schedule Sessions', 'Schedule Sessions', 'manage_options', 'schedule-session', 'all_sessions', 'dashicons-image-filter', 6 );
    add_submenu_page("schedule-session", "All Sessions", "All Sessions", "manage_options", "schedule-session", "all_sessions");
    add_submenu_page("schedule-session", "Coupons", "Coupons", "manage_options", "coupons", "session_coupons");
    add_submenu_page( 'schedule-session', 'Settings', 'Settings', 'manage_options', 'session-settings', 'schedule_session_settings' );
}
add_action( 'admin_menu', 'my_admin_menu' );

function all_sessions(){
    include('includes/template_schedule.php');
}

function schedule_session_settings(){
    include('includes/schedule_session_settings.php');
}

function session_coupons(){
    include('includes/template_coupon.php');
}