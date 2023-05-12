<?php
/*
* Initialising metaboxes for post and pages
*/
if (is_admin()){
  /* 
	* prefix of meta keys, optional
	* use underscore (_) at the beginning to make keys hidden, for example $prefix = '_ba_';
	*  you also can make prefix empty to disable it
	* 
	*/
  $prefix = 'realgh_';
  /* 
	* configure your meta box
	*/


// Find therapist---------------------------------------------------------
	$cfg_find = array(
		'id'              => 'realgh_find',          // meta box id, unique per meta box
		'title'           => esc_html__('Find therapist page', 'realgh'),   // meta box title
		'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
		'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
		'page_name'       => 'template-psychologists-new.php',  // if single = true. Name of page for which to output metaboxes
		'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
		'priority'        => 'high',            // order of meta box: high (default), low; optional
		'fields'          => array(),            // list of meta fields (can be added by field arrays)
		'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
		'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);
 
 
 /*
   * Initiate your meta box
 */
 $find=  new AT_Meta_Box($cfg_find);
 
 /*
   * Add fields to your meta box
 */
 	// Text field
	$find->addText( $prefix.'count_label', array( 'name' => esc_html__('A signature for the number of therapists', 'realgh')) );
	// Text field
	$find->addText( $prefix.'main_title', array( 'name' => esc_html__('Main title', 'realgh')) );
	// Textarea field
	$find->addTextarea( $prefix.'main_text', array( 'name' => esc_html__('Main text', 'realgh')) );
	//Page field
  $find->addText(
    $prefix.'bot_link_value',
    array(
      'name' => esc_html__('Link value', 'realgh'),
      'desc' => esc_html__('The page to which the button link leads', 'realgh'),
      'group' => 'start'
    )
  );
  //Text field
  $find->addText(
  	$prefix.'bot_link_text',
  	array(
  		'name' => esc_html__('Link text', 'realgh'),
  		'group' => 'end')
  );

	//Finish Meta Box Declaration 
	$find->Finish();

}