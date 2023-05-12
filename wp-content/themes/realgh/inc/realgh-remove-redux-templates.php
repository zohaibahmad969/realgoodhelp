<?php
/*
 * Remove redux templates
*/

function realgh_remove_redux_templates( $templates ) {
	unset( $templates['redux-templates_contained'] );
	unset( $templates['redux-templates_full_width'] );
	unset( $templates['redux-templates_canvas'] );
	
	return $templates;
}
add_filter( 'theme_post_templates', 'realgh_remove_redux_templates', 999 );
add_filter( 'theme_page_templates', 'realgh_remove_redux_templates', 999 );