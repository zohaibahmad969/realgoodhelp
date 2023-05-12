<?php
/*
* Template name: Template Dashboard
*/

get_header();

$is_empty = false;

$current_user = wp_get_current_user();

if($current_user) {
    
    $roles = $current_user->roles;
    global $wpdb;
    $table_name = $wpdb->prefix . "users_data";
    $user_additional_data = $wpdb->get_row( "SELECT * FROM $table_name WHERE user_id = $current_user->ID" );
    // $user_additional_data = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}users_data a JOIN {$wpdb->prefix}therapists_data b ON a.user_id = b.therapist_id WHERE a.user_id = $current_user->ID");
    if (in_array("therapist", $roles) || in_array("administrator", $roles)){
        include('template-psycho-dashboard.php');
    } else if(in_array("client", $roles)) {
        include('template-client-dashboard.php');
    }
}

get_footer(); ?>