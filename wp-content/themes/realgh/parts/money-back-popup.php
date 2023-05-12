<?php global $rlgh_data; ?>

<div class="popup money-back__popup">
	<div class="popup__body popup__body--bg regist-popup__body login-popup__body--bg">
		<div class="popup__container">
			<button class="button close-button close-button--ps-abs js-close-popup">
				<i class="icon realgh-close"></i>
			</button>
			<div class="popup__content">
				<p class="title popup__title">Eligibility for the guarantee</p>
				<p class="text">If you are unhappy with your first session (trial or a regular session), you can get a full refund. You are eligible for your first session only, with a limitation to two therapists or coaches.<br>
				<br>
				You can only get a refund from therapists or coaches with "money back guarantee" badges.</p>
				<p class="subtitle fz-18">How the Money Back Guarantee works</p>
				<ul class="list">
					<li class="text list-item">Book a session with a therapist or coach with a "money-back guarantee" badge.</li>
					<li class="text list-item">Complete your session.</li>
					<li class="text list-item">If you are not satisfied with it, please send email within 24 hours of the session to <a href="mailto:support@realgoodhelp.com" class="link c-main">support@realgoodhelp.com</a>. The email should include why you were dissatisfied with the session, its date and time, the name of the therapist, and your name.  </li>
					<li class="text list-item">We will review your request within three business days and confirm the refund. You will get your money back shortly after.</li>
				</ul>
				<p class="text note">Please see our <a href="https://realgoodhelp.com/terms-of-use/" class="link c-main" target="blank">Terms of Use</a> for full conditions.</p>
			</div>
		</div>

		<div class="popup__side">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/img/decoration/background--login.svg" alt="Background" class="img bg login-popup__bg">
			<div class="popup__side-content">
				<a href="/" class="link logo">
					<img src="<?php echo $rlgh_data['logo_alt']['url']; ?>" alt="Logo" class="svg">
				</a>
				<div class="popup-side__text-block">
					<p class="title c-white ta-c">Money Back Gurantee!</p>
				</div>
			</div>
		</div>

	</div>

</div>