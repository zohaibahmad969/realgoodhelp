<?php 
	
	$therapists = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}users a JOIN {$wpdb->prefix}usermeta b ON a.ID = b.user_id JOIN {$wpdb->prefix}therapists_data c ON a.ID = c.therapist_id JOIN {$wpdb->prefix}users_data d ON a.ID = d.user_id  WHERE b.meta_key = '{$wpdb->prefix}capabilities' and b.meta_value like '%therapist%' and c.top_therapists = 1 ORDER BY a.user_nicename");
	$total_therapists = count($therapists);

	$client_id = $current_user->ID;
	$table_name = $wpdb->prefix . "sessions";
	$client_sessions = $wpdb->get_results( "SELECT * FROM $table_name WHERE  client_id = $client_id AND session_status = 'pending' AND session_date >= CURDATE() ORDER BY session_date ASC LIMIT 5");
	$utc_date_time = gmdate("Y-m-d H:i");

?>

<main class="main js-padding">
	<div class="wrapper">
		<section class="section-alt aside__container">
			<div class="aside grid__column grid cus_column__flex">
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
							<div class="card__text-block">
								<p class="text fz-16 fw-600">Unfortunately, your schedule is empty!</p>
								<p class="subtitle fz-20">Book your first consultation with a <span class="c-main">20% discount!</span></p>
							</div>
						<?php else: ?>
							<div class="d-flex dashboard__consultation-content">
								<div class="consultation__text-block">
									<p class="text fz-16"><?php echo get_post_meta( get_the_ID(), 'realgh_consultation_text_title_1', true ); ?></p>
									<?php
									foreach($client_sessions as $single_client_session):
										$session_datetime = strtotime($single_client_session->session_date . ' ' . $single_client_session->session_end); 
										$current_datetime = strtotime($utc_date_time);
										if($session_datetime > $current_datetime):
											$ses_time = new DateTimeImmutable($single_client_session->session_date . ' ' . $single_client_session->session_start);
											$ses_time = $ses_time->setTimezone(new DateTimeZone($user_additional_data->time_zone));
											?>

											<p class="text fw-700">
												<?php echo $ses_time->format('M j Y, g:i a'); ?>
											</p>
									<?php endif; endforeach; ?>
								</div>
								<div class="consultation__text-block">
									<p class="text fz-16"><?php echo get_post_meta( get_the_ID(), 'realgh_consultation_text_title_2', true ); ?></p>
									<?php
									foreach($client_sessions as $single_client_session) {
										$session_datetime = strtotime($single_client_session->session_date . ' ' . $single_client_session->session_end); 
										$current_datetime = strtotime($utc_date_time);
										if($session_datetime > $current_datetime):
									?>
										<p class="text fw-700 tt-cap"><?php echo $single_client_session->communication_method; ?></p>
									<?php endif; } ?>
								</div>
							</div>
						<?php endif; ?>
						<a href="<?php echo get_home_url(); ?>/user-schedule"
							class="button border-button card__button link"
							<?php echo $is_empty ? 'disabled' : ''; ?>
						>
							<span class="button-text">show all</span>
						</a>
					</div>
				</div>
				<!--<a href="<?php echo get_permalink(get_post_meta( get_the_ID(), 'realgh_psycho_banner_link_value', true )); ?>" class="link banner banner--desktop">
					<img
						src="<?php echo get_template_directory_uri(); ?>/assets/img/dashboard/client-banner--small.png"
						alt="Banner"
						class="img bg"
					>
					<?php realgh_print_meta_img('realgh_client_banner_image', 'img bg') ?>
					<div class="banner__content">
						<p class="text banner__title"><?php echo get_post_meta( get_the_ID(), 'realgh_discount_title', true ); ?></p>
						<p class="text banner__text"><?php echo get_post_meta( get_the_ID(), 'realgh_client_banner_link_text', true ); ?></p>
					</div>
				</a> -->
			</div>
			<!-- <div class="grid__content grid grid__column"> -->
				<!-- <div class="card dashboard__card">
					<div class="card__header">
						<i class="icon realgh-dollar"></i>
						<p class="subtitle fz-22"><?php echo get_post_meta( get_the_ID(), 'realgh_balance_meta_title', true ); ?></p>
					</div>
					<div class="card__content">
						<div class="balance__content">
							<p class="subtitle fz-22">$138.00 <?php echo CURRENCY; ?></p>
							<button class="button transp-button balance__button">
								<i class="icon realgh-plus--circle"></i>
							</button>
						</div>
						<a href="/" class="link text fw-600 c-main">See details</a>
					</div> 
				</div> -->
				<!-- <div class="card dashboard__card">
					<div class="card__content">
						<div class="card__text-block">
							<p class="subtitle fz-22"><?php echo get_post_meta( get_the_ID(), 'realgh_refer_friends_meta_title', true ); ?></p>
							<p class="text"><?php echo get_post_meta( get_the_ID(), 'realgh_refer-friend_meta_desc', true ); ?></p>
						</div>
						<a class="button border-button card__button link" href="<?php echo get_home_url(); ?>/user-schedule">
							<span class="button-text">View/Edit Schedule</span>
						</a>
					</div>
				</div> -->
				<!-- <div class="card dashboard__card card--big">
					<div class="card__header dashboard__reviews-header">
						<p class="subtitle fz-22"><?php echo get_post_meta( get_the_ID(), 'realgh_psychologists_meta_title', true ); ?></p>
					</div>
					<div class="card__content client-dash__card-content">
						<p class="text fz-16 client-dash__card-text"><?php echo get_post_meta( get_the_ID(), 'realgh_psychologists_meta_desc', true ); ?></p>
						<div class="grid client-dash__psychologists">
						<?php foreach($therapists as $single_therapist) { ?>
							<a href="<?php echo get_home_url(); ?>/psychologist-profile/?psychologist_id=<?php echo $single_therapist->ID ?>" class="link psycho__small-card">
								<div class="psycho-small__content">
									<?php
									
										$userImg = $single_therapist->user_profile_pic;
										if(!$userImg){
											if(get_avatar_url($single_therapist->ID)){
												$userImg = get_avatar_url($single_therapist->ID);
											} else {
												$userImg = get_template_directory_uri() . "/assets/img/dummy-profile-image.png";
											}
										}
									?>
									<img
										src="<?php echo $userImg; ?>"
										alt="Psychologist"
										class="img psycho-small__img"
									>
									<div class="rating">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/star--fill.svg" alt="Rating" class="svg rating__star">
										<p class="text fz-14">5.0</p>
									</div>
								</div>
								<div class="psycho-small__content">
									<div class="info__section">
										<p class="subtitle fz-16"><?php echo get_user_meta( $single_therapist->ID, 'first_name', true ) . " " . get_user_meta( $single_therapist->ID, 'last_name', true ); ?></p>
										<p class="text fz-14 cus-capitalize-text"><?php echo str_replace('_', ' ',$single_therapist->main_method) ?></p>
									</div>
									<div class="psycho-small__info">
										<div class="info__section">
											<p class="text note fz-14">Work experience:</p>
											<p class="text fz-16 fw-600"><?php echo $single_therapist->experience; ?></p>
										</div>
										<div class="info__section">
											<p class="text note fz-14">Hourly rate from:</p>
											<p class="text fz-16 fw-600"><?php echo CURRENCY . ' ' . $single_therapist->hourly_rate; ?></p>
										</div>
									</div>
								</div>
							</a>
						<?php } ?>
						</div>
						<a href="<?php echo get_home_url(); ?>/psychologists" class="link button main-button card__button">
							<span class="button-text">Choose a psychologist</span>
						</a>
					</div>
				</div>
				<a href="<?php echo get_permalink(get_post_meta( get_the_ID(), 'realgh_psycho_banner_link_value', true )); ?>" class="link banner banner--mobile">
					<img
						src="<?php echo get_template_directory_uri(); ?>/assets/img/dashboard/client-banner--big.png"
						alt="Banner"
						class="img bg banner__bg--desktop"
					>
					<img
						src="<?php echo get_template_directory_uri(); ?>/assets/img/dashboard/client-banner--small.png"
						alt="Banner"
						class="img bg banner__bg--mobile"
					>
					<?php realgh_print_meta_img('realgh_client_banner_image_ipad', 'img bg banner__bg--desktop') ?>
					<?php realgh_print_meta_img('realgh_client_banner_image_mobile', 'img bg banner__bg--mobile') ?>
					<div class="banner__content">
						<p class="text banner__title"><?php echo get_post_meta( get_the_ID(), 'realgh_discount_title', true ); ?></p>
						<p class="text banner__text"><?php echo get_post_meta( get_the_ID(), 'realgh_client_banner_link_text', true ); ?></p>
					</div>
				</a> -->
			</div>
		</section>
	</div>
</main>