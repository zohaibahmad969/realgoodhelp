<?php
/*
* Display the image on the screen with the set parameters/
*/

function realgh_print_meta_img($realgh_metaname, $realgh_img_classes, $realgh_size = 'full') {
	$img = get_post_meta( get_the_ID(), $realgh_metaname, true );
	?>
	<img
		src="<?php echo wp_get_attachment_image_url($img['id'], $realgh_size); ?>"
		alt="<?php echo get_post_meta($img['id'], '_wp_attachment_image_alt', true); ?>"
		class="<?php echo $realgh_img_classes ?>"
		loading="lazy"
	>
	<?php
}