<?php
/**
 * Theme Options Legacy Mapping
 * 
 * Maps old option keys/sections to the new Redux-based structure.
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get the legacy mapping array
 * 
 * Format: 'old_key' => 'new_key'
 * Or: 'old_section' => array( 'old_key' => 'new_key' )
 * 
 * @return array
 */
function mds_pro_get_legacy_option_map() {
    return apply_filters( 'mds_pro_legacy_option_map', array(
        // Layout & Sidebar
        'layout' => array(
            'sidebar_position' => 'single_sidebar_pos',
            'container_width'  => 'container_width',
        ),
        'sidebar_position' => 'single_sidebar_pos',
        
        // Performance
        'performance' => array(
            'minify_css'     => 'enable_minify',
            'lazy_load'      => 'enable_lazyload',
        ),
        'minify_css' => 'enable_minify',
        'lazy_load'  => 'enable_lazyload',
        
        // Social
        'social' => array(
            'facebook'  => 'social_facebook',
            'twitter'   => 'social_twitter',
            'instagram' => 'social_instagram',
            'youtube'   => 'social_youtube',
        ),
        'facebook'  => 'social_facebook',
        'twitter'   => 'social_twitter',
        'instagram' => 'social_instagram',
        'youtube'   => 'social_youtube',
        
        // Header
        'header' => array(
            'layout'      => 'header_layout',
            'transparent' => 'header_transparent_home',
        ),
        
        // Typography (Legacy often used simple strings)
        'typography' => array(
            'main_title' => 'main_title_typo',
            'body'       => 'paragraph_typo',
        ),
    ) );
}
