<?php 
/*
* Template name: Template psychologists new
*/

get_header();


global $wpdb;
global $specialisations;

$current_user = wp_get_current_user();
$roles = $current_user->roles;

get_template_part('parts/money-back', 'popup');
get_template_part('parts/filter', 'popup', array('specialisations' => $specialisations));

$therapists = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}users a JOIN {$wpdb->prefix}usermeta b ON a.ID = b.user_id JOIN {$wpdb->prefix}users_data c ON a.ID = c.user_id JOIN {$wpdb->prefix}therapists_data d ON a.ID = d.therapist_id JOIN {$wpdb->prefix}therapists_settings e ON a.ID = e.therapist_id WHERE b.meta_key = '{$wpdb->prefix}capabilities' and b.meta_value like '%therapist%' ORDER BY a.user_nicename");

$therapists = wp_unslash ($therapists);

$total_therapists = 0;
?>

<main class="main js-padding">

	<div class="extend">
		<div class="wrapper">

			<form class="filter">
				<div class="form__relative-block">
					<!-- <input type="text" class="input input-text filter__item filter__input" name="search" placeholder="Name">
					<button type="button" class="button main-button filter__button">
						<i class="icon realgh-search"></i>
					</button> -->
				</div>
				<div class="filter__options">
					<!-- START DROP-DOWN -->
					<div class="dropdown__container">
						<div class="dropdown__button filter__item">
							<p class="text fz-14 fw-600">Price</p>
							<i class="icon realgh-chevron-down"></i>
						</div>
						<div class="dropdown filter__dropdown">
							<div class="filter__dropdown-content">
								<ul class="filter__list">
									<li class="filter__list-item">
										<input type="checkbox" id="price-1" value="< 10" name="price[]" class="input check__input">
										<label for="price-1" class="label check__label checkbox__label text form__text filter__label">&lt; $10</label>
									</li>
									<li class="filter__list-item">
										<input type="checkbox" id="price-2" value="10-29" name="price[]" class="input check__input">
										<label for="price-2" class="label check__label checkbox__label text form__text filter__label">$10 - $29</label>
									</li>
									<li class="filter__list-item">
										<input type="checkbox" id="price-3" value="30-49" name="price[]" class="input check__input">
										<label for="price-3" class="label check__label checkbox__label text form__text filter__label">$30 - $49</label>
									</li>
									<li class="filter__list-item">
										<input type="checkbox" id="price-4" value="50-99" name="price[]" class="input check__input">
										<label for="price-4" class="label check__label checkbox__label text form__text filter__label">$50 - $99</label>
									</li>
									<li class="filter__list-item">
										<input type="checkbox" id="price-5" value=">= 100" name="price[]" class="input check__input">
										<label for="price-5" class="label check__label checkbox__label text form__text filter__label">&gt;= $100</label>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- END DROP-DOWN -->

					<!-- START DROP-DOWN -->
					<div class="dropdown__container">
						<div class="dropdown__button filter__item">
							<p class="text fz-14 fw-600">Qualification</p>
							<i class="icon realgh-chevron-down"></i>
						</div>
						<div class="dropdown filter__dropdown">
							<div class="filter__dropdown-content">
								<ul class="filter__list">
									<li class="filter__list-item">
										<input type="checkbox" id="qualification-1" value="Clinical Psychologist" name="qualification[]" class="input check__input">
										<label for="qualification-1" class="label check__label checkbox__label text form__text filter__label">Clinical Psychologist</label>
									</li>
									<li class="filter__list-item">
										<input type="checkbox" id="qualification-2" value="Counselling Psychologist" name="qualification[]" class="input check__input">
										<label for="qualification-2" class="label check__label checkbox__label text form__text filter__label">Counselling Psychologist</label>
									</li>
									<li class="filter__list-item">
										<input type="checkbox" id="qualification-3" value="Psychiatrist" name="qualification[]" class="input check__input">
										<label for="qualification-3" class="label check__label checkbox__label text form__text filter__label">Psychiatrist</label>
									</li>
									<li class="filter__list-item">
										<input type="checkbox" id="qualification-4" value="Counsellor" name="qualification[]" class="input check__input">
										<label for="qualification-4" class="label check__label checkbox__label text form__text filter__label">Counsellor</label>
									</li>
									<li class="filter__list-item">
										<input type="checkbox" id="qualification-5" value="Coach" name="qualification[]" class="input check__input">
										<label for="qualification-5" class="label check__label checkbox__label text form__text filter__label">Coach</label>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- END DROP-DOWN -->

					<!-- START DROP-DOWN -->
					<div class="dropdown__container">
						<div class="dropdown__button filter__item">
							<p class="text fz-14 fw-600">Specialisation</p>
							<i class="icon realgh-chevron-down"></i>
						</div>
						<div class="dropdown filter__dropdown">
							<div class="filter__dropdown-content">
								<ul class="filter__list">
								<?php
								$i = 0;
								foreach ($specialisations as $single):
									?>
									<li class="filter__list-item">
										<input
											type="checkbox"
											id="specialization-<?php echo $i; ?>"
											value="<?php echo $single; ?>"
											name="specialization[]"
											class="input check__input"
										>
										<label
											for="specialization-<?php echo $i; ?>"
											class="label check__label checkbox__label text form__text filter__label"
										>
											<?php echo $single; ?>
										</label>
									</li>
									<?php
									$i++;
								endforeach;
								?>
								</ul>
							</div>
						</div>
					</div>
					<!-- END DROP-DOWN -->

					<!-- START DROP-DOWN -->
					<div class="dropdown__container">
						<div class="dropdown__button filter__item">
							<p class="text fz-14 fw-600">Method</p>
							<i class="icon realgh-chevron-down"></i>
						</div>
						<div class="dropdown filter__dropdown">
							<div class="filter__dropdown-content">
								<ul class="filter__list">
									<li class="filter__list-item">
										<input type="checkbox" id="method-1" value="Psychoanalytic therapy" name="main_method[]" class="input check__input">
										<label for="method-1" class="label check__label checkbox__label text form__text filter__label">Psychoanalytic therapy</label>
									</li>
									<li class="filter__list-item">
										<input type="checkbox" id="method-2" value="Transactional analysis" name="main_method[]" class="input check__input">
										<label for="method-2" class="label check__label checkbox__label text form__text filter__label">Transactional analysis</label>
									</li>
									<li class="filter__list-item">
										<input type="checkbox" id="method-3" value="Gestalt therapy" name="main_method[]" class="input check__input">
										<label for="method-3" class="label check__label checkbox__label text form__text filter__label">Gestalt therapy</label>
									</li>
									<li class="filter__list-item">
										<input type="checkbox" id="method-4" value="Existential therapy" name="main_method[]" class="input check__input">
										<label for="method-4" class="label check__label checkbox__label text form__text filter__label">Existential therapy</label>
									</li>
									<li class="filter__list-item">
										<input type="checkbox" id="method-5" value="Systemic family approach" name="main_method[]" class="input check__input">
										<label for="method-5" class="label check__label checkbox__label text form__text filter__label">Systemic family approach</label>
									</li>
									<li class="filter__list-item">
										<input type="checkbox" id="method-6" value="CBT" name="main_method[]" class="input check__input">
										<label for="method-6" class="label check__label checkbox__label text form__text filter__label">CBT</label>
									</li>
									<li class="filter__list-item">
										<input type="checkbox" id="method-7" value="Psychodrama" name="main_method[]" class="input check__input">
										<label for="method-7" class="label check__label checkbox__label text form__text filter__label">Psychodrama</label>
									</li>
									<li class="filter__list-item">
										<input type="checkbox" id="method-8" value="Integrative therapy" name="main_method[]" class="input check__input">
										<label for="method-8" class="label check__label checkbox__label text form__text filter__label">Integrative therapy</label>
									</li>
									<li class="filter__list-item">
										<input type="checkbox" id="method-9" value="Other" name="main_method[]" class="input check__input">
										<label for="method-9" class="label check__label checkbox__label text form__text filter__label">Other</label>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- END DROP-DOWN -->

					<!-- START DROP-DOWN -->
					<div class="dropdown__container">
						<div class="dropdown__button filter__item">
							<p class="text fz-14 fw-600">Work Experience</p>
							<i class="icon realgh-chevron-down"></i>
						</div>
						<div class="dropdown filter__dropdown">
							<div class="filter__dropdown-content">
								<ul class="filter__list">
									<li class="filter__list-item">
										<input type="checkbox" id="experience-1" value="1-2" name="experience[]" class="input check__input">
										<label for="experience-1" class="label check__label checkbox__label text form__text filter__label">1 - 2 years</label>
									</li>
									<li class="filter__list-item">
										<input type="checkbox" id="experience-2" value="3-4" name="experience[]" class="input check__input">
										<label for="experience-2" class="label check__label checkbox__label text form__text filter__label">3 - 4 years</label>
									</li>
									<li class="filter__list-item">
										<input type="checkbox" id="experience-3" value="5-10" name="experience[]" class="input check__input">
										<label for="experience-3" class="label check__label checkbox__label text form__text filter__label">5 - 10 years</label>
									</li>
									<li class="filter__list-item">
										<input type="checkbox" id="experience-4" value="> 10" name="experience[]" class="input check__input">
										<label for="experience-4" class="label check__label checkbox__label text form__text filter__label">&gt; 10 years</label>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- END DROP-DOWN -->

					<!-- START DROP-DOWN -->
					<div class="dropdown__container">
						<div class="dropdown__button filter__item">
							<p class="text fz-14 fw-600">Language</p>
							<i class="icon realgh-chevron-down"></i>
						</div>
						<div class="dropdown filter__dropdown">
							<div class="filter__dropdown-content">
								<ul class="filter__list">
									<li class="filter__list-item">
										<input type="checkbox" id="language-1" value="Mandarin" name="languages[]" class="input check__input">
										<label for="language-1" class="label check__label checkbox__label text form__text filter__label">Mandarin</label>
									</li>
									<li class="filter__list-item">
										<input type="checkbox" id="language-2" value="Hindi" name="languages[]" class="input check__input">
										<label for="language-2" class="label check__label checkbox__label text form__text filter__label">Hindi</label>
									</li>
									<li class="filter__list-item">
										<input type="checkbox" id="language-3" value="Spanish" name="languages[]" class="input check__input">
										<label for="language-3" class="label check__label checkbox__label text form__text filter__label">Spanish</label>
									</li>
									<li class="filter__list-item">
										<input type="checkbox" id="language-4" value="Russian" name="languages[]" class="input check__input">
										<label for="language-4" class="label check__label checkbox__label text form__text filter__label">Russian</label>
									</li>
									<li class="filter__list-item">
										<input type="checkbox" id="language-5" value="Other" name="languages[]" class="input check__input">
										<label for="language-5" class="label check__label checkbox__label text form__text filter__label">Other</label>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- END DROP-DOWN -->

					<!-- START DROP-DOWN -->
					<div class="dropdown__container">
						<div class="dropdown__button filter__item">
							<i class="icon realgh-sort-by"></i>
							<p class="text fz-14 fw-600">Sort by</p>
						</div>
						<div class="dropdown filter__dropdown">
							<div class="filter__dropdown-content">
								<ul class="filter__list">
									<li class="filter__list-item">
										<input type="radio" id="sort-by-1" value="name" name="sort-by" class="input check__input" checked>
										<label for="sort-by-1" class="label check__label checkbox__label text form__text filter__label">Name</label>
									</li>
									<li class="filter__list-item">
										<input type="radio" id="sort-by-2" value="price_asc" name="sort-by" class="input check__input">
										<label for="sort-by-2" class="label check__label checkbox__label text form__text filter__label">Price ascending</label>
									</li>
									<li class="filter__list-item">
										<input type="radio" id="sort-by-3" value="price_desc" name="sort-by" class="input check__input">
										<label for="sort-by-3" class="label check__label checkbox__label text form__text filter__label">Price descending</label>
									</li>
									<li class="filter__list-item">
										<input type="radio" id="sort-by-4" value="exp_asc" name="sort-by" class="input check__input">
										<label for="sort-by-4" class="label check__label checkbox__label text form__text filter__label">Experience ascending</label>
									</li>
									<li class="filter__list-item">
										<input type="radio" id="sort-by-5" value="exp_desc" name="sort-by" class="input check__input">
										<label for="sort-by-5" class="label check__label checkbox__label text form__text filter__label">Experience descending</label>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- END DROP-DOWN -->
				</div>
				<button type="button" data-popup="filter" class="button filter__item filter__popup-button js-popup">
					<i class="icon realgh-filter"></i>
					<span class="button-text">Filters</span>
				</button>
			</form>

		</div>
	</div>
	<section class="psychologists">
		<div class="wrapper wrapper--small">
			<div class="psycho__top">
				<p class="text note fz-18 psycho__note">
					<?php echo get_post_meta( get_the_ID(), 'realgh_count_label', true ); ?>
				</p>
				<h1 class="title psycho__title">
					<?php echo get_post_meta( get_the_ID(), 'realgh_main_title', true ); ?>
				</h1>
				<p class="text fz-18">
					<?php echo nl2br(get_post_meta( get_the_ID(), 'realgh_main_text', true )); ?>
				</p>

			</div>

			<!-- START TEMPLATE -->
			<template id="psycho-card-temp">
				<a href="<?php echo get_permalink( get_page_by_path( 'psychologist-profile' ) ) . '?psychologist_id='; ?>" class="link psycho__card">
					<div class="psycho-card__account-block">
						<div class="psycho-card__account-top">
							<img src="" alt="Psychologist" class="img img--bdrs-20 psycho-card__img" loading="lazy">
						</div>
						<div class="psycho-card__info psycho-info--mobile">
							<div class="info__section">
								<p class="text note">30 min trial:</p>
								<p class="text fw-600 psycho-card__30-rate"></p>
							</div>
							<div class="info__section">
								<p class="text note">Hourly rate from:</p>
								<p class="text fw-600 psycho-card__60-rate"></p>
							</div>
						</div>

						<button data-popup="money-back" class="button bookButton psycho-card__button--desktop money-back-btn link js-popup">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/100-percent.png" alt="Guarantee" loading="lazy">
							<span class="button-text">100% Guarantee</span>
						</button>

						<?php
						if ( is_user_logged_in() ):
							if(in_array("client", $roles)):
								?>
								<button
									data-href="<?php echo get_home_url(); ?>/booking?psychologist_id="
									class="button main-button bookButton psycho-card__button--desktop js-link"
								>
									<span class="button-text">Book</span>
								</button>
								<?php
							endif;
						else:
							?>
							<button data-popup="regist" class="button main-button bookButton psycho-card__button--desktop js-popup">
								<span class="button-text">Book</span>
							</button>
						<?php endif; ?>
					</div>
					<div class="psycho-card__info cus-psycho-card-info">	
						<div class="psycho-card__info-top">
							<p class="subtitle fz-18 psycho-card__name"></p>
							<p class="text fz-14 psycho-card__qual"></p>
						</div>
						<div class="info__section">
							<p class="text note">Specialization</p>
							<ul class="list psycho-card__grid psycho-card__spec"></ul>
						</div>
						<div class="psycho-card__grid">
							<div class="info__section">
								<p class="text note">Work experience:</p>
								<p class="text fz-16 fw-600 psycho-card__exp"></p>
							</div>
							<div class="info__section">
								<p class="text note">Method:</p>
								<p class="text fz-16 fw-600 tt-cap psycho-card__method"></p>
							</div>
						</div>
						<div class="psycho-card__grid psycho-info--desktop">
							<div class="info__section">
								<p class="text note">Trial (30 minutes):</p>
								<p class="text fz-16 fw-600 psycho-card__30-rate"></p>
							</div>
							<div class="info__section">
								<p class="text note">Hourly rate:</p>
								<p class="text fz-16 fw-600 psycho-card__60-rate"></p>
							</div>
						</div>
					</div>

					<button data-popup="money-back"  class="button bookButton psycho-card__button--mobile money-back-btn link js-popup">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/img/100-percent.png" alt="Guarantee" loading="lazy">
						<span class="button-text">100% Guarantee</span>
					</button>

					<?php
					if ( is_user_logged_in() ):
						if(in_array("client", $roles)):
							?>
							<button
								data-href="/booking?psychologist_id=<?php echo $single_therapist->ID; ?>"
								class="button main-button psycho-card__button psycho-card__button--mobile js-link"
							>
								<span class="button-text">Book</span>
							</button>
							<?php
						endif;
					else:
						?>
						<button data-popup="regist" class="button main-button psycho-card__button psycho-card__button--mobile link js-popup">
							<span class="button-text">Book</span>
						</button>
					<?php endif; ?>

					<div class="tabs-container psycho-card__tabs-block">
						<div class="tabs psycho-card__tabs">
							
							<div class="tab-block">
								<input
									data-tab-item="intro-"
									type="radio"
									name="tab-"
									id="intro-tab-"
									class="tab"
									checked
								>
								<label
									for="intro-tab-"
									class="label tab-label text fz-16 fw-600 psycho-card__tab-label"
								>Intro</label>
							</div>
						</div>
						<div class="tabs__content psycho-card__tab-content">
							<div
								id="intro-"
								class="tab__item psycho-card__tab-item psycho-card__intro-tab active"
							>
								<p class="text note psycho-card__intro-text"></p>
							</div>
						</div>
					</div>
				</a>
			</template>
			<!-- END TEMPLATE -->

			<div class="psycho__cards">

				<?php foreach($therapists as $key => $single_therapist) { 
					if($single_therapist->account_status == 'verified' && ($single_therapist->half_rate || $single_therapist->hourly_rate || $single_therapist->chat_rate) && $single_therapist->availability_hours != '[]' && $single_therapist->availability_hours){
				?>
					<a href="<?php echo get_permalink( get_page_by_path( 'psychologist-profile' ) ) . '?psychologist_id=' . $single_therapist->ID; ?>" class="link psycho__card">
						<div class="psycho-card__account-block">
							<div class="psycho-card__account-top">
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
								<img src="<?php echo $userImg; ?>" alt="Psychologist" class="img img--bdrs-20 psycho-card__img" loading="lazy">
							</div>
							<div class="psycho-card__info psycho-info--mobile">
								<div class="info__section">
									<p class="text note">
										30 min trial:</p>
									<p class="text fw-600"><?php echo CURRENCY . ' ' . $single_therapist->half_rate; ?></p>
								</div>
								<div class="info__section">
									<p class="text note">
										Hourly rate from:</p>
									<p class="text fw-600"><?php echo CURRENCY . ' ' . $single_therapist->hourly_rate; ?></p>
								</div>
							</div>

							<?php if ($single_therapist->money_back_guarantee == '1'): ?>
								<button data-popup="money-back"  class="button bookButton psycho-card__button--desktop money-back-btn link js-popup">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/img/100-percent.png" alt="Guarantee" loading="lazy">
									<span class="button-text">100% Guarantee</span>
								</button>
							<?php endif; ?>

							<?php
							if ( is_user_logged_in() ):
								if(in_array("client", $roles)):
									?>
									<button
										data-href="<?php echo get_home_url(); ?>/booking?psychologist_id=<?php echo $single_therapist->ID; ?>"
										class="button main-button bookButton psycho-card__button--desktop js-link"
									>
										<span class="button-text">Book</span>
									</button>
									<?php
								endif;
							else:
								?>
								<button data-popup="regist" class="button main-button bookButton psycho-card__button--desktop js-popup">
									<span class="button-text">Book</span>
								</button>
							<?php endif; ?>
						</div>
						<div class="psycho-card__info cus-psycho-card-info">	
							<div class="psycho-card__info-top">
								<p class="subtitle fz-18">
									<?php echo get_user_meta( $single_therapist->ID, 'first_name', true ) . " " . get_user_meta( $single_therapist->ID, 'last_name', true ); ?>
								</p>
								<p class="text fz-14"><?php echo $single_therapist->qualification; ?></p>
							</div>
							<div class="info__section">
								<p class="text note">Specialization</p>
								<ul class="list psycho-card__grid">
								<?php 
									$final_specialization = [];
									$exploded_first = explode('";', $single_therapist->specialization); 
									foreach($exploded_first as $single_exploded_first){
										if (strpos($single_exploded_first, '"') !== false) {
											$exploded_second = explode('"', $single_exploded_first);
											$final_specialization[] = str_replace("_"," ",$exploded_second[1]);
										}
									}
									foreach ($final_specialization as $specialization):
								?>
									<li class="list__item text fz-14 fw-600 tt-cap">
										<?php echo $specialization; ?>
									</li>
								<?php endforeach; ?>
								</ul>
							</div>
							<div class="psycho-card__grid">
								<div class="info__section">
									<p class="text note">Work experience:</p>
									<p class="text fz-16 fw-600">
										<?php echo $single_therapist->experience . ' years'; ?></p>
								</div>
								<div class="info__section">
									<p class="text note">Method:</p>
								<?php 
									$final_method = [];
									$exploded_first = explode('";', $single_therapist->main_method); 
									foreach($exploded_first as $single_exploded_first){
										if (strpos($single_exploded_first, '"') !== false) {
											$exploded_second = explode('"', $single_exploded_first);
											$final_method[] = str_replace("_"," ",$exploded_second[1]);;
										}
									}
									foreach ($final_method as $main_method):
								?>
									<p class="text fz-16 fw-600 tt-cap">
										<?php if($main_method == 'Other') {
											echo $single_therapist->other_main_method;
										 } else 
										 {
											echo $main_method;
										} ?>
									</p>
								<?php endforeach; ?>
								</div>
							</div>
							<div class="psycho-card__grid psycho-info--desktop">
								<div class="info__section">
									<p class="text note">Trial (30 minutes):</p>
									<p class="text fz-16 fw-600">
									<?php echo $single_therapist->half_rate . ' ' . CURRENCY; ?></p>
								</div>
								<div class="info__section">
									<p class="text note">Hourly rate:</p>
									<p class="text fz-16 fw-600"><?php echo $single_therapist->hourly_rate . ' ' . CURRENCY; ?></p>
								</div>
							</div>
						</div>
						<?php if ($single_therapist->money_back_guarantee == '1'): ?>
							<button data-popup="money-back"  class="button bookButton psycho-card__button--mobile money-back-btn link js-popup">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/img/100-percent.png" alt="Guarantee" loading="lazy">
								<span class="button-text">100% Guarantee</span>
							</button>
						<?php endif; ?>
						<?php
						if ( is_user_logged_in() ):
							if(in_array("client", $roles)):
								?>
								<button
									data-href="<?php echo get_home_url(); ?>/booking?psychologist_id=<?php echo $single_therapist->ID; ?>"
									class="button main-button psycho-card__button psycho-card__button--mobile js-link"
								>
									<span class="button-text">Book</span>
								</button>
								<?php
							endif;
						else:
							?>
							<button data-popup="regist" class="button main-button psycho-card__button psycho-card__button--mobile link js-popup">
								<span class="button-text">Book</span>
							</button>
						<?php endif; ?>

						<div class="tabs-container psycho-card__tabs-block">
							<div class="tabs psycho-card__tabs">
								
								<div class="tab-block">
									<input
										data-tab-item="intro-<?php echo $single_therapist->ID; ?>"
										type="radio"
										name="tab-<?php echo $single_therapist->ID; ?>"
										id="intro-tab-<?php echo $single_therapist->ID; ?>"
										class="tab"
										checked
									>
									<label
										for="intro-tab-<?php echo $single_therapist->ID; ?>"
										class="label tab-label text fz-16 fw-600 psycho-card__tab-label"
									>Intro</label>
								</div>
							</div>
							<div class="tabs__content psycho-card__tab-content">
								<div
									id="intro-<?php echo $single_therapist->ID; ?>"
									class="tab__item psycho-card__tab-item psycho-card__intro-tab active"
								>
									<p class="text note psycho-card__intro-text"><?php echo $single_therapist->about_myself; ?></p>
								</div>
							</div>
						</div>
					</a>
				<?php $total_therapists++; } } ?>
			</div>

			<div class="show-more__block">
                <a
                	href="<?php echo get_post_meta( get_the_ID(), 'realgh_bot_link_value', true ); ?>"
                	class="link button border-button"
                >
                    <span class="button-text">
                    	<?php echo get_post_meta( get_the_ID(), 'realgh_bot_link_text', true ); ?>
                    </span>
                </a>
                <p class="text note fz-18"><span class="c-text">Showing</span> <span class="psycho__cur-count"><?php echo $total_therapists; ?></span> out of <span class="psycho__glob-count"><?php echo $total_therapists; ?></span></p>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>