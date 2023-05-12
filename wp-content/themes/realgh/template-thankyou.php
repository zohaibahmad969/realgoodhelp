<?php
/*
* Template name: Template Thank You
*/

use function GuzzleHttp\json_encode;

get_header();

if ($_GET['payment_key']) {

	global $wpdb;

	$user   = wp_get_current_user();
	$client_id = $user->ID;
	
	$stripe_api_secret = get_option('stripe_api_secret');
	$therapist_ID = $_SESSION['order']['therapist_ID'];
	$duration = $_SESSION['order']['duration'];
	$session_date = $_SESSION['order']['session_date'];
	$session_start = $_SESSION['order']['session_start'];
	$session_end = $_SESSION['order']['session_end'];
	$communication_method = $_SESSION['order']['communication_method'];
	$consultation_type = $_SESSION['order']['consultation_type'];
	$payment_method = $_SESSION['order']['payment_method'];
	$discount_price = $_SESSION['order']['discount_price'];
	$coupon_id = $_SESSION['order']['coupon_id'];
	$amount_paid = $_SESSION['order']['price'];
	
	$_SESSION['client_id'] = $client_id;
	$_SESSION['client_Name'] = $user->first_name . ' ' . $user->last_name;
	$_SESSION['client_email'] = $user->user_email;

	$therapist_data  = get_user_by( 'id', $therapist_ID);
	$_SESSION['therapist_email'] = $therapist_data->user_email;

	if(isset($_GET['rand']) &&  $_GET['rand'] == $_GET['payment_key']){
		$rand_sesion_id = rand();
		$rand_sesion_id = md5($rand_sesion_id);
		$response_array = array(
			"id"             =>  $_GET['payment_key'],
			"payment_status" => "paid",
			"payment_intent" => $rand_sesion_id,
			"amount_total"   => $amount_paid
		);
		$response = json_encode($response_array);
	} else{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api.stripe.com/v1/checkout/sessions/' . $_GET['payment_key'],
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/x-www-form-urlencoded',
				'Authorization: Bearer ' . $stripe_api_secret
			),
		));
		$response = curl_exec($curl);
	}

	$response = json_decode($response);
	if(isset($response->id)){
		$table_name = $wpdb->prefix . "sessions";
		$transaction_id = "'" . $response->id . "'";
		$session_data = $wpdb->get_row("SELECT * FROM $table_name WHERE payment_key = $transaction_id");

		if(empty($session_data)){

			$total_amount = $response->amount_total / 100;
			$percentage = 80;
			$therapist_balance = ($percentage / 100) * ($total_amount + $discount_price);

			$insert_data = array(
				'payment_key'             => $response->id,
				'amount_total'            => $total_amount + $discount_price,
				'therapist_balance'       => $therapist_balance,
				'payment_status'          => $response->payment_status,
				'transaction_id'          => $response->payment_intent,
				'therapist_ID'            => $therapist_ID,
				'client_id'               => $client_id,
				'session_date'            => $session_date,
				'duration'                => $duration,
				'session_start'           => $session_start,
				'session_end'             => $session_end,
				'session_status'          => 'pending',
				'communication_method'    => $communication_method,
				'consultation_type'       => $consultation_type,
				'payment_method'          => $payment_method,
				"discount_price"          => $discount_price,
				"coupon_id"               => $coupon_id,
			);

			if($discount_price > 0){
				$insert_data['total_price_discount'] = $total_amount;
			}

			$insert  = $wpdb->insert($table_name, $insert_data);
			$_SESSION['insertID'] = $wpdb->insert_id;

		?>
		<script>
			$(document).ready(function() {
				<?php
				if ($_SESSION['insertID']) { ?>
					jQuery.ajax({
						type: "post",
						dataType: "json",
						url: rlghData.ajaxurl,
						data: {
							action: "createZoomMeeting",
							data: <?php echo json_encode($_SESSION); ?>
						},
						beforeSend: function() {
							$('#loader').show();
						},
						success: function(response) {
							// if(response.success == true ){
							//   window.location.replace(response.message);
							// } else{
							//   $('#loader').hide();
							//   alert(response.message);
							// }
						},
						error: function() {
							// $('#loader').hide();
						}
					});
				<?php } ?>
			})
		</script>
		
<?php        
		} 
	}
} else {
	header("Location: " . home_url());
}
?>

<main class="main js-padding">
	<div class="wrapper wrapper--small">
		<section class="section-alt thank-you">
			<div class="thank-you__content">
				<!-- <img src="<?php echo get_template_directory_uri(); ?>/assets/img/thank-you/thank-you.svg" alt="Thank you" class="img thank-you__img"> -->
				<?php realgh_print_meta_img('realgh_thankyou_icon_image', 'img thank-you__img') ?>
				<h1 class="title"><?php echo get_post_meta(get_the_ID(), 'realgh_thankyou_main_title', true); ?></h1>
				<p class="text"><?php echo get_post_meta( get_the_ID(), 'realgh_thankyou_main_text', true ); ?></p>
				<a 
					href="<?php echo get_permalink(get_post_meta( get_the_ID(), 'realgh_thankyoucontent_link_value', true )); ?>"
					class="link button main-button button--big"
				>
					<span class="button-text">
						<?php echo get_post_meta( get_the_ID(), 'realgh_thankyoucontent_link_text', true ); ?>
					</span>
				</a>
			</div>
			<div class="thank-you__social-block">
				<p class="text"><?php echo get_post_meta( get_the_ID(), 'realgh_thankyou_social_text', true ); ?></p>
				<div class="d-flex thank-you__social">
					<?php for ($i = 0; $i < count($rlgh_data['social_icon']); $i++): ?>
						<a
							href="<?php echo $rlgh_data['social_link'][$i]; ?>"
							class="link button border-button social-button <?php echo 'c-' . $rlgh_data['social_icon'][$i]; ?>"
						>
							<i class="icon realgh-<?php echo $rlgh_data['social_icon'][$i]; ?>"></i>
							<span class="button-text">
								<?php echo $rlgh_data['social_icon'][$i]; ?>
							</span>
						</a>
					<?php endfor; ?>
				</div>
			</div>
		</section>
	</div>
</main>

<?php get_footer(); ?>