<?php
/**
 * Masonry functions and definitions
 *
 * @package Masonry
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 940; /* pixels */
}

if ( ! function_exists( 'masonry_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function masonry_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Masonry, use a find and replace
	 * to change 'masonry' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'masonry', get_template_directory() . '/languages' );
	
	// Masonry styles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/editor-style.css', masonry_font_url() ) );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This feature allows themes to add document title tag to HTML <head>.
	 * @see https://codex.wordpress.org/Title_Tag
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true ) /* Standard posts */;
	add_image_size( 'masonry-home', '300', '300', true ) /* Home only */;
	add_image_size( 'masonry-single', '960', '9999', false ) /* Single pages */ ;


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary', 'masonry' ),
		'social'  => __( 'Social', 'masonry' ),
		'footer'  => __( 'Footer', 'masonry' ),
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'masonry_custom_background_args', array(
		'default-color' => 'f2f2f2',
		'default-image' => '',
	) ) );
}
endif; // masonry_setup
add_action( 'after_setup_theme', 'masonry_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function masonry_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'masonry' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<p class="widget-title">',
		'after_title'   => '</p>',
	) );
}
add_action( 'widgets_init', 'masonry_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function masonry_scripts() {
	
    // Parent theme style.	
	wp_enqueue_style( 'masonry-style', get_stylesheet_uri(), array(), '1.0.0' );
	
	// Google fonts
	wp_enqueue_style( 'masonry-maven', masonry_font_url(), array(), '1.0.0' );
	
    // Typicons style.	
	wp_enqueue_style( 'masonry-typicons', get_template_directory_uri() . '/css/typicons.css', array(), '2.0.6' );

	// Enqueue masonry	
	wp_enqueue_script( 'masonry');
		
    wp_enqueue_script( 'masonry-helpers', get_template_directory_uri() . '/js/helpers.js', array(), '1.0.0', true );

	wp_enqueue_script( 'masonry-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '1.0.0', true );

	wp_enqueue_script( 'masonry-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'masonry_scripts' );

/**
 * Register Maven font.
 *
 */
function masonry_font_url() {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Maven, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Maven font: on or off', 'masonry' ) ) {
		$font_url = add_query_arg( 'family', urlencode( 'Rozha One|Roboto Slab:&subset=latin,latin-ext' ), '//fonts.googleapis.com/css' );
	}

	return $font_url;
}

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 *
 */
function masonry_admin_fonts() {
	wp_enqueue_style( 'masonry-maven', masonry_font_url(), array(), '1.0.0' );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'masonry_admin_fonts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
