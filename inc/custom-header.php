<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...

	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>

 *
 * @package Masonry
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses masonry_header_style()
 * @uses masonry_admin_header_style()
 * @uses masonry_admin_header_image()
 */
function masonry_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'masonry_custom_header_args', array(
		'default-image'          => '%s/images/default-image.jpg',
		'default-text-color'     => 'ffffff',
		'width'                  => 1900,
		'height'                 => 300,
		'flex-height'            => true,
		'wp-head-callback'       => 'masonry_header_style',
		'admin-head-callback'    => 'masonry_admin_header_style',
		'admin-preview-callback' => 'masonry_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'masonry_custom_header_setup' );

if ( ! function_exists( 'masonry_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see masonry_custom_header_setup().
 */
function masonry_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>  
		.site-title a,
		.site-description {
			color: #<?php echo $header_text_color; ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // masonry_header_style

if ( ! function_exists( 'masonry_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see masonry_custom_header_setup().
 */
function masonry_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
        
		#headimg h1 {
            font-family: 'Rozha One', serif;
            font-size: 75px;
            letter-spacing: 2px;
            margin: 0;
            text-align: center;
            width: 100%;
		}
        
		#headimg h1 a {
            color: #fff;
            position: relative;
            text-decoration: none;
            top: 30px;
            z-index: 1;
		}
        
		#desc {
            color: #fff;
            font-size: 12px;
            letter-spacing: 2px;
            position: relative;
            text-align: center;
            top: 50px;
            width: 100%;
            z-index: 2;
		}
        
        #headimg {
            background-color: rgba(0, 0, 0, .9);
            z-index: -1;
        }
        
		#headimg img {
            height: auto;
            margin: -112px 0 -10px 0;
            max-width: 100%;
            opacity: 0.4;
            z-index: -2;
		}
	</style>
<?php
}
endif; // masonry_admin_header_style

if ( ! function_exists( 'masonry_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see masonry_custom_header_setup().
 */
function masonry_admin_header_image() {
	$style = sprintf( ' style="color:#%s;"', get_header_textcolor() );
?>
	<div id="headimg">
		<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div class="displaying-header-text" id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
	</div>
<?php
}
endif; // masonry_admin_header_image