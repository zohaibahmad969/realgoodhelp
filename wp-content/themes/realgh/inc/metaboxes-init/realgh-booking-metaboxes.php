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
	* Find booking step
  */
  $cfg_bookingstep1 = array(
	 'id'              => 'realgh_bookingstep1',          // meta box id, unique per meta box
	 'title'           => esc_html__('Select your consultation type step content', 'realgh'),   // meta box title
	 'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	 'page_name'       => 'template-book.php',  // if single = true. Name of page for which to output metaboxes
	 'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	 'priority'        => 'high',            // order of meta box: high (default), low; optional
	 'fields'          => array(),            // list of meta fields (can be added by field arrays)
	 'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	 'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
	* Initiate your meta box
  */
  $bookingstep1 =  new AT_Meta_Box($cfg_bookingstep1);

  //Text field
  $bookingstep1->addText(
   $prefix.'book_step_main_title_1', array( 'name' => esc_html__('Book step main title', 'realgh'),
   'group' => 'start' )
  );
  //Text field
  $bookingstep1->addText(
   $prefix.'book_step_title', array( 'name' => esc_html__('Book step title ', 'realgh'),
   'group' => 'end' )
  );
  //Button text field
  $bookingstep1->addText(
    $prefix.'previous_button_text', array( 'name' => esc_html__('Previous button text ', 'realgh'),
    'group' => 'start' )
  );
     
  $bookingstep1->addText(
    $prefix.'continue_button_text', array( 'name' => esc_html__('Continue button text ', 'realgh'),
    'group' => 'end' )
  );

  /*
	* Don't Forget to Close up the meta box Declaration 
  */
  //Finish Meta Box Declaration 
$bookingstep1->Finish();


/* Find booking step
*/
$cfg_bookingstep2 = array(
 'id'              => 'realgh_bookingstep2',          // meta box id, unique per meta box
 'title'           => esc_html__('Schedule your consultation step content', 'realgh'),   // meta box title
 'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
 'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
 'page_name'       => 'template-book.php',  // if single = true. Name of page for which to output metaboxes
 'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
 'priority'        => 'high',            // order of meta box: high (default), low; optional
 'fields'          => array(),            // list of meta fields (can be added by field arrays)
 'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
 'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);


/*
* Initiate your meta box
*/
$bookingstep2 =  new AT_Meta_Box($cfg_bookingstep2);

//Text field
$bookingstep2->addText(
 $prefix.'book_step_main_title_2', array( 'name' => esc_html__('Book step main title', 'realgh'),
 'group' => 'start' )
);
//Text field
$bookingstep2->addText(
  $prefix.'book_step2_title', array( 'name' => esc_html__('Book step title', 'realgh'),
  'group' => 'end' )
 );
//Textarea field
$bookingstep2->addTextarea(
 $prefix.'book_step2_desc', array( 'name' => esc_html__('Book step desc ', 'realgh'),
 'group' => 'start' )
);
//Button text field
$bookingstep2->addText(
  $prefix.'previous_button_text', array( 'name' => esc_html__('Previous button text ', 'realgh'),
  'group' => 'end' )
);
$bookingstep2->addText(
  $prefix.'continue_button_text', array( 'name' => esc_html__('Continue button text ', 'realgh')
  )
);

/*
* Don't Forget to Close up the meta box Declaration 
*/
//Finish Meta Box Declaration 
$bookingstep2->Finish();

/* Find booking step
*/
$cfg_bookingstep3 = array(
  'id'              => 'realgh_bookingstep3',          // meta box id, unique per meta box
  'title'           => esc_html__('Communication tool step content', 'realgh'),   // meta box title
  'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
  'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
  'page_name'       => 'template-book.php',  // if single = true. Name of page for which to output metaboxes
  'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
  'priority'        => 'high',            // order of meta box: high (default), low; optional
  'fields'          => array(),            // list of meta fields (can be added by field arrays)
  'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
  'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
 );
 
 
 /*
 * Initiate your meta box
 */
 $bookingstep3 =  new AT_Meta_Box($cfg_bookingstep3);
 
 //Text field
 $bookingstep3->addText(
  $prefix.'book_step_main_title_3', array( 'name' => esc_html__('Book step main title', 'realgh'),
  'group' => 'start' )
 );
 //Text field
 $bookingstep3->addText(
   $prefix.'book_step3_title', array( 'name' => esc_html__('Book step title', 'realgh'),
   'group' => 'end' )
  );
 //Textarea field
 $bookingstep3->addTextarea(
  $prefix.'book_step3_desc', array( 'name' => esc_html__('book step desc ', 'realgh'),
  'group' => 'start' )
 );
 //Button text field
 $bookingstep3->addText(
   $prefix.'previous_button_text', array( 'name' => esc_html__('Previous button text ', 'realgh'),
   'group' => 'end' )
 );
    
 $bookingstep3->addText(
   $prefix.'continue_button_text', array( 'name' => esc_html__('Continue button text ', 'realgh') )
 );
 
 /*
 * Don't Forget to Close up the meta box Declaration 
 */
 //Finish Meta Box Declaration 
 $bookingstep3->Finish();


/* Find booking step
*/
$cfg_bookingstep4 = array(
  'id'              => 'realgh_bookingstep4',          // meta box id, unique per meta box
  'title'           => esc_html__('Payment step content', 'realgh'),   // meta box title
  'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
  'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
  'page_name'       => 'template-book.php',  // if single = true. Name of page for which to output metaboxes
  'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
  'priority'        => 'high',            // order of meta box: high (default), low; optional
  'fields'          => array(),            // list of meta fields (can be added by field arrays)
  'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
  'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
 );
 
 
 /*
 * Initiate your meta box
 */
 $bookingstep4 =  new AT_Meta_Box($cfg_bookingstep4);
 
 //Text field
 $bookingstep4->addText(
  $prefix.'book_step_main_title_4', array( 'name' => esc_html__('Book step main title', 'realgh'),
  'group' => 'start' )
 );
 //Text field
 $bookingstep4->addText(
   $prefix.'book_step4_title', array( 'name' => esc_html__('Book step title', 'realgh'),
   'group' => 'end' )
  );
 //Textarea desc
 $bookingstep4->addTextarea(
  $prefix.'book_step4_desc', array( 'name' => esc_html__('book step desc ', 'realgh'),
  'group' => 'start' )
 );
 //Text field
 $bookingstep4->addText(
  $prefix.'book_step_payment_method_title', array( 'name' => esc_html__('Book step payment method title', 'realgh'),
  'group' => 'end' )
 );
 //Textarea desc
 $bookingstep4->addTextarea(
  $prefix.'book_step_payment_method_desc', array( 'name' => esc_html__('Book step payment method desc', 'realgh'),
  'group' => 'start' )
 );

 //Text field
 $bookingstep4->addText(
  $prefix.'book_step_promo_code_title', array( 'name' => esc_html__('Book step promo code title', 'realgh'),
  'group' => 'end' )
 );
  // Placeholder
  $bookingstep4->addText(
    $prefix.'promo_code_input_placeholder', array( 'name' => esc_html__('Promo code input placeholder', 'realgh'),
    'group' => 'start' )
  );
  // Placeholder
  $bookingstep4->addText(
    $prefix.'promo_code_input_button_text', array( 'name' => esc_html__('Promo code input button text', 'realgh'),
    'group' => 'end' )
  );
 //Button text field
  $bookingstep4->addText(
    $prefix.'previous_button_text', array( 'name' => esc_html__('Previous button text ', 'realgh') )
  );
 /*
 * Don't Forget to Close up the meta box Declaration 
 */
 //Finish Meta Box Declaration 
 $bookingstep4->Finish();



}
