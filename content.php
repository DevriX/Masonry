<?php
/**
 * @package Masonry
 */

?>
<?php $masonry_options = get_option( 'masonry_theme_options' ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>

	<div class="entry-thumbnail">
		<a class="thumbnail" href="<?php the_permalink(); ?>" rel="bookmark" >
			<?php the_post_thumbnail( 'masonry-home' ); ?>
		</a>	

	</div><!-- .entry-thumbnail -->
	<div class="entry-thumbnail-title">
		<?php
			$post_title = the_title( '', '', false );
		if ( strlen( $post_title ) > 50 ) :
			echo esc_html( trim( substr( $post_title, 0, 50 ) ) . '...' );
					else :
						echo esc_html( $post_title );
					endif;
					?>

	</div>
	<?php else : ?>

	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php
			if ( ! empty( $masonry_options['last_updated_on'] ) ) {
				masonry_last_updated_on();
			} else {
				masonry_posted_on();
			}
			?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		if ( is_home() ) {
			// For home.php only
			the_excerpt();
		} else {
			// When not home.php
			the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'masonry' ) );
		}
		?>
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
		<?php if ( 'post' === get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'masonry' ) );
			if ( $categories_list && masonry_categorized_blog() ) :
				?>

			<span class="cat-links">
				<?php
				printf(
					// translators: category list
					esc_html__( 'Posted in %1$s', 'masonry' ),
					esc_attr( $categories_list )
				);
				?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'masonry' ) );
			if ( $tags_list ) :
				?>
			<span class="tags-links">
				<?php
				printf(
					// translators: tag list
					esc_html__( 'Tagged %1$s', 'masonry' ),
					esc_attr( $tags_list )
				);
				?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' !== get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'masonry' ), __( '1 Comment', 'masonry' ), __( '% Comments', 'masonry' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'masonry' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
