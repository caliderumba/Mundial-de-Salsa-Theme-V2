<?php
/**
 * Layout Engine: Dynamic Layout Switcher
 * 
 * Centralized logic to determine structural classes and layouts.
 * Refactored for PHP 8.1+ and modern Redux flat options.
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
function mds_get_archive_layout_type(): string {
    return (string) mds_pro_get_option( 'archive_layout', 'grid' );
}

/**
 * Get Site Layout Class
 * 
 * Returns 'layout-full' or 'layout-boxed'.
 * 
 * @return string
 */
function mds_get_site_layout_class(): string {
    $layout = mds_pro_get_option( 'site_layout', 'full' );
    return 'layout-' . esc_attr( (string) $layout );
}

/**
 * Get Header Classes
 * 
 * Generates classes for the main header based on options.
 * 
 * @return string
 */
function mds_get_header_classes(): string {
    $classes = array( 'site-header', 'z-[100]', 'transition-all', 'duration-300' );
    
    // Using modern helpers from inc/theme-options/helpers.php
    $layout = mds_get_header_layout();
    $sticky = (bool) mds_pro_get_option( 'header_sticky', true );
    
    $classes[] = 'header-layout-' . esc_attr( (string) $layout );
    
    if ( $sticky ) {
        $classes[] = 'sticky top-0 shadow-sm';
    } else {
        $classes[] = 'relative';
    }
    
    // Design System: Glassmorphism / Background
    $classes[] = 'bg-white/95 dark:bg-slate-950/95 backdrop-blur-md border-b border-slate-100 dark:border-slate-800';
    
    return (string) implode( ' ', apply_filters( 'mds_header_classes', $classes ) );
}

/**
 * Get Sidebar Position for Single Posts
 * 
 * @return string 'left', 'right', or 'none'
 */
function mds_get_sidebar_position(): string {
    return (string) mds_get_single_sidebar_pos();
}

/**
 * Determine if a specific section should be shown on front page
 * 
 * @param string $section_id
 * @return bool
 */
function mds_show_front_page_section( string $section_id ): bool {
    $sections = mds_pro_get_option( 'show_front_page_sections', true );
    
    // If it's a boolean (global toggle)
    if ( is_bool( $sections ) ) {
        return $sections;
    }
    
    // If it's an array (granular selection)
    if ( is_array( $sections ) ) {
        if ( empty( $sections ) ) {
            return true; 
        }
        return in_array( $section_id, $sections, true );
    }
    
    return true;
}
