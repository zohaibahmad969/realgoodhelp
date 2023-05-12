<?php
/*
* Template name: Template Single Client
*/

$single_client_id = $_GET['client_id'];

get_header();
global $wpdb;

$current_user = wp_get_current_user();

if (isset($single_client_id) && !empty($single_client_id)) {
	$client_data = get_userdata($single_client_id);
	$table_name = $wpdb->prefix . "users_data";
	$user_additional_data = $wpdb->get_row("SELECT * FROM $table_name WHERE user_id = $single_client_id");
	$country_list = country_array();

    $age = (date('Y') - date('Y',strtotime($user_additional_data->date_of_birth)));
}
?>



<main class="main js-padding">
	<section class="section-alt">
		<div class="wrapper">
			<div class="card grid single-client__card">
				<div class="single-client__card-left">
					<!-- <img src="<?php echo get_template_directory_uri(); ?>/assets/img/clients/client-1.jpg" alt="Client" class="img img--bdrs-8 single-client__img"> -->

					<?php
							$userImg = $user_additional_data->user_profile_pic;
							if (!$userImg) {
								if (get_avatar_url($client_data->ID)) {
									$userImg = get_avatar_url($client_data->ID);
								} else {
									$userImg = get_template_directory_uri() . "/assets/img/dummy-profile-image.png";
								}
							}

							?>
							<img
								src="<?php echo $userImg; ?>"
								alt="Avatar"
								class="img single-psycho__img"
							>
					<!-- <div class="status-block online">
						<div class="status">
							<i class="icon realgh-online"></i>
							<p class="text note fz-18">Offline</p>
						</div>
						<p class="text fz-14">Visited 31 minutes ago</p>
					</div> -->
				</div>
				<div class="card__content">
					<div class="d-flex w-100p">
						<div class="info__section">
							<p class="subtitle fz-32"><?php echo $client_data->display_name; ?></p>
							<p class="text fz-16">
								<?php 
								if ($user_additional_data->date_of_birth ) {
									echo $age . ' years';
								} ?> </p>
						</div>
						<!-- <a href="/" class="link button border-button button--big single-client__button--desktop">
							<span class="button-text">Write a message</span>
						</a> -->
					</div>
					<div class="info__section">
						<p class="text note fz-18">Country of residence</p>
						<p class="text fz-20 fw-600">
							<?php
								if(isset($user_additional_data->country)){
									echo esc_attr($country_list[$user_additional_data->country]);
								}
							?>
						</p>
					</div>
					<?php if ($user_additional_data->about_myself): ?>
						<div class="info__section">
							<p class="text note fz-18">About Sarah</p>
							<p class="text fz-16"><?php echo esc_attr($user_additional_data->about_myself); ?>
							</p>
						</div>
					<?php endif; ?>
					<a href="/" class="link button border-button button--big single-client__button--mobile">
						<span class="button-text">Write a message</span>
					</a>
				</div>
			</div>
		</div>
	</section>
</main>
<?php get_footer(); ?>