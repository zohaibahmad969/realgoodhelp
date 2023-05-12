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
		'title'      => esc_html__( 'Category settings', 'realgh' ),
		'id'         => 'cat_page',
		'desc'       => esc_html__( 'Settings for category page', 'realgh' ),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'cat_subtitle',
				'type'     => 'text',
				'title'    => esc_html__( 'Category subtitle', 'realgh' ),
				'desc' => esc_html__( 'Enter a subtitle to be displayed above the questions', 'realgh' ),
			),
			array(
				'id'       => 'quest_btn_text',
				'type'     => 'text',
				'title'    => esc_html__( 'Questions button text', 'realgh' ),
				'desc' => esc_html__( 'Enter the text to be displayed on the button to the right of the questions', 'realgh' ),
			),
			array(
				'id'       => 'quest_sec_btn_text',
				'type'     => 'text',
				'title'    => esc_html__( 'The text of the secondary questions button', 'realgh' ),
				'desc' => esc_html__( 'Enter the text to be displayed on the button to the right of the secondary questions', 'realgh' ),
			),
			array(
				'id'       => 'save_btn_text',
				'type'     => 'text',
				'title'    => esc_html__( 'Save button text', 'realgh' ),
				'desc' => esc_html__( 'Enter the text to be displayed on the save button', 'realgh' ),
			),
			array(
				'id'           => 'save_icon',
				'type'         => 'media',
				'url'          => true,
				'title'        => esc_html__( 'Save icon', 'realgh' ),
				'compiler'     => 'true',
				'subtitle'     => esc_html__( 'Select the image to be displayed as the save icon', 'realgh' ),
				'preview_size' => 'full',
			),
			array(
				'id'           => 'save_cancel_icon',
				'type'         => 'media',
				'url'          => true,
				'title'        => esc_html__( 'Save cancel icon', 'realgh' ),
				'compiler'     => 'true',
				'subtitle'     => esc_html__( 'Select the image to be displayed as the save cancel icon', 'realgh' ),
				'preview_size' => 'full',
			),
		),
	)
);
