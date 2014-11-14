<?php
/**
 * Masonry Theme Customizer
 *
 * @package Masonry
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function masonry_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	/*
	 * Masonry custom settings
	 */
	
	// Masonry theme option section
	$wp_customize->add_section(
        'masonry_theme_options',
        array(
            'title'		=> __( 'Masonry Theme Options', 'masonry' ),
            'priority' 	=> 1000,
        )
    );
	
	// Masonry hide homepage title setting
	$wp_customize->add_setting(
	    'hide_homepage_title',
	    array(
	        'default' 			=> false,
	        'sanitize_callback' => 'masonry_sanitize_checkbox'
	    )
	);
	
	// Masonry hide homepage title control
	$wp_customize->add_control(
	    'hide_homepage_title',
	    array(
	        'label' 	=> __( 'Hide Homepage title?', 'masonry' ),
	        'description'	=> __( 'This option will hide homepage title if you have static front page', 'masonry' ),
	        'section' 	=> 'masonry_theme_options',
	        'type' 		=> 'checkbox',
	    )
	);
	
}
add_action( 'customize_register', 'masonry_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function masonry_customize_preview_js() {
	wp_enqueue_script( 'masonry_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), null, true );
}
add_action( 'customize_preview_init', 'masonry_customize_preview_js' );


/*
 * Customizer Sanitization functions
 */
 
// Checkbox sanitize
function masonry_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}