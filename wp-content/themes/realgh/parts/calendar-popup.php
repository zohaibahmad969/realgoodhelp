<div class="popup calendar__popup">
	<div class="popup__body calendar__body">
		<p class="title fz-22">Calendar</p>
		<select id="timezone" name="timezone" class="input input-text select timezone__select">
			<option value selected disabled>Select Timezone</option>
			<?php echo realgh_get_timezones('num', $args['timezone']); ?>
		</select>
		<div data-psycho="<?php echo $args['psycho_id']; ?>" class="calendar">

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
					<select name="year" class="input calendar__input subtitle fz-20 fw-600 calendar__year">
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

				<!-- START ADDITION -->
				<template id="session-temp">
					<div class="calendar__event not-allow">
						<p class="text fz-14 calendar__event-time"></p>
					</div>
				</template>

				<div class="calendar__hint">
					<p class="subtitle fz-12 fw-600 calendar-hint__text"></p>
				</div>
				<!-- END ADDITION -->

				<div class="calendar__column calendar__time-block"></div>

				<?php if (in_array("client", $args['roles'])): ?>
					<a
						href="<?php echo get_home_url(); ?>/booking?psychologist_id=<?php echo $args['psycho_id']; ?>"
						class="link calendar__table"
					>
						<div class="calendar__column calendar__day-block"></div>
						<div class="calendar__column calendar__day-block"></div>
						<div class="calendar__column calendar__day-block"></div>
						<div class="calendar__column calendar__day-block"></div>
						<div class="calendar__column calendar__day-block"></div>
						<div class="calendar__column calendar__day-block"></div>
						<div class="calendar__column calendar__day-block"></div>
					</a>
				<?php else: ?>
					<div
						data-popup="regist"
						class="calendar__table <?php echo !is_user_logged_in() ? 'js-popup' : ''; ?>"
					>
						<div class="calendar__column calendar__day-block"></div>
						<div class="calendar__column calendar__day-block"></div>
						<div class="calendar__column calendar__day-block"></div>
						<div class="calendar__column calendar__day-block"></div>
						<div class="calendar__column calendar__day-block"></div>
						<div class="calendar__column calendar__day-block"></div>
						<div class="calendar__column calendar__day-block"></div>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
		if (is_user_logged_in()):
			if (in_array("client", $args['roles'])): 
				?>
				<a
					href="<?php echo get_home_url(); ?>/booking?psychologist_id=<?php echo $args['psycho_id']; ?>"
					class="link button main-button button--big flex--fxsh-0"
				>
					<span class="button-text">book</span>
				</a>
				<?php
			endif;
		else:
			?>
			<button data-popup="regist" class="link button main-button button--big flex--fxsh-0 js-popup">
				<span class="button-text">book</span>
			</button>
		<?php endif; ?>
	</div>
</div>