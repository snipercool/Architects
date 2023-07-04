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
	<footer id="footer" class="footer bg-creme mt-12 px-10" area-label="footer">
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
