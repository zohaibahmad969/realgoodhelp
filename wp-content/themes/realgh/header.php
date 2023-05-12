<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package realgh
 */

global $rlgh_data;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	<?php get_template_part('parts/themesheader', 'popup'); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<header class="header js-padding">
			<div class="wrapper">
				<div class="header__content d-flex">
					<div class="header__left d-flex">
						<a href="<?php echo get_site_url(); ?>" class="link logo header__logo">
							<img src="<?php echo $rlgh_data['logo']['url']; ?>" alt="logo" class="svg">
						</a>
						<nav id="site-navigation" class="nav header__desktop">
							<?php
                            global $post;
                            $post_slug = $post->post_name;
                            if ($post_slug == "self-help" || $post_slug == "self-help-v2" || $post_slug == "wellbeing-homepage" || $post_slug == "my-progress" || is_category() || is_single()) {
	                            wp_nav_menu(
	                            	array(
	                            		'menu' => 'wellbeing_menu',
	                            		'container' => false,
	                            		'menu_class' => 'menu d-flex',
	                            		'add_li_class' => 'menu__item',
	                            		'link_class' => 'link text menu__link',
	                            	)
	                            );
                            } else {
	                            wp_nav_menu(
	                            	array(
	                            		'theme_location' => 'main-menu',
	                            		'container' => false,
	                            		'menu_class' => 'menu d-flex',
	                            		'add_li_class' => 'menu__item',
	                            		'link_class' => 'link text menu__link main-menu-link',
	                            	)
	                            );
                            }
                            ?>
						</nav>
					</div>
					<div class="header__right d-flex header__desktop">

						<?php if (is_user_logged_in()) { ?>
						<a href="<?php echo get_home_url(); ?>/dashboard/"
							class="button transp-button cus-my-account-btn">
							<span class="button-text">
								My Account
							</span>
						</a>

						<a href="<?php echo wp_logout_url(get_home_url()); ?>" title="Logout"
							class="link button yellow-button cus-my-account-btn">
							<span class="button-text">
								Logout
							</span></a>

						<?php } else { ?>
						<button data-popup="login" class="button transp-button js-popup">
							<span class="button-text">
								<?php echo $rlgh_data['login_btn']; ?>
							</span>
						</button>
						<button data-popup="regist" class="button yellow-button js-popup">
							<span class="button-text">
								<?php 
									if (is_page('self-help') || is_page('my-progress')) { 
										echo "Create an account";
									}else{
										echo $rlgh_data['regist_btn'];
									}
								?>
							</span>
						</button>
						<?php } ?>
					</div>
					<button data-popup="menu" class="button menu-button js-popup">
						<span class="menu-button__h-line"></span>
						<span class="menu-button__h-line"></span>
						<span class="menu-button__h-line"></span>
					</button>
				</div>
			</div>
		</header>

		<?php
        get_template_part('parts/menu', 'popup');
        get_template_part('parts/support', 'popup');

        if (!is_user_logged_in()) {
	        get_template_part('parts/regist', 'popup');
	        get_template_part('parts/login', 'popup');
	        get_template_part('parts/reset-request', 'popup');
	        get_template_part('parts/reset-answer', 'popup');
        }

        ?>
