<?php
/**
 * MundialdeSalsa Pro Social Meta Tags (Open Graph & Twitter Cards)
 * 
 * Centralized logic for social meta tags.
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Output Social Meta Tags in wp_head
 */
function mds_output_social_meta() {
    if ( is_admin() ) {
        return;
    }

    $post_id     = get_the_ID();
    $site_name   = get_bloginfo( 'name' );
    $description = get_bloginfo( 'description' );
    $url         = home_url( add_query_arg( [], $GLOBALS['wp']->request ) );
    $type        = 'website';
    $title       = get_bloginfo( 'name' );
    
    // Default image from logo
    $logo = mds_pro_get_option( 'header_settings', 'header_logo', [] );
    $image_data = [
        'url'    => ! empty( $logo['url'] ) ? $logo['url'] : '',
        'width'  => 1200,
        'height' => 630,
    ];

    if ( is_singular() ) {
        $type        = 'article';
        $title       = get_the_title();
        $description = get_the_excerpt();
        $url         = get_permalink();
        $image_data  = mds_get_primary_image_data( $post_id );
    } elseif ( is_category() ) {
        $title       = single_cat_title( '', false );
        $description = strip_tags( category_description() );
    }

    ?>
    <!-- Open Graph -->
    <meta property="og:site_name" content="<?php echo esc_attr( $site_name ); ?>">
    <meta property="og:type" content="<?php echo esc_attr( $type ); ?>">
    <meta property="og:title" content="<?php echo esc_attr( $title ); ?>">
    <meta property="og:description" content="<?php echo esc_attr( wp_trim_words( $description, 30 ) ); ?>">
    <meta property="og:url" content="<?php echo esc_url( $url ); ?>">
    <?php if ( ! empty( $image_data['url'] ) ) : ?>
        <meta property="og:image" content="<?php echo esc_url( $image_data['url'] ); ?>">
        <meta property="og:image:width" content="<?php echo esc_attr( $image_data['width'] ?? '1200' ); ?>">
        <meta property="og:image:height" content="<?php echo esc_attr( $image_data['height'] ?? '630' ); ?>">
    <?php endif; ?>

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr( $title ); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr( wp_trim_words( $description, 30 ) ); ?>">
    <?php if ( ! empty( $image_data['url'] ) ) : ?>
        <meta name="twitter:image" content="<?php echo esc_url( $image_data['url'] ); ?>">
    <?php endif; ?>
    <?php
}
add_action( 'wp_head', 'mds_output_social_meta', 5 );
