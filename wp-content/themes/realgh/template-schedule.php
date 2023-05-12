<?php 
/*
* Template name: Template User's Schedule
*/

get_header();

get_template_part('parts/cancel', 'popup');
get_template_part(
	'parts/review',
	'popup',
	array('client_id' => get_current_user_id())
);
get_template_part('parts/review-success', 'popup');

global $wpdb;

$current_user = wp_get_current_user();

$user_id = $current_user->ID;

$table_name = $wpdb->prefix . "sessions";

$roles = $current_user->roles;

$utc_date_time = gmdate("Y-m-d H:i");

if (in_array("therapist", $roles) || in_array("administrator", $roles)){
	$user_role = 'therapist';
	$user_sessions = $wpdb->get_results( "SELECT * FROM $table_name WHERE  therapist_id = $user_id AND session_status = 'pending' AND session_date >= CURDATE()");
	$user_sessions_history = $wpdb->get_results( "SELECT * FROM $table_name WHERE  therapist_id = $user_id AND (session_status = 'done' OR session_status = 'cancelled')");
	$user_sessions_pending_history = $wpdb->get_results( "SELECT * FROM $table_name WHERE  therapist_id = $user_id AND session_status = 'pending' AND session_date <= CURDATE()");
} else {
	$user_role = 'client';
	$user_sessions = $wpdb->get_results( "SELECT * FROM $table_name WHERE  client_id = $user_id AND session_status = 'pending' AND session_date >= CURDATE()");
	$user_sessions_history = $wpdb->get_results( "SELECT * FROM $table_name WHERE  client_id = $user_id AND (session_status = 'done' OR session_status = 'cancelled')");
	$user_sessions_pending_history = $wpdb->get_results( "SELECT * FROM $table_name WHERE  client_id = $user_id AND session_status = 'pending' AND session_date <= CURDATE()");
}

$user_data = $wpdb->get_row("SELECT * FROM " . $wpdb->get_blog_prefix() . "users_data WHERE user_id = $user_id");
?>

<main class="main js-padding">
	<section class="section-alt">
		<div class="wrapper wrapper--small">
			<div class="card mobile-card--p-0">
				<div class="card__header">
					<p class="subtitle fz-22">Your consultations</p>
				</div>
				<div class="client-schedule__sections">
					<?php if($user_sessions): ?>
						<div class="card__text-block client-schedule__current">
							<p class="text fz-20 fw-600">Schedule</p>
							<div class="grid grid__column">
							<!-- START CARD -->
							<?php
							foreach($user_sessions as $single_client_session):
							$session_datetime = strtotime($single_client_session->session_date . ' ' . $single_client_session->session_end); 
							$current_datetime = strtotime($utc_date_time);
							if($session_datetime > $current_datetime):

								if($user_role == 'client'){
									$therapist_data = get_userdata($single_client_session->therapist_id);
								} else {
									$client_data = get_userdata($single_client_session->client_id);
								}
								$ses_time = new DateTimeImmutable($single_client_session->session_date . ' ' . $single_client_session->session_start);
								$ses_time = $ses_time->setTimezone(new DateTimeZone($user_data->time_zone));

								$duration = $single_client_session->duration;
								$ses_end_time = $ses_time->add(new DateInterval("PT" . $duration . "M"));
								?>

								<div class="client-schedule__card active">
									<div class="client-schedule__content">
										<div class="client-schedule__content-title">
											<i class="icon realgh-date"></i>
											<p class="text fz-14">Date</p>
										</div>
										<p class="text fz-15 fw-600">
											<?php echo $ses_time->format('F j, Y'); ?>
										</p>
										<div class="client-schedule__content-title">
											<i class="icon realgh-time"></i>
											<p class="text fz-14">Time</p>
										</div>
										<p class="text fz-15 fw-600">
											<?php echo $ses_time->format('g:i a') . " - " . $ses_end_time->format('g:i a'); ?>
										</p>
										<div class="client-schedule__content-title">
											<i class="icon realgh-tool"></i>
											<p class="text fz-14">Communication tool</p>
										</div>
										<p class="text fz-15 fw-600 tt-cap">
											<?php echo $single_client_session->communication_method; ?>
										</p>
										<div class="client-schedule__content-title">
											<i class="icon realgh-person"></i>
											<p class="text fz-14"><?php if($user_role == 'client'){ echo 'Therapist'; } else{ echo "Client"; } ?></p>
										</div>
										<?php if($user_role == 'client'){ ?>
											<a href="<?php echo get_home_url(); ?>/psychologist-profile/?psychologist_id=<?php echo $single_client_session->therapist_id; ?>" class="text fz-15 fw-600 client-schedule__link">
												<?php echo $therapist_data->first_name . ' ' . $therapist_data->last_name; ?>
											</a>
										<?php } else { ?>
											<a href="<?php echo get_home_url(); ?>/client-profile?client_id=<?php echo $single_client_session->client_id; ?>" class="text fz-15 fw-600 client-schedule__link">
												<?php echo $client_data->first_name . ' ' . $client_data->last_name; ?>
											</a>
										<?php } ?>
									</div>
									<div class="client-schedule__buttons">
										<a class="button main-button client-schedule__button link" href="<?php echo $single_client_session->video_call_link; ?>" target="blank">
											<span class="button-text">Join the consultation</span>
										</a>
										<button data-popup="cancel" data-session-id="<?php echo $single_client_session->id; ?>" 
										data-client-id="<?php echo $single_client_session->client_id; ?>" 
										data-therapist-id="<?php echo $single_client_session->therapist_id; ?>" 
										data-cancelled-by="<?php echo $user_role; ?>" 
										class="button transp-button client-schedule__button client-schedule__clear-button js-popup" id="cancel_session-<?php echo $single_client_session->id; ?>">
											<i class="icon realgh-trash"></i>
										</button>
									</div>
								</div>

							<?php endif; endforeach; ?>
							<!-- END CARD -->
							</div>
						</div>
					<?php endif;  ?>
					
					<div id="loader" class="loader-wrap is-active" style="display:none;">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/img/booking/blue_spinner.gif" class="pay_loader" alt="blue_spinner">
					</div>
					
					<?php if($user_sessions_history): ?>
						<div class="card__text-block client-schedule__history">
							<p class="text fz-20 fw-600">Consultation history</p>
							<div class="grid grid__column">
							<!-- START CARD -->
							<?php
							foreach($user_sessions_history as $single_client_session_history):
								if($user_role == 'client'){
									$therapist_data_history = get_userdata($single_client_session_history->therapist_id);
								} else {
									$client_data_history = get_userdata($single_client_session_history->client_id);
								}

								$ses_time = new DateTimeImmutable($single_client_session_history->session_date . ' ' . $single_client_session_history->session_start);
								$ses_time = $ses_time->setTimezone(new DateTimeZone($user_data->time_zone));

								$duration = $single_client_session_history->duration;
								$ses_end_time = $ses_time->add(new DateInterval("PT" . $duration . "M"));
								?>

								<div class="client-schedule__card <?php if($single_client_session_history->session_status == 'cancelled') : echo "cancel_session_card"; endif; ?>">
									<div class="client-schedule__content">
										<div class="client-schedule__content-title">
											<i class="icon realgh-date"></i>
											<p class="text fz-14">Date</p>
										</div>
										<p class="text fz-15 fw-600">
											<?php echo $ses_time->format('F j, Y'); ?>
										</p>
										<div class="client-schedule__content-title">
											<i class="icon realgh-time"></i>
											<p class="text fz-14">Time</p>
										</div>
										<p class="text fz-15 fw-600">
											<?php echo $ses_time->format('g:i a') . " - " . $ses_end_time->format('g:i a'); ?>
										</p>
										<div class="client-schedule__content-title">
											<i class="icon realgh-tool"></i>
											<p class="text fz-14">Communication tool</p>
										</div>
										<p class="text fz-15 fw-600 tt-cap">
											<?php echo $single_client_session_history->communication_method; ?>
										</p>
										<div class="client-schedule__content-title">
											<i class="icon realgh-person"></i>
											<p class="text fz-14"><?php if($user_role == 'client'){ echo 'Therapist'; } else{ echo "Client"; } ?></p>
										</div>

										<?php if($user_role == 'client'){ ?>
											<a href="<?php echo get_home_url(); ?>/psychologist-profile/?psychologist_id=<?php echo $single_client_session_history->therapist_id; ?>" class="text fz-15 fw-600 client-schedule__link">
												<?php echo $therapist_data_history->first_name . ' ' . $therapist_data_history->last_name; ?>
											</a>
										<?php } else { ?>
											<a href="<?php echo get_home_url(); ?>/client-profile?client_id=<?php echo $single_client_session_history->client_id; ?>" class="text fz-15 fw-600 client-schedule__link">
												<?php echo $client_data_history->first_name . ' ' . $client_data_history->last_name; ?>
											</a>
										<?php } ?>

										<div class="client-schedule__content-title">
											<i class="icon realgh-person"></i>
											<p class="text fz-14">Session Status</p>
										</div>
										<p class="text fz-15 fw-600 tt-cap">
											<?php echo $single_client_session_history->session_status; ?>
										</p>
									</div>
									<?php if($user_role == 'client'): ?>
									<!-- <div class="client-schedule__buttons">
										<button
											data-popup="review"
											class="button main-button client-schedule__button js-popup"
											data-psycho="<?php echo $single_client_session_history->therapist_id; ?>"
										>
											<span class="button-text">Leave feedback</span>
										</button>
									</div> -->
									<?php endif; ?>
								</div>

							<?php endforeach; ?>
							<!-- END CARD -->

							<?php
							foreach($user_sessions_pending_history as $single_user_sessions_pending_history):
								$session_datetime = strtotime($single_user_sessions_pending_history->session_date . ' ' . $single_user_sessions_pending_history->session_end); 
								$current_datetime = strtotime($utc_date_time);
								if($session_datetime < $current_datetime):
									if($user_role == 'client'){
										$therapist_data_history = get_userdata($single_user_sessions_pending_history->therapist_id);
									} else {
										$client_data_history = get_userdata($single_user_sessions_pending_history->client_id);
									}

									$ses_time = new DateTimeImmutable($single_user_sessions_pending_history->session_date . ' ' . $single_user_sessions_pending_history->session_start);
									$ses_time = $ses_time->setTimezone(new DateTimeZone($user_data->time_zone));

									$duration = $single_user_sessions_pending_history->duration;
									$ses_end_time = $ses_time->add(new DateInterval("PT" . $duration . "M"));
									?>

									<div class="client-schedule__card">
										<div class="client-schedule__content">
											<div class="client-schedule__content-title">
												<i class="icon realgh-date"></i>
												<p class="text fz-14">Date</p>
											</div>
											<p class="text fz-15 fw-600">
												<?php echo $ses_time->format('F j, Y'); ?>
											</p>
											<div class="client-schedule__content-title">
												<i class="icon realgh-time"></i>
												<p class="text fz-14">Time</p>
											</div>
											<p class="text fz-15 fw-600">
												<?php echo $ses_time->format('g:i a') . " - " . $ses_end_time->format('g:i a'); ?>
											</p>
											<div class="client-schedule__content-title">
												<i class="icon realgh-tool"></i>
												<p class="text fz-14">Communication tool</p>
											</div>
											<p class="text fz-15 fw-600 tt-cap">
												<?php echo $single_user_sessions_pending_history->communication_method; ?>
											</p>
											<div class="client-schedule__content-title">
												<i class="icon realgh-person"></i>
												<p class="text fz-14"><?php if($user_role == 'client'){ echo 'Therapist'; } else{ echo "Client"; } ?></p>
											</div>

											<?php if($user_role == 'client'){ ?>
												<a href="<?php echo get_home_url(); ?>/psychologist-profile/?psychologist_id=<?php echo $single_user_sessions_pending_history->therapist_id; ?>" class="text fz-15 fw-600 client-schedule__link">
													<?php echo $therapist_data_history->first_name . ' ' . $therapist_data_history->last_name; ?>
												</a>
											<?php } else { ?>
												<a href="<?php echo get_home_url(); ?>/client-profile?client_id=<?php echo $single_user_sessions_pending_history->client_id; ?>" class="text fz-15 fw-600 client-schedule__link">
													<?php echo $client_data_history->first_name . ' ' . $client_data_history->last_name; ?>
												</a>
											<?php } ?>

											<div class="client-schedule__content-title">
												<i class="icon realgh-person"></i>
												<p class="text fz-14">Session Status</p>
											</div>
											<p class="text fz-15 fw-600 tt-cap">Done</p>
										</div>
										<!--<div class="client-schedule__buttons">
											<button
												data-psycho="<?php echo $single_client_session_history->therapist_id; ?>"
												data-popup="review"
												class="button main-button client-schedule__button js-popup"
											>
												<span class="button-text">Leave feedback</span>
											</button>
										</div>-->
									</div>

							<?php endif; endforeach; ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>