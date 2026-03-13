<?php
/**
 * AJAX Features: Live Search and Load More
 */

// Live Search AJAX
function mds_pro_ajax_search() {
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
