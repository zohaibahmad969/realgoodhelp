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

  /* 
	* Homepage
  */
  
  // Main Screen----------------------------------------------------------
  $cfg_mainscreen = array(
	 'id'              => 'realgh_mainscreen',          // meta box id, unique per meta box
	 'title'           => esc_html__('Main Screen content', 'realgh'),   // meta box title
	 'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	 'page_name'       => 'template-homepage-selfhelp-v2.php',  // if single = true. Name of page for which to output metaboxes
	 'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	 'priority'        => 'high',            // order of meta box: high (default), low; optional
	 'fields'          => array(),            // list of meta fields (can be added by field arrays)
	 'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	 'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  $mainscreen =  new AT_Meta_Box($cfg_mainscreen);
  
  // Main Heading Text field
  $mainscreen->addText(
	 $prefix.'mainheading', array( 'name' => esc_html__('Main Heading', 'realgh') )
  );

  // Sub Heading Text field
  $mainscreen->addText(
	$prefix.'subheading', array( 'name' => esc_html__('Sub Heading', 'realgh') )
 	);

	//Image field
	$mainscreen->addImage(
		$prefix.'main_top_image', array('name' => esc_html__('Load the background image of the mainscreen', 'realgh'))
	 );

  //Finish Meta Box Declaration 
  $mainscreen->Finish();


}