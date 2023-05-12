<div class="popup support__popup">
	<div class="popup__body support-popup__body">
		<form class="form">
			<p class="title fz-32">Submit a support request</p>
			<div class="support-popup__form-content">
				<input type="hidden" name="user_id" value="<?php echo get_current_user_id(); ?>">
				<div class="form__cell req-field">
					<input type="text" name="subject" class="input input-text" placeholder="Subject*">
				</div>
				<div class="form__cell req-field">
					<input type="email" name="email" class="input input-text" placeholder="Your email*">
				</div>
				<!-- <div class="form__cell req-field">
					<select name="topic" class="input input-text">
						<option value selected disabled>Topics*</option>
						<option value="Some">Some</option>
						<option value="Other">Other</option>
					</select>
				</div> -->
				<div class="form__cell req-field">
					<textarea name="desc" class="input input-text textarea" placeholder="Description*"></textarea>
					<p class="text fz-14">Please give us as much detail about your inquiry as possible. The more information we have at the time of ticket submission, the quicker we can get an accurate response to you.</p>
				</div>
				<!-- <div class="form__select-file">
					<template class="temp__file-card">
						<div class="file__card file-card__media-block">
							<div class="file-card__content">
								<p class="text c-dark file-card__name"></p>
								<p class="text c-grey file-card__size"></p>
							</div>
							<button type="button" class="button transp-button file-card__button">
								<i class="icon realgh-close"></i>
							</button>
						</div>
					</template>
					<input type="file" id="annex" name="annex" class="input-file" accept="image/png, image/jpeg, image/bmp" multiple>
					<input
						type="hidden"
						class="input input-file--path"
						name="annex_path"
					>
					<label for="annex" class="label button yellow-button form__file-button cus-profile-upload-label cus-file-upload">
						<span class="button-text">Select Files</span>
					</label>
					<p class="text fz-14">Please upload any screenshots, related files, or error messages that will help us better understand your issue</p>
					<div class="form__file-content"></div>
				</div> -->
				<p class="subtitle fz-12 fw-500">After you submit a ticket, you will receive a confirmation email letting you know the ticket was successfully put in a Support pipeline.</p>
			</div>
			<button class="button main-button button--big">
				<span class="button-text">submit</span>
			</button>
		</form>
	</div>
</div>