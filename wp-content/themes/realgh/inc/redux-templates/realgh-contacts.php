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
		'title'      => esc_html__( 'Contact information', 'realgh' ),
		'id'         => 'contacts',
		'desc'       => esc_html__( 'Fields for contact information', 'realgh' ),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'phone',
				'type'     => 'text',
				'title'    => esc_html__( 'Phone number', 'realgh' ),
				'subtitle' => esc_html__( 'Enter the phone number', 'realgh' ),
			),
			array(
				'id'       => 'email',
				'type'     => 'text',
				'title'    => esc_html__( 'Email address', 'realgh' ),
				'subtitle' => esc_html__( 'Enter email address', 'realgh' ),
			),
			array(
				'id'          => 'rep_social',
				'type'        => 'repeater',
				'title'       => esc_html__( 'Social media', 'realgh' ),
				'full_width'  => true,
				'item_name'   => '',
				'sortable'    => true,
				'active'      => false,
				'collapsible' => false,
				'fields'      => array(
					array(
						'id'       => 'social_icon',
						'type'     => 'select',
						'title'    => esc_html__( 'Social icon', 'realgh' ),
						'subtitle' => esc_html__( 'Select which social network icon should be displayed for this link', 'realgh' ),
						'options'  => array(
							'facebook' => 'Facebook',
							'youtube' => 'YouTube',
							'instagram' => 'Instagram',
							'linkedin' => 'Linkedin',
							'tiktok' => 'TikTok',
							'twitter' => 'Twitter',
						),
					),
					array(
						'id'       => 'social_link',
						'type'     => 'text',
						'title'    => esc_html__( 'Social link', 'realgh' ),
						'subtitle' => esc_html__( 'Enter the social media link', 'realgh' ),
					),
				),
			),
		),
	)
);
