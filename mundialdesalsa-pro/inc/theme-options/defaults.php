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
        // Branding
        'site_logo'               => array( 'url' => '' ),
        'site_logo_dark'          => array( 'url' => '' ),
        'site_favicon'            => array( 'url' => '' ),
        'site_retina_logo'        => false,
        
        // Header & Nav
        'header_layout'           => 'left',
        'header_width'            => 'full',
        'header_height'           => 80,
        'header_sticky'           => true,
        'header_transparent_home' => false,
        'header_topbar'           => false,
        'header_breaking_news'    => false,
        'header_search'           => true,
        'header_social'           => true,
        
        // Header Desktop
        'header_desktop_layout'   => 'standard',
        'header_desktop_columns'  => '3',
        
        // Header Mobile
        'header_mobile_layout'    => 'standard',
        'header_mobile_sticky'    => true,
        
        // Navigation
        'nav_typography'          => array(
            'font-family' => 'Inter',
            'font-size'   => '13px',
            'font-weight' => '700',
            'color'       => '#141414',
        ),
        
        // Content Design
        'single_sidebar_pos'      => 'right',
        'category_sidebar_pos'    => 'right',
        'news_grid_style'         => 'grid',
        'container_width'         => 1200,
        'site_layout'             => 'full',
        'show_front_page_sections' => true,
        'border_radius'           => 12,
        
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
        'color_h1'                => '#e74c3c',
        'color_subheader'         => '#2c3e50',
        'color_text'              => '#334155',
        'bg_page'                 => '#f1f5f9',
        'bg_content'              => '#ffffff',
        'color_accent'            => '#10b981',
        
        // Single Post
        'single_featured_image'   => true,
        'single_post_meta'        => true,
        'single_author_box'       => true,
        'single_related_posts'    => true,
        'single_share_buttons'    => true,
        
        // Archives
        'archive_layout'          => 'grid',
        'archive_sidebar'         => 'right',
        'archive_pagination'      => 'numeric',
        
        // Ads Manager
        'ad_header'               => '',
        'ad_article_top'          => '',
        'ad_article_bottom'       => '',
        'ad_sidebar'              => '',
        
        // Footer
        'footer_layout'           => 'standard',
        'footer_columns'          => '4',
        'footer_bg'               => '#0f172a',
        'footer_text_color'       => '#ffffff',
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
        'enable_preloader'        => false,
        
        // SEO & Scripts
        'google_analytics'        => '',
        'global_meta_tags'        => '',
        'footer_scripts'          => '',
        'custom_css'              => '',
        'custom_js'               => '',
    ) );
}
