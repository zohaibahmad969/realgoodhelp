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
  $cfg_find = array(
	 'id'              => 'realgh_find',          // meta box id, unique per meta box
	 'title'           => esc_html__('Psychologists page content', 'realgh'),   // meta box title
	 'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	 'page_name'       => 'template-psychologists.php',  // if single = true. Name of page for which to output metaboxes
	 'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	 'priority'        => 'high',            // order of meta box: high (default), low; optional
	 'fields'          => array(),            // list of meta fields (can be added by field arrays)
	 'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	 'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
	* Initiate your meta box
  */
  $find =  new AT_Meta_Box($cfg_find);
  
  /*
	* Add fields to your meta box
  */
  //Text field
  $find->addText(
    $prefix.'count_text',
    array(
      'name' => esc_html__('Psychologist count text', 'realgh'),
      'desc' => esc_html__('Enter the text displayed next to the number of psychologists on the service', 'realgh')
    )
  );
  //Text field
  $find->addText(
   $prefix.'title', array( 'name' => esc_html__('Title', 'realgh') )
  );
  //Textarea field
  $find->addTextarea(
   $prefix.'text', array( 'name' => esc_html__('Under headline text', 'realgh') )
  );
  //Text field
  $find->addText(
   $prefix.'book_btn_text', array( 'name' => esc_html__('Book button text', 'realgh') )
  );
  //Text field
  $find->addText(
   $prefix.'psycho_type', array( 'name' => esc_html__('Psychologist\'s type title', 'realgh') )
  );
  //Text field
  $find->addText(
   $prefix.'psycho_exp', array( 'name' => esc_html__('Psychologist\'s experience title', 'realgh') )
  );
  //Text field
  $find->addText(
   $prefix.'psycho_half', array( 'name' => esc_html__('Psychologist\'s 30 min title', 'realgh') )
  );
  //Text field
  $find->addText(
   $prefix.'psycho_hour', array( 'name' => esc_html__('Psychologist\'s hour title', 'realgh') )
  );
  //Text field
  $find->addText(
   $prefix.'first_tab', array( 'name' => esc_html__('Psychologist\'s first tab title', 'realgh') )
  );
  //Text field
  $find->addText(
   $prefix.'second_tab', array( 'name' => esc_html__('Psychologist\'s second tab title', 'realgh') )
  );
  //Text field
  $find->addText(
   $prefix.'third_tab', array( 'name' => esc_html__('Psychologist\'s third tab title', 'realgh') )
  );

  /*
  * To Create a reapeater Block first create an array of fields
  * use the same functions as above but add true as a last param
  */
  $repeater_psycho = array();
  
  //Number field
  $repeater_psycho[] = $find->addNumber(
    $prefix.'psycho_id',
    array( 'name' => esc_html__('Psychologist\'s id', 'realgh') ),
    true
  );
  //Text field
  $repeater_psycho[] = $find->addText($prefix.'psycho_name', array( 'name' => esc_html__('Psychologist\'s name', 'realgh') ), true);
  //Text field
  $repeater_psycho[] = $find->addImage($prefix.'psycho_image', array( 'name' => esc_html__('Psychologist\'s photo', 'realgh') ), true);
  //Textarea field
  $repeater_psycho[] = $find->addTextarea($prefix.'psycho_type_text', array( 'name' => esc_html__('Psychologist\'s type text', 'realgh') ), true);
  //Textarea field
  $repeater_psycho[] = $find->addText($prefix.'psycho_exp_text', array( 'name' => esc_html__('Psychologist\'s experience text', 'realgh') ), true);
  //Textarea field
  $repeater_psycho[] = $find->addText($prefix.'psycho_half_rate', array( 'name' => esc_html__('Psychologist\'s 30 min rate', 'realgh') ), true);
  //Textarea field
  $repeater_psycho[] = $find->addText($prefix.'psycho_hour_rate', array( 'name' => esc_html__('Psychologist\'s hour rate', 'realgh') ), true);
  //Textarea field
  $repeater_psycho[] = $find->addTextarea($prefix.'psycho_desc', array( 'name' => esc_html__('Psychologist\'s description', 'realgh') ), true);

  /*
  * Then just add the fields to the repeater block
  */
  //repeater block
  $find->addRepeaterBlock($prefix.'re_psycho',array(
   'inline'   => false, 
   'name'     => 'Reviews list',
   'fields'   => $repeater_psycho, 
   'sortable' => false
  ));
  
  /*
	* Don't Forget to Close up the meta box Declaration 
  */
  //Finish Meta Box Declaration 
  $find->Finish();
}