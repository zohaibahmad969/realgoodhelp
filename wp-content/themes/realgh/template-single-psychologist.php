<?php
/*
* Template name: Template Single Psychologist
*/

get_header();

session_start();
$single_therapist_id = $_GET['psychologist_id'];

global $wpdb;

$table_name = $wpdb->prefix . "users_data";

$current_user = wp_get_current_user();
$roles = $current_user->roles;
$user_data = $wpdb->get_row("SELECT * FROM $table_name WHERE user_id = " . $current_user->ID);

get_template_part(
	'parts/calendar',
	'popup',
	array(
		'timezone' => $user_data->time_zone,
		'psycho_id' => $single_therapist_id,
		'roles'		=> $roles
	)
);
get_template_part('parts/money-back', 'popup');

if (isset($single_therapist_id) && !empty($single_therapist_id)) {
	$therapist_data = get_userdata($single_therapist_id);
	$user_additional_data = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}users_data a JOIN {$wpdb->prefix}therapists_data b ON a.user_id = b.therapist_id WHERE a.user_id = $single_therapist_id");
	$user_additional_data = (object) wp_unslash ($user_additional_data);

	if($user_additional_data->date_of_birth && $user_additional_data->date_of_birth != '0000-00-00'){
		$age = (date('Y') - date('Y',strtotime($user_additional_data->date_of_birth)));
	} else{
		$age = '';
	}
} else{
	wp_redirect(home_url());
}
?>



<main class="main js-padding">
	<section class="section-alt">
		<div class="wrapper">
			<div class="grid aside__container aside__rev-container">
				<div class="card mobile-card--p-0">
					<div class="card__header single-psycho__content-header">
						<div class="single-psycho__header-left single-psycho__header-item">
							<?php
							$userImg = $user_additional_data->user_profile_pic;
							if (!$userImg) {
								if (get_avatar_url($therapist_data->ID)) {
									$userImg = get_avatar_url($therapist_data->ID);
								} else {
									$userImg = get_template_directory_uri() . "/assets/img/dummy-profile-image.png";
								}
							}

							?>
							<img
								src="<?php echo $userImg; ?>"
								alt="Avatar"
								class="img single-psycho__img"
							>
							<?php if ($user_additional_data->money_back_guarantee == '1'){ ?>
								<button data-popup="money-back"  class="button bookButton psycho-card__button--desktop money-back-btn link js-popup">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/img/100-percent.png" alt=""><span class="button-text">100% Guarantee</span>
							</button>
							<?php } ?>

							<?php if ($user_additional_data->money_back_guarantee == '1'){ ?>
								<button data-popup="money-back"  class="button bookButton psycho-card__button--mobile money-back-btn single-psy-btn link js-popup">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/img/100-percent.png" alt="">	<span class="button-text">100% Guarantee</span>
								</button>
							<?php } ?>
							<!-- <div class="single-psycho__psycho-info">
								<div class="status-block">
									<div class="status">
										<i class="icon realgh-online"></i>
										<p class="text note fz-18"><?php echo get_post_meta(get_the_ID(), 'realgh_status_title', true); ?></p>
									</div>
									<p class="text fz-14"><?php echo get_post_meta(get_the_ID(), 'realgh_status_visit_time', true); ?></p>
								</div>
								<div class="rating-block single-psycho__rating-block">
									<div class="rating single-psycho__rating">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/star--fill.svg" alt="Rating" class="svg rating__star">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/star--fill.svg" alt="Rating" class="svg rating__star">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/star--fill.svg" alt="Rating" class="svg rating__star">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/star--fill.svg" alt="Rating" class="svg rating__star">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/star--fill.svg" alt="Rating" class="svg rating__star">
									</div>
									<p class="text fw-600 c-dark">5.0</p>
								</div>
							</div>
							<div class="d-flex flex--fxw-w">
								<p class="text fz-14"><span class="fw-700">630</span> Consultation</p>
								<p class="text fz-14"><span class="fw-700">140</span> Clients</p>
							</div> -->
						</div>
						<div class="single-psycho__header-item">
							<div class="single-psycho__desc-item">
								<div class="single-psycho__desc-header">
									<p class="title fz-32"><?php echo $therapist_data->display_name;?></p>
								</div>
								<p class="text fz-16"><?php echo $user_additional_data->qualification ?> <!-- <i class="icon realgh-question c-grey"></i> --></p>
							</div>
							<div class="d-flex flex--fxw-w single-psycho__flex">
								<div class="info__section">
									<p class="text note fz-14">Work experience</p>
									<p class="text fz-16 fw-600"><?php echo esc_attr($user_additional_data->experience); ?> </p>
								</div>
								<div class="info__section">
									<p class="text note fz-14">Method <!-- <i class="icon realgh-question c-grey"></i> --></p>
									<p class="text fz-16 fw-600"> 
									<?php $final_my_method = [];
									$exploded_first = explode('";', $user_additional_data->main_method); 
									foreach($exploded_first as $single_exploded_first){
										if (strpos($single_exploded_first, '"') !== false) {
											$exploded_second = explode('"', $single_exploded_first);
											$final_my_method[] = str_replace("_"," ",$exploded_second[1]);
										}
									}
									foreach ($final_my_method as $main_method):
									?>
									<p class="list__item text fz-16 fw-600 tt-cap">
										<?php if($main_method == 'Other') {
											echo $user_additional_data->other_main_method;
										 } else 
										 {
											echo $main_method;
										} ?>
									</p>
								<?php endforeach; ?></p>
								</div>

								<div class="info__section">
									<?php if($age) { ?>
										<p class="text note fz-14">Age</p>
										
										<p class="text fz-16 fw-600"> <?php echo $age ?></p>
									<?php } ?>
								</div>
							</div>
						</div>
						<div class="single-psycho__header-item single-psycho__answers">
							<div class="single-psycho__desc-item">
								<p class="text c-grey"><?php echo get_post_meta(get_the_ID(), 'realgh_single_psycho_desc_title', true); ?></p>
								<!-- <?php
									$uploadLinkArr = get_post_meta(get_the_ID(), 'realgh_single_psycho_list_repeater', true);
									if (!empty($uploadLinkArr)): ?>
										<ul class="list single-psycho__grid">
										<?php foreach ($uploadLinkArr as $key => $value): ?>
											<li class="list__item text fz-16">
												<?php echo $value['realgh_single_psycho_list_item']; ?>
											</li>
										<?php endforeach; ?>
										</ul>
									<?php endif;?> -->

									<ul class="list psycho-card__grid">
								<?php 
									$final_specialization = [];
									$exploded_first = explode('";', $user_additional_data->specialization); 
									foreach($exploded_first as $single_exploded_first){
										if (strpos($single_exploded_first, '"') !== false) {
											$exploded_second = explode('"', $single_exploded_first);
											$final_specialization[] = str_replace("_"," ",$exploded_second[1]);;
										}
									}
									foreach ($final_specialization as $specialization):
								?>
									<li class="list__item text fz-16 fw-600 tt-cap">
										<?php echo $specialization; ?>
									</li>
								<?php endforeach; ?>
								</ul>
							</div>
							<div class="single-psycho__desc-item">
								<p class="text c-grey">
									<?php echo get_post_meta(get_the_ID(), 'realgh_single_psycho_desc_title_1', true); ?>
								</p>
								<div class="badge-block">
									<!-- <p class="text fz-16"><?php echo get_post_meta(get_the_ID(), 'realgh_single_psycho_badge_title', true); ?></p> -->

									
								<?php 
									$final_work_with = [];
									$exploded_first = explode('";', $user_additional_data->work_with); 
									foreach($exploded_first as $single_exploded_first){
										if (strpos($single_exploded_first, '"') !== false) {
											$exploded_second = explode('"', $single_exploded_first);
											$final_work_with[] = str_replace("_"," ",$exploded_second[1]);;
										}
									}
									foreach ($final_work_with as $work_with):
								?>
									<p class="text fz-16 tt-cap">
										<?php echo $work_with; ?>
									</p>
									
								<?php endforeach; ?>
								
								</div>
							</div>
						</div>
					</div>
					<div class="card__content">
						<div class="aside grid grid__column single-psycho__aside--mobile">
							<div class="card">
								<div class="card__content">
									<div class="single-psycho__aside-content">
										<div class="d-flex w-100p">
											<p class="text fz-20 fw-600">30-minute trial consultation</p>
											<p class="subtitle fz-18"><?php echo esc_attr($user_additional_data->half_rate) . ' ' . CURRENCY; ?></p>
										</div>
										<div class="d-flex w-100p">
											<p class="text fz-20 fw-600">60-minute consultation</p>
											<p class="subtitle fz-18"><?php echo esc_attr($user_additional_data->hourly_rate) . ' ' . CURRENCY; ?></p>
										</div>
										<div class="d-flex w-100p">
											<p class="text fz-20 fw-600">60-minute chat</p>
											<p class="subtitle fz-18"><?php echo esc_attr($user_additional_data->chat_rate) . ' ' . CURRENCY; ?></p>
										</div>
									</div>
									<div class="card__text-block w-100p">
									<?php if ( is_user_logged_in() ) {?>
										<?php if(in_array("client", $roles)){ ?>
											<a class="button main-button psycho-card__button psycho-card__button--mobile link" href="<?php echo get_home_url(); ?>/booking?psychologist_id=<?php echo $single_therapist_id; ?>">
												<span class="button-text">Book</span>
											</a>
										<?php } ?>

									<?php } else{ ?>
										<button data-popup="regist"  class="button main-button psycho-card__button psycho-card__button--mobile link js-popup">
											<span class="button-text">Book</span>
										</button>
									<?php } ?>
										<!-- <button class="button border-button">
											<span class="button-text">Write a message</span>
										</button> -->
									</div>
								</div>
							</div>
							<div class="card card__content js-popup">
								<p class="subtitle"><?php echo get_post_meta(get_the_ID(), 'realgh_single_psycho_calendar_title', true); ?></p>
								<img
									src="<?php echo get_template_directory_uri(); ?>/assets/img/calendar.svg"
									alt="Calendar"
									data-popup="calendar"
									class="svg calendar-img js-popup"
								>
							</div>
						</div>

						<!-- START SECTION -->
						<div class="single-psycho__section">
							<p class="subtitle single-psycho__title"><?php echo get_post_meta(get_the_ID(), 'realgh_single_psycho_about_me_title', true); ?></p>
							<p class="text fz-16"><?php echo esc_attr($user_additional_data->about_myself); ?>
							</p>
						</div>
						<!-- END SECTION -->

						<!-- START SECTION -->
						<div class="single-psycho__section">
							<p class="subtitle single-psycho__title">
								<?php echo get_post_meta(get_the_ID(), 'realgh_single_psycho_subtitle_title', true); ?>
							</p>
							<div class="tabs-container">
								<div class="tabs d-flex single-psycho__tabs">
									<input
										data-tab-item="education"
										type="radio"
										name="description"
										id="education-tab"
										class="tab"
										checked
									>
									<label
										for="education-tab"
										class="label tab-label text fz-16 fw-600 single-psycho__tab-label"
									>
										<?php echo get_post_meta(get_the_ID(), 'realgh_single_psycho_tab_label_1', true); ?>
									</label>

									<input
										data-tab-item="methods"
										type="radio"
										name="description"
										id="methods-tab"
										class="tab"
									>
									<label
										for="methods-tab"
										class="label tab-label text fz-16 fw-600 single-psycho__tab-label"
									>
										<?php echo get_post_meta(get_the_ID(), 'realgh_single_psycho_tab_label_2', true); ?>
									</label>

									<input
										data-tab-item="features"
										type="radio"
										name="description"
										id="features-tab"
										class="tab"
									>
									<label
										for="features-tab"
										class="label tab-label text fz-16 fw-600 single-psycho__tab-label"
									>
										<?php echo get_post_meta(get_the_ID(), 'realgh_single_psycho_tab_label_3', true); ?>
									</label>

									<!-- <input
										data-tab-item="techniques"
										type="radio"
										name="description"
										id="techniques-tab"
										class="tab"
									>
									<label
										for="techniques-tab"
										class="label tab-label text fz-16 fw-600 single-psycho__tab-label"
									>
										<?php echo get_post_meta(get_the_ID(), 'realgh_single_psycho_tab_label_4', true); ?>
									</label> -->
								</div>
								<div class="tabs__content">
									<!-- START EDUCATION TAB CONTENT -->
									<div id="education" class="tab__item active">
									<p class="text fz-16"><?php echo esc_attr($user_additional_data->higher_education); ?></p>
									<p><?php echo "<br>"; ?></p>
									<p class="text fz-16"><?php echo esc_attr($user_additional_data->basic_education); ?></p>
									</div>
									<!-- END EDUCATION TAB CONTENT -->

									<!-- START METHODS TAB CONTENT -->
									<div id="methods" class="tab__item">
									<p class="text fz-16"><?php echo esc_attr($user_additional_data->about_main_method); ?></p>
									</div>
									<!-- END METHODS TAB CONTENT -->

									<!-- START FEATURES TAB CONTENT -->
									<div id="features" class="tab__item">
									<p class="text fz-16"><?php echo esc_attr($user_additional_data->phylosophy); ?></p>
									</div>
									<!-- END FEATURES TAB CONTENT -->

								</div>
							</div>
						</div>
						<!-- END SECTION -->

						<!-- START SECTION -->
						<?php if($user_additional_data->introduction_video && $user_additional_data->is_video_public == 1) { ?>
							<div class="single-psycho__section">
								<p class="subtitle single-psycho__title">
									<?php echo get_post_meta(get_the_ID(), 'realgh_single_psycho_video_title', true); ?>	
								</p>
								<video src="<?php echo esc_attr($user_additional_data->introduction_video); ?>" class="video" controls preload="metadata"></video>
							</div>
						<?php } else { ?>
							
                		<?php } ?>
						<!-- END SECTION -->

						<!-- START SECTION -->
						<!-- <div class="single-psycho__section">
							<p class="subtitle single-psycho__title">
								<?php echo get_post_meta(get_the_ID(), 'realgh_single_psycho_reviews_title', true); ?>	
							</p>
							<div class="grid card__reviews-content">
								<div class="review__card card__review-card">
									<p class="text review__text">Piper has been a very compassionate listener and helped my daughter out a great deal. Even though my daughter doesn't like to talk a lot they managed to always find something to talk about.</p>
									<div class="review__profile">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/img/clients/client-1.jpg" alt="Client" class="img review__img">
										<div class="review__content">
											<p class="subtitle review__user-name">Piper Sullivan</p>
											<div class="rating review__rating">
												<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/star--fill.svg" alt="Rating" class="svg rating__star">
												<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/star--fill.svg" alt="Rating" class="svg rating__star">
												<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/star--fill.svg" alt="Rating" class="svg rating__star">
												<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/star--fill.svg" alt="Rating" class="svg rating__star">
												<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/star--fill.svg" alt="Rating" class="svg rating__star">
											</div>
										</div>
									</div>
								</div>
								<div class="review__card card__review-card">
									<p class="text review__text">Piper has been a very compassionate listener and helped my daughter out a great deal. Even though my daughter doesn't like to talk a lot they managed to always find something to talk about.</p>
									<div class="review__profile">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/img/clients/client-2.jpg" alt="Client" class="img review__img">
										<div class="review__content">
											<p class="subtitle review__user-name">Piper Sullivan</p>
											<div class="rating review__rating">
												<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/star--fill.svg" alt="Rating" class="svg rating__star">
												<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/star--fill.svg" alt="Rating" class="svg rating__star">
												<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/star--fill.svg" alt="Rating" class="svg rating__star">
												<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/star--fill.svg" alt="Rating" class="svg rating__star">
												<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/star--fill.svg" alt="Rating" class="svg rating__star">
											</div>
										</div>
									</div>
								</div>
							</div>
							<button class="button border-button single-psycho__button button--big">
								<span class="button-text">Show more</span>
							</button>
						</div> -->
						<!-- END SECTION -->
					</div>
				</div>
				<div class="aside grid grid__column single-psycho__aside--desktop">
					<div class="card">
						<div class="card__content">
							<div class="single-psycho__aside-content">
								<div class="d-flex w-100p">
									<p class="text fz-20 fw-600">30-minute trial consultation</p>
									<p class="subtitle fz-18">
									<?php if ( $user_additional_data->half_rate ) {?>
										<?php echo esc_attr($user_additional_data->half_rate) . ' ' . CURRENCY; ?>
									<?php } else{ ?>
										<?php echo "Not available" ?>
									<?php } ?>
									</p>
								</div>
								<div class="d-flex w-100p">
									<p class="text fz-20 fw-600">60-minute consultation</p>
									<p class="subtitle fz-18">
									<?php if ( $user_additional_data->hourly_rate ) {?>
										<?php echo esc_attr($user_additional_data->hourly_rate) . ' ' . CURRENCY; ?>
									<?php } else{ ?>
										<?php echo "Not available" ?>
									<?php } ?>
									</p>
								</div>
								<div class="d-flex w-100p">
									<p class="text fz-20 fw-600">60-minute chat</p>
									<p class="subtitle fz-18">
									<?php if ( $user_additional_data->chat_rate ) {?>
										<?php echo esc_attr($user_additional_data->chat_rate) . ' ' . CURRENCY; ?>
									<?php } else{ ?>
										<?php echo "Not available" ?>
									<?php } ?>
									</p>
								</div>
							</div>
							<div class="card__text-block w-100p">
							<?php
							if ( is_user_logged_in() ):
								if(in_array("client", $roles)):
									?>
									<a
										class="button main-button bookButton psycho-card__button--desktop link"
										href="<?php echo get_home_url(); ?>/booking?psychologist_id=<?php echo $single_therapist_id; ?>"
									>
										<span class="button-text">Book</span>
									</a>
									<?php
								endif;
							else:
								?>
								<button data-popup="regist" class="button main-button bookButton psycho-card__button--desktop link js-popup">
										<span class="button-text">Book</span>
								</button>
							<?php endif; ?>
								<!-- <button class="button border-button">
									<span class="button-text">Write a message</span>
								</button> -->
							</div>
						</div>
					</div>
					<div class="card card__content">
						<p class="subtitle"><?php echo get_post_meta(get_the_ID(), 'realgh_single_psycho_calendar_title', true); ?></p>
						<img
							src="<?php echo get_template_directory_uri(); ?>/assets/img/calendar.svg"
							alt="Calendar"
							data-popup="calendar"
							class="svg calendar-img js-popup"
						>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
<?php get_footer(); ?>