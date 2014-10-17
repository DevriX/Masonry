<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Masonry
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function masonry_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'masonry_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function masonry_body_classes( $classes ) {
	// #1 Adds a class of no-posts to blogs with no posts.
	// #1 Adds a class of masonry only when home.php is used.
	// #3 Adds a class of group-blog to blogs with more than 1 published author.
    if ( ! have_posts () ) {
        $classes[] = 'no-posts';
    }
	
    if ( is_home () ) {
        $classes[] = 'masonry';
    }

    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    return $classes;
}
add_filter( 'body_class', 'masonry_body_classes' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function masonry_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'masonry' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'masonry_wp_title', 10, 2 );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function masonry_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'masonry_setup_author' );

/**
 * Masonry's excerpt length is set to 10 words.
 */
function masonry_excerpt_length( $length ) {
	return 10;
}
add_filter( 'excerpt_length', 'masonry_excerpt_length', 999 );

/**
 * Masonry is using "Read More" and [...] string in the excerpt.
 */
function masonry_excerpt_more( $more ) {
	return '<span class="more-dots"><a href="'. get_permalink( get_the_ID() ) . '">[ ... ]</span>' . '</a>';
}
add_filter( 'excerpt_more', 'masonry_excerpt_more' );