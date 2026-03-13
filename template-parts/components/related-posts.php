<?php
/**
 * Component: Related Posts
 */
$categories = get_the_category( get_the_ID() );
if ( $categories ) {
    $category_ids = [];
    foreach( $categories as $individual_category ) $category_ids[] = $individual_category->term_id;

    $args = [
        'category__in'     => $category_ids,
        'post__not_in'     => [ get_the_ID() ],
        'posts_per_page'   => 3,
        'ignore_sticky_posts' => 1
    ];

    $related_query = new WP_Query( $args );

    if( $related_query->have_posts() ) :
        ?>
        <div class="related-posts my-5">
            <h3 class="related-title h4 mb-4 pb-2 border-bottom"><?php _e( 'Related Posts', 'mundialdesalsa-pro' ); ?></h3>
            <div class="row">
                <?php while( $related_query->have_posts() ) : $related_query->the_post(); ?>
                    <div class="col-md-4">
                        <div class="related-item mb-4">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="mb-2 rounded overflow-hidden">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'mds-pro-list', [ 'class' => 'img-fluid' ] ); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <h4 class="h6"><a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none"><?php the_title(); ?></a></h4>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
        <?php
    endif;
}
