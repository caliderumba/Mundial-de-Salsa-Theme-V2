<?php
/**
 * Related Posts Template Part
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id = get_the_ID();
$categories = get_the_category( $post_id );
$cat_ids = array();

if ( $categories ) {
    foreach ( $categories as $category ) {
        $cat_ids[] = $category->term_id;
    }
}

$related_query = new WP_Query( array(
    'category__in'        => $cat_ids,
    'post__not_in'        => array( $post_id ),
    'posts_per_page'      => 3,
    'ignore_sticky_posts' => 1,
) );

if ( $related_query->have_posts() ) : ?>
    <div class="related-posts mt-16 pt-12 border-t border-slate-100 dark:border-slate-800">
        <h3 class="text-2xl font-black uppercase italic tracking-tighter mb-8 text-slate-900 dark:text-white">También te puede <span class="text-emerald-500">interesar</span></h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
                <article class="group">
                    <div class="aspect-video overflow-hidden rounded-2xl mb-4 relative">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-110' ) ); ?>
                        <?php else : ?>
                            <img src="https://picsum.photos/seed/salsa<?php the_ID(); ?>/600/400" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="">
                        <?php endif; ?>
                    </div>
                    <h4 class="text-sm font-bold leading-tight italic tracking-tight group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors text-slate-900 dark:text-white">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                </article>
            <?php endwhile; ?>
        </div>
    </div>
<?php 
endif;
wp_reset_postdata();
