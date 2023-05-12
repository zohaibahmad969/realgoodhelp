<?php
/*
 * Ajax get saved lessons
 */

add_action('wp_ajax_saved', 'wellbeing_saved_lessons');
add_action('wp_ajax_nopriv_saved', 'wellbeing_saved_lessons');
function wellbeing_saved_lessons()
{
	if (isset($_POST['lessons'])) {
		if (count($_POST['lessons'])) {
			$lessons = array();
			foreach ($_POST['lessons'] as $lesson) {
				array_push($lessons, $lesson);
			}
			$posts = get_posts(
				array(
					'post__in' => $lessons,
					'posts_per_page' => -1
				)
			);
			// Group the posts by category:
			$posts_by_category = array();
			foreach ($posts as $post) {
				$categories = wp_get_post_categories($post->ID);
				foreach ($categories as $category_id) {
					$category = get_category($category_id);
					if ($category->parent != 0) {
						continue; // skip subcategories
					}
					$category_name = get_cat_name($category_id);
					$cat_meta = get_option('category_' . $category_id);
					if (!isset($posts_by_category[$category_name])) {
						$posts_by_category[$category_name] = array(
							'cat_meta' => $cat_meta,
							// add the 'img' metadata to the category array
							'posts' => array() // create an array to store the posts in this category
						);
					}
					$posts_by_category[$category_name]['posts'][] = $post; // add the post to the 'posts' array in the category
				}
			}

			?>
			<div class="theme__cards">
				<?php
				// Output the results:
				foreach ($posts_by_category as $category_name => $category_data) {
					?>
					<div class="readmore theme__readmore">
						<div class="card theme__cover">
							<img src="<?php echo $category_data['cat_meta']['img'] ?>" alt="theme" class="img bg-block">
							<div class="tint bg-block show-readmore-content"></div>
							<h5 class="subtitle text--c-light theme__name show-readmore-content">
								<?php echo $category_name; ?>
							</h5>
							<div class="theme-action-btns">
								<button class="button transp-button readmore__button show-readmore-content">
									<i class="icon realgh-chevron-down"></i>
								</button>
							</div>
						</div>
						<div class="card theme__more">
							<div class="za-theme-more-inner">
								<?php
								foreach ($category_data['posts'] as $post) {
									$imgUrl = realgh_get_lesson_thumbnail($post->ID);
									?>
									<a href="<?php echo get_permalink($post->ID); ?>" class="link card theme__card">
										<img src="<?php echo $imgUrl; ?>" alt="<?php echo $post->post_name; ?>" class="img bg-block">
										<div class="tint theme__tint bg-block"></div>
										<p class="text theme__text">
											<?php echo $post->post_title; ?>
										</p>
									</a>
									<?php
								}
								?>
							</div>
						</div>
					</div>
					<?php
				}
				?>

			</div>
		<?php }
	} else {
		?>
		<h2 class="title">
			<?php echo get_post_meta($_POST['page'], 'wellbeing_empty_title', true); ?>
		</h2>
		<p class="text">
			<?php echo get_post_meta($_POST['page'], 'wellbeing_empty_text', true); ?>
		</p>
		<a href="<?php echo home_url(); ?>" class="link button" style="display: none;">
			<span class="button-text button-text--lighter">
				<?php echo get_post_meta($_POST['page'], 'wellbeing_empty_btn', true); ?>
			</span>
		</a>
		<?php
	}
	die();
}