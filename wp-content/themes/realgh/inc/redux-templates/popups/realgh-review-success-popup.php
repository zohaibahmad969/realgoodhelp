<?php
/**
 * Redux Framework media config.
 * For full documentation, please visit: http://devs.redux.io/
 *
 * @package Redux Framework
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
	$opt_name,
	array(
		'title'      => esc_html__( 'Review success popup', 'realgh' ),
		'id'         => 'review-success_popup',
		'desc'       => esc_html__( 'Fields for review popup', 'realgh' ),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'review-suc_title',
				'type'     => 'text',
				'title'    => esc_html__( 'Title', 'realgh' ),
				'subtitle' => esc_html__( 'Enter the title of the popup', 'realgh' ),
			),
			array(
				'id'       => 'review-suc_text',
				'type'     => 'textarea',
				'title'    => esc_html__( 'Text', 'realgh' ),
				'subtitle' => esc_html__( 'Enter the text of the popup', 'realgh' ),
			),
		),
	)
);
