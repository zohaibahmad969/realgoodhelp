<?php
/*
* Template name: Template Edit Schedule
*/

get_header();
global $wpdb;
if ($current_user) {
	$roles = $current_user->roles;
}
// $user_additional_data = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}users_data a JOIN {$wpdb->prefix}therapists_data b ON a.therapist_id =  JOIN {$wpdb->prefix}therapists_settings b ON a.therapist_id = b.therapist_id WHERE b.therapist_id = $current_user->ID");

$user_additional_data = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}users_data a JOIN {$wpdb->prefix}therapists_data b ON a.user_id = b.therapist_id JOIN {$wpdb->prefix}therapists_settings c ON a.user_id = c.therapist_id WHERE b.therapist_id = $current_user->ID");

$weekdays = array('mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun');

// =================Update Schedule Data ==================
if (isset($_POST['save'])) {
	// =========== Calendar Hours Availability ==========
	$availability_hours = $_POST['availability_hours'];
	// echo '<pre>';
	// 		var_dump($availability_hours);
	// 		echo '</pre>';
	$finallArray = [];
	foreach ($availability_hours as $key => $value) {
		if (!is_array($value)) continue;

		// foreach($value as $odd_key => $odd_val){
		// 	if($odd_key % 2 != 0){
		// 		$previous_value = $value[$odd_key - 1];
				
		// 		if($previous_value > $odd_val){
		// 			$value[$odd_key] = '23:59';
		// 			$value[$odd_key +  1] = '00:00';
		// 			$value[$odd_key +  2] = $odd_val;
		// 		}

		// 		if(array_key_exists($odd_key + 1, $value)){
		// 			$next_value = $value[$odd_key + 1];
		// 			if($next_value == $odd_val){
		// 				$value[$odd_key] = $value[$odd_key + 2];
		// 				unset($value[$odd_key + 1]);
		// 				unset($value[$odd_key + 2]);
		// 				break;
		// 			}
		// 		}
		// 	}
		// }

		foreach ($value as $sub_key => $st_value) {
			if ($sub_key % 2 != 0) continue;

			$end_value = $value[$sub_key + 1];
			$is_24_hour = false;

			$st_time = new DateTime($st_value, new DateTimeZone($user_additional_data->time_zone));
			$end_time = new DateTime($end_value, new DateTimeZone($user_additional_data->time_zone));

			$day_num = ($st_time->format('w') + 6) % 7;
			$cur_day = explode('_', $key)[0];
			$cur_day_num = array_search($cur_day, $weekdays);

			$st_time->modify($cur_day_num - $day_num . ' day');
			$end_time->modify($cur_day_num - $day_num . ' day');
			$st_time->setTimezone(new DateTimeZone('UTC'));
			$end_time->setTimezone(new DateTimeZone('UTC'));

			if ($end_value == '00:00' && $st_time > $end_time) $end_time->modify('1 day');
			if ($end_time->format('H:i') == '00:00') {
				$is_24_hour = true;
				$end_time->modify('-1 day');
			}




			
			// $time = new DateTime($st_value, new DateTimeZone($user_additional_data->time_zone));
// 			$day_num = ($time->format('w') + 6) % 7;
// 			$cur_day = explode('_', $key)[0];
// 			$cur_day_num = array_search($cur_day, $weekdays);
// 			$time->modify($cur_day_num - $day_num . ' days');
// echo $time->format('d');
// 			$time->setTimezone(new DateTimeZone('UTC'));
			// echo '<pre>';
			// var_dump($st_time->format('D H-i'));
			// var_dump($end_time->format('D H-i'));
			// echo '</pre>';
			$finallArray[$key][$sub_key / 2][] = $st_time->format('H:i');
			$finallArray[$key][$sub_key / 2][] = $end_time->format('H:i');
		}
	}
	// Update Query
	$update_therapist_data = array(
		'half_rate' 					=> 	$_POST['half_rate'],
		'hourly_rate' 					=>	$_POST['hourly_rate'],
		'chat_rate' 					=>	$_POST['chat_rate'],
	);
	$update_therapist_settings_data = array(
		'availability_hours'			=>	json_encode($finallArray),
		'break_time' 					=>	$_POST['break_time'],
		'min_session_time' 		    	=>	$_POST['min_session_time']
	);

	$wpdb->update($wpdb->prefix . "therapists_data", $update_therapist_data, array('therapist_id' => $current_user->ID));
	$wpdb->update($wpdb->prefix . "therapists_settings", $update_therapist_settings_data, array('therapist_id' => $current_user->ID));

	$user_additional_data = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}users_data a JOIN {$wpdb->prefix}therapists_data b ON a.user_id = b.therapist_id JOIN {$wpdb->prefix}therapists_settings c ON a.user_id = c.therapist_id WHERE b.therapist_id = $current_user->ID");
	// echo $wpdb->last_error;
	// die;
}

$additionalHours = json_decode($user_additional_data->availability_hours, true);

?>

<main class="main js-padding">
	<form method="post" class="section-alt">
		<div class="wrapper">
		<?php echo get_warning_banner('warning_padding'); ?>
			<div class="grid aside__container aside__rev-container schedule-edit__grid">
				<div class="form schedule-edit__content">
					<div class="card__text-block">
						<h1 class="title fz-32"><?php echo get_post_meta( get_the_ID(), 'realgh_edit_schedule_title', true ); ?></h1>
						<p class="text fz-16"><?php echo get_post_meta( get_the_ID(), 'realgh_edit_schedule_text-desc', true ); ?></p>
					</div>
					<div class="form__cell">
						<div class="form-cell__header">
							<p class="subtitle fz-18"><?php echo get_post_meta( get_the_ID(), 'realgh_edit_schedule_price_title', true ); ?></p>
							<p class="text note"><?php echo get_post_meta( get_the_ID(), 'realgh_edit_schedule_price_desc', true ); ?></p>
						</div>
						<div class="form__row">
							<div class="form__cell">
								<input <?php if ($user_additional_data->half_rate) {
											echo 'checked';
										} ?> type="checkbox" id="consult-30" value="consult-30" name="connects[]" class="check__input check-condition">
								<label for="consult-30" class="label check__label checkbox__label text form__text">
									<?php echo get_post_meta( get_the_ID(), 'realgh_form_consultation_label', true ); ?>
								</label>
								<input type="number" class="input input-text" name="half_rate" placeholder="<?php echo get_post_meta( get_the_ID(), 'realgh_form_consultation_placeholder', true ); ?>" value="<?php echo $user_additional_data->half_rate; ?>">
							</div>

							<div class="form__cell">
								<input <?php if ($user_additional_data->hourly_rate) {
											echo 'checked';
										} ?> type="checkbox" id="consult-60" value="consult-60" name="connects[]" class="check__input check-condition">
								<label for="consult-60" class="label check__label checkbox__label text form__text">
									<?php echo get_post_meta( get_the_ID(), 'realgh_form_consultation_label1', true ); ?>
								</label>
								<input type="number" class="input input-text" name="hourly_rate" placeholder="<?php echo get_post_meta( get_the_ID(), 'realgh_form_consultation_placeholder1', true ); ?>" value="<?php echo $user_additional_data->hourly_rate; ?>">
							</div>

							<div class="form__cell">
								<input <?php if ($user_additional_data->chat_rate) {
											echo 'checked';
										} ?> type="checkbox" id="chat" value="chat" name="connects[]" class="check__input check-condition">
								<label for="chat" class="label check__label checkbox__label text form__text">
									<?php echo get_post_meta( get_the_ID(), 'realgh_form_chat_label', true ); ?>
								</label>
								<input type="number" class="input input-text" name="chat_rate" value="<?php echo $user_additional_data->chat_rate; ?>" placeholder="<?php echo get_post_meta( get_the_ID(), 'realgh_form_chat_placeholder', true ); ?>">
							</div>

						</div>
					</div>
					<div class="form__row">
						<div class="form__cell">
							<label for="break_time" class="subtitle fz-18"><?php echo get_post_meta( get_the_ID(), 'realgh_range_title_1', true ); ?></label>
							<div class="d-flex form__flex">
								<input type="range" name="break_time" id="break_time" class="input input-range" value="<?php echo $user_additional_data->break_time; ?>" min="0" max="60" step="10">
								<output for="break_time" class="output text fz-16"><span class="output__content"></span> min</output>
							</div>
						</div>
						<div class="form__cell">
							<label for="min_session_time" class="subtitle fz-18"><?php echo get_post_meta( get_the_ID(), 'realgh_range_title_2', true ); ?></label>
							<div class="d-flex form__flex">
								<input type="range" name="min_session_time" id="min_session_time" class="input input-range" value="<?php echo $user_additional_data->min_session_time; ?>" min="1" max="48" step="1">
								<output for="min_session_time" class="output text fz-16"><span class="output__content"></span> hrs</output>
							</div>
						</div>
					</div>
					<div class="form__cell">
						<p class="subtitle fz-18">
							<?php echo get_post_meta( get_the_ID(), 'realgh_weekly_hours_title', true ); ?>
						</p>
						<div data-empty="Unavailable" class="timetable">
							<template id="workhours-temp">
								<div class="workhours__row">
									<div class="workhours">
										<input type="text" class="input input-text workhours__input workhours__start" value="09:00" placeholder="Start">
										<p class="text">-</p>
										<input type="text" class="input input-text workhours__input workhours__end" value="17:00" placeholder="End">
									</div>
									<button type="button" class="button transp-button timetable__button workhours__remove-button">
										<i class="icon realgh-trash"></i>
									</button>
								</div>
							</template>

							<?php foreach ($weekdays as $weekday): ?>
								<div class="timetable__row">
									<input
										type="checkbox"
										id="<?php echo $weekday; ?>"
										value="<?php echo $weekday; ?>"
										name="availability_hours[]"
										class="check__input"
										<?php echo is_array($additionalHours) && array_key_exists($weekday . '_int', $additionalHours) ? 'checked' : '';?>
									>
									<label
										for="<?php echo $weekday; ?>"
										class="label check__label checkbox__label subtitle form__text tt-upp"
									>
										<?php echo $weekday; ?>
									</label>
									<div class="timetable__intervals">
									<?php
									if (is_array($additionalHours) && array_key_exists($weekday . '_int', $additionalHours)):
										foreach ($additionalHours[$weekday . '_int'] as $key => $value):
											$f_time = new DateTime($value[0]);
											$f_time->setTimezone(new DateTimeZone($user_additional_data->time_zone));
											$s_time = new DateTime($value[1]);
											$s_time->setTimezone(new DateTimeZone($user_additional_data->time_zone));
											?>

											<div class='workhours__row'>
												<div class="workhours">
													<input
														type="text"
														class="input input-text workhours__input workhours__start"
														value="<?php echo $f_time->format('H:i'); ?>"
														placeholder="Start"
														name="availability_hours[<?php echo $weekday; ?>_int][]"
													>
													<p class="text">-</p>
													<input
														type="text"
														class="input input-text workhours__input workhours__end"
														value="<?php echo $s_time->format('H:i'); ?>"
														placeholder="End"
														name="availability_hours[<?php echo $weekday; ?>_int][]"
													>
												</div>
												<button type="button" class="button transp-button timetable__button workhours__remove-button">
													<i class="icon realgh-trash"></i>
												</button>
											</div>

											<?php
										endforeach;
									else:
										echo '<p class="text note">Unavailable</p>';
									endif;
									?>
									</div>
									<div class="timetable__buttons-block">
										<button type="button" class="button transp-button timetable__button timetable__add-button">
											<i class="icon realgh-plus"></i>
										</button>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
				<div class="aside card__text-block">
					<a href="<?php echo get_home_url(); ?>/therapist-schedule" type="button" class="link button border-button button--big">
						<span class="button-text">cancel</span>
					</a>
					<button class="button button--big">
						<input type="submit" name="save" value="Save Changes" class="button-text button main-button button--big">
					</button>
					<?php
					if (isset($_POST['save'])) {
						echo "<p class='successMsg subtitle fz-18'>Schedule data saved successfully!</p>";
					}
					?>
				</div>
			</div>
			<div
				data-psycho="<?php echo get_current_user_id(); ?>"
				class="calendar psycho"
			>

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
						<select name="month" class="input calendar__input subtitle fz-20 fw-600 calendar__year">
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

					<div class="calendar__hint">
						<p class="subtitle fz-12 fw-600 calendar-hint__name"></p>
						<p class="subtitle fz-12 fw-600 calendar-hint__text"></p>
						<p class="subtitle fz-12 fw-600 calendar-hint__text"></p>
						<p class="subtitle fz-12 fw-600 calendar-hint__text"></p>
					</div>
			
					<template id="session-temp">
						<div class="calendar__event">
							<img src="" alt="Avatar" class="img calendar__event-img">
							<p class="text fz-14 calendar__event-name"></p>
						</div>
					</template>

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
		</div>
	</form>
</main>

<?php get_footer(); ?>