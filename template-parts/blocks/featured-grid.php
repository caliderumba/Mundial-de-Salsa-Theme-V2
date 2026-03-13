<?php
/**
 * Block: Featured Grid (Magazine Style)
 */
$data = get_query_var('block_data');
$args = [
    'posts_per_page' => 5,
    'post_status'    => 'publish',
];
$query = new WP_Query($args);
?>

<section class="mds-block-featured-grid my-5">
    <div class="container">
        <div class="row no-gutters rounded-xl overflow-hidden shadow-sm">
            <?php if ( $query->have_posts() ) : $count = 0; while ( $query->have_posts() ) : $query->the_post(); $count++; ?>
                <?php if ( $count === 1 ) : ?>
                    <div class="col-lg-6">
                        <article class="grid-item grid-item-large position-relative h-100 min-vh-50">
                            <div class="item-bg position-absolute w-100 h-100" style="background-image: url(<?php the_post_thumbnail_url('mds-pro-hero'); ?>); background-size: cover; background-position: center;"></div>
                            <div class="item-overlay position-absolute w-100 h-100 d-flex align-items-end p-4" style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);">
                                <div class="item-content text-white">
                                    <span class="badge badge-primary mb-2"><?php the_category(', '); ?></span>
                                    <h3 class="h2"><a href="<?php the_permalink(); ?>" class="text-white text-decoration-none"><?php the_title(); ?></a></h3>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="col-lg-6">
                        <div class="row no-gutters h-100">
                <?php else : ?>
                    <div class="col-md-6">
                        <article class="grid-item grid-item-small position-relative min-vh-25 border-left border-bottom border-white/10">
                            <div class="item-bg position-absolute w-100 h-100" style="background-image: url(<?php the_post_thumbnail_url('mds-pro-grid'); ?>); background-size: cover; background-position: center;"></div>
                            <div class="item-overlay position-absolute w-100 h-100 d-flex align-items-end p-3" style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
                                <div class="item-content text-white">
                                    <h4 class="h6 m-0"><a href="<?php the_permalink(); ?>" class="text-white text-decoration-none"><?php the_title(); ?></a></h4>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php endif; ?>
            <?php endwhile; echo '</div></div>'; wp_reset_postdata(); endif; ?>
        </div>
    </div>
</section>
