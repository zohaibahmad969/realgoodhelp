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
  $cfg_editschedule = array(
	 'id'              => 'realgh_editschedule',          // meta box id, unique per meta box
	 'title'           => esc_html__('Edit schedule page content', 'realgh'),   // meta box title
	 'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	 'page_name'       => 'template-edit-schedule.php',  // if single = true. Name of page for which to output metaboxes
	 'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	 'priority'        => 'high',            // order of meta box: high (default), low; optional
	 'fields'          => array(),            // list of meta fields (can be added by field arrays)
	 'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	 'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
	* Initiate your meta box
  */
  $editschedule =  new AT_Meta_Box($cfg_editschedule);

  //Title
  $editschedule->addText(
    $prefix.'edit_schedule_title', array( 'name' => esc_html__('Edit schedule main title ', 'realgh'),
    'group' => 'start' )
  );
  // Textarea
  $editschedule->addTextarea(
    $prefix.'edit_schedule_text-desc', array( 'name' => esc_html__('Edit schedule text desc ', 'realgh'),
    'group' => 'end' )
  );
  // Text
  $editschedule->addText(
    $prefix.'edit_schedule_price_title', array( 'name' => esc_html__('Edit schedule price title ', 'realgh'),
    'group' => 'start' )
  );
  // Text
  $editschedule->addText(
    $prefix.'edit_schedule_price_desc', array( 'name' => esc_html__('Edit schedule price desc ', 'realgh'),
    'group' => 'end' )
  );
  // form label
  $editschedule->addText(
    $prefix.'form_consultation_label', array( 'name' => esc_html__(' Form consultation label ', 'realgh'),
    'group' => 'start' )
  );
  // form placeholder
  $editschedule->addText(
    $prefix.'form_consultation_placeholder', array( 'name' => esc_html__(' Form consultation placeholder ', 'realgh'),
    'group' => 'end' )
  );
  // form label
  $editschedule->addText(
    $prefix.'form_consultation_label1', array( 'name' => esc_html__(' Form consultation label ', 'realgh'),
    'group' => 'start' )
  );
  // form placeholder
  $editschedule->addText(
    $prefix.'form_consultation_placeholder1', array( 'name' => esc_html__(' Form consultation placeholder ', 'realgh'),
    'group' => 'end' )
  );
  // form label
  $editschedule->addText(
    $prefix.'form_voice_call_label', array( 'name' => esc_html__(' Form voice call label ', 'realgh'),
    'group' => 'start' )
  );
  // form placeholder
   $editschedule->addText(
    $prefix.'form_voice_call_placeholder', array( 'name' => esc_html__(' Form voice call placeholder ', 'realgh'),
    'group' => 'end' )
  );
  // form label
  $editschedule->addText(
    $prefix.'form_chat_label', array( 'name' => esc_html__(' Form voice call label ', 'realgh'),
    'group' => 'start' )
  );
  // form label
  $editschedule->addText(
    $prefix.'form_chat_placeholder', array( 'name' => esc_html__(' Form voice call placeholder ', 'realgh'),
    'group' => 'end' )
  );
   // Title
   $editschedule->addText(
    $prefix.'range_title_1', array( 'name' => esc_html__(' Range title  ', 'realgh'),
    'group' => 'start' )
  );
  // Title
  $editschedule->addText(
    $prefix.'range_title_2', array( 'name' => esc_html__(' Range title  ', 'realgh'),
    'group' => 'end' )
  );
  // Title
  $editschedule->addText(
    $prefix.'weekly_hours_title', array( 'name' => esc_html__('Weekly hours title', 'realgh') )
  );


  /*
	* Don't Forget to Close up the meta box Declaration 
  */
  //Finish Meta Box Declaration 
$editschedule->Finish();



}
