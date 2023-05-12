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
		'title'      => esc_html__( 'Review popup', 'realgh' ),
		'id'         => 'review_popup',
		'desc'       => esc_html__( 'Fields for review popup', 'realgh' ),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'review_title',
				'type'     => 'text',
				'title'    => esc_html__( 'Title', 'realgh' ),
				'subtitle' => esc_html__( 'Enter the title of the popup', 'realgh' ),
			),
			array(
				'id'       => 'review_text',
				'type'     => 'textarea',
				'title'    => esc_html__( 'Text', 'realgh' ),
				'subtitle' => esc_html__( 'Enter the text of the popup', 'realgh' ),
			),
			array(
				'id'          => 'rep_review_params',
				'type'        => 'repeater',
				'title'       => esc_html__( 'Review parameters', 'realgh' ),
				'full_width'  => true,
				'item_name'   => '',
				'sortable'    => true,
				'active'      => false,
				'collapsible' => false,
				'fields'      => array(
					array(
						'id'       => 'review_field_text',
						'type'     => 'text',
						'title'    => esc_html__( 'Field text', 'realgh' ),
						'subtitle' => esc_html__( 'Enter the text of the field', 'realgh' ),
					),
					array(
						'id'       => 'review_field_slug',
						'type'     => 'text',
						'title'    => esc_html__( 'Field slug', 'realgh' ),
						'subtitle' => esc_html__( 'Enter field slug', 'realgh' ),
					),
				),
			),
			array(
				'id'       => 'review_textarea',
				'type'     => 'text',
				'title'    => esc_html__( 'Textarea placeholder', 'realgh' ),
				'subtitle' => esc_html__( 'Enter the textarea placeholder', 'realgh' ),
			),
			array(
				'id'       => 'review_check',
				'type'     => 'text',
				'title'    => esc_html__( 'Checkbox text', 'realgh' ),
				'subtitle' => esc_html__( 'Enter text agreeing to show the user\'s name and photo', 'realgh' ),
			),
			array(
				'id'       => 'review_button',
				'type'     => 'text',
				'title'    => esc_html__( 'Button text', 'realgh' ),
				'subtitle' => esc_html__( 'Enter the text of the button', 'realgh' ),
			),
		),
	)
);
