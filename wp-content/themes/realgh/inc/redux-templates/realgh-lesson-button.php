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
		'title'      => esc_html__( 'Lesson button', 'wellbeing' ),
		'id'         => 'button',
		'desc'       => esc_html__( 'Settings for lesson button', 'wellbeing' ),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'btn_text',
				'type'     => 'text',
				'title'    => esc_html__( 'Save lesson button text', 'wellbeing' ),
				'subtitle' => esc_html__( 'Enter the text of the save button', 'wellbeing' ),
			),
			array(
				'id'       => 'btn_remove',
				'type'     => 'text',
				'title'    => esc_html__( 'Remove lesson button text', 'wellbeing' ),
				'subtitle' => esc_html__( 'Enter the text of the remove button', 'wellbeing' ),
			),
		),
	)
);
