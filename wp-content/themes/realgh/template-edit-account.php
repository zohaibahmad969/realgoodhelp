<?php
/*
* Template name: Template Edit Account
*/

get_header();

$current_user = wp_get_current_user();

if($current_user) {
    global $wpdb;
    $roles = $current_user->roles;

    if (in_array("therapist", $roles) || in_array("administrator", $roles)){
        if($_POST){ 
            $response = edit_pyschologist_user_info($current_user);
            $current_user = wp_get_current_user();
        }
        $user_additional_data = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}users_data a JOIN {$wpdb->prefix}therapists_data b ON a.user_id = b.therapist_id WHERE a.user_id = $current_user->ID");
    
        $user_additional_data = wp_unslash($user_additional_data);
        include('template-psycho-edit.php');
    } else if(in_array("client", $roles)) {
        if($_POST){
            $response = edit_client_user_info($current_user);
            $current_user = wp_get_current_user();
        }
        $user_additional_data = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}users_data a JOIN {$wpdb->prefix}clients_data b ON a.user_id = b.client_id WHERE a.user_id = $current_user->ID");
        $user_additional_data = wp_unslash($user_additional_data);
        include('template-client-edit.php');
    }
}

get_footer(); ?>