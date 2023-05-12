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
  // MainScreen----------------------------------------------------------
  $cfg_mainscreen = array(
	 'id'              => 'realgh_mainscreen',          // meta box id, unique per meta box
	 'title'           => esc_html__('Mainscreen content', 'realgh'),   // meta box title
	 'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	 'page_name'       => 'template-homepage-wellbeing-new.php',  // if single = true. Name of page for which to output metaboxes
	 'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	 'priority'        => 'high',            // order of meta box: high (default), low; optional
	 'fields'          => array(),            // list of meta fields (can be added by field arrays)
	 'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	 'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
	* Initiate your meta box
  */
  $mainscreen =  new AT_Meta_Box($cfg_mainscreen);
  
  /*
	* Add fields to your meta box
  */
  //Text field
  $mainscreen->addText(
	 $prefix.'main_title', array( 'name' => esc_html__('Title', 'realgh') )
  );
  //Textarea field
  $mainscreen->addTextarea(
	 $prefix.'main_text', array( 'name' => esc_html__('Text', 'realgh') )
  );
  //Page field
  $mainscreen->addPosts(
    $prefix.'main_link_value',
    array('post_type' => 'page'),
    array(
      'name' => esc_html__('Link value', 'realgh'),
      'desc' => esc_html__('The page to which the mainscreen link leads', 'realgh'),
      'group' => 'start'
    )
  );
  //Text field
  $mainscreen->addText(
  	$prefix.'main_link_text',
  	array(
  		'name' => esc_html__('Link text', 'realgh'),
  		'group' => 'end')
  );
  //Image field
  $mainscreen->addImage(
	 $prefix.'main_top_image', array('name' => esc_html__('Load the image of the mainscreen', 'realgh'))
  );

  /*
	* Don't Forget to Close up the meta box Declaration 
  */
  //Finish Meta Box Declaration 
  $mainscreen->Finish();



  // Feature----------------------------------------------------------
  $cfg_feature = array(
	 'id'              => 'realgh_feature',          // meta box id, unique per meta box
	 'title'           => esc_html__('Feature content', 'realgh'),   // meta box title
	 'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	 'page_name'       => 'template-homepage-wellbeing-new.php',  // if single = true. Name of page for which to output metaboxes
	 'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	 'priority'        => 'high',            // order of meta box: high (default), low; optional
	 'fields'          => array(),            // list of meta fields (can be added by field arrays)
	 'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	 'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  $feature =  new AT_Meta_Box($cfg_feature);
  
  //Text field
  $feature->addText(
	 $prefix.'feature_title', array( 'name' => esc_html__('Title', 'realgh') )
  );
  //Text field
  $feature->addImage(
	 $prefix.'feature_card-1_img',
	 array(
	 	'name' => esc_html__('Card image', 'realgh'),
	 	'group' => 'start'
	 )
  );
  //Text field
  $feature->addText(
	 $prefix.'feature_card-1_title', array( 'name' => esc_html__('Card title', 'realgh') )
  );
  //Textarea field
  $feature->addTextarea(
  	$prefix.'feature_card-1_text',
  	array(
  		'name' => esc_html__('Card text', 'realgh'),
  		'group' => 'end'
  	)
  );
  //Text field
  $feature->addImage(
	 $prefix.'feature_card-2_img',
	 array(
	 	'name' => esc_html__('Card image', 'realgh'),
	 	'group' => 'start'
	 )
  );
  //Text field
  $feature->addText(
	 $prefix.'feature_card-2_title', array( 'name' => esc_html__('Card title', 'realgh') )
  );
  //Textarea field
  $feature->addTextarea(
  	$prefix.'feature_card-2_text',
  	array(
  		'name' => esc_html__('Card text', 'realgh'),
  		'group' => 'end'
  	)
  );
  //Text field
  $feature->addImage(
	 $prefix.'feature_card-3_img',
	 array(
	 	'name' => esc_html__('Card image', 'realgh'),
	 	'group' => 'start'
	 )
  );
  //Text field
  $feature->addText(
	 $prefix.'feature_card-3_title', array( 'name' => esc_html__('Card title', 'realgh') )
  );
  //Textarea field
  $feature->addTextarea(
  	$prefix.'feature_card-3_text',
  	array(
  		'name' => esc_html__('Card text', 'realgh'),
  		'group' => 'end'
  	)
  );
    //Text field
	$feature->addImage(
		$prefix.'feature_card-4_img',
		array(
			'name' => esc_html__('Card image', 'realgh'),
			'group' => 'start'
		)
	 );
	 //Text field
	 $feature->addText(
		$prefix.'feature_card-4_title', array( 'name' => esc_html__('Card title', 'realgh') )
	 );
	 //Textarea field
	 $feature->addTextarea(
		 $prefix.'feature_card-4_text',
		 array(
			 'name' => esc_html__('Card text', 'realgh'),
			 'group' => 'end'
		 )
	 );

  //Finish Meta Box Declaration 
  $feature->Finish();



  // benefits----------------------------------------------------------
  $cfg_benefits = array(
	 'id'              => 'realgh_benefits',          // meta box id, unique per meta box
	 'title'           => esc_html__('Benefits content', 'realgh'),   // meta box title
	 'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	 'page_name'       => 'template-homepage-wellbeing-new.php',  // if single = true. Name of page for which to output metaboxes
	 'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	 'priority'        => 'high',            // order of meta box: high (default), low; optional
	 'fields'          => array(),            // list of meta fields (can be added by field arrays)
	 'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	 'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  $benefits =  new AT_Meta_Box($cfg_benefits);
  
  //Text field
  $benefits->addText(
	 $prefix.'benefits_title', array( 'name' => esc_html__('Title', 'realgh') )
  );
  //Image field
  $benefits->addImage(
	 $prefix.'benefits_top_image-1', array('name' => esc_html__('Load the image of the top benefits section', 'realgh'))
  );
  //Image field
  $benefits->addImage(
	 $prefix.'benefits_mid_image-2', array('name' => esc_html__('Load the image of the middle benefits section', 'realgh'))
  );
  //Image field
  $benefits->addImage(
	 $prefix.'benefits_bot_image-3', array('name' => esc_html__('Load the image of the bottom benefits section', 'realgh'))
  );
  //Text field
  $benefits->addText(
	 $prefix.'benefits_item-1_title',
	 array(
	 	'name' => esc_html__('List item title', 'realgh'),
	 	'group' => 'start'
	 )
  );
  //Textarea field
  $benefits->addTextarea(
  	$prefix.'benefits_item-1_text',
  	array(
  		'name' => esc_html__('List item text', 'realgh'),
  		'group' => 'end'
  	)
  );
  //Text field
  $benefits->addText(
	 $prefix.'benefits_item-2_title',
	 array(
	 	'name' => esc_html__('List item title', 'realgh'),
	 	'group' => 'start'
	 )
  );
  //Textarea field
  $benefits->addTextarea(
  	$prefix.'benefits_item-2_text',
  	array(
  		'name' => esc_html__('List item text', 'realgh'),
  		'group' => 'end'
  	)
  );
  //Text field
  $benefits->addText(
	 $prefix.'benefits_item-3_title',
	 array(
	 	'name' => esc_html__('List item title', 'realgh'),
	 	'group' => 'start'
	 )
  );
  //Textarea field
  $benefits->addTextarea(
  	$prefix.'benefits_item-3_text',
  	array(
  		'name' => esc_html__('List item text', 'realgh'),
  		'group' => 'end'
  	)
  );
    //Text field
	$benefits->addText(
		$prefix.'benefits_item-4_title',
		array(
			'name' => esc_html__('List item title', 'realgh'),
			'group' => 'start'
		)
	 );
	 //Textarea field
	 $benefits->addTextarea(
		 $prefix.'benefits_item-4_text',
		 array(
			 'name' => esc_html__('List item text', 'realgh'),
			 'group' => 'end'
		 )
	 );
	   //Text field
	   $benefits->addText(
		$prefix.'benefits_item-5_title',
		array(
			'name' => esc_html__('List item title', 'realgh'),
			'group' => 'start'
		)
	 );
	 //Textarea field
	 $benefits->addTextarea(
		 $prefix.'benefits_item-5_text',
		 array(
			 'name' => esc_html__('List item text', 'realgh'),
			 'group' => 'end'
		 )
	 );
	   //Text field
	   $benefits->addText(
		$prefix.'benefits_item-6_title',
		array(
			'name' => esc_html__('List item title', 'realgh'),
			'group' => 'start'
		)
	 );
	 //Textarea field
	 $benefits->addTextarea(
		 $prefix.'benefits_item-6_text',
		 array(
			 'name' => esc_html__('List item text', 'realgh'),
			 'group' => 'end'
		 )
	 );
	   //Text field
	   $benefits->addText(
		$prefix.'benefits_item-7_title',
		array(
			'name' => esc_html__('List item title', 'realgh'),
			'group' => 'start'
		)
	 );
	 //Textarea field
	 $benefits->addTextarea(
		 $prefix.'benefits_item-7_text',
		 array(
			 'name' => esc_html__('List item text', 'realgh'),
			 'group' => 'end'
		 )
	 );
  //Page field
  $benefits->addPosts(
    $prefix.'benefits_link_value-1',
    array('post_type' => 'page'),
    array(
      'name' => esc_html__('Link value', 'realgh'),
      'desc' => esc_html__('The page to which the benefits top section link leads', 'realgh'),
      'group' => 'start'
    )
  );
  //Text field
  $benefits->addText(
  	$prefix.'benefits_link_text-1',
  	array(
  		'name' => esc_html__('Link text', 'realgh'),
  		'group' => 'end')
  );
    //Page field
	$benefits->addPosts(
		$prefix.'benefits_link_value-2',
		array('post_type' => 'page'),
		array(
		  'name' => esc_html__('Link value', 'realgh'),
		  'desc' => esc_html__('The page to which the benefits middle section link leads', 'realgh'),
		  'group' => 'start'
		)
	  );
	  //Text field
	  $benefits->addText(
		  $prefix.'benefits_link_text-2',
		  array(
			  'name' => esc_html__('Link text', 'realgh'),
			  'group' => 'end')
	  );
	    //Page field
  $benefits->addPosts(
    $prefix.'benefits_link_value-3',
    array('post_type' => 'page'),
    array(
      'name' => esc_html__('Link value', 'realgh'),
      'desc' => esc_html__('The page to which the benefits bottom section link leads', 'realgh'),
      'group' => 'start'
    )
  );
  //Text field
  $benefits->addText(
  	$prefix.'benefits_link_text-3',
  	array(
  		'name' => esc_html__('Link text', 'realgh'),
  		'group' => 'end')
  );

  //Finish Meta Box Declaration 
  $benefits->Finish();



  // Join----------------------------------------------------------
  $cfg_guided = array(
	 'id'              => 'realgh_join',          // meta box id, unique per meta box
	 'title'           => esc_html__('Guided content', 'realgh'),   // meta box title
	 'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	 'page_name'       => 'template-homepage-wellbeing-new.php',  // if single = true. Name of page for which to output metaboxes
	 'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	 'priority'        => 'high',            // order of meta box: high (default), low; optional
	 'fields'          => array(),            // list of meta fields (can be added by field arrays)
	 'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	 'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  $guided =  new AT_Meta_Box($cfg_guided);
  
  //Image field
  $guided->addImage(
	 $prefix.'guided_image', array('name' => esc_html__('Load the background image of the guided section', 'realgh'))
  );
  //Text field
  $guided->addText(
	 $prefix.'guided_title_left-section', array( 'name' => esc_html__('Left Section Title', 'realgh') )
  );
  //Textarea field
  $guided->addTextarea(
	 $prefix.'guided_text_left-section', array( 'name' => esc_html__('Left Section Text', 'realgh') )
  );
  //Page field
  $guided->addPosts(
    $prefix.'guided_link_value',
    array('post_type' => 'page'),
    array(
      'name' => esc_html__('Link value', 'realgh'),
      'desc' => esc_html__('The page to which the guided system section link leads', 'realgh'),
      'group' => 'start'
    )
  );
  //Text field
  $guided->addText(
  	$prefix.'guided_link_text',
  	array(
  		'name' => esc_html__('Link text', 'realgh'),
  		'group' => 'end')
  );
    //Image field
	$guided->addImage(
		$prefix.'guided_image_right-section', array('name' => esc_html__('Load the icon image of the guided section', 'realgh'))
	 );
  //Text field
  $guided->addText(
	$prefix.'guided_title_right-section', array( 'name' => esc_html__('Rigth Section Title', 'realgh') )
 );
 //Textarea field
 $guided->addTextarea(
	$prefix.'guided_text_right-section', array( 'name' => esc_html__('Rigth Section Text', 'realgh') )
 );
  //Finish Meta Box Declaration 
  $guided->Finish();
}