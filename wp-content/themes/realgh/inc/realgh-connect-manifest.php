<?php

/*
 * Connecting the manifest file for PWA
*/

add_action( 'wp_head', 'realgh_manifest_link' );

function realgh_manifest_link() {   
	echo '<link rel="manifest" href="' . get_template_directory_uri() . '/manifest.json">';
	echo '<meta name="theme-color" content="#6ba7fa">';
	echo '<link rel="apple-touch-icon" href="' . get_template_directory_uri() . '/assets/pwa_icons/ios/180.png">';
}