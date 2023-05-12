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
	* ------------------------------Lesson----------------------------------
	*/
	$cfg_lesson = array(
	 'id'              => 'realgh_lesson',          // meta box id, unique per meta box
	 'title'           => esc_html__('Lesson content', 'realgh'),   // meta box title
	 'pages'           => array('post'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => false,      // Display metaboxes on a specific page (false if diplayed at all)
	 'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	 'priority'        => 'high',            // order of meta box: high (default), low; optional
	 'fields'          => array(),            // list of meta fields (can be added by field arrays)
	 'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	 'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);


	/*
	* Initiate your meta box
	*/
	$lesson =  new AT_Meta_Box($cfg_lesson);

	/*
	* Add fields to your meta box
	*/

	//Text field
	$lesson->addText(
	 $prefix_za.'lesson_question', array( 'name' => esc_html__('Question that leads to this lesson', 'realgh') )
	);
	//Text field
	$lesson->addText(
	 $prefix_za.'lesson_title', array( 'name' => esc_html__('Title for current exercise groups', 'realgh') )
	);

	/*
	* Don't Forget to Close up the meta box Declaration 
	*/
	//Finish Meta Box Declaration 
	$lesson->Finish();



	/* 
	* ------------------------------Exercise Content----------------------------------
	*/
	$cfg_exercise = array(
		'id'              => 'realgh_exercise',          // meta box id, unique per meta box
		'title'           => esc_html__('Exercise content', 'realgh'),   // meta box title
		'pages'           => array('post'),      // post types, accept custom post types as well, default is array('post'); optional
		'single'          => false,      // Display metaboxes on a specific page (false if diplayed at all)
		'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
		'priority'        => 'high',            // order of meta box: high (default), low; optional
		'fields'          => array(),            // list of meta fields (can be added by field arrays)
		'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
		'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	   );
   
   
	   /*
	   * Initiate your meta box
	   */
	   $exercise =  new AT_Meta_Box($cfg_exercise);
   
	   /*
	   * Add fields to your meta box
	   */
   
	   //Text field
	   $exercise->addText(
		$prefix_za.'exercise_text', array( 'name' => esc_html__('Exercise Text', 'realgh') )
	   );
	   //TextArea field
	   $exercise->addTextarea(
		$prefix_za.'exercise_description', array( 'name' => esc_html__('Exercise Description', 'realgh') )
	   );
	   //Select field
	   $exercise->addSelect(
		$prefix_za.'exercise_template', 
		array( 
			'' => 'Select Exercise Template',
			'sd_template' => 'Situation Description Template' ,
			'plan_template' => 'Plan Template',
			'journal_template' => 'Journal Template',
			'sr_template' => 'Sitaution Reflection Template'
		),
		array( 'label' => 'Exercise Template')
	   );
   
	   /*
	   * Don't Forget to Close up the meta box Declaration 
	   */
	   //Finish Meta Box Declaration 
	   $exercise->Finish();



	/* 
	* ------------------------------Strategy----------------------------------
	*/
	$cfg_strategy = array(
	 'id'              => 'realgh_strategy',          // meta box id, unique per meta box
	 'title'           => esc_html__('Strategy tab content', 'realgh'),   // meta box title
	 'pages'           => array('post'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => false,      // Display metaboxes on a specific page (false if diplayed at all)
	 'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	 'priority'        => 'high',            // order of meta box: high (default), low; optional
	 'fields'          => array(),            // list of meta fields (can be added by field arrays)
	 'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	 'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);

	$strategy =  new AT_Meta_Box($cfg_strategy);

	/*
	* To Create a reapeater Block first create an array of fields
	* use the same functions as above but add true as a last param
	*/
	$repeater_exercise = array();
	//Text field
	$repeater_exercise[] = $strategy->addText($prefix_za.'exercise_title', array( 'name' => esc_html__('Exercise title', 'realgh') ), true);
	//Text field
	$repeater_exercise[] = $strategy->addText($prefix_za.'exercise_youtube_link', array( 'name' => esc_html__('YouTube link', 'realgh') ), true);
	//Textarea field
	$repeater_exercise[] = $strategy->addTextarea($prefix_za.'exercise_text', array( 'name' => esc_html__('Exercise text', 'realgh') ), true);

	/*
	* Then just add the fields to the repeater block
	*/
	//repeater block
	$strategy->addRepeaterBlock($prefix_za.'re_strategy_list',array(
	 'inline'   => false, 
	 'name'     => 'Exercises list',
	 'fields'   => $repeater_exercise, 
	 'sortable' => false
	));

	//Finish Meta Box Declaration 
	$strategy->Finish();


	/* 
	* ---------------------------Other tab---------------------------------
	*/
	$cfg_other = array(
	 'id'              => 'realgh_other',          // meta box id, unique per meta box
	 'title'           => esc_html__('Other resources tab content', 'realgh'),   // meta box title
	 'pages'           => array('post'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => false,      // Display metaboxes on a specific page (false if diplayed at all)
	 'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	 'priority'        => 'high',            // order of meta box: high (default), low; optional
	 'fields'          => array(),            // list of meta fields (can be added by field arrays)
	 'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	 'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);

	$other =  new AT_Meta_Box($cfg_other);

	//repeater block
	$other->addRepeaterBlock($prefix_za.'re_other_list',array(
	 'inline'   => false, 
	 'name'     => 'Exercises list',
	 'fields'   => $repeater_exercise, 
	 'sortable' => false
	));

	//Finish Meta Box Declaration 
	$other->Finish();


	/* 
	* ---------------------------Science tab---------------------------------
	*/
	$cfg_science = array(
	 'id'              => 'realgh_science',          // meta box id, unique per meta box
	 'title'           => esc_html__('Science tab content', 'realgh'),   // meta box title
	 'pages'           => array('post'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => false,      // Display metaboxes on a specific page (false if diplayed at all)
	 'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	 'priority'        => 'high',            // order of meta box: high (default), low; optional
	 'fields'          => array(),            // list of meta fields (can be added by field arrays)
	 'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	 'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);


	$science =  new AT_Meta_Box($cfg_science);

	//repeater block
	$science->addRepeaterBlock($prefix_za.'re_science_list',array(
	 'inline'   => false, 
	 'name'     => 'Exercises list',
	 'fields'   => $repeater_exercise, 
	 'sortable' => false
	));

	//Finish Meta Box Declaration 
	$science->Finish();



	/* 
	* ------------------------------Links block----------------------------------
	*/
	$cfg_links = array(
	 'id'              => 'realgh_links',          // meta box id, unique per meta box
	 'title'           => esc_html__('Links block content', 'realgh'),   // meta box title
	 'pages'           => array('post'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => false,      // Display metaboxes on a specific page (false if diplayed at all)
	 'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	 'priority'        => 'high',            // order of meta box: high (default), low; optional
	 'fields'          => array(),            // list of meta fields (can be added by field arrays)
	 'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	 'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);

	$links =  new AT_Meta_Box($cfg_links);

	/*
   * To Create a conditinal Block first create an array of fields
   * use the same functions as above but add true as a last param (like the repater block)
   */
  $conditinal_posts[] = $links->addPosts(
		$prefix_za.'link_post',
		array('post_type' => 'post'),
		array(
			'name' => esc_html__('Lesson question', 'realgh'),
			'desc' => esc_html__('Which lesson question do you want to display on the page?', 'realgh')
		),
		true
	);
  $сonditinal_cutegories[] = $links->addTaxonomy(
		$prefix_za.'link_category',
		array('taxonomy' => 'category'),
		array(
			'name' => esc_html__('Category question', 'realgh'),
			'desc' => esc_html__('Question from which category do you want to display on the page?', 'realgh')
		),
		true
	);

	$repeater_links = array();

	//Text field
	$repeater_links[] = $links->addCondition('conditinal_posts',
      array(
        'name'   => __('Lesson','realgh'),
        'desc'   => __('Will this question be selected from the list of lessons?','realgh'),
        'fields' => $conditinal_posts,
        'std'    => false
      ),
      true
   );
	//Text field
	$repeater_links[] = $links->addCondition('сonditinal_categories',
      array(
        'name'   => __('Category','realgh'),
        'desc'   => __('Will this question be selected from the list of categories?','realgh'),
        'fields' => $сonditinal_cutegories,
        'std'    => true
      ),
      true
   );

	//repeater block
	$links->addRepeaterBlock($prefix_za.'re_links_list',array(
	 'inline'   => false, 
	 'name'     => 'Links list',
	 'fields'   => $repeater_links, 
	 'sortable' => false
	));

	//Finish Meta Box Declaration 
	$links->Finish();
}