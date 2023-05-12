<?php
/*
* Template name: Template Booking
*/

session_start();

get_header();

if(!$single_therapist_id){
	$single_therapist_id = $_GET['psychologist_id'];
}

$psycho_additional_data = [];
if (isset($single_therapist_id) && !empty($single_therapist_id)) {
	$therapist_data = get_userdata($single_therapist_id);
	$psycho_additional_data = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}users_data a JOIN {$wpdb->prefix}therapists_data b ON a.user_id = b.therapist_id WHERE therapist_id = $single_therapist_id");
}

$user_data = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}users_data WHERE user_id = " . get_current_user_id());

?>
<main class="main js-padding">
	<div class="extend steps__nav">
		<div class="wrapper">
			<div class="steps-nav__content">
				<div id="step-1-tab" class="steps__nav-item step-1 active">
					<p class="step-item__numb">1</p>
					<p class="text fw-600"><?php echo get_post_meta( get_the_ID(), 'realgh_book_step_main_title_1', true ); ?></p>
				</div>
				<i class="icon realgh-chevron-right"></i>
				<div id="step-2-tab" class="steps__nav-item step-2">
					<p class="step-item__numb">2</p>
					<p class="text fw-600"><?php echo get_post_meta( get_the_ID(), 'realgh_book_step_main_title_2', true ); ?></p>
				</div>
				<!-- <i class="icon realgh-chevron-right"></i>
				<div id="step-3-tab" class="steps__nav-item step-3">
					<p class="step-item__numb">3</p>
					<p class="text fw-600"><?php echo get_post_meta( get_the_ID(), 'realgh_book_step_main_title_3', true ); ?></p>
				</div> -->
				<!-- <i class="icon realgh-chevron-right"></i>
				<div id="step-4-tab" class="steps__nav-item step-4">
					<p class="step-item__numb">4</p>
					<p class="text fw-600">Information about you</p>
				</div> -->
				<i class="icon realgh-chevron-right"></i>
				<div id="step-5-tab" class="steps__nav-item step-5">
					<p class="step-item__numb">3</p>
					<p class="text fw-600"><?php echo get_post_meta( get_the_ID(), 'realgh_book_step_main_title_4', true ); ?></p>
				</div>
			</div>
		</div>
	</div>
	<section class="section-alt steps">
		<form method="POST" id="bookingForm" enctype="multipart/form-data">
			<div class="wrapper ps-rel">
				<!-- START FORM 1 -->
				<div id="step-1" class="form tab__item active">
					<div class="steps-form__header">
						<h2 class="title steps__title"><?php echo get_post_meta( get_the_ID(), 'realgh_book_step_title', true ); ?></h2>
					</div>
					<input type="hidden" name="therapist_Name" value="<?php echo $therapist_data->display_name; ?>" />
					<input type="hidden" name="therapist_ID" value="<?php echo $single_therapist_id; ?>" />
					<div class="grid booking__types req-field">
						<?php if ($psycho_additional_data->half_rate) { ?>
							<!-- START CARD -->
							<input data-duration="30" type="radio" name="type_price" id="type-1" class="check__input durationRadio time_duration" value="<?php echo $psycho_additional_data->half_rate; ?>#Trial consultation#30 min">
							<label for="type-1" class="label method__label">
								<p class="text fz-20 fw-600">Trial consultation</p>
								<span class="d-flex booking-type__bot">
									<span class="text fz-20 c-grey">30 min</span>
									<span class="text fz-16 booking-type__price">
										<?php echo $psycho_additional_data->half_rate; ?>
									</span>
								</span>
							</label>
						<?php  } ?>
						<!-- END CARD -->

						<!-- START CARD -->
						<?php if ($psycho_additional_data->hourly_rate) { ?>
							<input data-duration="60" type="radio" name="type_price" id="type-2" class="check__input durationRadio time_duration" value="<?php echo $psycho_additional_data->hourly_rate; ?>#Consultation#60 min">
							<label for="type-2" class="label method__label">
								<p class="text fz-20 fw-600">Consultation</p>
								<span class="d-flex booking-type__bot">
									<span class="text fz-20 c-grey">60 min</span>
									<span class="text fz-16 booking-type__price">
										<?php echo $psycho_additional_data->hourly_rate; ?>
									</span>
								</span>
							</label>
						<?php  } ?>
						<!-- END CARD -->

						<!-- START CARD -->
						<?php if ($psycho_additional_data->chat_rate) { ?>
							<input data-duration="60" type="radio" name="type_price" id="type-4" class="check__input durationRadio time_duration" value="<?php echo $psycho_additional_data->chat_rate; ?>#1 hour of Chat#60 min">
							<label for="type-4" class="label method__label">
								<p class="text fz-20 fw-600">1 hour of Chat</p>
								<span class="d-flex booking-type__bot">
									<span class="text fz-20 c-grey">60 min</span>
									<span class="text fz-16 booking-type__price">
										<?php echo $psycho_additional_data->chat_rate; ?>
									</span>
								</span>
							</label>
						<?php  } ?>
						<!-- END CARD -->
					</div>
					<div class="form__button-block mobile--fxd-cr">
						<a href="<?php echo get_permalink( get_page_by_path( 'psychologist-profile' ) ) ?>?psychologist_id=<?php echo $single_therapist_id; ?>" class="link button border-button steps__button button--big">
							<span class="button-text"><?php echo get_post_meta( get_the_ID(), 'realgh_previous_button_text', true ); ?></span>
						</a>
						<button data-step="2" type="button" class="button main-button steps__button button--big next">
							<span class="button-text"><?php echo get_post_meta( get_the_ID(), 'realgh_continue_button_text', true ); ?></span>
						</button>
					</div>
				</div>
				<!-- END FORM 1 -->

				<!-- START FORM 2 -->
				<div id="step-2" class="form tab__item">
					<div class="steps-form__header">
						<h2 class="title steps__title">Please select a day and time for your consultation</h2>
						<p class="text c-dark">You can select from the available slots shown in white.</p>
						<select id="timezone" name="timezone" class="input input-text select timezone__select">
							<option value selected disabled>Select Timezone</option>
							<?php echo realgh_get_timezones('num', $user_data->time_zone); ?>
						</select>
					</div>
					<div class="form">
						<div class="booking__calendar-fields req-field">
							<input type="hidden" name="session_date" id="session_date" class="input">
							<input type="hidden" name="session_start" id="session_start" class="input">
							<input type="hidden" name="session_end" id="session_end" class="input">
							<input type="hidden" name="session_duration" id="session_duration" class="input">
							<input type="hidden" name="promo_amount" id="promo_amount" class="input">
							<input type="hidden" name="communication_method" value="zoom" class="input">
						</div>
						<!-- data-psycho="psychologist id" -->
						<div data-psycho="<?php echo $single_therapist_id; ?>" class="calendar client">

							<div class="d-flex calendar__nav">
								<button type="button" class="button calendar__button prev-button">
									<i class="icon realgh-chevron-left"></i>
								</button>
								<div class="d-flex calendar__global">
									<select name="month" class="input calendar__input subtitle fz-20 fw-600 calendar__month">
										<option value="0">January</option>
										<option value="1">February</option>
										<option value="2">March</option>
										<option value="3">April</option>
										<option value="4">May</option>
										<option value="5">June</option>
										<option value="6">July</option>
										<option value="7">August</option>
										<option value="8">September</option>
										<option value="9">October</option>
										<option value="10">November</option>
										<option value="11">December</option>
									</select>
									<select name="year" class="input calendar__input subtitle fz-20 fw-600 calendar__year">
									</select>
								</div>
								<button type="button" class="button calendar__button next-button">
									<i class="icon realgh-chevron-right"></i>
								</button>
							</div>
							<div class="calendar__header">
								<div class="empty"></div>
								<div class="calendar__cell calendar__day-header">
									<p class="text fz-12 calendar__weekday">mon</p>
									<p class="subtitle calendar__date"></p>
								</div>
								<div class="calendar__cell calendar__day-header">
									<p class="text fz-12 calendar__weekday">tue</p>
									<p class="subtitle calendar__date"></p>
								</div>
								<div class="calendar__cell calendar__day-header">
									<p class="text fz-12 calendar__weekday">wed</p>
									<p class="subtitle calendar__date"></p>
								</div>
								<div class="calendar__cell calendar__day-header">
									<p class="text fz-12 calendar__weekday">thu</p>
									<p class="subtitle calendar__date"></p>
								</div>
								<div class="calendar__cell calendar__day-header">
									<p class="text fz-12 calendar__weekday">fri</p>
									<p class="subtitle calendar__date"></p>
								</div>
								<div class="calendar__cell calendar__day-header">
									<p class="text fz-12 calendar__weekday">sat</p>
									<p class="subtitle calendar__date"></p>
								</div>
								<div class="calendar__cell calendar__day-header">
									<p class="text fz-12 calendar__weekday">sun</p>
									<p class="subtitle calendar__date"></p>
								</div>
							</div>
							<div class="calendar__body">

								<!-- START ADDITION -->
								<template id="session-temp">
									<div class="calendar__event">
										<p class="text fz-14 calendar__event-time"></p>
									</div>
								</template>

								<div class="calendar__hint">
									<p class="subtitle fz-12 fw-600 calendar-hint__text"></p>
								</div>
								<!-- END ADDITION -->

								<div class="calendar__column calendar__time-block"></div>

								<div class="calendar__table">
									<div class="calendar__column calendar__day-block"></div>
									<div class="calendar__column calendar__day-block"></div>
									<div class="calendar__column calendar__day-block"></div>
									<div class="calendar__column calendar__day-block"></div>
									<div class="calendar__column calendar__day-block"></div>
									<div class="calendar__column calendar__day-block"></div>
									<div class="calendar__column calendar__day-block"></div>
								</div>
							</div>
						</div>
						<div class="form__button-block mobile--fxd-cr">
							<button data-step="1" type="button" class="button border-button steps__button button--big back">
								<span class="button-text"><?php echo get_post_meta( get_the_ID(), 'realgh_previous_button_text', true ); ?></span>
							</button>
							<button data-step="5" type="button" class="button main-button book_button_steps steps__button button--big next">
								<span class="button-text"><?php echo get_post_meta( get_the_ID(), 'realgh_continue_button_text', true ); ?></span>
							</button>
						</div>
					</div>
				</div>
				<!-- END FORM 2 -->

				<!-- START FORM 3 -->
				<!-- <div id="step-3" class="form tab__item">
					<div class="steps-form__header">
						<h2 class="title steps__title"><?php echo get_post_meta( get_the_ID(), 'realgh_book_step3_title', true ); ?></h2>
						<p class="text c-dark"><?php echo get_post_meta( get_the_ID(), 'realgh_book_step3_desc', true ); ?>
						</p>
					</div>
					<div class="d-flex method__cards booking__call-method req-field"> -->
						<!-- START CARD -->
						<!-- <input type="radio" name="communication_method" id="method-1" value="google" class="check__input durationRadio" checked>
						<label for="method-1" class="label method__label method-card">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/booking/google-meet.png" alt="Method" class="svg booking__method-img">
						</label> -->
						<!-- END CARD -->

						<!-- START CARD -->
						<!-- <input type="radio" name="communication_method" id="method-2" value="zoom" class="check__input durationRadio" checked>
						<label for="method-2" class="label method__label method-card">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/booking/zoom.png" alt="Method" class="svg booking__method-img">
						</label> -->
						<!-- END CARD -->
					<!-- </div>
					<div class="form__button-block mobile--fxd-cr">
						<button data-step="2" type="button" class="button border-button steps__button button--big back">
							<span class="button-text"><?php echo get_post_meta( get_the_ID(), 'realgh_previous_button_text', true ); ?></span>
						</button>
						<button data-step="5" type="button" class="button main-button book_button_steps steps__button button--big next">
							<span class="button-text"><?php echo get_post_meta( get_the_ID(), 'realgh_continue_button_text', true ); ?></span>
						</button>
					</div>
				</div> -->
				<!-- END FORM 3 -->

				<!-- START FORM 4 -->
				<!-- <div id="step-4" class="form tab__item">
					<div class="steps-form__header">
						<h2 class="title steps__title">Please select all issues you have experienced or been concerned with recently? <span class="fz-18 tt-upp c-grey">(Optional)</span></h2>
					</div>
					<div class="booking__issues">

						<input type="checkbox" id="slowly" value="slowly" name="issue[]" class="check__input durationRadio">
						<label for="slowly" class="label check__label checkbox__label text form__text">Moving or speaking slowly</label>

						<input type="checkbox" id="tired" value="tired" name="issue[]" class="check__input durationRadio">
						<label for="tired" class="label check__label checkbox__label text form__text">Feeling tired or low energy</label>

						<input type="checkbox" id="concentrating" value="concentrating" name="issue[]" class="check__input durationRadio">
						<label for="concentrating" class="label check__label checkbox__label text form__text">Trouble concentrating on simple things</label>

						<input type="checkbox" id="hurting" value="hurting" name="issue[]" class="check__input durationRadio">
						<label for="hurting" class="label check__label checkbox__label text form__text">Thoughts of feeling better off dead or of hurting yourself</label>

						<input type="checkbox" id="bored" value="bored" name="issue[]" class="check__input durationRadio">
						<label for="bored" class="label check__label checkbox__label text form__text">Little interest in doing things</label>

						<input type="checkbox" id="panic" value="panic" name="issue[]" class="check__input durationRadio">
						<label for="panic" class="label check__label checkbox__label text form__text">Anxiety or panic attacks</label>

						<input type="checkbox" id="depression" value="depression" name="issue[]" class="check__input durationRadio">
						<label for="depression" class="label check__label checkbox__label text form__text">Depression</label>

						<input type="checkbox" id="none" value="none" name="issue[]" class="check__input durationRadio">
						<label for="none" class="label check__label checkbox__label text form__text">None of the above</label>

						<input type="checkbox" id="other" value="other" name="issue[]" class="check__input durationRadio">
						<label for="other" class="label check__label checkbox__label text form__text">Other</label>
					</div>
					<input type="text" name="other_text" class="input input-text booking__input" placeholder="Please write another option">
					<div class="form__button-block mobile--fxd-cr">
						<button data-step="3" type="button" class="button border-button steps__button button--big back">
							<span class="button-text">Previous</span>
						</button>
						<button data-step="5" type="button" class="button main-button steps__button button--big next">
							<span class="button-text">Continue</span>
						</button>
					</div>
				</div>
				END FORM 4 -->

				<!-- START FORM 5 -->
				<div id="step-5" class="grid aside__container aside__rev-container tab__item">
					<div class="grid aside__main-content">

						<!-- <div class="card card__content">
							<input type="checkbox" id="balance" value="balance" name="balance" class="check__input durationRadio">
							<label for="balance" class="label check__label checkbox__label subtitle fz-22">
								<?php echo get_post_meta( get_the_ID(), 'realgh_book_step4_title', true ); ?><br>
								<span class="text fz-16"><?php echo get_post_meta( get_the_ID(), 'realgh_book_step4_desc', true ); ?></span>
							</label>
						</div> -->

						<div class="card">
							<div class="card__header">
								<p class="subtitle fz-22"><?php echo get_post_meta( get_the_ID(), 'realgh_book_step_payment_method_title', true ); ?></p>
							</div>
							<div class="card__content">
								<div class="d-flex method__cards">
									<!-- START CARD -->
									<input type="radio" name="payment_method" id="pay-1" value="stripe" class="check__input durationRadio paymetMethod" checked>
									<label for="pay-1" class="label method__label method-card">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/img/payment/cards.png" alt="Payment" class="svg pay-img">
									</label>
									<!-- END CARD -->

									<!-- START CARD -->
									<!-- <input type="radio" name="payment_method" id="pay-2" value="paypal" class="check__input durationRadio paymetMethod">
									<label for="pay-2" class="label method__label method-card">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/img/payment/paypal.png" alt="Payment" class="svg pay-img">
									</label> -->
									<!-- END CARD -->
								</div>
								<p class="text fz-16 fw-600">
									<?php echo get_post_meta( get_the_ID(), 'realgh_book_step_payment_method_desc', true ); ?>
								</p>
							</div>
						</div>

						<div class="card card__content">
							<div class="d-flex promo__header">
								<i class="icon realgh-tag"></i>
								<p class="subtitle fz-22"><?php echo get_post_meta( get_the_ID(), 'realgh_book_step_promo_code_title', true ); ?></p>
							</div>
							<div class="d-flex promo__content">
									<input id="promo_field" type="text" name="promo" class="input input-text" placeholder="<?php echo get_post_meta( get_the_ID(), 'realgh_promo_code_input_placeholder', true ); ?>">
									<button type="submit" class="button yellow-button promo__button js-redeem-btn">
										<span class="button-text"><?php echo get_post_meta( get_the_ID(), 'realgh_promo_code_input_button_text', true ); ?></span>
									</button>
							</div>
						</div>

					</div>
					<div class="aside">
						<div id="loader" class="loader-wrap is-active" style="display:none;">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/booking/blue_spinner.gif" class="pay_loader" alt="blue_spinner">
						</div>

						<div class="card pay-card">
							
							<div class="pay-card__header">
								<span class="cus-booking-user-img">
								<?php
									$userImg = $psycho_additional_data->user_profile_pic;
									if (!$userImg) {
										if (get_avatar_url($therapist_data->ID)) {
											$userImg = get_avatar_url($therapist_data->ID);
										} else {
											$userImg = get_template_directory_uri() . "/assets/img/dummy-profile-image.png";
										}
									}

								?>
								<img src="<?php echo $userImg; ?>" alt="Avatar" class="img single-psycho__img"
							>
								<input type="hidden" name="avtarUrl" value="<?php echo $userImg; ?>">
								</span>
								<div class="pay-card__user-details">
									<p class="subtitle fz-22"><?php echo $therapist_data->data->display_name; ?></p>
									<p class="text fz-16 fw-600" id="commuMethodType">Trial Lesson</p>
									<p class="text fz-16 fw-600" id="videoType">Zoom</p>
									<p class="text fz-16 fw-600"><span id="commuMethodPeriod">30 min</span>, Consultation</p>
									<p class="text fz-16 fw-600" id="fullDateFormate">Mon, Jul 04, 10 AM - 11 PM</p>
								</div>
							</div>

							<div class="pay-card__details">
								<div class="pay-card__row">
									<p class="text fw-600">Sub-total</p>
									<p class="subtitle fz-22"><span id="initPrice">0.00</span> <?php echo CURRENCY; ?></p>
								</div>
								<div class="pay-card__row">
									<p class="text fw-600">Discount</p>
									<p class="subtitle fz-22"><span id="discountPrice">0.00</span> <?php echo CURRENCY; ?></p>
								</div>
								<div class="h-line pay-card__h-line"></div>
								<div class="pay-card__row">
									<p class="subtitle fz-20 fw-600">Total</p>
									<p class="subtitle fz-22"><span id="totalPrice">0.00</span> <?php echo CURRENCY; ?></p>
								</div>
							</div>
							<button class="button main-button pay-card__button" id="checkout-button">
								<span class="button-text">Pay <span id="btnLblPrice">00 <?php echo CURRENCY; ?></span> <?php echo CURRENCY; ?></span>
							</button>
							<div id="smart-button-container" style="display: none;">
								<div style="text-align: center;">
									<div id="paypal-button-container"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="form__button-block mobile--fxd-cr">
						<button data-step="2" type="button" class="button border-button steps__button button--big back">
							<span class="button-text"><?php echo get_post_meta( get_the_ID(), 'realgh_previous_button_text', true ); ?></span>
						</button>
					</div>
				</div>
				<!-- END FORM 5 -->

			</div>
		</form>
	</section>
	<div class="responseSection">
		<div class="errorMsg"></div>
		<div class="successMsg"></div>
	</div>
</main>
<script src="https://www.paypal.com/sdk/js?client-id=sb&currency=<?php echo CURRENCY; ?>&disable-funding=card" data-sdk-integration-source="button-factory"></script>
<?php get_footer(); ?>

<script>
	initPayPalButton();
</script>