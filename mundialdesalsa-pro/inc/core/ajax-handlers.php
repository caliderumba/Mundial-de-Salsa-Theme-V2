<?php
/**
 * AJAX Handlers for Live Updates, Search, and Load More.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Live Search AJAX
 */
function mds_pro_ajax_search() {
    // 1. Security: Nonce check
    check_ajax_referer( 'mds_pro_nonce', 'nonce' );
    
    // 2. Validation: Check if query exists and is not empty
    if ( ! isset( $_POST['query'] ) || empty( trim( $_POST['query'] ) ) ) {
        wp_send_json_error( array( 'message' => __( 'Empty search query.', 'mundialdesalsa-pro' ) ) );
    }

    $query = sanitize_text_field( $_POST['query'] );
    
    $args = [
        'post_type'      => 'post',
        'post_status'    => 'publish',
        's'              => $query,
        'posts_per_page' => 5,
        'no_found_rows'  => true, // Performance optimization
    ];

    $search_query = new WP_Query( $args );

    ob_start();
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
        echo '<p class="p-3 m-0 text-muted">' . esc_html__( 'No results found.', 'mundialdesalsa-pro' ) . '</p>';
    endif;
    $html = ob_get_clean();

    wp_send_json_success( array( 'html' => $html ) );
}
add_action( 'wp_ajax_mds_pro_search', 'mds_pro_ajax_search' );
add_action( 'wp_ajax_nopriv_mds_pro_search', 'mds_pro_ajax_search' );

/**
 * Load More AJAX
 */
function mds_pro_load_more() {
    // 1. Security: Nonce check
    check_ajax_referer( 'mds_pro_nonce', 'nonce' );

    // 2. Validation: Ensure page is set and is an integer
    $page = isset( $_POST['page'] ) ? absint( $_POST['page'] ) : 0;
    if ( $page < 1 ) {
        wp_send_json_error( array( 'message' => __( 'Invalid page number.', 'mundialdesalsa-pro' ) ) );
    }

    $paged = $page + 1;
    $args = [
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'paged'          => $paged,
    ];

    $query = new WP_Query( $args );

    ob_start();
    if ( $query->have_posts() ) :
        while ( $query->have_posts() ) : $query->the_post();
            get_template_part( 'template-parts/archive/list' );
        endwhile;
    else :
        wp_send_json_error( array( 'message' => __( 'No more posts.', 'mundialdesalsa-pro' ) ) );
    endif;
    $html = ob_get_clean();

    wp_send_json_success( array( 'html' => $html ) );
}
add_action( 'wp_ajax_mds_pro_load_more', 'mds_pro_load_more' );
add_action( 'wp_ajax_nopriv_mds_pro_load_more', 'mds_pro_load_more' );

/**
 * Get Live Updates for a post
 */
function mds_pro_ajax_get_live_updates() {
    check_ajax_referer( 'mds_live_nonce', 'nonce' );

    $post_id = isset( $_POST['post_id'] ) ? intval( $_POST['post_id'] ) : 0;
    if ( ! $post_id ) {
        wp_send_json_error( array( 'message' => 'Invalid Post ID' ) );
    }

    $updates = get_post_meta( $post_id, 'mds_live_updates', true );
    $html = mds_pro_render_live_updates( array( 'updates' => $updates ) );

    wp_send_json_success( array( 'html' => $html ) );
}
add_action( 'wp_ajax_mds_get_live_updates', 'mds_pro_ajax_get_live_updates' );
add_action( 'wp_ajax_nopriv_mds_get_live_updates', 'mds_pro_ajax_get_live_updates' );

/**
 * Get Live Scores for a post
 */
function mds_pro_ajax_get_live_scores() {
    check_ajax_referer( 'mds_live_nonce', 'nonce' );

    $post_id = isset( $_POST['post_id'] ) ? intval( $_POST['post_id'] ) : 0;
    if ( ! $post_id ) {
        wp_send_json_error( array( 'message' => 'Invalid Post ID' ) );
    }

    $scores = get_post_meta( $post_id, 'mds_live_scores', true );
    $title = get_post_meta( $post_id, 'mds_live_score_title', true );
    $html = mds_pro_render_live_score( array( 'scores' => $scores, 'title' => $title ) );

    wp_send_json_success( array( 'html' => $html ) );
}
add_action( 'wp_ajax_mds_get_live_scores', 'mds_pro_ajax_get_live_scores' );
add_action( 'wp_ajax_nopriv_mds_get_live_scores', 'mds_pro_ajax_get_live_scores' );
