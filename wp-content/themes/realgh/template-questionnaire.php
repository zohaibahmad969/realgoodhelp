<?php
/*
* Template name: Template Questionnaire
*/

get_header();

get_template_part('parts/success-regist', 'popup');


?>

<main class="main js-padding">
	<div class="extend steps__nav">
		<div class="wrapper">
			<div class="steps-nav__content">
				<div id="step-1-tab" class="steps__nav-item active">
					<p class="step-item__numb">1</p>
					<p class="text fw-600"><?php echo get_post_meta(get_the_ID(), 'realgh_personal_main_title', true); ?></p>
				</div>
				<i class="icon realgh-chevron-right"></i>
				<div id="step-2-tab" class="steps__nav-item">
					<p class="step-item__numb">2</p>
					<p class="text fw-600"><?php echo get_post_meta(get_the_ID(), 'realgh_therapist_main_title', true); ?></p>
				</div>
				<i class="icon realgh-chevron-right"></i>
				<div id="step-3-tab" class="steps__nav-item">
					<p class="step-item__numb">3</p>
					<p class="text fw-600"><?php echo get_post_meta(get_the_ID(), 'realgh_education_main_title', true); ?></p>
				</div>
				<i class="icon realgh-chevron-right"></i>
				<div id="step-4-tab" class="steps__nav-item">
					<p class="step-item__numb">4</p>
					<p class="text fw-600"><?php echo get_post_meta(get_the_ID(), 'realgh_experience_main_title', true); ?></p>
				</div>
				<i class="icon realgh-chevron-right"></i>
				<div id="step-5-tab" class="steps__nav-item">
					<p class="step-item__numb">5</p>
					<p class="text fw-600"><?php echo get_post_meta(get_the_ID(), 'realgh_videointro_main_title', true); ?></p>
				</div>
			</div>
		</div>
	</div>
	<section class="section-alt steps">
		<div id="questionariesForm">
			<div class="wrapper wrapper--small ps-rel">
				<div class="responseSection">
					<div class="errorMsg"></div>
				</div>
				<!-- START FORM 1 -->
				<form id="step-1" class="steps__form tab__item active">
					<div class="steps-form__header">
						<h2 class="title steps__title"><?php echo get_post_meta(get_the_ID(), 'realgh_personal_main_title', true); ?></h2>
						<!-- <p class="text c-dark">Please try to keep your answers honest and error-free.</p> -->
					</div>
					<div class="form">
						<!-- START FORM ROW -->
						<div class="form__cell">
							<div class="form-cell__header">
								<p class="text form-cell__title"><?php echo get_post_meta(get_the_ID(), 'realgh_form-image_title', true); ?></p>
							</div>
							<div class="form__image-cell req-field">
								<input type="file" id="prfilePic" name="prfilePic" class="input-file" accept="image/png, image/jpeg, image/bmp">
								<input
									type="hidden"
									class="input input-file--path"
									name="avatar_path"
								>
								<label for="prfilePic" class="label form__image-block">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/avatar-placeholder.svg" alt="Avatar" id="userUplodaedPic" class="img">
								</label>

								<div class="form-image__side">

									<div class="form-image__info">
										<?php

										$uploadLinkArr = get_post_meta(get_the_ID(), 'realgh_upload_link_repeter', true);
										if (!empty($uploadLinkArr)) {
											echo '<ul class="list">';
											foreach ($uploadLinkArr as $key => $value) {
												echo '<li class="list__item text fz-14">' . $value['realgh_upload_link'] . '</li>';
											}
											echo '</ul>';
										}

										?>
										<!-- <ul class="list">
											<li class="list__item text fz-14"><?php echo get_post_meta(get_the_ID(), 'realgh_upload_link-text', true); ?></li>
											<li class="list__item text fz-14">JPG, PNG and BMP formats only</li>
										</ul> -->
										<p class="text fz-14"><?php echo get_post_meta(get_the_ID(), 'realgh_upload_link_list_text', true); ?> </p>
									</div>
									<label for="prfilePic" class="button yellow-button">
										<span class="button-text"><?php echo get_post_meta(get_the_ID(), 'realgh_upload_link_text', true); ?></span>
									</label>
								</div>
							</div>
						</div>
						<!-- END FORM ROW -->

						<!-- START FORM ROW -->
						<div class="form__row">
							<input type="hidden" name="password" value="<?php echo $_POST['password']; ?>">
							<div class="form__cell req-field">
								<div class="form-cell__header">
									<label for="fname" class="label text form-cell__title req-label">
										<?php echo get_post_meta(get_the_ID(), 'realgh_form_field_fname_label', true); ?>
									</label>
								</div>
								<input type="text" name="fname" id="fname" value="<?php echo $_POST['fname']; ?>" class="input input-text" placeholder="<?php echo get_post_meta(get_the_ID(), 'realgh_form_field_fname_placeholder', true); ?>">
							</div>

							<div class="form__cell req-field">
								<div class="form-cell__header">
									<label for="lname" class="label text form-cell__title req-label">
										<?php echo get_post_meta(get_the_ID(), 'realgh_form_field_sname_label', true); ?>
									</label>
								</div>
								<input type="text" name="lname" id="lname" value="<?php echo $_POST['lname']; ?>" class="input input-text" placeholder="<?php echo get_post_meta(get_the_ID(), 'realgh_form_field_sname_placeholder', true); ?>">
							</div>

						</div>
						<!-- END FORM ROW -->

						<!-- START FORM ROW -->
						<div class="form__row">
							<div class="form__cell req-field">
								<div class="form-cell__header">
									<label for="datepicker" class="label text form-cell__title req-label">
										<?php echo get_post_meta(get_the_ID(), 'realgh_form_field_dob_label', true); ?>
									</label>
								</div>
								<input type="text" name="dob" id="datepicker" class="input input-text datepicker_dob" placeholder="<?php echo get_post_meta(get_the_ID(), 'realgh_form_field_dob_placeholder', true); ?> " readonly="readonly">
							</div>

							<div class="form__cell req-field">
								<div class="form-cell__header">
									<label for="qualification" class="label text form-cell__title req-label">
										<?php echo get_post_meta(get_the_ID(), 'realgh_form_field_qualification_label', true); ?>
									</label>
								</div>
								<select name="qualification" id="qualification" class="input input-text cus_select_dropdown">
									<option value="" selected="true" disabled="disabled">Qualification</option>
									<option value="Clinical Psychologist">Clinical Psychologist</option>
									<option value="Counselling Psychologist">Counselling Psychologist</option>
									<option value="Psychiatrist">Psychiatrist</option>
									<option value="Counsellor">Counsellor</option>
									<option value="Coach">Coach</option>
								</select>
							</div>

						</div>
						<!-- END FORM ROW -->

						<!-- START FORM ROW -->
						<div class="form__row">
							<div class="form__cell req-field">
								<div class="form-cell__header">
									<label for="country" class="label text form-cell__title req-label">
										<?php echo get_post_meta(get_the_ID(), 'realgh_form_field_residence_label', true); ?>
									</label>
								</div>
								<?php $countryList = country_array(); ?>
								<select name="country" class="input input-text">
									<option value="">Country</option>
									<?php foreach ($countryList as $key => $single_country) { ?>
										<option value="<?php echo $key; ?>"><?php echo $single_country; ?></option>
									<?php } ?>
								</select>
							</div>


							<div class="form__cell req-field">
								<div class="form-cell__header">
									<label for="phone" class="label text form-cell__title req-label">
										<?php echo get_post_meta(get_the_ID(), 'realgh_form_phone_number_label', true); ?>
									</label>
								</div>
								<input type="tel" name="phone" value="<?php echo ($_POST['phone']); ?>" id="phone" class="input input-text" placeholder="<?php echo get_post_meta(get_the_ID(), 'realgh_form_field_phone_number_placeholder', true); ?>">
							</div>
						</div>
						<!-- END FORM ROW -->

						<!-- START FORM ROW -->
						<div class="form__row">

							<div class="form__cell req-field">
								<div class="form-cell__header">
									<label for="email" class="label text form-cell__title req-label">
										<?php echo get_post_meta(get_the_ID(), 'realgh_form_email_address_label', true); ?>
									</label>
									<p class="text fz-14"><?php echo get_post_meta(get_the_ID(), 'realgh_form_email_address_text_field', true); ?></p>
								</div>
								<input type="email" name="email" value="<?php echo ($_POST['email']); ?>" id="email" class="input input-text" placeholder="<?php echo get_post_meta(get_the_ID(), 'realgh_form_email_address_placeholder', true); ?>">
							</div>

							<div class="form__cell req-field">
								<div class="form-cell__header">
									<label for="time_zone" class="label text form-cell__title req-label"><?php echo get_post_meta(get_the_ID(), 'realgh_form_field_timezone_label', true); ?></label>
								</div>
								<select id="time_zone" name="time_zone" class="input input-text timezone__select">
									<option value selected disabled>Select Timezone</option>
									<?php echo realgh_get_timezones(); ?>
								</select>
							</div>

						</div>
						<!-- END FORM ROW -->


						<div class="form__button-block mobile--fxd-cr">
							<a href="/" class="link button border-button button--big">
								<span class="button-text">
									<?php echo get_post_meta(get_the_ID(), 'realgh_goback_link_text', true); ?>
								</span>
							</a>
							<button data-step="2" id="step-1-btn" type="button" class="button main-button steps__button button--big next register_step_form-1">
								<span class="button-text">
									<?php echo get_post_meta(get_the_ID(), 'realgh_continue_link_text', true); ?>
								</span>
							</button>
						</div>
						<div>
							<p class="text mandatory-text"><?php echo get_post_meta(get_the_ID(), 'realgh_mandatory_field_title', true); ?></p>
						</div>
					</div>
				</form>
				<!-- END FORM 1 -->

				<!-- START FORM 2 -->
				<form id="step-2" class="steps__form tab__item">
					<div class="steps-form__header">
						<h2 class="title steps__title"><?php echo get_post_meta(get_the_ID(), 'realgh_therapist_main_title', true); ?></h2>
					</div>
					<div class="form">
						<!-- START FORM ROW -->
						<div class="form__cell req-field">
							<div class="form-cell__header">
								<label for="psychologist" class="label text form-cell__title req-label">
									<?php echo get_post_meta(get_the_ID(), 'realgh_form_about_me_extended_version_label', true); ?>
								</label>
								<p class="text fz-14"><?php echo get_post_meta(get_the_ID(), 'realgh_form_about_me_extended_version_text_desc', true); ?></p>
							</div>
							<textarea name="psychologist" id="psychologist" class="input input-text textarea textarea--length cus-counter1" maxlength="1000" placeholder="<?php echo get_post_meta(get_the_ID(), 'realgh_form_extend_textarea_placeholder', true); ?>"></textarea>
							<p class="cus-text-limit">
								<span id="current1">0</span>
								<span id="maximum1">/ 1000</span>
							</p>
						</div>
						<!-- END FORM ROW -->

						<!-- START FORM ROW -->
						<div class="form__cell req-field">
							<div class="form-cell__header">
								<label for="phylosophy" class="label text form-cell__title req-label">
									<?php echo get_post_meta(get_the_ID(), 'realgh_form_phylosophy_label', true); ?>
								</label>
								<p class="text fz-14"><?php echo get_post_meta(get_the_ID(), 'realgh_form_phylosophy_label_desc', true); ?></p>
							</div>
							<textarea name="phylosophy" id="phylosophy" class="input input-text textarea textarea--length" maxlength="500" placeholder="<?php echo get_post_meta(get_the_ID(), 'realgh_form_phylosophy_placeholder', true); ?>"></textarea>
						</div>
						<!-- END FORM ROW -->

						<div class="form__button-block mobile--fxd-cr">
							<button data-step="1" type="button" class="button border-button steps__button button--big back">
								<span class="button-text"><?php echo get_post_meta(get_the_ID(), 'realgh_therapist_goback_link_text', true); ?></span>
							</button>
							<button data-step="3" type="button" class="button main-button steps__button button--big next register_step_form-2">
								<span class="button-text"><?php echo get_post_meta(get_the_ID(), 'realgh_therapist_continue_link_text', true); ?></span>
							</button>
						</div>
						<div>
							<p class="text mandatory-text"><?php echo get_post_meta(get_the_ID(), 'realgh_mandatory_field_title', true); ?></p>
						</div>
					</div>
				</form>
				<!-- END FORM 2 -->

				<!-- START FORM 3 -->
				<form id="step-3" class="steps__form tab__item">
					<div class="steps-form__header">
						<h2 class="title steps__title"><?php echo get_post_meta(get_the_ID(), 'realgh_education_main_title', true); ?></h2>
					</div>
					<div class="form">
						<!-- START FORM ROW -->
						<div class="form__cell req-field">
							<div class="form-cell__header">
								<label for="higher_education" class="label text form-cell__title req-label">
									<?php echo get_post_meta(get_the_ID(), 'realgh_higher_education_label', true); ?>
								</label>
								<p class="text c-dark"><?php echo get_post_meta(get_the_ID(), 'realgh_higher_education_label_desc', true); ?></p>
							</div>
							<textarea name="higher_education" id="higher_education" class="input input-text textarea textarea--length" maxlength="500" placeholder="<?php echo get_post_meta(get_the_ID(), 'realgh_higher_education_placeholder', true); ?> "></textarea>
						</div>
						<!-- END FORM ROW -->

						<!-- START FORM ROW -->
						<div class="form__cell req-field">
							<div class="form-cell__header">
								<label for="main_method" class="label text form-cell__title req-label"><?php echo get_post_meta(get_the_ID(), 'realgh_main_method_label', true); ?></label>
							</div>
				
							<div class="form__row" id="form_main_method_wrap">
								<input type="radio" id="step-3_psychoanalytic" value="Psychoanalytic therapy" name="main_method[]" class="check__input">
								<label for="step-3_psychoanalytic" class="label check__label checkbox__label text form__text">Psychoanalytic therapy
								</label>

								<input type="radio" id="step-3_transactional" value="Transactional analysis" name="main_method[]" class="check__input">
								<label for="step-3_transactional" class="label check__label checkbox__label text form__text">Transactional analysis</label>

								<input type="radio" id="step-3_gestalt" value="Gestalt therapy" name="main_method[]" class="check__input">
								<label for="step-3_gestalt" class="label check__label checkbox__label text form__text">Gestalt therapy</label>

								<input type="radio" id="step-3_existential" value="Existential therapy" name="main_method[]" class="check__input">
								<label for="step-3_existential" class="label check__label checkbox__label text form__text">Existential therapy</label>

								<input type="radio" id="step-3_systemic" value="Systemic family approach" name="main_method[]" class="check__input">
								<label for="step-3_systemic" class="label check__label checkbox__label text form__text">Systemic family approach</label>

								<input type="radio" id="step-3_cbt" value="CBT" name="main_method[]" class="check__input">
								<label for="step-3_cbt" class="label check__label checkbox__label text form__text">CBT</label>

								<input type="radio" id="step-3_psychodrama" value="Psychodrama" name="main_method[]" class="check__input">
								<label for="step-3_psychodrama" class="label check__label checkbox__label text form__text">Psychodrama</label>

								<input type="radio" id="step-3_integrative" value="Integrative therapy" name="main_method[]" class="check__input">
								<label for="step-3_integrative" class="label check__label checkbox__label text form__text">Integrative therapy</label>

								<input type="radio" id="step-3_my_main_other" value="Other" name="main_method[]" class="check__input">
								<label for="step-3_my_main_other" class="label check__label checkbox__label text form__text">Other</label>

							</div>
							<div class="form__row">
								<input type="text" name="other_main_method" id="other_main_method" disabled class="input input-text input--req" placeholder="<?php echo get_post_meta(get_the_ID(), 'realgh_form_main_method_placeholder', true); ?>">
							</div>
						</div>
						<!-- END FORM ROW -->

						<!-- START FORM ROW -->
						<div class="form__cell">
							<div class="form-cell__header">
								<label for="basic_education" class="label text form-cell__title">
									<?php echo get_post_meta(get_the_ID(), 'realgh_are_you_studying_your_main_method_label', true); ?>
								</label>
								<p class="text c-dark"><?php echo get_post_meta(get_the_ID(), 'realgh_studying_your_main_method_label_desc', true); ?></p>
							</div>
							<textarea name="basic_education" id="basic_education" class="input input-text textarea textarea--length" maxlength="500" placeholder="<?php echo get_post_meta(get_the_ID(), 'realgh_form-main_method_textarea', true); ?>"></textarea>
						</div>
						<!-- END FORM ROW -->

						<!-- START FORM ROW -->
						<div class="form__cell req-field">
							<div class="form-cell__header">
								<label for="about_main_method" class="label text form-cell__title req-label">	<?php echo get_post_meta(get_the_ID(), 'realgh_form_about_method_label', true); ?>
								</label>
								<p class="text c-dark"><?php echo get_post_meta(get_the_ID(), 'realgh_form_about_method_label_desc', true); ?></p>
							</div>
							<textarea name="about_main_method" id="about_main_method" class="input input-text textarea textarea--length" maxlength="500" placeholder="<?php echo get_post_meta(get_the_ID(), 'realgh_form_about_method_placeholder', true); ?>"></textarea>
						</div>
						<!-- END FORM ROW -->

						<!-- START FORM ROW -->
						<div class="form__cell">
							<div class="form-cell__header">
								<p class="text form-cell__title">
									<?php echo get_post_meta(get_the_ID(), 'realgh_form-additional_education_topics_label', true); ?>
								</p>
							</div>
							<div class="form__row">

								<input type="checkbox" id="step-3_addictions" value="Mandarin" name="languages[]" class="check__input">
								<label for="step-3_addictions" class="label check__label checkbox__label text form__text">Mandarin
								</label>

								<input type="checkbox" id="step-3_sexology" value="Russian" name="languages[]" class="check__input">
								<label for="step-3_sexology" class="label check__label checkbox__label text form__text">Russian</label>

								<input type="checkbox" id="step-3_ptsd" value="Hindi" name="languages[]" class="check__input">
								<label for="step-3_ptsd" class="label check__label checkbox__label text form__text">Hindi</label>

								<input type="checkbox" id="step-3_other" value="Other" name="languages[]" class="check__input">
								<label for="step-3_other" class="label check__label checkbox__label text form__text">Other</label>

								<input type="checkbox" id="step-3_eating" value="Spanish" name="languages[]" class="check__input">
								<label for="step-3_eating" class="label check__label checkbox__label text form__text">Spanish</label>

							</div>
							<div class="form__row">
								<input type="text" name="another_options" id="another_options" disabled class="input input-text input--req" placeholder="<?php echo get_post_meta(get_the_ID(), 'realgh_form_additional_education_topics_placeholder', true); ?>">
							</div>
						</div>
						<!-- END FORM ROW -->

						<!-- START FORM ROW -->
						<div class="form__cell">
							<div class="form-cell__header">
								<p class="text form-cell__title req-label">
									<?php echo get_post_meta(get_the_ID(), 'realgh_form_attach_certification_topics_label', true); ?>
								</p>
							</div>
							<div class="form__select-file req-field">
								<template class="temp__file-card">
									<div class="file__card file-card__media-block">
										<div class="file-card__content">
											<p class="text c-dark file-card__name"></p>
											<p class="text c-grey file-card__size"></p>
										</div>
										<button type="button" class="button transp-button file-card__button">
											<i class="icon realgh-close"></i>
										</button>
									</div>
								</template>
								<input type="file" id="certificates" name="certificates[]" class="input-file" accept=".pdf, .jpg, .jpeg, .png" multiple>
								<input
									type="hidden"
									class="input input-file--path"
									name="certificates_path"
								>
								<label for="certificates" class="label button yellow-button form__file-button cus-profile-upload-label cus-file-upload">
									<span class="button-text"><?php echo get_post_meta(get_the_ID(), 'realgh_form_upload_button_text', true); ?></span>
								</label>
								<p class="text fz-16 file__req-text"><?php echo get_post_meta(get_the_ID(), 'realgh_form_upload_file_desc', true); ?></p>
								<div class="form__file-content"></div>
							</div>
						</div>
						<!-- END FORM ROW -->

						<div class="form__button-block mobile--fxd-cr">
							<button data-step="2" type="button" class="button border-button steps__button button--big back">
								<span class="button-text"><?php echo get_post_meta(get_the_ID(), 'realgh_education_goback_link_text', true); ?></span>
							</button>
							<button data-step="4" type="button" class="button main-button steps__button button--big next register_step_form-3">
								<span class="button-text"><?php echo get_post_meta(get_the_ID(), 'realgh_education_continue_link_text', true); ?></span>
							</button>
						</div>
						<div>
							<p class="text mandatory-text"><?php echo get_post_meta(get_the_ID(), 'realgh_mandatory_field_title', true); ?></p>
						</div>
					</div>
				</form>
				<!-- END FORM 3 -->

				<!-- START FORM 4 -->
				<form id="step-4" class="steps__form tab__item">
					<div class="steps-form__header">
						<h2 class="title steps__title"><?php echo get_post_meta(get_the_ID(), 'realgh_experience_main_title', true); ?></h2>
					</div>
					<div class="form">
						<!-- START FORM ROW -->
						<div class="form__cell req-field">
							<div class="form-cell__header">
								<label for="step-4_years" class="label text form-cell__title req-label">
									<?php echo get_post_meta(get_the_ID(), 'realgh_form_study_cirriculum_label', true); ?>
								</label>
							</div>
							<div class="form__row">
								<input type="number" name="constYears" id="step-4_years" class="input input-text" placeholder="<?php echo get_post_meta(get_the_ID(), 'realgh_form_study_cirriculum_placeholder', true); ?>" min="1">
							</div>
						</div>

						<div class="form__cell">
							<div class="form-cell__header">
								<p class="text form-cell__title req-label">
									<?php echo get_post_meta(get_the_ID(), 'realgh_form_experience_topics_label', true); ?>
								</p>
							</div>
							<div class="form__row req-field" id="form_special_wrap">

								<input type="checkbox" id="special_addictions" value="Addictions" name="specialization[]" class="check__input">
								<label for="special_addictions" class="label check__label checkbox__label text form__text">Addictions</label>

								<input type="checkbox" id="infertility" value="Infertility" name="specialization[]" class="check__input">
								<label for="infertility" class="label check__label checkbox__label text form__text">Infertility</label>

								<input type="checkbox" id="adhd" value="ADHD & Attention Issues" name="specialization[]" class="check__input">
								<label for="adhd" class="label check__label checkbox__label text form__text">ADHD & Attention Issues</label>

								<input type="checkbox" id="intimacy" value="Intimacy" name="specialization[]" class="check__input">
								<label for="intimacy" class="label check__label checkbox__label text form__text">Intimacy</label>

								<input type="checkbox" id="adoption" value="Adoption" name="specialization[]" class="check__input">
								<label for="adoption" class="label check__label checkbox__label text form__text">Adoption</label>

								<input type="checkbox" id="lgbtq" value="LGBTQ" name="specialization[]" class="check__input">
								<label for="lgbtq" class="label check__label checkbox__label text form__text">LGBTQ</label>

								<input type="checkbox" id="agoraphobia" value="Agoraphobia" name="specialization[]" class="check__input">
								<label for="agoraphobia" class="label check__label checkbox__label text form__text">Agoraphobia</label>

								<input type="checkbox" id="life_changes" value="Life Changes" name="specialization[]" class="check__input">
								<label for="life_changes" class="label check__label checkbox__label text form__text">Life Changes</label>

								<input type="checkbox" id="alzheimer" value="Alzheimers" name="specialization[]" class="check__input">
								<label for="alzheimer" class="label check__label checkbox__label text form__text">Alzheimer's</label>

								<input type="checkbox" id="marriage_issues" value="Marriage Issues" name="specialization[]" class="check__input">
								<label for="marriage_issues" class="label check__label checkbox__label text form__text">Marriage Issues</label>

								<input type="checkbox" id="anger_management" value="Anger Management" name="specialization[]" class="check__input">
								<label for="anger_management" class="label check__label checkbox__label text form__text">Anger Management</label>

								<input type="checkbox" id="ocd" value="OCD" name="specialization[]" class="check__input">
								<label for="ocd" class="label check__label checkbox__label text form__text">OCD</label>

								<input type="checkbox" id="anxiety" value="Anxiety" name="specialization[]" class="check__input">
								<label for="anxiety" class="label check__label checkbox__label text form__text">Anxiety</label>

								<input type="checkbox" id="panic_attack" value="Panic Attack" name="specialization[]" class="check__input">
								<label for="panic_attack" class="label check__label checkbox__label text form__text">Panic Attack</label>

								<input type="checkbox" id="asperger_syndrome" value="Aspergers Syndrome" name="specialization[]" class="check__input">
								<label for="asperger_syndrome" class="label check__label checkbox__label text form__text">Asperger's Syndrome</label>

								<input type="checkbox" id="parenting" value="Parenting" name="specialization[]" class="check__input">
								<label for="parenting" class="label check__label checkbox__label text form__text">Parenting</label>

								<input type="checkbox" id="autism" value="Autism" name="specialization[]" class="check__input">
								<label for="autism" class="label check__label checkbox__label text form__text">Autism</label>

								<input type="checkbox" id="phobias" value="Phobias" name="specialization[]" class="check__input">
								<label for="phobias" class="label check__label checkbox__label text form__text">Phobias</label>

								<input type="checkbox" id="bipolar_disorder" value="Bipolar Disorder" name="specialization[]" class="check__input">
								<label for="bipolar_disorder" class="label check__label checkbox__label text form__text">Bipolar Disorder</label>

								<input type="checkbox" id="postnatal_depression" value="Postnatal Depression" name="specialization[]" class="check__input">
								<label for="postnatal_depression" class="label check__label checkbox__label text form__text">Postnatal Depression</label>

								<input type="checkbox" id="boederline_personality" value="Borderline Personality" name="specialization[]" class="check__input">
								<label for="boederline_personality" class="label check__label checkbox__label text form__text">Borderline Personality</label>

								<input type="checkbox" id="procrastination" value="Procrastination" name="specialization[]" class="check__input">
								<label for="procrastination" class="label check__label checkbox__label text form__text">Procrastination</label>

								<input type="checkbox" id="career_difficulties" value="Career Difficulties" name="specialization[]" class="check__input">
								<label for="career_difficulties" class="label check__label checkbox__label text form__text">Career Difficulties</label>

								<input type="checkbox" id="ptsd_special" value="PTSD" name="specialization[]" class="check__input">
								<label for="ptsd_special" class="label check__label checkbox__label text form__text">PTSD</label>

								<input type="checkbox" id="chronic_pain" value="Chronic Pain" name="specialization[]" class="check__input">
								<label for="chronic_pain" class="label check__label checkbox__label text form__text">Chronic Pain</label>

								<input type="checkbox" id="relationship_issues" value="Relationship Issues" name="specialization[]" class="check__input">
								<label for="relationship_issues" class="label check__label checkbox__label text form__text">Relationship Issues</label>

								<input type="checkbox" id="compassion_fatigue" value="Compassion Fatigue" name="specialization[]" class="check__input">
								<label for="compassion_fatigue" class="label check__label checkbox__label text form__text">Compassion Fatigue</label>

								<input type="checkbox" id="self_esteem" value="Self Esteem" name="specialization[]" class="check__input">
								<label for="self_esteem" class="label check__label checkbox__label text form__text">Self Esteem</label>

								<input type="checkbox" id="depression" value="Depression" name="specialization[]" class="check__input">
								<label for="depression" class="label check__label checkbox__label text form__text">Depression</label>

								<input type="checkbox" id="sex_sexuality" value="Sex & Sexuality" name="specialization[]" class="check__input">
								<label for="sex_sexuality" class="label check__label checkbox__label text form__text">Sex & Sexuality</label>


								<input type="checkbox" id="divorce" value="Divorce" name="specialization[]" class="check__input">
								<label for="divorce" class="label check__label checkbox__label text form__text">Divorce</label>

								<input type="checkbox" id="sleep_or_insomnia" value="Sleep or Insomnia" name="specialization[]" class="check__input">
								<label for="sleep_or_insomnia" class="label check__label checkbox__label text form__text">Sleep or Insomnia</label>


								<input type="checkbox" id="domestic_violence" value="Domestic Violence" name="specialization[]" class="check__input">
								<label for="domestic_violence" class="label check__label checkbox__label text form__text">Domestic Violence</label>

								<input type="checkbox" id="social_anxiety" value="Social Anxiety" name="specialization[]" class="check__input">
								<label for="social_anxiety" class="label check__label checkbox__label text form__text">Social Anxiety</label>


								<input type="checkbox" id="eating_food" value="Eating & Food Disorders" name="specialization[]" class="check__input">
								<label for="eating_food" class="label check__label checkbox__label text form__text">Eating & Food Disorders</label>

								<input type="checkbox" id="speech_anxiety" value="speech_anxiety" name="specialization[]" class="check__input">
								<label for="speech_anxiety" class="label check__label checkbox__label text form__text">Speech Anxiety</label>


								<input type="checkbox" id="family_issues" value="Family Issues" name="specialization[]" class="check__input">
								<label for="family_issues" class="label check__label checkbox__label text form__text">Family Issues</label>

								<input type="checkbox" id="stress" value="Stress" name="specialization[]" class="check__input">
								<label for="stress" class="label check__label checkbox__label text form__text">Stress</label>

								<input type="checkbox" id="gad" value="GAD" name="specialization[]" class="check__input">
								<label for="gad" class="label check__label checkbox__label text form__text">GAD</label>

								<input type="checkbox" id="trauma_abuse" value="Trauma and or Abuse" name="specialization[]" class="check__input">
								<label for="trauma_abuse" class="label check__label checkbox__label text form__text">Trauma and/or Abuse</label>


								<input type="checkbox" id="grief" value="Grief" name="specialization[]" class="check__input">
								<label for="grief" class="label check__label checkbox__label text form__text">Grief</label>

								<input type="checkbox" id="weight_loss" value="Weight Loss" name="specialization[]" class="check__input">
								<label for="weight_loss" class="label check__label checkbox__label text form__text">Weight Loss</label>


								<input type="checkbox" id="helth_anxiety" value="Health Anxiety" name="specialization[]" class="check__input">
								<label for="helth_anxiety" class="label check__label checkbox__label text form__text">Health Anxiety</label>


							</div>
						</div>
						<!-- END FORM ROW -->

						<!-- START FORM ROW -->

						<div class="form__cell">
							<div class="form-cell__header">
								<p class="text form-cell__title req-label">
									<?php echo get_post_meta(get_the_ID(), 'realgh_form_i-work-with_label', true); ?>
								</p>
							</div>
							<div class="form__row req-field">

								<input type="checkbox" id="adults" value="adults" name="work_with[]" class="check__input">
								<label for="adults" class="label check__label checkbox__label text form__text">Adults</label>

								<input type="checkbox" id="children" value="children" name="work_with[]" class="check__input">
								<label for="children" class="label check__label checkbox__label text form__text">Children</label>

								<input type="checkbox" id="teenagers" value="teenagers" name="work_with[]" class="check__input">
								<label for="teenagers" class="label check__label checkbox__label text form__text">Teenagers</label>

								<input type="checkbox" id="couples" value="couples" name="work_with[]" class="check__input">
								<label for="couples" class="label check__label checkbox__label text form__text">Couples</label>

								<input type="checkbox" id="families" value="families" name="work_with[]" class="check__input">
								<label for="families" class="label check__label checkbox__label text form__text">Families</label>

							</div>
						</div>
						<!-- END FORM ROW -->

						<div class="form__button-block mobile--fxd-cr">
							<button data-step="3" type="button" class="button border-button steps__button button--big back">
								<span class="button-text"><?php echo get_post_meta(get_the_ID(), 'realgh_experience_goback_link_text', true); ?></span>
							</button>
							<button data-step="5" type="button" class="button main-button steps__button button--big next register_step_form-4">
								<span class="button-text"><?php echo get_post_meta(get_the_ID(), 'realgh_experience_continue_link_text', true); ?></span>
							</button>
						</div>

						<div>
							<p class="text mandatory-text"><?php echo get_post_meta(get_the_ID(), 'realgh_mandatory_field_title', true); ?></p>
						</div>
					</div>
				</form>
				<!-- END FORM 4 -->

				<!-- START FORM 5 -->
				<form id="step-5" class="steps__form tab__item">
					<div class="steps-form__header">
						<h2 class="title steps__title"><?php echo get_post_meta(get_the_ID(), 'realgh_videointro_main_title', true); ?></h2>
						<p class="text c-dark"><?php echo get_post_meta(get_the_ID(), 'realgh_videointro_title_desc', true); ?></p>
					</div>
					<div class="form">
						<?php

						$uploadLinkArr = get_post_meta(get_the_ID(), 'realgh_video_desc_repeter', true);
						if (!empty($uploadLinkArr)) {
							echo '<ul class="list">';
							foreach ($uploadLinkArr as $key => $value) {
								echo '<li class="list__item text">' . $value['realgh_video_desc_item'] . '</li>';
							}
							echo '</ul>';
						}

						?>
						<!-- START FORM ROW -->
						<div class="form__select-file">
							<template class="temp__file-card">
								<div class="single-file__card">
									<div class="file-card__media-block">
										<button type="button" class="button transp-button single-file__card-button file-card__button">
											<i class="icon realgh-close"></i>
										</button>
									</div>
									<div class="file-card__content">
										<p class="text c-dark file-card__name"></p>
										<p class="text c-grey file-card__size"></p>
									</div>
								</div>
							</template>
							<input type="file" name="intro_video" class="input-file" id="intro_video" accept="video/mp4, video/x-m4v, video/quicktime">
							<input
								type="hidden"
								class="input input-file--path"
								name="intro_video_path"
							>
							<label for="intro_video" class="label button yellow-button form__file-button">
								<span class="button-text"><?php echo get_post_meta(get_the_ID(), 'realgh_form_upload_button_text', true); ?></span>
							</label>
							<p class="text fz-16 file__req-text"><?php echo get_post_meta(get_the_ID(), 'realgh_form_upload_video_file_desc', true); ?></p>
							<div class="form__file-content"></div>
						</div>
						<!-- END FORM ROW -->

						<!-- START FORM ROW -->
						<div class="form__cell">
							<div class="form__cell">
								<input type="checkbox" id="warning" value="1" name="warning" class="check__input">
								<label for="warning" class="label check__label checkbox__label text form__text">
									<?php echo get_post_meta(get_the_ID(), 'realgh_videointro_checkbox_desc_1', true); ?>
								</label>
							</div>
							<div class="form__cell req-field">
								<input type="checkbox" id="confirmation" value="1" name="confirm" class="check__input">
								<label for="confirmation" class="label check__label checkbox__label text form__text d-block">
									<?php echo get_post_meta(get_the_ID(), 'realgh_videointro_checkbox_desc_2', true); ?>
								</label>
							</div>
						</div>
						<!-- END FORM ROW -->

						<div class="form__button-block mobile--fxd-cr">
							<button data-step="4" type="button" class="button border-button steps__button button--big back">
								<span class="button-text"><?php echo get_post_meta(get_the_ID(), 'realgh_videointro_goback_link_text', true); ?></span>
							</button>
							<button class="button main-button button--big" id="submitFormTyrpiest">
								<span class="button-text"><?php echo get_post_meta(get_the_ID(), 'realgh_videointro_submit_link_text', true); ?></span>
							</button>
						</div>
						<div id="loader" class="loader-wrap is-active" style="display:none;">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/booking/blue_spinner.gif" class="pay_loader" alt="blue_spinner">
						</div>
					</div>
				</form>
				<!-- END FORM 5 -->

			</div>
		</div>
	</section>
</main>
<?php get_footer(); ?>