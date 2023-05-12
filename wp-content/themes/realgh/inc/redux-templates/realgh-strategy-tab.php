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
		'title'      => esc_html__( 'Strategy tab', 'wellbeing' ),
		'id'         => 'strategy',
		'desc'       => esc_html__( 'Settings for strategy tab', 'wellbeing' ),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'top_link_text',
				'type'     => 'text',
				'title'    => esc_html__( 'Top link', 'wellbeing' ),
				'desc' => esc_html__( 'Enter text for the top link', 'wellbeing' ),
			),
			array(
				'id'       => 'top_link_value',
				'type'     => 'text',
				'desc' => esc_html__( 'Enter value for the top link', 'wellbeing' ),
			),
			array(
				'id'       => 'group_title',
				'type'     => 'text',
				'title'    => esc_html__( 'Group links title', 'wellbeing' ),
				'desc' => esc_html__( 'Enter the title of the reference group', 'wellbeing' ),
			),
			array(
				'id'       => 'suggest_label',
				'type'     => 'text',
				'title'    => esc_html__( 'Suggestion form label', 'wellbeing' ),
				'desc' => esc_html__( 'Enter the label text for the suggestion form', 'wellbeing' ),
			),
			array(
				'id'       => 'suggest_btn',
				'type'     => 'text',
				'title'    => esc_html__( 'Suggestion form button text', 'wellbeing' ),
				'desc' => esc_html__( 'Enter the button text for the suggestion form', 'wellbeing' ),
			),
		),
	)
);
