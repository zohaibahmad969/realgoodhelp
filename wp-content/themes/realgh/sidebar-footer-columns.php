<?php
/**
 * The sidebar containing the footer widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Joint_Theme
 */

if ( ! is_active_sidebar( 'realgh_footer_widgets' ) ) {
	return;
}


dynamic_sidebar( 'realgh_footer_widgets' );