<?php

add_action('wp_ajax_support', 'realgh_send_support');
add_action('wp_ajax_nopriv_support', 'realgh_send_support');
function realgh_send_support() {
	global $rlgh_data;

	$mailBody = '<p><strong>Subject:</strong> ' . $_POST['subject'] . '</p>';
	if ($_POST['user_id']) $mailBody .= '<p><strong>User id:</strong> ' . $_POST['user_id'] . '</p>';
	$mailBody .= '<p><strong>Email:</strong> ' . $_POST['email'] . '</p>';
	$mailBody .= '<p><strong>Description:</strong> ' . $_POST['desc'] . '</p>';

	$headers = array(
		'From: RealGoodHelp Admin <' . SMTP_FROM . '>',
		'content-type: text/html'
	);

	/*
	 * Upload files
	*/
	$file = $_FILES['file'];
	// realgh_array_flatten() - converts multi-dimensional array to a flat array
	$names = realgh_array_flatten( $file['name'] );
	$tmp_names = realgh_array_flatten( $file['tmp_name'] );

	$uploads = wp_get_upload_dir()['basedir'];
	$uploads_dir = path_join( $uploads, 'rlgh_uploads' );

	$uploaded_files = array();

	foreach ( $names as $key => $filename ) {
		$tmp_name = $tmp_names[$key];

		if ( empty( $tmp_name ) or ! is_uploaded_file( $tmp_name ) ) {
			continue;
		}

		// realgh_antiscript_file_name() - converts a file name to one that is not executable as a script
		$filename = realgh_antiscript_file_name( $filename );

		$filename = wp_unique_filename( $uploads_dir, $filename );
		$new_file = path_join( $uploads_dir, $filename );

		if ( false === @move_uploaded_file( $tmp_name, $new_file ) ) {
			wp_send_json_error( json_encode( array('message' => 'Upload error') ) );
			return;
		}

		// Make sure the uploaded file is only readable for the owner process
		chmod( $new_file, 0400 );

		$uploaded_files[] = $new_file;
	}

	/*
	 * Send mail
	*/
	$result = wp_mail( $rlgh_data['mail_to'], $_POST['topic'], $mailBody, $headers, $uploaded_files );

	// Deletes sent files as they are on the email
	foreach ( $uploaded_files as $filepath ) {
		wp_delete_file( $filepath );
	}

	if ($result) {
		wp_send_json_success();
	}
	else {
		wp_send_json_error();
	}
}