<?php
/**
 * Theme Options Defaults
 * 
 * Centralized source of truth for all default values.
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get all theme defaults
 * 
 * @return array
 */
function mds_pro_get_option_defaults() {
    return apply_filters( 'mds_pro_option_defaults', array(
        // Header & Nav
        'header_layout'           => 'left',
        'header_transparent_home' => false,
        'header_logo'             => array( 'url' => '' ),
        'header_logo_dark'        => array( 'url' => '' ),
        
        // Content Design
        'single_sidebar_pos'      => 'right',
        'category_sidebar_pos'    => 'right',
        'news_grid_style'         => 'grid',
        'container_width'         => 1200,
        
        // Typography
        'main_title_typo'         => array(
            'font-family' => 'Space Grotesk',
            'font-size'   => '48px',
            'font-weight' => '700',
            'color'       => '#141414',
        ),
        'subtitle_typo'           => array(
            'font-family' => 'Inter',
            'font-size'   => '24px',
            'font-weight' => '600',
            'color'       => '#141414',
        ),
        'paragraph_typo'          => array(
            'font-family' => 'Inter',
            'font-size'   => '16px',
            'font-weight' => '400',
            'color'       => '#333333',
        ),
        
        // Colors
        'primary'                 => '#e74c3c',
        'secondary'               => '#2c3e50',
        'accent'                  => '#f1c40f',
        
        // Footer
        'footer_columns'          => '4',
        'footer_credits'          => '© ' . date('Y') . ' MundialdeSalsa Pro. Todos los derechos reservados.',
        
        // Social
        'social_facebook'         => '',
        'social_twitter'          => '',
        'social_instagram'        => '',
        'social_youtube'          => '',
        'social_tiktok'           => '',
        
        // Performance
        'enable_lazyload'         => true,
        'enable_minify'           => false,
        'enable_pwa'              => false,
        
        // SEO & Scripts
        'google_analytics'        => '',
        'global_meta_tags'        => '',
        'footer_scripts'          => '',
        'custom_css'              => '',
    ) );
}
