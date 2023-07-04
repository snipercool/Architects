<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package architects
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="mt-8 mb-9 pt-9 px-10">
			<h1><?php echo get_the_title(); ?></h1>
		</div>
		<?php echo the_content(); ?>
	</main><!-- #main -->

<?php
get_footer();
