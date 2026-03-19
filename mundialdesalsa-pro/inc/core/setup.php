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

    // Custom Image Sizes
    add_image_size( 'mds-pro-magazine', 800, 600, true );
    add_image_size( 'mds-pro-hero', 1200, 800, true );
    add_image_size( 'mds-pro-thumbnail', 400, 300, true );
}
add_action( 'after_setup_theme', 'mds_pro_setup' );

/**
 * Enable WebP Support
 */
function mds_pro_upload_mimes( $mimes ) {
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter( 'upload_mimes', 'mds_pro_upload_mimes' );

/**
 * Display WebP in Media Library
 */
function mds_pro_file_is_displayable_image( $result, $path ) {
    if ( $result === false ) {
        $displayable_image_types = array( IMAGETYPE_WEBP );
        $info = @getimagesize( $path );
        if ( empty( $info ) ) {
            $result = false;
        } elseif ( in_array( $info[2], $displayable_image_types ) ) {
            $result = true;
        }
    }
    return $result;
}
add_filter( 'file_is_displayable_image', 'mds_pro_file_is_displayable_image', 10, 2 );
