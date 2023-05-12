<?php global $rlgh_data; ?>

<div class="popup regist__popup">
	<div class="popup__body popup__body--bg regist-popup__body regist-popup__body--bg" id="wrapper_top">
		<div class="popup__side">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/img/decoration/background--regist.svg" alt="Background" class="img bg regist-popup__bg">
			<div class="popup__side-content">
				<a href="/" class="link logo">
					<img src="<?php echo $rlgh_data['logo_alt']['url']; ?>" alt="Logo" class="svg">
				</a>
				<div class="popup-side__text-block">
					<p class="title c-white">Hello, Friend!</p>
					<p class="text c-white">Enter your personal details and start journey with us</p>
				</div>
			</div>
		</div>


		<div class="popup__container">
			<button class="button close-button close-button--ps-abs js-close-popup">
				<i class="icon realgh-close"></i>
			</button>
			<div class="popup__content">
				<form method="post" action="" id="registerPopUpForm">
					<section id="userType">
						<p class="title psycho__title">Who are you?</p>
						<div class="cus-client-therapist-btn">
							<div class="regist-popup__type">
								<div class="regist-popup__type-variants">
									<input type="radio" id="client" value="client" name="user_type" class="check__input" checked>
									<label for="client" class="label check__label radio__label text form__text text fz-18">Client</label>

									<input type="radio" id="psycho" value="psycho" name="user_type" class="check__input">
									<label for="psycho" class="label check__label radio__label text form__text text fz-18">Therapist</label>
								</div>
							</div>
						</div>

						<div>
						<span class="button main-button cus-continue-sign-up-btn" id="step1Countinue">Continue</span>
						</div>
					</section>


					<section id="formRegistraion">
						<div class="login__top">
							<div class="reponseMsg"></div>
							<div class="errorMsg"></div>
							<p class="subtitle popup__title mb-20">Create Account</p>
							<div class="social-logins">
								<?php echo do_shortcode('[nextend_social_login provider="google" redirect="'. home_url() .'/edit-account/"]'); ?>
								<?php //echo do_shortcode('[nextend_social_login provider="facebook"]'); ?>
							</div>
							<div>
								<p class="cus-or-text">- OR - </p>
							</div>
						</div>

						<div class="form__top">
							<div class="form__cell req-field">
								<input type="text" class="input input-text" name="fname" placeholder="First Name">
							</div>
							<div class="form__cell req-field">
								<input type="text" class="input input-text" name="lname" placeholder="Last Name">
							</div>
							<div class="form__cell req-field">
								<input type="tel" class="input input-text" name="phone" placeholder="Phone number">
							</div>
							<div class="form__cell req-field" id="client_timezone">
								<select name="time_zone" class="input input-text timezone__select">
									<option value selected disabled>Select Timezone</option>
									<?php echo realgh_get_timezones(); ?>
								</select>
							</div>
							<div class="form__cell req-field">
								<input type="email" id="email_register" class="input input-text" name="email" placeholder="Email Address">
								<div id="email_register_error" class="error-message"></div>
							</div>
							<div class="form__cell req-field">
								<input type="password" class="input input-text" name="password" placeholder="Password">
							</div>
						</div>
						
						<!-- START FORM ROW -->

						<div class="form__cell req-field" id="client_agree">
							<div class="client-check-field">
								<input type="checkbox" id="client_checkbox" value="1" name="client_checkbox" class="check__input" checked>
								<span class="desc text form__text">By clicking the "Submit" button, you confirm that you have read and accepted our <a class="link c-main" href="https://realgoodhelp.com/privacy-policy/" target="blank">Privacy Policy</a> and <a class="link c-main" href="https://realgoodhelp.com/terms-of-use/" target="blank">Terms of Use</a></span>
							</div>
							<!-- <label for="client_checkbox" class="label check__label text form__text" id="cus-orig-check"></label> -->
						</div>
						
						<!-- END FORM ROW -->
						<div class="form__bot">
							<button class="button main-button" id="signUpForm">
									<span class="button-text">Sign Up</span>
							</button>

							<button class="button main-button" id="continueForm">
								<span class="button-text">Continue</span>
							</button>
							<p class="text form__text regist-popup__text">Already have an account? <span data-popup="login" class="link c-main js-popup">Sign In</span></p>
						</div>

					</section>
				</form>
			</div>
		</div>
	</div>
</div>

<div id="loader" class="loader-wrap is-active" style="display:none;">
	<img src="<?php echo get_template_directory_uri(); ?>/assets/img/booking/blue_spinner.gif" class="pay_loader" alt="blue_spinner">
</div>

<script type="text/javascript">
	$(document).ready(function() {
		var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

		$.validator.addMethod("custom_number", function(value, element) {
				return this.optional(element) || value === "NA" ||
						value.match(/^[0-9,\+-]+$/);
		}, "Please enter a valid phone number with country code");

		var validator = $("#registerPopUpForm").validate({
			rules: {
				// simple rule, converted to {required:true}
				fname: "required",
				lname: "required",
				phone: {
					minlength: 10,
					maxlength: 13,
					custom_number: true,
				},
				time_zone: {
					required: true,
				},
				// compound rule
				email: {
					required: true,
					email: true
				},
				password: {
					required: true,
					minlength: 8,
				},
				client_checkbox:{
					required: true,
				},
				agree: "required"
			}
		});
	 

		$("#signUpForm").click(function(e) {
			e.preventDefault();
			validator.form();

      if (validator.valid()) {
        var formData = $("#registerPopUpForm").serialize();
        console.log("From Data", formData);
		$('#loader').show();
        $.ajax({
            method: "POST",
            url: ajaxurl,
            data: {
              action: 'registerForm',
              data: formData
            },
            dataType: 'JSON'
          })
          .done(function(msg) {
            var response = msg;
			$('#loader').hide();
            if (response.error) {
              jQuery('.errorMsg').html(response.error);
            } else {
              jQuery('.reponseMsg').html(response.success);
			  $("#wrapper_top").animate({ scrollTop: 0 }, "slow");
			  $('#registerPopUpForm')[0].reset();

			  // keep user in same page after login, just refresh
			  if($("body").hasClass("category")){
                        $("#loader").removeClass("is-active");
                        $(".regist__popup").removeClass("show");
						unlockScroll();
                        $("body").addClass("logged-in");
                        $(".cp-action-popup h2.title").text("You are successfully signed up.");
                        $('.cp-action-popup').css('display', 'block')
                        window.setTimeout(function() {
                            $('.cp-action-popup').css('display', 'none')
                        }, 4000);
                    }else{
                        window.location.href = window.location.href;
                    }
            }
          });
      }
    });

		function checkEmailExisting(email){
			var response = '';
			$.ajax({
					method: "POST",
					url: ajaxurl,
					async: false,
					data: {
						action: 'checkEmailExist',
						email: email
					},
					dataType: 'JSON'
				})
				.done(function(msg) {
					response = msg.result
				});
				return response;
		}

		$("#continueForm").click(function(e) {
			e.preventDefault();
			validator.form();
			let email_register = $('#email_register').val();
			let emailExist = checkEmailExisting(email_register);
			if(emailExist){
				$('#email_register_error').html('<label class="error">Email already exist!.</label>')
			} else {
				if (validator.valid()) {
					$('#registerPopUpForm').attr('action', '<?php echo get_site_url(); ?>/therapists-registration/');
					$('#registerPopUpForm').submit();
				}
			}
		});

		// $("#continueForm").click(function(e) {
		//   e.preventDefault();
		//   validator.form();

		//   if (validator.valid()) {
		//     $('#registerPopUpForm').attr('action', '<?php //echo get_site_url(); ?>/therapists-registration/');
		//     $('#registerPopUpForm').submit();
		//   }
		// });

		$('#step1Countinue').click(function(e) {
			$('#userType').fadeOut();
			$('#formRegistraion').fadeIn();
			var user_type = $('input[name=user_type]:checked').val();
			if (user_type == 'psycho') {
				$('#continueForm').show();
				$('#signUpForm').hide();
				$('#client_agree').hide();
				$('#client_timezone').hide();
			} else if (user_type == 'client') {
				$('#client_agree').show();
				$('#client_timezone').show();
				$('#continueForm').hide();
				$('#signUpForm').show();
			}

			document.cookie = 'userType=' + user_type + '; max-age=3600; path=/';
		});

		$('button.button.close-button.close-button--ps-abs').click(function() {
			$('#userType').fadeIn();
			$('#formRegistraion').fadeOut();
		});

	});
	
</script>