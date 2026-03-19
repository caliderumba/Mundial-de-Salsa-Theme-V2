<?php
/**
 * Theme Setup
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function mds_pro_setup() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title.
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support( 'post-thumbnails' );

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

    // Register Navigation Menus
    register_nav_menus( [
        'menu-1' => esc_html__( 'Primary Menu', 'mundialdesalsa-pro' ),
        'footer' => esc_html__( 'Footer Menu', 'mundialdesalsa-pro' ),
    ] );
}
add_action( 'after_setup_theme', 'mds_pro_setup' );
