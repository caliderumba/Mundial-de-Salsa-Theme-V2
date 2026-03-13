<?php
/**
 * Traffic Engine: Infinite Scroll & Next Post Suggestions
 */

/**
 * AJAX handler for Infinite Scroll
 */
function mds_pro_ajax_infinite_scroll() {
    $paged = $_POST['page'] + 1;
    $query_args = json_decode( stripslashes( $_POST['query'] ), true );
    $query_args['paged'] = $paged;
    $query_args['post_status'] = 'publish';

    $loop = new WP_Query( $query_args );

    if ( $loop->have_posts() ) :
        while ( $loop->have_posts() ) : $loop->the_post();
            get_template_part( 'template-parts/archive/' . mds_pro_get_layout('archive') );
        endwhile;
    endif;

    wp_die();
}
add_action( 'wp_ajax_mds_infinite_scroll', 'mds_pro_ajax_infinite_scroll' );
add_action( 'wp_ajax_nopriv_mds_infinite_scroll', 'mds_pro_ajax_infinite_scroll' );

/**
 * Next Post Suggestion (Auto-load next post logic)
 */
function mds_pro_get_next_post_suggestion() {
    $next_post = get_next_post();
    if ( ! empty( $next_post ) ) {
        return $next_post->ID;
    }
    return false;
}
