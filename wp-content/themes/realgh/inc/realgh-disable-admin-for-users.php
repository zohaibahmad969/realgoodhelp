<?php

/*
 * Disable admin page for therapists and clients
*/

add_action('admin_init', 'realgh_redirect_users_from_admin');

function realgh_redirect_users_from_admin() {
   if ( !(current_user_can('edit_pages') || current_user_can('edit_posts')) && !wp_doing_ajax() ) {
      wp_redirect(home_url());
   }
}