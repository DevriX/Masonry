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
}
add_action( 'customize_register', 'masonry_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function masonry_customize_preview_js() {
	wp_enqueue_script( 'masonry_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '1.0.0', true );
}
add_action( 'customize_preview_init', 'masonry_customize_preview_js' );


add_action( 'admin_init', 'masonry_theme_options_init' );
/**
 * Init plugin options to white list our options
 */
function masonry_theme_options_init() {
	register_setting( 'masonry_theme_options', 'masonry_theme_options', 'masonry_theme_options_validate' );
}

function masonry_theme_options_validate( $input ) {
	return $input;
}

/**
 * Add Masonry Theme Options in Customizer.
 */
function masonry_customizer_options( $wp_customize ) {

	$wp_customize->add_section(
		'masonry_options',
		array(
			'title'       => __( 'Masonry Options', 'masonry' ),
			'description' => __( 'Masonry Theme Options', 'masonry' ),
			'priority'    => 500,
		)
	);

	$wp_customize->add_setting(
		'masonry_theme_options[hide_homepage_title]',
		array(
			'sanitize_callback' => 'wp_filter_post_kses',
			'type'              => 'option',
		)
	);

	$wp_customize->add_control(
		'masonry_theme_options[hide_homepage_title]',
		array(
			'label'   => __( 'Hide homepage title?', 'masonry' ),
			'section' => 'masonry_options',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'masonry_theme_options[last_updated_on]',
		array(
			'sanitize_callback' => 'wp_filter_post_kses',
			'type'              => 'option',
		)
	);

	$wp_customize->add_control(
		'masonry_theme_options[last_updated_on]',
		array(
			'label'   => __( 'Show last modified date?', 'masonry' ),
			'section' => 'masonry_options',
			'type'    => 'checkbox',
		)
	);

}
add_action( 'customize_register', 'masonry_customizer_options' );
