<?php
/**
 * Block: Trending Posts
 */
$args = [
    'posts_per_page' => 5,
    'meta_key'       => 'post_views_count',
    'orderby'        => 'meta_value_num',
    'order'          => 'DESC',
    'post_status'    => 'publish',
];

$trending_query = new WP_Query($args);
?>

<section class="mds-block-trending my-5">
    <div class="container">
        <div class="trending-inner d-flex align-items-center bg-light p-2 rounded-lg">
            <div class="trending-label bg-primary text-white px-3 py-1 rounded mr-3 font-weight-bold">
                <i class="lucide-trending-up mr-1"></i><?php _e( 'Trending', 'mundialdesalsa-pro' ); ?>
            </div>
            <div class="trending-ticker overflow-hidden flex-grow-1">
                <ul class="list-unstyled m-0 d-flex">
                    <?php if ( $trending_query->have_posts() ) : while ( $trending_query->have_posts() ) : $trending_query->the_post(); ?>
                        <li class="mr-4 whitespace-nowrap">
                            <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none font-weight-medium"><?php the_title(); ?></a>
                        </li>
                    <?php endwhile; wp_reset_postdata(); endif; ?>
                </ul>
            </div>
        </div>
    </div>
</section>
