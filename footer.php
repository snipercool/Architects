<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package architects
 */

?>
	<div id="contact-modal" class="hidden">
			<div class="modal-overlay absolute"></div>
			<div class="modal-content absolute">
				<div class="relative">
					<div class="modal-close-btn absolute mt-1 mr-1 right-0">
						<svg fill="none" viewBox="0 0 24 24" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
							<path xmlns="http://www.w3.org/2000/svg" d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z" fill="#0D0D0D"></path>
						</svg>
					</div>
					<div class="form px-2 py-2">
					<?php echo do_shortcode('[formidable id=5]'); ?>
					</div>
				</div>
			</div>
		</div>
	<footer id="footer" class="footer bg-creme mt-12 px-10-lg" area-label="footer">
		<div class="my-5 bg-creme flex space-between">
			<?php wp_nav_menu( array( 'menu' => 'footer' ) );?>
			<div class="info">
				<?php echo get_field('footer_street', 'options') ?>
				<a class="link block" href="tel:<?php echo get_field('phone_number', 'options') ?>"><?php echo get_field('phone_number', 'options') ?></a>
				<a class="link block" href="mailto:<?php echo get_field('footer_email', 'options') ?>"><?php echo get_field('footer_email', 'options') ?></a>
			</div>
		</div>
		<div class="my-5 bg-creme flex space-between">
			<div class="text-black">
				<p class="fs-1"><?php echo get_field('btw_number', 'options') ?></p>
				<p class="fs-1">&copy; <?php echo the_date('Y'); ?> Architects. All rights reserved.</p>
			</div>
			<div class="text-black socials">
				<p class="fs-1">Powered by <a href="http://nicolasvh.be" target="_blank" rel="noopener noreferrer">Nicolasvh</a></p>
				<p class="fs-1">&copy; <?php echo the_date('Y'); ?> Architects. All rights reserved.</p>
			</div>
		</div>
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
</body>
</html>
