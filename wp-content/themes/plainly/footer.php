<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Plainly
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'plainly' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'plainly' ), 'WordPress' ); ?></a>
			<span class="sep"> &middot; </span>
			<?php printf( __( 'Theme: %1$s by %2$s', 'plainly' ), 'Plainly', '<a href="http://chris.ink/" rel="designer">Chris Rudzki</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
