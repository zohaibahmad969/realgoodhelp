<?php
/*
* Template name: Template Creadits
*/

get_header();
?>

<main class="main js-padding">
	<section class="section-alt">
		<div class="wrapper">
			<div class="grid aside__container aside__rev-container">
				<div class="aside__main-content grid grid__column grid__column--no-stretch">
					<div class="card mobile-card--p-0">
						<div class="card__header">
							<p class="subtitle fz-22">Payment Methods</p>
						</div>
						<div class="card__content">
							<div class="d-flex method__cards">
								<!-- START CARD -->
								<input type="radio" name="payment" id="pay-1" value="card" class="check__input" checked>
								<label for="pay-1" class="label method__label method-card">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/img/payment/cards.png" alt="Payment" class="svg pay-img">
								</label>
								<!-- END CARD -->

								<!-- START CARD -->
								<input type="radio" name="payment" id="pay-2" value="paypal" class="check__input">
								<label for="pay-2" class="label method__label method-card">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/img/payment/paypal.png" alt="Payment" class="svg pay-img">
								</label>
								<!-- END CARD -->

								<!-- START CARD -->
								<input type="radio" name="payment" id="pay-3" value="payoneer" class="check__input">
								<label for="pay-3" class="label method__label method-card">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/img/payment/payoneer.png" alt="Payment" class="svg pay-img">
								</label>
								<!-- END CARD -->
							</div>
							<p class="text fz-16 fw-600">
								Select a convenient payment system from the list and click “Pay". Then follow the instructions of the payment system.<br>
								<br>
								Card and client data are transmitted via secure communication channels. Payments are accepted through a secure secure connection using the SSL protocol.<br>
								<br>
								All payment methods are instant, funds are credited and a place on the course is booked automatically.
							</p>
						</div>
					</div>
					<div class="card card__content">
						<div class="d-flex promo__header">
							<i class="icon realgh-tag"></i>
							<p class="subtitle fz-22">Do you know the promo code?</p>
						</div>
						<div class="d-flex promo__content">
							<input type="text" name="promo" class="input input-text" placeholder="Enter the promo code">
							<button type="button" class="button yellow-button promo__button">
								<span class="button-text">Redeem</span>
							</button>
						</div>
					</div>
				</div>
				
				<div class="aside grid grid__column grid__column--no-stretch">
					<div class="card mobile-card--p-0">
						<div class="card__header">
							<p class="subtitle fz-20">How many italki Credits would you like to purchase?</p>
						</div>
						<div class="card__content badge-block">
							<input type="radio" id="amount-20" value="20" name="amount" class="check__input">
							<label for="amount-20" class="label badge border-badge pay__badge text">$20</label>

							<input type="radio" id="amount-40" value="40" name="amount" class="check__input">
							<label for="amount-40" class="label badge border-badge pay__badge text">$40</label>

							<input type="radio" id="amount-60" value="60" name="amount" class="check__input">
							<label for="amount-60" class="label badge border-badge pay__badge text">$60</label>

							<input type="radio" id="amount-80" value="80" name="amount" class="check__input">
							<label for="amount-80" class="label badge border-badge pay__badge text">$80</label>

							<input type="radio" id="amount-100" value="100" name="amount" class="check__input">
							<label for="amount-100" class="label badge border-badge pay__badge text">$100</label>

							<input type="radio" id="amount-150" value="150" name="amount" class="check__input">
							<label for="amount-150" class="label badge border-badge pay__badge text">$150</label>

							<input type="text" name="other-amount" class="input input-text badge__input pay__badge-input" placeholder="Other">
						</div>
					</div>
					<div class="card mobile-card--p-0">
						<div class="card__header">
							<p class="subtitle fz-20">My Balance</p>
						</div>
						<div class="card__content">
							<div class="pay-card__details">
								<div class="pay-card__row">
									<p class="text fw-600">Sub-total</p>
									<p class="subtitle fz-22">$40.00</p>
								</div>
								<div class="pay-card__row">
									<p class="text fw-600">Discount</p>
									<p class="subtitle fz-22">$ 0.00</p>
								</div>
								<div class="h-line pay-card__h-line"></div>
								<div class="pay-card__row">
									<p class="subtitle fz-20 fw-600">Total</p>
									<p class="subtitle fz-22">$ 48.00</p>
								</div>
							</div>
							<button class="button main-button pay-card__button">
								<span class="button-text">Pay $48 <?php echo CURRENCY; ?></span>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();