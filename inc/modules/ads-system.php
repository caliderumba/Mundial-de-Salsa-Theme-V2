<?php
/**
 * Ads System Module
 */

function mds_pro_get_ad( $position ) {
    if ( get_option( 'mds_ads_enabled', 'enabled' ) === 'disabled' ) return '';

    $ad_code = get_option( 'mds_ad_' . $position );
    if ( empty( $ad_code ) ) return '';

    return '<div class="mds-ad mds-ad-' . esc_attr( $position ) . ' my-4 text-center">' . $ad_code . '</div>';
}

/**
 * Auto-inject ads into content
 */
function mds_pro_inject_ads_into_content( $content ) {
    if ( ! is_single() || is_admin() ) return $content;

    $ad_code = mds_pro_get_ad( 'inside-article' );
    if ( empty( $ad_code ) ) return $content;

    $paragraphs = explode( '</p>', $content );
    if ( count( $paragraphs ) > 3 ) {
        $paragraphs[1] .= $ad_code;
    }
    
    return implode( '</p>', $paragraphs );
}
add_filter( 'the_content', 'mds_pro_inject_ads_into_content' );
