<?php
/**
 * Block: Latest Posts
 */
$data = get_query_var('block_data');
$args = [
    'posts_per_page' => $data['limit'] ?? 6,
    'post_status'    => 'publish',
];

$latest_query = new WP_Query($args);
?>

<section class="mds-block-latest my-5">
    <div class="container">
        <div class="block-header d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
            <h2 class="block-title h3 m-0"><?php _e( 'Latest News', 'mundialdesalsa-pro' ); ?></h2>
            <a href="<?php echo get_post_type_archive_link('post'); ?>" class="view-all text-primary font-weight-bold"><?php _e( 'View All', 'mundialdesalsa-pro' ); ?></a>
        </div>

        <div class="row">
            <?php if ( $latest_query->have_posts() ) : ?>
                <?php while ( $latest_query->have_posts() ) : $latest_query->the_post(); ?>
                    <div class="col-md-6 col-lg-4">
                        <?php get_template_part( 'template-parts/archive/grid' ); ?>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>
    </div>
</section>
