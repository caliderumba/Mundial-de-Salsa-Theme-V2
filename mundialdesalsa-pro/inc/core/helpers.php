<?php
/**
 * AJAX Features: Live Search and Load More
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Live Search AJAX
function mds_pro_ajax_search() {
    check_ajax_referer( 'mds_pro_nonce', 'nonce' );
    
    $query = sanitize_text_field( $_POST['query'] );
    
    $args = [
        'post_type'      => 'post',
        'post_status'    => 'publish',
        's'              => $query,
        'posts_per_page' => 5,
    ];

    $search_query = new WP_Query( $args );

    if ( $search_query->have_posts() ) :
        echo '<ul class="live-search-results list-unstyled m-0">';
        while ( $search_query->have_posts() ) : $search_query->the_post();
            ?>
            <li class="p-2 border-bottom">
                <a href="<?php the_permalink(); ?>" class="d-flex align-items-center text-decoration-none text-dark">
                    <?php if ( has_post_thumbnail() ) the_post_thumbnail( [40, 40], [ 'class' => 'rounded mr-2' ] ); ?>
                    <span><?php the_title(); ?></span>
                </a>
            </li>
            <?php
        endwhile;
        echo '</ul>';
    else :
        echo '<p class="p-3 m-0 text-muted">' . __( 'No results found.', 'mundialdesalsa-pro' ) . '</p>';
    endif;

    wp_die();
}
add_action( 'wp_ajax_mds_pro_search', 'mds_pro_ajax_search' );
add_action( 'wp_ajax_nopriv_mds_pro_search', 'mds_pro_ajax_search' );

// Load More AJAX
function mds_pro_load_more() {
    $paged = $_POST['page'] + 1;
    $args = [
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'paged'          => $paged,
    ];

    $query = new WP_Query( $args );

    if ( $query->have_posts() ) :
        while ( $query->have_posts() ) : $query->the_post();
            get_template_part( 'template-parts/archive/list' );
        endwhile;
    endif;

    wp_die();
}
add_action( 'wp_ajax_mds_pro_load_more', 'mds_pro_load_more' );
add_action( 'wp_ajax_nopriv_mds_pro_load_more', 'mds_pro_load_more' );

/**
 * Sponsored Content Meta Box
 */
function mds_pro_add_sponsored_meta_box() {
    add_meta_box(
        'mds_pro_sponsored_meta',
        __( 'Contenido Patrocinado', 'mundialdesalsa-pro' ),
        'mds_pro_sponsored_meta_box_callback',
        'post',
        'side'
    );
}
add_action( 'add_meta_boxes', 'mds_pro_add_sponsored_meta_box' );

function mds_pro_sponsored_meta_box_callback( $post ) {
    wp_nonce_field( 'mds_pro_save_sponsored_meta', 'mds_pro_sponsored_nonce' );
    $value = get_post_meta( $post->ID, '_mds_pro_is_sponsored', true );
    ?>
    <label for="mds_pro_is_sponsored">
        <input type="checkbox" id="mds_pro_is_sponsored" name="mds_pro_is_sponsored" value="1" <?php checked( $value, '1' ); ?> />
        <?php _e( 'Marcar como contenido patrocinado', 'mundialdesalsa-pro' ); ?>
    </label>
    <?php
}

function mds_pro_save_sponsored_meta( $post_id ) {
    if ( ! isset( $_POST['mds_pro_sponsored_nonce'] ) || ! wp_verify_nonce( $_POST['mds_pro_sponsored_nonce'], 'mds_pro_save_sponsored_meta' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    $is_sponsored = isset( $_POST['mds_pro_is_sponsored'] ) ? '1' : '0';
    update_post_meta( $post_id, '_mds_pro_is_sponsored', $is_sponsored );
}
add_action( 'save_post', 'mds_pro_save_sponsored_meta' );

/**
 * Display Sponsored Badge
 */
function mds_pro_sponsored_badge() {
    if ( get_post_meta( get_the_ID(), '_mds_pro_is_sponsored', true ) === '1' ) {
        echo '<span class="bg-amber-100 text-amber-800 text-xs font-bold px-2 py-1 rounded-full uppercase tracking-wider mb-2 inline-block dark:bg-amber-900 dark:text-amber-100">' . __( 'Patrocinado', 'mundialdesalsa-pro' ) . '</span>';
    }
}

/**
 * Track Post Views
 */
function mds_pro_track_post_views() {
    if ( ! is_single() ) {
        return;
    }

    $post_id = get_the_ID();
    $count   = get_post_meta( $post_id, 'mds_pro_views_count', true );
    $count   = ( $count === '' ) ? 0 : (int) $count;
    $count++;

    update_post_meta( $post_id, 'mds_pro_views_count', $count );
}
add_action( 'wp_head', 'mds_pro_track_post_views' );

/**
 * Social Sharing Buttons
 */
function mds_pro_social_sharing() {
    $url   = urlencode( get_permalink() );
    $title = urlencode( get_the_title() );
    $image = urlencode( get_the_post_thumbnail_url( get_the_ID(), 'full' ) );

    $facebook_url = "https://www.facebook.com/sharer/sharer.php?u={$url}";
    $twitter_url  = "https://twitter.com/intent/tweet?text={$title}&url={$url}";
    $linkedin_url = "https://www.linkedin.com/shareArticle?mini=true&url={$url}&title={$title}";
    $email_url    = "mailto:?subject={$title}&body={$url}";

    ?>
    <div class="mds-social-sharing flex items-center gap-4 my-12 py-8 border-y border-slate-100 dark:border-slate-800">
        <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Compartir:</span>
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

/**
 * Calculate Reading Time
 */
function mds_pro_get_reading_time( $post_id = 0 ) {
    $post_id = $post_id ? $post_id : get_the_ID();
    $content = get_post_field( 'post_content', $post_id );
    $word_count = str_word_count( strip_tags( $content ) );
    $reading_time = ceil( $word_count / 200 ); // Average 200 words per minute
    
    return $reading_time;
}

/**
 * Get Theme Logo
 */
function mds_pro_get_logo() {
    $logo_main = mds_pro_get_option( 'header_settings', 'header_logo', array() );
    $logo_dark = mds_pro_get_option( 'header_settings', 'header_logo_dark', array() );
    $site_name = mds_pro_get_option( 'general', 'site_name', 'MundialdeSalsa' );
    
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

/**
 * Render Post Video (SEO Priority)
 */
function mds_pro_render_post_video() {
    $video_url   = get_post_meta( get_the_ID(), 'mds_post_video_url', true );
    $video_embed = get_post_meta( get_the_ID(), 'mds_post_video_embed', true );
    $video_self  = get_post_meta( get_the_ID(), 'mds_post_video_self', true );
    $layout      = get_post_meta( get_the_ID(), 'mds_post_video_layout', true );

    if ( empty( $video_url ) && empty( $video_embed ) && empty( $video_self['url'] ) ) {
        return;
    }

    $container_class = 'mds-video-container mb-8 overflow-hidden rounded-salsa shadow-lg';
    if ( $layout === 'boxed' ) {
        $container_class .= ' container mx-auto px-4';
    }

    echo '<div class="' . esc_attr( $container_class ) . '" style="--mds-radius: var(--mds-radius, 12px);">';
    
    if ( ! empty( $video_embed ) ) {
        echo '<div class="aspect-video w-full">' . $video_embed . '</div>';
    } elseif ( ! empty( $video_url ) ) {
        echo '<div class="aspect-video w-full">' . wp_oembed_get( $video_url ) . '</div>';
    } elseif ( ! empty( $video_self['url'] ) ) {
        echo '<video controls class="w-full h-auto"><source src="' . esc_url( $video_self['url'] ) . '" type="video/mp4"></video>';
    }

    echo '</div>';
}

/**
 * Render Post Highlights
 */
function mds_pro_render_post_highlights() {
    $highlights = get_post_meta( get_the_ID(), 'mds_post_highlights', true );

    if ( empty( $highlights ) || ! is_array( $highlights ) ) {
        return;
    }

    ?>
    <div class="mds-post-highlights p-6 mb-8 border-l-4 border-salsa bg-slate-50 dark:bg-slate-900 rounded-r-salsa" style="--mds-primary: var(--mds-primary, #e74c3c); --mds-radius: var(--mds-radius, 12px);">
        <h4 class="text-xs font-black uppercase tracking-widest text-slate-400 mb-4"><?php _e( 'Puntos Clave', 'mundialdesalsa-pro' ); ?></h4>
        <ul class="list-none p-0 m-0 space-y-3">
            <?php foreach ( $highlights as $point ) : if ( empty( $point ) ) continue; ?>
                <li class="flex items-start gap-3 text-sm font-medium text-slate-700 dark:text-slate-300">
                    <svg class="w-5 h-5 text-salsa shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    <span><?php echo esc_html( $point ); ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php
}

/**
 * Render Post Sources
 */
function mds_pro_render_post_sources() {
    $sources = get_post_meta( get_the_ID(), 'mds_post_sources', true );
    $links   = get_post_meta( get_the_ID(), 'mds_post_source_links', true );

    if ( empty( $sources ) || ! is_array( $sources ) ) {
        return;
    }

    ?>
    <div class="mds-post-sources mt-12 pt-8 border-t border-slate-100 dark:border-slate-800">
        <span class="text-[10px] font-black uppercase tracking-widest text-slate-400 block mb-4"><?php _e( 'Fuentes & Via:', 'mundialdesalsa-pro' ); ?></span>
        <div class="flex flex-wrap gap-x-6 gap-y-2">
            <?php foreach ( $sources as $index => $source ) : if ( empty( $source ) ) continue; ?>
                <div class="flex items-center gap-2 text-xs font-bold text-slate-500">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.828a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                    <?php if ( ! empty( $links[$index] ) ) : ?>
                        <a href="<?php echo esc_url( $links[$index] ); ?>" target="_blank" rel="nofollow" class="hover:text-salsa transition-colors"><?php echo esc_html( $source ); ?></a>
                    <?php else : ?>
                        <span><?php echo esc_html( $source ); ?></span>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
}
