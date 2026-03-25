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
    // Allow disabling social meta via filter
    if ( ! apply_filters( 'mds_enable_social_meta', true ) ) {
        return;
    }

    if ( is_admin() ) {
        return;
    }

    $queried_id  = get_queried_object_id();
    $site_name   = get_bloginfo( 'name' );
    $description = get_bloginfo( 'description' );
    $url         = home_url( '/' );
    $type        = 'website';
    $title       = get_bloginfo( 'name' );
    
    // Default image from site settings
    $image_data = mds_get_primary_image_data( 0 );

    if ( is_singular() ) {
        $type        = 'article';
        $title       = get_the_title( $queried_id );
        $description = has_excerpt( $queried_id ) ? get_the_excerpt( $queried_id ) : wp_strip_all_tags( get_the_content( null, false, $queried_id ) );
        $url         = get_permalink( $queried_id );
        $image_data  = mds_get_primary_image_data( $queried_id );
    } elseif ( is_category() || is_tag() || is_tax() ) {
        $term        = get_queried_object();
        $title       = $term->name;
        $description = $term->description ?: sprintf( __( 'Explora lo mejor de %s en Mundial de Salsa.', 'mds-pro' ), $term->name );
        $url         = get_term_link( $term );
    } elseif ( is_front_page() ) {
        $title       = get_bloginfo( 'name' );
        $description = get_bloginfo( 'description' );
        $url         = home_url( '/' );
    }

    // Clean description
    $description = wp_strip_all_tags( $description );
    $description = wp_trim_words( $description, 30, '...' );

    ?>
    <!-- Open Graph -->
    <meta property="og:site_name" content="<?php echo esc_attr( $site_name ); ?>">
    <meta property="og:type" content="<?php echo esc_attr( $type ); ?>">
    <meta property="og:title" content="<?php echo esc_attr( $title ); ?>">
    <meta property="og:description" content="<?php echo esc_attr( $description ); ?>">
    <meta property="og:url" content="<?php echo esc_url( $url ); ?>">
    <?php if ( ! empty( $image_data['url'] ) ) : ?>
        <meta property="og:image" content="<?php echo esc_url( $image_data['url'] ); ?>">
        <meta property="og:image:width" content="<?php echo esc_attr( $image_data['width'] ); ?>">
        <meta property="og:image:height" content="<?php echo esc_attr( $image_data['height'] ); ?>">
    <?php endif; ?>

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr( $title ); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr( $description ); ?>">
    <?php if ( ! empty( $image_data['url'] ) ) : ?>
        <meta name="twitter:image" content="<?php echo esc_url( $image_data['url'] ); ?>">
    <?php endif; ?>
    <?php
}
add_action( 'wp_head', 'mds_output_social_meta', 5 );

/**
 * Get Social Links from Theme Options.
 * Only returns networks with valid URLs.
 * 
 * @return array Map of social networks.
 */
function mds_get_social_links() {
    $networks = array(
        'facebook'  => array( 'label' => 'Facebook', 'icon' => 'fa-brands fa-facebook-f', 'key' => 'social_facebook' ),
        'instagram' => array( 'label' => 'Instagram', 'icon' => 'fa-brands fa-instagram', 'key' => 'social_instagram' ),
        'twitter'   => array( 'label' => 'Twitter', 'icon' => 'fa-brands fa-x-twitter', 'key' => 'social_twitter' ),
        'youtube'   => array( 'label' => 'YouTube', 'icon' => 'fa-brands fa-youtube', 'key' => 'social_youtube' ),
    );

    $valid_links = array();

    foreach ( $networks as $id => $data ) {
        // Use helper to get option safely
        $url = mds_pro_get_option( 'social', $data['key'], '' );
        
        if ( ! empty( $url ) && $url !== '#' ) {
            $valid_links[$id] = array(
                'url'   => esc_url( $url ), // Sane URL
                'label' => esc_html( $data['label'] ),
                'icon'  => esc_attr( $data['icon'] ),
            );
        }
    }

    return $valid_links;
}

/**
 * Social Sharing Buttons
 */
function mds_pro_social_sharing() {
    $post_id = get_the_ID();
    $url     = urlencode( get_permalink( $post_id ) );
    $title   = urlencode( get_the_title( $post_id ) );
    
    // Use theme's primary image engine
    $image_data = mds_get_primary_image_data( $post_id );
    $image_url  = urlencode( $image_data['url'] );

    $facebook_url = "https://www.facebook.com/sharer/sharer.php?u={$url}";
    $twitter_url  = "https://twitter.com/intent/tweet?text={$title}&url={$url}";
    $linkedin_url = "https://www.linkedin.com/shareArticle?mini=true&url={$url}&title={$title}";
    $email_url    = "mailto:?subject={$title}&body={$url}";

    ?>
    <div class="mds-social-sharing flex items-center gap-4 my-12 py-8 border-y border-slate-100 dark:border-slate-800">
        <span class="text-[10px] font-black uppercase tracking-widest text-slate-400"><?php esc_html_e( 'Compartir:', 'mundialdesalsa-pro' ); ?></span>
        <div class="flex gap-3">
            <a href="<?php echo esc_url( $facebook_url ); ?>" target="_blank" rel="nofollow" class="w-10 h-10 rounded-full border border-slate-100 dark:border-slate-800 flex items-center justify-center hover:bg-blue-600 hover:text-white hover:border-blue-600 transition-all text-slate-600 dark:text-slate-400" title="Facebook">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
            </a>
            <a href="<?php echo esc_url( $twitter_url ); ?>" target="_blank" rel="nofollow" class="w-10 h-10 rounded-full border border-slate-100 dark:border-slate-800 flex items-center justify-center hover:bg-black hover:text-white hover:border-black transition-all text-slate-600 dark:text-slate-400" title="Twitter">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
            </a>
            <a href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank" rel="nofollow" class="w-10 h-10 rounded-full border border-slate-100 dark:border-slate-800 flex items-center justify-center hover:bg-blue-700 hover:text-white hover:border-blue-700 transition-all text-slate-600 dark:text-slate-400" title="LinkedIn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
            </a>
            <a href="<?php echo esc_url( $email_url ); ?>" class="w-10 h-10 rounded-full border border-slate-100 dark:border-slate-800 flex items-center justify-center hover:bg-emerald-500 hover:text-white hover:border-emerald-500 transition-all text-slate-600 dark:text-slate-400" title="Email">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            </a>
        </div>
    </div>
    <?php
}
