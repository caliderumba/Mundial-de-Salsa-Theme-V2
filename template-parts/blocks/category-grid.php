<?php
/**
 * Block: Category Grid
 */
$data = get_query_var('block_data');
$cat_id = $data['category'] ?? 0;
$cat_name = get_cat_name($cat_id);

$args = [
    'posts_per_page' => $data['limit'] ?? 4,
    'cat'            => $cat_id,
    'post_status'    => 'publish',
];

$cat_query = new WP_Query($args);
?>

<section class="mds-block-category-grid my-5">
    <div class="container">
        <div class="block-header d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom" style="border-color: var(--primary-color) !important;">
            <h2 class="block-title h3 m-0"><?php echo esc_html($cat_name); ?></h2>
            <a href="<?php echo get_category_link($cat_id); ?>" class="view-all text-primary font-weight-bold"><?php _e( 'More in', 'mundialdesalsa-pro' ); ?> <?php echo esc_html($cat_name); ?></a>
        </div>

        <div class="row">
            <?php if ( $cat_query->have_posts() ) : ?>
                <?php 
                $count = 0;
                while ( $cat_query->have_posts() ) : $cat_query->the_post(); 
                    $count++;
                    if ( $count === 1 ) :
                ?>
                    <div class="col-lg-6">
                        <article class="featured-cat-item mb-4">
                            <div class="post-thumbnail mb-3 overflow-hidden rounded-lg">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'mds-pro-grid', [ 'class' => 'img-fluid' ] ); ?>
                                </a>
                            </div>
                            <h3 class="h2"><a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none"><?php the_title(); ?></a></h3>
                            <?php get_template_part( 'template-parts/components/post-meta' ); ?>
                            <p class="mt-3 text-muted"><?php echo wp_trim_words(get_the_excerpt(), 30); ?></p>
                        </article>
                    </div>
                    <div class="col-lg-6">
                        <div class="cat-list-items">
                <?php else : ?>
                        <div class="cat-small-item d-flex mb-3 pb-3 border-bottom">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="post-thumbnail mr-3" style="width: 100px; flex-shrink: 0;">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'thumbnail', [ 'class' => 'rounded' ] ); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="post-content">
                                <h4 class="h6 mb-1"><a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none"><?php the_title(); ?></a></h4>
                                <time class="small text-muted"><?php echo get_the_date(); ?></time>
                            </div>
                        </div>
                <?php 
                    endif;
                endwhile; 
                echo '</div></div>'; // Close cat-list-items and col-lg-6
                wp_reset_postdata(); 
                ?>
            <?php endif; ?>
        </div>
    </div>
</section>
