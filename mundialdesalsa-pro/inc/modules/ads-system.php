<?php
/**
 * Ads System
 * 
 * Manages ad injection and retrieval from Redux options.
 * Refactored for PHP 8.1+ and modern flat keys.
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get Ad Code from Options
 * 
 * Hardening: This function returns raw HTML/JS code. 
 * It is treated as "Trusted Admin Content" only.
 * 
 * @param string $location Location key (header, article_top, article_bottom).
 * @return string Ad HTML code.
 */
function mds_get_ad_code( string $location ): string {
    $key = 'ad_' . $location;
    $code = mds_pro_get_option( $key, '' );
    
    // Raw HTML/JS for ads. Trusted admin content.
    return (string) $code;
}

/**
 * Inject ads into post content automatically
 * 
 * @param string $content
 * @return string
 */
function mds_inject_ads_into_content( string $content ): string {
    // Only inject in single posts and main query
    if ( ! is_single() || ! is_main_query() ) {
        return $content;
    }

    $ad_top    = mds_get_ad_code( 'article_top' );
    $ad_bottom = mds_get_ad_code( 'article_bottom' );

    /**
     * Wrapper helper for consistent ad styling
     */
    $wrap_ad = function( string $code, string $label = 'Publicidad' ): string {
        if ( empty( $code ) ) {
            return '';
        }
        
        $html = '<div class="mds-ad-wrapper my-10 py-6 border-y border-slate-100 dark:border-slate-800 flex flex-col items-center gap-3">';
        $html .= '<span class="text-[9px] font-bold uppercase tracking-[0.2em] text-slate-400">' . esc_html( $label ) . '</span>';
        $html .= '<div class="ad-content-inner max-w-full overflow-hidden">' . $code . '</div>';
        $html .= '</div>';
        
        return $html;
    };

    // Injection logic
    if ( ! empty( $ad_top ) ) {
        $content = $wrap_ad( $ad_top ) . $content;
    }

    if ( ! empty( $ad_bottom ) ) {
        $content .= $wrap_ad( $ad_bottom );
    }

    return $content;
}
add_filter( 'the_content', 'mds_inject_ads_into_content' );

/**
 * Display Header Ad
 * 
 * Template tag to be used in header.php or topbar.
 */
function mds_display_header_ad(): void {
    $ad_code = mds_get_ad_code( 'header' );
    if ( empty( $ad_code ) ) {
        return;
    }

    echo '<div class="header-ad-container container mx-auto px-4 py-6 flex justify-center overflow-hidden">';
    echo $ad_code; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    echo '</div>';
}
