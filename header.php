<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Masonry
 */

?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'masonry' ); ?></a>

	<?php if ( get_header_image() ) : ?>
		<header id="masthead" class="site-header" role="banner" style="background-image: url('<?php header_image(); ?>')">
	<?php else : ?>
		<header id="masthead" class="site-header" role="banner">
	<?php endif; // End header image check. ?>

		<div class="site-banner">

			<div class="site-branding">

				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<p class="site-description"><?php bloginfo( 'description' ); ?></p>

				<?php if ( has_nav_menu( 'social' ) ) : ?>
				<div class="social-menu">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'social',
							'depth'          => '1',
							'link_before'    => '<span class="screen-reader-text">',
							'link_after'     => '</span>',
						)
					);
					?>
				</div><!-- .social-menu -->       
				<?php endif; ?>
			</div>

		</div><!-- .site-banner -->
		<a id="simple-menu" class="menu-button" href="#sidr">
			<span class="icon"><span class="menu-text"><?php esc_html_e( 'Menu', 'masonry' ); ?></span><span>
		</a>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
				)
			);
			?>

			<?php get_sidebar(); ?>
		</nav><!-- #site-navigation -->
		<div class="header-overlay"></div><!-- .header-overlay -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
