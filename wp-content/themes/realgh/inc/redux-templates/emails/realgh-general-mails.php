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
		'title'      => esc_html__( 'General fileds', 'realgh' ),
		'id'         => 'general_mails',
		'desc'       => esc_html__( 'General settings for emails', 'realgh' ),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'           => 'email_logo',
				'type'         => 'media',
				'url'          => true,
				'title'        => esc_html__( 'Email logo', 'realgh' ),
				'compiler'     => 'true',
				'subtitle'     => esc_html__( 'Select the image to be shown as the logo in emails', 'realgh' ),
				'preview_size' => 'full',
			),
			array(
				'id'       => 'email_regards',
				'type'     => 'textarea',
				'title'    => esc_html__( 'Email regards', 'realgh' ),
				'subtitle' => esc_html__( 'Enter the text of your best regards', 'realgh' ),
			),
			array(
				'id'           => 'mail_facebook',
				'type'         => 'media',
				'url'          => true,
				'title'        => esc_html__( 'Facebook icon', 'realgh' ),
				'compiler'     => 'true',
				'preview_size' => 'full',
			),
			array(
				'id'           => 'mail_youtube',
				'type'         => 'media',
				'url'          => true,
				'title'        => esc_html__( 'Youtube icon', 'realgh' ),
				'compiler'     => 'true',
				'preview_size' => 'full',
			),
			array(
				'id'           => 'mail_instagram',
				'type'         => 'media',
				'url'          => true,
				'title'        => esc_html__( 'Instagram icon', 'realgh' ),
				'compiler'     => 'true',
				'preview_size' => 'full',
			),
			array(
				'id'           => 'mail_twitter',
				'type'         => 'media',
				'url'          => true,
				'title'        => esc_html__( 'Twitter icon', 'realgh' ),
				'compiler'     => 'true',
				'preview_size' => 'full',
			),
			array(
				'id'           => 'mail_linkedin',
				'type'         => 'media',
				'url'          => true,
				'title'        => esc_html__( 'Linkedin icon', 'realgh' ),
				'compiler'     => 'true',
				'preview_size' => 'full',
			),
			array(
				'id'           => 'mail_tiktok',
				'type'         => 'media',
				'url'          => true,
				'title'        => esc_html__( 'Tiktok icon', 'realgh' ),
				'compiler'     => 'true',
				'preview_size' => 'full',
			),
			array(
				'id'           => 'mail_list_mark',
				'type'         => 'media',
				'url'          => true,
				'title'        => esc_html__( 'List mark', 'realgh' ),
				'compiler'     => 'true',
				'preview_size' => 'full',
			),
		),
	)
);
