<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Masonry
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<p class="page-title">
					<?php
					if ( is_category() ) :
						single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							// translators: Outputs the post author
							printf( esc_attr__( 'Author: %s', 'masonry' ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							// translators: Outputs the day of publishing
							printf( esc_attr__( 'Day: %s', 'masonry' ), '<span>' . get_the_date() . '</span>' );
						elseif ( is_month() ) :
							// translators: Outputs the month of publishing
							printf( esc_attr__( 'Month: %s', 'masonry' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'masonry' ) ) . '</span>' );
						elseif ( is_year() ) :
							// translators: Outputs the year of publishing
							printf( esc_attr__( 'Year: %s', 'masonry' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'masonry' ) ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							esc_html_e( 'Asides', 'masonry' );

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							esc_html_e( 'Galleries', 'masonry' );

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							esc_html_e( 'Images', 'masonry' );

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							esc_html_e( 'Videos', 'masonry' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							esc_html_e( 'Quotes', 'masonry' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							esc_html_e( 'Links', 'masonry' );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							esc_html_e( 'Statuses', 'masonry' );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							esc_html_e( 'Audios', 'masonry' );

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							esc_html_e( 'Chats', 'masonry' );

						else :
							esc_html_e( 'Archives', 'masonry' );

						endif;
						?>
				</p>
				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( esc_html( '<div class="taxonomy-description">%s</div>' ), esc_html( $term_description ) );
					endif;
				?>
			</header><!-- .page-header -->

			<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();
					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );

				?>

			<?php endwhile; ?>

			<?php masonry_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer(); ?>
