<?php
/*
 * Add custom classes to nav-menu
*/
// Li class filter
function realgh_add_custom_class_on_li($classes, $item, $args) {
	if(isset($args->add_li_class)) {
		$classes[] = $args->add_li_class;
	}
	return $classes;
}
add_filter('nav_menu_css_class', 'realgh_add_custom_class_on_li', 1, 3);

// Link class filter

function realgh_add_custom_class_on_link( $atts, $item, $args ) {
	if (isset($args->link_class)) {
		$atts['class'] = $args->link_class;
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'realgh_add_custom_class_on_link', 1, 3 );