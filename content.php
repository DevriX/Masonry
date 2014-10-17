<?php
/**
 * @package Masonry
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
    <div class="entry-thumbnail">
        <a href="<?php the_permalink(); ?>" rel="bookmark">
             <?php the_post_thumbnail( 'masonry-home' ); ?>
        </a>
    </div><!-- .entry-thumbnail -->
    <?php else: ?>
    
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php masonry_posted_on(); ?>
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
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'masonry' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'masonry' ) );
				if ( $categories_list && masonry_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'masonry' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'masonry' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'masonry' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'masonry' ), __( '1 Comment', 'masonry' ), __( '% Comments', 'masonry' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'masonry' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
    <?php endif; ?>
</article><!-- #post-## -->