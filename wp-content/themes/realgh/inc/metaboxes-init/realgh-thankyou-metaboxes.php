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
  $cfg_thankyoucontent = array(
	 'id'              => 'realgh_thankyoucontent',          // meta box id, unique per meta box
	 'title'           => esc_html__('Thankyou page content', 'realgh'),   // meta box title
	 'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	 'page_name'       => 'template-thankyou.php',  // if single = true. Name of page for which to output metaboxes
	 'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	 'priority'        => 'high',            // order of meta box: high (default), low; optional
	 'fields'          => array(),            // list of meta fields (can be added by field arrays)
	 'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	 'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
	* Initiate your meta box
  */
  $thankyoucontent =  new AT_Meta_Box($cfg_thankyoucontent);
  
  //img field
  $thankyoucontent->addImage(
    $prefix.'thankyou_icon_image',
    array(
      'name' => esc_html__('Check icon image', 'realgh')
    )
   );
  //Text field
  $thankyoucontent->addText(
   $prefix.'thankyou_main_title', array( 'name' => esc_html__('Thankyou main title', 'realgh'),
    'group' => 'start' )
  );
  //Textarea field
  $thankyoucontent->addTextarea(
   $prefix.'thankyou_main_text', array( 'name' => esc_html__('Description', 'realgh'),
   'group' => 'end' )
  );

  //Page field
  $thankyoucontent->addPosts(
    $prefix.'thankyoucontent_link_value',
    array('post_type' => 'page'),
    array(
      'name' => esc_html__('Link value', 'realgh'),
      'desc' => esc_html__('The page to which the connect link leads', 'realgh'),
      'group' => 'start'
    )
  );
  //Text field
  $thankyoucontent->addText(
    $prefix.'thankyoucontent_link_text',
    array(
      'name' => esc_html__('Link text', 'realgh'),
      'group' => 'end')
  );
  
  //Text field
  $thankyoucontent->addText(
    $prefix.'thankyou_social_text',
    array(
      'name' => esc_html__('Thankyou social text', 'realgh'),
      'group' => 'start')
  );
    

  /*
	* Don't Forget to Close up the meta box Declaration 
  */
  //Finish Meta Box Declaration 
  $thankyoucontent->Finish();
}