<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package realgh
 */

global $rlgh_data;
?>

<div class="cp-action-popup">
	<div class="cp-action-popup-inner">
		<h2 class="title">Strategy was saved in My Progress</h2>
	</div>
</div>
<footer class="footer">
	<div class="wrapper">
		<div class="footer__content footer__top">
			<div class="footer__column">
				<h6 class="subtitle footer__title c-white">
					Company
				</h6>
				<div class="footer__links">
					<a href="<?php echo get_home_url("/welcome-to-real-good-help"); ?>" class="link footer__link text footer__text">
						About us
					</a>
					<a href="<?php echo get_home_url("/welcome-to-real-good-help"); ?>" class="link footer__link text footer__text">
						FAQ
					</a>
					<a href="<?php echo get_home_url("/news"); ?>" class="link footer__link text footer__text">
						News
					</a>
					<a data-popup="support" class="link footer__link text footer__text js-popup">
						Support
					</a>
					<a href="<?php echo $rlgh_data['policy_value']; ?>" class="link footer__link text footer__text">
						<?php echo $rlgh_data['policy']; ?>
					</a>
					<a href="<?php echo $rlgh_data['terms_value']; ?>" class="link footer__link text footer__text">
						<?php echo $rlgh_data['terms']; ?>
					</a>
				</div>
			</div>
			<?php get_sidebar('footer-columns'); ?>
			<div class="footer__column">
				<h6 class="subtitle footer__title c-white">
					<?php echo $rlgh_data['contact_title']; ?>
				</h6>
				<address class="footer__contacts">
					<a href="tel:<?php echo $rlgh_data['phone']; ?>" class="link footer__link footer__contact">
						<i class="icon realgh-phone"></i>
						<p class="text footer__text">
							<?php echo $rlgh_data['phone']; ?>
						</p>
					</a>
					<a href="mailto:<?php echo $rlgh_data['email']; ?>" class="link footer__link footer__contact">
						<i class="icon realgh-mail"></i>
						<p class="text footer__text">
							<?php echo $rlgh_data['email']; ?>
						</p>
					</a>
				</address>
			</div>

			<div class="footer__column">
				<h6 class="subtitle footer__title c-white">
					Follow us
				</h6>
				<div class="social m-b-30">
					<?php for ($i = 0; $i < count($rlgh_data['social_icon']); $i++): ?>
						<a href="<?php echo $rlgh_data['social_link'][$i]; ?>" class="link socila__link c-white">
							<i class="icon realgh-<?php echo $rlgh_data['social_icon'][$i]; ?>"></i>
						</a>
					<?php endfor; ?>
				</div>
				<p class="text fz-14 c-white m-b-15">
					<?php echo $rlgh_data['footnote']; ?>
				</p>
				<p class="text fz-14 c-white">
					<?php echo $rlgh_data['copyright']; ?>
				</p>
			</div>
		</div>
	</div>
</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>