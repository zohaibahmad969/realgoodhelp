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
	* Find single psycho header  step
  */
  $cfg_singlepsychoheader = array(
	 'id'              => 'realgh_singlepsychoheader',          // meta box id, unique per meta box
	 'title'           => esc_html__('Single psychologist page content', 'realgh'),   // meta box title
	 'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	 'page_name'       => 'template-single-psychologist.php',  // if single = true. Name of page for which to output metaboxes
	 'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	 'priority'        => 'high',            // order of meta box: high (default), low; optional
	 'fields'          => array(),            // list of meta fields (can be added by field arrays)
	 'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	 'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
	* Initiate your meta box
  */
  $singlepsychoheader =  new AT_Meta_Box($cfg_singlepsychoheader);

  //Title
  $singlepsychoheader->addText(
    $prefix.'status_title', array( 'name' => esc_html__('Status title ', 'realgh'),
    'group' => 'start' )
  );

  // visit time 
  $singlepsychoheader->addText(
    $prefix.'status_visit_time', array( 'name' => esc_html__('Status visit time ', 'realgh'),
    'group' => 'end' )
  );
  
   //Title
   $singlepsychoheader->addText(
    $prefix.'single_psycho_desc_title', array( 'name' => esc_html__('Single psycho desc title ', 'realgh'),
    'group' => 'start' )
  );
  
  $upload_links = array();

  // upload link text
  $upload_links[] = $singlepsychoheader->addText($prefix.'single_psycho_list_item', array( 'name' => esc_html__('Single psycho list item', 'realgh'),'group' => 'end'  ), true);
  
  //repeater block
  $singlepsychoheader->addRepeaterBlock($prefix.'single_psycho_list_repeater',array(
    'inline'   => false, 
    'name'     => 'Single psycho list item',
    'fields'   => $upload_links, 
    'sortable' => false,
    'group' => 'end',
  ));

   //desc Title
   $singlepsychoheader->addText(
    $prefix.'single_psycho_desc_title_1', array( 'name' => esc_html__('Single psycho desc title ', 'realgh'),
    'group' => 'start' )
  );

  //badge Title
  $singlepsychoheader->addText(
    $prefix.'single_psycho_badge_title', array( 'name' => esc_html__('Single psycho badge title ', 'realgh'),
    'group' => 'end' )
  );

  //About me Title
  $singlepsychoheader->addText(
    $prefix.'single_psycho_about_me_title', array( 'name' => esc_html__('Single psycho about me title ', 'realgh') )
  );
 
  
 
  /*
	* Don't Forget to Close up the meta box Declaration 
  */
  //Finish Meta Box Declaration 
$singlepsychoheader->Finish();


/* 
* Find single psycho tab section
*/
$cfg_singlepsychotabsection = array(
  'id'              => 'realgh_singlepsychotabsection',          // meta box id, unique per meta box
  'title'           => esc_html__('Single psychologist page content', 'realgh'),   // meta box title
  'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
  'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
  'page_name'       => 'template-single-psychologist.php',  // if single = true. Name of page for which to output metaboxes
  'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
  'priority'        => 'high',            // order of meta box: high (default), low; optional
  'fields'          => array(),            // list of meta fields (can be added by field arrays)
  'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
  'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
   
  /*
  * Initiate your meta box
  */
  $singlepsychotabsection =  new AT_Meta_Box($cfg_singlepsychotabsection);
 

//Subtitle Title
$singlepsychotabsection->addText(
  $prefix.'single_psycho_subtitle_title', array( 'name' => esc_html__('Single psycho subtitle title ', 'realgh'),
  'group' => 'end' )
);

//Tab label
$singlepsychotabsection->addText(
  $prefix.'single_psycho_tab_label_1', array( 'name' => esc_html__('Single psycho tab label  ', 'realgh'),
  'group' => 'start' )
);
//Tab label
$singlepsychotabsection->addText(
  $prefix.'single_psycho_tab_label_2', array( 'name' => esc_html__('Single psycho tab label  ', 'realgh'),
  'group' => 'end' )
);
//Tab label
$singlepsychotabsection->addText(
  $prefix.'single_psycho_tab_label_3', array( 'name' => esc_html__('Single psycho tab label  ', 'realgh'),
  'group' => 'start' )
);
//Tab label
$singlepsychotabsection->addText(
  $prefix.'single_psycho_tab_label_4', array( 'name' => esc_html__('Single psycho tab label  ', 'realgh'),
  'group' => 'end' )
);

$upload_links = array();

//Tab desc list
$upload_links[] = $singlepsychotabsection->addText($prefix.'education_list_item', array( 'name' => esc_html__('Single psycho education tab desc', 'realgh'),'group' => 'end'  ), true);

//repeater block
$singlepsychotabsection->addRepeaterBlock($prefix.'education_tab_list_repeter',array(
  'inline'   => false, 
  'name'     => 'Single psycho education tab desc',
  'fields'   => $upload_links, 
  'sortable' => false,
  'group' => 'start',
));


$upload_links = array();

// Tab desc list
$upload_links[] = $singlepsychotabsection->addText($prefix.'methods_list_item', array( 'name' => esc_html__('Single psycho methods tab desc', 'realgh'),'group' => 'end'  ), true);

//repeater block
$singlepsychotabsection->addRepeaterBlock($prefix.'methods_tab_list_repeter',array(
  'inline'   => false, 
  'name'     => 'Single psycho methods tab desc',
  'fields'   => $upload_links, 
  'sortable' => false,
  'group' => 'end',
));

$upload_links = array();

// Tab desc list
$upload_links[] = $singlepsychotabsection->addText($prefix.'features_list_item', array( 'name' => esc_html__('Single psycho features tab desc', 'realgh'),'group' => 'end'  ), true);

//repeater block
$singlepsychotabsection->addRepeaterBlock($prefix.'features_tab_list_repeter',array(
  'inline'   => false, 
  'name'     => 'Single psycho features tab desc',
  'fields'   => $upload_links, 
  'sortable' => false,
  'group' => 'start',
));

$upload_links = array();

// Tab desc list
$upload_links[] = $singlepsychotabsection->addText($prefix.'techniques_list_item', array( 'name' => esc_html__('Single psycho techniques tab desc', 'realgh'),'group' => 'end'  ), true);

//repeater block
$singlepsychotabsection->addRepeaterBlock($prefix.'techniques_tab_list_repeter',array(
  'inline'   => false, 
  'name'     => 'Single psycho techniques tab desc',
  'fields'   => $upload_links, 
  'sortable' => false,
  'group' => 'end',
));

//Tab Title
$singlepsychotabsection->addText(
  $prefix.'single_psycho_video_title', array( 'name' => esc_html__('Single psycho video title  ', 'realgh'),
  'group' => 'end' )
);

/*
* Don't Forget to Close up the meta box Declaration 
*/
//Finish Meta Box Declaration 
$singlepsychotabsection->Finish();



 
/* 
  * Find Reviews title section
*/
$cfg_reviewstitle = array(
  'id'              => 'realgh_reviewstitle',          // meta box id, unique per meta box
  'title'           => esc_html__('Single psychologist reviews section', 'realgh'),   // meta box title
  'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
  'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
  'page_name'       => 'template-single-psychologist.php',  // if single = true. Name of page for which to output metaboxes
  'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
  'priority'        => 'high',            // order of meta box: high (default), low; optional
  'fields'          => array(),            // list of meta fields (can be added by field arrays)
  'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
  'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
   
/*
  * Initiate your meta box
*/
$reviewstitle =  new AT_Meta_Box($cfg_reviewstitle);
 
//Reviews  Title
$reviewstitle->addText(
  $prefix.'single_psycho_reviews_title', array( 'name' => esc_html__('Single psycho reviews title ', 'realgh') )
);

/*
* Don't Forget to Close up the meta box Declaration 
*/
//Finish Meta Box Declaration 
$reviewstitle->Finish();



/* 
  * Find single psycho aside
*/
  $cfg_singlepsychoaside = array(
    'id'              => 'realgh_singlepsychoaside',          // meta box id, unique per meta box
    'title'           => esc_html__('Single psychologist singlepsychoaside section', 'realgh'),   // meta box title
    'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
    'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
    'page_name'       => 'template-single-psychologist.php',  // if single = true. Name of page for which to output metaboxes
    'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'        => 'high',            // order of meta box: high (default), low; optional
    'fields'          => array(),            // list of meta fields (can be added by field arrays)
    'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
    );
    
     
  /*
    * Initiate your meta box
  */
  $singlepsychoaside =  new AT_Meta_Box($cfg_singlepsychoaside);
   
  //Calendar Title
  $singlepsychoaside->addText(
    $prefix.'single_psycho_calendar_title', array( 'name' => esc_html__('Single psycho calendar title mobile  ', 'realgh'),
    'group' => 'end' )
  );
  /*
  * Don't Forget to Close up the meta box Declaration 
  */
  //Finish Meta Box Declaration 
  $singlepsychoaside->Finish();
  



}
