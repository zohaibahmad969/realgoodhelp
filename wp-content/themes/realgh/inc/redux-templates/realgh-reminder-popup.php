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
		'title'      => esc_html__( 'Reminder popup', 'wellbeing' ),
		'id'         => 'reminder_popup',
		'desc'       => esc_html__( 'Settings for reminder popup', 'wellbeing' ),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'reminder_title',
				'type'     => 'text',
				'title'    => esc_html__( 'Reminder title', 'wellbeing' ),
				'desc' => esc_html__( 'Enter the title of the reminder pop-up', 'wellbeing' ),
			),
			array(
				'id'       => 'telegram_tab_title',
				'type'     => 'text',
				'title'    => esc_html__( 'Telegram tab title', 'wellbeing' ),
				'desc' => esc_html__( 'Enter a name for the telegram tab', 'wellbeing' ),
			),
			array(
				'id'       => 'telegram_bot_link',
				'type'     => 'text',
				'title'    => esc_html__( 'Before telegram bot link', 'wellbeing' ),
				'desc' => esc_html__( 'Enter text before the link to the telegram bot', 'wellbeing' ),
			),
			array(
				'id'       => 'telegram_bot',
				'type'     => 'text',
				'title'    => esc_html__( 'Telegram bot name', 'wellbeing' ),
				'desc' => esc_html__( 'Enter the name of the telegram bot', 'wellbeing' ),
			),
			array(
				'id'       => 'telegram_user_id',
				'type'     => 'text',
				'title'    => esc_html__( 'User id label', 'wellbeing' ),
				'desc' => esc_html__( 'Enter a label for the field with the user id', 'wellbeing' ),
			),
			array(
				'id'       => 'email_tab_title',
				'type'     => 'text',
				'title'    => esc_html__( 'Email tab title', 'wellbeing' ),
				'desc' => esc_html__( 'Enter a name for the email tab', 'wellbeing' ),
			),
			array(
				'id'       => 'email_label',
				'type'     => 'text',
				'title'    => esc_html__( 'Email label', 'wellbeing' ),
				'desc' => esc_html__( 'Enter a label for the field with the user email', 'wellbeing' ),
			),
			array(
				'id'       => 'interval_label',
				'type'     => 'text',
				'title'    => esc_html__( 'Interval label', 'wellbeing' ),
				'desc' => esc_html__( 'Enter a label for the field with the interval', 'wellbeing' ),
			),
			array(
				'id'       => 'interval_after',
				'type'     => 'text',
				'title'    => esc_html__( 'After interval field', 'wellbeing' ),
				'desc' => esc_html__( 'Enter text after the interval field', 'wellbeing' ),
			),
			array(
				'id'       => 'time_label',
				'type'     => 'text',
				'title'    => esc_html__( 'Time label', 'wellbeing' ),
				'desc' => esc_html__( 'Enter text for the reminder time selection field label', 'wellbeing' ),
			),
			array(
				'id'       => 'time_after',
				'type'     => 'text',
				'title'    => esc_html__( 'After time field', 'wellbeing' ),
				'desc' => esc_html__( 'Enter text after the field with the reminder time selection', 'wellbeing' ),
			),

			array(
				'id'       => 'reminder_popup_btn',
				'type'     => 'text',
				'title'    => esc_html__( 'Remider form button', 'wellbeing' ),
				'desc' => esc_html__( 'Enter text for the pop-up reminder button', 'wellbeing' ),
			),
		)
	)
);
