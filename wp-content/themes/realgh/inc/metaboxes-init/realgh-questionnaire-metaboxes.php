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
	* questionnaire
  */
  // personalinfo---------------------------------------------------------
  $cfg_personalinfo = array(
	 'id'              => 'realgh_personalinfo',          // meta box id, unique per meta box
	 'title'           => esc_html__('Personal Info Content', 'realgh'),   // meta box title
	 'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	 'page_name'       => 'template-questionnaire.php',  // if single = true. Name of page for which to output metaboxes
	 'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	 'priority'        => 'high',            // order of meta box: high (default), low; optional
	 'fields'          => array(),            // list of meta fields (can be added by field arrays)
	 'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	 'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
	* Initiate your meta box
  */
  $personalinfo =  new AT_Meta_Box($cfg_personalinfo);
  
  /*
	* Add fields to your meta box
  */
//main title
$personalinfo->addText(
	$prefix.'personal_main_title', array( 'name' => esc_html__('Main title', 'realgh'),
	   'group' => 'end' ) 
);

//form image title
$personalinfo->addText(
	$prefix.'form-image_title',
	 array( 'name' => esc_html__('Image title', 'realgh'),
	    'group' => 'start' )
);


$upload_links = array();

//upload link text
$upload_links[] = $personalinfo->addText($prefix.'upload_link', array( 'name' => esc_html__('Upload link', 'realgh') ), true);

//repeater block
$personalinfo->addRepeaterBlock($prefix.'upload_link_repeter',array(
'inline'   => false, 
'name'     => 'Upload Link List',
'fields'   => $upload_links, 
'sortable' => false,
'group'   => 'end'
));


// upload link list text
$personalinfo->addText(
	$prefix.'upload_link_list_text',
	 array( 'name' => esc_html__('Upload link list text', 'realgh'),
	    'group' => 'start' )
);


//upload link text field
$personalinfo->addText(
	$prefix.'upload_link_text',
	array(
		'name' => esc_html__('Upload link text', 'realgh'),
		'group' => 'end'
	)
);

//form label
$personalinfo->addText(
	$prefix.'form_field_fname_label',
	array(
		'name' => esc_html__('First name label', 'realgh'),
		'group' => 'start')
);
//form placeholder
 $personalinfo->addText(
	$prefix.'form_field_fname_placeholder',
	array(
		'name' => esc_html__('First name placeholder', 'realgh'),
		'group' => 'end')
);
//form label
$personalinfo->addText(
	$prefix.'form_field_sname_label',
	array(
		'name' => esc_html__('Sur name label', 'realgh'),
		'group' => 'start')
);
//form placeholder
 $personalinfo->addText(
	$prefix.'form_field_sname_placeholder',
	array(
		'name' => esc_html__('Sur name placeholder', 'realgh'),
		'group' => 'end')
);
//form label
$personalinfo->addText(
	$prefix.'form_field_dob_label',
	array(
		'name' => esc_html__('Date of birth label', 'realgh'),
		'group' => 'start')
);
//form placeholder
 $personalinfo->addText(
	$prefix.'form_field_dob_placeholder',
	array(
		'name' => esc_html__('Date of birth placeholder', 'realgh'),
		'group' => 'end')
);
//form label
$personalinfo->addText(
	$prefix.'form_field_qualification_label', 
	array( 
		'name' => esc_html__('Qualification label', 'realgh'),
		'group' => 'start'
	)
 );

//form label
 $personalinfo->addText(
	$prefix.'form_field_residence_label', 
	array( 
		'name' => esc_html__('Residence label', 'realgh'),
		'group' => 'end'
	)
 );

 //form label
 $personalinfo->addText(
	$prefix.'form_phone_number_label', 
	array( 
		'name' => esc_html__('Phone number label', 'realgh'),
		'group' => 'start'
	)
 );
 //form placeholder
 $personalinfo->addText(
	$prefix.'form_field_phone_number_placeholder', 
	array( 
		'name' => esc_html__('Phone number placeholder', 'realgh'),
		'group' => 'end'
	)
 );

 //form label
 $personalinfo->addText(
	$prefix.'form_email_address_label', 
	array( 
		'name' => esc_html__('Email address label', 'realgh'),
		'group' => 'start'
	)
 );

  //form label
  $personalinfo->addTextarea(
	$prefix.'form_email_address_text_field', 
	array( 
		'name' => esc_html__('Email address text field', 'realgh')
	)
 );

//form address placeholder
$personalinfo->addText(
	$prefix.'form_email_address_placeholder', 
	array( 
		'name' => esc_html__('Email address pleaceholder label', 'realgh'),
		'group' => 'end'
	)
 );

//form label
$personalinfo->addText(
	$prefix.'form_field_timezone_label', 
	array( 
		'name' => esc_html__('Time zone label', 'realgh'),
		'group' => 'start'
	)
 );
//goback button link text
$personalinfo->addText(
	$prefix.'goback_link_text',
	array(
		'name' => esc_html__('Goback link text', 'realgh'),
		'group' => 'start')
);

//continue button link text
$personalinfo->addText(
	$prefix.'continue_link_text',
	array(
		'name' => esc_html__('Continue Link text', 'realgh'),
		'group' => 'end')
);

//mandatory text field
$personalinfo->addText(
	$prefix.'mandatory_field_title',
	array(
		'name' => esc_html__('Mandatory field desc', 'realgh')
	)
);


  /*
	* Don't Forget to Close up the meta box Declaration 
  */
  //Finish Meta Box Declaration 
$personalinfo->Finish();


// Therapist Introduction---------------------------------------------------------
$cfg_therapist = array(
	'id'              => 'realgh_therapist',          // meta box id, unique per meta box
	'title'           => esc_html__('Therapist Info Content', 'realgh'),   // meta box title
	'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	'page_name'       => 'template-questionnaire.php',  // if single = true. Name of page for which to output metaboxes
	'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	'priority'        => 'high',            // order of meta box: high (default), low; optional
	'fields'          => array(),            // list of meta fields (can be added by field arrays)
	'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
 );
 
 
 /*
   * Initiate your meta box
 */
 $therapist =  new AT_Meta_Box($cfg_therapist);
 
 /*
   * Add fields to your meta box
 */

//main title
$therapist->addText(
   $prefix.'therapist_main_title', array( 'name' => esc_html__('Therapist main title', 'realgh'),
   'group' => 'end' ) 
);

//form label
$therapist->addText(
	$prefix.'form_about_me_short_version_label', 
	array( 
		'name' => esc_html__('About me (short version) label', 'realgh'),
		'group' => 'start'
	)
);

// form label desc
$therapist->addTextarea(
	$prefix.'form_about_me_text_desc', 
	array( 
		'name' => esc_html__('About me (short version) label desc', 'realgh')
		
	)
);

//form placeholder
$therapist->addTextarea(
	$prefix.'form_short_textarea_placeholder', 
	array( 
		'name' => esc_html__('Textarea placeholder', 'realgh'),
		'group' => 'end'
	)
);

//form label
$therapist->addText(
	$prefix.'form_about_me_extended_version_label', 
	array( 
		'name' => esc_html__('About me (extended version) label', 'realgh'),
		'group' => 'start'
	)
);

// form label desc
$therapist->addTextarea(
	$prefix.'form_about_me_extended_version_text_desc', 
	array( 
		'name' => esc_html__('About me (extended version) label desc', 'realgh')
		
	)
);
//form placeholder
$therapist->addTextarea(
	$prefix.'form_extend_textarea_placeholder', 
	array( 
		'name' => esc_html__('Textarea placeholder', 'realgh'),
		'group' => 'end'
	)
);
//form label
$therapist->addText(
	$prefix.'form_phylosophy_label', 
	array( 
		'name' => esc_html__('Phylosophy label', 'realgh'),
		'group' => 'start'
	)
);

// form label desc
$therapist->addTextarea(
	$prefix.'form_phylosophy_label_desc', 
	array( 
		'name' => esc_html__('Phylosophy label desc', 'realgh')
		
	)
);

//form placeholder
$therapist->addTextarea(
	$prefix.'form_phylosophy_placeholder', 
	array( 
		'name' => esc_html__('Phylosophy Placeholder', 'realgh'),
		'group' => 'end'
	)
);

//Goback button link text
$therapist->addText(
	$prefix.'therapist_goback_link_text',
	array(
		'name' => esc_html__('Therapist goback link text', 'realgh'),
		'group' => 'start')
);

//Continue button link text 
$therapist->addText(
	$prefix.'therapist_continue_link_text',
	array(
		'name' => esc_html__('Therapist continue link text', 'realgh'),
		'group' => 'end')
);



 /*
   * Don't Forget to Close up the meta box Declaration 
 */
 //Finish Meta Box Declaration 
$therapist->Finish();

// Education Introduction---------------------------------------------------------
$cfg_education = array(
	'id'              => 'realgh_education',          // meta box id, unique per meta box
	'title'           => esc_html__('Education Info Content', 'realgh'),   // meta box title
	'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	'page_name'       => 'template-questionnaire.php',  // if single = true. Name of page for which to output metaboxes
	'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	'priority'        => 'high',            // order of meta box: high (default), low; optional
	'fields'          => array(),            // list of meta fields (can be added by field arrays)
	'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
 );
 
 
 /*
   * Initiate your meta box
 */
 $education =  new AT_Meta_Box($cfg_education);
 
 /*
   * Add fields to your meta box
 */

//main title
$education->addText(
   $prefix.'education_main_title', array( 'name' => esc_html__('Education main title', 'realgh'),
      'group' => 'end' ) 
);

//form label
$education->addText(
	$prefix.'higher_education_label', 
	array( 
		'name' => esc_html__('Tell me about your higher education label', 'realgh'),
		'group' => 'start'
	)
);

//form label desc
$education->addTextarea(
	$prefix.'higher_education_label_desc', 
	array( 
		'name' => esc_html__('Higher education label desc', 'realgh')
	)
);

//form placeholder textarea
$education->addText(
	$prefix.'higher_education_placeholder', 
	array( 
		'name' => esc_html__('Higher education Placeholder', 'realgh'),
		'group' => 'end'
	)
);

//form label
 $education->addText(
 	$prefix.'main_method_label', 
 	array( 
 		'name' => esc_html__('Main method label', 'realgh'))
 );
//form placeholder
$education->addText(
	$prefix.'form_main_method_placeholder', 
	array( 
		'name' => esc_html__('Other textarea', 'realgh'),
		'group' => 'end'
	)
);


//form label
$education->addText(
	$prefix.'are_you_studying_your_main_method_label', 
	array( 
		'name' => esc_html__('Are you studying your main method label', 'realgh'),
		'group' => 'start'
	)
);

//form label desc
$education->addTextarea(
	$prefix.'studying_your_main_method_label_desc', 
	array( 
		'name' => esc_html__('Studying your main method label desc', 'realgh')
	)
);

//form placeholder
$education->addTextarea(
	$prefix.'form-main_method_textarea', 
	array( 
		'name' => esc_html__('Write about yourself textarea', 'realgh'),
		'group' => 'end'
	)
);

//form label
$education->addText(
	$prefix.'form_about_method_label', 
	array( 
		'name' => esc_html__('About my method Label', 'realgh'),
		'group' => 'start'
	)
);

//form label desc
$education->addTextarea(
	$prefix.'form_about_method_label_desc', 
	array( 
		'name' => esc_html__('About method label desc', 'realgh')
	)
);

//form placeholder
$education->addTextarea(
	$prefix.'form_about_method_placeholder', 
	array( 
		'name' => esc_html__('About method textarea', 'realgh'),
		'group' => 'end'
	)
);
//form label
$education->addText(
	$prefix.'form-additional_education_topics_label', 
	array( 
		'name' => esc_html__('Additional education topics label', 'realgh'),
		'group' => 'start'
	)
);
//form placeholder
$education->addText(
	$prefix.'form_additional_education_topics_placeholder', 
	array( 
		'name' => esc_html__('Education topics textarea', 'realgh'),
		'group' => 'end'
	)
);

//form label
$education->addText(
	$prefix.'form_attach_certification_topics_label', 
	array( 
		'name' => esc_html__('Attach certification topics label', 'realgh'),
		'group' => 'start'
	)
);

//upload button text
$education->addText(
	$prefix.'form_upload_button_text', 
	array( 
		'name' => esc_html__('Upload button text', 'realgh')
	)
);

//video intro desc
$education->addText(
	$prefix.'form_upload_file_desc', 
	array( 
		'name' => esc_html__('Upload file desc', 'realgh'),
		'group' => 'end'
	)
);

//Goback button link text
$education->addText(
	$prefix.'education_goback_link_text',
	array(
		'name' => esc_html__('Education goback link text', 'realgh'),
		'group' => 'start')
);

//Continue button link text
$education->addText(
	$prefix.'education_continue_link_text',
	array(
		'name' => esc_html__('Education continue link text', 'realgh'),
		'group' => 'end')
);

//mandatory text field
$education->addText(
	$prefix.'mandatory_field_title',
	array(
		'name' => esc_html__('Mandatory field desc', 'realgh')
	)
);

 /*
   * Don't Forget to Close up the meta box Declaration 
 */
 //Finish Meta Box Declaration 
$education->Finish();

// Experience Introduction---------------------------------------------------------
$cfg_experience = array(
	'id'              => 'realgh_experience',          // meta box id, unique per meta box
	'title'           => esc_html__('Experience Info Content', 'realgh'),   // meta box title
	'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	'page_name'       => 'template-questionnaire.php',  // if single = true. Name of page for which to output metaboxes
	'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	'priority'        => 'high',            // order of meta box: high (default), low; optional
	'fields'          => array(),            // list of meta fields (can be added by field arrays)
	'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
 );
 
 
 /*
   * Initiate your meta box
 */
 $experience =  new AT_Meta_Box($cfg_experience);
 
 /*
   * Add fields to your meta box
 */

//main title
$experience->addText(
   $prefix.'experience_main_title', array( 'name' => esc_html__('Experience main title', 'realgh'),
   'group' => 'end' ) 
);

//form label
$experience->addText(
	$prefix.'form_study_cirriculum_label', 
	array( 
		'name' => esc_html__('Study cirriculum label', 'realgh'),
		'group' => 'start'
	)
);

//form placeholder
$experience->addText(
	$prefix.'form_study_cirriculum_placeholder', 
	array( 
		'name' => esc_html__('Study cirriculum textarea', 'realgh'),
		'group' => 'end'
	)
);

//form label
$experience->addText(
	$prefix.'form_experience_topics_label', 
	array( 
		'name' => esc_html__('Experience topics label', 'realgh'),
		'group' => 'start'
	)
);

//form label
$experience->addText(
	$prefix.'form_i-work-with_label', 
	array( 
		'name' => esc_html__('Experience work with label', 'realgh'),
		'group' => 'end'
	)
);

//Goback button link text
$experience->addText(
	$prefix.'experience_goback_link_text',
	array(
		'name' => esc_html__('Experience goback link text', 'realgh'),
		'group' => 'start'
	)
);

//link text field
$experience->addText(
	$prefix.'experience_continue_link_text',
	array(
		'name' => esc_html__('Experience continue link text', 'realgh'),
		'group' => 'end'
	)
);

//mandatory text field
$experience->addText(
	$prefix.'mandatory_field_title',
	array(
		'name' => esc_html__('Mandatory field desc', 'realgh'),
	)
);

 /*
   * Don't Forget to Close up the meta box Declaration 
 */
 //Finish Meta Box Declaration 
$experience->Finish();



// videointro Introduction---------------------------------------------------------
$cfg_videointro = array(
	'id'              => 'realgh_videointro',          // meta box id, unique per meta box
	'title'           => esc_html__('Videointro Info Content', 'realgh'),   // meta box title
	'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	'page_name'       => 'template-questionnaire.php',  // if single = true. Name of page for which to output metaboxes
	'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	'priority'        => 'high',            // order of meta box: high (default), low; optional
	'fields'          => array(),            // list of meta fields (can be added by field arrays)
	'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
 );
 
 
 /*
   * Initiate your meta box
 */
 $videointro =  new AT_Meta_Box($cfg_videointro);
 
 /*
   * Add fields to your meta box
 */

//Main title
$videointro->addText(
   $prefix.'videointro_main_title', array( 'name' => esc_html__('Videointro main title', 'realgh'),
   'group' => 'start' )
);

//video intro title desc
$videointro->addTextarea(
	$prefix.'videointro_title_desc', array( 'name' => esc_html__('Videointro title desc', 'realgh'),
	'group' => 'end' )
 );


$video_links = array();

//Text field
$video_links[] = $videointro->addText($prefix.'video_desc_item', array( 'name' => esc_html__('Description Item', 'realgh'),'group' => 'end' ), true);

//repeater block
$videointro->addRepeaterBlock($prefix.'video_desc_repeter',array(
'inline'   => true, 
'name'     => 'Video Description',
'fields'   => $video_links, 
'sortable' => false
));

 //upload button text
 $videointro->addText(
	$prefix.'form_upload_button_text', 
	array( 
		'name' => esc_html__('Upload button text', 'realgh'),
		'group' => 'start'
	)
);

//video intro desc
$videointro->addText(
	$prefix.'form_upload_video_file_desc', 
	array( 
		'name' => esc_html__('Upload file desc', 'realgh'),
		'group' => 'end'
	)
);


//video intro checkbox desc
$videointro->addText(
	$prefix.'videointro_checkbox_desc_1',
	array(
		'name' => esc_html__('Videointro checkbox desc', 'realgh'),
		'group' => 'start'
	)
);

//video intro checkbox desc
$videointro->addText(
	$prefix.'videointro_checkbox_desc_2',
	array(
		'name' => esc_html__('Videointro checkbox desc', 'realgh'),
		'group' => 'end'
	)
);


//Goback button link text
$videointro->addText(
	$prefix.'videointro_goback_link_text',
	array(
		'name' => esc_html__('Videointro goback link text', 'realgh'),
		'group' => 'start'
	)
);

//Submit button link text
$videointro->addText(
	$prefix.'videointro_submit_link_text',
	array(
		'name' => esc_html__('Videointro submit link text', 'realgh'),
		'group' => 'end'
	)
);

 /*
   * Don't Forget to Close up the meta box Declaration 
 */
 //Finish Meta Box Declaration 
$videointro->Finish();

}


