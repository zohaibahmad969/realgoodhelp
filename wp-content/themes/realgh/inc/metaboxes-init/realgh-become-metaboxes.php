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
	* Become 
  */
  // MainScreen----------------------------------------------------------
  $cfg_mainscreen = array(
	 'id'              => 'realgh_mainscreen',          // meta box id, unique per meta box
	 'title'           => esc_html__('Mainscreen content', 'realgh'),   // meta box title
	 'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	 'page_name'       => 'template-become.php',  // if single = true. Name of page for which to output metaboxes
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
      'group' => 'end'
    )
  );

  // Image field
  $mainscreen->addImage(
	 $prefix.'main_banner_image', array('name' => esc_html__('Load the image of the mainscreen', 'realgh'))
  );

  /*
	* Don't Forget to Close up the meta box Declaration 
  */
  //Finish Meta Box Declaration 
  $mainscreen->Finish();

  // Wating----------------------------------------------------------
$cfg_waiting = array(
  'id'              => 'realgh_waiting',          // meta box id, unique per meta box
  'title'           => esc_html__('Waiting content', 'realgh'),   // meta box title
  'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
  'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
  'page_name'       => 'template-become.php',  // if single = true. Name of page for which to output metaboxes
  'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
  'priority'        => 'high',            // order of meta box: high (default), low; optional
  'fields'          => array(),            // list of meta fields (can be added by field arrays)
  'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
  'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);
   
   
/*
* Initiate your meta box
*/
$waiting=  new AT_Meta_Box($cfg_waiting);

/*
* Add fields to your meta box
*/
//Text field
$waiting->addText(
  $prefix.'waiting_main_title', array( 'name' => esc_html__('Title', 'realgh') )
  );
  //Textarea field
  $waiting->addTextarea(
  $prefix.'waiting_main_text', array( 'name' => esc_html__('Text', 'realgh') )
);

//Text field
$waiting->addImage(
  $prefix.'waiting_card-1_img',
  array(
    'name' => esc_html__('Card image', 'realgh'),
    'group' => 'start'
  )
);
//Text field
$waiting->addText(
  $prefix.'waiting_card-1_title', array( 'name' => esc_html__('Card title', 'realgh') )
);
//Textarea field
$waiting->addTextarea(
  $prefix.'waiting_card-1_text',
  array(
    'name' => esc_html__('Card text', 'realgh'),
    'group' => 'end'
  )
);

//Text field
$waiting->addImage(
  $prefix.'waiting_card-2_img',
  array(
    'name' => esc_html__('Card image', 'realgh'),
    'group' => 'start'
  )
);
//Text field
$waiting->addText(
  $prefix.'waiting_card-2_title', array( 'name' => esc_html__('Card title', 'realgh') )
);
  //Textarea field
  $waiting->addTextarea(
    $prefix.'waiting_card-2_text',
    array(
      'name' => esc_html__('Card text', 'realgh'),
      'group' => 'end'
    )
  );
  //Text field
  $waiting->addImage(
    $prefix.'waiting_card-3_img',
    array(
      'name' => esc_html__('Card image', 'realgh'),
      'group' => 'start'
    )
  );
  //Text field
  $waiting->addText(
    $prefix.'waiting_card-3_title', array( 'name' => esc_html__('Card title', 'realgh') )
  );
  //Textarea field
  $waiting->addTextarea(
    $prefix.'waiting_card-3_text',
    array(
       'name' => esc_html__('Card text', 'realgh'),
       'group' => 'end'
    )
  );

   /*
   * Don't Forget to Close up the meta box Declaration 
   */
   //Finish Meta Box Declaration 
   $waiting->Finish();


// Experts----------------------------------------------------------
$cfg_experts = array(
  'id'              => 'realgh_experts',          // meta box id, unique per meta box
  'title'           => esc_html__('Experts content', 'realgh'),   // meta box title
  'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
  'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
  'page_name'       => 'template-become.php',  // if single = true. Name of page for which to output metaboxes
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



// Connect----------------------------------------------------------
$cfg_cooperation = array(
  'id'              => 'realgh_cooperation',          // meta box id, unique per meta box
  'title'           => esc_html__('Cooperation content', 'realgh'),   // meta box title
  'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
  'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
  'page_name'       => 'template-become.php',  // if single = true. Name of page for which to output metaboxes
  'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
  'priority'        => 'high',            // order of meta box: high (default), low; optional
  'fields'          => array(),            // list of meta fields (can be added by field arrays)
  'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
  'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);
 
$cooperation =  new AT_Meta_Box($cfg_cooperation);
 
//Text title
$cooperation->addText(
  $prefix.'cooperation_title_heading', array( 'name' => esc_html__('Heading title', 'realgh') )
);

//Text title
$cooperation->addText(
  $prefix.'cooperation_title_1', array( 'name' => esc_html__('Title', 'realgh'),
  'group' => 'start' )
);

 //Text area
 $cooperation->addTextarea(
  $prefix.'cooperation_desc_1', array( 'name' => esc_html__('Description', 'realgh'),
  'group' => 'end' )
);

//Text title
$cooperation->addText(
  $prefix.'cooperation_title_2', array( 'name' => esc_html__('Title', 'realgh'),
  'group' => 'start' )
);

 //Text area
 $cooperation->addTextarea(
  $prefix.'cooperation_desc_2', array( 'name' => esc_html__('Description', 'realgh'),
  'group' => 'end' )
);

//Image field
$cooperation->addImage(
  $prefix.'cooperation_image', array('name' => esc_html__('Load the top image of the cooperation section', 'realgh'))
);


//Image field
$cooperation->addImage(
  $prefix.'cooperation_image_1', array('name' => esc_html__('Load the bottom image of the cooperation section', 'realgh'))
);
//Image field
$cooperation->addImage(
  $prefix.'cooperation_image_2', array('name' => esc_html__('Load the bottom image of the cooperation section', 'realgh'))
);

//Text title
$cooperation->addText(
  $prefix.'cooperation_title_3', array( 'name' => esc_html__('Title', 'realgh'),
  'group' => 'start' )
);

 //Text area
 $cooperation->addTextarea(
  $prefix.'cooperation_desc_3', array( 'name' => esc_html__('Description', 'realgh'),
  'group' => 'end' )
);

//Text title
$cooperation->addText(
  $prefix.'cooperation_title_4', array( 'name' => esc_html__('Title', 'realgh'),
  'group' => 'start' )
);

 //Text area
 $cooperation->addTextarea(
  $prefix.'cooperation_desc_4', array( 'name' => esc_html__('Description', 'realgh'),
  'group' => 'end' )
);

//Text title
$cooperation->addText(
  $prefix.'cooperation_title_5', array( 'name' => esc_html__('Title', 'realgh'),
  'group' => 'start' )
);
 //Text area
 $cooperation->addTextarea(
  $prefix.'cooperation_desc_5', array( 'name' => esc_html__('Description', 'realgh'),
  'group' => 'end' )
);


 //Page field
 $cooperation->addPosts(
  $prefix.'cooperation_link_value',
  array('post_type' => 'page'),
  array(
    'name' => esc_html__('Link value', 'realgh'),
    'desc' => esc_html__('The page to which the connect link leads', 'realgh'),
    'group' => 'start'
  )
);

 //Text field
 $cooperation->addText(
  $prefix.'cooperation_link_text',
  array(
    'name' => esc_html__('Link text', 'realgh'),
    'group' => 'end')
);


//Finish Meta Box Declaration 
$cooperation->Finish();
 
// FAQ----------------------------------------------------------
$cfg_faq = array(
  'id'              => 'realgh_faq',          // meta box id, unique per meta box
  'title'           => esc_html__('FAQ content', 'realgh'),   // meta box title
  'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
  'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
  'page_name'       => 'template-become.php',  // if single = true. Name of page for which to output metaboxes
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


}