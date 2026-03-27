<?php
/**
 * Theme Domain Helpers
 * 
 * Specific functions to retrieve processed options for different domains.
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Header Helpers
 */
function mds_get_header_layout() {
    return mds_pro_get_option( 'header_layout', 'left' );
}

function mds_is_header_transparent_home() {
    return (bool) mds_pro_get_option( 'header_transparent_home', false );
}

/**
 * Layout Helpers
 */
function mds_get_single_sidebar_pos() {
    return mds_pro_get_option( 'single_sidebar_pos', 'right' );
}

function mds_get_container_width() {
    return (int) mds_pro_get_option( 'container_width', 1200 );
}

/**
 * Typography Helpers
 */
function mds_get_typography( $id ) {
    $typo = mds_pro_get_option( $id );
    
    // Ensure it's an array for typography fields
    if ( ! is_array( $typo ) ) {
        $defaults = mds_pro_get_option_defaults();
        $typo = isset( $defaults[$id] ) ? $defaults[$id] : array();
    }
    
    return $typo;
}

/**
 * Color Helpers
 */
function mds_get_primary_color() {
    return mds_pro_get_option( 'primary', '#e74c3c' );
}

function mds_get_accent_color() {
    return mds_pro_get_option( 'accent', '#f1c40f' );
}

/**
 * Social Helpers
 */
function mds_get_social_url( $network ) {
    $key = "social_{$network}";
    return mds_pro_get_option( $key, '' );
}

/**
 * Performance Helpers
 */
function mds_is_lazyload_enabled() {
    return (bool) mds_pro_get_option( 'enable_lazyload', true );
}

function mds_is_minify_enabled() {
    return (bool) mds_pro_get_option( 'enable_minify', false );
}
