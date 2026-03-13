<?php
/**
 * Block: Video Section
 */
$data = get_query_var('block_data');
$args = [
    'posts_per_page' => $data['limit'] ?? 3,
    'meta_key'       => '_mds_video_url',
    'meta_compare'   => 'EXISTS',
    'post_status'    => 'publish',
];

$video_query = new WP_Query($args);
?>

<section class="mds-block-video py-5 bg-dark text-white">
    <div class="container">
        <div class="block-header d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom border-secondary">
            <h2 class="block-title h3 m-0 text-white"><i class="lucide-play-circle mr-2"></i><?php _e( 'Video Gallery', 'mundialdesalsa-pro' ); ?></h2>
        </div>

        <div class="row">
            <?php if ( $video_query->have_posts() ) : ?>
                <?php while ( $video_query->have_posts() ) : $video_query->the_post(); ?>
                    <div class="col-md-4">
                        <article class="video-item mb-4">
                            <div class="video-thumbnail position-relative mb-3 rounded-lg overflow-hidden">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'mds-pro-grid', [ 'class' => 'img-fluid' ] ); ?>
                                    <div class="play-icon position-absolute top-50 left-50 translate-middle">
                                        <i class="lucide-play bg-primary p-3 rounded-circle text-white shadow"></i>
                                    </div>
                                </a>
                            </div>
                            <h3 class="h6"><a href="<?php the_permalink(); ?>" class="text-white text-decoration-none"><?php the_title(); ?></a></h3>
                        </article>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>
    </div>
</section>
