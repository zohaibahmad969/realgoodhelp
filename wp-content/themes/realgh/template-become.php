<?php 
/*
* Template name: Template Become Psychologist
*/

get_header();
?>

<main class="main js-padding">
	<!-- START MAINSCREEN -->
	<section class="becomescreen ps-rel">
		<div class="wrapper becomescreen__wrapper">
			<div class="becomescreen__content">
				<h1 class="title becomescreen__title"><?php echo get_post_meta( get_the_ID(), 'realgh_main_title', true ); ?></h1>
				<div class="becomescreen__bottom">
					<p class="text fz-20 becomescreen__text"><?php echo get_post_meta( get_the_ID(), 'realgh_main_text', true ); ?></p>
					<?php if (is_user_logged_in()): ?>
					<a href="<?php echo get_permalink(get_post_meta( get_the_ID(), 'realgh_main_link_value', true )); ?>" class="link button main-button button--big">
						<span class="button-text"><?php echo get_post_meta( get_the_ID(), 'realgh_main_link_text', true ); ?></span>
					</a>
					<?php else: ?>
						<button data-popup="regist"  class="link button main-button button--big js-popup">
							<span class="button-text"><?php echo get_post_meta( get_the_ID(), 'realgh_main_link_text', true ); ?></span>
					</button>
					<?php endif; ?>
				</div>
			</div>
			<div class="bg mainscreen__bg">
			<?php realgh_print_meta_img('realgh_main_banner_image', 'img bg becomescreen__img') ?>
			</div>
		</div>
	</section>
	<!-- END MAINSCREEN -->

	<!-- START WAITING -->
	<section class="section waiting">
		<div class="wrapper">
			<div class="section__spacing section__title">
				<h2 class="title waiting__title"><?php echo get_post_meta( get_the_ID(), 'realgh_waiting_main_title', true ); ?></h2>
				<p class="text"><?php echo get_post_meta( get_the_ID(), 'realgh_waiting_main_text', true ); ?></p>
			</div>
			<div class="info__cards">
				<?php foreach (array(1, 2, 3) as $i): ?>
					<div class="info__card">
						<?php realgh_print_meta_img('realgh_waiting_card-' . $i . '_img', 'svg info-card__img'); ?>
						<h4 class="title info-card__title fz-22 tt-upp">
							<?php echo get_post_meta( get_the_ID(), 'realgh_waiting_card-' . $i . '_title', true ); ?>
						</h4>
						<p class="text fz-16">
							<?php echo get_post_meta(get_the_ID(), 'realgh_waiting_card-' . $i . '_text', true); ?>
						</p>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</section>
	<!-- END WAITING -->

	<!-- START EXPERTS -->
	<section class="section experts">
		<div class="wrapper ta-c">
			<h2 class="title experts__title">
				<?php echo get_post_meta( get_the_ID(), 'realgh_experts_title', true ); ?>
			</h2>
			<p class="text experts__text">
				<?php echo get_post_meta( get_the_ID(), 'realgh_experts_text', true ); ?>
			</p>
			<div class="experts__cards">
				<?php foreach (array(1, 2, 3, 4) as $i): ?>
					<div class="experts__card">
						<?php realgh_print_meta_img('realgh_experts_image-' . $i, 'img') ?>
					</div>
				<?php endforeach; ?>
				<div class="experts__card">
					<p class="text experts__card-text">
						<?php echo get_post_meta( get_the_ID(), 'realgh_experts_card-text', true ); ?>
					</p>
				</div>
			</div>
		</div>
	</section>
	<!-- END EXPERTS -->

	<!-- START COOPERATION -->
	<section class="section cooperation">
		<div class="wrapper">
			<h2 class="title cooperation__title cooperation__spacing cooperation__title--mobile"><?php echo get_post_meta( get_the_ID(), 'realgh_cooperation_title_heading', true ); ?></h2>
			<div class="cooperation__section cooperation__top">
				<div class="cooperation-top__left">
					<h2 class="title cooperation__title cooperation__spacing cooperation__title--desktop"><?php echo get_post_meta( get_the_ID(), 'realgh_cooperation_title_heading', true ); ?></h2>
					<div class="cooperation__section cooperation__text-block cooperation-top__text-block">
						<div class="cooperation__item">
							<p class="subtitle cooperation__subtitle"><?php echo get_post_meta( get_the_ID(), 'realgh_cooperation_title_1', true ); ?></p>
							<p class="text"><?php echo get_post_meta( get_the_ID(), 'realgh_cooperation_desc_1', true ); ?></p>
						</div>
						<div class="cooperation__item">
							<p class="subtitle cooperation__subtitle"><?php echo get_post_meta( get_the_ID(), 'realgh_cooperation_title_2', true ); ?></p>
							<p class="text"><?php echo get_post_meta( get_the_ID(), 'realgh_cooperation_desc_2', true ); ?></p>
						</div>
					</div>
				</div>
				<?php realgh_print_meta_img('realgh_cooperation_image', 'img img--bdrs-20') ?>
			</div>
			<div class="cooperation__section cooperation__bot">
				<div class="cooperation__imgs-block">
					<?php realgh_print_meta_img('realgh_cooperation_image_1', 'img img--bdrs-20 cooperation__img') ?>
					<?php realgh_print_meta_img('realgh_cooperation_image_2', 'img img--bdrs-20 cooperation__img') ?>
				</div>
				<div class="cooperation-bot__right">
					<div class="cooperation__section cooperation__text-block cooperation__spacing">
						<div class="cooperation__item">
							<p class="subtitle cooperation__subtitle"><?php echo get_post_meta( get_the_ID(), 'realgh_cooperation_title_3', true ); ?></p>
							<p class="text"><?php echo get_post_meta( get_the_ID(), 'realgh_cooperation_desc_3', true ); ?></p>
						</div>
						<div class="cooperation__item">
							<p class="subtitle cooperation__subtitle"><?php echo get_post_meta( get_the_ID(), 'realgh_cooperation_title_4', true ); ?></p>
							<p class="text"><?php echo get_post_meta( get_the_ID(), 'realgh_cooperation_desc_4', true ); ?></p>
						</div>
						<div class="cooperation__item">
							<p class="subtitle cooperation__subtitle"><?php echo get_post_meta( get_the_ID(), 'realgh_cooperation_title_5', true ); ?></p>
							<p class="text"><?php echo get_post_meta( get_the_ID(), 'realgh_cooperation_desc_5', true ); ?></p>
						</div>
					</div>
					<?php if (is_user_logged_in()) { ?>
						<a href="<?php echo get_permalink(get_post_meta( get_the_ID(), 'realgh_cooperation_link_value', true )); ?>" class="link button main-button">
							<span class="button-text"><?php echo get_post_meta( get_the_ID(), 'realgh_cooperation_link_text', true ); ?></span>
						</a>
					<?php } else{ ?>
						<button data-popup="regist" class="js-popup link button main-button">
							<span class="button-text"><?php echo get_post_meta( get_the_ID(), 'realgh_cooperation_link_text', true ); ?></span>
						</button>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>
	<!-- END COOPERATION -->

	<!-- START FAQ -->
	<section class="section faq">
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
</main>

<?php get_footer(); ?>
