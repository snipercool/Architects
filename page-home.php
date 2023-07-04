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
$terms    = get_terms(['taxonomy' => 'project_category', 'hide_empty' => false]);
?>
<div class="relative inset-0 z-0">
	<?php if($terms): ?>
		<div id="home-slider" class="bg-white h-full w-full ">
		<?php foreach ($terms as $term):?>
      <div class="h-full w-full bg-cover flex align-center" style="background-image: url(<?php echo get_field('category_image', $term->taxonomy . '_' . $term->term_id); ?>)">
      	<div class="container<?php echo (get_field('home_title_color', $term->taxonomy . '_' . $term->term_id))? ' text-black' : ' text-white'; ?> text-left mx-10">
			<h1 class="text-5xl font-medium mb-9"><?php echo get_field('home_title', $term->taxonomy . '_' . $term->term_id); ?></h1>
			<a href="/projecten/?category=<?php echo $term->slug; ?>" class="button button-secondary arrowed">Bekijk <?php echo $term->name ?></a>
		</div>
      </div>
	<?php endforeach; ?>
	</div>
	<?php endif; ?>
</div>
<main id="primary" class="site-main">
<?php 
$args = array(
	'post_type' => 'projecten',
	'posts_per_page' => 6,
	'meta_query' => array(
	  array(
		'key' => 'display_on_homepage',
		'value' => true,
	  ),
	),
  );
  
  $query = new WP_Query($args);
  if ($query->have_posts()) :
  $counter = 1;
?>
<div class="mx-auto grid grid-projects grid-cols-3 grid-rows-3 gap-2 px-10 mt-11 mb-4">
	<?php while ($query->have_posts()) : $query->the_post(); 
	$terms = wp_get_post_terms( get_the_ID(), 'project_category' );
	$project_classes = 'project';
	if ($counter === 1) {
            $project_classes .= ' big';
        } ?>
	<div class="<?php echo $project_classes; ?>">
		<h2 class="text-right"><?php echo the_title() ?><br><span class="price"><?php echo ($terms[0]->slug == 'appartementen' || $terms[0]->slug == 'parkings' )?'vanaf:' : ''; ?> € <?php echo get_field('proj_price') ?></span></h2>
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
<?php endif; ?>
	<?php echo the_content(); ?>
</main><!-- #main -->

<?php
get_footer();
