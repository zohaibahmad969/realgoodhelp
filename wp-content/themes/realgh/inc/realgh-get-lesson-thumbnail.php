<?php

/*
* Returns the lesson thumbnail, if available, or the cover image of the first video lesson
*/

function realgh_get_lesson_thumbnail($id) {
	$tabs_arr = ['strategy', 'other', 'science'];
	$imgUrl;

	if (get_post_thumbnail_id($id)) {
		$imgUrl = wp_get_attachment_image_url( get_post_thumbnail_id($id), 'medium' );
	}
	else {
		foreach ($tabs_arr as $tab) {
			if ($imgUrl) continue;

			$tabs_content = get_post_meta(
				$id,
				'wellbeing_re_' . $tab . '_list',
				true
			);

   		if (!$tabs_content) continue;

   		foreach ($tabs_content as $content) {
   			if ($imgUrl) continue;

   			$imgUrl = apply_filters(
               'youtube_thumbnail',
               $content['wellbeing_exercise_youtube_link']
            );
   		}
		}
	}

	return $imgUrl;
}