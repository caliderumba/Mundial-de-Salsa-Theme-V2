<?php
/**
 * Ads System
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Basic ads system logic
function mds_pro_get_ad( $location ) {
    return mds_pro_get_option( 'ads', $location . '_ad', '' );
}

/**
 * Inject ads into post content
 */
function mds_pro_inject_content_ads( $content ) {
    if ( ! is_single() || ! is_main_query() ) {
        return $content;
    }

    $ad_code = mds_pro_get_ad( 'content' );

    if ( empty( $ad_code ) ) {
        return $content;
    }

    $ad_html = '<div class="mds-pro-content-ad my-8 flex justify-center">' . $ad_code . '</div>';

    // Inject after the second paragraph if it exists
    $paragraphs = explode( '</p>', $content );
    
    if ( count( $paragraphs ) > 2 ) {
        array_splice( $paragraphs, 2, 0, $ad_html );
        $content = implode( '</p>', $paragraphs );
    } else {
        $content .= $ad_html;
    }

    return $content;
}
add_filter( 'the_content', mds_pro_inject_content_ads );
