<?php
/**
 * MundialdeSalsa Pro Editorial Engine
 * 
 * Logic for determining post context and editorial states.
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get the context of a post.
 * 
 * @param int $post_id Post ID.
 * @return string Context: 'video', 'event', 'profile', 'news'.
 */
function mds_get_post_context( $post_id = 0 ) {
    $post_id = $post_id ? $post_id : get_the_ID();
    
    // 1. Check for video
    $video = mds_get_primary_video_data( $post_id );
    if ( $video['has_video'] || has_category( 'videos', $post_id ) ) {
        return 'video';
    }

    // 2. Check for events/festivals
    if ( has_category( ['eventos', 'festivales', 'coberturas'], $post_id ) ) {
        return 'event';
    }

    // 3. Check for profiles/artists
    if ( has_category( ['artistas', 'orquestas', 'perfiles'], $post_id ) ) {
        return 'profile';
    }

    return 'news';
}

/**
 * Check if a post has been updated significantly.
 * 
 * @param int $post_id Post ID.
 * @return bool True if updated.
 */
function mds_is_post_updated( $post_id = 0 ) {
    $post_id = $post_id ? $post_id : get_the_ID();
    
    $published = get_the_date( 'U', $post_id );
    $modified  = get_the_modified_date( 'U', $post_id );

    // If modified more than 24 hours after published
    return ( $modified - $published ) > 86400;
}
