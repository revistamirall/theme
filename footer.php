<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Revista Mirall Premium
 */
?>
		</div><!-- #container -->
	</div><!-- #content -->
	<div class="footer-custom">
		<footer class="site-footer container" role="contentinfo">
			<div class="site-info text-center">
				<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'revista_mirall_premium' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'revista_mirall_premium' ), 'WordPress' ); ?></a>
				<span class="sep"> | </span>
				<?php printf( __( 'Theme: %1$s by %2$s.', 'revista_mirall_premium' ), 'revista_mirall_premium', '<a href="http://automattic.com/" rel="designer">Automattic</a>' ); ?>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div>

	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
