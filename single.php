<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package architects
 */

get_header();
$terms = wp_get_post_terms( $post->ID, 'project_category' );
$appsTotal = '';
if ($terms[0]->slug == 'appartementen'){
	$appsTotal .= '<p class="fs-4 mb-3">';
	$total = get_field('proj_total');
	$sold = get_field('proj_sold');
	$percentage = round($sold / $total * 100);
	$appsTotal .= 'Al '.$percentage.'% verkocht';
	$appsTotal .= '</p>';
};
?>
<div class="relative inset-0 z-0">
	<div class="bg-white h-70 w-full ">
    	<div class="h-70 w-full bg-cover bg-p-c flex align-center" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>)">
    		<div class="container text-left px-10">
				<h1 class="fs-8<?php echo (get_field('proj_title_color'))?' text-black' : ' text-white' ?> font-medium mb-2"><?php the_title() ?></h1>
				<?php echo $appsTotal; ?>
				<a href="#" class="button button-secondary arrowed button-modal">Maak een afspraak</a>
			</div>
    	</div>
	</div>
</div>
	<main id="primary" class="site-main">
		<div class="grid project-info px-10 my-9 mx-auto container">
			<div class="info">
				<h2 class="mb-5">Inleiding:</h2>
				<?php echo get_field('inleiding_text') ?>
			</div>
			<?php if(get_field('proj_price')): ?>
				<div class="card px-2 py-2 grid-start-7" data-aos="fade-up">
					<h3 class="fs-2">Aankoopprijs<?php echo ($terms[0]->slug == 'appartementen' || $terms[0]->slug == 'studios' )?' vanaf' : ''; ?>: </h3>
					<p class="fs-5 fw-b">€ <?php echo get_field('proj_price'); ?></p>
				</div>
			<?php endif;?>
			<?php if(get_field('proj_location')): ?>
				<div class="card px-2 py-2" data-aos="fade-up">
					<h3 class="fs-2">Locatie: </h3>
					<p class="fs-5 fw-b"><?php echo get_field('proj_location'); ?></p>
				</div>
			<?php endif;?>
			<?php if(get_field('proj_oppervlakte')): ?>
				<div class="card px-2 py-2 grid-start-7" data-aos="fade-up">
					<h3 class="fs-2">Oppervlakte: </h3>
					<p class="fs-5 fw-b"><?php echo get_field('proj_oppervlakte'); ?>m²</p>
				</div>
			<?php endif;?>
			<?php if(get_field('proj_rooms')): ?>
				<div class="card px-2 py-2" data-aos="fade-up">
					<h3 class="fs-2">Aantal slaapkamers: </h3>
					<p class="fs-5 fw-b"><?php echo get_field('proj_rooms'); ?></p>
				</div>
			<?php endif;?>
			<?php if(get_field('proj_total')): ?>
				<div class="card px-2 py-2" data-aos="fade-up">
					<h3 class="fs-2">Aantal <?php echo ($terms[0]->slug == 'appartementen')?' Appartementen' : ''; ?><?php echo ($terms[0]->slug == 'studios')?' studio\'s' : ''; ?>: </h3>
					<p class="fs-5 fw-b"><?php echo get_field('proj_total'); ?></p>
				</div>
			<?php endif;?>
		</div>
		<?php the_content(); ?>
		<?php 
		$gallery = get_field('proj_gallerij');
		if($gallery): ?>
		<div class="project-gallery px-10 mb-6 container mx-auto">
          <div class="project-image" data-aos="fade-up">
            <img class="active" src="<?php echo $gallery[0]; ?>">
          </div>
          <ul class="project-image-list grid my-2">
			<?php foreach ($gallery as $image) : ?>
            <li class="image-item" data-aos="fade-up"><img src="<?php echo $image; ?>"></li>
			<?php endforeach; ?>
          </ul>
        </div>
		<?php endif; ?>
		<div id="modal" class="hidden">
			<div class="modal-overlay absolute"></div>
			<div class="modal-content absolute">
				<div class="relative">
					<div class="modal-close-btn absolute mt-1 mr-1 right-0">
						<svg fill="none" viewBox="0 0 24 24" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
							<path xmlns="http://www.w3.org/2000/svg" d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z" fill="#0D0D0D"></path>
						</svg>
					</div>
					<div class="form px-2 py-2">
					<?php 
					switch ($terms[0]->slug) {
						case 'appartementen':
							echo do_shortcode('[formidable id=1]');
							break;
						case 'studios':
							echo do_shortcode('[formidable id=3]');
							break;
						case 'parkings':
							echo do_shortcode('[formidable id=4]');
							break;
						default:
							echo do_shortcode('[formidable id=2]');
							break;
					}?>
					</div>
				</div>
			</div>
		</div>
		<?php $title = get_the_title();
			switch ($terms[0]->slug) {
				case 'appartementen':
					$form_field = '#field_exx46';
					break;
				case 'studios':
					$form_field = '#field_exx463';
					break;
				case 'parkings':
					$form_field = '#field_exx4632';
					break;
				default:
					$form_field = '#field_exx462';
					break;
			}?>
		<script>
            // Set the selected option of the select field to the value of $default_subject
			
            jQuery(document).ready(function($) {
                $('<?php echo $form_field ?>').val('<?php echo $title ?>');
            });
        </script>
		
	</main><!-- #main -->

<?php
get_footer();
