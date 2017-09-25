<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Masonry
 */
?>
<?php $masonry_options = get_option( 'masonry_theme_options' ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		$class = 'entry-title';
		
		/* show title ( default -> hide homepage title checkbox is unchecked ) */
		if( ( is_home() || is_front_page() ) && ! empty( $masonry_options['hide_homepage_title'] ) ) {
			$class .= ' hidden';
		}
		
		the_title( '<h1 class="'.$class.'">', '</h1>' ); 
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