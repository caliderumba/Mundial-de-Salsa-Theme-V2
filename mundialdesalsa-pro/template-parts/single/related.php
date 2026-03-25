<?php
/**
 * Single Post Related Posts - Mundial de Salsa Pro
 * 
 * Displays related posts based on the current post's category.
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id    = get_the_ID();
$categories = wp_get_post_categories( $post_id );
$context    = mds_get_post_context( $post_id );

if ( empty( $categories ) ) {
	return;
}

$args = [
	'post_type'      => 'post',
	'posts_per_page' => 3,
	'post__not_in'   => [ $post_id ],
	'category__in'   => $categories,
	'orderby'        => 'rand',
];

// If context is video, prioritize other videos
if ( $context === 'video' ) {
    $video_cat = get_category_by_slug( 'videos' );
    if ( $video_cat ) {
        $args['category__in'] = [ $video_cat->term_id ];
    }
}

$related_query = new WP_Query( $args );

if ( ! $related_query->have_posts() ) {
	return;
}
?>

<section class="related-posts my-20 pt-16 border-t border-slate-100 dark:border-slate-800">
    <div class="mb-10 flex items-center justify-between">
        <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight uppercase">
            Te puede interesar
        </h2>
        <div class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-emerald-600">
            <span class="w-10 h-[2px] bg-emerald-600"></span>
            <span>Más contenido</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <?php while ( $related_query->have_posts() ) : $related_query->the_post(); 
            $rel_image = mds_get_primary_image_data( get_the_ID() );
            $rel_context = mds_get_post_context( get_the_ID() );
        ?>
            <article class="related-card group">
                <a href="<?php the_permalink(); ?>" class="block mb-4 overflow-hidden rounded-2xl aspect-video bg-slate-100 dark:bg-slate-800 relative shadow-lg hover:shadow-2xl transition-all duration-500">
                    <?php if ( $rel_image['url'] ) : ?>
                        <img 
                            src="<?php echo esc_url( $rel_image['url'] ); ?>" 
                            alt="<?php echo esc_attr( $rel_image['alt'] ); ?>"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            loading="lazy"
                            referrerpolicy="no-referrer"
                        >
                    <?php endif; ?>

                    <?php if ( $rel_context === 'video' ) : ?>
                        <div class="absolute inset-0 flex items-center justify-center bg-black/10 group-hover:bg-black/30 transition-colors">
                            <div class="w-10 h-10 bg-red-600 text-white rounded-full flex items-center justify-center shadow-xl transform transition-transform group-hover:scale-110">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        </div>
                    <?php endif; ?>
                </a>

                <div class="px-2">
                    <div class="mb-2 flex items-center gap-3 text-[9px] font-black uppercase tracking-[0.2em] text-slate-400">
                        <time><?php echo get_the_date(); ?></time>
                        <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                        <span class="text-emerald-600"><?php echo esc_html( $rel_context === 'video' ? 'Video' : 'Noticia' ); ?></span>
                    </div>
                    <h3 class="text-lg font-black leading-tight text-slate-900 dark:text-white tracking-tight hover:text-emerald-600 transition-colors">
                        <a href="<?php the_permalink(); ?>">
                            <?php echo wp_trim_words( get_the_title(), 10 ); ?>
                        </a>
                    </h3>
                </div>
            </article>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
</section>
