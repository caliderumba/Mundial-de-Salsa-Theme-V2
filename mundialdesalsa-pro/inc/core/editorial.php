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
 * @param int|null $post_id Post ID. Null uses get_the_ID().
 * @return string Context: 'video', 'event', 'profile', 'news'.
 */
function mds_get_post_context( $post_id = null ) {
    $post_id = ( null === $post_id ) ? get_the_ID() : $post_id;
    $post_id = absint( $post_id );
    
    if ( ! $post_id ) {
        return 'news';
    }
    
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
 * @param int|null $post_id Post ID. Null uses get_the_ID().
 * @return bool True if updated.
 */
function mds_is_post_updated( $post_id = null ) {
    $post_id = ( null === $post_id ) ? get_the_ID() : $post_id;
    $post_id = absint( $post_id );
    
    if ( ! $post_id ) {
        return false;
    }
    
    $published = get_the_date( 'U', $post_id );
    $modified  = get_the_modified_date( 'U', $post_id );

    // If modified more than 24 hours after published
    return ( $modified - $published ) > 86400;
}

/**
 * Get Trending Posts (Lo Más Visto) with Transient Caching.
 * 
 * @param int $count Number of posts to retrieve.
 * @return array List of post data.
 */
function mds_get_trending_posts( $count = 3 ) {
    $count = absint( $count );
    $transient_key = 'mds_trending_posts_' . $count;
    $trending_data = get_transient( $transient_key );

    if ( false === $trending_data ) {
        $trending_query = new WP_Query( array(
            'posts_per_page' => $count,
            'post_status'    => 'publish',
            'orderby'        => 'meta_value_num',
            'meta_key'       => 'mds_pro_views_count',
            'no_found_rows'  => true,
            'ignore_sticky_posts' => true,
        ) );

        $trending_data = array();

        if ( $trending_query->have_posts() ) {
            while ( $trending_query->have_posts() ) {
                $trending_query->the_post();
                $trending_data[] = array(
                    'title' => get_the_title(),
                    'link'  => get_permalink(),
                );
            }
            wp_reset_postdata();
        }

        // Cache for 1 hour
        set_transient( $transient_key, $trending_data, HOUR_IN_SECONDS );
    }

    return $trending_data;
}

/**
 * Calculate Reading Time
 */
function mds_pro_get_reading_time( $post_id = 0 ) {
    $post_id = $post_id ? absint( $post_id ) : get_the_ID();
    $content = get_post_field( 'post_content', $post_id );
    $word_count = str_word_count( strip_tags( $content ) );
    $reading_time = ceil( $word_count / 200 ); // Average 200 words per minute
    
    return $reading_time;
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
        <h4 class="text-xs font-black uppercase tracking-widest text-slate-400 mb-4"><?php esc_html_e( 'Puntos Clave', 'mundialdesalsa-pro' ); ?></h4>
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
        <span class="text-[10px] font-black uppercase tracking-widest text-slate-400 block mb-4"><?php esc_html_e( 'Fuentes & Via:', 'mundialdesalsa-pro' ); ?></span>
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
