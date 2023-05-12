<?php
/*
* Template name: Template Withdraw Money
*/

get_header();
$is_empty = false;
?>

<main class="main js-padding">
	<div class="wrapper">
		<section class="section-alt aside__container grid">
			<div class="aside grid__column grid">
				<div class="card">
					<div class="card__header">
						<p class="subtitle fz-22">My Balance</p>
					</div>
					<div class="card__content">
						<div class="card__text-block withdraw__text-block">
							<p class="text note fz-20">Available Balance</p>
							<p class="subtitle">$ 0.00</p>
						</div>
						<button class="button border-button card__button">
							<span class="button-text">Withdraw money</span>
						</button>
					</div>
				</div>
			</div>
			<div class="card withdraw__card mobile-card--p-0">
				<div class="card__header">
					<p class="subtitle fz-22">Transaction Detail</p>
				</div>
				<div class="card__header withdraw__grid">
					<p class="text withdraw__table-title">Time</p>
					<p class="text withdraw__table-title">Description</p>
					<p class="text withdraw__table-title">Description</p>
					<p class="text withdraw__table-title ta-c">Status</p>
				</div>
				<?php if ($is_empty) : ?>
					<div class="card__content flex--ai-c">
						<p class="text fz-22">No transaction</p>
					</div>
				<?php else : ?>
					<div class="withdraw__rows">
						<div class="withdraw__grid">
							<div class="withdraw__date">
								<p class="text withdraw-date__day">16</p>
								<p class="text fz-14 withdraw-date__month">APR</p>
							</div>
							<div class="withdraw__desc">
								<p class="text fz-16 fw-600">HDFC Bank</p>
								<p class="text note">Withdraw to Bank account</p>
							</div>
							<p class="subtitle fz-20 fw-600">+ $50</p>
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/minus.svg" alt="Status" class="svg withdraw__status">
						</div>
						<div class="withdraw__grid">
							<div class="withdraw__date">
								<p class="text withdraw-date__day">17</p>
								<p class="text fz-14 withdraw-date__month">APR</p>
							</div>
							<div class="withdraw__desc">
								<p class="text fz-16 fw-600">HDFC Bank</p>
								<p class="text note">Withdraw to Bank account</p>
							</div>
							<p class="subtitle fz-20 fw-600">+ $50</p>
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/check--fill.svg" alt="Status" class="svg withdraw__status">
						</div>
					</div>
				<?php endif; ?>
			</div>
		</section>
	</div>
</main>

<?php
get_footer();