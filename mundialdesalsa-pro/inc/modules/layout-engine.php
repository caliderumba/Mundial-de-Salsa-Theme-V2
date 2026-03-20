<?php
/**
 * Layout Engine: Dynamic Layout Switcher
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Basic layout switching logic
function mds_pro_get_layout( $type = 'post' ) {
    $section = 'layout';
    $key = $type;
    
    if ( $type === 'category' || $type === 'archive' ) {
        $key = 'archive';
    } elseif ( $type === 'homepage' ) {
        $key = 'homepage';
    } elseif ( $type === 'post' || $type === 'single' ) {
        $key = 'single_layout';
    } elseif ( $type === 'page' ) {
        $key = 'page_layout';
    }
    
    $default = 'classic';
    if ( $key === 'archive' ) $default = 'grid';
    if ( $key === 'homepage' ) $default = 'magazine';
    if ( $key === 'page_layout' ) $default = 'standard';
    
    return mds_pro_get_option( $section, $key, $default );
}

/**
 * Get Header Layout
 */
function mds_pro_get_header_layout() {
    return mds_pro_get_option( 'header_settings', 'header_layout', 'standard' );
}

/**
 * Get Header Classes
 */
function mds_pro_get_header_classes() {
    $classes = array( 'site-header' );
    $layout = mds_pro_get_header_layout();
    $sticky = mds_pro_get_option( 'header_settings', 'header_sticky', true );
    
    $classes[] = 'header-' . $layout;
    
    if ( $sticky ) {
        $classes[] = 'sticky top-0 z-[100] bg-white/95 dark:bg-slate-950/95 backdrop-blur-md shadow-sm';
    } else {
        $classes[] = 'relative bg-white dark:bg-slate-950';
    }
    
    return implode( ' ', $classes );
}
