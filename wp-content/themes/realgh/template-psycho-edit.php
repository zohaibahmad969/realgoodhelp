
<main class="main js-padding">
	<div class="wrapper">
	<?php echo get_warning_banner(); ?>
		<form class="section-alt aside__container grid edit-prof__form" method="POST" enctype="multipart/form-data">
			<div class="aside grid__column grid">
				<div class="card dashboard__card">
					<!-- START COLUMN CARD -->
					<div class="card__content psycho-edit__card-content form__image-cell req-field">
						<div class="card__content flex--ai-c">
							<p class="subtitle psycho-edit__name--top fz-22">
								<?php echo  $current_user->first_name . ' ' . $current_user->last_name ?>
							</p>
							<?php
							$userImg = $user_additional_data->user_profile_pic;
							if (!$userImg) {
								if (get_avatar_url($current_user->ID)) {
									$userImg = get_avatar_url($current_user->ID);
								} else {
									$userImg = get_template_directory_uri() . "/assets/img/dummy-profile-image.png";
								}
							}
							
							?>
							<input type="file" id="prfilePic" name="prfilePic" class="input-file" accept="image/png, image/jpeg, image/bmp">
							<input
								type="hidden"
								class="input input-file--path"
								name="avatar_path"
								value="<?php echo $userImg; ?>"
							>
							<label for="prfilePic" class="label avatar psycho-edit__avatar">
								<img src="<?php echo $userImg; ?>" alt="Avatar" class="img" id="userUplodaedPic">
							</label>
							<label for="prfilePic" id="upldPic" class="button yellow-button">
								<span class="button-text"><?php echo get_post_meta(get_the_ID(), 'realgh_upload_btn_text', true); ?></span>
							</label>
						</div>
						<div class="card__content psycho-edit__card-info">
							<p class="subtitle psycho-edit__name--right fz-22">
								<?php echo  $current_user->first_name . ' ' . $current_user->last_name ?>
							</p>
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
								<p class="text fz-14"><?php echo get_post_meta(get_the_ID(), 'realgh_upload_link_list_text', true); ?> </p>
							</div>
							<!-- <p class="text fz-14">Member Since: <span class="fw-600"><?php $date = date_create($current_user->user_registered); echo date_format($date, "d F Y"); ?></span></p> -->
						</div>
					</div>
					<!-- END COLUMN CARD -->
				</div>
			</div>
			<div class="grid__content">
				<div class="card dashboard__card card__content psycho-edit__card mobile-card--p-0">
					<h1 class="subtitle"><?php echo get_post_meta(get_the_ID(), 'realgh_profile_info_main_title', true); ?></h1>
					<div class="tabs-container">
						<div class="tabs psycho-edit__tabs">
							<input data-tab-item="user" type="radio" name="edit" id="user-tab" class="tab" checked>
							<label for="user-tab" class="label tab-label subtitle fz-16 psycho-edit__tab-label">
								<?php echo get_post_meta(get_the_ID(), 'realgh_user_info_main_title', true); ?>
							</label>

							<input data-tab-item="questionnaire" type="radio" name="edit" id="questionnaire-tab" class="tab">
							<label for="questionnaire-tab" class="label tab-label subtitle fz-16 psycho-edit__tab-label">
								<?php echo get_post_meta(get_the_ID(), 'realgh_therapist_main_title', true); ?>
							</label>

							<input data-tab-item="my_prices" type="radio" name="edit" id="my_prices-tab" class="tab">
							<label for="my_prices-tab" class="label tab-label subtitle fz-16 psycho-edit__tab-label">
								<?php echo get_post_meta(get_the_ID(), 'realgh_prices_info_main_title', true); ?>
							</label>
						</div>
						<div class="tabs__content">

							<!-- START USER TAB CONTENT -->
							<div id="user" class="tab__item form active">
								<div class="form__cell">
									<?php if(isset($response['error'])){ ?>
										<p class="subtitle fz-16 error-message"><?php echo $response['error']; ?></p>
									<?php } else if(isset($response['success'])){ ?>
										<p class="subtitle fz-16 success-message"><?php echo $response['success']; ?></p>
									<?php } ?>
									<div class="form__row">
										<div class="form__cell req-field">
											<label for="name" class="label text form-cell__title req-label">
												<?php echo get_post_meta(get_the_ID(), 'realgh_form_field_fname_label', true); ?>
											</label>
											<input
												type="text"
												name="fname"
												class="input input-text"
												value="<?php echo $current_user->first_name; ?>"
												placeholder="<?php echo get_post_meta(get_the_ID(), 'realgh_form_field_fname_placeholder', true); ?>"
											>
										</div>

										<div class="form__cell req-field">
											<label for="name" class="label text form-cell__title req-label">
												<?php echo get_post_meta(get_the_ID(), 'realgh_form_field_sname_label', true); ?>
											</label>
											<input
												type="text"
												name="lname"
												class="input input-text"
												value="<?php echo $current_user->last_name; ?>"
												placeholder="<?php echo get_post_meta(get_the_ID(), 'realgh_form_field_sname_placeholder', true); ?>"
											>
										</div>

									</div>
									<div class="form__row">
										<div class="form__cell req-field">
											<label for="birth" class="label text form-cell__title req-label">
												<?php echo get_post_meta(get_the_ID(), 'realgh_form_field_dob_label', true); ?>
											</label>
											<input
												type="text"
												name="dob"
												id="datepicker"
												value="<?php $date = date_create($user_additional_data->date_of_birth);
											echo date_format($date, "Y-m-d"); ?>"
												class="input input-text datepicker_dob"
												placeholder="<?php echo get_post_meta(get_the_ID(), 'realgh_form_field_dob_placeholder', true); ?>" readonly="readonly"
											>
										</div>

										<div class="form__cell req-field">
											<label for="country" class="label text form-cell__title req-label">
												<?php echo get_post_meta(get_the_ID(), 'realgh_form_field_residence_label', true); ?>	
											</label>
											<?php $countryList = country_array(); ?>
											<select name="country" class="input input-text">
												<option value="">Country of residence</option>
												<?php foreach ($countryList as $key => $single_country): ?>
													<option
														<?php if ($key == $user_additional_data->country) { ?> selected="selected" <?php } ?>
														value="<?php echo $key; ?>"
													>
														<?php echo $single_country; ?>
													</option>
												<?php endforeach; ?>
											</select>
										</div>


									</div>
									<div class="form__row">
										<div class="form__cell req-field">
											<label for="email" class="label text form-cell__title req-label">
												<?php echo get_post_meta(get_the_ID(), 'realgh_form_select-timezone_label', true); ?>
											</label>
											<select name="time_zone" class="input input-text timezone__select">
												<option value selected disabled>Select Timezone</option>
												<?php echo realgh_get_timezones('str', $user_additional_data->time_zone); ?>
											</select>
										</div>
										
										<div class="form__cell req-field">
											<label for="email" class="label text form-cell__title req-label">
												<?php echo get_post_meta(get_the_ID(), 'realgh_form_email_address_label', true); ?>
											</label>
											<input
												type="text"
												name="email"
												value="<?php echo $current_user->user_email; ?>"
												class="input input-text"
												placeholder="<?php echo get_post_meta(get_the_ID(), 'realgh_form_email_address_placeholder', true); ?>"
											>
										</div>
										
									</div>
								</div>
								<div class="form__row">
									<div class="form__cell req-field">
										<label for="phone" class="label text form-cell__title req-label">
											<?php echo get_post_meta(get_the_ID(), 'realgh_form_phone_number_label', true); ?>
										</label>
										<input
											type="text"
											name="phone"
											value="<?php echo $user_additional_data->phone; ?>"
											class="input input-text"
											placeholder="<?php echo get_post_meta(get_the_ID(), 'realgh_form_field_phone_number_placeholder', true); ?>"
										>
									</div>
								</div>
									
								<div class="form__row">
									<div class="form__cell">
										<label for="password" class="label text form-cell__title"><?php echo get_post_meta(get_the_ID(), 'realgh_form_password_label', true); ?></label>
											<input type="password" name="password" minlength="8" autocomplete="new-password" class="input input-text" placeholder="<?php echo get_post_meta(get_the_ID(), 'realgh_form_password_label_placeholder', true); ?>">
										<a href="/" class="link text c-main"><?php echo get_post_meta(get_the_ID(), 'realgh_form_password-change_link', true); ?></a>
									</div>

									<div class="form__cell">
										<label for="confirm_password" class="label text form-cell__title"><?php echo get_post_meta(get_the_ID(), 'realgh_form_conform_password_label', true); ?></label>
											<input type="password" name="confirm_password" minlength="8" class="input input-text" placeholder="<?php echo get_post_meta(get_the_ID(), 'realgh_form_conform_password_label_placeholder', true); ?>">
										<a href="/" class="link text c-main"><?php echo get_post_meta(get_the_ID(), 'realgh_form_conform_password-change_link', true); ?></a>
									</div>

								</div>
							</div>
							<!-- END USER TAB CONTENT -->


							<!-- START QUEST TAB CONTENT -->
							<div id="questionnaire" class="tab__item form">
								<div class="form__cell">
									<p class="subtitle fz-20"><?php echo get_post_meta(get_the_ID(), 'realgh_therapist_info_title', true); ?></p>

									<!-- START FORM ROW -->
									<div class="form__cell req-field">
										<div class="form-cell__header">
											<label for="about_myself" class="label text form-cell__title req-label">
												<?php echo get_post_meta(get_the_ID(), 'realgh_form_about_me_extended_version_label', true); ?>
											</label>
											<p class="text fz-14"><?php echo get_post_meta(get_the_ID(), 'realgh_form_about_me_extended_version_text_desc', true); ?></p>
										</div>
										<textarea
											name="about_myself"
											id="about_myself"
											class="input input-text textarea textarea--length cus-counter1"
											maxlength="1000"
											placeholder="Write about yourself"
										><?php echo esc_attr($user_additional_data->about_myself); ?></textarea>
										<p class="cus-text-limit"><span id="current1">0</span>
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
										<textarea
											name="phylosophy"
											id="phylosophy"
											class="input input-text textarea textarea--length cus-counter2"
											maxlength="500"
											placeholder="<?php echo get_post_meta(get_the_ID(), 'realgh_form_phylosophy_placeholder', true); ?>"
										><?php echo esc_attr($user_additional_data->phylosophy); ?></textarea>
									</div>
									<!-- END FORM ROW -->

									<!-- START FORM ROW -->
									<div class="form__cell req-field">
										<div class="form-cell__header">
											<label for="higher_education" class="label text form-cell__title req-label">
												<?php echo get_post_meta(get_the_ID(), 'realgh_higher_education_label', true); ?>
											</label>
											<p class="text c-dark"><?php echo get_post_meta(get_the_ID(), 'realgh_higher_education_label_desc', true); ?></p>
										</div>
										<textarea
											name="higher_education"
											id="higher_education"
											class="input input-text textarea textarea--length"
											maxlength="500"
											placeholder="<?php echo get_post_meta(get_the_ID(), 'realgh_higher_education_placeholder', true); ?>"
										><?php echo esc_attr($user_additional_data->higher_education); ?></textarea>
									</div>
									<!-- END FORM ROW -->

									<!-- START FORM ROW -->
									<div class="form__cell">
										<div class="form-cell__header">
											<label for="main_method" class="label text form-cell__title req-label">
												<?php echo get_post_meta(get_the_ID(), 'realgh_main_method_label', true); ?>
											</label>
										</div>

										<div class="form__row req-field" id="form_main_method_wrap">
											<?php $main_method =  unserialize($user_additional_data->main_method); ?>
											<input type="radio" id="psychoanalytic" value="Psychoanalytic therapy" name="main_method[]" class="check__input" <?php if (!empty($main_method) && in_array("Psychoanalytic therapy", $main_method)) echo "checked"; ?>>
											<label for="psychoanalytic" class="label check__label checkbox__label text form__text">Psychoanalytic therapy
											</label>

											<input type="radio" id="transactional" value="Transactional analysis" name="main_method[]" class="check__input" <?php if (!empty($main_method) && in_array("Transactional analysis", $main_method)) echo "checked"; ?>>
											<label for="transactional" class="label check__label checkbox__label text form__text">Transactional analysis</label>

											<input type="radio" id="gestalt" value="Gestalt therapy" name="main_method[]" class="check__input" <?php if (!empty($main_method) && in_array("Gestalt therapy", $main_method)) echo "checked"; ?>>
											<label for="gestalt" class="label check__label checkbox__label text form__text">Gestalt therapy</label>

											<input type="radio" id="existential" value="Existential therapy" name="main_method[]" class="check__input" <?php if (!empty($main_method) && in_array("Existential therapy", $main_method)) echo "checked"; ?>>
											<label for="existential" class="label check__label checkbox__label text form__text">Existential therapy</label>

											<input type="radio" id="systemic" value="Systemic family approach" name="main_method[]" class="check__input" <?php if (!empty($main_method) && in_array("Systemic family approach", $main_method)) echo "checked"; ?>>
											<label for="systemic" class="label check__label checkbox__label text form__text">Systemic family approach</label>

											<input type="radio" id="cbt" value="CBT" name="main_method[]" class="check__input" <?php if (!empty($main_method) && in_array("CBT", $main_method)) echo "checked"; ?>>
											<label for="cbt" class="label check__label checkbox__label text form__text">CBT</label>

											<input type="radio" id="psychodrama" value="Psychodrama" name="main_method[]" class="check__input" <?php if (!empty($main_method) && in_array("Psychodrama", $main_method)) echo "checked"; ?>>
											<label for="psychodrama" class="label check__label checkbox__label text form__text">Psychodrama</label>

											<input type="radio" id="integrative" value="Integrative therapy" name="main_method[]" class="check__input" <?php if (!empty($main_method) && in_array("Integrative therapy", $main_method)) echo "checked"; ?>>
											<label for="integrative" class="label check__label checkbox__label text form__text">Integrative therapy</label>

											<input type="radio" id="step-3_my_main_other" value="Other" name="main_method[]" class="check__input" <?php if (!empty($main_method) && in_array("Other", $main_method)) echo "checked"; ?>>
											<label for="step-3_my_main_other" class="label check__label checkbox__label text form__text" <?php if ($main_method && $main_method == "Other") echo "checked"; ?>>Other</label>
										</div>

										<div class="form__row">
											<input type="text" name="other_main_method" id="other_main_method" readonly class="input input-text" value="<?php echo $user_additional_data->other_main_method; ?>" placeholder="<?php echo get_post_meta(get_the_ID(), 'realgh_form_main_method_placeholder', true); ?>">
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
										<textarea
											name="basic_education"
											id="basic_education"
											class="input input-text textarea textarea--length"
											maxlength="500"
											placeholder="<?php echo get_post_meta(get_the_ID(), 'realgh_form-main_method_textarea', true); ?>"
										><?php echo esc_attr($user_additional_data->basic_education); ?></textarea>
									</div>
									<!-- END FORM ROW -->

									<!-- START FORM ROW -->
									<div class="form__cell req-field">
										<div class="form-cell__header">
											<label for="about_main_method" class="label text form-cell__title req-label">
												<?php echo get_post_meta(get_the_ID(), 'realgh_form_about_method_label', true); ?>
											</label>
											<p class="text c-dark"><?php echo get_post_meta(get_the_ID(), 'realgh_form_about_method_label_desc', true); ?></p>
										</div>
										<textarea
											name="about_main_method"
											id="about_main_method"
											class="input input-text textarea textarea--length"
											maxlength="500"
											placeholder="<?php echo get_post_meta(get_the_ID(), 'realgh_form_about_method_placeholder', true); ?>"
										><?php echo ($user_additional_data->about_main_method); ?></textarea>
									</div>
									<!-- END FORM ROW -->

									<!-- START FORM ROW -->
									<div class="form__cell">
										<div class="form-cell__header">
											<p class="text form-cell__title"><?php echo get_post_meta(get_the_ID(), 'realgh_form-additional_education_topics_label', true); ?></p>
										</div>
										<div class="form__row">
											<?php $languages =  unserialize($user_additional_data->languages); ?>
											<input type="checkbox" id="Mandarin" value="Mandarin" name="languages[]" class="check__input" <?php if (!empty($languages) && in_array("Mandarin", $languages)) echo "checked"; ?>>
											<label for="Mandarin" class="label check__label checkbox__label text form__text">Mandarin
											</label>

											<input type="checkbox" id="Russian" value="Russian" name="languages[]" class="check__input" <?php if (!empty($languages) && in_array("Russian", $languages)) echo "checked"; ?>>
											<label for="Russian" class="label check__label checkbox__label text form__text">Russian</label>

											<input type="checkbox" id="Hindi" value="Hindi" name="languages[]" class="check__input" <?php if (!empty($languages) && in_array("Hindi", $languages)) echo "checked"; ?>>
											<label for="Hindi" class="label check__label checkbox__label text form__text">Hindi</label>

											<input type="checkbox" id="step-3_other" value="Other" name="languages[]" class="check__input" <?php if (!empty($languages) && in_array("Other", $languages)) echo "checked"; ?>>
											<label for="step-3_other" class="label check__label checkbox__label text form__text" <?php if ($languages && $languages  == "Other") echo "checked"; ?>>Other</label>

											<input type="checkbox" id="Spanish" value="Spanish" name="languages[]" class="check__input" <?php if (!empty($languages) && in_array("Spanish", $languages)) echo "checked"; ?>>
											<label for="Spanish" class="label check__label checkbox__label text form__text">Spanish</label>

										</div>
										<div class="form__row">
											<input type="text" name="additional_option" id="another_options" disabled class="input input-text" value="<?php echo $user_additional_data->another_options; ?>" placeholder="<?php echo get_post_meta(get_the_ID(), 'realgh_form_additional_education_topics_placeholder', true); ?>">
										</div>
									</div>
									<!-- END FORM ROW -->

									<!-- START FORM ROW -->
									<div class="form__cell">
										<div class="form-cell__header">
											<p class="text form-cell__title"><?php echo get_post_meta(get_the_ID(), 'realgh_form_attach_certification_topics_label', true); ?></p>
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

											<?php $files = $user_additional_data->uploaded_certificates; ?>
											<input type="file" id="certificates" name="certificates[]" class="input-file" accept=".pdf, .jpg, .jpeg, .png" multiple>
											<input
												type="hidden"
												class="input input-file--path <?php echo $files ? 'filled' : ''; ?>"
												name="certificates_path"
												value="<?php echo $files; ?>"
											>
											<label for="certificates" class="label button yellow-button form__file-button cus-profile-upload-label cus-file-upload">
												<span class="button-text"><?php echo get_post_meta(get_the_ID(), 'realgh_form_upload_button_text', true); ?></span>
											</label>

											<div class="form__file-content">
											<?php
											if($files):
												$certificate_image = explode(",", $files);
												foreach ($certificate_image as $single_certificate_image):
													$file_info = pathinfo($single_certificate_image);
													$file_path = esc_attr($single_certificate_image); 
													if ($file_info['extension'] == 'pdf') {
														$file_path = get_template_directory_uri() . '/assets/img/icons/pdf.svg';
													}
													?>
													<div class="file__card file-card__media-block">
														<img
															src="<?php echo $file_path; ?>"
															class="img file-card__img"
															alt="File image"
														>
													</div>
													<?php
												endforeach;
											endif;
											?>
											</div>
										</div>
									</div>
									<!-- END FORM ROW -->

									<div class="form__cell req-field">
										<div class="form-cell__header">
											<label for="step-4_years" class="label text form-cell__title req-label">
												<?php echo get_post_meta(get_the_ID(), 'realgh_form_study_cirriculum_label', true); ?>
											</label>
										</div>
										<div class="form__row">
											<input
												type="number"
												name="constYears"
												id="step-4_years"
												min="0"
												class="input input-text"
												placeholder="<?php echo get_post_meta(get_the_ID(), 'realgh_form_study_cirriculum_placeholder', true); ?>"
												value="<?php echo esc_attr($user_additional_data->experience); ?>"
											>
										</div>
									</div>


									<div class="form__cell">
										<div class="form-cell__header">
											<p class="text form-cell__title req-label">
												<?php echo get_post_meta(get_the_ID(), 'realgh_form_experience_topics_label', true); ?>
											</p>
										</div>
										<div class="form__row req-field" id="form_special_wrap">
											<?php $specialization =  unserialize($user_additional_data->specialization); ?>
											<input type="checkbox" id="special_addictions" value="Addictions" name="specialization[]" <?php if (!empty($specialization) && in_array("Addictions", $specialization)) echo "checked"; ?> class="check__input">
											<label for="special_addictions" class="label check__label checkbox__label text form__text">Addictions</label>

											<input type="checkbox" id="infertility" value="Infertility" name="specialization[]" <?php if (!empty($specialization) && in_array("Infertility", $specialization)) echo "checked"; ?> class="check__input">
											<label for="infertility" class="label check__label checkbox__label text form__text">Infertility</label>

											<input type="checkbox" id="adhd" value="ADHD & Attention Issues" name="specialization[]" <?php if (!empty($specialization) && in_array("adhd", $specialization)) echo "checked"; ?> class="check__input">
											<label for="adhd" class="label check__label checkbox__label text form__text">ADHD & Attention Issues</label>

											<input type="checkbox" id="intimacy" value="Intimacy" name="specialization[]" <?php if (!empty($specialization) && in_array("Intimacy", $specialization)) echo "checked"; ?> class="check__input">
											<label for="intimacy" class="label check__label checkbox__label text form__text">Intimacy</label>

											<input type="checkbox" id="adoption" value="Adoption" name="specialization[]" <?php if (!empty($specialization) && in_array("Adoption", $specialization)) echo "checked"; ?> class="check__input">
											<label for="adoption" class="label check__label checkbox__label text form__text">Adoption</label>

											<input type="checkbox" id="lgbtq" value="LGBTQ" name="specialization[]" <?php if (!empty($specialization) && in_array("LGBTQ", $specialization)) echo "checked"; ?> class="check__input">
											<label for="lgbtq" class="label check__label checkbox__label text form__text">LGBTQ</label>

											<input type="checkbox" id="agoraphobia" value="Agoraphobia" name="specialization[]" <?php if (!empty($specialization) && in_array("Agoraphobia", $specialization)) echo "checked"; ?> class="check__input">
											<label for="agoraphobia" class="label check__label checkbox__label text form__text">Agoraphobia</label>

											<input type="checkbox" id="life_changes" value="Life Changes" name="specialization[]" <?php if (!empty($specialization) && in_array("Life Changes", $specialization)) echo "checked"; ?> class="check__input">
											<label for="life_changes" class="label check__label checkbox__label text form__text">Life Changes</label>

											<input type="checkbox" id="alzheimer" value="Alzheimers" name="specialization[]" <?php if (!empty($specialization) && in_array("Alzheimers", $specialization)) echo "checked"; ?> class="check__input">
											<label for="alzheimer" class="label check__label checkbox__label text form__text">Alzheimer's</label>

											<input type="checkbox" id="marriage_issues" value="Marriage Issues" name="specialization[]" <?php if (!empty($specialization) && in_array("Marriage Issues", $specialization)) echo "checked"; ?> class="check__input">
											<label for="marriage_issues" class="label check__label checkbox__label text form__text">Marriage Issues</label>

											<input type="checkbox" id="anger_management" value="Anger Management" name="specialization[]" <?php if (!empty($specialization) && in_array("Anger Management", $specialization)) echo "checked"; ?> class="check__input">
											<label for="anger_management" class="label check__label checkbox__label text form__text">Anger Management</label>

											<input type="checkbox" id="ocd" value="OCD" name="specialization[]" <?php if (!empty($specialization) && in_array("OCD", $specialization)) echo "checked"; ?> class="check__input">
											<label for="ocd" class="label check__label checkbox__label text form__text">OCD</label>

											<input type="checkbox" id="anxiety" value="Anxiety" name="specialization[]" <?php if (!empty($specialization) && in_array("Anxiety", $specialization)) echo "checked"; ?> class="check__input">
											<label for="anxiety" class="label check__label checkbox__label text form__text">Anxiety</label>

											<input type="checkbox" id="panic_attack" value="Panic Attack" name="specialization[]" <?php if (!empty($specialization) && in_array("Panic Attack", $specialization)) echo "checked"; ?> class="check__input">
											<label for="panic_attack" class="label check__label checkbox__label text form__text">Panic Attack</label>

											<input type="checkbox" id="asperger_syndrome" value="Aspergers Syndrome" name="specialization[]" <?php if (!empty($specialization) && in_array("Aspergers Syndrome", $specialization)) echo "checked"; ?> class="check__input">
											<label for="asperger_syndrome" class="label check__label checkbox__label text form__text">Asperger's Syndrome</label>

											<input type="checkbox" id="parenting" value="Parenting" name="specialization[]" <?php if (!empty($specialization) && in_array("Parenting", $specialization)) echo "checked"; ?> class="check__input">
											<label for="parenting" class="label check__label checkbox__label text form__text">Parenting</label>

											<input type="checkbox" id="autism" value="Autism" name="specialization[]" <?php if (!empty($specialization) && in_array("Autism", $specialization)) echo "checked"; ?> class="check__input">
											<label for="autism" class="label check__label checkbox__label text form__text">Autism</label>

											<input type="checkbox" id="phobias" value="Phobias" name="specialization[]" <?php if (!empty($specialization) && in_array("Phobias", $specialization)) echo "checked"; ?> class="check__input">
											<label for="phobias" class="label check__label checkbox__label text form__text">Phobias</label>

											<input type="checkbox" id="bipolar_disorder" value="Bipolar Disorder" name="specialization[]" <?php if (!empty($specialization) && in_array("Bipolar Disorder", $specialization)) echo "checked"; ?> class="check__input">
											<label for="bipolar_disorder" class="label check__label checkbox__label text form__text">Bipolar Disorder</label>

											<input type="checkbox" id="postnatal_depression" value="Postnatal Depression" name="specialization[]" <?php if (!empty($specialization) && in_array("Postnatal Depression", $specialization)) echo "checked"; ?> class="check__input">
											<label for="postnatal_depression" class="label check__label checkbox__label text form__text">Postnatal Depression</label>

											<input type="checkbox" id="boederline_personality" value="Borderline Personality" name="specialization[]" <?php if (!empty($specialization) && in_array("Borderline Personality", $specialization)) echo "checked"; ?> class="check__input">
											<label for="boederline_personality" class="label check__label checkbox__label text form__text">Borderline Personality</label>

											<input type="checkbox" id="procrastination" value="Procrastination" name="specialization[]" <?php if (!empty($specialization) && in_array("Procrastination", $specialization)) echo "checked"; ?> class="check__input">
											<label for="procrastination" class="label check__label checkbox__label text form__text">Procrastination</label>

											<input type="checkbox" id="career_difficulties" value="Career Difficulties" name="specialization[]" <?php if (!empty($specialization) && in_array("Career Difficulties", $specialization)) echo "checked"; ?> class="check__input">
											<label for="career_difficulties" class="label check__label checkbox__label text form__text">Career Difficulties</label>

											<input type="checkbox" id="ptsd_special" value="PTSD" name="specialization[]" <?php if (!empty($specialization) && in_array("PTSD", $specialization)) echo "checked"; ?> class="check__input">
											<label for="ptsd_special" class="label check__label checkbox__label text form__text">PTSD</label>

											<input type="checkbox" id="chronic_pain" value="Chronic Pain" name="specialization[]" <?php if (!empty($specialization) && in_array("Chronic Pain", $specialization)) echo "checked"; ?> class="check__input">
											<label for="chronic_pain" class="label check__label checkbox__label text form__text">Chronic Pain</label>

											<input type="checkbox" id="relationship_issues" value="Relationship Issues" name="specialization[]" <?php if (!empty($specialization) && in_array("Relationship Issues", $specialization)) echo "checked"; ?> class="check__input">
											<label for="relationship_issues" class="label check__label checkbox__label text form__text">Relationship Issues</label>

											<input type="checkbox" id="compassion_fatigue" value="Compassion Fatigue" name="specialization[]" <?php if (!empty($specialization) && in_array("Compassion Fatigue", $specialization)) echo "checked"; ?> class="check__input">
											<label for="compassion_fatigue" class="label check__label checkbox__label text form__text">Compassion Fatigue</label>

											<input type="checkbox" id="self_esteem" value="Self Esteem" name="specialization[]" <?php if (!empty($specialization) && in_array("Self Esteem", $specialization)) echo "checked"; ?> class="check__input">
											<label for="self_esteem" class="label check__label checkbox__label text form__text">Self Esteem</label>

											<input type="checkbox" id="depression" value="Depression" name="specialization[]" <?php if (!empty($specialization) && in_array("Depression", $specialization)) echo "checked"; ?> class="check__input">
											<label for="depression" class="label check__label checkbox__label text form__text">Depression</label>

											<input type="checkbox" id="sex_sexuality" value="Sex & Sexuality" name="specialization[]" <?php if (!empty($specialization) && in_array("Sex & Sexuality", $specialization)) echo "checked"; ?> class="check__input">
											<label for="sex_sexuality" class="label check__label checkbox__label text form__text">Sex & Sexuality</label>


											<input type="checkbox" id="divorce" value="Divorce" name="specialization[]" <?php if (!empty($specialization) && in_array("Divorce", $specialization)) echo "checked"; ?> class="check__input">
											<label for="divorce" class="label check__label checkbox__label text form__text">Divorce</label>


											<input type="checkbox" id="sleep_or_insomnia" value="Sleep or Insomnia" name="specialization[]" <?php if (!empty($specialization) && in_array("Sleep or Insomnia", $specialization)) echo "checked"; ?> class="check__input">
											<label for="sleep_or_insomnia" class="label check__label checkbox__label text form__text">Sleep or Insomnia</label>


											<input type="checkbox" id="domestic_violence" value="Domestic Violence" name="specialization[]" <?php if (!empty($specialization) && in_array("Domestic Violence", $specialization)) echo "checked"; ?> class="check__input">
											<label for="domestic_violence" class="label check__label checkbox__label text form__text">Domestic Violence</label>

											<input type="checkbox" id="social_anxiety" value="Social Anxiety" name="specialization[]" <?php if (!empty($specialization) && in_array("Social Anxiety", $specialization)) echo "checked"; ?> class="check__input">
											<label for="social_anxiety" class="label check__label checkbox__label text form__text">Social Anxiety</label>


											<input type="checkbox" id="eating_food" value="Eating & Food Disorders" name="specialization[]" <?php if (!empty($specialization) && in_array("Eating & Food Disorders", $specialization)) echo "checked"; ?> class="check__input">
											<label for="eating_food" class="label check__label checkbox__label text form__text">Eating & Food Disorders</label>

											<input type="checkbox" id="speech_anxiety" value="Speech Anxiety" name="specialization[]" <?php if (!empty($specialization) && in_array("Speech Anxiety", $specialization)) echo "checked"; ?> class="check__input">
											<label for="speech_anxiety" class="label check__label checkbox__label text form__text">Speech Anxiety</label>


											<input type="checkbox" id="family_issue" value="Family Issues" name="specialization[]" <?php if (!empty($specialization) && in_array("Family Issues", $specialization)) echo "checked"; ?> class="check__input">
											<label for="family_issue" class="label check__label checkbox__label text form__text">Family Issues</label>

											<input type="checkbox" id="stress" value="Stress" name="specialization[]" <?php if (!empty($specialization) && in_array("Stress", $specialization)) echo "checked"; ?> class="check__input">
											<label for="stress" class="label check__label checkbox__label text form__text">Stress</label>

											<input type="checkbox" id="gad" value="GAD" name="specialization[]" <?php if (!empty($specialization) && in_array("GAD", $specialization)) echo "checked"; ?> class="check__input">
											<label for="gad" class="label check__label checkbox__label text form__text">GAD</label>

											<input type="checkbox" id="trauma_abuse" value="Trauma and or Abuse" name="specialization[]" <?php if (!empty($specialization) && in_array("Trauma and or Abuse", $specialization)) echo "checked"; ?> class="check__input">
											<label for="trauma_abuse" class="label check__label checkbox__label text form__text">Trauma and/or Abuse</label>


											<input type="checkbox" id="grief" value="Grief" name="specialization[]" <?php if (!empty($specialization) && in_array("Grief", $specialization)) echo "checked"; ?> class="check__input">
											<label for="grief" class="label check__label checkbox__label text form__text">Grief</label>

											<input type="checkbox" id="weight_loss" value="Weight Loss" name="specialization[]" <?php if (!empty($specialization) && in_array("Weight Loss", $specialization)) echo "checked"; ?> class="check__input">
											<label for="weight_loss" class="label check__label checkbox__label text form__text">Weight Loss</label>

											<input type="checkbox" id="helth_anxiety" value="Health Anxiety" name="specialization[]" <?php if (!empty($specialization) && in_array("Health Anxiety", $specialization)) echo "checked"; ?> class="check__input">
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
											<?php $work_with =  unserialize($user_additional_data->work_with); ?>
											<input type="checkbox" id="adults" value="adults" name="work_with[]" <?php if (!empty($work_with) && in_array("adults", $work_with)) echo "checked"; ?> class="check__input">
											<label for="adults" class="label check__label checkbox__label text form__text">Adults</label>

											<input type="checkbox" id="children" value="children" name="work_with[]" <?php if (!empty($work_with) && in_array("children", $work_with)) echo "checked"; ?> class="check__input">
											<label for="children" class="label check__label checkbox__label text form__text">Children</label>

											<input type="checkbox" id="teenagers" value="teenagers" name="work_with[]" <?php if (!empty($work_with) && in_array("teenagers", $work_with)) echo "checked"; ?> class="check__input">
											<label for="teenagers" class="label check__label checkbox__label text form__text">Teenagers</label>

											<input type="checkbox" id="couples" value="couples" name="work_with[]" <?php if (!empty($work_with) && in_array("couples", $work_with)) echo "checked"; ?> class="check__input">
											<label for="couples" class="label check__label checkbox__label text form__text">Couples</label>

											<input type="checkbox" id="families" value="families" name="work_with[]" <?php if (!empty($work_with) && in_array("families", $work_with)) echo "checked"; ?> class="check__input">
											<label for="families" class="label check__label checkbox__label text form__text">Families</label>
										</div>
									</div>
									<!-- END FORM ROW -->

								</div>

									<div class="form__cell">
									<p class="subtitle fz-20"><?php echo get_post_meta(get_the_ID(), 'realgh_videointro_main_title', true); ?></p>
									<p class="text fz-14"><?php echo get_post_meta(get_the_ID(), 'realgh_videointro_title_desc', true); ?></p>
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
								</div>
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
									<?php $file = esc_attr($user_additional_data->introduction_video); ?>
									<input type="file" name="intro_video" class="input-file" id="intro_video" accept="video/mp4, video/x-m4v, video/quicktime">
									<input
										type="hidden"
										class="input input-file--path <?php echo $file ? 'filled' : ''; ?>"
										name="intro_video_path"
										value="<?php echo $file; ?>"
									>
									<label for="intro_video" class="label button yellow-button form__file-button">
										<span class="button-text">
											<?php echo get_post_meta(get_the_ID(), 'realgh_form_upload_button_text', true); ?>
										</span>
									</label>
									<p class="text fz-16 file__req-text">
										<?php echo get_post_meta(get_the_ID(), 'realgh_form_upload_file_desc', true); ?>
									</p>
									<div class="form__file-content">
									<?php if($file): ?>
										<div class="single-psycho__section">
											<p class="subtitle single-psycho__title">
												<?php echo get_post_meta(get_the_ID(), 'realgh_single_psycho_video_title', true); ?>	
											</p>
											<video src="<?php echo $file; ?>" class="video" controls preload="metadata"></video>
										</div>
									<?php endif; ?>
									</div>
								</div>
								<!-- START FORM ROW -->
								<div class="form__cell">
									<input type="checkbox" <?php if ($user_additional_data->is_video_public == '1') { echo "checked"; } ?> id="warning" name="warning" value="1" class="check__input">
									<label for="warning" class="label check__label checkbox__label text form__text">
										<?php echo get_post_meta(get_the_ID(), 'realgh_videointro_checkbox_desc_1', true); ?>
									</label>
								</div>
								<div class="form__cell req-field">
									<input type="checkbox" id="confirmation" <?php if ($user_additional_data->accept_privacy_terms == '1') { echo "checked"; } ?> name="confirm" value="1" class="check__input">
									<label for="confirmation" class="label check__label checkbox__label text form__text d-block">
										<?php echo get_post_meta(get_the_ID(), 'realgh_videointro_checkbox_desc_2', true); ?>
									</label>
								</div>
								<!-- END FORM ROW -->
							</div>

							<!-- END QUEST TAB CONTENT -->

							<!-- START PRICE TAB CONTENT -->
							<div id="my_prices" class="tab__item form">
								<div class="form__cell">
									<div class="form__row">
										<div class="form__cell">
											<input <?php if ($user_additional_data->half_rate) { echo 'checked'; } ?> type="checkbox" id="consult-30" value="consult-30" name="connects[]" class="check__input check-condition">
											<label for="consult-30" class="label check__label checkbox__label text form__text"><?php echo get_post_meta(get_the_ID(), 'realgh_form_prices_label_text_1', true); ?></label>
											<input type="number" class="input input-text" min="0" name="half_rate" value="<?php echo $user_additional_data->half_rate; ?>" placeholder="<?php echo get_post_meta(get_the_ID(), 'realgh_form_prices_label_text_placeholder_1', true); ?>">
										</div>

										<div class="form__cell">
											<input <?php if ($user_additional_data->hourly_rate) { echo 'checked'; } ?> type="checkbox" id="consult-60" value="consult-60" name="connects[]" class="check__input check-condition">
											<label for="consult-60" class="label check__label checkbox__label text form__text"><?php echo get_post_meta(get_the_ID(), 'realgh_form_prices_label_text_2', true); ?></label>
											<input type="number" class="input input-text" min="0" name="hourly_rate" value="<?php echo $user_additional_data->hourly_rate; ?>" placeholder="<?php echo get_post_meta(get_the_ID(), 'realgh_form_prices_label_text_placeholder_2', true); ?>">
										</div>

										<div class="form__cell">
											<input <?php if ($user_additional_data->chat_rate) { echo 'checked'; } ?> type="checkbox" id="chat" value="chat" name="connects[]" class="check__input check-condition">
											<label for="chat" class="label check__label checkbox__label text form__text"><?php echo get_post_meta(get_the_ID(), 'realgh_form_prices_label_text_3', true); ?></label>
											<input type="number" class="input input-text" min="0" name="chat_rate" value="<?php echo $user_additional_data->chat_rate; ?>" placeholder="<?php echo get_post_meta(get_the_ID(), 'realgh_form_prices_label_text_placeholder_3', true); ?>">
										</div>
									</div>
										<div class="form__cell">
											<input type="checkbox" id="money_back_guarantee" <?php if ($user_additional_data->money_back_guarantee == '1') { echo "checked"; } ?> name="money_back_guarantee" value="1" class="check__input">
											<label for="money_back_guarantee" class="label check__label checkbox__label text form__text d-block agree-label">I agree to provide a full refund if the client is unhappy with their first session with me (be that a trial or a regular session). For further details please see our <a href="https://realgoodhelp.com/terms-of-use/" class="link text c-main" target="blank"> Terms of Use.</a></label>
										</div>

								</div>

							</div>
							<div id="loader" class="loader-wrap is-active" style="display:none;">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/img/booking/blue_spinner.gif" class="pay_loader" alt="blue_spinner">
							</div>
							<!-- END USER TAB CONTENT -->

						</div>
					</div>
				</div>
				<div class="form__button-block mobile--fxd-cr">
					<a href="<?php echo get_home_url(); ?>/dashboard" class="link button border-button button--big">
						<span class="button-text"><?php echo get_post_meta(get_the_ID(), 'realgh_cancel_link_text', true); ?></span>
					</a>
					<button class="button main-button button--big" type="submit">
						<span class="button-text"><?php echo get_post_meta(get_the_ID(), 'realgh_save_link_text', true); ?></span>
					</button>
				</div>
			</div>
		</form>
	</div>
</main>