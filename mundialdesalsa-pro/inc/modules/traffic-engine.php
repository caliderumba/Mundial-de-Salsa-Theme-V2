<?php
/**
 * Traffic Engine: Infinite Scroll & View Tracking
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Track Post Views
 * 
 * Hooked to template_redirect for cleaner logic execution.
 */
function mds_pro_track_post_views() {
    if ( ! is_singular( 'post' ) ) {
        return;
    }

    $post_id = get_the_ID();
    
    // Prevent double counting if needed (optional)
    // if ( isset( $_COOKIE['mds_viewed_' . $post_id] ) ) return;

    $count = get_post_meta( $post_id, 'mds_pro_views_count', true );
    $count = ( $count === '' ) ? 0 : (int) $count;
    $count++;

    update_post_meta( $post_id, 'mds_pro_views_count', $count );
}
add_action( 'template_redirect', 'mds_pro_track_post_views' );

// Basic infinite scroll logic
function mds_pro_infinite_scroll() {
    if ( is_singular() || is_paged() ) {
        return;
    }
    // Add scripts for infinite scroll here
}
add_action( 'wp_enqueue_scripts', 'mds_pro_infinite_scroll' );
