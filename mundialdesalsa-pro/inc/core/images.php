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
 * @param int|null $post_id Post ID. Null uses get_the_ID(). 0 forces fallback.
 * @return array Image data structure.
 */
function mds_get_primary_image_data( $post_id = null ) {
    $post_id = ( null === $post_id ) ? get_the_ID() : $post_id;
    $post_id = absint( $post_id );
    
    $data = [
        'has_image'   => false,
        'url'         => '',
        'width'       => 1200,
        'height'      => 630,
        'alt'         => $post_id ? get_the_title( $post_id ) : get_bloginfo( 'name' ),
        'title'       => $post_id ? get_the_title( $post_id ) : get_bloginfo( 'name' ),
        'source'      => 'none',
        'is_external' => false,
    ];

    // 1. Local Featured Image
    if ( $post_id && has_post_thumbnail( $post_id ) ) {
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
    if ( $post_id ) {
        $external_url = get_post_meta( $post_id, 'url_imagen_externa', true );
        if ( ! empty( $external_url ) && filter_var( $external_url, FILTER_VALIDATE_URL ) ) {
            $data['has_image']   = true;
            $data['url']         = esc_url_raw( $external_url );
            $data['source']      = 'external';
            $data['is_external'] = true;
            return $data;
        }
    }

    // 3. Video Thumbnail
    if ( $post_id && function_exists( 'mds_get_primary_video_data' ) ) {
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

/**
 * Get Theme Logo
 */
function mds_pro_get_logo() {
    $logo_main = mds_pro_get_option( 'header_settings', 'header_logo', array() );
    $logo_dark = mds_pro_get_option( 'header_settings', 'header_logo_dark', array() );
    $site_name = mds_pro_get_option( 'general', 'site_name', get_bloginfo( 'name' ) );
    
    $output = '';
    
    if ( ! empty( $logo_main['url'] ) ) {
        $output .= sprintf(
            '<img src="%s" alt="%s" class="header-logo-main %s">',
            esc_url( $logo_main['url'] ),
            esc_attr( $site_name ),
            ! empty( $logo_dark['url'] ) ? 'dark:hidden' : ''
        );
    }
    
    if ( ! empty( $logo_dark['url'] ) ) {
        $output .= sprintf(
            '<img src="%s" alt="%s" class="header-logo-dark hidden dark:block">',
            esc_url( $logo_dark['url'] ),
            esc_attr( $site_name )
        );
    }
    
    if ( empty( $output ) ) {
        $output = sprintf(
            '<span class="text-3xl md:text-4xl font-black uppercase tracking-tighter italic leading-none text-slate-900 dark:text-white">%s<span class="text-emerald-500">.</span></span>',
            esc_html( $site_name )
        );
    }
    
    return $output;
}
