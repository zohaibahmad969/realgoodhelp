<?php

/*
 * Custom email template
*/

function email_template($title, $message, $img) {
	global $rlgh_data;

	$site_url = get_site_url();
	$logo_url = $rlgh_data['email_logo']['url'];

	$message = explode(PHP_EOL, $message);
	$message = array_filter($message);

	$regards = nl2br($rlgh_data['email_regards']);


	$mail_body = <<<HTML
<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>RGH Email</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@600;700&display=swap" rel="stylesheet">
	<style>
		body {
			width: 100% !important;
			-webkit-text-size-adjust: 100%;
			-ms-text-size-adjust: 100%;
			margin: 0;
			padding: 0;
			font-size: 15px;
			line-height: 130%;
			color: #494957;
		}
		[style*="Raleway"] {font-family: 'Raleway', arial, sans-serif !important;}
		img {
			width: 100%;
			height: auto;
			max-width: 100%!important;
			display: block;
			outline: none;
			text-decoration: none;
			border:none;
			-ms-interpolation-mode: bicubic;
			margin: 0;
			padding: 0;
		}
    
		table td {
			border-collapse: collapse;
		}
		table {
			border-collapse: collapse;
			mso-table-lspace: 0pt;
			mso-table-rspace: 0pt;
		}
		a {
			color: #3686F5;
			text-decoration: none;
		}
		.table-640 {
			width: 100%;
			max-width: 640px;
		}
		.table-540 {
			width: 90%;
			max-width: 540px;
		}
		.social td {
			padding-left: 40px;
		}
		.title {
			font-size: 24px;
			line-height: 130%;
			font-weight: 700;
			color: #121A26;
		}
		.list {
			color: #121A26;
			padding-left: 8px;
		}

		@media (max-width: 550px) {
			body {
				font-size: 14px;
			}
			.logo {
				width: 84px !important;
			}
			.title {
				font-size: 18px;
			}
			.social td {
				padding-left: 20px;
			}
		}
	</style>
</head>
<body style="margin: 0; padding: 0;">
	<table cellpadding="0" cellspacing="0" width="100%" bgcolor="#ededed">
		<tr>
			<td>
				<table cellpadding="0" cellspacing="0" align="center" bgcolor="#ffffff" class="table-640">
					<thead>
						<tr>
							<th style="padding-top: 9px; padding-bottom: 9px;">
								<table cellpadding="0" cellspacing="0" align="center" class="table-540">
									<tr>
										<td align="left" width="106" class="logo">
											<a href="$site_url"><img src="$logo_url" /></a>
										</td>
										<td align="right" class="social">
											<table cellpadding="0" cellspacing="0">
												<tr>
HTML;

											for ($i = 0; $i < count($rlgh_data['social_icon']); $i++):
												$social_link = $rlgh_data['social_link'][$i];
												$social_img = $rlgh_data['mail_' . $rlgh_data['social_icon'][$i]]['url'];

$mail_body .= <<<HTML
													<td width="24">
														<a href="$social_link">
															<img src="$social_img"/>
														</a>
													</td>
HTML;

											endfor;

$mail_body .= <<<HTML
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="padding-top: 25px; padding-bottom: 50px;">
								<table cellpadding="0" cellspacing="0" align="center" class="table-540">
									<tr>
										<td>
											<table cellpadding="0" cellspacing="0">
												<tr>
													<td style="font-family: Arial, Helvetica, sans-serif, Raleway; padding-bottom: 24px;" class="title">{$title}</td>
												</tr>
HTML;

										foreach ($message as $row):
											$row = do_shortcode($row);

$mail_body .= <<<HTML
												<tr>
													<td style="font-family: Arial, Helvetica, sans-serif, Raleway; padding-bottom: 24px;">
														$row
													</td>
												</tr>
HTML;

										endforeach;

$mail_body .= <<<HTML
												<tr>
													<td style="font-family: Arial, Helvetica, sans-serif, Raleway;">$regards</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td style="padding-bottom: 50px;">
								<table cellpadding="0" cellspacing="0" align="center" class="table-540">
									<tr>
										<td><img src="$img" alt="Illustration"></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>

HTML;

 return $mail_body;
}