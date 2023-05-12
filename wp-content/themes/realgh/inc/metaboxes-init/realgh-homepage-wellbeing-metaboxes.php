<?php
/*
* Initialising metaboxes for post and pages
*/
if (is_admin()){
  /* 
	* prefix of meta keys, optional
	* use underscore (_) at the beginning to make keys hidden, for example $prefix_za = '_ba_';
	*  you also can make prefix empty to disable it
	* 
	*/
  $prefix_za = 'wellbeing_';
  /* 
	* configure your meta box
	*/

  /* 
	* Homepage
  */
  // MainScreen----------------------------------------------------------
  $cfg_mainscreen = array(
	 'id'              => $prefix_za.'mainscreen',          // meta box id, unique per meta box
	 'title'           => esc_html__('Mainscreen content', 'realgh'),   // meta box title
	 'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	 'page_name'       => 'template-homepage-wellbeing.php',  // if single = true. Name of page for which to output metaboxes
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
	 $prefix_za.'current_title', array( 'name' => esc_html__('Current goals title', 'realgh') )
  );
  //Text field
  $mainscreen->addText(
	 $prefix_za.'suggest_title', array( 'name' => esc_html__('Suggestions title', 'realgh') )
  );
  //Image field
  $mainscreen->addImage(
	 $prefix_za.'more_image', array('name' => esc_html__('Dropdown image', 'realgh'))
  );
  //Text field
  $mainscreen->addText(
	 $prefix_za.'more_title', array( 'name' => esc_html__('Dropdown title', 'realgh') )
  );
  //Text field
  $mainscreen->addText(
	 $prefix_za.'more_link_text', array('name' => esc_html__('Dropdown link text', 'realgh'))
  );

  /*
	* Don't Forget to Close up the meta box Declaration 
  */
  //Finish Meta Box Declaration 
  $mainscreen->Finish();



  // Themes pop-up----------------------------------------------------------
  $cfg_themes = array(
	 'id'              => $prefix_za.'themes_popup',          // meta box id, unique per meta box
	 'title'           => esc_html__('Themes pop-up content', 'realgh'),   // meta box title
	 'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	 'page_name'       => 'template-homepage-wellbeing.php',  // if single = true. Name of page for which to output metaboxes
	 'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	 'priority'        => 'high',            // order of meta box: high (default), low; optional
	 'fields'          => array(),            // list of meta fields (can be added by field arrays)
	 'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	 'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  $themes =  new AT_Meta_Box($cfg_themes);

  //Text field
  $themes->addText(
	 $prefix_za.'themes_title', array( 'name' => esc_html__('Themes pop-up title', 'realgh') )
  );

  //Finish Meta Box Declaration 
  $themes->Finish();
}