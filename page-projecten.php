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
$category = isset( $_GET['category'] ) ? $_GET['category'] : '';
$category_terms = get_terms( array(
	'taxonomy' => 'project_category',
	'hide_empty' => false,
	'parent' => 0
) );
?>

	<main id="primary" class="site-main">
		<div class="mt-8 mb-9 pt-9 px-10 container mx-auto">
			<h1><?php echo get_the_title(); ?></h1>
		</div>
		<?php if($category_terms):?>
			<div id="category_filter" class="bg-creme px-10 container mx-auto flex flex-wrap gap-2">
			<button class="button button-primary<?php echo ($category)? ' outlined': '' ?>">Alle</button>
			<?php foreach ($category_terms as $cat):?>
				<button id="<?php echo $cat->slug ?>" class="button button-primary<?php echo ($category == $cat->slug)? '': ' outlined' ?>"><?php echo $cat->name ?></button>
		<?php endforeach; ?>
		</div>
		<?php endif; ?>
		<?php 
					$args = array(
						'post_type'      => 'projecten',
						'posts_per_page' => -1,
						'order'          => 'ASC',
						'post_status'    => 'publish',
					);
					
					// Add category filter to the query if it is present
					if (!empty($category)) {
						$args['tax_query'] = array(
							array(
								'taxonomy' => 'project_category',
								'field'    => 'slug',
								'terms'    => $category,
							),
						);
					}
					
					$projects = new WP_Query($args);
					if ($projects->have_posts()) :  $counter = 1;?>
						<div id='grid-projects' class="mx-auto grid grid-projects grid-cols-3 grid-rows-3 gap-2 px-10 mt-9 mb-4">
							<?php while ($projects->have_posts()) : $projects->the_post(); 
								$project_classes = 'project';
								if ($counter === 1 || ($counter - 5) % 6 === 0 || ($counter - 7) % 6 === 0) {
										$project_classes .= ' big';
									} ?>
								<div class="<?php echo $project_classes; ?>" data-aos="fade-up">
									<h2><?php the_title() ?></h2>
									<p>Bekijk project</p>
									<div class="pic" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>)"></div>
									<a class="project-link" href="<?php echo the_permalink(); ?>"></a>
									<div class="arrow">
										<svg fill="none" viewBox="0 0 20 20" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
											<path xmlns="http://www.w3.org/2000/svg" d="M12.2929 5.29289C12.6834 4.90237 13.3166 4.90237 13.7071 5.29289L19.7071 11.2929C19.8946 11.4804 20 11.7348 20 12C20 12.2652 19.8946 12.5196 19.7071 12.7071L13.7071 18.7071C13.3166 19.0976 12.6834 19.0976 12.2929 18.7071C11.9024 18.3166 11.9024 17.6834 12.2929 17.2929L16.5858 13L5 13C4.44772 13 4 12.5523 4 12C4 11.4477 4.44772 11 5 11L16.5858 11L12.2929 6.70711C11.9024 6.31658 11.9024 5.68342 12.2929 5.29289Z" fill="#ffffff"></path>
										</svg>
									</div>
								</div>
							<?php $counter++; endwhile;
							wp_reset_postdata(); ?>
						</div>
					<?php else :
						echo '<div class="title mb-2"><h2>No cases found...</h2></div>';
					endif;
					?>
		<?php echo the_content(); ?>
	</main><!-- #main -->

<?php
get_footer();
