<?php

/*
* Remove the register link from the wp-login.php script
*/

add_filter('option_users_can_register', 'realgh_remove_register_link');

function realgh_remove_register_link($value) {
    $script = basename(parse_url($_SERVER['SCRIPT_NAME'], PHP_URL_PATH));
  
    if ($script == 'wp-login.php') {
        $value = false;
    }
  
    return $value;
}