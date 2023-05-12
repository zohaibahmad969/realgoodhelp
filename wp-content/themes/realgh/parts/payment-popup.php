<?php global $rlgh_data; ?>

<div class="popup payment__popup">
	<div class="popup__body popup__body--bg payment-popup__body payment-popup__body--bg">
		<div class="popup__container">
			<button class="button close-button close-button--ps-abs js-close-popup">
				<i class="icon realgh-close"></i>
			</button>
			<div class="popup__content">
				<form method="POST" id="zaPaymentForm">
					<h2 class="sc-content-main-title title col-black m-b-15 text-center js-payment-page-text">
						This is default payment page text.
					</h2>
					<input type="hidden" name="payment_details_text" class="input  js-payment-details-text" value="This is default payment page text">
					<input type="hidden" name="price" class="input  js-payment-page-amount" value="0">
					<button class="button main-button pay-card__button" id="za-payment-button" style="margin: auto;">
						<span class="button-text">Pay <span id="btnLblPrice">0.00</span> USD</span>
					</button>
				</form>
				<!-- <iframe class="js-paymentScreenForUserToPay" width="100%" height="400px"></iframe> -->
			</div>
		</div>

	</div>

</div>