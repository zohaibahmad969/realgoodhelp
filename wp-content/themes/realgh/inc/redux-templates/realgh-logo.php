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
		'title'      => esc_html__( 'Logo block', 'realgh' ),
		'id'         => 'logo-block',
		'desc'       => esc_html__( 'Settings for the website logo', 'realgh' ),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'           => 'logo',
				'type'         => 'media',
				'url'          => true,
				'title'        => esc_html__( 'Logo image', 'realgh' ),
				'compiler'     => 'true',
				'subtitle'     => esc_html__( 'Select the image to be displayed as the website logo', 'realgh' ),
				'preview_size' => 'full',
			),
			array(
				'id'           => 'logo_alt',
				'type'         => 'media',
				'url'          => true,
				'title'        => esc_html__( 'Alternative logo image', 'realgh' ),
				'compiler'     => 'true',
				'subtitle'     => esc_html__( 'Select the image to be displayed as the alternative website logo', 'realgh' ),
				'preview_size' => 'full',
			),
		),
	)
);
