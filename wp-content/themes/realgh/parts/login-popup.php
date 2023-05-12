<?php global $rlgh_data; ?>

<div class="popup login__popup">
	<div class="popup__body popup__body--bg regist-popup__body login-popup__body--bg">
		<div class="popup__container">
			<button class="button close-button close-button--ps-abs js-close-popup">
				<i class="icon realgh-close"></i>
			</button>
			<div class="popup__content">
				<div class="login__top">
					<p class="subtitle popup__title mb-20">Sign In</p>
					<div class="social-logins">
						<?php echo do_shortcode('[nextend_social_login provider="google" redirect="' . home_url() . '/edit-account/"]'); ?>
						<?php //echo do_shortcode('[nextend_social_login provider="facebook"]'); ?>

					</div>
					<p class="cus-or-text">- OR - </p>

				</div>
				<form method="post" id="ajaxLoginForm">
					<div class="form__top">
						<div class="responseSection">
							<div class="errorMsg"></div>
							<div class="successMsg"></div>
						</div>
						<div class="form__cell req-field">
							<input type="email" name='email' class="input input-text input--req"
								placeholder="Email Address">
						</div>
						<div class="form__cell req-field">
							<input type="password" name="password" class="input input-text input--req"
								placeholder="Password">
						</div>
						<div class="d-flex login-popup__more">
							<input type="checkbox" id="stay_login" name="stay_login" class="check__input">
							<label for="stay_login" class="label check__label checkbox__label text form__text">Keep me
								logged in</label>
							<!-- <p data-popup="reset-request" class="text c-grey js-popup">Forgot password?</p> -->
							<a href="<?php echo wp_lostpassword_url(); ?>" class="link text c-grey">Forgot password?</a>
						</div>
					</div>
					<div class="form__bot m-b-15">
						<button class="button main-button" id="loginForm">
							<span class="button-text">Sign in</span>
						</button>
						<p class="text form__text regist-popup__text">No account yet? <span data-popup="regist"
								class="link c-main js-popup">Sign up</span></p>
					</div>
					<?php
					if (is_category() || is_single() || is_page('my-progress')) {
						?>
						<div class="form__bot">
							<a href="#" class="button main-button no-text-decore js-close-popup">
								<span class="button-text">Countinue Without Signin</span>
							</a>
							<p class="text form__text regist-popup__text">You won't be able to save and track<br> your
								progress without log in</p>
						</div>
						<?php
					}
					?>
				</form>
			</div>
		</div>

		<div class="popup__side">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/img/decoration/background--login.svg"
				alt="Background" class="img bg login-popup__bg">
			<div class="popup__side-content">
				<a href="/" class="link logo">
					<img src="<?php echo $rlgh_data['logo_alt']['url']; ?>" alt="Logo" class="svg">
				</a>
				<div class="popup-side__text-block">
					<p class="title c-white">Welcome Back!</p>
					<p class="text c-white">Enter your personal details and start journey with us</p>
				</div>
			</div>
		</div>

	</div>

</div>