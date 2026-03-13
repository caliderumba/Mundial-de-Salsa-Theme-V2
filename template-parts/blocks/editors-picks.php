<?php
/**
 * Block: Editors Picks
 */
$data = get_query_var('block_data');
$args = [
    'posts_per_page' => 4,
    'tag'            => 'editors-pick', // Assuming posts are tagged
    'post_status'    => 'publish',
];

$picks_query = new WP_Query($args);
?>

<section class="mds-block-editors-picks my-5">
    <div class="container">
        <div class="block-header mb-4">
            <h2 class="h3 border-left border-primary pl-3"><?php _e( "Editor's Picks", 'mundialdesalsa-pro' ); ?></h2>
        </div>
        <div class="row">
            <?php if ( $picks_query->have_posts() ) : while ( $picks_query->have_posts() ) : $picks_query->the_post(); ?>
                <div class="col-md-6 mb-4">
                    <div class="pick-item d-flex align-items-center">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="pick-thumb mr-3" style="width: 150px; flex-shrink: 0;">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'mds-pro-list', [ 'class' => 'rounded-lg img-fluid' ] ); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="pick-content">
                            <h3 class="h6 mb-1"><a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none"><?php the_title(); ?></a></h3>
                            <div class="small text-muted"><?php echo get_the_date(); ?></div>
                        </div>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata(); endif; ?>
        </div>
    </div>
</section>
