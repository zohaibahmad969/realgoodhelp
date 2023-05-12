<?php global $rlgh_data; ?>

<div class="popup review__popup">
	<div class="popup__body review-popup__body">
		<button type="button" class="button close-button close-button--ps-abs js-close-popup">
			<i class="icon realgh-close"></i>
		</button>
		<form class="form">
			<input type="hidden" name="client_id" value="<?php echo $args['client_id']; ?>">
			<input type="hidden" name="therapist_id" value="">
			<div class="card__text-block">
				<p class="title popup__title">
					<?php echo $rlgh_data['review_title']; ?>
				</p>
				<p class="text">
					<?php echo nl2br($rlgh_data['review_text']); ?>
				</p>
			</div>
			<?php for ($i = 0; $i < count($rlgh_data['review_field_text']); $i++): ?>
				<div class="form__cell req-field">
					<p class="text fz-16 fw-600">
						<?php echo $rlgh_data['review_field_text'][$i]; ?>
					</p>
					<input type="hidden" class="input" name="<?php echo $rlgh_data['review_field_slug'][$i]; ?>_score">
					<div class="rating__container">
						<div class="rating">
							<?php for ($j = 1; $j <= 5; $j++): ?>
								<svg
									data-num="<?php echo $j; ?>"
									viewBox="0 0 24 24"
									fill="none"
									class="svg rating__star js-rating-star"
								>
									<path d="M9.5398 8.9143L12.1179 2.71484L14.7226 8.9143L21.4938 9.56783L16.8601 14.1136L17.9265 20.424L12.1179 17.1249L6.32236 20.4071L7.36618 14.1136L2.75781 9.56783L9.5398 8.9143Z" stroke-width="1.5" stroke-linejoin="round"/>
								</svg>
							<?php endfor; ?>
						</div>
						<div class="rating rating__score">
							<?php for ($j = 1; $j <= 5; $j++): ?>
								<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/star--fill.svg" alt="Rating" class="svg rating__star">
							<?php endfor; ?>
						</div>
					</div>
				</div>
			<?php endfor; ?>
			<textarea name="review_text" class="input input-text textarea textarea--length" maxlength="300" placeholder="<?php echo $rlgh_data['review_textarea']; ?>"></textarea>

			<input type="checkbox" id="review_сoncord" value="true" name="review_сoncord" class="check__input" checked>
			<label for="review_сoncord" class="label check__label checkbox__label text form__text">
				<?php echo $rlgh_data['review_check']; ?>
			</label>

			<button class="button main-button">
				<span class="button-text">
					<?php echo $rlgh_data['review_button']; ?>
				</span>
			</button>
		</form>
	</div>
</div>