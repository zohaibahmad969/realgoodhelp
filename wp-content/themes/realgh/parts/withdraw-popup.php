<div class="popup withdraw__popup">
	<div class="popup__body withdraw-popup__body">
		<button type="button" class="button close-button close-button--ps-abs js-close-popup">
			<i class="icon realgh-close"></i>
		</button>
		<form class="form">
			<input
				type="hidden"
				name="id"
				value="<?php echo $args['id']; ?>"
			>
			<input
				type="hidden"
				name="email"
				value="<?php echo $args['email']; ?>"
			>
			<p class="title popup__title">Withdraw</p>
			<!-- <div class="form__cell req-field">
				<label for="withdraw_amount" class="label text fz-16">Enter the amount of money you would like to bring in:</label>
				<input type="number" id="withdraw_amount" class="input input-text" name="amount" placeholder="Enter the amount">
				<p class="text note">The amount in your account: <span data-amount="345.34" class="withdraw__max-amount">345.34USD</span></p>
			</div> -->
			<div class="form__cell req-field">
				<label for="withdraw_currency" class="label text fz-16">Please enter the currency you would like to receive your funds in:</label>
				<input type="text" id="withdraw_currency" class="input input-text tt-upp" name="currency" placeholder="Currency (USD, AUD, etc.)" maxlength="3">
			</div>
			<p class="text fz-16">When you submit this request, you will in the next 24 hours receive an email from www.wise.com requesting your bank details. Please complete this form and your funds will be deposited in your account soon after.</p>
			<button class="button main-button">
				<span class="button-text">Submit</span>
			</button>
		</form>
	</div>
</div>