<?php
/**
 * Ads System
 * 
 * Manages ad injection and retrieval from Redux options.
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get Ad Code from Options
 * 
 * @param string $location Location key (header, article_top, article_bottom).
 * @return string Ad HTML code.
 */
function mds_get_ad_code( $location ) {
    $key = 'ad_' . $location;
    $code = mds_pro_get_option( $key, '' );
    
    // Only allow admins to save this content (it's raw HTML/JS)
    // We assume Redux handles the sanitization on save, but we return it as is for execution.
    return $code;
}

/**
 * Inject ads into post content automatically
 * 
 * @param string $content
 * @return string
 */
function mds_inject_ads_into_content( $content ) {
    if ( ! is_single() || ! is_main_query() ) {
        return $content;
    }

    $ad_top    = mds_get_ad_code( 'article_top' );
    $ad_bottom = mds_get_ad_code( 'article_bottom' );

    // Wrapper helper
    $wrap_ad = function( $code, $label = 'Publicidad' ) {
        if ( empty( $code ) ) return '';
        $html = '<div class="mds-ad-wrapper my-8 py-6 border-y border-slate-100 dark:border-slate-800 flex flex-col items-center gap-2">';
        $html .= '<span class="text-[9px] font-bold uppercase tracking-widest text-slate-400">' . esc_html( $label ) . '</span>';
        $html .= '<div class="ad-content max-w-full overflow-hidden">' . $code . '</div>';
        $html .= '</div>';
        return $html;
    };

    // Inject Top Ad
    if ( ! empty( $ad_top ) ) {
        $content = $wrap_ad( $ad_top ) . $content;
    }

    // Inject Bottom Ad
    if ( ! empty( $ad_bottom ) ) {
        $content .= $wrap_ad( $ad_bottom );
    }

    return $content;
}
add_filter( 'the_content', 'mds_inject_ads_into_content' );

/**
 * Display Header Ad
 */
function mds_display_header_ad() {
    $ad_code = mds_get_ad_code( 'header' );
    if ( empty( $ad_code ) ) return;

    echo '<div class="header-ad-container container mx-auto px-4 py-4 flex justify-center">';
    echo $ad_code;
    echo '</div>';
}
