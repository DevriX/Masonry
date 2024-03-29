<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Masonry
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

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
						// $categories_list generates a warning but cannot be escaped - it's a link
						// translators: outputs the post categories
						esc_html__( 'Posted in %1$s', 'masonry' ),
						$categories_list
					);
				?>
			</span>
		<?php endif; // End if categories ?>

			<?php
				// translators: outputs the post tags
				$tags_list = get_the_tag_list( '', __( ', ', 'masonry' ) );
			if ( $tags_list ) :
				?>
			<span class="tags-links">
				<?php
				printf(
					// $tags_list generates a warning but cannot be escaped - it's a link
					// translators: list of the post's tags
					esc_html__( 'Tagged %1$s', 'masonry' ),
					$tags_list
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
</article><!-- #post-## -->
