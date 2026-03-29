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

        // General / SEO
        'general' => array(
            'google_analytics' => 'google_analytics',
            'global_meta_tags' => 'global_meta_tags',
            'dark_mode'        => 'dark_mode',
        ),
        'google_analytics' => 'google_analytics',
        'global_meta_tags' => 'global_meta_tags',
        
        // Performance
        'performance' => array(
            'minify_css'     => 'enable_minify',
            'lazy_load'      => 'enable_lazyload',
        ),
        'minify_css' => 'enable_minify',
        'lazy_load'  => 'enable_lazyload',
        
        // Social
        'social' => array(
            'facebook'      => 'social_facebook',
            'facebook_url'  => 'social_facebook',
            'twitter'       => 'social_twitter',
            'twitter_url'   => 'social_twitter',
            'instagram'     => 'social_instagram',
            'instagram_url' => 'social_instagram',
            'youtube'       => 'social_youtube',
            'youtube_url'   => 'social_youtube',
            'tiktok'        => 'social_tiktok',
            'tiktok_url'    => 'social_tiktok',
        ),
        'facebook'      => 'social_facebook',
        'facebook_url'  => 'social_facebook',
        'twitter'       => 'social_twitter',
        'twitter_url'   => 'social_twitter',
        'instagram'     => 'social_instagram',
        'instagram_url' => 'social_instagram',
        'youtube'       => 'social_youtube',
        'youtube_url'   => 'social_youtube',
        'tiktok'        => 'social_tiktok',
        'tiktok_url'    => 'social_tiktok',
        
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

        // Colors
        'colors' => array(
            'primary'   => 'color_h1',
            'secondary' => 'color_subheader',
            'accent'    => 'color_text',
        ),
        'primary'   => 'color_h1',
        'secondary' => 'color_subheader',
        'accent'    => 'color_text',
    ) );
}
