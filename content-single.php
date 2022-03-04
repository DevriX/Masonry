<?php
/**
 * @package Masonry
 */

?>
<?php $masonry_options = get_option( 'masonry_theme_options' ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail( 'masonry-single' ); ?>
		</div><!-- .entry-thumbnail -->
	<?php endif; ?>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php
				if ( ! empty( $masonry_options['last_updated_on'] ) ) {
					masonry_last_updated_on();
				} else {
					masonry_posted_on();
				}
			?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'masonry' ),
					'after'  => '</div>',
				)
			);
			?>
	</div><!-- .entry-content -->		

	<footer class="entry-footer">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'masonry' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'masonry' ) );

		if ( ! masonry_categorized_blog() ) {
			// This blog only has 1 category so we just need to worry about tags in the meta text
			if ( '' !== $tag_list ) {
				// translators: tag list and a link
				$meta_text = __( 'This entry was tagged %2$s.', 'masonry' );
			} else {
				// translators: just a link
				$meta_text = '';
			}
		} else {
			// But this blog has loads of categories so we should probably display them here
			if ( '' !== $tag_list ) {
				// translators: category and tag lists + link
				$meta_text = __( 'This entry was posted in %1$s and tagged %2$s.', 'masonry' );
			} else {
				// translators: just a category list + link
				$meta_text = __( 'This entry was posted in %1$s.', 'masonry' );
			}
		} // end check for categories on this blog

			// Not escaping $category_list and $tag_list because they are html values
			printf(
				esc_html( $meta_text ),
				$category_list,
				$tag_list
			);
			?>
			<?php esc_html_e( 'Bookmark the', 'masonry' ); ?>
			<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
				<?php esc_html_e( 'permalink.', 'masonry' ); ?>		
			</a>

		<?php edit_post_link( __( 'Edit', 'masonry' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
