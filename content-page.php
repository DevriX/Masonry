<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Masonry
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		// it should be homepage and checkbox should be checked
		if ( is_front_page() ) {
			$hide_homepage_title = get_theme_mod( 'hide_homepage_title' );
			
			if ( empty ( $hide_homepage_title ) ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			}
		} else {
			the_title( '<h1 class="entry-title">', '</h1>' );
		}
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'masonry' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'masonry' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->