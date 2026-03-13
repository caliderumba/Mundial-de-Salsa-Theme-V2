<?php
/**
 * Component: Trending Ticker (Mini)
 */
$trending = mds_pro_get_trending_posts(3);
?>
<div class="trending-ticker-mini d-inline-block">
    <span class="badge badge-primary mr-2"><?php _e( 'Trending', 'mundialdesalsa-pro' ); ?></span>
    <div class="ticker-content d-inline-block overflow-hidden" style="vertical-align: middle; height: 20px;">
        <?php if ( $trending->have_posts() ) : while ( $trending->have_posts() ) : $trending->the_post(); ?>
            <a href="<?php the_permalink(); ?>" class="text-white opacity-75 hover-opacity-100 mr-4 small"><?php the_title(); ?></a>
        <?php endwhile; wp_reset_postdata(); endif; ?>
    </div>
</div>
