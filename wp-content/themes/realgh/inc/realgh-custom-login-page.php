<?php
/*
 * Customize login page
*/

function realgh_enqueue_styles() {
	global $rlgh_data;
	?>
	<style  type="text/css">
		#login h1 a {
			background-image: url(<?php echo $rlgh_data['logo']['url']; ?>);
			height: 80px;
    		width: auto;
    		background-size: contain;
		}
	</style>

	<?php
}
add_action( 'login_enqueue_scripts', 'realgh_enqueue_styles' );

function realgh_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'realgh_login_logo_url' );
  
function realgh_login_logo_url_title() {
    return 'RealGoodHelp';
}
add_filter( 'login_headertitle', 'realgh_login_logo_url_title' );