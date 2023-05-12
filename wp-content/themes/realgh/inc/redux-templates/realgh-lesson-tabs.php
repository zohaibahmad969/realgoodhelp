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
		'title'      => esc_html__( 'Tabs settings', 'wellbeing' ),
		'id'         => 'tabs',
		'desc'       => esc_html__( 'Settings for tabs', 'wellbeing' ),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'strategy_tab',
				'type'     => 'text',
				'title'    => esc_html__( 'Strategy tab', 'wellbeing' ),
				'desc' => esc_html__( 'Enter a tab name', 'wellbeing' ),
			),
			array(
				'id'       => 'other_tab',
				'type'     => 'text',
				'title'    => esc_html__( 'Other resources tab', 'wellbeing' ),
				'desc' => esc_html__( 'Enter a tab name', 'wellbeing' ),
			),
			array(
				'id'       => 'science_tab',
				'type'     => 'text',
				'title'    => esc_html__( 'Science tab', 'wellbeing' ),
				'desc' => esc_html__( 'Enter a tab name', 'wellbeing' ),
			),
		),
	)
);
