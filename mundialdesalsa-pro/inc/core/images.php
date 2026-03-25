<?php
/**
 * MundialdeSalsa Pro Image Engine
 * 
 * Centralized logic for post images.
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get primary image data for a post.
 * Priority: 
 * 1. Local Featured Image
 * 2. External Image Meta (url_imagen_externa)
 * 3. Video Thumbnail (if post has video)
 * 4. Default Site Logo or Placeholder
 * 
 * @param int $post_id Post ID.
 * @return array Image data structure.
 */
function mds_get_primary_image_data( $post_id = 0 ) {
    $post_id = absint( $post_id ? $post_id : get_the_ID() );
    
    $data = [
        'has_image'   => false,
        'url'         => '',
        'width'       => 1200,
        'height'      => 630,
        'alt'         => get_the_title( $post_id ),
        'title'       => get_the_title( $post_id ),
        'source'      => 'none',
        'is_external' => false,
    ];

    if ( ! $post_id ) {
        return $data;
    }

    // 1. Local Featured Image
    if ( has_post_thumbnail( $post_id ) ) {
        $thumb_id = get_post_thumbnail_id( $post_id );
        $img = wp_get_attachment_image_src( $thumb_id, 'full' );
        if ( $img ) {
            $data['has_image'] = true;
            $data['url']       = $img[0];
            $data['width']     = $img[1];
            $data['height']    = $img[2];
            $data['alt']       = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) ?: $data['alt'];
            $data['source']    = 'local';
            return $data;
        }
    }

    // 2. External Image Meta
    $external_url = get_post_meta( $post_id, 'url_imagen_externa', true );
    if ( ! empty( $external_url ) && filter_var( $external_url, FILTER_VALIDATE_URL ) ) {
        $data['has_image']   = true;
        $data['url']         = esc_url_raw( $external_url );
        $data['source']      = 'external';
        $data['is_external'] = true;
        return $data;
    }

    // 3. Video Thumbnail
    if ( function_exists( 'mds_get_primary_video_data' ) ) {
        $video = mds_get_primary_video_data( $post_id );
        if ( $video['has_video'] && ! empty( $video['thumbnail_url'] ) ) {
            $data['has_image']   = true;
            $data['url']         = esc_url_raw( $video['thumbnail_url'] );
            $data['source']      = 'video';
            $data['is_external'] = true;
            return $data;
        }
    }

    // 4. Default Placeholder
    $data['has_image'] = true; // Fallback is still an image to display
    $default_logo = function_exists('mds_pro_get_option') ? mds_pro_get_option( 'header_settings', 'header_logo', [] ) : [];
    
    if ( ! empty( $default_logo['url'] ) ) {
        $data['url']    = esc_url_raw( $default_logo['url'] );
        $data['source'] = 'default';
    } else {
        $placeholder_path = '/assets/images/default-placeholder.jpg';
        $data['url']    = defined('MDS_PRO_URI') ? MDS_PRO_URI . $placeholder_path : get_template_directory_uri() . $placeholder_path;
        $data['source'] = 'fallback';
    }

    return $data;
}
