<div class="popup popup--side filter__popup">
	<form class="popup__body popup__body--side filter-popup__body">
		<div class="popup__header d-flex">
			<p class="title popup__title">Filters</p>
			<button type="button" class="button close-button js-close-popup">
				<i class="icon realgh-close"></i>
			</button>
		</div>
		<div class="popup__content filter-popup__content">
			<!-- START READ MORE -->
			<div class="readmore__container">
				<div class="readmore">
					<div class="readmore__cover popup__filter-item d-flex">
						<p class="text">Price</p>
						<button type="button" class="button readmore__button">
							<i class="icon realgh-chevron-right"></i>
						</button>
					</div>
					<div class="readmore__more">
						<div class="popup-filter__readmore-content">
							<ul class="filter__list">
								<li class="filter__list-item">
									<input type="checkbox" id="pop-price-1" value="< 10" name="pop-price[]" class="input check__input">
									<label for="pop-price-1" class="label check__label checkbox__label text form__text filter__label">&lt; $10</label>
								</li>
								<li class="filter__list-item">
									<input type="checkbox" id="pop-price-2" value="10-29" name="pop-price[]" class="input check__input">
									<label for="pop-price-2" class="label check__label checkbox__label text form__text filter__label">$10 - $29</label>
								</li>
								<li class="filter__list-item">
									<input type="checkbox" id="pop-price-3" value="30-49" name="pop-price[]" class="input check__input">
									<label for="pop-price-3" class="label check__label checkbox__label text form__text filter__label">$30 - $49</label>
								</li>
								<li class="filter__list-item">
									<input type="checkbox" id="pop-price-4" value="50-99" name="pop-price[]" class="input check__input">
									<label for="pop-price-4" class="label check__label checkbox__label text form__text filter__label">$50 - $99</label>
								</li>
								<li class="filter__list-item">
									<input type="checkbox" id="pop-price-5" value=">= 100" name="pop-price[]" class="input check__input">
									<label for="pop-price-5" class="label check__label checkbox__label text form__text filter__label">&gt;= $100</label>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- END READ MORE -->

			<!-- START READ MORE -->
			<div class="readmore__container">
				<div class="readmore">
					<div class="readmore__cover popup__filter-item d-flex">
						<p class="text">Qualification</p>
						<button type="button" class="button readmore__button">
							<i class="icon realgh-chevron-right"></i>
						</button>
					</div>
					<div class="readmore__more">
						<div class="popup-filter__readmore-content">
							<ul class="filter__list">
								<li class="filter__list-item">
									<input type="checkbox" id="pop-qualification-1" value="Clinical Psychologist" name="pop-qualification[]" class="input check__input">
									<label for="pop-qualification-1" class="label check__label checkbox__label text form__text filter__label">Clinical Psychologist</label>
								</li>
								<li class="filter__list-item">
									<input type="checkbox" id="pop-qualification-2" value="Counselling Psychologist" name="pop-qualification[]" class="input check__input">
									<label for="pop-qualification-2" class="label check__label checkbox__label text form__text filter__label">Counselling Psychologist</label>
								</li>
								<li class="filter__list-item">
									<input type="checkbox" id="pop-qualification-3" value="Psychiatrist" name="pop-qualification[]" class="input check__input">
									<label for="pop-qualification-3" class="label check__label checkbox__label text form__text filter__label">Psychiatrist</label>
								</li>
								<li class="filter__list-item">
									<input type="checkbox" id="pop-qualification-4" value="Counsellor" name="pop-qualification[]" class="input check__input">
									<label for="pop-qualification-4" class="label check__label checkbox__label text form__text filter__label">Counsellor</label>
								</li>
								<li class="filter__list-item">
									<input type="checkbox" id="pop-qualification-5" value="Coach" name="pop-qualification[]" class="input check__input">
									<label for="pop-qualification-5" class="label check__label checkbox__label text form__text filter__label">Coach</label>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- END READ MORE -->
			
			<!-- START READ MORE -->
			<div class="readmore__container">
				<div class="readmore">
					<div class="readmore__cover popup__filter-item d-flex">
						<p class="text">Specialisation</p>
						<button type="button" class="button readmore__button">
							<i class="icon realgh-chevron-right"></i>
						</button>
					</div>
					<div class="readmore__more">
						<div class="popup-filter__readmore-content">
							<ul class="filter__list">
							<?php
							$i = 0;
							foreach ($args['specialisations'] as $single):
								?>
								<li class="filter__list-item">
									<input
										type="checkbox"
										id="pop-specialization-<?php echo $i; ?>"
										value="<?php echo $single; ?>"
										name="pop-specialization[]"
										class="input check__input"
									>
									<label
										for="pop-specialization-<?php echo $i; ?>"
										class="label check__label checkbox__label text form__text filter__label"
									>
										<?php echo $single; ?>
									</label>
								</li>
								<?php
								$i++;
							endforeach;
							?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- END READ MORE -->
			
			<!-- START READ MORE -->
			<div class="readmore__container">
				<div class="readmore">
					<div class="readmore__cover popup__filter-item d-flex">
						<p class="text">Method</p>
						<button type="button" class="button readmore__button">
							<i class="icon realgh-chevron-right"></i>
						</button>
					</div>
					<div class="readmore__more">
						<div class="popup-filter__readmore-content">
							<ul class="filter__list">
								<li class="filter__list-item">
									<input type="checkbox" id="pop-method-1" value="Psychoanalytic therapy" name="pop-main_method[]" class="input check__input">
									<label for="pop-method-1" class="label check__label checkbox__label text form__text filter__label">Psychoanalytic therapy</label>
								</li>
								<li class="filter__list-item">
									<input type="checkbox" id="pop-method-2" value="Transactional analysis" name="pop-main_method[]" class="input check__input">
									<label for="pop-method-2" class="label check__label checkbox__label text form__text filter__label">Transactional analysis</label>
								</li>
								<li class="filter__list-item">
									<input type="checkbox" id="pop-method-3" value="Gestalt therapy" name="pop-main_method[]" class="input check__input">
									<label for="pop-method-3" class="label check__label checkbox__label text form__text filter__label">Gestalt therapy</label>
								</li>
								<li class="filter__list-item">
									<input type="checkbox" id="pop-method-4" value="Existential therapy" name="pop-main_method[]" class="input check__input">
									<label for="pop-method-4" class="label check__label checkbox__label text form__text filter__label">Existential therapy</label>
								</li>
								<li class="filter__list-item">
									<input type="checkbox" id="pop-method-5" value="Systemic family approach" name="pop-main_method[]" class="input check__input">
									<label for="pop-method-5" class="label check__label checkbox__label text form__text filter__label">Systemic family approach</label>
								</li>
								<li class="filter__list-item">
									<input type="checkbox" id="pop-method-6" value="CBT" name="pop-main_method[]" class="input check__input">
									<label for="pop-method-6" class="label check__label checkbox__label text form__text filter__label">CBT</label>
								</li>
								<li class="filter__list-item">
									<input type="checkbox" id="pop-method-7" value="Psychodrama" name="pop-main_method[]" class="input check__input">
									<label for="pop-method-7" class="label check__label checkbox__label text form__text filter__label">Psychodrama</label>
								</li>
								<li class="filter__list-item">
									<input type="checkbox" id="pop-method-8" value="Integrative therapy" name="pop-main_method[]" class="input check__input">
									<label for="pop-method-8" class="label check__label checkbox__label text form__text filter__label">Integrative therapy</label>
								</li>
								<li class="filter__list-item">
									<input type="checkbox" id="pop-method-9" value="Other" name="pop-main_method[]" class="input check__input">
									<label for="pop-method-9" class="label check__label checkbox__label text form__text filter__label">Other</label>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- END READ MORE -->
			
			<!-- START READ MORE -->
			<div class="readmore__container">
				<div class="readmore">
					<div class="readmore__cover popup__filter-item d-flex">
						<p class="text">Work Experience</p>
						<button type="button" class="button readmore__button">
							<i class="icon realgh-chevron-right"></i>
						</button>
					</div>
					<div class="readmore__more">
						<div class="popup-filter__readmore-content">
							<ul class="filter__list">
								<li class="filter__list-item">
									<input type="checkbox" id="pop-experience-1" value="1-2" name="pop-experience[]" class="input check__input">
									<label for="pop-experience-1" class="label check__label checkbox__label text form__text filter__label">1 - 2 years</label>
								</li>
								<li class="filter__list-item">
									<input type="checkbox" id="pop-experience-2" value="3-4" name="pop-experience[]" class="input check__input">
									<label for="pop-experience-2" class="label check__label checkbox__label text form__text filter__label">3 - 4 years</label>
								</li>
								<li class="filter__list-item">
									<input type="checkbox" id="pop-experience-3" value="5-10" name="pop-experience[]" class="input check__input">
									<label for="pop-experience-3" class="label check__label checkbox__label text form__text filter__label">5 - 10 years</label>
								</li>
								<li class="filter__list-item">
									<input type="checkbox" id="pop-experience-4" value="> 10" name="pop-experience[]" class="input check__input">
									<label for="pop-experience-4" class="label check__label checkbox__label text form__text filter__label">&gt; 10 years</label>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- END READ MORE -->
			
			<!-- START READ MORE -->
			<div class="readmore__container">
				<div class="readmore">
					<div class="readmore__cover popup__filter-item d-flex">
						<p class="text">Language</p>
						<button type="button" class="button readmore__button">
							<i class="icon realgh-chevron-right"></i>
						</button>
					</div>
					<div class="readmore__more">
						<div class="popup-filter__readmore-content">
							<ul class="filter__list">
								<li class="filter__list-item">
									<input type="checkbox" id="pop-language-1" value="Mandarin" name="pop-languages[]" class="input check__input">
									<label for="pop-language-1" class="label check__label checkbox__label text form__text filter__label">Mandarin</label>
								</li>
								<li class="filter__list-item">
									<input type="checkbox" id="pop-language-2" value="Hindi" name="pop-languages[]" class="input check__input">
									<label for="pop-language-2" class="label check__label checkbox__label text form__text filter__label">Hindi</label>
								</li>
								<li class="filter__list-item">
									<input type="checkbox" id="pop-language-3" value="Spanish" name="pop-languages[]" class="input check__input">
									<label for="pop-language-3" class="label check__label checkbox__label text form__text filter__label">Spanish</label>
								</li>
								<li class="filter__list-item">
									<input type="checkbox" id="pop-language-4" value="Russian" name="pop-languages[]" class="input check__input">
									<label for="pop-language-4" class="label check__label checkbox__label text form__text filter__label">Russian</label>
								</li>
								<li class="filter__list-item">
									<input type="checkbox" id="pop-language-5" value="Other" name="pop-languages[]" class="input check__input">
									<label for="pop-language-5" class="label check__label checkbox__label text form__text filter__label">Other</label>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- END READ MORE -->
			
			<!-- START READ MORE -->
			<div class="readmore__container">
				<div class="readmore">
					<div class="readmore__cover popup__filter-item d-flex">
						<p class="text">Sort by</p>
						<button type="button" class="button readmore__button">
							<i class="icon realgh-chevron-right"></i>
						</button>
					</div>
					<div class="readmore__more">
						<div class="popup-filter__readmore-content">
							<ul class="filter__list">
								<li class="filter__list-item">
									<input type="radio" id="pop-sort-by-1" value="name" name="pop-sort-by" class="input check__input" checked>
									<label for="pop-sort-by-1" class="label check__label checkbox__label text form__text filter__label">Name</label>
								</li>
								<li class="filter__list-item">
									<input type="radio" id="pop-sort-by-2" value="price_asc" name="pop-sort-by" class="input check__input">
									<label for="pop-sort-by-2" class="label check__label checkbox__label text form__text filter__label">Price ascending</label>
								</li>
								<li class="filter__list-item">
									<input type="radio" id="pop-sort-by-3" value="price_desc" name="pop-sort-by" class="input check__input">
									<label for="pop-sort-by-3" class="label check__label checkbox__label text form__text filter__label">Price descending</label>
								</li>
								<li class="filter__list-item">
									<input type="radio" id="pop-sort-by-4" value="exp_asc" name="pop-sort-by" class="input check__input">
									<label for="pop-sort-by-4" class="label check__label checkbox__label text form__text filter__label">Experience ascending</label>
								</li>
								<li class="filter__list-item">
									<input type="radio" id="pop-sort-by-5" value="exp_desc" name="pop-sort-by" class="input check__input">
									<label for="pop-sort-by-5" class="label check__label checkbox__label text form__text filter__label">Experience descending</label>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- END READ MORE -->
		</div>
		<div class="filter-popup__button-block">
			<button type="button" class="button border-button filter-popup__button filter-popup__clear-button">
				<span class="button-text">Clear</span>
			</button>
			<button type="button" class="button main-button filter-popup__button filter-popup__send-button">
				<span class="button-text">Apply</span>
			</button>
		</div>
	</form>
</div>