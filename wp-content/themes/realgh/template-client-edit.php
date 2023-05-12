<main class="main js-padding">
	<div class="wrapper">
		<form class="section-alt aside__container grid edit-prof__form" method="POST" enctype="multipart/form-data">
			<div class="aside grid__column grid">
				<div class="card dashboard__card account__card">
					<!-- START COLUMN CARD -->
					<div class="card__content psycho-edit__card-content form__image-cell req-field">
						<div class="card__content flex--ai-c">
							<p class="subtitle psycho-edit__name--top fz-22">
								<?php echo  $user_additional_data->first_name . ' ' . $user_additional_data->last_name ?>
							</p>
							<?php
							$userImg = $user_additional_data->user_profile_pic;
							if(!$userImg){
								if(get_avatar_url($current_user->ID)){
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
							<label for="prfilePic" class="label">
								<img src="<?php echo $userImg; ?>" alt="Avatar" class="img avatar psycho-edit__avatar" id="userUplodaedPic">
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
							<p class="text fz-14">Member Since: <span class="fw-600"><?php $date = date_create($current_user->user_registered); echo date_format($date,"d F Y"); ?></span></p>
						</div>
					</div>
					<!-- END COLUMN CARD -->
				</div>
			</div>
			<div class="grid__content">
				<div class="card dashboard__card card__content psycho-edit__card">
					<h1 class="subtitle"><?php echo get_post_meta(get_the_ID(), 'realgh_profile_info_main_title', true); ?></h1>
					<p class="subtitle fz-16"><?php echo get_post_meta(get_the_ID(), 'realgh_client_user_info_main_title', true); ?></p>
					<div class="form">
						<div class="form__cell">
							<?php if(isset($response['error'])){ ?>
								<p class="subtitle fz-16 error-message"><?php echo $response['error']; ?></p>
							<?php } else if(isset($response['success'])){ ?>
										<p class="subtitle fz-16 success-message"><?php echo $response['success']; ?></p>
							<?php } ?>
							<p class="subtitle fz-20"><?php echo get_post_meta(get_the_ID(), 'realgh_client_user_info_subtitle', true); ?></p>
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
										value="<?php $date = date_create($user_additional_data->date_of_birth); echo date_format($date,"Y-m-d"); ?>"
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
												<?php if($key == $user_additional_data->country){ ?> selected="selected" <?php } ?>
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
							<div class="form__row">
								<div class="form__cell req-field">
									<label for="phone" class="label text form-cell__title req-label">
										<?php echo get_post_meta(get_the_ID(), 'realgh_form_phone_number_label', true); ?>
									</label>
									<input
										type="tel"
										name="phone"
										value="<?php echo $user_additional_data->phone; ?>"
										class="input input-text"
										placeholder="<?php echo get_post_meta(get_the_ID(), 'realgh_form_field_phone_number_placeholder', true); ?>"
									>
								</div>	
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
						<div class="form__cell req-field">
							<input type="checkbox" id="confirmation" <?php if ($user_additional_data->accept_privacy_terms == '1') { echo "checked"; } ?> name="confirm" value="1" class="check__input">
								<label for="confirmation" class="label check__label checkbox__label text form__text d-block">By clicking the "Submit" button, you confirm that you have read and accepted our <a href="https://realgoodhelp.com/privacy-policy/" class="link text c-main" target="blank"> Privacy Policy</a> and <a href="https://realgoodhelp.com/terms-of-use/" class="link text c-main" target="blank"> Terms of Use.</a></label>
						</div>
					</div>
				</div>

				<div id="loader" class="loader-wrap is-active" style="display:none;">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/booking/blue_spinner.gif" class="pay_loader" alt="blue_spinner">
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