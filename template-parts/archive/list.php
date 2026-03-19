<?php
/**
 * Archive Layout: List Style
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('flex flex-col md:flex-row gap-8 group pb-8 border-b border-slate-100 dark:border-slate-800 last:border-0'); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="w-full md:w-1/3 aspect-video md:aspect-square overflow-hidden rounded-2xl shrink-0">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail( 'medium_large', [ 'class' => 'w-full h-full object-cover transition-transform duration-700 group-hover:scale-110' ] ); ?>
            </a>
        </div>
    <?php endif; ?>

    <div class="flex-1 py-2">
        <div class="mb-3">
            <?php 
            $categories = get_the_category();
            if ( ! empty( $categories ) ) {
                echo '<span class="text-emerald-600 text-[10px] font-black uppercase tracking-widest">' . esc_html( $categories[0]->name ) . '</span>';
            }
            ?>
        </div>
        <h3 class="text-2xl font-black leading-tight mb-4 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors text-slate-900 dark:text-white">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        <p class="text-slate-500 dark:text-slate-400 text-sm mb-6 line-clamp-2">
            <?php echo wp_trim_words( get_the_excerpt(), 30 ); ?>
        </p>
        <div class="flex items-center gap-4 text-[10px] font-bold uppercase tracking-widest text-slate-400">
            <span><?php the_author(); ?></span>
            <span class="w-1 h-1 bg-slate-200 dark:bg-slate-800 rounded-full"></span>
            <span><?php echo get_the_date(); ?></span>
        </div>
    </div>
</article>
