<?php
/*
 * SMTP Setting to send the mail
*/

add_action( 'phpmailer_init', 'realgh_send_smtp_email' );
function realgh_send_smtp_email( $phpmailer ) {
   $phpmailer->isSMTP();
   $phpmailer->Host       = SMTP_HOST;
   $phpmailer->SMTPAuth   = SMTP_AUTH;
   $phpmailer->Port       = SMTP_PORT;
   $phpmailer->Username   = SMTP_USER;
   $phpmailer->Password   = SMTP_PASS;
   $phpmailer->SMTPSecure = SMTP_SECURE;
   $phpmailer->From       = SMTP_FROM;
}