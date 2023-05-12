<?php
/*
* Template name: Template Reminder
*/

get_header();

get_template_part('parts/success-reminder', 'popup');

global $wpdb;
$post_id = $_GET['post_id'];
$user_id = get_current_user_id();

$reminders = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}reminders rm WHERE rm.user_id = $user_id AND rm.post_id = $post_id");
$user_data = $wpdb->get_row("SELECT ud.time_zone, us.telegram_id FROM {$wpdb->prefix}users_data ud JOIN {$wpdb->prefix}users_settings us ON ud.user_id = us.user_id WHERE ud.user_id = $user_id");
?>

<main class="main js-padding">
	<div class="wrapper">
		<div id="loader" class="loader-wrap is-active" style="display:none;">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/img/booking/blue_spinner.gif" class="pay_loader" alt="blue_spinner">
		</div>

		<section class="section-alt reminder">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/img/reminder/reminder.svg" alt="reminder" class="svg reminder__img">
			<div class="reminder__content">
				<div class="reminder__text-block">
					<p class="title fz-28">Would you like to set a reminder to practice this strategy?</p>
				</div>
				<form class="form reminder__form">

					<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
					<input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
					<input type="hidden" name="timezone" value="<?php echo $user_data->time_zone; ?>">

					<div class="tabs-container">
						<div class="tabs reminder__tabs">

							<input data-tab-item="telegram" type="radio" name="method" value="telegram" id="telegram-tab" class="tab" checked>
							<label for="telegram-tab" class="label tab-label reminder__tab-label subtitle fz-16">Telegram</label>

							<input data-tab-item="push" type="radio" name="method" value="push" id="push-tab" class="tab">
							<label for="push-tab" class="label tab-label reminder__tab-label subtitle fz-16">Push notifications</label>

						</div>
						<div class="tabs__content">

							<div
								id="telegram"
								class="tab__item reminder__tab-item <?php echo !$reminders[0] || $reminders[0]->method == 'telegram' ? 'req-field active' : ''; ?>"
							>
								<p class="text fz-14 fw-600">Send a message to our bot and paste the received id into the field below</p>
								<a href="https://t.me/real_good_help_bot" class="link text fz-14 c-main" target="blank">@real_good_help_bot</a>
								<input
									type="number"
									name="telegram_id"
									class="input input-text input-numb"
									placeholder="Enter the telegram's id"
									value="<?php echo $user_data->telegram_id; ?>"
								>
							</div>


							<div
								id="push"
								class="tab__item reminder__tab-item <?php echo $reminders[0]->method == 'push' ? 'req-field active' : ''; ?>"
							>
								<p class="text fz-14 fw-600">Click on the button below to request permission to send notifications. If you have rejected it before or have banned it altogether, you will need to change your settings so that we can send you a reminder in this way</p>
								<div class="reminder__form-row">
									<input type="checkbox" id="notifications" name="notifications" class="check__input">
									<label for="notifications" class="label reminder__checkbox "></label>
									<p class="text form__text">Allow notifications</p>
								</div>
							</div>

						</div>
					</div>
					<div class="reminder__fields">

					<template id="reminder-temp">
						<div class="reminder__form-row">
							<input type="hidden" name="reminder_id[]" value="">
							<div class="form__cell req-field">
								<?php $min_date = new DateTime('tomorrow'); ?>
								<input type="date" name="date[]" class="input input-text" min="<?php echo $min_date->format('Y-m-d'); ?>">
							</div>
							<div class="form__cell req-field">
								<input type="time" name="time[]" class="input input-text">
							</div>
							<div class="form__cell req-field">
								<div class="reminder_repeat">
									<p class="text fz-16">Repeat every</p>
									<input type="number" name="repeat[]" class="input input-text input-numb" placeholder="days" min="0" max="99">
								</div>
							</div>
							<button type="button" class="button transp-button reminder__remove-button">
								<i class="icon realgh-close c-main"></i>
							</button>
						</div>
					</template>

					<?php if (!$reminders): ?>
						<div class="reminder__form-row">
							<input type="hidden" name="reminder_id[]" value="">
							<div class="form__cell req-field">
								<?php $min_date = new DateTime('tomorrow'); ?>
								<input type="date" name="date[]" class="input input-text" min="<?php echo $min_date->format('Y-m-d'); ?>">
							</div>
							<div class="form__cell req-field">
								<input type="time" name="time[]" class="input input-text">
							</div>
							<div class="form__cell req-field">
								<div class="reminder_repeat">
									<p class="text fz-16">Repeat every</p>
									<input type="number" name="repeat[]" class="input input-text input-numb" placeholder="days" min="0" max="99">
								</div>
							</div>
							<button type="button" class="button transp-button reminder__remove-button">
								<i class="icon realgh-close c-main"></i>
							</button>
						</div>
						<?php
					else:
						foreach ($reminders as $reminder):
							$rem_time = new DateTime($reminder->next_reminder . $reminder->reminder_time, new DateTimeZone(date_default_timezone_get()));
							$rem_time->setTimezone(new DateTimeZone($user_data->time_zone));
							?>
							<div class="reminder__form-row">
								<input
									type="hidden"
									name="reminder_id[]"
									value="<?php echo $reminder->id; ?>"
								>
								<div class="form__cell req-field">
									<?php $min_date = new DateTime('tomorrow'); ?>
									<input
										type="date"
										name="date[]"
										class="input input-text"
										min="<?php echo $min_date->format('Y-m-d'); ?>"
										value="<?php echo $rem_time->format('Y-m-d'); ?>"
									>
								</div>
								<div class="form__cell req-field">
									<input
										type="time"
										name="time[]"
										class="input input-text"
										value="<?php echo $rem_time->format('H:i'); ?>"
									>
								</div>
								<div class="form__cell req-field">
									<div class="reminder_repeat">
										<p class="text fz-16">Repeat every</p>
										<input
											type="number"
											name="repeat[]"
											class="input input-text input-numb"
											placeholder="days"
											min="0"
											max="99"
											value="<?php echo $reminder->days_interval; ?>"
										>
									</div>
								</div>
								<button type="button" class="button transp-button reminder__remove-button">
									<i class="icon realgh-close c-main"></i>
								</button>
							</div>
							<?php
						endforeach;
					endif;
					?>

					</div>
					<button type="button" class="button transp-button readmore__add-button">
						<i class="icon realgh-plus--fill c-main"></i>
						<span class="button-text">Add another time</span>
					</button>
					<div class="reminder__buttons-block">
						<button class="button main-button">
							<span class="button-text">Set a reminder</span>
						</button>
						<a href="" class="link button border-button">
							<span class="button-text">Continue with other subcategories</span>
						</a>
					</div>
				</form>
			</div>
		</section>
	</div>
</main>

<?php get_footer(); ?>