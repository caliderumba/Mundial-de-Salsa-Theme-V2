<?php
/**
 * Layout Engine: Dynamic Layout Switcher
 * 
 * Centralized logic to determine structural classes and layouts.
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get Archive Layout Type
 * 
 * Returns 'grid' or 'list' based on theme options.
 * 
 * @return string
 */
function mds_get_archive_layout_type() {
    return mds_pro_get_option( 'archive_layout', 'grid' );
}

/**
 * Get Site Layout Class
 * 
 * Returns 'layout-full' or 'layout-boxed'.
 * 
 * @return string
 */
function mds_get_site_layout_class() {
    $layout = mds_pro_get_option( 'site_layout', 'full' );
    return 'layout-' . esc_attr( $layout );
}

/**
 * Get Header Classes
 * 
 * Generates classes for the main header based on options.
 * 
 * @return string
 */
function mds_get_header_classes() {
    $classes = array( 'site-header', 'z-[100]', 'transition-all', 'duration-300' );
    
    $layout = mds_get_header_layout();
    $sticky = mds_pro_get_option( 'header_sticky', true );
    
    $classes[] = 'header-layout-' . esc_attr( $layout );
    
    if ( $sticky ) {
        $classes[] = 'sticky top-0 shadow-sm';
    } else {
        $classes[] = 'relative';
    }
    
    // Glassmorphism / Background
    $classes[] = 'bg-white/95 dark:bg-slate-950/95 backdrop-blur-md border-b border-slate-100 dark:border-slate-800';
    
    return implode( ' ', apply_filters( 'mds_header_classes', $classes ) );
}

/**
 * Get Sidebar Position for Single Posts
 * 
 * @return string 'left', 'right', or 'none'
 */
function mds_get_sidebar_position() {
    return mds_get_single_sidebar_pos();
}

/**
 * Determine if a specific section should be shown on front page
 * 
 * @param string $section_id
 * @return bool
 */
function mds_show_front_page_section( $section_id ) {
    $sections = mds_pro_get_option( 'show_front_page_sections', array() );
    if ( empty( $sections ) ) {
        return true; // Default to show if not configured
    }
    return in_array( $section_id, $sections );
}
