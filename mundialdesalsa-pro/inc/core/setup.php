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
        'menu-1'      => esc_html__( 'Primary Menu', 'mundialdesalsa-pro' ),
        'footer-menu' => esc_html__( 'Footer Menu', 'mundialdesalsa-pro' ),
    ] );

    // Add support for Custom Logo
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

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

/**
 * Fix "Attempt to read property 'name' on false" in nav-menus.php
 * This happens when a menu item points to a missing term/post or invalid post type.
 */
function mds_pro_fix_nav_menu_warning( $items ) {
    if ( ! is_admin() || ! is_array( $items ) ) {
        return $items;
    }

    foreach ( $items as $key => $item ) {
        if ( ! isset( $item->type ) ) continue;

        if ( 'taxonomy' === $item->type ) {
            $tax = get_taxonomy( $item->object );
            if ( ! $tax ) {
                unset( $items[ $key ] );
                continue;
            }
            $term = get_term( $item->object_id, $item->object );
            if ( ! $term || is_wp_error( $term ) ) {
                unset( $items[ $key ] );
            }
        } elseif ( 'post_type' === $item->type ) {
            $pt = get_post_type_object( $item->object );
            if ( ! $pt ) {
                unset( $items[ $key ] );
                continue;
            }
            $post = get_post( $item->object_id );
            if ( ! $post && '0' != $item->object_id ) { // 0 might be a placeholder
                unset( $items[ $key ] );
            }
        }
    }

    return $items;
}
add_filter( 'wp_get_nav_menu_items', 'mds_pro_fix_nav_menu_warning', 10, 1 );

/**
 * Additional safeguard for nav menu item setup
 */
function mds_pro_setup_nav_menu_item_safeguard( $item ) {
    if ( ! is_admin() ) return $item;

    if ( isset( $item->type ) && 'post_type' === $item->type ) {
        if ( ! get_post_type_object( $item->object ) ) {
            $item->_invalid = true;
        }
    }
    if ( isset( $item->type ) && 'taxonomy' === $item->type ) {
        if ( ! get_taxonomy( $item->object ) ) {
            $item->_invalid = true;
        }
    }
    return $item;
}
add_filter( 'wp_setup_nav_menu_item', 'mds_pro_setup_nav_menu_item_safeguard' );
