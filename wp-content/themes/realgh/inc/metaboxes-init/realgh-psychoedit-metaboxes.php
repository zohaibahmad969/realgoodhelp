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


// psychoeditprofile---------------------------------------------------------
$cfg_psychoeditprofile = array(
	'id'              => 'realgh_psychoeditprofile',          // meta box id, unique per meta box
	'title'           => esc_html__('Psycho edit profile', 'realgh'),   // meta box title
	'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	'page_name'       => 'template-edit-account.php',  // if single = true. Name of page for which to output metaboxes
	'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	'priority'        => 'high',            // order of meta box: high (default), low; optional
	'fields'          => array(),            // list of meta fields (can be added by field arrays)
	'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
 );
 
 
 /*
   * Initiate your meta box
 */
 $psychoeditprofile=  new AT_Meta_Box($cfg_psychoeditprofile);
 
 /*
   * Add fields to your meta box
 */


// upload button and link text

$psychoeditprofile->addText(
   $prefix.'upload_btn_text',
	array( 'name' => esc_html__('Upload button text', 'realgh'),
	   'group' => 'start' )
);


$upload_links = array();

// upload link text
$upload_links[] = $psychoeditprofile->addText($prefix.'upload_link', array( 'name' => esc_html__('Upload link', 'realgh') ), true);

//repeater block
$psychoeditprofile->addRepeaterBlock($prefix.'upload_link_repeter',array(
'inline'   => false, 
'name'     => 'Upload Link List',
'fields'   => $upload_links, 
'sortable' => false
));


$psychoeditprofile->addText(
   $prefix.'upload_link_list_text',
	array( 'name' => esc_html__('Upload link list text', 'realgh'),
	   'group' => 'end' )
);

 //Finish Meta Box Declaration 
$psychoeditprofile->Finish();


// psychoeditprofileinfo---------------------------------------------------------
  $cfg_psychoeditprofileinfo = array(
	 'id'              => 'realgh_psychoeditprofileinfo',          // meta box id, unique per meta box
	 'title'           => esc_html__('Psycho edit profile info', 'realgh'),   // meta box title
	 'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	 'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	 'page_name'       => 'template-edit-account.php',  // if single = true. Name of page for which to output metaboxes
	 'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	 'priority'        => 'high',            // order of meta box: high (default), low; optional
	 'fields'          => array(),            // list of meta fields (can be added by field arrays)
	 'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	 'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
	* Initiate your meta box
  */
  $psychoeditprofileinfo=  new AT_Meta_Box($cfg_psychoeditprofileinfo);
  
  /*
	* Add fields to your meta box
  */
//main title
$psychoeditprofileinfo->addText(
	$prefix.'profile_info_main_title', array( 'name' => esc_html__('Main title', 'realgh'),
	   'group' => 'start' ) 
);

// user title
$psychoeditprofileinfo->addText(
	$prefix.'user_info_main_title', array( 'name' => esc_html__('User info title', 'realgh'),
	   'group' => 'end' ) 
);
// user title
$psychoeditprofileinfo->addText(
	$prefix.'client_user_info_main_title', array( 'name' => esc_html__('Client user info title', 'realgh'),
	'group' => 'start'
	) 
);
// user title
$psychoeditprofileinfo->addText(
	$prefix.'Client_user_info_subtitle', array( 'name' => esc_html__('client user info subtitle', 'realgh'),
	'group' => 'end'
 ) 
);

//form label
$psychoeditprofileinfo->addText(
	$prefix.'form_field_fname_label',
	array(
		'name' => esc_html__('First name label', 'realgh'),
		'group' => 'start')
);
//form placeholder
 $psychoeditprofileinfo->addText(
	$prefix.'form_field_fname_placeholder',
	array(
		'name' => esc_html__('First name placeholder', 'realgh'),
		'group' => 'end')
);
//form label
$psychoeditprofileinfo->addText(
	$prefix.'form_field_sname_label',
	array(
		'name' => esc_html__('Sur name label', 'realgh'),
		'group' => 'start')
);
//form placeholder
 $psychoeditprofileinfo->addText(
	$prefix.'form_field_sname_placeholder',
	array(
		'name' => esc_html__('Sur name placeholder', 'realgh'),
		'group' => 'end')
);
//form label
$psychoeditprofileinfo->addText(
	$prefix.'form_field_dob_label',
	array(
		'name' => esc_html__('Date of birth label', 'realgh'),
		'group' => 'start')
);
//form placeholder
 $psychoeditprofileinfo->addText(
	$prefix.'form_field_dob_placeholder',
	array(
		'name' => esc_html__('Date of birth placeholder', 'realgh'),
		'group' => 'end')
);
//form label
 $psychoeditprofileinfo->addText(
	$prefix.'form_field_residence_label', 
	array( 
		'name' => esc_html__('Residence label', 'realgh'),
		'group' => 'start'
	)
 );

 //form label
 $psychoeditprofileinfo->addText(
	$prefix.'form_select-timezone_label', 
	array( 
		'name' => esc_html__('Select timezone label', 'realgh'),
		'group' => 'end'
	)
 );

 //form label
 $psychoeditprofileinfo->addText(
	$prefix.'form_email_address_label', 
	array( 
		'name' => esc_html__('Email address label', 'realgh'),
		'group' => 'start'
	)
 );

//form address placeholder
$psychoeditprofileinfo->addText(
	$prefix.'form_email_address_placeholder', 
	array( 
		'name' => esc_html__('Email address pleaceholder label', 'realgh'),
		'group' => 'end'
	)
 );

 //form label
 $psychoeditprofileinfo->addText(
	$prefix.'form_phone_number_label', 
	array( 
		'name' => esc_html__('Phone number label', 'realgh'),
		'group' => 'start'
	)
 );
 //form placeholder
 $psychoeditprofileinfo->addText(
	$prefix.'form_field_phone_number_placeholder', 
	array( 
		'name' => esc_html__('Phone number placeholder', 'realgh'),
		'group' => 'end'
	)
 );

//form label
$psychoeditprofileinfo->addText(
	$prefix.'form_password_label', 
	array( 
		'name' => esc_html__('Password label', 'realgh'),
		'group' => 'start'
	)
);
 //form placeholder
 $psychoeditprofileinfo->addText(
	$prefix.'form_password_label_placeholder', 
	array( 
		'name' => esc_html__('Password label placeholder', 'realgh'),
		'group' => 'end'
	)
 );

//form password change link
$psychoeditprofileinfo->addText(
	$prefix.'form_password-change_link', 
	array( 
		'name' => esc_html__('Password change link', 'realgh'),
		'group' => 'end'
	)
 );

 //form label
$psychoeditprofileinfo->addText(
	$prefix.'form_conform_password_label', 
	array( 
		'name' => esc_html__('Confirm Password label', 'realgh'),
		'group' => 'start'
	)
);
 //form placeholder
 $psychoeditprofileinfo->addText(
	$prefix.'form_conform_password_label_placeholder', 
	array( 
		'name' => esc_html__('Confirm Password label placeholder', 'realgh'),
		'group' => 'end'
	)
 );

//form password change link
$psychoeditprofileinfo->addText(
	$prefix.'form_conform_password-change_link', 
	array( 
		'name' => esc_html__('Confirm Password change link', 'realgh'),
		'group' => 'end'
	)
 );

  //Finish Meta Box Declaration 
$psychoeditprofileinfo->Finish();


// Therapist Introduction---------------------------------------------------------
$cfg_psychoedittherapistinfo = array(
	'id'              => 'realgh_psychoedittherapistinfo',          // meta box id, unique per meta box
	'title'           => esc_html__('Therapist Info Content', 'realgh'),   // meta box title
	'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	'page_name'       => 'template-edit-account.php',  // if single = true. Name of page for which to output metaboxes
	'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	'priority'        => 'high',            // order of meta box: high (default), low; optional
	'fields'          => array(),            // list of meta fields (can be added by field arrays)
	'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
 );
 
 
 /*
   * Initiate your meta box
 */
 $psychoedittherapistinfo =  new AT_Meta_Box($cfg_psychoedittherapistinfo);
 
 /*
   * Add fields to your meta box
 */

//main title
$psychoedittherapistinfo->addText(
   $prefix.'therapist_main_title', array( 'name' => esc_html__('Psycho edit main title', 'realgh'),
   'group' => 'start' ) 
);

$psychoedittherapistinfo->addText(
	$prefix.'therapist_info_title', array( 'name' => esc_html__('Psycho edit therapist info title', 'realgh'),
	'group' => 'end' ) 
 );
 

//form label
$psychoedittherapistinfo->addText(
	$prefix.'form_about_me_short_version_label', 
	array( 
		'name' => esc_html__('About me (short version) label', 'realgh'),
		'group' => 'start'
	)
);

// form label desc
$psychoedittherapistinfo->addTextarea(
	$prefix.'form_about_me_text_desc', 
	array( 
		'name' => esc_html__('About me (short version) label desc', 'realgh')
		
	)
);

//form placeholder
$psychoedittherapistinfo->addTextarea(
	$prefix.'form_short_textarea_placeholder', 
	array( 
		'name' => esc_html__('Textarea placeholder', 'realgh'),
		'group' => 'end'
	)
);

//form label
$psychoedittherapistinfo->addText(
	$prefix.'form_about_me_extended_version_label', 
	array( 
		'name' => esc_html__('About me (extended version) label', 'realgh'),
		'group' => 'start'
	)
);

// form label desc
$psychoedittherapistinfo->addTextarea(
	$prefix.'form_about_me_extended_version_text_desc', 
	array( 
		'name' => esc_html__('About me (extended version) label desc', 'realgh')
		
	)
);
//form placeholder
$psychoedittherapistinfo->addTextarea(
	$prefix.'form_extend_textarea_placeholder', 
	array( 
		'name' => esc_html__('Textarea placeholder', 'realgh'),
		'group' => 'end'
	)
);
//form label
$psychoedittherapistinfo->addText(
	$prefix.'form_phylosophy_label', 
	array( 
		'name' => esc_html__('Phylosophy label', 'realgh'),
		'group' => 'start'
	)
);

// form label desc
$psychoedittherapistinfo->addTextarea(
	$prefix.'form_phylosophy_label_desc', 
	array( 
		'name' => esc_html__('Phylosophy label desc', 'realgh')
		
	)
);

//form placeholder
$psychoedittherapistinfo->addTextarea(
	$prefix.'form_phylosophy_placeholder', 
	array( 
		'name' => esc_html__('Phylosophy Placeholder', 'realgh'),
		'group' => 'end'
	)
);

// //form label
$psychoedittherapistinfo->addText(
	$prefix.'higher_education_label', 
	array( 
		'name' => esc_html__('Tell me about your higher education label', 'realgh'),
		'group' => 'start'
	)
);

// //form label desc
$psychoedittherapistinfo->addTextarea(
	$prefix.'higher_education_label_desc', 
	array( 
		'name' => esc_html__('Higher education label desc', 'realgh')
	)
);

// //form placeholder textarea
$psychoedittherapistinfo->addText(
	$prefix.'higher_education_placeholder', 
	array( 
		'name' => esc_html__('Higher education Placeholder', 'realgh'),
		'group' => 'end'
	)
);


// //form label
$psychoedittherapistinfo->addText(
	$prefix.'main_method_label', 
	array( 
		'name' => esc_html__('Main method label', 'realgh'))
);


// //form placeholder
$psychoedittherapistinfo->addText(
	$prefix.'form_main_method_placeholder', 
	array( 
		'name' => esc_html__('Other main method textarea', 'realgh'),
		'group' => 'end'
	)
);


// //form label
$psychoedittherapistinfo->addText(
	$prefix.'are_you_studying_your_main_method_label', 
	array( 
		'name' => esc_html__('Are you studying your main method label', 'realgh'),
		'group' => 'start'
	)
);

// //form label desc
$psychoedittherapistinfo->addTextarea(
	$prefix.'studying_your_main_method_label_desc', 
	array( 
		'name' => esc_html__('Studying your main method label desc', 'realgh')
	)
);

// //form placeholder
$psychoedittherapistinfo->addTextarea(
	$prefix.'form-main_method_textarea', 
	array( 
		'name' => esc_html__('Write about yourself textarea', 'realgh'),
		'group' => 'end'
	)
);

// //form label
$psychoedittherapistinfo->addText(
	$prefix.'form_about_method_label', 
	array( 
		'name' => esc_html__('About my method Label', 'realgh'),
		'group' => 'start'
	)
);

// //form label desc
$psychoedittherapistinfo->addTextarea(
	$prefix.'form_about_method_label_desc', 
	array( 
		'name' => esc_html__('About method label desc', 'realgh')
	)
);

// //form placeholder
$psychoedittherapistinfo->addTextarea(
	$prefix.'form_about_method_placeholder', 
	array( 
		'name' => esc_html__('About method textarea', 'realgh'),
		'group' => 'end'
	)
);

// //form label
$psychoedittherapistinfo->addText(
	$prefix.'form-additional_education_topics_label', 
	array( 
		'name' => esc_html__('Additional education topics label', 'realgh'),
		'group' => 'start'
	)
);

// //form placeholder
$psychoedittherapistinfo->addText(
	$prefix.'form_additional_education_topics_placeholder', 
	array( 
		'name' => esc_html__('Education topics textarea', 'realgh'),
		'group' => 'end'
	)
);

// //form label
$psychoedittherapistinfo->addText(
	$prefix.'form_attach_certification_topics_label', 
	array( 
		'name' => esc_html__('Attach certification topics label', 'realgh'),
		'group' => 'start'
	)
);

// //upload button text
$psychoedittherapistinfo->addText(
	$prefix.'form_upload_button_text', 
	array( 
		'name' => esc_html__('Upload button text', 'realgh')
	)
);

// //video intro desc
$psychoedittherapistinfo->addText(
	$prefix.'form_upload_file_desc', 
	array( 
		'name' => esc_html__('Upload file desc', 'realgh'),
		'group' => 'end'
	)
);


//form label
$psychoedittherapistinfo->addText(
	$prefix.'form_study_cirriculum_label', 
	array( 
		'name' => esc_html__('Study cirriculum label', 'realgh'),
		'group' => 'start'
	)
);

//form placeholder
$psychoedittherapistinfo->addText(
	$prefix.'form_study_cirriculum_placeholder', 
	array( 
		'name' => esc_html__('Study cirriculum textarea', 'realgh'),
		'group' => 'end'
	)
);

//form label
$psychoedittherapistinfo->addText(
	$prefix.'form_experience_topics_label', 
	array( 
		'name' => esc_html__('Experience topics label', 'realgh'),
		'group' => 'start'
	)
);

//form label
$psychoedittherapistinfo->addText(
	$prefix.'form_i-work-with_label', 
	array( 
		'name' => esc_html__('Experience work with label', 'realgh'),
		'group' => 'end'
	)
);

//Main title
$psychoedittherapistinfo->addText(
	$prefix.'videointro_main_title', array( 'name' => esc_html__('Videointro main title', 'realgh'),
	'group' => 'start' )
 );
 
 //video intro title desc
 $psychoedittherapistinfo->addTextarea(
	 $prefix.'videointro_title_desc', array( 'name' => esc_html__('Videointro title desc', 'realgh'),
	 'group' => 'end' )
  );
 
  $video_links = array();

  //Text field
  $video_links[] = $psychoedittherapistinfo->addText($prefix.'video_desc_item', array( 'name' => esc_html__('Description Item', 'realgh'),'group' => 'end' ), true);
  
  //repeater block
  $psychoedittherapistinfo->addRepeaterBlock($prefix.'video_desc_repeter',array(
  'inline'   => true, 
  'name'     => 'Video Description',
  'fields'   => $video_links, 
  'sortable' => false
  ));

 //upload button text
 $psychoedittherapistinfo->addText(
	$prefix.'form_upload_button_text', 
	array( 
		'name' => esc_html__('Upload button text', 'realgh'),
		'group' => 'start'
	)
);

//video intro desc
$psychoedittherapistinfo->addText(
	$prefix.'form_upload_file_desc', 
	array( 
		'name' => esc_html__('Upload file desc', 'realgh'),
		'group' => 'end'
	)
);

//video intro checkbox desc
$psychoedittherapistinfo->addText(
	$prefix.'videointro_checkbox_desc_1',
	array(
		'name' => esc_html__('Videointro checkbox desc', 'realgh'),
		'group' => 'start'
	)
);

//video intro checkbox desc
$psychoedittherapistinfo->addText(
	$prefix.'videointro_checkbox_desc_2',
	array(
		'name' => esc_html__('Videointro checkbox desc', 'realgh'),
		'group' => 'end'
	)
);

 //Finish Meta Box Declaration 
$psychoedittherapistinfo->Finish();

// psychoeditpricesinfo---------------------------------------------------------
$cfg_psychoeditpricesinfo = array(
	'id'              => 'realgh_psychoeditpricesinfo',          // meta box id, unique per meta box
	'title'           => esc_html__('Psycho edit prices info', 'realgh'),   // meta box title
	'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	'page_name'       => 'template-edit-account.php',  // if single = true. Name of page for which to output metaboxes
	'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	'priority'        => 'high',            // order of meta box: high (default), low; optional
	'fields'          => array(),            // list of meta fields (can be added by field arrays)
	'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);
 
/*
	* Initiate your meta box
*/
$psychoeditpricesinfo=  new AT_Meta_Box($cfg_psychoeditpricesinfo);


//main title
$psychoeditpricesinfo->addText(
	$prefix.'prices_info_main_title', array( 'name' => esc_html__('Main title', 'realgh'),
	   ) 
);


//prices label text
$psychoeditpricesinfo->addText(
	$prefix.'form_prices_label_text_1',
	array(
		'name' => esc_html__('Prices label text', 'realgh'),
		'group' => 'start')
);
//prices label placeholder
$psychoeditpricesinfo->addText(
	$prefix.'form_prices_label_text_placeholder_1',
	array(
		'name' => esc_html__('Prices label placeholder', 'realgh'),
		'group' => 'end')
);
//prices label text
$psychoeditpricesinfo->addText(
	$prefix.'form_prices_label_text_2',
	array(
		'name' => esc_html__('Prices label text', 'realgh'),
		'group' => 'start')
);
//prices label placeholder
$psychoeditpricesinfo->addText(
	$prefix.'form_prices_label_text_placeholder_2',
	array(
		'name' => esc_html__('Prices label placeholder', 'realgh'),
		'group' => 'end')
);
//prices label text
$psychoeditpricesinfo->addText(
	$prefix.'form_prices_label_text_3',
	array(
		'name' => esc_html__('Prices label text', 'realgh'),
		'group' => 'start')
);
//prices label placeholder
$psychoeditpricesinfo->addText(
	$prefix.'form_prices_label_text_placeholder_3',
	array(
		'name' => esc_html__('Prices label placeholder', 'realgh'),
		'group' => 'end')
);

 //Finish Meta Box Declaration 
 $psychoeditpricesinfo->Finish();


 // psychoeditprofilebutton---------------------------------------------------------
$cfg_psychoeditprofilebutton = array(
	'id'              => 'realgh_psychoeditprofilebutton',          // meta box id, unique per meta box
	'title'           => esc_html__('Psycho edit profile button', 'realgh'),   // meta box title
	'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
	'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
	'page_name'       => 'template-edit-account.php',  // if single = true. Name of page for which to output metaboxes
	'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
	'priority'        => 'high',            // order of meta box: high (default), low; optional
	'fields'          => array(),            // list of meta fields (can be added by field arrays)
	'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
	'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
 );
 
 /*
	* Initiate your meta box
  */
  $psychoeditprofilebutton=  new AT_Meta_Box($cfg_psychoeditprofilebutton);

//cancel button link text
$psychoeditprofilebutton->addText(
	$prefix.'cancel_link_text',
	array(
		'name' => esc_html__('Cancel link text', 'realgh'),
		'group' => 'start')
);

// //save button link text
$psychoeditprofilebutton->addText(
	$prefix.'save_link_text',
	array(
		'name' => esc_html__('Save Link text', 'realgh'),
		'group' => 'end')
);

 /*
   * Don't Forget to Close up the meta box Declaration 
 */

//Finish Meta Box Declaration 
$psychoeditprofilebutton->Finish();

}



