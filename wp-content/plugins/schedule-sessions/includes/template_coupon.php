<?php 


if(isset($_GET['coupon_id']) && !empty($_GET['coupon_id'])){
    include('single_coupon.php');
} else if(isset($_GET['coupon']) && $_GET['coupon'] == 'add_new') {
    include('add_coupon.php');
} else {
    include('all_coupons.php');
}