<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Masonry
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function masonry_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
	    'type'           => 'scroll',
	    'container'      => 'content',
	    'footer'		=> 'page'
	) );
	
	/**
	 * Add theme support for Responsive Videos.
	 */
	add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'masonry_jetpack_setup' );