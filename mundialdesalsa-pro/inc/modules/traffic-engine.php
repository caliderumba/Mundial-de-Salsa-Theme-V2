<?php
/**
 * Traffic Engine: View Tracking
 * 
 * Handles post view counts for "Most Popular" sections.
 * Refactored for PHP 8.1+ and robust tracking.
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Track Post Views
 * 
 * Increments the view count for single posts using a robust ID retrieval.
 */
function mds_track_post_views(): void {
    // Only track single posts, not pages or other types
    if ( ! is_singular( 'post' ) ) {
        return;
    }

    // Get current post ID reliably from the queried object
    $post_id = get_queried_object_id();
    if ( ! $post_id ) {
        return;
    }

    // Optional: Don't track views from administrators to keep stats cleaner
    if ( current_user_can( 'manage_options' ) ) {
        return;
    }

    $count_key = 'mds_views_count';
    $count = get_post_meta( $post_id, $count_key, true );
    
    if ( '' === $count ) {
        $count = 0;
        delete_post_meta( $post_id, $count_key );
        add_post_meta( $post_id, $count_key, 1 );
    } else {
        $count = (int) $count + 1;
        update_post_meta( $post_id, $count_key, $count );
    }
}
add_action( 'wp_head', 'mds_track_post_views' );

/**
 * Get Post Views
 * 
 * Utility to retrieve the view count for display or queries.
 * 
 * @param int $post_id
 * @return int
 */
function mds_get_post_views( int $post_id ): int {
    $count_key = 'mds_views_count';
    $count = get_post_meta( $post_id, $count_key, true );
    
    return ( '' === $count ) ? 0 : (int) $count;
}
