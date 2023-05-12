<?php
// ************* Remove default Comments type since no blog *************

// Remove side menu
add_action( 'admin_menu', 'realgh_remove_comments' );
function realgh_remove_comments() {
    remove_menu_page( 'edit-comments.php' );
}

// Remove +New post in top Admin Menu Bar
add_action( 'admin_bar_menu', 'realgh_remove_comments_menu_bar', 999 );
function realgh_remove_comments_menu_bar( $wp_admin_bar ) {
    $wp_admin_bar->remove_menu( 'comments' );
}

// Remove comments filed from all pages
add_action( 'add_meta_boxes' , 'realgh_remove_comments_fields', 99 );
function realgh_remove_comments_fields() {
    remove_meta_box( 'commentstatusdiv', null , 'normal' ); // removes comments status
    remove_meta_box( 'commentsdiv',      null , 'normal' ); // removes comments
}