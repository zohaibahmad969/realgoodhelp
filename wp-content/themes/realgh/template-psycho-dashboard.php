<?php

$therapist_id = $current_user->ID;

$table_name = $wpdb->prefix . "sessions";

$therapist_sessions = $wpdb->get_results( "SELECT * FROM $table_name WHERE  therapist_id = $therapist_id AND session_status = 'pending' AND session_date >= CURDATE() ORDER BY session_date ASC LIMIT 5 ");

get_template_part(
	'parts/withdraw',
	'popup',
	array(
		'id' => $therapist_id,
		'email' => $current_user->user_email
	)
);

get_template_part(
	'parts/withdraw-thankyou',
	'popup'
);

$therapist_balance = $wpdb->get_row( "SELECT SUM(therapist_balance) as therapist_balance FROM $table_name WHERE therapist_id = $therapist_id AND session_status = 'done'");
$pending_balance_data = $wpdb->get_results( "SELECT * FROM $table_name WHERE  therapist_id = $therapist_id AND session_status = 'pending' AND session_date <= CURDATE()");
$utc_date_time = gmdate("Y-m-d H:i");
$pending_balance = 0;

foreach($pending_balance_data as $single_pending_balance_data) {
	$session_datetime = strtotime($single_pending_balance_data->session_date . ' ' . $single_pending_balance_data->session_end); 
	$current_datetime = strtotime($utc_date_time);
	if($session_datetime < $current_datetime){
		$pending_balance += $single_pending_balance_data->therapist_balance;
	}
}

?>

<main class="main js-padding">
	<div class="wrapper">
		<?php echo get_warning_banner(); ?>
		<section class="section-alt aside__container grid">
			<div class="aside grid__column grid">
				<div class="card dashboard__card">
					<div class="card__header account-card__header">
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
						<img
							src="<?php echo $userImg; ?>"
							alt="Avatar"
							class="img avatar dashboard__avatar"
						>
						<div class="account-card__text-block">
							<p class="subtitle fz-22"><?php echo  $current_user->first_name . ' ' . $current_user->last_name ?></p>
							<a href="<?php echo get_home_url(); ?>/edit-account" class="link text c-main">Edit profile</a>
						</div>
					</div>
					<div class="card__content account-card__content">
						<div class="account-card__info">
							<p class="text account-info__title fz-18">Timezone:</p>
							<p class="text account-info___text fz-16">
								<?php 
									if ($user_additional_data->time_zone) {
										$date = new DateTime("now", new DateTimeZone($user_additional_data->time_zone));
										echo $date->format('d, F Y ( h:i:s A )');
									} else {
										echo date("d, F Y ( h:i:s A )");
									}				
								?>
							</p>
							<p class="text account-info__title fz-18">Phone number:</p>
							<p class="text account-info___text fz-16"><?php echo  $user_additional_data->phone ?></p>
							<p class="text account-info__title fz-18">Email:</p>
							<p class="text account-info___text fz-16"><?php echo  $current_user->user_email ?></p>
						</div>
						<a class="button transp-button dashboard__logout-button" href="<?php echo wp_logout_url(get_home_url()); ?>">
							<i class="icon realgh-exit"></i>
							<span class="button-text">Log Out</span>
						</a>
					</div>
				</div>
				<div class="card dashboard__card">
					<div class="card__header">
						<i class="icon realgh-chat"></i>
						<p class="subtitle fz-22"><?php echo get_post_meta( get_the_ID(), 'realgh_consultation_main_title', true ); ?></p>
					</div>
					<div class="card__content">
						<?php if ($is_empty) : ?>
							<p class="text fz-16 fw-600">Unfortunately, your schedule is empty!</p>
						<?php else : ?>
							<div class="d-flex dashboard__consultation-content">
								<div class="consultation__text-block">
									<p class="text fz-16"><?php echo get_post_meta( get_the_ID(), 'realgh_consultation_text_title_1', true ); ?></p>
									<?php
									foreach($therapist_sessions as $single_therapist_session) {
										$session_datetime = strtotime($single_therapist_session->session_date . ' ' . $single_therapist_session->session_end); 
										$current_datetime = strtotime($utc_date_time);
										if($session_datetime > $current_datetime):
									?>
										<p class="text fw-700"><?php echo $single_therapist_session->session_date; ?></p>
									<?php endif; }?>
								</div>
								<div class="consultation__text-block">
									<p class="text fz-16"><?php echo get_post_meta( get_the_ID(), 'realgh_consultation_text_title_2', true ); ?></p>
									<?php
									foreach($therapist_sessions as $single_therapist_session) {
										$session_datetime = strtotime($single_therapist_session->session_date . ' ' . $single_therapist_session->session_end); 
										$current_datetime = strtotime($utc_date_time);
										if($session_datetime > $current_datetime):
									?>
										<p class="text fw-700 tt-cap"><?php echo $single_therapist_session->communication_method; ?></p>
									<?php endif; }?>
								</div>
							</div>
						<?php endif; ?>
						<a href="<?php echo get_home_url(); ?>/user-schedule" class="button border-button card__button link" <?php echo $is_empty ? 'disabled' : ''; ?>>
							<span class="button-text">show all</span>
						</a>
					</div>
				</div>
				<!-- <a href="<?php echo get_permalink(get_post_meta( get_the_ID(), 'realgh_psycho_banner_link_value', true )); ?>" class="link banner banner--desktop">
					<?php realgh_print_meta_img('realgh_psycho_banner_image', 'img bg') ?>
					<div class="banner__content psycho__banner-content">
						<p class="text banner__title">
							<?php echo get_post_meta( get_the_ID(), 'realgh_invite_friend_title', true ); ?>
						</p>
						<p class="text banner__text"><?php echo get_post_meta( get_the_ID(), 'realgh_psycho_banner_text', true ); ?></p>
						<button class="button yellow-button">
							<span class="button-text"><?php echo get_post_meta( get_the_ID(), 'realgh_psycho_banner_link_text', true ); ?></span>
						</button>
					</div>
				</a> -->
			</div>
			<div class="grid__content grid grid__column">
				<div class="card dashboard__card card--big">
					<div class="grid__content grid mob-grid">
						<div class="card__header">
							<i class="icon realgh-dollar"></i>
							<p class="subtitle fz-22">Available balance</p>
						</div>
						<div class="card__header">
							<i class="icon realgh-dollar"></i>
							<p class="subtitle fz-22">Pending balance</p>
						</div>
					
						<div class="balance__content">
								<?php if ( $therapist_balance->therapist_balance ) {?>
									<p class="subtitle fz-22"><?php echo esc_attr($therapist_balance->therapist_balance) . ' ' . CURRENCY; ?></p>
								<?php } else{ ?>
									<p class="subtitle fz-22"><?php echo "0 " . CURRENCY; ?></p>
								<?php } ?>
								<button style="display: none;" class="button transp-button balance__button">
									<i class="icon realgh-plus--circle"></i>
								</button>
						</div>
						<div class="balance__content">
							<p class="subtitle fz-22"><?php echo $pending_balance . ' ' . CURRENCY; ?></p>
							<button style="display: none;" class="button transp-button balance__button">
								<i class="icon realgh-plus--circle"></i>
							</button>
						</div>
							<button data-popup="withdraw" class="button main-button card__button js-popup">
								<span class="button-text">Withdraw</span>
							</button>
					</div>
				</div>
				<div class="card dashboard__card card--big">
					<div class="card__header">
						<i class="icon realgh-date"></i>
						<p class="subtitle fz-22"><?php echo get_post_meta( get_the_ID(), 'realgh_schedule_meta_title', true ); ?></p>
					</div>
					<div class="card__content">
						<p class="text">Here you can adjust your schedule (select working hours and assign days off)</p>
						<a href="<?php echo get_home_url(); ?>/therapist-schedule" class="link button main-button card__button">
							<span class="button-text">View/Edit Schedule</span>
						</a>
					</div>
				</div>
				<div id="loader" class="loader-wrap is-active" style="display:none;">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/booking/blue_spinner.gif" class="pay_loader" alt="blue_spinner">
				</div>
				<!-- <div class="card dashboard__card card--big">
					<div class="card__header dashboard__reviews-header">
						<p class="subtitle fz-22"><?php echo get_post_meta( get_the_ID(), 'realgh_reviews_meta_title', true ); ?></p>
						<div class="dashboard__header-right d-flex">
							<div class="d-flex dashboard-reviews__text-block dashboard__review--desktop">
								<p class="text fz-16 fw-600 whs-nw"><span class="c-dark">63</span> consultation</p>
								<p class="text fz-16 fw-600 whs-nw"><span class="c-dark">41</span> clients</p>
								<p class="text fz-16 fw-600 whs-nw"><span class="c-dark">11</span> reviews</p>
							</div>
							<?php if (!$is_empty) : ?>
								<div class="rating-block">
									<div class="rating">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/star--fill.svg" alt="Rating" class="svg rating__star">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/star--fill.svg" alt="Rating" class="svg rating__star">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/star--fill.svg" alt="Rating" class="svg rating__star">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/star--fill.svg" alt="Rating" class="svg rating__star">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/star--fill.svg" alt="Rating" class="svg rating__star">
									</div>
									<p class="text fw-600 c-dark">5.0</p>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<div class="card__content">
						<div class="d-flex dashboard-reviews__text-block dashboard__review--mobile">
							<p class="text fz-16 fw-600 whs-nw"><span class="c-dark">63</span> consultation</p>
							<p class="text fz-16 fw-600 whs-nw"><span class="c-dark">41</span> clients</p>
							<p class="text fz-16 fw-600 whs-nw"><span class="c-dark">11</span> reviews</p>
						</div>
						<?php if ($is_empty) : ?>
							<p class="text fz-16 fw-600">You don't have any reviews yet</p>
						<?php else : ?>
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
						<?php endif; ?>
						<button class="button border-button card__button" <?php echo $is_empty ? 'disabled' : ''; ?>>
							<span class="button-text">View all reviews</span>
						</button>
					</div>
				</div>
				<a href="<?php echo get_permalink(get_post_meta( get_the_ID(), 'realgh_psycho_banner_link_value', true )); ?>" class="link banner banner--mobile">
					<?php realgh_print_meta_img('realgh_psycho_banner_image_ipad', 'img bg banner__bg--desktop') ?>
					<?php realgh_print_meta_img('realgh_psycho_banner_image_mobile', 'img bg banner__bg--mobile') ?>
					<div class="banner__content psycho__banner-content">
						<p class="text banner__title">
							<?php echo get_post_meta( get_the_ID(), 'realgh_invite_friend_title', true ); ?>
						</p>
						<p class="text banner__text"><?php echo get_post_meta( get_the_ID(), 'realgh_psycho_banner_text', true ); ?></p>
						<button class="button yellow-button">
							<span class="button-text"><?php echo get_post_meta( get_the_ID(), 'realgh_psycho_banner_link_text', true ); ?></span>
						</button>
					</div>
				</a> -->
			</div>
		</section>
	</div>
</main>