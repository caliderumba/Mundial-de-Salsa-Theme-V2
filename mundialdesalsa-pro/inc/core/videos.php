<?php
/**
 * MundialdeSalsa Pro Video Engine
 * 
 * Centralized logic for post videos.
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get primary video data for a post.
 * 
 * @param int $post_id Post ID.
 * @return array Video data structure.
 */
function mds_get_primary_video_data( $post_id = 0 ) {
    $post_id = absint( $post_id ? $post_id : get_the_ID() );
    
    $data = [
        'has_video'     => false,
        'provider'      => '',
        'video_url'     => '',
        'video_id'      => '',
        'embed_url'     => '',
        'thumbnail_url' => '',
    ];

    if ( ! $post_id ) {
        return $data;
    }

    // Priority 1: url_video_limpia meta
    $video_url = get_post_meta( $post_id, 'url_video_limpia', true );
    
    // Priority 2: mds_post_video_url (legacy or alternative)
    if ( empty( $video_url ) ) {
        $video_url = get_post_meta( $post_id, 'mds_post_video_url', true );
    }

    if ( empty( $video_url ) ) {
        return apply_filters( 'mds_video_data', $data, $post_id );
    }

    $video_url = esc_url_raw( $video_url );
    $data['video_url'] = $video_url;

    // YouTube Detection
    if ( mds_is_youtube_url( $video_url ) ) {
        $data = mds_parse_youtube_data( $video_url, $data );
    } 
    // Vimeo Detection
    elseif ( mds_is_vimeo_url( $video_url ) ) {
        $data = mds_parse_vimeo_data( $video_url, $data );
    }

    return apply_filters( 'mds_video_data', $data, $post_id );
}

/**
 * Check if URL is YouTube
 */
function mds_is_youtube_url( $url ) {
    return (bool) preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url );
}

/**
 * Parse YouTube Data
 */
function mds_parse_youtube_data( $url, $data ) {
    if ( preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match ) ) {
        $data['has_video']     = true;
        $data['provider']      = 'youtube';
        $data['video_id']      = $match[1];
        $data['embed_url']     = 'https://www.youtube.com/embed/' . $data['video_id'];
        // hqdefault.jpg is more reliable than maxresdefault.jpg
        $data['thumbnail_url'] = 'https://img.youtube.com/vi/' . $data['video_id'] . '/hqdefault.jpg';
    }
    return $data;
}

/**
 * Check if URL is Vimeo
 */
function mds_is_vimeo_url( $url ) {
    return (bool) preg_match( '%^https?://(?:www\.)?vimeo\.com/(?:channels/(?:\w+/)?|groups/(?:[^/]*)/videos/|album/(?:\d+)/video/|video/|)(\d+)(?:$|/|\?)%i', $url );
}

/**
 * Parse Vimeo Data
 */
function mds_parse_vimeo_data( $url, $data ) {
    if ( preg_match( '%^https?://(?:www\.)?vimeo\.com/(?:channels/(?:\w+/)?|groups/(?:[^/]*)/videos/|album/(?:\d+)/video/|video/|)(\d+)(?:$|/|\?)%i', $url, $match ) ) {
        $data['has_video']     = true;
        $data['provider']      = 'vimeo';
        $data['video_id']      = $match[1];
        $data['embed_url']     = 'https://player.vimeo.com/video/' . $data['video_id'];
        // Placeholder for vimeo thumbnail logic if needed later
        $data['thumbnail_url'] = ''; 
    }
    return $data;
}
