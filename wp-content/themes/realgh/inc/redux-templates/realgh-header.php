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
		'title'      => esc_html__( 'Header fileds', 'realgh' ),
		'id'         => 'header',
		'desc'       => esc_html__( 'Settings for header', 'realgh' ),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'login_btn',
				'type'     => 'text',
				'title'    => esc_html__( 'Login button text', 'realgh' ),
				'subtitle' => esc_html__( 'Enter the text of the login button', 'realgh' ),
			),
			array(
				'id'       => 'regist_btn',
				'type'     => 'text',
				'title'    => esc_html__( 'Sign up button text', 'realgh' ),
				'subtitle' => esc_html__( 'Enter the text of the sign up button', 'realgh' ),
			),
		),
	)
);
