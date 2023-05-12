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
		'title'      => esc_html__( 'Client removed', 'realgh' ),
		'id'         => 'client_removed',
		'desc'       => 	'<strong>tar_id</strong> - the user to whom the email is sent<br>
								<strong>cur_id</strong> - the user from whom the email is sent<br>
								<br>
								<strong>[rlgh_first_name tar_id=""]</strong> - user name<br>
								<strong>[rlgh_full_name cur_id=""]</strong> - full user name<br>
								<strong>[rlgh_link value="value" text="text"]</strong> - link<br>
								<strong>[rlgh_list]Some text[/rlgh_list]</strong> - list<br>
								<strong>[rlgh_ses_type ses_id=""]</strong> - session type<br>
								<strong>[rlgh_ses_time ses_id="" tar_id=""]</strong> - session time and date<br>
								<strong>[rlgh_ses_money ses_id=""]</strong> - the cost of the session',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'client_removed_title',
				'type'     => 'text',
				'title'    => esc_html__( 'Email title', 'realgh' ),
				'subtitle' => esc_html__( 'Enter the title of the email', 'realgh' ),
			),
			array(
				'id'       => 'client_removed_text',
				'type'     => 'textarea',
				'title'    => esc_html__( 'Email text', 'realgh' ),
				'subtitle' => esc_html__( 'Enter the text of the email', 'realgh' ),
			),
			array(
				'id'           => 'client_removed_image',
				'type'         => 'media',
				'url'          => true,
				'title'        => esc_html__( 'Email image', 'realgh' ),
				'compiler'     => 'true',
				'subtitle'     => esc_html__( 'Select an image for the email', 'realgh' ),
				'preview_size' => 'full',
			),
		),
	)
);
