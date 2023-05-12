<div class="popup book__popup">
	<div class="popup__body book-popup__body">
		<button class="button close-button close-button--ps-abs js-close-popup">
			<i class="icon realgh-close"></i>
		</button>
		<div class="book-popup__top">
			<p class="title popup__title">Thank you for booking appointment on our sevice! </p>
			<p class="text fz-18">Please fill oup the form below and receive an e-mail with a link for payment and consultation</p>
		</div>
		<div class="h-line book-popup__h-line"></div>
		<form action="/" class="book-popup__form">
			<input type="hidden" name="id" class="input">
			<div class="form__top">
				<div class="form__row">
					<div class="form__cell req-field">
						<input type="text" name="name" class="input input-text" placeholder="Name*">
					</div>
					<div class="form__cell">
						<input type="text" name="last_name" class="input input-text" placeholder="Last name">
					</div>
				</div>
				<div class="form__row">
					<div class="form__cell req-field">
						<input type="email" name="email" class="input input-text" placeholder="Email Address*">
					</div>
					<div class="form__cell req-field">
						<select name="tymezone" class="input input-text">
							<option value selected disabled>Timezone</option>
							<option value="-12">UTC−12:00</option>
							<option value="-11">UTC−11:00</option>
							<option value="-10">UTC−10:00</option>
							<option value="-9.5">UTC−09:30</option>
							<option value="-9">UTC−09:00</option>
							<option value="-8">UTC−08:00</option>
							<option value="-7">UTC−07:00</option>
							<option value="-6">UTC−06:00</option>
							<option value="-5">UTC−05:00</option>
							<option value="-4">UTC−04:00</option>
							<option value="-3.5">UTC−03:30</option>
							<option value="-3">UTC−03:00</option>
							<option value="-2">UTC−02:00</option>
							<option value="-1">UTC−01:00</option>
							<option value="0">UTC±00:00</option>
							<option value="1">UTC+01:00</option>
							<option value="2">UTC+02:00</option>
							<option value="3">UTC+03:00</option>
							<option value="3.5">UTC+03:30</option>
							<option value="4">UTC+04:00</option>
							<option value="4.5">UTC+04:30</option>
							<option value="5">UTC+05:00</option>
							<option value="5.5">UTC+05:30</option>
							<option value="6">UTC+06:00</option>
							<option value="6.5">UTC+06:30</option>
							<option value="7">UTC+07:00</option>
							<option value="8">UTC+08:00</option>
							<option value="9">UTC+09:00</option>
							<option value="9.5">UTC+09:30</option>
							<option value="10">UTC+10:00</option>
							<option value="10.5">UTC+10:30</option>
							<option value="11">UTC+11:00</option>
							<option value="12">UTC+12:00</option>
							<option value="13">UTC+13:00</option>
							<option value="14">UTC+14:00</option>
						</select>
					</div>
				</div>
				<div class="form__cell req-field">
					<label for="desc" class="label text fz-18 req-label">Please write down the dates and times at which it would be convenient for you to have the session</label>
					<textarea name="desc" id="desc" class="input input-text textarea"></textarea>
				</div>
			</div>
			<div class="form__cell req-field">
				<p class="subtitle req-label">Prefered room</p>
				<div class="book-popup__radio-group">
					<input type="radio" id="zoom" value="zoom" name="method" class="check__input">
					<label for="zoom" class="label check__label radio__label text fz-18">Zoom</label>
					<input type="radio" id="google" value="google" name="method" class="check__input">
					<label for="google" class="label check__label radio__label text fz-18">Google Meet</label>
				</div>
			</div>
			<div class="book-popup__bot">
				<button class="button main-button book-popup__button">
					<span class="button-text">Submit</span>
				</button>
			</div>
		</form>
	</div>
</div>