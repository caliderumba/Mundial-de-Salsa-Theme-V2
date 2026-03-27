<?php
/**
 * Global Theme Hooks - Mundial de Salsa Pro
 * 
 * Handles safe output of analytics, meta tags, and other head/footer injections.
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Output Google Analytics and Global Meta Tags safely in the head.
 * This content is treated as "trusted admin content".
 */
function mds_output_head_scripts() {
    // Analytics
    $analytics = mds_pro_get_option( 'general', 'google_analytics', '' );
    if ( ! empty( $analytics ) && is_string( $analytics ) ) {
        echo "<!-- Google Analytics -->\n";
        echo $analytics . "\n";
    }

    // Global Meta Tags
    $meta_tags = mds_pro_get_option( 'general', 'global_meta_tags', '' );
    if ( ! empty( $meta_tags ) && is_string( $meta_tags ) ) {
        echo "<!-- Global Meta Tags -->\n";
        echo $meta_tags . "\n";
    }
}
add_action( 'wp_head', 'mds_output_head_scripts', 1 );
