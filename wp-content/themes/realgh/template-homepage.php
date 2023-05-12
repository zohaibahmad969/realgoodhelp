<?php 
/*
* Template name: Template Homepage
*/

get_header();
global $wpdb;

$top_therapists_data = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}users_data a JOIN {$wpdb->prefix}therapists_data b ON a.user_id = b.therapist_id WHERE 	top_therapists = 1");
?>

<main class="main js-padding">
	<!-- START MAINSCREEN -->
	<section class="mainscreen">
		<div class="wrapper mainscreen__wrapper">
			<div class="mainscreen__content">
				<h1 class="title mainscreen__title">
					<?php echo get_post_meta( get_the_ID(), 'realgh_main_title', true ); ?>
				</h1>
				<div class="mainscreen__bot">
					<p class="text mainscreen__text">
						<?php echo nl2br( get_post_meta( get_the_ID(), 'realgh_main_text', true ) ); ?>
					</p>
					<a
						href="<?php echo get_permalink(get_post_meta( get_the_ID(), 'realgh_main_link_value', true )); ?>"
						class="link button main-button"
					>
						<span class="button-text">
							<?php echo get_post_meta( get_the_ID(), 'realgh_main_link_text', true ); ?>
						</span>
					</a>
				</div>
			</div>
			<div class="bg mainscreen__bg">
				<?php realgh_print_meta_img('realgh_main_top_image', 'img img--bdrs-20 mainscreen__img-1') ?>
				<?php realgh_print_meta_img('realgh_main_bot_image', 'img img--bdrs-20 mainscreen__img-2') ?>
			</div>
		</div>
	</section>
	<!-- END MAINSCREEN -->

	<!-- START IMPROVE -->
	<section class="section improve">
		<div class="wrapper">
			<h2 class="title section__title section__spacing">
				<?php echo get_post_meta( get_the_ID(), 'realgh_improve_title', true ); ?>
			</h2>
			<div class="info__cards">
				<?php foreach (array(1, 2, 3) as $i): ?>
					<div class="info__card">
						<?php realgh_print_meta_img('realgh_improve_card-' . $i . '_img', 'svg info-card__img') ?>
						<h4 class="title info-card__title fz-22 tt-upp">
							<?php echo get_post_meta( get_the_ID(), 'realgh_improve_card-' . $i . '_title', true ); ?>
						</h4>
						<p class="text fz-16">
							<?php echo nl2br( get_post_meta(get_the_ID(), 'realgh_improve_card-' . $i . '_text', true) ); ?>
						</p>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</section>
	<!-- END IMPROVE -->

	<!-- START CONNECT -->
	<section class="section connect">
		<div class="wrapper">
			<div class="connect__content">
				<div class="connect__text-block">
					<h2 class="title connect__title">
						<?php echo get_post_meta( get_the_ID(), 'realgh_connect_title', true ); ?>
					</h2>
					<?php realgh_print_meta_img('realgh_connect_image', 'img img--bdrs-20 connect__img connect--mobile') ?>
					<p class="text section__spacing">
						<?php echo nl2br( get_post_meta( get_the_ID(), 'realgh_connect_text', true ) ); ?>
					</p>
					<a
						href="<?php echo get_permalink(get_post_meta( get_the_ID(), 'realgh_connect_link_value', true )); ?>"
						class="link button main-button"
					>
						<span class="button-text">
							<?php echo get_post_meta( get_the_ID(), 'realgh_connect_link_text', true ); ?>
						</span>
					</a>
				</div>
				<?php realgh_print_meta_img('realgh_connect_image', 'img img--bdrs-20 connect__img connect--desktop') ?>
			</div>
		</div>
	</section>
	<!-- END CONNECT -->

	<!-- START WORK -->
	<section class="section work" style="display: none;">
		<div class="wrapper">
			<div class="work__content">
				<h2 class="title work__title">
					<?php echo get_post_meta( get_the_ID(), 'realgh_work_title', true ); ?>
				</h2>
				<div class="work__img-block">
					<button class="button play-button work__button">
						<i class="icon realgh-play"></i>
					</button>
					<?php realgh_print_meta_img('realgh_work_image', 'img work__img') ?>
				</div>
				<ul class="work__list">
					<?php foreach (array(1, 2, 3) as $i): ?>
						<li class="work__item">
							<i class="icon realgh-check-circle work__icon"></i>
							<h4 class="subtitle">
								<?php echo get_post_meta( get_the_ID(), 'realgh_work_item-' . $i . '_title', true ); ?>
							</h4>
							<p class="text">
								<?php echo nl2br( get_post_meta(get_the_ID(), 'realgh_work_item-' . $i . '_text', true) ); ?>
							</p>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</section>
	<!-- END WORK -->

	<!-- START ADVANTAGES -->
	<section class="section advantages" style="display: none;">
		<div class="wrapper">
			<h2 class="title advantages__title advantages__title--mobile">
				<?php echo get_post_meta( get_the_ID(), 'realgh_advantages_title', true ); ?>
			</h2>
			<div class="advantages__section advantages__top">
				<div class="advantages-top__left">
					<h2 class="title advantages__title advantages__title--desktop">
						<?php echo get_post_meta( get_the_ID(), 'realgh_advantages_title', true ); ?>
					</h2>
					<div class="advantages__item">
						<div class="advantages-item__top">
							<p class="title advantages__number">#1</p>
							<h4 class="subtitle fz-28">
								<?php echo get_post_meta( get_the_ID(), 'realgh_advantages_item-1_title', true ); ?>
							</h4>
						</div>
						<div class="advatages-item__text-block">
							<p class="text">
								<?php echo nl2br( get_post_meta(get_the_ID(), 'realgh_advantages_item-1_text', true) ); ?>
							</p>
							<a
								href="<?php echo get_permalink(get_post_meta( get_the_ID(), 'realgh_advantages_link_value', true )); ?>"
								class="link button main-button advantages__button"
							>
								<span class="button-text">
									<?php echo get_post_meta( get_the_ID(), 'realgh_advantages_link_text', true ); ?>
								</span>
							</a>
						</div>
					</div>
				</div>
				<?php realgh_print_meta_img('realgh_advantages_top_image', 'img img--bdrs-20 advantages__top-img') ?>
			</div>
			<div class="advantages__section advantages__bot">
				<div class="advantages__imgs-block">
					<div class="advantages__imgs-column">
						<?php realgh_print_meta_img('realgh_advantages_bot_image-1', 'img img--bdrs-20') ?>
						<?php realgh_print_meta_img('realgh_advantages_bot_image-2', 'img img--bdrs-20') ?>
					</div>
					<div class="advantages__imgs-column">
						<?php realgh_print_meta_img('realgh_advantages_bot_image-3', 'img img--bdrs-20') ?>
						<?php realgh_print_meta_img('realgh_advantages_bot_image-4', 'img img--bdrs-20') ?>
					</div>
				</div>
				<div class="advantages-bot__content">
					<?php foreach (array(2, 3) as $i): ?>
						<div class="advantages__item">
							<div class="advantages-item__top">
								<p class="title advantages__number">#<?php echo $i; ?></p>
								<h4 class="subtitle fz-28">
									<?php echo get_post_meta( get_the_ID(), 'realgh_advantages_item-' . $i . '_title', true ); ?>
								</h4>
							</div>
							<div class="advatages-item__text-block">
								<p class="text">
									<?php echo nl2br( get_post_meta(get_the_ID(), 'realgh_advantages_item-' . $i . '_text', true) ); ?>
								</p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>
	<!-- END ADVANTAGES -->

	<!-- START EXPERTS -->
	<section class="section experts" style="display: none;">
		<div class="wrapper ta-c">
			<h2 class="title experts__title">
				<?php echo get_post_meta( get_the_ID(), 'realgh_experts_title', true ); ?>
			</h2>
			<p class="text experts__text">
				<?php echo nl2br( get_post_meta( get_the_ID(), 'realgh_experts_text', true ) ); ?>
			</p>
			<div class="experts__cards_desk">
				<?php
					$last_key = array_key_last($top_therapists_data);
					foreach ($top_therapists_data as $key => $single_top_therapists_data):
						if($key == 0 || $key % 5 == 0){
							if($key > 0 && $key % 5 == 0){
								echo '</div>';
							}
							echo '<div class="experts__cards">';
						}
						$userImg = $single_top_therapists_data->user_profile_pic;
						if (!$userImg) {
							if (get_avatar_url($single_top_therapists_data->user_id)) {
								$userImg = get_avatar_url($single_top_therapists_data->user_id);
							} else {
								$userImg = get_template_directory_uri() . "/assets/img/dummy-profile-image.png";
							}
						}
				?>
					<div class="experts__card">
						<a href="<?php echo get_permalink( get_page_by_path( 'psychologist-profile' ) ) ?>?psychologist_id=<?php echo $single_top_therapists_data->user_id; ?>" class="all-therapist-img">
							<img src="<?php echo $userImg; ?>" alt="Psychologist <?php echo $key; ?>" class="img" loading="lazy">
						</a>
					</div>
				<?php
					if($key == $last_key){
						echo '</div>';
					} 
				endforeach; ?>
			</div>

			<div class="experts__cards_mob">
				<?php
					$last_key = array_key_last($top_therapists_data);
					foreach ($top_therapists_data as $key => $single_top_therapists_data):
						if($key == 0 || $key % 3 == 0){
							if($key > 0 && $key % 3 == 0){
								echo '</div>';
							}
							echo '<div class="experts__cards">';
						}
						$userImg = $single_top_therapists_data->user_profile_pic;
						if (!$userImg) {
							if (get_avatar_url($single_top_therapists_data->user_id)) {
								$userImg = get_avatar_url($single_top_therapists_data->user_id);
							} else {
								$userImg = get_template_directory_uri() . "/assets/img/dummy-profile-image.png";
							}
						}
				?>
					<div class="experts__card">
						<a href="<?php echo get_permalink( get_page_by_path( 'psychologist-profile' ) ) ?>?psychologist_id=<?php echo $single_top_therapists_data->user_id; ?>" class="all-therapist-img">
							<img src="<?php echo $userImg; ?>" alt="Psychologist <?php echo $key; ?>" class="img" loading="lazy">
						</a>
					</div>
				<?php
					if($key == $last_key){
						echo '</div>';
					} 
				endforeach; ?>
			</div>
		</div>
	</section>
	<!-- END EXPERTS -->

	<!-- START HELP -->
	<section class="section help" style="display: none;">
		<div class="wrapper">
			<h2 class="title section__title section__spacing">
				<?php echo get_post_meta( get_the_ID(), 'realgh_help_title', true ); ?>
			</h2>
			<div class="info__cards">
				<?php foreach (array(1, 2, 3) as $i): ?>
					<div class="info__card">
						<?php realgh_print_meta_img('realgh_help_card-' . $i . '_img', 'svg info-card__img') ?>
						<h4 class="title info-card__title fz-22 tt-upp">
							<?php echo get_post_meta( get_the_ID(), 'realgh_help_card-' . $i . '_title', true ); ?>
						</h4>
						<p class="text fz-16">
							<?php echo nl2br( get_post_meta( get_the_ID(), 'realgh_help_card-' . $i . '_text', true ) ); ?>
						</p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<!-- END HELP -->

	<!-- START REVIEWS -->
	<!-- <section class="section reviews">
		<div class="wrapper">
			<h2 class="title section__title section__spacing ta-c">
				<?php echo get_post_meta( get_the_ID(), 'realgh_reviews_title', true ); ?>
			</h2>
			<div class="slider auto-slider slider--spacing">
				<div class="slider__tape slider__tape--points">
					<?php
					$review_rep = get_post_meta(get_the_ID(), 'realgh_re_reviews', true);
					foreach ($review_rep as $arr) :
					?>
						<div class="slider__item reviews__slider-item">
							<div class="review__card">
								<p class="text review__text">
									<?php echo nl2br( $arr['realgh_reviews_text'] ); ?>
								</p>
								<div class="review__profile">
									<img
										src="<?php echo $arr['realgh_reviews_image']['url']; ?>"
										alt="Client"
										class="img review__img"
									>
									<div class="review__content">
										<p class="subtitle review__user-name">
											<?php echo $arr['realgh_review_name']; ?>
										</p>
										<div class="rating review__rating">
											<?php for ($i = 1; $i <= 5; $i++): ?>
												<img
													src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/star<?php echo $arr['realgh_review_score'] < $i ? '' : '--fill' ?>.svg"
													alt="Rating"
													class="svg rating__star"
												>
											<?php endfor; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="slider__points"></div>
			</div>
		</div>
	</section> -->
	<!-- END REVIEWS -->

	<!-- START FAQ -->
	<section class="section faq" style="display: none;">
		<div class="wrapper">
			<h2 class="title section__title section__spacing ta-c">
				<?php echo get_post_meta( get_the_ID(), 'realgh_faq_title', true ); ?>
			</h2>
			<div class="faq__content">
				<?php
				$faq_rep = get_post_meta(get_the_ID(), 'realgh_re_faq', true);
				foreach ($faq_rep as $arr) :
				?>
					<div class="readmore__container faq__readmore-container">
						<div class="readmore">
							<div class="readmore__cover faq__readmore-cover d-flex">
								<h4 class="title faq__readmore-title">
									<?php echo $arr['realgh_faq_quest']; ?>
								</h4>
								<button class="button readmore__button faq__readmore-button">
									<i class="icon realgh-chevron-right"></i>
								</button>
							</div>
							<div class="readmore__more">
								<p class="text faq__text faq__top-text">
									<?php echo nl2br( $arr['realgh_faq_answer'] ); ?>
								</p>
								<?php if ($arr['conditinal_list']['enabled']): ?>
									<ul class="list">
										<?php
										$list = explode("\n", $arr['conditinal_list']['realgh_answer_list']);

										foreach ($list as $item):
										?>
											<li class="list__item text faq__text">
												<?php echo $item; ?>
											</li>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<!-- END FAQ -->

	<!-- START JOIN -->
	<section class="join" style="display: none;">
		<div class="wrapper join__wrapper">
			<div class="join__content">
				<?php realgh_print_meta_img('realgh_join_image', 'img bg') ?>
				<div class="bg tint"></div>
				<h2 class="title join__title">
					<?php echo get_post_meta( get_the_ID(), 'realgh_join_title', true ); ?>
				</h2>
				<p class="text join__text">
					<?php echo get_post_meta( get_the_ID(), 'realgh_join_text', true ); ?>
				</p>
				<a
					href="<?php echo get_permalink(get_post_meta( get_the_ID(), 'realgh_join_link_value', true )); ?>"
					class="link button main-button join__button"
				>
					<span class="button-text">
						<?php echo get_post_meta( get_the_ID(), 'realgh_join_link_text', true ); ?>
					</span>
				</a>
			</div>
		</div>
	</section>
	<!-- END JOIN -->
</main>

<?php get_footer(); ?>