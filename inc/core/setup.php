<?php
/**
 * Theme Setup and Basic Configuration
 */

if ( ! function_exists( 'mds_pro_setup' ) ) :
	function mds_pro_setup() {
		// Make theme available for translation.
		load_theme_textdomain( 'mundialdesalsa-pro', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Set default thumbnail sizes
		set_post_thumbnail_size( 1200, 9999 );
		add_image_size( 'mds-pro-grid', 600, 400, true );
		add_image_size( 'mds-pro-list', 300, 200, true );
		add_image_size( 'mds-pro-hero', 1600, 900, true );

		// Register Menus
		register_nav_menus( [
			'main-menu'   => esc_html__( 'Main Menu', 'mundialdesalsa-pro' ),
			'top-menu'    => esc_html__( 'Top Bar Menu', 'mundialdesalsa-pro' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'mundialdesalsa-pro' ),
			'mobile-menu' => esc_html__( 'Mobile Menu', 'mundialdesalsa-pro' ),
		] );

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', [
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		] );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for core custom logo.
		add_theme_support( 'custom-logo', [
			'height'      => 250,
			'width'       => 600,
			'flex-width'  => true,
			'flex-height' => true,
		] );
	}
endif;
add_action( 'after_setup_theme', 'mds_pro_setup' );
