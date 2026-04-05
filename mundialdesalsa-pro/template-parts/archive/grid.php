<?php
/**
 * Template part for displaying posts in grid layout
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('group relative flex flex-col bg-white dark:bg-slate-900 rounded-3xl overflow-hidden border border-slate-100 dark:border-slate-800 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2'); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="aspect-[16/9] overflow-hidden relative">
            <a href="<?php the_permalink(); ?>" class="block w-full h-full">
                <?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-full h-full object-cover transition-transform duration-700 group-hover:scale-110' ) ); ?>
            </a>
            <div class="absolute top-4 left-4">
                <?php 
                $categories = get_the_category();
                if ( ! empty( $categories ) ) : ?>
                    <a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>" class="px-3 py-1 bg-emerald-500 text-white text-[10px] font-black uppercase tracking-widest rounded-full shadow-lg">
                        <?php echo esc_html( $categories[0]->name ); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="p-6 flex flex-col flex-grow">
        <div class="flex items-center gap-3 text-[10px] font-black uppercase tracking-widest text-slate-400 mb-4">
            <span><?php echo get_the_date(); ?></span>
            <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
            <span><?php echo mds_pro_get_reading_time(); ?> min</span>
        </div>

        <h3 class="text-xl font-black text-slate-900 dark:text-white leading-tight mb-4 group-hover:text-emerald-500 transition-colors">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <div class="text-sm text-slate-500 dark:text-slate-400 line-clamp-3 mb-6 font-medium">
            <?php echo wp_trim_words( get_the_excerpt(), 20 ); ?>
        </div>

        <div class="mt-auto pt-6 border-t border-slate-50 dark:border-slate-800 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded-full bg-slate-200 overflow-hidden">
                    <?php echo get_avatar( get_the_author_meta( 'ID' ), 24 ); ?>
                </div>
                <span class="text-[10px] font-black uppercase tracking-widest text-slate-900 dark:text-white"><?php the_author(); ?></span>
            </div>
            <a href="<?php the_permalink(); ?>" class="text-emerald-500 hover:text-emerald-600 transition-colors">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
    </div>
</article>
