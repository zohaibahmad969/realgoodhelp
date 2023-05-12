<?php
/*
 * Converts multi-dimensional array to a flat array.
*/

function realgh_array_flatten( $input ) {
	if ( ! is_array( $input ) ) {
		return array( $input );
	}

	$output = array();

	foreach ( $input as $value ) {
		$output = array_merge( $output, realgh_array_flatten( $value ) );
	}

	return $output;
}