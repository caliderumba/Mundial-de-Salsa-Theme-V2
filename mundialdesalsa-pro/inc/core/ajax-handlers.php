<?php
/**
 * AJAX Handlers for Live Updates and Scores.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get Live Updates for a post
 */
function mds_pro_ajax_get_live_updates() {
    check_ajax_referer( 'mds_live_nonce', 'nonce' );

    $post_id = isset( $_POST['post_id'] ) ? intval( $_POST['post_id'] ) : 0;
    if ( ! $post_id ) {
        wp_send_json_error( array( 'message' => 'Invalid Post ID' ) );
    }

    $updates = get_post_meta( $post_id, 'mds_live_updates', true );
    $html = mds_pro_render_live_updates( array( 'updates' => $updates ) );

    wp_send_json_success( array( 'html' => $html ) );
}
add_action( 'wp_ajax_mds_get_live_updates', 'mds_pro_ajax_get_live_updates' );
add_action( 'wp_ajax_nopriv_mds_get_live_updates', 'mds_pro_ajax_get_live_updates' );

/**
 * Get Live Scores for a post
 */
function mds_pro_ajax_get_live_scores() {
    check_ajax_referer( 'mds_live_nonce', 'nonce' );

    $post_id = isset( $_POST['post_id'] ) ? intval( $_POST['post_id'] ) : 0;
    if ( ! $post_id ) {
        wp_send_json_error( array( 'message' => 'Invalid Post ID' ) );
    }

    $scores = get_post_meta( $post_id, 'mds_live_scores', true );
    $title = get_post_meta( $post_id, 'mds_live_score_title', true );
    $html = mds_pro_render_live_score( array( 'scores' => $scores, 'title' => $title ) );

    wp_send_json_success( array( 'html' => $html ) );
}
add_action( 'wp_ajax_mds_get_live_scores', 'mds_pro_ajax_get_live_scores' );
add_action( 'wp_ajax_nopriv_mds_get_live_scores', 'mds_pro_ajax_get_live_scores' );
