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
		'title'      => esc_html__( 'Footer fileds', 'realgh' ),
		'id'         => 'footer',
		'desc'       => esc_html__( 'Settings for footer', 'realgh' ),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'footnote',
				'type'     => 'text',
				'title'    => esc_html__( 'Footnote text', 'realgh' ),
				'subtitle' => esc_html__( 'Enter the text of the notes in the footer of the website', 'realgh' ),
			),
			array(
				'id'       => 'contact_title',
				'type'     => 'text',
				'title'    => esc_html__( 'Contacts headline', 'realgh' ),
				'subtitle' => esc_html__( 'Enter the section heading of the contact column', 'realgh' ),
			),
			array(
				'id'       => 'feedback_btn',
				'type'     => 'text',
				'title'    => esc_html__( 'Feedback button text', 'realgh' ),
				'subtitle' => esc_html__( 'Enter the text of the feedback button', 'realgh' ),
			),
			array(
				'id'       => 'copyright',
				'type'     => 'text',
				'title'    => esc_html__( 'Copyright text', 'realgh' ),
				'subtitle' => esc_html__( 'Enter the text of the copy rights', 'realgh' ),
			),
			array(
				'id'       => 'policy',
				'type'     => 'text',
				'title'    => esc_html__( 'Privacy policy link', 'realgh' ),
				'desc' => esc_html__( 'Enter the text of the link to the privacy policy', 'realgh' ),
			),
			array(
				'id'       => 'policy_value',
				'type'     => 'text',
				'desc' => esc_html__( 'Enter the id of the page to which the link should lead', 'realgh' ),
			),
			array(
				'id'       => 'terms',
				'type'     => 'text',
				'title'    => esc_html__( 'Terms link', 'realgh' ),
				'desc' => esc_html__( 'Enter the text of the link to the terms of use', 'realgh' ),
			),
			array(
				'id'       => 'terms_value',
				'type'     => 'text',
				'desc' => esc_html__( 'Enter the id of the page to which the link should lead', 'realgh' ),
			),
		),
	)
);
