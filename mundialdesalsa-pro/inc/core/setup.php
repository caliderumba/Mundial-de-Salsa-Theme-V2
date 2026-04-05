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

    // Gutenberg Support
    add_theme_support( 'align-wide' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'custom-line-height' );
    add_theme_support( 'editor-styles' );
    add_editor_style( 'assets/css/editor-style.css' );

    // Gutenberg Color Palette
    add_theme_support( 'editor-color-palette', array(
        array(
            'name'  => esc_html__( 'Emerald', 'mundialdesalsa-pro' ),
            'slug'  => 'emerald',
            'color' => '#10b981',
        ),
        array(
            'name'  => esc_html__( 'Black', 'mundialdesalsa-pro' ),
            'slug'  => 'black',
            'color' => '#000000',
        ),
        array(
            'name'  => esc_html__( 'White', 'mundialdesalsa-pro' ),
            'slug'  => 'white',
            'color' => '#ffffff',
        ),
        array(
            'name'  => esc_html__( 'Slate 900', 'mundialdesalsa-pro' ),
            'slug'  => 'slate-900',
            'color' => '#0f172a',
        ),
        array(
            'name'  => esc_html__( 'Slate 500', 'mundialdesalsa-pro' ),
            'slug'  => 'slate-500',
            'color' => '#64748b',
        ),
    ) );

    // Custom Image Sizes
    add_image_size( 'card-thumb', 400, 250, true );
    add_image_size( 'featured-main', 1200, 600, true );
    add_image_size( 'square-mini', 150, 150, true );
    add_image_size( 'mds-pro-magazine', 800, 600, true );
    add_image_size( 'mds-pro-hero', 1200, 800, true );
    add_image_size( 'mds-pro-thumbnail', 400, 300, true );

    // Block Templates
    $post_type_object = get_post_type_object( 'post' );
    $post_type_object->template = array(
        array( 'mds-pro/video-hero' ),
        array( 'mds-pro/editorial-highlights' ),
        array( 'core/paragraph', array(
            'placeholder' => 'Comienza a escribir la historia de la salsa...',
        ) ),
    );

    $page_type_object = get_post_type_object( 'page' );
    // We can't easily set a global page template that only applies to "Home" without more logic,
    // but we can define a default for new pages or use a specific page template.
}
add_action( 'after_setup_theme', 'mds_pro_setup' );

/**
 * Set default content for the Home page if it's new
 */
function mds_pro_set_home_template( $post_id, $post, $update ) {
    if ( $update ) return;
    if ( $post->post_type !== 'page' ) return;
    
    // Check if this is intended to be the home page (e.g. title is "Inicio" or "Home")
    if ( in_array( strtolower($post->post_title), ['inicio', 'home'] ) ) {
        $content = '
            <!-- wp:mds-pro/bento-grid {"category":"mundial"} /-->
            <!-- wp:mds-pro/smart-list {"category":"feria"} /-->
            <!-- wp:mds-pro/editorial-highlights /-->
        ';
        wp_update_post( array(
            'ID'           => $post_id,
            'post_content' => $content,
        ) );
    }
}
add_action( 'wp_insert_post', 'mds_pro_set_home_template', 10, 3 );

/**
 * Enable WebP and SVG Support
 */
function mds_pro_upload_mimes( $mimes ) {
    $mimes['webp'] = 'image/webp';
    $mimes['svg']  = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'mds_pro_upload_mimes' );

/**
 * Prefer WebP for generated images
 */
function mds_pro_prefer_webp( $formats ) {
    $formats['image/jpeg'] = 'image/webp';
    $formats['image/png']  = 'image/webp';
    return $formats;
}
add_filter( 'image_editor_output_format', 'mds_pro_prefer_webp' );

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
