<?php
/*
* Template name: Template Reminder Email Cronjobs
*/

require_once('wp-config.php');
ini_set('output_buffering', 0);
ini_set('zlib.output_compression', 0);

global $wpdb;

$sessions = $wpdb->prefix . "sessions";
$users_table = $wpdb->prefix . "users";
$user_meta_table = $wpdb->prefix . "usermeta";


//  $therapists_data = $wpdb->get_results("SELECT users.ID, users.user_nicename, users.user_registered, meta_data.half_rate, meta_data.hourly_rate, meta_data.chat_rate, meta_data.account_status FROM $users_table as users INNER JOIN $user_meta_table as users_meta ON users.ID = users_meta.user_id LEFT JOIN $sessions as meta_data ON meta_data.user_id = users.ID  WHERE users_meta.meta_key = '{$wpdb->prefix}capabilities' AND users_meta.meta_value LIKE '%therapist%'");

$user_sessions_pending_history = $wpdb->get_results( "SELECT * FROM $sessions WHERE session_status = 'pending' AND session_date <= CURDATE()");

$utc_date_time = gmdate("Y-m-d H:i");

foreach($user_sessions_pending_history as $single_user_sessions_pending_history) {

    $session_datetime = $single_user_sessions_pending_history->session_date . ' ' . $single_user_sessions_pending_history->session_end; 

    $future_session_datetime = strtotime($session_datetime . ' + 3 days');
    $current_datetime = strtotime($utc_date_time);

    if($future_session_datetime < $current_datetime){
        $payment_key = $single_user_sessions_pending_history->id;
        $status_change =  $wpdb->update($sessions, array("session_status" => "done" ), array('id' => $payment_key));
    }
}
?>
