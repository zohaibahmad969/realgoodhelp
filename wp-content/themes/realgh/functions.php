<?php

/**
 * realgh functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package realgh
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.1');
}

/**
 * Constants
*/
const CURRENCY = 'USD';

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function realgh_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on realgh, use a find and replace
		* to change 'realgh' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('realgh', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'main-menu' => esc_html__('Primary', 'realgh'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'realgh_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function realgh_content_width()
{
	$GLOBALS['content_width'] = apply_filters('realgh_content_width', 640);
}
add_action('after_setup_theme', 'realgh_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function realgh_widgets_init()
{
	// register_sidebar(
	// 	array(
	// 		'name'          => esc_html__( 'Sidebar', 'realgh' ),
	// 		'id'            => 'sidebar-1',
	// 		'description'   => esc_html__( 'Add widgets here.', 'realgh' ),
	// 		'before_widget' => '<section id="%1$s" class="widget %2$s">',
	// 		'after_widget'  => '</section>',
	// 		'before_title'  => '<h2 class="widget-title">',
	// 		'after_title'   => '</h2>',
	// 	)
	// );
	register_sidebar(
		array(
			'name'          => esc_html__('Footer widgets', 'realgh'),
			'id'            => 'realgh_footer_widgets',
			'description'   => esc_html__('Sidebar, which displays information in the footer columns', 'realgh'),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);
}
add_action('widgets_init', 'realgh_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function realgh_scripts()
{
    wp_enqueue_style('realgh-style', get_stylesheet_uri(), array(), time());
    wp_enqueue_style('rlgh-main-style', get_template_directory_uri() . '/assets/css/style.min.css', array(), time());
    wp_enqueue_style('jquery-ui-style', get_template_directory_uri() . '/assets/css/jquery-ui.css', array(), time());
	wp_enqueue_style('zohaib-style', get_template_directory_uri() . '/assets/css/zohaib.css', array(), time());

    wp_enqueue_script( 'jquery-ui-datepicker' );
    wp_enqueue_script('jQuery', get_template_directory_uri() . '/assets/js/jquery.js', array(), time());
    wp_enqueue_script('jQuery-validate', get_template_directory_uri() . '/assets/js/jquery-validate.js', array(), time());
    wp_enqueue_script('rlgh-script', get_template_directory_uri() . '/assets/js/script.js', array('wp-blocks', 'firebase-app', 'firebase-messaging'), time(), true);
    wp_enqueue_script( 'tunnel_cards-script', get_template_directory_uri() . '/assets/js/tunnel_cards.js', array(), time(), true );
    wp_enqueue_script( 'tunnel_cards-script', get_template_directory_uri() . '/assets/js/tunnel_cards.js', array(), time(), true );
    wp_enqueue_script( 'firebase-app', 'https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'firebase-messaging', 'https://www.gstatic.com/firebasejs/8.10.1/firebase-messaging.js', array(), _S_VERSION, true );
    wp_localize_script('rlgh-script', 'rlghData', array('ajaxurl' => admin_url('admin-ajax.php'), 'themePath' => get_template_directory_uri(), 'currency' => CURRENCY, 'siteUrl' => get_home_url()));
    wp_localize_script('ajax-js', 'ajax_params', array('ajax_url' => admin_url('admin-ajax.php')));

}
add_action('wp_enqueue_scripts', 'realgh_scripts');

/*
 * Common functions
*/
require_once get_template_directory() . "/inc/realgh-common.php";

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Redux config file.
 */
require get_template_directory() . '/inc/redux-config.php';

/*
 * Remove redux templates
*/
require_once get_template_directory() . "/inc/realgh-remove-redux-templates.php";

/**
 * Add meta pixel code.
 */
require get_template_directory() . '/inc/realgh-add-meta-pixel.php';

/*
 * Remove inner container from WP group
*/
require_once get_template_directory() . "/inc/realgh-remove-inner-container.php";

/*
 * Remove Comments post type
*/
require_once get_template_directory() . "/inc/realgh-remove-comments.php";

/*
 * Remove the register link from the wp-login.php script
*/
require_once get_template_directory() . "/inc/realgh-remove-register-link.php";

/*
 * Disable admin page for therapists and clients
*/
require_once get_template_directory() . "/inc/realgh-disable-admin-for-users.php";

/*
 * Connecting the manifest file for PWA
*/
require_once get_template_directory() . "/inc/realgh-connect-manifest.php";

/*
 * Automatically set the image Title, Alt-Text upon upload
*/
require_once get_template_directory() . "/inc/realgh-autoset-image-attr.php";

/*
 * Add custom classes to nav-menu
*/
require_once get_template_directory() . "/inc/realgh-custom-nav-classes.php";

/*
 * Timezone functions
*/
require_once get_template_directory() . "/inc/realgh-timezone.php";

/*
 * List of specialisations
*/
require_once get_template_directory() . "/inc/realgh-specialisation-list.php";

/*
 * Display img function
*/
require_once get_template_directory() . "/inc/realgh-display-image.php";

/*
 * Create/update custom tables
*/
require_once get_template_directory() . "/inc/realgh-create-db-tables.php";

/*
 * Add custom fields for categories
*/
require_once get_template_directory() . "/inc/realgh-category-custom-fields.php";

/*
 * SMTP Setting to send the mail
*/
require_once get_template_directory() . "/inc/realgh-smtp-setting.php";

/*
 * Shortcodes for email template
*/
require_once get_template_directory() . "/inc/realgh-email-shortcodes.php";

/*
 * Custom email template
*/
require_once get_template_directory() . "/inc/realgh-email-template.php";

/*
 * Converts multi-dimensional array to a flat array
*/
require_once get_template_directory() . "/inc/realgh-array-flatten.php";

/*
 * Converts a file name to one that is not executable as a script
*/
require_once get_template_directory() . "/inc/realgh-antiscript-file-name.php";

/*
 * Customize login page
*/
require_once get_template_directory() . "/inc/realgh-custom-login-page.php";

/*
 * Reminder logic
*/
require_once get_template_directory() . "/inc/realgh-reminder.php";

/*
 * Ajax get a filtered list of therapists
*/
require_once get_template_directory() . "/inc/realgh-ajax-filter-psycho.php";

/*
 * Ajax get saved lessons
*/
require_once get_template_directory() . "/inc/realgh-ajax-saved-lessons.php";


/*
 * Ajax get get category meta data
*/
require_once get_template_directory() . "/inc/realgh-ajax-get-category-meta-data.php";

/*
 * Ajax send suggestion in the mail
*/
require_once get_template_directory() . "/inc/realgh-ajax-send-suggestion.php";

/*
 * Ajax sending forms
*/
require_once get_template_directory() . "/inc/forms/realgh-save-questionnaire.php";
require_once get_template_directory() . "/inc/forms/realgh-leave-review.php";
require_once get_template_directory() . "/inc/forms/realgh-client-request.php";

/*
 * Ajax sending emails
*/
require_once get_template_directory() . "/inc/send/realgh-send-booking.php";
require_once get_template_directory() . "/inc/send/realgh-send-support.php";
require_once get_template_directory() . "/inc/send/realgh-send-support-to-user.php";
require_once get_template_directory() . "/inc/send/realgh-send-reset.php";
require_once get_template_directory() . "/inc/send/realgh-send-withdraw.php";

/*
 * Ajax get calandar data
*/
require_once get_template_directory() . "/inc/realgh-ajax-calendar-data.php";

/*
 * Ajax check if user logged in
*/
require_once get_template_directory() . "/inc/realgh-ajax-check-if-user-logged-in.php";

/*
 * Ajax get session data
*/
require_once get_template_directory() . "/inc/realgh-ajax-session-data.php";

/*
 * Ajax Save User Progress
*/
require_once get_template_directory() . "/inc/realgh-ajax-user-save-progress.php";


/*
 * Widgets
*/
// Add column widget
require_once get_template_directory() . "/widgets/realgh-widget-column.php";
// Initialise all custom widgets
require_once get_template_directory() . "/widgets/realgh-widgets-init.php";
/*
 * Get thumbnail from YouTube url
*/
require_once get_template_directory() . "/inc/realgh-youtube-thumbnail.php";
/*
 * Edit YouTube url watch to embed
*/
require_once get_template_directory() . "/inc/realgh-edit-youtube-url.php";

/*
 * Get lesson thumbnail
*/
require_once get_template_directory() . "/inc/realgh-get-lesson-thumbnail.php";

/*
 * Registering a metabox class
*/
// Metabox class
require_once get_template_directory() . "/inc/meta-box-class/realgh-class-metaboxes.php";
// Metabox initializing function
require_once get_template_directory() . "/inc/metaboxes-init/realgh-homepage-metaboxes.php";
require_once get_template_directory() . "/inc/metaboxes-init/realgh-posts-metaboxes.php";
require_once get_template_directory() . "/inc/metaboxes-init/realgh-psychologists-metaboxes.php";
require_once get_template_directory() . "/inc/metaboxes-init/realgh-psychoedit-metaboxes.php";
require_once get_template_directory() . "/inc/metaboxes-init/realgh-questionnaire-metaboxes.php";
require_once get_template_directory() . "/inc/metaboxes-init/realgh-become-metaboxes.php";
require_once get_template_directory() . "/inc/metaboxes-init/realgh-term-of-use-metaboxes.php";
require_once get_template_directory() . "/inc/metaboxes-init/realgh-find-metaboxes.php";
require_once get_template_directory() . "/inc/metaboxes-init/realgh-thankyou-metaboxes.php";
require_once get_template_directory() . "/inc/metaboxes-init/realgh-dashboard-metaboxes.php";
require_once get_template_directory() . "/inc/metaboxes-init/realgh-booking-metaboxes.php";
require_once get_template_directory() . "/inc/metaboxes-init/realgh-edit-schedule-metaboxes.php";
require_once get_template_directory() . "/inc/metaboxes-init/realgh-single-psychologist-metaboxes.php";
require_once get_template_directory() . "/inc/metaboxes-init/realgh-lesson-metaboxes.php";
require_once get_template_directory() . "/inc/metaboxes-init/realgh-homepage-wellbeing-metaboxes.php";
require_once get_template_directory() . "/inc/metaboxes-init/realgh-homepage-wellbeing-new-metaboxes.php";
require_once get_template_directory() . "/inc/metaboxes-init/realgh-homepage-selfhelpv2-metaboxes.php";
require_once get_template_directory() . "/inc/metaboxes-init/realgh-my-strategies-metaboxes.php";
require_once get_template_directory() . "/inc/metaboxes-init/realgh-activation-metaboxes.php";

function registerForm()
{
	global $wpdb;
	$params = array();
	parse_str($_POST['data'], $params);

	$users_table = $wpdb->prefix . "users";
	$user_name = $params['fname'] . '_' . $params['lname'] . '_' . bin2hex(random_bytes(5));
	$user_by_username = $wpdb->get_row( "SELECT * FROM $users_table WHERE user_login = '$user_name'");

	$response = array();

	if($user_by_username){
		$response['error'] = "Username with same name already exist.";
		echo json_encode($response);
		die();
	} else{
		$userdata = array(
			'user_login' => $user_name,
			'user_pass'  => $params['password'],
			'user_email' => $params['email'],
			'first_name' => $params['fname'],
			'last_name'  => $params['lname'],
			'role'       => $params['user_type']
		);
	
		$user_id = wp_insert_user($userdata);
	}

	// Return
	if (!is_wp_error($user_id)) {

		$info = array();
		$info['user_login'] = $params['email'];
		$info['user_password'] = $params['password'];
		$info['remember'] = true;

		$user_signon = wp_signon($info, false);

		global $wpdb;
		$table_name = $wpdb->prefix . "users_data";
		$wpdb->insert($table_name, array('first_name' => $params['fname'], 'last_name' => $params['lname'],'phone' => $params['phone'], 'user_id' => $user_id, 'time_zone' => $params['time_zone'], 'accept_privacy_terms'  =>  $params['client_checkbox'], 'user_profile_pic' => get_template_directory_uri() . "/assets/img/dummy-profile-image.png"));

		$wpdb->insert($wpdb->prefix . "clients_data", array('client_id' => $user_id, 'money_back_count' => 0));
		$wpdb->insert($wpdb->prefix . 'users_settings', array('user_id' => $user_id));

		// ========== Send  email Notifical  ===============

		global $rlgh_data;

		// $verify_subject = "Email Verification";
		// $headers = array(
		// 	'From: RealGoodHelp Admin <' . SMTP_FROM . '>',
		// 	'content-type: text/html'
		// );

		// $code = sha1( $user_id . time() );
		// $activation_link = get_home_url() . '/email-verification/?key=' . $code . '&user=' . $user_id;

		// $verify_message = "Hello " .$params['fname'] . ", <br><br> Please click on the link to verify your account <a href='". $activation_link ."'>Verify Account</a><br><br> Thanks";

		// add_user_meta( $user_id, 'has_to_be_activated', $code, true );

		// wp_mail($params['email'], $verify_subject, $verify_message, $headers);

		$headers = array(
			'From: RealGoodHelp Admin <' . SMTP_FROM . '>',
			'content-type: text/html'
		);
		
		$message = str_replace(
			'tar_id=""',
			'id="' . $user_id . '"',
			$rlgh_data['client_welcome_text']
		);  

		$mailBody = email_template(
			$rlgh_data['client_welcome_title'],
			$message,
			$rlgh_data['client_welcome_image']['url']
		);
	
		wp_mail( $params['email'], $rlgh_data['client_welcome_title'], $mailBody, $headers );

		$response['success'] = "Congratulations, you have successfully registered";
	} else {
		$response['error'] = $user_id->get_error_message();
	}

	echo json_encode($response);

	die();
}

add_action('wp_ajax_registerForm', 'registerForm');
add_action('wp_ajax_nopriv_registerForm', 'registerForm');

// therapist useres fields//

function therapist_users_fields($user)
{
	$user_id = $user->ID;
	global $wpdb;

	$roles = $user->roles;
	if (in_array("therapist", $roles) || in_array("administrator", $roles)){
		$user_additional_data = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}users_data a JOIN {$wpdb->prefix}therapists_data b ON a.user_id = b.therapist_id JOIN {$wpdb->prefix}therapists_settings c ON a.user_id = c.therapist_id WHERE a.user_id = $user_id");
	} else{
		$user_additional_data = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}users_data a WHERE a.user_id = $user_id");
	}
	$user_additional_data = (object) wp_unslash($user_additional_data);
	?>

	<h3><?php _e('User Details'); ?></h3>
	<table class="form-table">
		<?php $verify = $user_additional_data->account_status; ?>

		<tr>
			<th><label for="user_profile_pic">User Profile Picture :</label></th>
			<td>
				<?php
					$userImg = $user_additional_data->user_profile_pic;
					if (!$userImg) {
						if (get_avatar_url($user->ID)) {
							$userImg = get_avatar_url($user->ID);
						} else {
							$userImg = get_template_directory_uri() . "/assets/img/dummy-profile-image.png";
						}
					}

					?>
				<img alt="" src="<?php echo $userImg ?>" srcset="<?php echo $userImg ?>" class="avatar avatar-96 photo" height="96" width="96" loading="lazy">
				<br />
				<input type="file" id="prfilePic" name="prfilePic" class="input-file" accept="image/png, image/jpeg, image/bmp">

			</td>
		</tr>

		<tr>
			<th><label for="phone">Phone</label></th>
			<td>
				<input type="text" name="phone" id="phone" value="<?php echo $user_additional_data->phone; ?>" class="regular-text" /><br />
			</td>
		</tr>

		<tr>
			<th><label for="date_of_birth">Date of birth</label></th>
			<td>
				<input type="text" name="date_of_birth" id="date_of_birth" value="<?php echo $user_additional_data->date_of_birth; ?>" class="regular-text" /><br />
			</td>
		</tr>

		<tr>
			<th><label for="country_name">Country of residence</label></th>
			<td>
				<?php $countryList = country_array();
					$country_data = $user_additional_data->country; ?>
				<select name="country" class="input input-text">
					<option value="">Country of residence</option>
					<?php foreach ($countryList as $key => $single_country) { ?>
						<option <?php if ($key == $country_data) { ?> selected="selected" <?php } ?> value="<?php echo $key; ?>"><?php echo $single_country; ?></option>
					<?php } ?>
				</select>
			</td>
		</tr>

		<tr>
			<th><label for="time_zone">Time zone</label></th>
			<td>
				<select name="time_zone" class="input input-text">
					<option value selected disabled>Select Timezone</option>
					<?php echo realgh_get_timezones('str', $user_additional_data->time_zone); ?>
				</select>
			</td>
		</tr>

		<tr>
			<th><label for="accept_privacy_terms">Accept Privacy & Terms</label></th>
			<td>
				<input type="checkbox" <?php if ($user_additional_data->accept_privacy_terms == '1') { echo "checked"; } ?> value="1" name="accept_privacy_terms" class="input check__input"> <br />
			</td>
		</tr>

		<?php 
			$roles = $user->roles;
			if (in_array("therapist", $roles) || in_array("administrator", $roles)){
		?>

		<tr>
			<th><label for="account_status">Verify Account</label></th>
			<td>
				<select name="account_status" id="account_status">
					<option value="unverified" <?php if ($verify == 'unverified') { ?> selected="selected" <?php } ?>>Unverified</option>
					<option value="verified" <?php if ($verify == 'verified') { ?> selected="selected" <?php } ?>>Verified</option>
					<option value="declined" <?php if ($verify == 'declined') { ?> selected="selected" <?php } ?>>Declined</option>
				</select>
			</td>
		</tr>

		<tr>
			<th><label for="top_therapists">Top Therapist</label></th>
			<td>
				<input type="checkbox" <?php if ($user_additional_data->top_therapists == '1') { echo "checked"; } ?> value="1" name="top_therapists" class="input check__input"> <br />
			</td>
		</tr>

		<tr>
			<th><label for="money_back_guarantee">Money Back Guarantee</label></th>
			<td>
				<input type="checkbox" <?php if ($user_additional_data->money_back_guarantee == '1') { echo "checked"; } ?> value="1" name="money_back_guarantee" class="input check__input"> <br />
			</td>
		</tr>

		<tr>
			<th><label for="half_rate">Half rate</label></th>
			<td>
				<input type="text" name="half_rate" id="half_rate" value="<?php echo $user_additional_data->half_rate; ?>" class="regular-text" /><br />
			</td>
		</tr>

		<tr>
			<th><label for="hourly_rate">Hourly rate</label></th>
			<td>
				<input type="text" name="hourly_rate" id="hourly_rate" value="<?php echo $user_additional_data->hourly_rate; ?>" class="regular-text" /><br />
			</td>
		</tr>

		<tr>
			<th><label for="chat_rate">Hourly chat rate</label></th>
			<td>
				<input type="text" name="chat_rate" id="chat_rate" value="<?php echo $user_additional_data->chat_rate; ?>" class="regular-text" /><br />
			</td>
		</tr>
		<!----------------------- Personal information ----------------------->

		<?php $qualification = $user_additional_data->qualification; ?>
		<tr>
			<th><label for="qualification">Qualification</label></th>
			<td>
				<select name="qualification" id="qualification">
					<option value="Clinical Psychologist" <?php if ($qualification == 'Clinical Psychologist') { ?> selected="selected" <?php } ?>>Clinical Psychologist</option>
					<option value="Counselling Psychologist" <?php if ($qualification == 'Counselling Psychologist') { ?> selected="selected" <?php } ?>>Counselling Psychologist</option>
					<option value="Psychiatrist" <?php if ($qualification == 'Psychiatrist') { ?> selected="selected" <?php } ?>>Psychiatrist</option>
					<option value="Counsellor" <?php if ($qualification == 'Counsellor') { ?> selected="selected" <?php } ?>>Counsellor</option>
					<option value="Coach" <?php if ($qualification == 'Coach') { ?> selected="selected" <?php } ?>>Coach</option>
				</select>
			</td>
		</tr>

		<tr>
			<th><label for="about_myself">About Myself</label></th>
			<td>
				<textarea name="about_myself" id="about_myself" rows="5" cols="50" class="regular-text"><?php echo $user_additional_data->about_myself; ?></textarea> <br />
			</td>
		</tr>

		<tr>
			<th><label for="phylosophy">My Phylosophy</label></th>
			<td>
				<textarea name="phylosophy" id="phylosophy" rows="5" cols="50" class="regular-text"><?php echo $user_additional_data->phylosophy; ?></textarea> <br />
			</td>
		</tr>

		<tr>
			<th><label for="higher_education">Higher Education</label></th>
			<td>
				<textarea name="higher_education" id="higher_education" rows="5" cols="50" class="regular-text"><?php echo $user_additional_data->higher_education; ?></textarea> <br />
			</td>
		</tr>

		<tr>
				<th><label for="main_method">My main method</label></th>
			<td>
				<?php
					$main_method =  unserialize($user_additional_data->main_method);
					?>

				<input type="radio" name="main_method[]" <?php if (!empty($main_method) && in_array("Psychoanalytic therapy", $main_method)) echo "checked"; ?> value="Psychoanalytic therapy" class="input radio__input">
				<label for="psychoanalytic" class="label radio__label checkbox__label text form__text">Psychoanalytic therapy</label>
				<br>

				<input type="radio" name="main_method[]" <?php if (!empty($main_method) && in_array("Transactional", $main_method)) echo "checked"; ?> value="Transactional" class="input radio__input">
				<label for="transactional" class="label radio__label checkbox__label text form__text">Transactional</label>
				<br>

				<input type="radio" name="main_method[]" <?php if (!empty($main_method) && in_array("Gestalt therapy", $main_method)) echo "checked"; ?> value="Gestalt therapy" class="input radio__input">
				<label for="gestalt" class="label radio__label checkbox__label text form__text">Gestalt therapy</label>
				<br>

				<input type="radio" name="main_method[]" <?php if (!empty($main_method) && in_array("Existential therapy", $main_method)) echo "checked"; ?> value="Existential therapy" class="input radio__input">
				<label for="existential" class="label radio__label checkbox__label text form__text">Existential therapy</label>
				<br>

				<input type="radio" name="main_method[]" <?php if (!empty($main_method) && in_array("Systemic family approach", $main_method)) echo "checked"; ?> value="Systemic family approach" class="input radio__input">
				<label for="systemic" class="label radio__label checkbox__label text form__text">Systemic family approach</label>
				<br>

				<input type="radio" name="main_method[]" <?php if (!empty($main_method) && in_array("CBT", $main_method)) echo "checked"; ?> value="CBT" class="input radio__input">
				<label for="cbt" class="label radio__label checkbox__label text form__text">CBT</label>
				<br>

				<input type="radio" name="main_method[]" <?php if (!empty($main_method) && in_array("Psychodrama", $main_method)) echo "checked"; ?> value="Psychodrama" class="input radio__input">
				<label for="psychodrama" class="label radio__label checkbox__label text form__text">Psychodrama</label>
				<br>

				<input type="radio" name="main_method[]" <?php if (!empty($main_method) && in_array("Integrative therapy", $main_method)) echo "checked"; ?> value="Integrative therapy" class="input radio__input">
				<label for="integrative" class="label radio__label checkbox__label text form__text">Integrative therapy</label>
				<br>

				<input type="radio" name="main_method[]" <?php if (!empty($main_method) && in_array("Other", $main_method)) echo "checked"; ?> value="Other" class="input radio__input">
				<label for="Other" class="label radio__label checkbox__label text form__text">Other</label>
				<br>

			</td>
		</tr>

		<!--<tr>
			<th><label for="other_main_method">Other my main method</label></th>
			<td>
				<input type="text" name="other_main_method" id="other_main_method" value="<?php echo $user_additional_data->other_main_method; ?>" class="regular-text" /><br />
			</td>
		</tr>-->

		<tr>
			<th><label for="basic_education">Study</label></th>
			<td>
				<textarea name="basic_education" id="basic_education" rows="5" cols="50" class="regular-text"><?php echo $user_additional_data->basic_education; ?></textarea> <br />
			</td>
		</tr>

		<tr>
			<th><label for="about_main_method">About main method</label></th>
			<td>
				<textarea name="about_main_method" id="about_main_method" rows="5" cols="50" class="regular-text"><?php echo $user_additional_data->about_main_method; ?></textarea> <br />
			</td>
		</tr>


		<tr>
			<th><label for="languages">Languages</label></th>
			<td>
				<?php
					$languages =  unserialize($user_additional_data->languages);
					?>

				<input type="checkbox" name="languages[]" <?php if (!empty($languages) && in_array("Mandarin", $languages)) echo "checked"; ?> value="Mandarin" class="input check__input">
				<label for="Mandarin" class="label check__label checkbox__label text form__text">Mandarin</label>
				<br>

				<input type="checkbox" name="languages[]" <?php if (!empty($languages) && in_array("Hindi", $languages)) echo "checked"; ?> value="Hindi" class="input check__input">
				<label for="Hindi" class="label check__label checkbox__label text form__text">Hindi</label>
				<br>

				<input type="checkbox" name="languages[]" <?php if (!empty($languages) && in_array("Spanish", $languages)) echo "checked"; ?> value="Spanish" class="input check__input">
				<label for="Spanish" class="label check__label checkbox__label text form__text">Spanish</label>
				<br>

				<input type="checkbox" name="languages[]" <?php if (!empty($languages) && in_array("Russian", $languages)) echo "checked"; ?> value="Russian" class="input check__input">
				<label for="Russian" class="label check__label checkbox__label text form__text">Russian</label>
				<br>

				<input type="checkbox" name="languages[]" <?php if (!empty($languages) && in_array("Other", $languages)) echo "checked"; ?> value="Other" class="input check__input">
				<label for="Other" class="label check__label checkbox__label text form__text">Other</label>
				<br>

			</td>
		</tr>

		<!--<tr>
			<th><label for="another_options">Other languages</label></th>
			<td>
				<input type="text" name="another_options" id="another_options" value="<?php echo $user_additional_data->another_options; ?>" class="regular-text" /><br />
			</td>
		</tr>-->

		<tr>
			<th><label for="experience">Experience</label></th>
			<td>
				<input type="text" name="experience" id="experience" value="<?php echo $user_additional_data->experience; ?>" class="regular-text" /><br />
			</td>
		</tr>

		<tr>
			<th><label for="specialization">Specialization</label></th>
			<td>
				<?php
					$specialization =  unserialize($user_additional_data->specialization);
					?>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("special_addictions", $specialization)) echo "checked"; ?> value="Addictions" class="input check__input">
				<label for="special_addictions" class="label check__label checkbox__label text form__text">Addictions</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Depression", $specialization)) echo "checked"; ?> value="Depression" class="input check__input">
				<label for="depression" class="label check__label checkbox__label text form__text">Depression</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Parenting", $specialization)) echo "checked"; ?> value="Parenting" class="input check__input">
				<label for="parenting" class="label check__label checkbox__label text form__text">Parenting</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("ADHD & Attention Issues", $specialization)) echo "checked"; ?> value="ADHD & Attention Issues" class="input check__input">
				<label for="adhd" class="label check__label checkbox__label text form__text">ADHD & Attention Issues</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Divorce", $specialization)) echo "checked"; ?> value="Divorce" class="input check__input">
				<label for="divorce" class="label check__label checkbox__label text form__text">Divorce</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Phobias", $specialization)) echo "checked"; ?> value="Phobias" class="input check__input">
				<label for="phobias" class="label check__label checkbox__label text form__text">Phobias</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Adoption", $specialization)) echo "checked"; ?> value="Adoption" class="input check__input">
				<label for="adoption" class="label check__label checkbox__label text form__text">Adoption</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Domestic Violence", $specialization)) echo "checked"; ?> value="Domestic Violence" class="input check__input">
				<label for="domestic_violence" class="label check__label checkbox__label text form__text">Domestic Violence</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Postnatal Depression", $specialization)) echo "checked"; ?> value="Postnatal Depression" class="input check__input">
				<label for="postnatal_depression" class="label check__label checkbox__label text form__text">Postnatal Depression</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Agoraphobia", $specialization)) echo "checked"; ?> value="Agoraphobia" class="input check__input">
				<label for="agoraphobia" class="label check__label checkbox__label text form__text">Agoraphobia</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Eating & Food Disorders", $specialization)) echo "checked"; ?> value="Eating & Food Disorders" class="input check__input">
				<label for="eating_food" class="label check__label checkbox__label text form__text">Eating & Food Disorders</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Procrastination", $specialization)) echo "checked"; ?> value="Procrastination" class="input check__input">
				<label for="procrastination" class="label check__label checkbox__label text form__text">Procrastination</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Alzheimers", $specialization)) echo "checked"; ?> value="Alzheimers" class="input check__input">
				<label for="alzheimer" class="label check__label checkbox__label text form__text">Alzheimer's</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Family Issues", $specialization)) echo "checked"; ?> value="Family Issues" class="input check__input">
				<label for="family_issue" class="label check__label checkbox__label text form__text">Family Issues</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("PTSD", $specialization)) echo "checked"; ?> value="PTSD" class="input check__input">
				<label for="ptsd" class="label check__label checkbox__label text form__text">PTSD</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Anger Management", $specialization)) echo "checked"; ?> value="Anger Management" class="input check__input">
				<label for="anger_management" class="label check__label checkbox__label text form__text">Anger Management</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("gad", $specialization)) echo "checked"; ?> value="GAD" class="input check__input">
				<label for="gad" class="label check__label checkbox__label text form__text">GAD</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Relationship Issues", $specialization)) echo "checked"; ?> value="Relationship Issues" class="input check__input">
				<label for="relationship_issues" class="label check__label checkbox__label text form__text">Relationship Issues</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Anxiety", $specialization)) echo "checked"; ?> value="Anxiety" class="input check__input">
				<label for="anxiety" class="label check__label checkbox__label text form__text">Anxiety</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Grief", $specialization)) echo "checked"; ?> value="Grief" class="input check__input">
				<label for="grief" class="label check__label checkbox__label text form__text">Grief</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Self Esteem", $specialization)) echo "checked"; ?> value="Self Esteem" class="input check__input">
				<label for="self_esteem" class="label check__label checkbox__label text form__text">Self Esteem</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Aspergers Syndrome", $specialization)) echo "checked"; ?> value="Aspergers Syndrome" class="input check__input">
				<label for="asperger_syndrome" class="label check__label checkbox__label text form__text">Asperger's Syndrome</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Health Anxiety", $specialization)) echo "checked"; ?> value="Health Anxiety" class="input check__input">
				<label for="helth_anxiety" class="label check__label checkbox__label text form__text">Health Anxiety</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Sex & Sexuality", $specialization)) echo "checked"; ?> value="Sex & Sexuality" class="input check__input">
				<label for="sex_sexuality" class="label check__label checkbox__label text form__text">Sex & Sexuality</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Autism", $specialization)) echo "checked"; ?> value="Autism" class="input check__input">
				<label for="autism" class="label check__label checkbox__label text form__text">Autism</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Infertility", $specialization)) echo "checked"; ?> value="Infertility" class="input check__input">
				<label for="infertility" class="label check__label checkbox__label text form__text">Infertility</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Sleep or Insomnia", $specialization)) echo "checked"; ?> value="Sleep or Insomnia" class="input check__input">
				<label for="sleep_or_insomnia" class="label check__label checkbox__label text form__text">Sleep or Insomnia</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Bipolar Disorder", $specialization)) echo "checked"; ?> value="Bipolar Disorder" class="input check__input">
				<label for="bipolar_disorder" class="label check__label checkbox__label text form__text">Bipolar Disorder</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Intimacy", $specialization)) echo "checked"; ?> value="Intimacy" class="input check__input">
				<label for="intimacy" class="label check__label checkbox__label text form__text">Intimacy</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Social Anxiety", $specialization)) echo "checked"; ?> value="Social Anxiety" class="input check__input">
				<label for="social_anxiety" class="label check__label checkbox__label text form__text">Social Anxiety</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Borderline Personality", $specialization)) echo "checked"; ?> value="Borderline Personality" class="input check__input">
				<label for="boederline_personality" class="label check__label checkbox__label text form__text">Borderline Personality</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("LGBTQ", $specialization)) echo "checked"; ?> value="LGBTQ" class="input check__input">
				<label for="lgbtq" class="label check__label checkbox__label text form__text">LGBTQ</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Speech Anxiety", $specialization)) echo "checked"; ?> value="Speech Anxiety" class="input check__input">
				<label for="speech_anxiety" class="label check__label checkbox__label text form__text">Speech Anxiety</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Career Difficulties", $specialization)) echo "checked"; ?> value="Career Difficulties" class="input check__input">
				<label for="career_difficulties" class="label check__label checkbox__label text form__text">Career Difficulties</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Life Changes", $specialization)) echo "checked"; ?> value="Life Changes" class="input check__input">
				<label for="life_changes" class="label check__label checkbox__label text form__text">Life Changes</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Stress", $specialization)) echo "checked"; ?> value="Stress" class="input check__input">
				<label for="stress" class="label check__label checkbox__label text form__text">Stress</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Marriage Issues", $specialization)) echo "checked"; ?> value="Marriage Issues" class="input check__input">
				<label for="marriage_issues" class="label check__label checkbox__label text form__text">Marriage Issues</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Trauma and or Abuse", $specialization)) echo "checked"; ?> value="Trauma and or Abuse" class="input check__input">
				<label for="trauma_abuse" class="label check__label checkbox__label text form__text">Trauma and/or Abuse</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Chronic Pain", $specialization)) echo "checked"; ?> value="Chronic Pain" class="input check__input">
				<label for="chronic_pain" class="label check__label checkbox__label text form__text">Chronic Pain</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("OCD", $specialization)) echo "checked"; ?> value="OCD" class="input check__input">
				<label for="ocd" class="label check__label checkbox__label text form__text">OCD</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Weight Loss", $specialization)) echo "checked"; ?> value="Weight Loss" class="input check__input">
				<label for="weight_loss" class="label check__label checkbox__label text form__text">Weight Loss</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Compassion Fatigue", $specialization)) echo "checked"; ?> value="Compassion Fatigue" class="input check__input">
				<label for="compassion_fatigue" class="label check__label checkbox__label text form__text">Compassion Fatigue</label>
				<br>

				<input type="checkbox" name="specialization[]" <?php if (!empty($specialization) && in_array("Panic Attack", $specialization)) echo "checked"; ?> value="Panic Attack" class="input check__input">
				<label for="panic_attack" class="label check__label checkbox__label text form__text">Panic Attack</label>
				<br>

			</td>
		</tr>

		<tr>
			<th><label for="work_with">I work with</label></th>
			<td>
				<?php
					$work_with =  unserialize($user_additional_data->work_with);
					?>

				<input type="checkbox" name="work_with[]" <?php if (!empty($work_with) && in_array("adults", $work_with)) echo "checked"; ?> value="adults" class="input check__input">
				<label for="adults" class="label check__label checkbox__label text form__text">Adults</label>
				<br>

				<input type="checkbox" name="work_with[]" <?php if (!empty($work_with) && in_array("children", $work_with)) echo "checked"; ?> value="children" class="input check__input">
				<label for="children" class="label check__label checkbox__label text form__text">Children</label>
				<br>

				<input type="checkbox" name="work_with[]" <?php if (!empty($work_with) && in_array("teenagers", $work_with)) echo "checked"; ?> value="teenagers" class="input check__input">
				<label for="teenagers" class="label check__label checkbox__label text form__text">Teenagers</label>
				<br>

				<input type="checkbox" name="work_with[]" <?php if (!empty($work_with) && in_array("couples", $work_with)) echo "checked"; ?> value="couples" class="input check__input">
				<label for="couples" class="label check__label checkbox__label text form__text">Couples</label>
				<br>

				<input type="checkbox" name="work_with[]" <?php if (!empty($work_with) && in_array("families", $work_with)) echo "checked"; ?> value="families" class="input check__input">
				<label for="families" class="label check__label checkbox__label text form__text">Families</label>
				<br>

			</td>
		</tr>

		<tr>
			<th><label for="experience_working">Diplomas and Certificates confirming the training:</label></th>
			<td>
				<?php 
					if($user_additional_data->uploaded_certificates) {
						$all_certificates = explode(",", $user_additional_data->uploaded_certificates);
						foreach($all_certificates as $single_certificates){
				?>
					<a href="<?php echo esc_attr($single_certificates); ?>" target="_blank">
						<?php echo $single_certificates . "<br>"; ?>
					</a>
				<?php } } else { ?>
					There are no certificates for this user
				<?php } ?>
			</td>
		</tr>

		<tr>
			<th><label for="introduction_video">Introduction Video:</label></th>
			<td>
				<?php if($user_additional_data->introduction_video) { ?>
					<a href="<?php echo esc_attr($user_additional_data->introduction_video); ?>" target="_blank">
						Click here to view video
					</a>
			   <?php } else { ?>
					There is no video for this user
				<?php } ?>
			</td>
		</tr>

		<tr>
			<th><label for="break_time">Break time</label></th>
			<td>
				<input type="text" name="break_time" id="break_time" value="<?php echo $user_additional_data->break_time; ?>" class="regular-text" />min<br />
			</td>
		</tr>

		<tr>
			<th><label for="min_session_time">Minimum session time</label></th>
			<td>
				<input type="text" name="min_session_time" id="min_session_time" value="<?php echo $user_additional_data->min_session_time; ?>" class="regular-text" />hr<br />
			</td>
		</tr>

		<tr>
			<th><label for="is_video_public">Video public</label></th>
			<td>
				<input type="checkbox" <?php if ($user_additional_data->is_video_public == '1') {echo "checked"; } ?> value="1" name="is_video_public" class="input check__input"> <br />
			</td>
		</tr>
		<?php } ?>
	</table>
<?php

}

// Then we hook the function to "show_user_profile" and "edit_user_profile"
add_action('show_user_profile', 'therapist_users_fields', 10);
add_action('edit_user_profile', 'therapist_users_fields', 10);

function save_therapist_users_fields($user_id)
{

	if (!current_user_can('edit_user', $user_id))
		return false;

	/*** Check User ID exist in the Therapist Meta Data Table  ****/
	global $wpdb;
	$user_data_exist = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}users_data WHERE user_id = $user_id");

	$user_main_details = get_userdata($user_id);

	$roles = $user_main_details->roles;
   
	if (in_array("therapist", $roles) || in_array("administrator", $roles)){

		$user_data = array(
			'first_name'                => $_POST['first_name'],
			'last_name'                 => $_POST['last_name'],
			'about_myself'              => $_POST['about_myself'],
			'phone'                     => $_POST['phone'],
			'date_of_birth'             => $_POST['date_of_birth'],
			'time_zone'                 => $_POST['time_zone'],
			'accept_privacy_terms'      => $_POST['accept_privacy_terms'],
			'country'                   => $_POST['country'],
		);

		$therapist_data = array(
			'account_status'                => $_POST['account_status'],
			'top_therapists'                => $_POST['top_therapists'],
			'qualification'                 => $_POST['qualification'],
			'specialization'                => serialize($_POST['specialization']),
			'experience'                    => $_POST['experience'],
			'languages'                     => serialize($_POST['languages']),
			'work_with'                     => serialize($_POST['work_with']),
			'phylosophy'                    => $_POST['phylosophy'],
			'main_method'                   => serialize($_POST['main_method']),
			'about_main_method'             => $_POST['about_main_method'],
			'basic_education'               => $_POST['basic_education'],
			'higher_education'              => $_POST['higher_education'],
			'half_rate'                     => $_POST['half_rate'],
			'hourly_rate'                   => $_POST['hourly_rate'],
			'chat_rate'                     => $_POST['chat_rate'],
			'money_back_guarantee'          => $_POST['money_back_guarantee'],
		);

		$therapist_settings = array(
			'break_time'                    => $_POST['break_time'],
			'min_session_time'              => $_POST['min_session_time'],
		);

		if($_POST['is_video_public'] == 1){
			$therapist_data['is_video_public'] = $_POST['is_video_public'];
		} else {
			$therapist_data['is_video_public'] = 0;
		}
		
		$therapist_data_exist = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}therapists_data WHERE therapist_id = $user_id");
		// $therapist_data_exist = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}therapists_data WHERE therapist_id = $user_id");
		
		$upload_overrides = array('test_form' => false);
		if ($_FILES["prfilePic"]["name"]) {
			$_FILES["prfilePic"]["name"] = rand(9999, 9999999999999) . '_' . basename($_FILES["prfilePic"]["name"]);
			$fileResp = wp_handle_upload($_FILES["prfilePic"], $upload_overrides);
			if (!empty($fileResp)) {
				$user_data['user_profile_pic'] = $fileResp['url'];
			}
		}
		if ($user_data_exist && $therapist_data_exist) {
			if($_POST['account_status'] == 'verified' && $therapist_data_exist->account_status != 'verified'){
				global $rlgh_data;

				$headers = array(
					'From: RealGoodHelp Admin <' . SMTP_FROM . '>',
					'content-type: text/html'
				);
				
				$message = str_replace(
					'tar_id=""',
					'id="' . $user_id . '"',
					$rlgh_data['therapist_welcome_text']
				);  

				$mailBody = email_template(
					$rlgh_data['therapist_welcome_title'],
					$message,
					$rlgh_data['therapist_welcome_image']['url']
				);
			
				wp_mail( $user_main_details->user_email, $rlgh_data['therapist_welcome_title'], $mailBody, $headers );
				

			} else if($_POST['account_status'] == 'declined' && $therapist_data_exist->account_status != 'declined'){
				
				$to = $_POST['email'];
				$subject = "Account Decline";
				$headers = array(
					'From: RealGoodHelp Admin <' . SMTP_FROM . '>',
					'content-type: text/html'
				);

				$message = "Dear ". $user_main_details->first_name .", <br><br> We are are feeling bad to inform you that your account has been declined.";

				wp_mail($user_main_details->user_email, $subject, $message, $headers);
			}
				
			$wpdb->update($wpdb->prefix . "users_data", $user_data, array('user_id' => $user_id));
			$wpdb->update($wpdb->prefix . "therapists_data", $therapist_data, array('therapist_id' => $user_id));
			$wpdb->update($wpdb->prefix . "therapists_settings", $therapist_settings, array('therapist_id' => $user_id));
		} else {
			$user_data['user_id'] = $user_id;
			$therapist_data['therapist_id'] = $user_id;
			$therapist_settings['therapist_id'] = $user_id;
			$wpdb->insert($wpdb->prefix . "users_data", $user_data);
			$wpdb->insert($wpdb->prefix . 'users_settings', array('user_id' => $user_id));
			$wpdb->insert($wpdb->prefix . "therapists_data", $therapist_data);
			$wpdb->insert($wpdb->prefix . "therapists_settings", $therapist_settings);
		}
	}
	else{
		$user_data = array(
			'first_name'                => $_POST['first_name'],
			'last_name'                 => $_POST['last_name'],
			'phone'                     => $_POST['phone'],
			'date_of_birth'             => $_POST['date_of_birth'],
			'time_zone'                 => $_POST['time_zone'],
			'accept_privacy_terms'      => $_POST['accept_privacy_terms'],
			'country'                   => $_POST['country'],
		);

		$upload_overrides = array('test_form' => false);
		if ($_FILES["prfilePic"]["name"]) {
			$_FILES["prfilePic"]["name"] = rand(9999, 9999999999999) . '_' . basename($_FILES["prfilePic"]["name"]);
			$fileResp = wp_handle_upload($_FILES["prfilePic"], $upload_overrides);
			if (!empty($fileResp)) {
				$user_data['user_profile_pic'] = $fileResp['url'];
			}
		}
		if ($user_data_exist) {
			$wpdb->update($wpdb->prefix . "users_data", $user_data, array('user_id' => $user_id));

		} else{
			$user_data['user_id'] = $user_id;
			$wpdb->insert($wpdb->prefix . "users_data", $user_data);
			$wpdb->insert($wpdb->prefix . 'users_settings', array('user_id' => $user_id));
		}
	}
}

add_action('personal_options_update', 'save_therapist_users_fields');
add_action('edit_user_profile_update', 'save_therapist_users_fields');



function registerStepsWizardFrom()
{  
	if(isset($_POST['action'])){
		global $wpdb;
		$response = array();
		$userMetaArray = array();
		$upload_overrides = array('test_form' => false);

		$users_table = $wpdb->prefix . "users";
		$email = $_POST['email'];

		$user_by_email = $wpdb->get_row( "SELECT * FROM $users_table WHERE user_email = '$email'");

		if($user_by_email){
			$user_id = $user_by_email->ID;
		} else {
			if($email){
				$userdata = array(
					'user_login' => $_POST['fname'] . '_' . $_POST['lname'] . '_' . bin2hex(random_bytes(5)),
					'user_pass'  => $_POST['password'],
					'user_email' => $_POST['email'],
					'first_name' => $_POST['fname'],
					'last_name'  => $_POST['lname'],
					'role'       => 'therapist'
				);
		
				$user_id = wp_insert_user($userdata);
			} else {
				$response['error'] = "Data is not correct!!";
				echo json_encode($response);
				die;
			}
		}

		if($_POST['step'] == 1){

			if (!is_wp_error($user_id)) {

				// if($user_by_email){
				//     update_user_meta($user_id, "first_name", $_POST['fname']);
				//     update_user_meta($user_id, "last_name", $_POST['lname']);
				// }

				$user_data = array(
					'first_name'                => $_POST['fname'],
					'last_name'                 => $_POST['lname'],
					'phone'                     => $_POST['phone'],
					'date_of_birth'             => $_POST['dob'],
					'time_zone'                 => $_POST['time_zone'],
					'country'                   => $_POST['country'],
				);

				$userMetaArray = array(
					'qualification'             =>  $_POST['qualification'],
				);
				
				if ($_FILES["prfilePic"]["name"]) {
					$allowed_profile = array('image/jpeg','image/png');
					$profile_pic = 5242880;
					if( ! in_array( $_FILES["prfilePic"]["type"], $allowed_profile ) ) {
						$response['error'] = "Please change the profile picture format you added";
						echo json_encode($response);
						die;
					}  else if($_FILES['prfilePic']['size'] > $profile_pic ){
						$response['error'] = "Profile Picture size is too big. Please upload less then 5MB";
						echo json_encode($response);
						die;
					} else{
						$_FILES["prfilePic"]["name"] = rand(9999, 9999999999999) . '_' . basename($_FILES["prfilePic"]["name"]);
						$fileResp = wp_handle_upload($_FILES["prfilePic"], $upload_overrides);
						if (!empty($fileResp)) {
							$user_data['user_profile_pic'] = $fileResp['url'];
						}
					}
				}
			}
		} else if($_POST['step'] == 2){
			if (!is_wp_error($user_id)) {
				$user_data = array(
					'user_id'                   =>  $user_id,
					'about_myself'              =>  $_POST['psychologist'],
				);

				if($_POST['phylosophy']){
					$userMetaArray['phylosophy'] = $_POST['phylosophy'];
				}
			}
		} else if($_POST['step'] == 3){
			if (!is_wp_error($user_id)) {

				$user_data = array(
					'user_id'                   =>  $user_id,
				);

				$userMetaArray = array(
					'higher_education'          =>  $_POST['higher_education'],
					'main_method'               =>  serialize($_POST['main_method']),
					'basic_education'           =>  $_POST['basic_education'],
					'about_main_method'         =>  $_POST['about_main_method'],
					'languages'                 =>  serialize($_POST['languages']),
				);

				if (!empty($_FILES["certificates"]["name"])) {
					$certificates_array = [];
					foreach($_FILES['certificates']['name'] as $key => $single_certificate){
						if($single_certificate){
							$allowed_certificates = array('image/jpeg','image/png','application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/pdf');
							$image_size = 5242880;
							if( ! in_array($_FILES['certificates']['type'][$key], $allowed_certificates ) ) {
								$response['error'] = "Please change the certificate format you added";
								echo json_encode($response);
								die;
							} else if($_FILES['certificates']['size'][$key] > $image_size ){
								$response['error'] = "Certificate size is too big. Please upload less then 7MB";
								echo json_encode($response);
								die;
							} else{
								$_FILES['certificates']['name'][$key] = rand(9999, 9999999999999) . '_' . basename($single_certificate);
								$new_array = array(
												"name" => $_FILES['certificates']['name'][$key], 
												"type" => $_FILES['certificates']['type'][$key],
												"tmp_name" => $_FILES['certificates']['tmp_name'][$key],
												"error" => $_FILES['certificates']['error'][$key],
												"size" => $_FILES['certificates']['size'][$key],
											);
								$fileResp = wp_handle_upload($new_array, $upload_overrides);
								if (!empty($fileResp)) {
									$certificates_array[] = $fileResp['url'];
								}
							}
						}
					} 
				}

				if($certificates_array){
					$userMetaArray['uploaded_certificates'] = implode(",",$certificates_array);
				}
			}  
		} else if($_POST['step'] == 4){
			if (!is_wp_error($user_id)) {

				$user_data = array(
					'user_id'                   =>  $user_id,
				);

				$userMetaArray = array(
					'experience'                =>  $_POST['constYears'],
					'specialization'            =>  serialize($_POST['specialization']),
					'work_with'                 =>  serialize($_POST['work_with']),
				);
			}
		} else if($_POST['step'] == 5){
			if (!is_wp_error($user_id)) {

				$user_data = array(
					'user_id'                   =>  $user_id,
					'accept_privacy_terms'      =>  $_POST['confirm']
				);

				if($_POST['warning'] == 1){
					$userMetaArray['is_video_public']  =  $_POST['warning'];
				} else {
					$userMetaArray['is_video_public'] = 0;
				}

				if ($_FILES["intro_video"]["name"]) {
					$allowed_videos = array('video/mp4','video/x-m4v','video/quicktime');
					$video_size = 104857600;
					if( ! in_array( $_FILES['intro_video']['type'], $allowed_videos ) ) {
						$response['error'] = "Please change the video format you added";
						echo json_encode($response);
						die;
					} else if($_FILES['intro_video']['size'] > $video_size ){
						$response['error'] = "Video size is too big. Please upload less then 100MB";
						echo json_encode($response);
						die;
					} else{
						$_FILES["intro_video"]["name"] = rand(99999, 9999999999999) . '_' . basename($_FILES["intro_video"]["name"]);
						$fileResp = wp_handle_upload($_FILES["intro_video"], $upload_overrides);
						if (!empty($fileResp)) {
							$userMetaArray['introduction_video'] = $fileResp['url'];
						}
					}
				}
			}
		}
		
		if(!empty($userMetaArray) && !is_wp_error($user_id)){
			$user_meta_by_id = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}users_data a JOIN {$wpdb->prefix}therapists_data b ON a.user_id = b.therapist_id WHERE user_id = $user_id");
			if($user_meta_by_id){
				$wpdb->update($wpdb->prefix . "users_data", $user_data, array('user_id' => $user_id));
				$wpdb->update($wpdb->prefix . "therapists_data", $userMetaArray, array('therapist_id' => $user_id));
	   
				if($_POST['step'] == 5){
					$to = 'support@realgoodhelp.com';
					$subject = "New User Registration Notification!";
					$headers = array("From: New User Registration Notification! <" . SMTP_FROM . ">", "Content-Type: text/html; charset=UTF-8");
					$message = "Hello Support, <br><br> New user register with email " . $email . " and pending for admin review. <br> Please click on the link to review the account <a href='". get_home_url() ."/wp-admin/user-edit.php?user_id=". $user_id ."&wp_http_referer=%2Frealgh%2Fwp-admin%2Fusers.php'>Review Account</a> <br> <br> Thanks";
			
					//Here put your Validation and send mail
					wp_mail($to, $subject, $message, $headers);
			
					global $rlgh_data;
			
					$headers = array(
						'From: RealGoodHelp Admin <' . SMTP_FROM . '>',
						'content-type: text/html'
					);
					
					$message = str_replace(
						'tar_id=""',
						'id="' . $user_id . '"',
						$rlgh_data['therapist_regist_text']
					);  
			
					$mailBody = email_template(
						$rlgh_data['therapist_regist_title'],
						$message,
						$rlgh_data['therapist_regist_image']['url']
					);
				
					wp_mail( $email, $rlgh_data['therapist_regist_title'], $mailBody, $headers );
				}
			} else{
				// $wpdb->insert($table_name, $userMetaArray);
				$user_data['user_id'] = $user_id;
				$userMetaArray['therapist_id'] = $user_id;
				$wpdb->insert($wpdb->prefix . "users_data", $user_data);
				$wpdb->insert($wpdb->prefix . 'users_settings', array('user_id' => $user_id));
				$wpdb->insert($wpdb->prefix . "therapists_data", $userMetaArray);
				$wpdb->insert($wpdb->prefix . "therapists_settings", array('therapist_id' => $user_id));

			}
			 
			if($wpdb->last_error){
				error_log($wpdb->last_error);
				error_log($wpdb->last_query);
			}
		
			$response['success'] = "Success";
			echo json_encode($response);
		}
	} else {
		$response['error'] = "No Data Found";
		echo json_encode($response); 
	}
	die();
}

add_action('wp_ajax_registerStepsWizardFrom', 'registerStepsWizardFrom');
add_action('wp_ajax_nopriv_registerStepsWizardFrom', 'registerStepsWizardFrom');

function manualUserLogin()
{
	$params = array();
	parse_str($_POST['data'], $params);

	$info = array();
	$info['user_login'] = $params['email'];
	$info['user_password'] = $params['password'];
	$info['remember'] = true;

	$user_signon = wp_signon($info, false);
	if (is_wp_error($user_signon)) {
		echo json_encode(array('loggedin' => false, 'message' => __('Wrong username or password.')));
	} else {
		$user_role = $user_signon->roles;
		if(in_array("client", $user_role)){
			$redirect_url = '/therapy-and-coaching';
		} else {
			$redirect_url = '/dashboard';
		}

		echo json_encode(array('loggedin' => true, 'message' => __('Login successful'), 'redirect_url' => $redirect_url));
	}

	die();
}

add_action('wp_ajax_manualUserLogin', 'manualUserLogin');
add_action('wp_ajax_nopriv_manualUserLogin', 'manualUserLogin');

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar()
{
	if (!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
}

add_action('nsl_register_new_user', function ($user_id) {
	//if (NextendSocialLogin::getTrackerData() == "registered_from") {
	$user = new WP_User($user_id);

	if (isset($_COOKIE["userType"])) {
		if ($_COOKIE["userType"] == 'psycho') {
			$user->remove_role('client');
			$user->add_role('therapist');
		}
	}
	//}
});

add_action('template_redirect', 'redirect_to_home_page');
function redirect_to_home_page()
{
	$current_user = wp_get_current_user();
	$roles = $current_user->roles;

	if (is_page('dashboard') || is_page('edit-account') ) {
		if (!is_user_logged_in()) {
			wp_redirect(home_url());
			exit;
		}
	}

	if(is_page('therapist-schedule') || is_page('edit-schedule') ){
		if (in_array("client", $roles)) {
			wp_redirect(home_url());
			exit;
		} else if(!is_user_logged_in()){
			wp_redirect(home_url());
			exit;
		}
	}

	if(is_page('booking')){
		if (in_array("therapist", $roles)) {
			wp_redirect(home_url());
			exit;
		} //else if(!is_user_logged_in()){
		//     wp_redirect(home_url());
		//     exit;
		// }
	}

	if(is_page('therapists-registration')){
		if (is_user_logged_in()) {
			wp_redirect(home_url());
			exit;
		} 
	}
	
}

function edit_client_user_info($current_user)
{
	$userdata = array(
		'ID' => $current_user->ID,
		'first_name' => $_POST['fname'],
		'last_name' => $_POST['lname']
	);

	if ($_POST['password'] !== "" && $_POST['password']) {
		if($_POST['password'] == $_POST['confirm_password']){
			$userdata['user_pass'] = $_POST['password'];
		} else{
			$response['error'] = "Passwords do not match";
			return $response;
		}
	}

	$upload_overrides = array('test_form' => false);

	$userMetaArray = array(
		'first_name'                =>  $_POST['fname'],
		'last_name'                 =>  $_POST['lname'],
		'phone'                     =>  $_POST['phone'],
		'date_of_birth'             =>  $_POST['dob'],
		'time_zone'                 =>  $_POST['time_zone'],
		'country'                   =>  $_POST['country'],
		'accept_privacy_terms'      =>  $_POST['confirm'],
	);

	if ($_FILES["prfilePic"]["name"]) {
		$allowed_profile = array('image/jpeg','image/png');
		$profile_pic = 5242880;
		if( ! in_array( $_FILES["prfilePic"]["type"], $allowed_profile ) ) {
			$response['error'] = "Please change the profile picture format you added";
			return $response;
		}  else if($_FILES['prfilePic']['size'] > $profile_pic ){
			$response['error'] = "Profile Picture size is too big. Please upload less then 5MB";
			return $response;
		} else{
			$_FILES["prfilePic"]["name"] = rand(9999, 9999999999999) . '_' . basename($_FILES["prfilePic"]["name"]);
			$fileResp = wp_handle_upload($_FILES["prfilePic"], $upload_overrides);
			if (!empty($fileResp)) {
				$userMetaArray['user_profile_pic'] = $fileResp['url'];
			}
		}
	}

	$user_id = wp_update_user($userdata);
	$response = array();

	if (!is_wp_error($user_id)) {
		global $wpdb;
		$table_name = $wpdb->prefix . "users_data";
		$user_data_exist  = $wpdb->get_row("SELECT * FROM $table_name WHERE user_id = $user_id");
		if ($user_data_exist) {
			$wpdb->update($table_name, $userMetaArray, array('user_id' => $user_id));
		} else {
			$userMetaArray['user_id'] = $user_id;
			$wpdb->insert($table_name, $userMetaArray);
		}
		$response['success'] = "Profile updated successfully!";
	} else {
		$response['error'] = $user_id->get_error_message();
	}

	return $response;
}

function edit_pyschologist_user_info($current_user)
{
	$userdata = array(
		'ID' => $current_user->ID,
		'first_name' => $_POST['fname'],
		'last_name' => $_POST['lname']
	);

	if ($_POST['password'] !== "" && $_POST['password']) {
		if($_POST['password'] == $_POST['confirm_password']){
			$userdata['user_pass'] = $_POST['password'];
		} else{
			$response['error'] = "Passwords do not match";
			return $response;
		}
	}

	$upload_overrides = array('test_form' => false);

	$user_data = array(
		'first_name'                => $_POST['fname'],
		'last_name'                 => $_POST['lname'],
		'about_myself'              => $_POST['about_myself'],
		'phone'                     => $_POST['phone'],
		'date_of_birth'             => $_POST['dob'],
		'time_zone'                 => $_POST['time_zone'],
		'accept_privacy_terms'      => $_POST['confirm'],
		'country'                   => $_POST['country'],
	);

	$therapist_data = array(
		'specialization'                => serialize($_POST['specialization']),
		'experience'                    => $_POST['constYears'],
		'languages'                     => serialize($_POST['languages']),
		'work_with'                     => serialize($_POST['work_with']),
		'phylosophy'                    => $_POST['phylosophy'],
		'main_method'                   => serialize($_POST['main_method']),
		'about_main_method'             => $_POST['about_main_method'],
		'basic_education'               => $_POST['basic_education'],
		'higher_education'              => $_POST['higher_education'],
		'half_rate'                     => $_POST['half_rate'],
		'hourly_rate'                   => $_POST['hourly_rate'],
		'chat_rate'                     => $_POST['chat_rate'],
	);

	if($_POST['warning'] == 1){
		$therapist_data['is_video_public']  =  $_POST['warning'];
	} else {
		$therapist_data['is_video_public'] = 0;
	}

	if($_POST['money_back_guarantee'] == 1){
		$therapist_data['money_back_guarantee']  =  $_POST['money_back_guarantee'];
	} else {
		$therapist_data['money_back_guarantee'] = 0;
	}

	if ($_FILES["prfilePic"]["name"]) {
		$allowed_profile = array('image/jpeg','image/png');
		$profile_pic = 5242880;
		if( ! in_array( $_FILES["prfilePic"]["type"], $allowed_profile ) ) {
			$response['error'] = "Please change the profile picture format you added";
			return $response;
		} else if($_FILES['prfilePic']['size'] > $profile_pic ){
			$response['error'] = "Profile Picture size is too big. Please upload less then 5MB";
			return $response;
		} else{
			$_FILES["prfilePic"]["name"] = rand(9999, 9999999999999) . '_' . basename($_FILES["prfilePic"]["name"]);
			$fileResp = wp_handle_upload($_FILES["prfilePic"], $upload_overrides);
			if (!empty($fileResp)) {
				$user_data['user_profile_pic'] = $fileResp['url'];
			}
		}
	}

	// if ($_FILES["certificates"]["name"]) {
	//     $_FILES["certificates"]["name"] = rand(99999, 9999999999999) . '_' . basename($_FILES["certificates"]["name"]);
	//     $fileResp = wp_handle_upload($_FILES["certificates"], $upload_overrides);
	//     if (!empty($fileResp)) {
	//         $userMetaArray['uploaded_certificates'] = $fileResp['url'];
	//     }
	// }


	if (!empty($_FILES["certificates"]["name"])) {
		$certificates_array = [];
		foreach($_FILES['certificates']['name'] as $key => $single_certificate){
			if($single_certificate){
				$allowed_certificates = array('image/jpeg','image/png','application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/pdf');
				$image_size = 7340032;
				if( ! in_array($_FILES['certificates']['type'][$key], $allowed_certificates ) ) {
					$response['error'] = "Please change the certificate format you added";
					return $response;
				} else if($_FILES['certificates']['size'][$key] > $image_size ){
					$response['error'] = "Certificate size is too big. Please upload less then 7MB";
					return $response;
				} else{
					$_FILES['certificates']['name'][$key] = rand(9999, 9999999999999) . '_' . basename($single_certificate);
					$new_array = array(
									"name" => $_FILES['certificates']['name'][$key], 
									"type" => $_FILES['certificates']['type'][$key],
									"tmp_name" => $_FILES['certificates']['tmp_name'][$key],
									"error" => $_FILES['certificates']['error'][$key],
									"size" => $_FILES['certificates']['size'][$key],
								);
					$fileResp = wp_handle_upload($new_array, $upload_overrides);
					if (!empty($fileResp)) {
						$certificates_array[] = $fileResp['url'];
					}
				}
			}
		} 
	}

	if(!empty($certificates_array)){
		$therapist_data['uploaded_certificates'] = implode(",",$certificates_array);
	}
	
	if ($_FILES["intro_video"]["name"]) {
		$allowed_videos = array('video/mp4','video/x-m4v','video/quicktime');
		$video_size = 104857600;
		if( ! in_array( $_FILES['intro_video']['type'], $allowed_videos ) ) {
			$response['error'] = "Please change the video format you added";
			return $response;
		} else if($_FILES['intro_video']['size'] > $video_size ){
			$response['error'] = "Video size is too big. Please upload less then 100MB";
			return $response;
		} else{
			$_FILES["intro_video"]["name"] = rand(99999, 9999999999999) . '_' . basename($_FILES["intro_video"]["name"]);
			$fileResp = wp_handle_upload($_FILES["intro_video"], $upload_overrides);
			if (!empty($fileResp)) {
				$therapist_data['introduction_video'] = $fileResp['url'];
			}
		}
	}

	$user_id = wp_update_user($userdata);
	$response = array();
	$send_email = 0;

	if (!is_wp_error($user_id)) {
		global $wpdb;
		$user_data_exist = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}users_data a JOIN {$wpdb->prefix}therapists_data b ON a.user_id = b.therapist_id JOIN {$wpdb->prefix}therapists_settings c ON a.user_id = c.therapist_id WHERE a.user_id = $user_id");
		if ($user_data_exist) {
			if($user_data_exist->accept_privacy_terms == 0){
				$send_email = 1;
			}

			$wpdb->update($wpdb->prefix . "users_data", $user_data, array('user_id' => $user_id));
			$wpdb->update($wpdb->prefix . "therapists_data", $therapist_data, array('therapist_id' => $user_id));

		} else {
			$user_data['user_id'] = $user_id;
			$therapist_data['therapist_id'] = $user_id;
			$insert_data = $wpdb->insert($wpdb->prefix . "users_data", $user_data);
			$wpdb->insert($wpdb->prefix . 'users_settings', array('user_id' => $user_id));
			$insert_data = $wpdb->insert($wpdb->prefix . "therapists_data", $therapist_data);
			$wpdb->insert($wpdb->prefix . "therapists_settings", array('therapist_id' => $user_id));

			if($current_user->user_activation_key && $insert_data){
				$send_email = 1;
			}
		}

		if($send_email == 1){
			$email = $current_user->user_email;
			$to = 'support@realgoodhelp.com';
			$subject = "New User Registration Notification!";
			$headers = array("From: New User Registration Notification! <support@realgoodhelp.com>", "Content-Type: text/html; charset=UTF-8");
			$message = "Hello Support, <br><br> New user register with email " . $email . " and pending for admin review. <br> Please click on the link to review the account <a href='". get_home_url() ."/wp-admin/user-edit.php?user_id=". $user_id ."&wp_http_referer=%2Frealgh%2Fwp-admin%2Fusers.php'>Review Account</a> <br> <br> Thanks";

			//Here put your Validation and send mail
			wp_mail($to, $subject, $message, $headers);

			global $rlgh_data;

			$headers = array(
				'From: RealGoodHelp Admin <' . SMTP_FROM . '>',
				'content-type: text/html'
			);
			
			$message = str_replace(
				'tar_id=""',
				'id="' . $user_id . '"',
				$rlgh_data['therapist_regist_text']
			);  

			$mailBody = email_template(
				$rlgh_data['therapist_regist_title'],
				$message,
				$rlgh_data['therapist_regist_image']['url']
			);
		
			wp_mail( $email, $rlgh_data['therapist_regist_title'], $mailBody, $headers );
		}

		$response['success'] = "Profile updated successfully!";
	} else {
		$response['error'] = $user_id->get_error_message();
	}

	return $response;
}


function session_cancel(){
	
	global $wpdb;
	$table_name = $wpdb->prefix . "sessions";

	$payment_key = $_POST['payment_key'];
	$client_id = $_POST['client_id'];
	$therapist_id = $_POST['therapist_id'];
	$cancelled_by = $_POST['cancelled_by'];

	$session_details = $wpdb->get_row( "SELECT * FROM $table_name WHERE  id = $payment_key");
	$utc_date_time =  gmdate("Y-m-d H:i");

	$session_date = new DateTime($session_details->session_date . ' ' . $session_details->session_start);
	$current_date = new DateTime($utc_date_time);
	$interval= $session_date->diff($current_date);
	$hours_difference = ($interval->days * 24) + $interval->h;

	$client_user_data = get_userdata($client_id);
	$therapist_user_data = get_userdata($therapist_id);

	if($hours_difference > 24){
		$cancel_sessions =  $wpdb->update($table_name, array("session_status" => "cancelled", "cancelled_by" => $cancelled_by . " cancelled more then 24 hours" ), array('id' => $payment_key));
	} else{
		$cancel_sessions =  $wpdb->update($table_name, array("session_status" => "cancelled", "cancelled_by" => $cancelled_by . " cancelled less then 24 hours" ), array('id' => $payment_key));
	}

	$response['success'] = "Successfully Cancelled";
	echo json_encode($response);
   
	if ($cancel_sessions) {
   
		global $rlgh_data;
		$headers = array(
			'From: RealGoodHelp Admin <' . SMTP_FROM . '>',
			'content-type: text/html'
		);

		if($cancelled_by == 'client'){
			if($hours_difference > 24){
				$client_refund_message = str_replace(
					'tar_id=""',
					'id="' . $client_id . '"',
					$rlgh_data['client_cancel_refund_text']
				);  
	
				$client_refund_message = str_replace(
					'cur_id=""',
					'id="' . $therapist_id . '"',
					$client_refund_message
				);  

				$client_refund_message = str_replace(
					'ses_id=""',
					'ses_id="' . $payment_key . '"',
					$client_refund_message
				);
	
				$mailBody = email_template(
					$rlgh_data['client_cancel_refund_title'],
					$client_refund_message,
					$rlgh_data['client_cancel_refund_image']['url']
				);

				$therapist_message = str_replace(
					'tar_id=""',
					'id="' . $therapist_id . '"',
					$rlgh_data['therapist_client_cancel_text']
				);  
	
				$therapist_message = str_replace(
					'cur_id=""',
					'id="' . $client_id . '"',
					$therapist_message
				);  

				$therapist_message = str_replace(
					'ses_id=""',
					'ses_id="' . $payment_key . '"',
					$therapist_message
				);
	
				$therapist_mailBody = email_template(
					$rlgh_data['therapist_client_cancel_title'],
					$therapist_message,
					$rlgh_data['therapist_client_cancel_image']['url']
				);

				wp_mail( $client_user_data->user_email, $rlgh_data['client_cancel_refund_title'], $mailBody, $headers );

				wp_mail( $therapist_user_data->user_email, $rlgh_data['therapist_client_cancel_title'], $therapist_mailBody, $headers );

				$adam_email = 'adam@realgoodhelp.com';
				$adam_subject = "Client Session Refund Notification!";
				$adam_message = "Hello Adam, <br><br> Client (" . $client_user_data->display_name . ") cancelled their appointment with Therapist (" . $therapist_user_data->display_name . ") and a refund of amount " . $session_details->amount_total . " needs to be made. <br> Please click on the link to review the session <a href='". get_home_url() ."/wp-admin/admin.php?page=schedule-session&payment_key=". $payment_key ."'>Review Session</a> <br> <br> Thanks";

				wp_mail($adam_email, $adam_subject, $adam_message, $headers);

			} else {
				
				$client_refund_message = str_replace(
					'tar_id=""',
					'id="' . $client_id . '"',
					$rlgh_data['client_cancel_no_refund_text']
				);  
	
				$client_refund_message = str_replace(
					'cur_id=""',
					'id="' . $therapist_id . '"',
					$client_refund_message
				);  

				$client_refund_message = str_replace(
					'ses_id=""',
					'ses_id="' . $payment_key . '"',
					$client_refund_message
				);
	
				$mailBody = email_template(
					$rlgh_data['client_cancel_no_refund_title'],
					$client_refund_message,
					$rlgh_data['client_cancel_no_refund_image']['url']
				);

				$therapist_message = str_replace(
					'tar_id=""',
					'id="' . $therapist_id . '"',
					$rlgh_data['therapist_late_cancel_text']
				);  
	
				$therapist_message = str_replace(
					'cur_id=""',
					'id="' . $client_id . '"',
					$therapist_message
				);  

				$therapist_message = str_replace(
					'ses_id=""',
					'ses_id="' . $payment_key . '"',
					$therapist_message
				);
	
				$therapist_mailBody = email_template(
					$rlgh_data['therapist_late_cancel_title'],
					$therapist_message,
					$rlgh_data['therapist_late_cancel_image']['url']
				);

				wp_mail( $client_user_data->user_email, $rlgh_data['client_cancel_no_refund_title'], $mailBody, $headers );
				wp_mail( $therapist_user_data->user_email, $rlgh_data['therapist_late_cancel_title'], $therapist_mailBody, $headers );
			}
		} else if($cancelled_by == 'therapist'){
			$client_message = str_replace(
				'tar_id=""',
				'id="' . $client_id . '"',
				$rlgh_data['client_cancel_text']
			);  

			$client_message = str_replace(
				'cur_id=""',
				'id="' . $therapist_id . '"',
				$client_message
			); 

			$client_message = str_replace(
				'ses_id=""',
				'ses_id="' . $payment_key . '"',
				$client_message
			); 

			$mailBody = email_template(
				$rlgh_data['client_cancel_title'],
				$client_message,
				$rlgh_data['client_cancel_image']['url']
			);
		
			wp_mail( $client_user_data->user_email, $rlgh_data['client_cancel_title'], $mailBody, $headers );

			$adam_email = 'adam@realgoodhelp.com';
			$adam_subject = "Client Session Refund Notification!";
			$adam_message = "Hello Adam, <br><br> Therapist (" . $therapist_user_data->display_name . ") cancelled their appointment with Client (" . $client_user_data->display_name . ") and a refund of amount " . $session_details->amount_total . " needs to be made. <br> Please click on the link to review the session <a href='". get_home_url() ."/wp-admin/admin.php?page=schedule-session&payment_key=". $payment_key ."'>Review Session</a> <br> <br> Thanks";

			wp_mail($adam_email, $adam_subject, $adam_message, $headers);
		}
	} 
	die();
}

add_action('wp_ajax_session_cancel', 'session_cancel');
add_action('wp_ajax_nopriv_session_cancel', 'session_cancel');


function change_session_status(){
	global $wpdb;
	$table_name = $wpdb->prefix . "sessions";
	$payment_key = $_POST['payment_key'];
	$session_status = $_POST['session_status'];

	$session_details = $wpdb->get_row( "SELECT * FROM $table_name WHERE  id = $payment_key");

	if($session_details){
		$change_session_status = $wpdb->update($table_name, array("session_status" => $session_status), array('id' => $payment_key));

		if($change_session_status){
			$response['success'] = "Successfully";
	
		} else{
			$response['success'] = "Something went wrong";
		}
	} else{
		$response['success'] = "Session not found";
	}

	echo json_encode($response);
	die;
}

add_action('wp_ajax_change_session_status', 'change_session_status');
add_action('wp_ajax_nopriv_change_session_status', 'change_session_status');

function redeem_promo_code(){

	global $wpdb;
	$table_name = $wpdb->prefix . "coupons";

	if(isset($_POST['coupon_code'])){
		$coupon_code = $_POST['coupon_code'];

		$coupons = $wpdb->get_row("SELECT * FROM $table_name WHERE coupon_code = '$coupon_code'");
		if(!empty($coupons)){
			$response['success'] = "Success";
			$response['data'] = $coupons;
		} else{
			$response['error'] = "Coupon Code doesn't exist";
		}

		echo json_encode($response);
		die;
	} else{
		$response['error'] = "Coupon Code Required";
		echo json_encode($response);
		die;
	}
}

add_action('wp_ajax_redeem_promo_code', 'redeem_promo_code');
add_action('wp_ajax_nopriv_redeem_promo_code', 'redeem_promo_code');

function get_warning_banner($bottom_padding = null){

	global $wpdb;
	$current_user = wp_get_current_user();
	$roles = $current_user->roles;
	$banner_html = '';

	if (is_user_logged_in() && in_array("therapist", $roles)) {
		$user_additional_data = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}users_data a JOIN {$wpdb->prefix}therapists_data b ON a.user_id = b.therapist_id WHERE a.user_id = $current_user->ID");
		if(empty($user_additional_data) || $user_additional_data->accept_privacy_terms == 0){
			$banner_html =  '<section class="warning_section ' . $bottom_padding . '">
			<div class="warning-wrapper">
				<div class="warning-img-content">
					<img src="' . get_template_directory_uri() . '/assets/img/danger.png" alt="">
					<p>"Please complete your profile, so that we can publish your details to clients"</p>
				</div>
				<div class="warning-btn">
					<a href="' . get_home_url() .'/edit-account">Click here</a>
				</div>
			</div>
			</section>';
		}
	}

	return $banner_html;
}

function country_array()
{
	$countryList = array(
		"AF" => "Afghanistan",
		"AL" => "Albania",
		"DZ" => "Algeria",
		"AS" => "American Samoa",
		"AD" => "Andorra",
		"AO" => "Angola",
		"AI" => "Anguilla",
		"AQ" => "Antarctica",
		"AG" => "Antigua and Barbuda",
		"AR" => "Argentina",
		"AM" => "Armenia",
		"AW" => "Aruba",
		"AU" => "Australia",
		"AT" => "Austria",
		"AZ" => "Azerbaijan",
		"BS" => "Bahamas",
		"BH" => "Bahrain",
		"BD" => "Bangladesh",
		"BB" => "Barbados",
		"BY" => "Belarus",
		"BE" => "Belgium",
		"BZ" => "Belize",
		"BJ" => "Benin",
		"BM" => "Bermuda",
		"BT" => "Bhutan",
		"BO" => "Bolivia",
		"BA" => "Bosnia and Herzegovina",
		"BW" => "Botswana",
		"BV" => "Bouvet Island",
		"BR" => "Brazil",
		"BQ" => "British Antarctic Territory",
		"IO" => "British Indian Ocean Territory",
		"VG" => "British Virgin Islands",
		"BN" => "Brunei",
		"BG" => "Bulgaria",
		"BF" => "Burkina Faso",
		"BI" => "Burundi",
		"KH" => "Cambodia",
		"CM" => "Cameroon",
		"CA" => "Canada",
		"CT" => "Canton and Enderbury Islands",
		"CV" => "Cape Verde",
		"KY" => "Cayman Islands",
		"CF" => "Central African Republic",
		"TD" => "Chad",
		"CL" => "Chile",
		"CN" => "China",
		"CX" => "Christmas Island",
		"CC" => "Cocos [Keeling] Islands",
		"CO" => "Colombia",
		"KM" => "Comoros",
		"CG" => "Congo - Brazzaville",
		"CD" => "Congo - Kinshasa",
		"CK" => "Cook Islands",
		"CR" => "Costa Rica",
		"HR" => "Croatia",
		"CU" => "Cuba",
		"CY" => "Cyprus",
		"CZ" => "Czech Republic",
		"CI" => "Côte d’Ivoire",
		"DK" => "Denmark",
		"DJ" => "Djibouti",
		"DM" => "Dominica",
		"DO" => "Dominican Republic",
		"NQ" => "Dronning Maud Land",
		"DD" => "East Germany",
		"EC" => "Ecuador",
		"EG" => "Egypt",
		"SV" => "El Salvador",
		"GQ" => "Equatorial Guinea",
		"ER" => "Eritrea",
		"EE" => "Estonia",
		"ET" => "Ethiopia",
		"FK" => "Falkland Islands",
		"FO" => "Faroe Islands",
		"FJ" => "Fiji",
		"FI" => "Finland",
		"FR" => "France",
		"GF" => "French Guiana",
		"PF" => "French Polynesia",
		"TF" => "French Southern Territories",
		"FQ" => "French Southern and Antarctic Territories",
		"GA" => "Gabon",
		"GM" => "Gambia",
		"GE" => "Georgia",
		"DE" => "Germany",
		"GH" => "Ghana",
		"GI" => "Gibraltar",
		"GR" => "Greece",
		"GL" => "Greenland",
		"GD" => "Grenada",
		"GP" => "Guadeloupe",
		"GU" => "Guam",
		"GT" => "Guatemala",
		"GG" => "Guernsey",
		"GN" => "Guinea",
		"GW" => "Guinea-Bissau",
		"GY" => "Guyana",
		"HT" => "Haiti",
		"HM" => "Heard Island and McDonald Islands",
		"HN" => "Honduras",
		"HK" => "Hong Kong SAR China",
		"HU" => "Hungary",
		"IS" => "Iceland",
		"IN" => "India",
		"ID" => "Indonesia",
		"IR" => "Iran",
		"IQ" => "Iraq",
		"IE" => "Ireland",
		"IM" => "Isle of Man",
		"IL" => "Israel",
		"IT" => "Italy",
		"JM" => "Jamaica",
		"JP" => "Japan",
		"JE" => "Jersey",
		"JT" => "Johnston Island",
		"JO" => "Jordan",
		"KZ" => "Kazakhstan",
		"KE" => "Kenya",
		"KI" => "Kiribati",
		"KW" => "Kuwait",
		"KG" => "Kyrgyzstan",
		"LA" => "Laos",
		"LV" => "Latvia",
		"LB" => "Lebanon",
		"LS" => "Lesotho",
		"LR" => "Liberia",
		"LY" => "Libya",
		"LI" => "Liechtenstein",
		"LT" => "Lithuania",
		"LU" => "Luxembourg",
		"MO" => "Macau SAR China",
		"MK" => "Macedonia",
		"MG" => "Madagascar",
		"MW" => "Malawi",
		"MY" => "Malaysia",
		"MV" => "Maldives",
		"ML" => "Mali",
		"MT" => "Malta",
		"MH" => "Marshall Islands",
		"MQ" => "Martinique",
		"MR" => "Mauritania",
		"MU" => "Mauritius",
		"YT" => "Mayotte",
		"FX" => "Metropolitan France",
		"MX" => "Mexico",
		"FM" => "Micronesia",
		"MI" => "Midway Islands",
		"MD" => "Moldova",
		"MC" => "Monaco",
		"MN" => "Mongolia",
		"ME" => "Montenegro",
		"MS" => "Montserrat",
		"MA" => "Morocco",
		"MZ" => "Mozambique",
		"MM" => "Myanmar [Burma]",
		"NA" => "Namibia",
		"NR" => "Nauru",
		"NP" => "Nepal",
		"NL" => "Netherlands",
		"AN" => "Netherlands Antilles",
		"NT" => "Neutral Zone",
		"NC" => "New Caledonia",
		"NZ" => "New Zealand",
		"NI" => "Nicaragua",
		"NE" => "Niger",
		"NG" => "Nigeria",
		"NU" => "Niue",
		"NF" => "Norfolk Island",
		"KP" => "North Korea",
		"VD" => "North Vietnam",
		"MP" => "Northern Mariana Islands",
		"NO" => "Norway",
		"OM" => "Oman",
		"PC" => "Pacific Islands Trust Territory",
		"PK" => "Pakistan",
		"PW" => "Palau",
		"PS" => "Palestinian Territories",
		"PA" => "Panama",
		"PZ" => "Panama Canal Zone",
		"PG" => "Papua New Guinea",
		"PY" => "Paraguay",
		"YD" => "People's Democratic Republic of Yemen",
		"PE" => "Peru",
		"PH" => "Philippines",
		"PN" => "Pitcairn Islands",
		"PL" => "Poland",
		"PT" => "Portugal",
		"PR" => "Puerto Rico",
		"QA" => "Qatar",
		"RO" => "Romania",
		"RU" => "Russia",
		"RW" => "Rwanda",
		"RE" => "Réunion",
		"BL" => "Saint Barthélemy",
		"SH" => "Saint Helena",
		"KN" => "Saint Kitts and Nevis",
		"LC" => "Saint Lucia",
		"MF" => "Saint Martin",
		"PM" => "Saint Pierre and Miquelon",
		"VC" => "Saint Vincent and the Grenadines",
		"WS" => "Samoa",
		"SM" => "San Marino",
		"SA" => "Saudi Arabia",
		"SN" => "Senegal",
		"RS" => "Serbia",
		"CS" => "Serbia and Montenegro",
		"SC" => "Seychelles",
		"SL" => "Sierra Leone",
		"SG" => "Singapore",
		"SK" => "Slovakia",
		"SI" => "Slovenia",
		"SB" => "Solomon Islands",
		"SO" => "Somalia",
		"ZA" => "South Africa",
		"GS" => "South Georgia and the South Sandwich Islands",
		"KR" => "South Korea",
		"ES" => "Spain",
		"LK" => "Sri Lanka",
		"SD" => "Sudan",
		"SR" => "Suriname",
		"SJ" => "Svalbard and Jan Mayen",
		"SZ" => "Swaziland",
		"SE" => "Sweden",
		"CH" => "Switzerland",
		"SY" => "Syria",
		"ST" => "São Tomé and Príncipe",
		"TW" => "Taiwan",
		"TJ" => "Tajikistan",
		"TZ" => "Tanzania",
		"TH" => "Thailand",
		"TL" => "Timor-Leste",
		"TG" => "Togo",
		"TK" => "Tokelau",
		"TO" => "Tonga",
		"TT" => "Trinidad and Tobago",
		"TN" => "Tunisia",
		"TR" => "Turkey",
		"TM" => "Turkmenistan",
		"TC" => "Turks and Caicos Islands",
		"TV" => "Tuvalu",
		"UM" => "U.S. Minor Outlying Islands",
		"PU" => "U.S. Miscellaneous Pacific Islands",
		"VI" => "U.S. Virgin Islands",
		"UG" => "Uganda",
		"UA" => "Ukraine",
		"SU" => "Union of Soviet Socialist Republics",
		"AE" => "United Arab Emirates",
		"GB" => "United Kingdom",
		"US" => "United States",
		"ZZ" => "Unknown or Invalid Region",
		"UY" => "Uruguay",
		"UZ" => "Uzbekistan",
		"VU" => "Vanuatu",
		"VA" => "Vatican City",
		"VE" => "Venezuela",
		"VN" => "Vietnam",
		"WK" => "Wake Island",
		"WF" => "Wallis and Futuna",
		"EH" => "Western Sahara",
		"YE" => "Yemen",
		"ZM" => "Zambia",
		"ZW" => "Zimbabwe",
		"AX" => "Åland Islands"

	);

	return $countryList;
}


function checkEmailExist(){
	$response = array();
	$email = $_POST['email'];

	// do check
	if ( email_exists( $email ) ) {
		$response['result'] = true;
	} else {
		$response['result'] = false;
	}

	// echo json
	echo json_encode( $response );
	die();
}
add_action('wp_ajax_checkEmailExist', 'checkEmailExist');
add_action('wp_ajax_nopriv_checkEmailExist', 'checkEmailExist');



function zaCreateSessionStripe()
{
    global $wpdb;

    $params = $_POST['data'];
    
    $stripe_api_secret = get_option('stripe_api_secret');
    $current_user = wp_get_current_user();

    $amount_paid = $params['price'];

    if($amount_paid > 0){
        $session_data = array(
            "mode"              => "payment",
            "success_url"       =>  home_url() . "/thank-you/?payment_key={CHECKOUT_SESSION_ID}",
            "cancel_url"        =>  home_url(),
            "currency"          => "usd",
            "customer_email"    => $current_user->user_email,
            "line_items"        => array(
                array(
                    "price_data" => array(
                        "unit_amount"   => $amount_paid * 100,
                        "currency"      => "usd",
                        "product_data"  => array(
                            "name"          => " Payment Details",
                            "description"   => $params['payment_details_text']
                        )
                    ),
                    "quantity" => 1
                ),
            ),
            "payment_method_types" => array("card"),
        );


        $url_encode_data = http_build_query($session_data);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.stripe.com/v1/checkout/sessions',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $url_encode_data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Bearer ' . $stripe_api_secret
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
    } else{
        $rand_sesion_id = rand();
        $rand_sesion_id = md5($rand_sesion_id);
        $response = json_encode(array("url" => home_url() . "/thank-you/?payment_key=" . $rand_sesion_id . "&rand=" . $rand_sesion_id));
    }

    if ($response) {
        $json_decode_response = json_decode($response);
        if (isset($json_decode_response->error)) {
            echo json_encode(array("success" => false, "message" => $json_decode_response->error->message));
        } else {
            echo json_encode(array("success" => true, "message" => $json_decode_response->url));
        }
    }

    die;
}

add_action('wp_ajax_zaCreateSessionStripe', 'zaCreateSessionStripe');
add_action('wp_ajax_zaCreateSessionStripe', 'zaCreateSessionStripe');