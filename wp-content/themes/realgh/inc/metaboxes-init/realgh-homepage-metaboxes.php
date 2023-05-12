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
	 'page_name'       => 'template-homepage.php',  // if single = true. Name of page for which to output metaboxes
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
	 $prefix.'main_top_image', array('name' => esc_html__('Load the top image of the mainscreen', 'realgh'))
  );
  //Image field
  $mainscreen->addImage(
	 $prefix.'main_bot_image', array('name' => esc_html__('Load the bottom image of the mainscreen', 'realgh'))
  );

  /*
	* Don't Forget to Close up the meta box Declaration 
  */
  //Finish Meta Box Declaration 
  $mainscreen->Finish();



  // Improve----------------------------------------------------------
  $cfg_improve = array(
	 'id'              => 'realgh_improve',          // meta box id, unique per meta box
	 'title'           => esc_html__('Improve content', 'realgh'),   // meta box title
	 'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	 'page_name'       => 'template-homepage.php',  // if single = true. Name of page for which to output metaboxes
	 'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	 'priority'        => 'high',            // order of meta box: high (default), low; optional
	 'fields'          => array(),            // list of meta fields (can be added by field arrays)
	 'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	 'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  $improve =  new AT_Meta_Box($cfg_improve);
  
  //Text field
  $improve->addText(
	 $prefix.'improve_title', array( 'name' => esc_html__('Title', 'realgh') )
  );
  //Text field
  $improve->addImage(
	 $prefix.'improve_card-1_img',
	 array(
	 	'name' => esc_html__('Card image', 'realgh'),
	 	'group' => 'start'
	 )
  );
  //Text field
  $improve->addText(
	 $prefix.'improve_card-1_title', array( 'name' => esc_html__('Card title', 'realgh') )
  );
  //Textarea field
  $improve->addTextarea(
  	$prefix.'improve_card-1_text',
  	array(
  		'name' => esc_html__('Card text', 'realgh'),
  		'group' => 'end'
  	)
  );
  //Text field
  $improve->addImage(
	 $prefix.'improve_card-2_img',
	 array(
	 	'name' => esc_html__('Card image', 'realgh'),
	 	'group' => 'start'
	 )
  );
  //Text field
  $improve->addText(
	 $prefix.'improve_card-2_title', array( 'name' => esc_html__('Card title', 'realgh') )
  );
  //Textarea field
  $improve->addTextarea(
  	$prefix.'improve_card-2_text',
  	array(
  		'name' => esc_html__('Card text', 'realgh'),
  		'group' => 'end'
  	)
  );
  //Text field
  $improve->addImage(
	 $prefix.'improve_card-3_img',
	 array(
	 	'name' => esc_html__('Card image', 'realgh'),
	 	'group' => 'start'
	 )
  );
  //Text field
  $improve->addText(
	 $prefix.'improve_card-3_title', array( 'name' => esc_html__('Card title', 'realgh') )
  );
  //Textarea field
  $improve->addTextarea(
  	$prefix.'improve_card-3_text',
  	array(
  		'name' => esc_html__('Card text', 'realgh'),
  		'group' => 'end'
  	)
  );

  //Finish Meta Box Declaration 
  $improve->Finish();



  // Connect----------------------------------------------------------
  $cfg_connect = array(
	 'id'              => 'realgh_connect',          // meta box id, unique per meta box
	 'title'           => esc_html__('Connect content', 'realgh'),   // meta box title
	 'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	 'page_name'       => 'template-homepage.php',  // if single = true. Name of page for which to output metaboxes
	 'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	 'priority'        => 'high',            // order of meta box: high (default), low; optional
	 'fields'          => array(),            // list of meta fields (can be added by field arrays)
	 'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	 'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  $connect =  new AT_Meta_Box($cfg_connect);
  
  //Text field
  $connect->addText(
	 $prefix.'connect_title', array( 'name' => esc_html__('Title', 'realgh') )
  );
	//Textarea field
	$connect->addTextarea(
		$prefix.'connect_text', array( 'name' => esc_html__('Connect text', 'realgh') )
	);
  //Page field
  $connect->addPosts(
    $prefix.'connect_link_value',
    array('post_type' => 'page'),
    array(
      'name' => esc_html__('Link value', 'realgh'),
      'desc' => esc_html__('The page to which the connect link leads', 'realgh'),
      'group' => 'start'
    )
  );
  //Text field
  $connect->addText(
  	$prefix.'connect_link_text',
  	array(
  		'name' => esc_html__('Link text', 'realgh'),
  		'group' => 'end')
  );
  //Image field
  $connect->addImage(
	 $prefix.'connect_image', array('name' => esc_html__('Load the image of the connect section', 'realgh'))
  );

  //Finish Meta Box Declaration 
  $connect->Finish();



  // Work----------------------------------------------------------
  $cfg_work = array(
	 'id'              => 'realgh_work',          // meta box id, unique per meta box
	 'title'           => esc_html__('Work content', 'realgh'),   // meta box title
	 'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	 'page_name'       => 'template-homepage.php',  // if single = true. Name of page for which to output metaboxes
	 'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	 'priority'        => 'high',            // order of meta box: high (default), low; optional
	 'fields'          => array(),            // list of meta fields (can be added by field arrays)
	 'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	 'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  $work =  new AT_Meta_Box($cfg_work);
  
  //Image field
  $work->addImage(
	 $prefix.'work_image', array('name' => esc_html__('Load the image of the work section', 'realgh'))
  );
  //Text field
  $work->addText(
	 $prefix.'work_title', array( 'name' => esc_html__('Title', 'realgh') )
  );
  //Text field
  $work->addText(
	 $prefix.'work_item-1_title',
	 array(
	 	'name' => esc_html__('List item title', 'realgh'),
	 	'group' => 'start'
	 )
  );
  //Textarea field
  $work->addTextarea(
  	$prefix.'work_item-1_text',
  	array(
  		'name' => esc_html__('List item text', 'realgh'),
  		'group' => 'end'
  	)
  );
  //Text field
  $work->addText(
	 $prefix.'work_item-2_title',
	 array(
	 	'name' => esc_html__('List item title', 'realgh'),
	 	'group' => 'start'
	 )
  );
  //Textarea field
  $work->addTextarea(
  	$prefix.'work_item-2_text',
  	array(
  		'name' => esc_html__('List item text', 'realgh'),
  		'group' => 'end'
  	)
  );
  //Text field
  $work->addText(
	 $prefix.'work_item-3_title',
	 array(
	 	'name' => esc_html__('List item title', 'realgh'),
	 	'group' => 'start'
	 )
  );
  //Textarea field
  $work->addTextarea(
  	$prefix.'work_item-3_text',
  	array(
  		'name' => esc_html__('List item text', 'realgh'),
  		'group' => 'end'
  	)
  );

  //Finish Meta Box Declaration 
  $work->Finish();



  // Advantages----------------------------------------------------------
  $cfg_advantages = array(
	 'id'              => 'realgh_advantages',          // meta box id, unique per meta box
	 'title'           => esc_html__('Advantages content', 'realgh'),   // meta box title
	 'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	 'page_name'       => 'template-homepage.php',  // if single = true. Name of page for which to output metaboxes
	 'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	 'priority'        => 'high',            // order of meta box: high (default), low; optional
	 'fields'          => array(),            // list of meta fields (can be added by field arrays)
	 'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	 'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  $advantages =  new AT_Meta_Box($cfg_advantages);
  
  //Text field
  $advantages->addText(
	 $prefix.'advantages_title', array( 'name' => esc_html__('Title', 'realgh') )
  );
  //Image field
  $advantages->addImage(
	 $prefix.'advantages_top_image', array('name' => esc_html__('Load the top image of the top advantages section', 'realgh'))
  );
  //Image field
  $advantages->addImage(
	 $prefix.'advantages_bot_image-1', array('name' => esc_html__('Load the top left image of the bottom advantages section', 'realgh'))
  );
  //Image field
  $advantages->addImage(
	 $prefix.'advantages_bot_image-2', array('name' => esc_html__('Load the bottom left image of the bottom advantages section', 'realgh'))
  );
  //Image field
  $advantages->addImage(
	 $prefix.'advantages_bot_image-3', array('name' => esc_html__('Load the top right image of the bottom advantages section', 'realgh'))
  );
  //Image field
  $advantages->addImage(
	 $prefix.'advantages_bot_image-4', array('name' => esc_html__('Load the bottom right image of the bottom advantages section', 'realgh'))
  );
  //Text field
  $advantages->addText(
	 $prefix.'advantages_item-1_title',
	 array(
	 	'name' => esc_html__('List item title', 'realgh'),
	 	'group' => 'start'
	 )
  );
  //Textarea field
  $advantages->addTextarea(
  	$prefix.'advantages_item-1_text',
  	array(
  		'name' => esc_html__('List item text', 'realgh'),
  		'group' => 'end'
  	)
  );
  //Text field
  $advantages->addText(
	 $prefix.'advantages_item-2_title',
	 array(
	 	'name' => esc_html__('List item title', 'realgh'),
	 	'group' => 'start'
	 )
  );
  //Textarea field
  $advantages->addTextarea(
  	$prefix.'advantages_item-2_text',
  	array(
  		'name' => esc_html__('List item text', 'realgh'),
  		'group' => 'end'
  	)
  );
  //Text field
  $advantages->addText(
	 $prefix.'advantages_item-3_title',
	 array(
	 	'name' => esc_html__('List item title', 'realgh'),
	 	'group' => 'start'
	 )
  );
  //Textarea field
  $advantages->addTextarea(
  	$prefix.'advantages_item-3_text',
  	array(
  		'name' => esc_html__('List item text', 'realgh'),
  		'group' => 'end'
  	)
  );
  //Page field
  $advantages->addPosts(
    $prefix.'advantages_link_value',
    array('post_type' => 'page'),
    array(
      'name' => esc_html__('Link value', 'realgh'),
      'desc' => esc_html__('The page to which the advantages link leads', 'realgh'),
      'group' => 'start'
    )
  );
  //Text field
  $advantages->addText(
  	$prefix.'advantages_link_text',
  	array(
  		'name' => esc_html__('Link text', 'realgh'),
  		'group' => 'end')
  );

  //Finish Meta Box Declaration 
  $advantages->Finish();



  // Experts----------------------------------------------------------
  $cfg_experts = array(
	 'id'              => 'realgh_experts',          // meta box id, unique per meta box
	 'title'           => esc_html__('Experts content', 'realgh'),   // meta box title
	 'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	 'page_name'       => 'template-homepage.php',  // if single = true. Name of page for which to output metaboxes
	 'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	 'priority'        => 'high',            // order of meta box: high (default), low; optional
	 'fields'          => array(),            // list of meta fields (can be added by field arrays)
	 'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	 'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  $experts =  new AT_Meta_Box($cfg_experts);
  
  //Text field
  $experts->addText(
	 $prefix.'experts_title', array( 'name' => esc_html__('Title', 'realgh') )
  );
  //Textarea field
  $experts->addTextarea(
  		$prefix.'experts_text', array( 'name' => esc_html__('List item text', 'realgh') )
  );
  //Image field
  $experts->addImage(
	 $prefix.'experts_image-1', array('name' => esc_html__('Load the first image of the experts section', 'realgh'))
  );
  //Image field
  $experts->addImage(
	 $prefix.'experts_image-2', array('name' => esc_html__('Load the second image of the experts section', 'realgh'))
  );
  //Image field
  $experts->addImage(
	 $prefix.'experts_image-3', array('name' => esc_html__('Load the third image of the experts section', 'realgh'))
  );
  //Image field
  $experts->addImage(
	 $prefix.'experts_image-4', array('name' => esc_html__('Load the fourth image of the experts section', 'realgh'))
  );
  //Text field
  $experts->addText(
	 $prefix.'experts_card-text', array( 'name' => esc_html__('Enter the text of the last card', 'realgh') )
  );

  //Finish Meta Box Declaration 
  $experts->Finish();



  // Help----------------------------------------------------------
  $cfg_help = array(
	 'id'              => 'realgh_help',          // meta box id, unique per meta box
	 'title'           => esc_html__('Help content', 'realgh'),   // meta box title
	 'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	 'page_name'       => 'template-homepage.php',  // if single = true. Name of page for which to output metaboxes
	 'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	 'priority'        => 'high',            // order of meta box: high (default), low; optional
	 'fields'          => array(),            // list of meta fields (can be added by field arrays)
	 'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	 'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  $help =  new AT_Meta_Box($cfg_help);
  
  //Text field
  $help->addText(
	 $prefix.'help_title', array( 'name' => esc_html__('Title', 'realgh') )
  );
  //Text field
  $help->addImage(
	 $prefix.'help_card-1_img',
	 array(
	 	'name' => esc_html__('Card image', 'realgh'),
	 	'group' => 'start'
	 )
  );
  //Text field
  $help->addText(
	 $prefix.'help_card-1_title', array( 'name' => esc_html__('Card title', 'realgh') )
  );
  //Textarea field
  $help->addTextarea(
  	$prefix.'help_card-1_text',
  	array(
  		'name' => esc_html__('Card text', 'realgh'),
  		'group' => 'end'
  	)
  );
  //Text field
  $help->addImage(
	 $prefix.'help_card-2_img',
	 array(
	 	'name' => esc_html__('Card image', 'realgh'),
	 	'group' => 'start'
	 )
  );
  //Text field
  $help->addText(
	 $prefix.'help_card-2_title', array( 'name' => esc_html__('Card title', 'realgh') )
  );
  //Textarea field
  $help->addTextarea(
  	$prefix.'help_card-2_text',
  	array(
  		'name' => esc_html__('Card text', 'realgh'),
  		'group' => 'end'
  	)
  );
  //Text field
  $help->addImage(
	 $prefix.'help_card-3_img',
	 array(
	 	'name' => esc_html__('Card image', 'realgh'),
	 	'group' => 'start'
	 )
  );
  //Text field
  $help->addText(
	 $prefix.'help_card-3_title', array( 'name' => esc_html__('Card title', 'realgh') )
  );
  //Textarea field
  $help->addTextarea(
  	$prefix.'help_card-3_text',
  	array(
  		'name' => esc_html__('Card text', 'realgh'),
  		'group' => 'end'
  	)
  );

  //Finish Meta Box Declaration 
  $help->Finish();



  // Reviews----------------------------------------------------------
  $cfg_reviews = array(
	 'id'              => 'realgh_reviews',          // meta box id, unique per meta box
	 'title'           => esc_html__('Reviews content', 'realgh'),   // meta box title
	 'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	 'page_name'       => 'template-homepage.php',  // if single = true. Name of page for which to output metaboxes
	 'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	 'priority'        => 'high',            // order of meta box: high (default), low; optional
	 'fields'          => array(),            // list of meta fields (can be added by field arrays)
	 'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	 'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  $reviews =  new AT_Meta_Box($cfg_reviews);
  
  //Text field
  $reviews->addText(
	 $prefix.'reviews_title', array( 'name' => esc_html__('Title', 'realgh') )
  );

  /*
	* To Create a reapeater Block first create an array of fields
	* use the same functions as above but add true as a last param
	*/
	$repeater_review = array();

	//Text field
	$repeater_review[] = $reviews->addText($prefix.'review_name', array( 'name' => esc_html__('The name of the reviewer', 'realgh') ), true);
	//Text field
	$repeater_review[] = $reviews->addImage($prefix.'reviews_image', array( 'name' => esc_html__('Image of the reviewer', 'realgh') ), true);
	//Textarea field
	$repeater_review[] = $reviews->addTextarea($prefix.'reviews_text', array( 'name' => esc_html__('Review text', 'realgh') ), true);
	//Number field
	$repeater_review[] = $reviews->addNumber(
		$prefix.'review_score',
		array(
			'name' => esc_html__('Review score', 'realgh'),
			'max' => 5
		),
		true
	);

	/*
	* Then just add the fields to the repeater block
	*/
	//repeater block
	$reviews->addRepeaterBlock($prefix.'re_reviews',array(
	 'inline'   => false, 
	 'name'     => 'Reviews list',
	 'fields'   => $repeater_review, 
	 'sortable' => false
	));

  //Finish Meta Box Declaration 
  $reviews->Finish();



  // FAQ----------------------------------------------------------
  $cfg_faq = array(
	 'id'              => 'realgh_faq',          // meta box id, unique per meta box
	 'title'           => esc_html__('FAQ content', 'realgh'),   // meta box title
	 'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	 'page_name'       => 'template-homepage.php',  // if single = true. Name of page for which to output metaboxes
	 'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	 'priority'        => 'high',            // order of meta box: high (default), low; optional
	 'fields'          => array(),            // list of meta fields (can be added by field arrays)
	 'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	 'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  $faq =  new AT_Meta_Box($cfg_faq);
  
  //Text field
  $faq->addText(
	 $prefix.'faq_title', array( 'name' => esc_html__('Title', 'realgh') )
  );

	$repeater_faq = array();

  /*
   * To Create a conditinal Block first create an array of fields
   * use the same functions as above but add true as a last param (like the repater block)
   */
  $conditinal_list[] = $faq->addTextarea(
  		$prefix.'answer_list',
  		array(
  			'name' => esc_html__('Answer list items', 'realgh' ),
  			'desc' => esc_html__('Start each new item in the list on a new line', 'realgh' )
  		),
		true
	);

	//Text field
	$repeater_faq[] = $faq->addText($prefix.'faq_quest', array( 'name' => esc_html__('Question', 'realgh') ), true);
	//Textarea field
	$repeater_faq[] = $faq->addTextarea($prefix.'faq_answer', array( 'name' => esc_html__('Answer', 'realgh') ), true);
	//Condition field
	$repeater_faq[] = $faq->addCondition('conditinal_list',
      array(
        'name'   => esc_html__('Answer list','realgh'),
        'desc'   => esc_html__('Would you like to add a list in response?','realgh'),
        'fields' => $conditinal_list,
        'std'    => false
      ),
      true
   );

	//repeater block
	$faq->addRepeaterBlock($prefix.'re_faq',array(
	 'inline'   => false, 
	 'name'     => 'Answers list',
	 'fields'   => $repeater_faq, 
	 'sortable' => false
	));

  //Finish Meta Box Declaration 
  $faq->Finish();



  // Join----------------------------------------------------------
  $cfg_join = array(
	 'id'              => 'realgh_join',          // meta box id, unique per meta box
	 'title'           => esc_html__('Join content', 'realgh'),   // meta box title
	 'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	 'page_name'       => 'template-homepage.php',  // if single = true. Name of page for which to output metaboxes
	 'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	 'priority'        => 'high',            // order of meta box: high (default), low; optional
	 'fields'          => array(),            // list of meta fields (can be added by field arrays)
	 'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	 'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  $join =  new AT_Meta_Box($cfg_join);
  
  //Image field
  $join->addImage(
	 $prefix.'join_image', array('name' => esc_html__('Load the background image of the join section', 'realgh'))
  );
  //Text field
  $join->addText(
	 $prefix.'join_title', array( 'name' => esc_html__('Title', 'realgh') )
  );
  //Textarea field
  $join->addTextarea(
	 $prefix.'join_text', array( 'name' => esc_html__('Text', 'realgh') )
  );
  //Page field
  $join->addPosts(
    $prefix.'join_link_value',
    array('post_type' => 'page'),
    array(
      'name' => esc_html__('Link value', 'realgh'),
      'desc' => esc_html__('The page to which the mainscreen link leads', 'realgh'),
      'group' => 'start'
    )
  );
  //Text field
  $join->addText(
  	$prefix.'join_link_text',
  	array(
  		'name' => esc_html__('Link text', 'realgh'),
  		'group' => 'end')
  );

  //Finish Meta Box Declaration 
  $join->Finish();
}