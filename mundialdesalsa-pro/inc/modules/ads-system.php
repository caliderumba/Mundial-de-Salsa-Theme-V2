<?php
/**
 * Ads System
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Basic ads system logic
function mds_pro_get_ad( $location ) {
    return mds_pro_get_option( 'monetization', $location, '' );
}

/**
 * Inject ads into post content
 */
function mds_pro_inject_content_ads( $content ) {
    if ( ! is_single() || ! is_main_query() ) {
        return $content;
    }

    $ad_code = mds_pro_get_ad( 'content_ad' );

    if ( empty( $ad_code ) ) {
        return $content;
    }

    $ad_html = '<div class="mds-pro-content-ad my-12 py-8 border-y border-slate-100 dark:border-slate-800 flex flex-col items-center gap-2">';
    $ad_html .= '<span class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">' . __( 'Publicidad', 'mundialdesalsa-pro' ) . '</span>';
    $ad_html .= '<div class="max-w-full overflow-hidden">' . $ad_code . '</div>';
    $ad_html .= '</div>';

    // Inject after the second paragraph if it exists
    $paragraphs = explode( '</p>', $content );
    
    if ( count( $paragraphs ) > 2 ) {
        // Insert after the second paragraph (index 1)
        $paragraphs[1] .= '</p>' . $ad_html;
        $content = implode( '</p>', $paragraphs );
    } else {
        $content .= $ad_html;
    }

    return $content;
}
add_filter( 'the_content', 'mds_pro_inject_content_ads' );
