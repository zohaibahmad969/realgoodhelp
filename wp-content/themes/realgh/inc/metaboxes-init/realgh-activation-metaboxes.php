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
  $cfg_activationcontent = array(
	 'id'              => 'realgh_activationcontent',          // meta box id, unique per meta box
	 'title'           => esc_html__('Activation page content', 'realgh'),   // meta box title
	 'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	 'page_name'       => 'template-activation.php',  // if single = true. Name of page for which to output metaboxes
	 'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	 'priority'        => 'high',            // order of meta box: high (default), low; optional
	 'fields'          => array(),            // list of meta fields (can be added by field arrays)
	 'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	 'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
	* Initiate your meta box
  */
  $activationcontent =  new AT_Meta_Box($cfg_activationcontent);
  
  //img field
  $activationcontent->addImage(
    $prefix.'activation_icon_image',
    array(
      'name' => esc_html__('Check icon image', 'realgh')
    )
   );
  //Text field
  $activationcontent->addText(
   $prefix.'activation_main_title', array( 'name' => esc_html__('Activation main title', 'realgh'),
    'group' => 'start' )
  );
  //Textarea field
  $activationcontent->addTextarea(
   $prefix.'activation_main_text', array( 'name' => esc_html__('Description', 'realgh'),
   'group' => 'end' )
  );

  //Page field
  $activationcontent->addPosts(
    $prefix.'activationcontent_link_value',
    array('post_type' => 'page'),
    array(
      'name' => esc_html__('Link value', 'realgh'),
      'desc' => esc_html__('The page to which the connect link leads', 'realgh'),
      'group' => 'start'
    )
  );
  //Text field
  $activationcontent->addText(
    $prefix.'activationcontent_link_text',
    array(
      'name' => esc_html__('Link text', 'realgh'),
      'group' => 'end')
  );
  
  //Text field
  $activationcontent->addText(
    $prefix.'activation_social_text',
    array(
      'name' => esc_html__('activation social text', 'realgh'),
      'group' => 'start')
  );
    

  /*
	* Don't Forget to Close up the meta box Declaration 
  */
  //Finish Meta Box Declaration 
  $activationcontent->Finish();
}