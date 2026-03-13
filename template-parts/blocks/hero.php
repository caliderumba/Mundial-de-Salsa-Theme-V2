<?php
/**
 * Block: Hero Section
 */
$data = get_query_var('block_data');
$args = [
    'posts_per_page' => $data['limit'] ?? 5,
    'post_status'    => 'publish',
];

if ( !empty($data['category']) ) {
    $args['cat'] = $data['category'];
}

$hero_query = new WP_Query($args);
?>

<section class="mds-block-hero">
    <div class="container-fluid p-0">
        <?php if ( $hero_query->have_posts() ) : ?>
            <div class="hero-slider">
                <?php while ( $hero_query->have_posts() ) : $hero_query->the_post(); ?>
                    <article class="hero-item" style="background-image: url(<?php the_post_thumbnail_url('mds-pro-hero'); ?>)">
                        <div class="hero-overlay">
                            <div class="container">
                                <div class="hero-content">
                                    <span class="category-badge"><?php the_category(', '); ?></span>
                                    <h2 class="hero-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <div class="post-meta">
                                        <span class="author"><?php the_author(); ?></span>
                                        <span class="date"><?php echo get_the_date(); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        <?php endif; ?>
    </div>
</section>
