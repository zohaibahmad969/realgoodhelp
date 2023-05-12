<?php global $rlgh_data; ?>

<div class="popup popup--side menu__popup">
	<div class="popup__body popup__body--side menu-popup__body">
		<div class="popup__header d-flex">
			<button class="button close-button menu-popup__close-button js-close-popup">
				<i class="icon realgh-close"></i>
			</button>
		</div>
		<div class="popup__content menu__popup-content">
			<div class="header__left d-flex">
				<nav id="site-navigation" class="nav">
					<?php
					global $post;
					$post_slug = $post->post_name;
					if ($post_slug == "self-help" || $post_slug == "self-help-v2" || $post_slug == "wellbeing-homepage" || $post_slug == "my-progress" || is_category() || is_single()) {
						wp_nav_menu(
							array(
								'menu' => 'wellbeing_menu',
								'container' 		=> false,
								'menu_class' 		=> 'menu d-flex',
								'add_li_class'		=> 'menu__item',
								'link_class'		=> 'link text menu__link',
							)
						);
					}else{
						wp_nav_menu(
							array(
								'theme_location' => 'main-menu',
								'container' 		=> false,
								'menu_class' 		=> 'menu d-flex',
								'add_li_class'		=> 'menu__item',
								'link_class'		=> 'link text menu__link',
							)
						);
					}
					?>
				</nav>
			</div>
			<div class="header__right d-flex">
				<?php if (is_user_logged_in()) { ?>
					<a href="<?php echo get_home_url(); ?>/dashboard/" class="button transp-button cus-my-account-btn">
						<span class="button-text">
							My Account
						</span>
					</a>

					<a href="<?php echo wp_logout_url(get_home_url()); ?>" title="Logout" class="link button yellow-button cus-my-account-btn">
						<span class="button-text">
							Logout
						</span></a>

				<?php } else { ?>
				<button data-popup="login" class="button transp-button js-popup menu-popup__button">
					<span class="button-text">
						<?php echo $rlgh_data['login_btn']; ?>
					</span>
				</button>
				<button data-popup="regist" class="button yellow-button js-popup menu-popup__button">
					<span class="button-text">
						<?php echo $rlgh_data['regist_btn']; ?>
					</span>
				</button>
				<?php } ?>
			</div>
		</div>
	</div>
</div>