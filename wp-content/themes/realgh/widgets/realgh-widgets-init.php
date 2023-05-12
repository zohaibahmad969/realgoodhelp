<?php
/*
 * Initialise all custom widgets
*/

// register Custom widgets
function realgh_register_widgets() {
	register_widget( 'Realgh_Column_Widget' );
}
add_action( 'widgets_init', 'realgh_register_widgets' );



// connect scripts
function realgh_widget_script( $hook ) {
	if ( 'widgets.php' != $hook ) {
		return;
	}
	wp_enqueue_script( 'realgh_widget_script', get_template_directory_uri() . '/widgets/realgh-widget-column-script.js' );
	wp_localize_script('realgh_widget_script', 'rlghAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
}
add_action( 'admin_enqueue_scripts', 'realgh_widget_script', 99 );