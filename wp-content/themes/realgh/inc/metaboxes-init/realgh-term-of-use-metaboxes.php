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
	* Termsuseinfo
  */
  $cfg_termsuseinfo = array(
	 'id'              => 'realgh_termsuseinfo',          // meta box id, unique per meta box
	 'title'           => esc_html__('Termsuseinfo section', 'realgh'),   // meta box title
	 'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	 'page_name'       => 'template-term-of-use.php',  // if single = true. Name of page for which to output metaboxes
	 'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	 'priority'        => 'high',            // order of meta box: high (default), low; optional
	 'fields'          => array(),            // list of meta fields (can be added by field arrays)
	 'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	 'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
	* Initiate your meta box
  */
  $termsuseinfo =  new AT_Meta_Box($cfg_termsuseinfo);
  
  /*
	* Add fields to your meta box
  */
  //Text field
  $termsuseinfo->addText(
   $prefix.'termsuse_main_title', array( 'name' => esc_html__('Main title', 'realgh') )
  );
  //Textarea field
  $termsuseinfo->addTextarea(
   $prefix.'termsuse_description_text_1', array( 'name' => esc_html__('Description text', 'realgh'),
   'group' => 'start' )
  );
 //Textarea field
 $termsuseinfo->addTextarea(
  $prefix.'termsuse_description_text_2', array( 'name' => esc_html__('Description text', 'realgh'),
  'group' => 'end' )
 );


  
  /*
  * To Create a reapeater Block first create an array of fields
  * use the same functions as above but add true as a last param
  */
  
  //Finish Meta Box Declaration 
  $termsuseinfo->Finish();



/* 
* Health Disclaimer
*/
$cfg_healthdisclaimer = array(
  'id'              => 'realgh_healthdisclaimer',          // meta box id, unique per meta box
  'title'           => esc_html__('Health disclaimer section', 'realgh'),   // meta box title
  'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
  'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
  'page_name'       => 'template-term-of-use.php',  // if single = true. Name of page for which to output metaboxes
  'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
  'priority'        => 'high',            // order of meta box: high (default), low; optional
  'fields'          => array(),            // list of meta fields (can be added by field arrays)
  'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
  'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);
   
   
  /*
  * Initiate your meta box
  */
$healthdisclaimer =  new AT_Meta_Box($cfg_healthdisclaimer);
   
  /*
  * Add fields to your meta box
  */
   //Text field
   $healthdisclaimer->addText(
    $prefix.'health_main_title', array( 'name' => esc_html__('Main title', 'realgh') )
   );
  //Textarea field
  $healthdisclaimer->addTextarea(
    $prefix.'health_description_text', array( 'name' => esc_html__('Description text', 'realgh') )
  );
 
  
   //Finish Meta Box Declaration 
   $healthdisclaimer->Finish();


/* 
*purpose
*/
$cfg_purpose = array(
  'id'              => 'realgh_purpose',          // meta box id, unique per meta box
  'title'           => esc_html__('Purpose section', 'realgh'),   // meta box title
  'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
  'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
  'page_name'       => 'template-term-of-use.php',  // if single = true. Name of page for which to output metaboxes
  'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
  'priority'        => 'high',            // order of meta box: high (default), low; optional
  'fields'          => array(),            // list of meta fields (can be added by field arrays)
  'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
  'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);
   
   
/*
  * Initiate your meta box
*/
$purpose  =  new AT_Meta_Box($cfg_purpose );
   
/*
  * Add fields to your meta box
*/
//Text field
$purpose->addText(
  $prefix.'purpose_main_title', array( 'name' => esc_html__('Main title', 'realgh') )
);
//Textarea field
$purpose->addTextarea(
  $prefix.'purpose_description_text', array( 'name' => esc_html__('Description text', 'realgh') )
);
  
//Finish Meta Box Declaration 
$purpose->Finish();

/* 
*Account
*/
$cfg_account = array(
  'id'              => 'realgh_account',          // meta box id, unique per meta box
  'title'           => esc_html__('Account section', 'realgh'),   // meta box title
  'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
  'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
  'page_name'       => 'template-term-of-use.php',  // if single = true. Name of page for which to output metaboxes
  'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
  'priority'        => 'high',            // order of meta box: high (default), low; optional
  'fields'          => array(),            // list of meta fields (can be added by field arrays)
  'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
  'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);
   
   
/*
  * Initiate your meta box
*/
$account  =  new AT_Meta_Box($cfg_account );
   
/*
  * Add fields to your meta box
*/
//Text field
$account->addText(
  $prefix.'account_main_title', array( 'name' => esc_html__('Main title', 'realgh') )
);
//Textarea field
$account->addTextarea(
  $prefix.'account_description_text_1', array( 'name' => esc_html__('Description text', 'realgh'),
  'group' => 'start' )
);
//Textarea field
$account->addTextarea(
  $prefix.'account_description_text_2', array( 'name' => esc_html__('Description text', 'realgh'),
  'group' => 'end' )
);
//Textarea field
$account->addTextarea(
  $prefix.'account_description_text_3', array( 'name' => esc_html__('Description text', 'realgh'),
  'group' => 'start' )
);
//Textarea field
$account->addTextarea(
  $prefix.'account_description_text_4', array( 'name' => esc_html__('Description text', 'realgh'),
  'group' => 'end' )
);
//Textarea field
$account->addTextarea(
  $prefix.'account_description_text_5', array( 'name' => esc_html__('Description text', 'realgh'),
  'group' => 'start' )
);

//Textarea field
$account->addTextarea(
  $prefix.'account_description_text_6', array( 'name' => esc_html__('Description text', 'realgh'),
  'group' => 'end' )
);


  
//Finish Meta Box Declaration 
$account->Finish();

/* 
*Acceptable
*/
$cfg_acceptable = array(
  'id'              => 'realgh_acceptable',          // meta box id, unique per meta box
  'title'           => esc_html__('Acceptable section', 'realgh'),   // meta box title
  'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
  'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
  'page_name'       => 'template-term-of-use.php',  // if single = true. Name of page for which to output metaboxes
  'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
  'priority'        => 'high',            // order of meta box: high (default), low; optional
  'fields'          => array(),            // list of meta fields (can be added by field arrays)
  'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
  'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);
   
   
/*
  * Initiate your meta box
*/
$acceptable  =  new AT_Meta_Box($cfg_acceptable );
   
/*
  * Add fields to your meta box
*/
//Text field
$acceptable->addText(
  $prefix.'acceptable_main_title', array( 'name' => esc_html__('Main title', 'realgh') )
);
//Textarea field
$acceptable->addTextarea(
  $prefix.'acceptable_description_text_1', array( 'name' => esc_html__('Description text', 'realgh') )
);

$upload_links = array();

// upload link text
$upload_links[] = $acceptable->addText($prefix.'acceptable_list_item', array( 'name' => esc_html__('Acceptable list item', 'realgh') ), true);

//repeater block
$acceptable->addRepeaterBlock($prefix.'acceptable_list_repeter',array(
  'inline'   => false, 
  'name'     => 'Acceptable list item',
  'fields'   => $upload_links, 
  'sortable' => false,
  'group' => 'start'
));


//Textarea field
$acceptable->addTextarea(
  $prefix.'acceptable_description_text_2', array( 'name' => esc_html__('Description text', 'realgh'),
  'group' => 'end' )
 
);
//Textarea field
$acceptable->addTextarea(
  $prefix.'acceptable_description_text_3', array( 'name' => esc_html__('Description text', 'realgh'),
  'group' => 'start' )
);
//Textarea field
$acceptable->addTextarea(
  $prefix.'acceptable_description_text_4', array( 'name' => esc_html__('Description text', 'realgh'),
  'group' => 'end' )
);
//Textarea field
$acceptable->addTextarea(
  $prefix.'acceptable_description_text_5', array( 'name' => esc_html__('Description text', 'realgh'),
  'group' => 'start' )
);
//Textarea field
$acceptable->addTextarea(
  $prefix.'acceptable_description_text_6', array( 'name' => esc_html__('Description text', 'realgh'),
  'group' => 'end' )
);



$upload_links = array();

// upload link text
$upload_links[] = $acceptable->addText($prefix.'acceptable_list_item_2', array( 'name' => esc_html__('Acceptable list item', 'realgh') ), true);

//repeater block
$acceptable->addRepeaterBlock($prefix.'acceptable_list_repeter_2',array(
  'inline'   => false, 
  'name'     => 'Acceptable list item',
  'fields'   => $upload_links, 
  'sortable' => false,
  'group' => 'start'
));

//Textarea field
$acceptable->addTextarea(
  $prefix.'acceptable_description_text_7', array( 'name' => esc_html__('Description text', 'realgh'),
  'group' => 'end' )
);



//Finish Meta Box Declaration 
$acceptable->Finish();


/* 
*Payment
*/
$cfg_payment = array(
  'id'              => 'realgh_payment',          // meta box id, unique per meta box
  'title'           => esc_html__('Payment section', 'realgh'),   // meta box title
  'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
  'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
  'page_name'       => 'template-term-of-use.php',  // if single = true. Name of page for which to output metaboxes
  'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
  'priority'        => 'high',            // order of meta box: high (default), low; optional
  'fields'          => array(),            // list of meta fields (can be added by field arrays)
  'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
  'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);
   
   
/*
  * Initiate your meta box
*/
$payment  =  new AT_Meta_Box($cfg_payment );
   
/*
  * Add fields to your meta box
*/
//Text field
$payment->addText(
  $prefix.'payment_main_title', array( 'name' => esc_html__('Main title', 'realgh') )
);

//Textarea field
$payment->addTextarea(
  $prefix.'payment_description_text_1', array( 'name' => esc_html__('Description text', 'realgh'),
  'group' => 'start' )
 
);

//Textarea field
$payment->addTextarea(
  $prefix.'payment_description_text_2', array( 'name' => esc_html__('Description text', 'realgh'),
  'group' => 'end' )
 
);

//Textarea field
$payment->addTextarea(
  $prefix.'payment_description_text_3', array( 'name' => esc_html__('Description text', 'realgh'),
  'group' => 'start' )
 
);

//Textarea field
$payment->addTextarea(
  $prefix.'payment_description_text_4', array( 'name' => esc_html__('Description text', 'realgh'),
  'group' => 'end' )
 
);


//Finish Meta Box Declaration 
$payment->Finish();



/* 
*Payment
*/
$cfg_money_back = array(
  'id'              => 'realgh_money_back',          // meta box id, unique per meta box
  'title'           => esc_html__('Money back section', 'realgh'),   // meta box title
  'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
  'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
  'page_name'       => 'template-term-of-use.php',  // if single = true. Name of page for which to output metaboxes
  'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
  'priority'        => 'high',            // order of meta box: high (default), low; optional
  'fields'          => array(),            // list of meta fields (can be added by field arrays)
  'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
  'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);
   
   
/*
  * Initiate your meta box
*/
$money_back  =  new AT_Meta_Box($cfg_money_back );
   
/*
  * Add fields to your meta box
*/
//Text field
$money_back->addText(
  $prefix.'money_back_main_title', array( 'name' => esc_html__('Main title', 'realgh') )
);

//Textarea field
$money_back->addTextarea(
  $prefix.'money_back_description_text_1', array( 'name' => esc_html__('Description text', 'realgh'),
  'group' => 'start' )
 
);

//Textarea field
$money_back->addTextarea(
  $prefix.'money_back_description_text_2', array( 'name' => esc_html__('Description text', 'realgh'),
  'group' => 'end' )
 
);

//Textarea field
$money_back->addTextarea(
  $prefix.'money_back_description_text_3', array( 'name' => esc_html__('Description text', 'realgh'),
  'group' => 'start' )
 
);

//Textarea field
$money_back->addTextarea(
  $prefix.'money_back_description_text_4', array( 'name' => esc_html__('Description text', 'realgh'),
  'group' => 'end' )
 
);


//Finish Meta Box Declaration 
$money_back->Finish();




/* 
*therapist
*/
$cfg_therapist = array(
  'id'              => 'realgh_therapist',          // meta box id, unique per meta box
  'title'           => esc_html__('Therapist section', 'realgh'),   // meta box title
  'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
  'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
  'page_name'       => 'template-term-of-use.php',  // if single = true. Name of page for which to output metaboxes
  'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
  'priority'        => 'high',            // order of meta box: high (default), low; optional
  'fields'          => array(),            // list of meta fields (can be added by field arrays)
  'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
  'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);
   
   
/*
  * Initiate your meta box
*/
$therapist  =  new AT_Meta_Box($cfg_therapist );
   
/*
  * Add fields to your meta box
*/
//Text field
$therapist->addText(
  $prefix.'therapist_main_title', array( 'name' => esc_html__('Main title', 'realgh'),
  'group' => 'start' ) 
);

//Textarea field
$therapist->addTextarea(
  $prefix.'therapist_description_text_1', array( 'name' => esc_html__('Description text', 'realgh'),
  'group' => 'end' )
 
);

//Textarea field
$therapist->addTextarea(
  $prefix.'therapist_description_text_2', array( 'name' => esc_html__('Description text', 'realgh'),
  'group' => 'start' )
 
);

//Textarea field
$therapist->addTextarea(
  $prefix.'therapist_description_text_3', array( 'name' => esc_html__('Description text', 'realgh'),
  'group' => 'end' )
 
);



//Finish Meta Box Declaration 
$therapist->Finish();


/* 
*Privacy
*/
$cfg_privacy = array(
  'id'              => 'realgh_privacy',          // meta box id, unique per meta box
  'title'           => esc_html__('Privacy section', 'realgh'),   // meta box title
  'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
  'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
  'page_name'       => 'template-term-of-use.php',  // if single = true. Name of page for which to output metaboxes
  'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
  'priority'        => 'high',            // order of meta box: high (default), low; optional
  'fields'          => array(),            // list of meta fields (can be added by field arrays)
  'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
  'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);
   
   
/*
  * Initiate your meta box
*/
$privacy  =  new AT_Meta_Box($cfg_privacy );
   
/*
  * Add fields to your meta box
*/
//Text field
$privacy->addText(
  $prefix.'privacy_main_title', array( 'name' => esc_html__('Main title', 'realgh'),
  'group' => 'start' ) 
);

//Textarea field
$privacy->addTextarea(
  $prefix.'privacy_description_text', array( 'name' => esc_html__('Description text', 'realgh'),
  'group' => 'end' )
 
);

//Finish Meta Box Declaration 
$privacy->Finish();

/* 
*linkedwebsite
*/
$cfg_linkedwebsite = array(
  'id'              => 'realgh_linkedwebsite',          // meta box id, unique per meta box
  'title'           => esc_html__('Linked website section', 'realgh'),   // meta box title
  'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
  'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
  'page_name'       => 'template-term-of-use.php',  // if single = true. Name of page for which to output metaboxes
  'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
  'priority'        => 'high',            // order of meta box: high (default), low; optional
  'fields'          => array(),            // list of meta fields (can be added by field arrays)
  'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
  'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);
   
   
/*
  * Initiate your meta box
*/
$linkedwebsite  =  new AT_Meta_Box($cfg_linkedwebsite );
   
/*
  * Add fields to your meta box
*/
//Text field
$linkedwebsite->addText(
  $prefix.'linked_website_main_title', array( 'name' => esc_html__('linked website content main title', 'realgh'),
  'group' => 'start'
  ) 
);

//Textarea field
$linkedwebsite->addTextarea(
  $prefix.'linked_website_description_text', array( 'name' => esc_html__('linked website content description text', 'realgh'),
  'group' => 'end' )
 
);



// //Finish Meta Box Declaration 
$linkedwebsite->Finish();



/* 
*thirdparty
*/
$cfg_thirdparty = array(
  'id'              => 'realgh_thirdparty',          // meta box id, unique per meta box
  'title'           => esc_html__('Third party section', 'realgh'),   // meta box title
  'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
  'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
  'page_name'       => 'template-term-of-use.php',  // if single = true. Name of page for which to output metaboxes
  'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
  'priority'        => 'high',            // order of meta box: high (default), low; optional
  'fields'          => array(),            // list of meta fields (can be added by field arrays)
  'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
  'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);
   
   
/*
  * Initiate your meta box
*/
$thirdparty  =  new AT_Meta_Box($cfg_thirdparty );
   
/*
  * Add fields to your meta box
*/
//Text field
$thirdparty->addText(
  $prefix.'third_party_main_title', array( 'name' => esc_html__('Third party content main title', 'realgh'),
  'group' => 'start'
  ) 
);

//Textarea field
$thirdparty->addTextarea(
  $prefix.'third_party_description_text', array( 'name' => esc_html__('Third party content description text', 'realgh'),
  'group' => 'end' )
 
);



// //Finish Meta Box Declaration 
 $thirdparty->Finish();



/* 
*visitplatform
*/
$cfg_visitplatform = array(
  'id'              => 'realgh_visitplatform',          // meta box id, unique per meta box
  'title'           => esc_html__('Visit platform section', 'realgh'),   // meta box title
  'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
  'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
  'page_name'       => 'template-term-of-use.php',  // if single = true. Name of page for which to output metaboxes
  'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
  'priority'        => 'high',            // order of meta box: high (default), low; optional
  'fields'          => array(),            // list of meta fields (can be added by field arrays)
  'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
  'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);
   
   
/*
  * Initiate your meta box
*/
$visitplatform  =  new AT_Meta_Box($cfg_visitplatform );
   
/*
  * Add fields to your meta box
*/
//Text field
$visitplatform->addText(
  $prefix.'visitplatform_main_title', array( 'name' => esc_html__('Visit platform main title', 'realgh')
  ) 
);

//Textarea field
$visitplatform->addTextarea(
  $prefix.'visitplatform_description_text_1', array( 'name' => esc_html__('Visit platform description text', 'realgh'),
  'group' => 'start' )
 
);
//Textarea field
$visitplatform->addTextarea(
  $prefix.'visitplatform_description_text_2', array( 'name' => esc_html__('Visit platform  description text', 'realgh'),
  'group' => 'end' )
 
);

$upload_links = array();

// upload link text
$upload_links[] = $visitplatform->addText($prefix.'visitplatform_list_item', array( 'name' => esc_html__('Visitplatform list item', 'realgh') ), true);

//repeater block
$visitplatform->addRepeaterBlock($prefix.'visitplatform_list_repeter',array(
  'inline'   => false, 
  'name'     => 'Acceptable list item',
  'fields'   => $upload_links, 
  'sortable' => false,
));

//Textarea field
$visitplatform->addTextarea(
  $prefix.'visitplatform_description_text_3', array( 'name' => esc_html__('Visit platform  description text', 'realgh'),
  'group' => 'end' )
);


//Finish Meta Box Declaration 
$visitplatform->Finish();


/* 
*socialmedia
*/
$cfg_socialmedia = array(
  'id'              => 'realgh_socialmedia',          // meta box id, unique per meta box
  'title'           => esc_html__('Social media section', 'realgh'),   // meta box title
  'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
  'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
  'page_name'       => 'template-term-of-use.php',  // if single = true. Name of page for which to output metaboxes
  'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
  'priority'        => 'high',            // order of meta box: high (default), low; optional
  'fields'          => array(),            // list of meta fields (can be added by field arrays)
  'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
  'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);
   
   
/*
  * Initiate your meta box
*/
$socialmedia  =  new AT_Meta_Box($cfg_socialmedia );
   
/*
  * Add fields to your meta box
*/
//Text field
$socialmedia->addText(
  $prefix.'socialmedia_main_title', array( 'name' => esc_html__('Social media main title', 'realgh'),
  'group' => 'start'
  ) 
);

//Textarea field
$socialmedia->addTextarea(
  $prefix.'socialmedia_description_text', array( 'name' => esc_html__('Social media description text', 'realgh'),
  'group' => 'end' )
 
);

//Finish Meta Box Declaration 
$visitplatform->Finish();


/* 
*disclaimer
*/
$cfg_disclaimer = array(
  'id'              => 'realgh_disclaimer',          // meta box id, unique per meta box
  'title'           => esc_html__('Disclaimer section', 'realgh'),   // meta box title
  'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
  'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
  'page_name'       => 'template-term-of-use.php',  // if single = true. Name of page for which to output metaboxes
  'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
  'priority'        => 'high',            // order of meta box: high (default), low; optional
  'fields'          => array(),            // list of meta fields (can be added by field arrays)
  'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
  'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);
   
   
/*
  * Initiate your meta box
*/
$disclaimer  =  new AT_Meta_Box($cfg_disclaimer );
   
/*
  * Add fields to your meta box
*/
//Text field
$disclaimer->addText(
  $prefix.'disclaimer_main_title', array( 'name' => esc_html__('Disclaimer main title', 'realgh')
  ) 
);

//Textarea field
$disclaimer->addTextarea(
  $prefix.'disclaimer_description_text_1', array( 'name' => esc_html__('Disclaimer description text', 'realgh'),
  'group' => 'start' )
 
);
//Textarea field
$disclaimer->addTextarea(
  $prefix.'disclaimer_description_text_2', array( 'name' => esc_html__('Disclaimer description text', 'realgh'),
  'group' => 'end' )
 
);
//Textarea field
$disclaimer->addTextarea(
  $prefix.'disclaimer_description_text_3', array( 'name' => esc_html__('Disclaimer description text', 'realgh'),
  'group' => 'start' )
 
);
//Textarea field
$disclaimer->addTextarea(
  $prefix.'disclaimer_description_text_4', array( 'name' => esc_html__('Disclaimer description text', 'realgh'),
  'group' => 'end' )
 
);
//Textarea field
$disclaimer->addTextarea(
  $prefix.'disclaimer_description_text_5', array( 'name' => esc_html__('Disclaimer description text', 'realgh'),
  'group' => 'start' )
 
);
//Textarea field
$disclaimer->addTextarea(
  $prefix.'disclaimer_description_text_6', array( 'name' => esc_html__('Disclaimer description text', 'realgh'),
  'group' => 'end' )
 
);

//Finish Meta Box Declaration 
$disclaimer->Finish();


/* 
*Copyright
*/
$cfg_copyright = array(
  'id'              => 'realgh_copyright',          // meta box id, unique per meta box
  'title'           => esc_html__('Copyright section', 'realgh'),   // meta box title
  'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
  'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
  'page_name'       => 'template-term-of-use.php',  // if single = true. Name of page for which to output metaboxes
  'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
  'priority'        => 'high',            // order of meta box: high (default), low; optional
  'fields'          => array(),            // list of meta fields (can be added by field arrays)
  'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
  'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);
   
   
/*
  * Initiate your meta box
*/
$copyright  =  new AT_Meta_Box($cfg_copyright );
   
/*
  * Add fields to your meta box
*/
//Text field
$copyright->addText(
  $prefix.'copyright_main_title', array( 'name' => esc_html__('Copyright main title', 'realgh'),
  'group' => 'start' 
  ) 
);

//Textarea field
$copyright->addTextarea(
  $prefix.'copyright_description_text_1', array( 'name' => esc_html__('Copyright description text', 'realgh'),
  'group' => 'end' )
 
);
//Textarea field
$copyright->addTextarea(
  $prefix.'copyright_description_text_2', array( 'name' => esc_html__('Copyright description text', 'realgh'),
  'group' => 'start' )
 
);
//Textarea field
$copyright->addTextarea(
  $prefix.'copyright_description_text_3', array( 'name' => esc_html__('Copyright description text', 'realgh'),
  'group' => 'end' )
 
);

$upload_links = array();

// upload link text
$upload_links[] = $copyright->addText($prefix.'copyright_list_item', array( 'name' => esc_html__('Copyright list item', 'realgh'),'group' => 'end'  ), true);

//repeater block
$copyright->addRepeaterBlock($prefix.'copyright_list_repeter',array(
  'inline'   => false, 
  'name'     => 'Copyright list item',
  'fields'   => $upload_links, 
  'sortable' => false,
));



//Finish Meta Box Declaration 
$copyright->Finish();



/* 
*trademark
*/
$cfg_trademark = array(
  'id'              => 'realgh_trademark',          // meta box id, unique per meta box
  'title'           => esc_html__('Trademark section', 'realgh'),   // meta box title
  'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
  'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
  'page_name'       => 'template-term-of-use.php',  // if single = true. Name of page for which to output metaboxes
  'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
  'priority'        => 'high',            // order of meta box: high (default), low; optional
  'fields'          => array(),            // list of meta fields (can be added by field arrays)
  'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
  'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);
   
   
/*
  * Initiate your meta box
*/
$trademark  =  new AT_Meta_Box($cfg_trademark );
   
/*
  * Add fields to your meta box
*/
//Text field
$trademark->addText(
  $prefix.'trademark_main_title', array( 'name' => esc_html__('Trademark main title', 'realgh'),
  'group' => 'start' 
  ) 
);

//Textarea field
$trademark->addTextarea(
  $prefix.'trademark_description_text_1', array( 'name' => esc_html__('Trademark description text', 'realgh'),
  'group' => 'end' )
);
//Textarea field
$trademark->addTextarea(
  $prefix.'trademark_description_text_2', array( 'name' => esc_html__('Trademark description text', 'realgh'),
  'group' => 'start' )
);
//Textarea field
$trademark->addTextarea(
  $prefix.'trademark_description_text_3', array( 'name' => esc_html__('Trademark description text', 'realgh'),
  'group' => 'end' )
);

$upload_links = array();

// upload link text
$upload_links[] = $trademark->addText($prefix.'trademark_list_item', array( 'name' => esc_html__('Trademark list item', 'realgh') ), true);

//repeater block
$trademark->addRepeaterBlock($prefix.'trademark_list_repeter',array(
  'inline'   => false, 
  'name'     => 'Trademark list item',
  'fields'   => $upload_links, 
  'sortable' => false,
));



//Finish Meta Box Declaration 
$trademark->Finish();


/* 
*modification
*/
$cfg_modification = array(
  'id'              => 'realgh_modification',          // meta box id, unique per meta box
  'title'           => esc_html__('Modification section', 'realgh'),   // meta box title
  'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
  'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
  'page_name'       => 'template-term-of-use.php',  // if single = true. Name of page for which to output metaboxes
  'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
  'priority'        => 'high',            // order of meta box: high (default), low; optional
  'fields'          => array(),            // list of meta fields (can be added by field arrays)
  'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
  'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);
   
   
/*
  * Initiate your meta box
*/
$modification  =  new AT_Meta_Box($cfg_modification );
   
/*
  * Add fields to your meta box
*/
//Text field
$modification->addText(
  $prefix.'modification_main_title', array( 'name' => esc_html__('Modification main title', 'realgh'),
  'group' => 'start' 
  ) 
);

//Textarea field
$modification->addTextarea(
  $prefix.'modification_description_text_1', array( 'name' => esc_html__('Modification description text', 'realgh'),
  'group' => 'end' )
);

//Textarea field
$modification->addTextarea(
  $prefix.'modification_description_text_2', array( 'name' => esc_html__('Modification description text', 'realgh'),
  'group' => 'start' )
);

//Textarea field
$modification->addTextarea(
  $prefix.'modification_description_text_3', array( 'name' => esc_html__('Modification description text', 'realgh'),
  'group' => 'end' )
);


//Finish Meta Box Declaration 
$modification->Finish();


/* 
*notice
*/
$cfg_notice = array(
  'id'              => 'realgh_notice',          // meta box id, unique per meta box
  'title'           => esc_html__('Notice section', 'realgh'),   // meta box title
  'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
  'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
  'page_name'       => 'template-term-of-use.php',  // if single = true. Name of page for which to output metaboxes
  'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
  'priority'        => 'high',            // order of meta box: high (default), low; optional
  'fields'          => array(),            // list of meta fields (can be added by field arrays)
  'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
  'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);
   
   
/*
  * Initiate your meta box
*/
$notice  =  new AT_Meta_Box($cfg_notice );
   
/*
  * Add fields to your meta box
*/
//Text field
$notice->addText(
  $prefix.'notice_main_title', array( 'name' => esc_html__('Notice main title', 'realgh'),
  'group' => 'start' 
  ) 
);

//Textarea field
$notice->addTextarea(
  $prefix.'notice_description_text', array( 'name' => esc_html__('Notice description text', 'realgh'),
  'group' => 'end' )
);



//Finish Meta Box Declaration 
$notice->Finish();



/* 
*notice
*/
$cfg_impnotes = array(
  'id'              => 'realgh_impnotes',          // meta box id, unique per meta box
  'title'           => esc_html__('Imp notes section', 'realgh'),   // meta box title
  'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
  'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
  'page_name'       => 'template-term-of-use.php',  // if single = true. Name of page for which to output metaboxes
  'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
  'priority'        => 'high',            // order of meta box: high (default), low; optional
  'fields'          => array(),            // list of meta fields (can be added by field arrays)
  'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
  'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);
   
   
/*
  * Initiate your meta box
*/
$impnotes  =  new AT_Meta_Box($cfg_impnotes );
   
/*
  * Add fields to your meta box
*/
//Text field
$impnotes->addText(
  $prefix.'imp_notes_main_title', array( 'name' => esc_html__('Imp notes main title', 'realgh'),
  'group' => 'start' 
  ) 
);

//Textarea field
$impnotes->addTextarea(
  $prefix.'imp_notes_description_text_1', array( 'name' => esc_html__('Imp notes description text', 'realgh'),
  'group' => 'end' )
);
//Textarea field
$impnotes->addTextarea(
  $prefix.'imp_notes_description_text_2', array( 'name' => esc_html__('Imp notes description text', 'realgh'),
  'group' => 'start' )
);

//Textarea field
$impnotes->addTextarea(
  $prefix.'imp_notes_description_text_3', array( 'name' => esc_html__('Imp notes description text', 'realgh'),
  'group' => 'end' )
);

//Textarea field
$impnotes->addTextarea(
  $prefix.'imp_notes_description_text_4', array( 'name' => esc_html__('Imp notes description text', 'realgh'),
  'group' => 'start' )
);

//Textarea field
$impnotes->addTextarea(
  $prefix.'imp_notes_description_text_5', array( 'name' => esc_html__('Imp notes description text', 'realgh'),
  'group' => 'end' )
);

//Textarea field
$impnotes->addTextarea(
  $prefix.'imp_notes_description_text_6', array( 'name' => esc_html__('Imp notes description text', 'realgh'),
  'group' => 'start' )
);

//Textarea field
$impnotes->addTextarea(
  $prefix.'imp_notes_description_text_7', array( 'name' => esc_html__('Imp notes description text', 'realgh'),
  'group' => 'end' )
);
//Textarea field
$impnotes->addTextarea(
  $prefix.'imp_notes_description_text_8', array( 'name' => esc_html__('Imp notes description text', 'realgh'),
  'group' => 'start' )
);

//Textarea field
$impnotes->addTextarea(
  $prefix.'imp_notes_description_text_9', array( 'name' => esc_html__('Imp notes description text', 'realgh'),
  'group' => 'end' )
);


//Finish Meta Box Declaration 
$impnotes->Finish();




}
 
 