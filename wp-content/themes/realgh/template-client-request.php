<?php
/*
* Template name: Template Client's Request
*/

get_header();
get_template_part('parts/success-request', 'popup');
?>

<main class="main js-padding">
	<div class="wrapper">
		<section class="section-alt request">
			<div class="request__backing">
				<form class="card form request__form mobile-card--p-0">

					<div class="request__header">

						<div class="form__image-cell">
							<input type="file" id="prfilePic" name="prfilePic" class="input-file" accept="image/png, image/jpeg, image/bmp">
							<input
								type="hidden"
								class="input input-file--path"
								name="avatar_path"
							>
							<label for="prfilePic" class="label form__image-block request__image-block">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/avatar-placeholder.svg" alt="Avatar" id="userUplodaedPic" class="img">
							</label>
						</div>

						<div class="request__about-block">

							<div class="form__cell req-field">
								<input type="text" name="full_name" class="input request__name title" placeholder="Name Surname">
							</div>

							<div class="form__cell request__form-cell req-field">
								<div class="form-cell__header">
									<label for="issue" class="label text form-cell__title req-label">
										Your story
									</label>
									<p class="text fz-14">Please describe the matter that brings you here. What is bothering or disturbing you? For how long? Is there anything specific you would like to achieve by working with a therapist?</p>
								</div>
								<textarea name="issue" id="issue" class="input input-text textarea textarea--length request__textarea cus-counter1" maxlength="1000" placeholder="Share your story here. It will be treated confidentially"></textarea>
								<p class="cus-text-limit request__limit">
									<span id="current1">0</span>
									<span id="maximum1">/ 1000</span>
								</p>
							</div>

						</div>
					</div>

					<div class="form__row">

						<div class="form__cell req-field">
							<label for="email" class="label text form-cell__title req-label">
								Email
							</label>
							<input type="email" name="email" id="email" class="input input-text" placeholder="Enter your email address">
						</div>

						<div class="form__cell req-field">
							<label for="time_zone" class="label text form-cell__title req-label">
								Timezone
							</label>
							<select id="time_zone" name="time_zone" class="input input-text timezone__select">
								<option value selected disabled>Select your timezone</option>
								<?php echo realgh_get_timezones(); ?>
							</select>
						</div>

					</div>

					<div class="readmore__container">
						<div class="readmore request__readmore">
							<div class="readmore__cover request__readmore-cover d-flex">
								<p class="subtitle fz-16">
									Optional questions
								</p>
								<button type="button" class="button readmore__button">
									<i class="icon realgh-chevron-right"></i>
								</button>
							</div>
							<div class="readmore__more request__readmore-more form__cell">
								<div class="form__row">

									<div class="form__cell">
										<label for="datepicker" class="label text form-cell__title">
											Age
										</label>
										<input type="text" name="dob" id="datepicker" class="input input-text datepicker_dob" placeholder="How old are you?" readonly="readonly">
									</div>

									<div class="form__cell">
										<label for="country" class="label text form-cell__title">
											Country
										</label>
										<?php $countryList = country_array(); ?>
										<select name="country" class="input input-text">
											<option value="">Where do you come from?</option>
											<?php foreach ($countryList as $key => $single_country) { ?>
												<option value="<?php echo $key; ?>"><?php echo $single_country; ?></option>
											<?php } ?>
										</select>
									</div>

								</div>
								<div class="form__row">

									<div class="form__cell">
										<label for="cost" class="label text form-cell__title">
											Expected cost per hour session
										</label>
										<input type="number" name="cost" id="cost" class="input input-text" min="0" placeholder="(USD/hour)">
									</div>

								</div>
							</div>
						</div>
					</div>

					<div class="form__cell req-field">
						<input type="checkbox" id="terms" value="1" name="terms" class="check__input" checked>
						<label for="terms" class="label check__label checkbox__label text form__text">
							By clicking the "Share" button, you confirm that you have read and accepted our <a class="link c-main" href="https://realgoodhelp.com/privacy-policy/" target="blank">Privacy Policy</a> and <a class="link c-main" href="https://realgoodhelp.com/terms-of-use/" target="blank">Terms of Use</a>
						</label>
					</div>

					<!-- <p class="text mandatory-text">* These fileds are mandatory</p> -->

					<div class="form__button-block request__buttons mobile--fxd-cr">
						<!-- <button type="button" class="link button border-button button--big">
							<span class="button-text">
								Save as a draft
							</span>
						</button> -->
						<button type="button" class="button main-button button--big js-send-button">
							<span class="button-text">
								SHARE WITH THERAPISTS
							</span>
						</button>
					</div>
				</form>
				<div class="request__answers">
					<p class="subtitle request__empty-text">
						Share your story and one of our therapists will reach out to you asap
					</p>
				</div>
			</div>
		</section>
	</div>
</main>

<?php get_footer(); ?>