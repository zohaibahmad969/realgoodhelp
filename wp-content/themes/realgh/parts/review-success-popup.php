<?php global $rlgh_data; ?>

<div class="popup review-suc__popup">
	<div class="popup__body review-suc__popup-body">
		<button type="button" class="button close-button close-button--ps-abs js-close-popup">
			<i class="icon realgh-close"></i>
		</button>
		<p class="title popup__title">
			<?php echo $rlgh_data['review-suc_title']; ?>
		</p>
		<p class="text fz-16">
			<?php echo nl2br($rlgh_data['review-suc_text']); ?>
		</p>
	</div>
</div>