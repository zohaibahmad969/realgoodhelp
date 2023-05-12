<?php 
/*
* Template name: Template Invite
*/

get_header();
?>

<main class="main js-padding">
	<section class="section">
		<div class="wrapper">
			<div class="invite__body">
				<div class="invite__content">
					<h1 class="title invite__title">Invite friends and get paid!</h1>
					<p class="text fz-22 invite__text">Get <span class="fw-700">$10</span> for each friend who who will register using your referral link. Plus, they’ll get $10 too!</p>
					<form class="d-flex invite__send-block">
						<input type="text" class="input input-text invite__input" placeholder="Enter email...">
						<button class="button main-button">
							<span class="button-text">Send invitation</span>
						</button>
					</form>
					<div class="invite__link-block">
						<button class="link button border-button invite__button">
							<i class="icon realgh-link"></i>
							<span class="button-text">Copy link</span>
						</button>
						<div class="social invite__social">
							<?php for ($i = 0; $i < count($rlgh_data['social_icon']); $i++): ?>
								<a href="<?php echo $rlgh_data['social_link'][$i]; ?>" class="link socila__link invite__social-link c-white">
									<i class="icon realgh-<?php echo $rlgh_data['social_icon'][$i]; ?>"></i>
								</a>
							<?php endfor; ?>
						</div>
					</div>
				</div>
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/invite/invite.jpg" alt="Invite" class="img img--bdrs-20">
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>