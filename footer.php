<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Masonry
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">

		<div class="site-info">

		<?php if ( has_nav_menu( 'footer' ) ) : ?>

			<?php
			wp_nav_menu(
				array(
					'fallback_cb'     => false,
					'container_class' => 'footer-navigation',
					'theme_location'  => 'footer',
				)
			);
			?>

			<?php endif; ?>

		<div class="site-credits">
			<?php
			printf(
				// translators: themen name and creator (company)
				esc_html__( 'Theme: %1$s by %2$s.', 'masonry' ),
				'Masonry',
				'<a esc_url( href="http://devrix.com/themes/masonry/ )" title="Masonry WordPress Theme" rel="designer">DevriX</a>'
			);
			?>
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'masonry' ) ); ?>">
				<?php
				printf(
					// translators: WordPress power
					esc_html__( 'Proudly powered by %s', 'masonry' ),
					'WordPress'
				);
				?>

			</a>
		</div><!-- .site-credits --> 

		</div><!-- .site-info -->

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
