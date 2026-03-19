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
 * Breadcrumbs Functionality
 */
function mds_pro_breadcrumbs() {
    if ( ! mds_pro_get_option( 'general', 'breadcrumbs', true ) ) {
        return;
    }

    if ( is_front_page() ) {
        return;
    }

    echo '<nav class="breadcrumbs text-xs font-bold uppercase tracking-widest text-slate-400 mb-8 flex items-center gap-2">';
    echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="hover:text-emerald-500">' . esc_html__( 'Inicio', 'mundialdesalsa-pro' ) . '</a>';
    echo '<span class="text-slate-300">/</span>';

    if ( is_category() || is_single() ) {
        $categories = get_the_category();
        if ( ! empty( $categories ) ) {
            echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '" class="hover:text-emerald-500">' . esc_html( $categories[0]->name ) . '</a>';
        }
        if ( is_single() ) {
            echo '<span class="text-slate-300">/</span>';
            echo '<span class="text-slate-600">' . get_the_title() . '</span>';
        }
    } elseif ( is_page() ) {
        echo '<span class="text-slate-600">' . get_the_title() . '</span>';
    } elseif ( is_archive() ) {
        the_archive_title( '<span class="text-slate-600">', '</span>' );
    } elseif ( is_search() ) {
        echo '<span class="text-slate-600">' . sprintf( esc_html__( 'Búsqueda: %s', 'mundialdesalsa-pro' ), get_search_query() ) . '</span>';
    }

    echo '</nav>';
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
