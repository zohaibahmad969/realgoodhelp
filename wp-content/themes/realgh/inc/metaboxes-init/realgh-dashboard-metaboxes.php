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
	* Find psychologist
  */
  $cfg_psychodashboardcontent = array(
	 'id'              => 'realgh_psychodashboardcontent',          // meta box id, unique per meta box
	 'title'           => esc_html__('Psycho dashboard content', 'realgh'),   // meta box title
	 'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	 'page_name'       => 'template-dashboard.php',  // if single = true. Name of page for which to output metaboxes
	 'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	 'priority'        => 'high',            // order of meta box: high (default), low; optional
	 'fields'          => array(),            // list of meta fields (can be added by field arrays)
	 'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	 'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  

  /*
	* Initiate your meta box
  */
  $psychodashboardcontent =  new AT_Meta_Box($cfg_psychodashboardcontent);
   
  //Text field
  $psychodashboardcontent->addText(
   $prefix.'consultation_main_title', array( 'name' => esc_html__('Consultation main title', 'realgh') )
  );

  //Text field
  $psychodashboardcontent->addText(
    $prefix.'consultation_text_title_1', array( 'name' => esc_html__('Consultation text title', 'realgh'),
     'group' => 'start' )
  );
 
  //Text field
  $psychodashboardcontent->addText(
    $prefix.'consultation_text_desc_1', array( 'name' => esc_html__('Consultation text desc', 'realgh'),
     'group' => 'end' )
  );

  //Text field
   $psychodashboardcontent->addText(
    $prefix.'consultation_text_title_2', array( 'name' => esc_html__('Consultation text title', 'realgh'),
     'group' => 'start' )
  );
 
  //Text field
  $psychodashboardcontent->addText(
    $prefix.'consultation_text_desc_2', array( 'name' => esc_html__('Consultation text desc', 'realgh'),
     'group' => 'end' )
  );


   //banner_link_value
   $psychodashboardcontent->addPosts(
    $prefix.'psycho_banner_link_value',
    array('post_type' => 'page'),
    array(
      'name' => esc_html__('Banner link value', 'realgh'),
      'desc' => esc_html__('The page to which the connect link leads', 'realgh'),
      'group' => 'start'
    )
  );

  //img field
  $psychodashboardcontent->addImage(
    $prefix.'psycho_banner_image',
    array(
      'name' => esc_html__('Psycho banner image', 'realgh'),
      'group' => 'end'
    )
  );
  //img field
  $psychodashboardcontent->addImage(
    $prefix.'psycho_banner_image_ipad',
    array(
      'name' => esc_html__('Psycho banner image ipad', 'realgh'),
      'group' => 'start'
    )
  );
  //img field
  $psychodashboardcontent->addImage(
    $prefix.'psycho_banner_image_mobile',
    array(
      'name' => esc_html__('Psycho banner image mobile', 'realgh'),
      'group' => 'end'
    )
  );

  //Text field
  $psychodashboardcontent->addText(
    $prefix.'invite_friend_title', array( 'name' => esc_html__('Invite friend title', 'realgh'),
    'group' => 'start' )
  );
  
  //Text field
  $psychodashboardcontent->addText(
    $prefix.'psycho_banner_text', array( 'name' => esc_html__('Psycho banner text', 'realgh'),
    'group' => 'end' )
  );
 
  //Text field
  $psychodashboardcontent->addText(
    $prefix.'psycho_banner_link_text',
    array(
      'name' => esc_html__('Psycho banner Link text', 'realgh'),
      'group' => 'start')
  );
  
 
  //Text field
  $psychodashboardcontent->addText(
    $prefix.'balance_meta_title', array( 'name' => esc_html__('Balance meta title', 'realgh'),
     'group' => 'end' )
  );

  //Text field
  $psychodashboardcontent->addText(
    $prefix.'schedule_meta_title', array( 'name' => esc_html__('Schedule meta title', 'realgh'),
      'group' => 'start' )
  );
  //Text field
  $psychodashboardcontent->addText(
    $prefix.'reviews_meta_title', array( 'name' => esc_html__('Reviews meta title', 'realgh'),
      'group' => 'end' )
  );

  /*
	* Don't Forget to Close up the meta box Declaration 
  */
  //Finish Meta Box Declaration 
  $psychodashboardcontent->Finish();



  /* 
	* Find psychologist
  */
  $cfg_clientdashboardcontent = array(
    'id'              => 'realgh_clientdashboardcontent',          // meta box id, unique per meta box
    'title'           => esc_html__('Client dashboard content', 'realgh'),   // meta box title
    'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
    'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
    'page_name'       => 'template-dashboard.php',  // if single = true. Name of page for which to output metaboxes
    'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'        => 'high',            // order of meta box: high (default), low; optional
    'fields'          => array(),            // list of meta fields (can be added by field arrays)
    'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
   );
   
 
   /*
   * Initiate your meta box
   */
   $clientdashboardcontent =  new AT_Meta_Box($cfg_clientdashboardcontent);
    
   //Text field
   $clientdashboardcontent->addText(
    $prefix.'consultation_main_title', array( 'name' => esc_html__('Consultation main title', 'realgh') )
   );
 
   //Text field
   $clientdashboardcontent->addText(
     $prefix.'consultation_text_title_1', array( 'name' => esc_html__('Consultation text title', 'realgh'),
      'group' => 'start' )
   );
  
   //Text field
   $clientdashboardcontent->addText(
     $prefix.'consultation_text_desc_1', array( 'name' => esc_html__('Consultation text desc', 'realgh'),
      'group' => 'end' )
   );
 
   //Text field
    $clientdashboardcontent->addText(
     $prefix.'consultation_text_title_2', array( 'name' => esc_html__('Consultation text title', 'realgh'),
      'group' => 'start' )
   );
  
   //Text field
   $clientdashboardcontent->addText(
     $prefix.'consultation_text_desc_2', array( 'name' => esc_html__('Consultation text desc', 'realgh'),
      'group' => 'end' )
   );
 
 
    //banner_link_value
    $clientdashboardcontent->addPosts(
     $prefix.'client_banner_link_value',
     array('post_type' => 'page'),
     array(
       'name' => esc_html__('Banner link value', 'realgh'),
       'desc' => esc_html__('The page to which the connect link leads', 'realgh'),
       'group' => 'start'
     )
   );
 
   //img desk
   $clientdashboardcontent->addImage(
     $prefix.'client_banner_image',
     array(
       'name' => esc_html__('Client banner image', 'realgh'),
       'group' => 'end'
     )
   );
    //img mobile
    $clientdashboardcontent->addImage(
      $prefix.'client_banner_image_ipad',
      array(
        'name' => esc_html__('Client banner image ipad', 'realgh'),
        'group' => 'start'
      )
    );
    $clientdashboardcontent->addImage(
      $prefix.'client_banner_image_mobile',
      array(
        'name' => esc_html__('Client banner image mobile', 'realgh'),
        'group' => 'end'
      )
    );
 
 
   //Text field
   $clientdashboardcontent->addText(
     $prefix.'discount_title', array( 'name' => esc_html__('Discount title', 'realgh'),
     'group' => 'start' )
   );
   
   //Text field
   $clientdashboardcontent->addText(
     $prefix.'client_banner_link_text', array( 'name' => esc_html__('Client banner text', 'realgh'),
     'group' => 'end' )
   );
  
   //Text field
   $clientdashboardcontent->addText(
     $prefix.'balance_meta_title', array( 'name' => esc_html__('Balance meta title', 'realgh'),
      'group' => 'start' )
   );
 
   //Text field
   $clientdashboardcontent->addText(
     $prefix.'refer_friends_meta_title', array( 'name' => esc_html__('Refer a friends meta title', 'realgh'),
       'group' => 'end' )
   );
    //Text field
    $clientdashboardcontent->addText(
      $prefix.'refer-friend_meta_desc', array( 'name' => esc_html__('Refer a friends meta desc', 'realgh'),
        'group' => 'start' )
    );
   //Text field
   $clientdashboardcontent->addText(
     $prefix.'psychologists_meta_title', array( 'name' => esc_html__('Psychologists available  meta title', 'realgh'),
       'group' => 'end' )
   );
    //Text desc
    $clientdashboardcontent->addText(
      $prefix.'psychologists_meta_desc', array( 'name' => esc_html__('Psychologist available meta desc', 'realgh'),
        'group' => 'end' )
    );
 
   /*
   * Don't Forget to Close up the meta box Declaration 
   */
   //Finish Meta Box Declaration 
   $clientdashboardcontent->Finish();
 


}