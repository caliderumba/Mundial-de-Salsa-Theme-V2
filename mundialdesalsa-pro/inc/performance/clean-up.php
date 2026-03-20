<?php
/**
 * Performance & Cleanup - Mundial de Salsa Pro
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 1. Header Cleanup: Remove unnecessary scripts
 */
function mds_pro_cleanup_head() {
    // Remove Emojis
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

    // Remove oEmbed
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );

    // Remove other junk
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'wp_generator' );
    remove_action( 'wp_head', 'wp_shortlink_wp_head' );
}
add_action( 'init', 'mds_pro_cleanup_head' );

/**
 * 2. SVG Security: Validate MIME type
 */
function mds_pro_check_svg_filetype( $data, $file, $filename, $mimes ) {
    $filetype = wp_check_filetype( $filename, $mimes );
    
    if ( 'svg' === $filetype['ext'] ) {
        $data['ext']  = 'svg';
        $data['type'] = 'image/svg+xml';
    }
    
    return $data;
}
add_filter( 'wp_check_filetype_and_ext', 'mds_pro_check_svg_filetype', 10, 4 );

/**
 * 3. Native Lazy Load Optimization
 * WordPress 5.5+ does this by default, but we ensure it's active for all theme images.
 */
function mds_pro_ensure_lazy_load( $attributes ) {
    if ( ! isset( $attributes['loading'] ) ) {
        $attributes['loading'] = 'lazy';
    }
    return $attributes;
}
add_filter( 'wp_get_attachment_image_attributes', 'mds_pro_ensure_lazy_load', 10, 1 );

/**
 * 4. Disable oEmbed scripts from loading on every page
 */
function mds_pro_deregister_oembed_scripts() {
    wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'mds_pro_deregister_oembed_scripts' );
