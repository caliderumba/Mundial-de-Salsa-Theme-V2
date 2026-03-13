<?php
/**
 * Editorial Engine: Post Views Tracker & Trending Logic
 */

/**
 * Track post views without heavy plugins
 */
function mds_pro_track_post_views() {
    if ( ! is_singular( 'post' ) ) return;

    global $post;
    $views = get_post_meta( $post->ID, 'mds_post_views', true );
    $views = ( $views === '' ) ? 0 : (int)$views;
    $views++;

    update_post_meta( $post->ID, 'mds_post_views', $views );
}
add_action( 'wp_head', 'mds_pro_track_post_views' );

/**
 * Get trending posts based on views
 */
function mds_pro_get_trending_posts( $limit = 5 ) {
    return new WP_Query([
        'posts_per_page' => $limit,
        'meta_key'       => 'mds_post_views',
        'orderby'        => 'meta_value_num',
        'order'          => 'DESC',
        'post_status'    => 'publish'
    ]);
}

/**
 * Editorial Picks (based on a custom meta flag)
 */
function mds_pro_get_editor_picks( $limit = 4 ) {
    return new WP_Query([
        'posts_per_page' => $limit,
        'meta_key'       => '_mds_editor_pick',
        'meta_value'     => '1',
        'post_status'    => 'publish'
    ]);
}
