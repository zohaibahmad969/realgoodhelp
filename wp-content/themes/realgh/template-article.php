<?php 
/*
* Template name: Template Article
*/

get_header();
?>

<main class="main js-padding">
	<div class="wrapper wrapper--small">
		<article class="article section">
			<?php the_content(); ?>
		</article>
	</div>
</main>

<?php get_footer(); ?>