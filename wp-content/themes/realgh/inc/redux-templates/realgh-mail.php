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
		'title'      => esc_html__( 'Mail setting', 'realgh' ),
		'id'         => 'mail',
		'desc'       => esc_html__( 'Settings for email', 'realgh' ),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'mail_to',
				'type'     => 'text',
				'title'    => esc_html__( 'Email to', 'realgh' ),
				'subtitle' => esc_html__( 'Enter the email address to which the messages will be sent', 'realgh' ),
			),
			array(
				'id'       => 'mail_theme',
				'type'     => 'text',
				'title'    => esc_html__( 'Message theme', 'realgh' ),
				'subtitle' => esc_html__( 'Enter a message theme', 'realgh' ),
			),
		),
	)
);
