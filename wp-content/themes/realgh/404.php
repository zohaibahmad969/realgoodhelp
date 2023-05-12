<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package realgh
 */

get_header();
?>

<main class="main js-padding">
	<div class="wrapper">
		<section class="section page-404">
			<div class="page-404__content">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/404/404.svg" alt="404" class="img page-404__img">
				<h1 class="title">Page Not Found</h1>
				<p class="text">You can search for the page you want here or return to the homepage</p>
			</div>
			<a href="/" class="link button main-button button--big">
				<span class="button-text">go home</span>
			</a>
		</section>
	</div>
</main>

<?php
get_footer();
