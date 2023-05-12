<?php 


if(isset($_GET['payment_key']) && !empty($_GET['payment_key'])){
    include('single_session.php');
} else {
    include('all_sessions.php');
}