<?php
/*
 * Ajax get category meta data
 */

add_action('wp_ajax_get_category_meta_data', 'get_category_meta_data');
add_action('wp_ajax_nopriv_get_category_meta_data', 'get_category_meta_data');
function get_category_meta_data()
{
	if (isset($_POST['cat_id'])) {
		
		$response = array( 'category' => get_cat_name($_POST['cat_id']) , 'cat_meta' => get_option('category_' . $_POST['cat_id']) );
		echo json_encode($response);
	}

	if (isset($_POST['cat_slug'])) {
		
		$category = get_category_by_slug($_POST['cat_slug']);
		$response = array( 'category' => get_cat_name($category->term_id) , 'cat_meta' => get_option('category_' . $category->term_id) );
		echo json_encode($response);
	}
	die();
}