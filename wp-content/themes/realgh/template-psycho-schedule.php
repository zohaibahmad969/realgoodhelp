<?php 
/*
* Template name: Template Psychologist's Schedule
*/

get_header();
?>

<main class="main js-padding">
	<section class="section-alt">
		<div class="wrapper">
		<?php echo get_warning_banner('warning_padding'); ?>
			<h1 class="title fz-32 dash-schedule__title">Your schedule</h1>
			<div class="d-flex dash-schedule__text-block">
				<p class="text fz-16">This is the schedule of your consultations.<br>
				<br>
				Black cells are your scheduled sessions.<br>			
				White cells are your available slots.<br>
				Gray cells are your blocked slots.</p>
				<a href="<?php echo get_home_url(); ?>/edit-schedule" class="link button main-button button--big">
					<span class="button-text">Edit the schedule</span>
				</a>
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

					<!-- START ADDITION -->
					<template id="session-temp">
						<a href="/" class="link calendar__event">
							<img src="" alt="Avatar" class="img calendar__event-img">
							<p class="text fz-14 calendar__event-name"></p>
						</a>
					</template>

					<div class="calendar__hint">
						<p class="subtitle fz-12 fw-600 calendar-hint__name"></p>
						<p class="subtitle fz-12 fw-600 calendar-hint__text"></p>
						<p class="subtitle fz-12 fw-600 calendar-hint__text"></p>
						<p class="subtitle fz-12 fw-600 calendar-hint__text"></p>
					</div>
					<!-- END ADDITION -->

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
	</section>
</main>

<?php get_footer(); ?>