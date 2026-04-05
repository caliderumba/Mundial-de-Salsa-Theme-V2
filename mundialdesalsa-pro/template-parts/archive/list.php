<?php
/**
 * Template part for displaying posts in list layout
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('group relative flex flex-col md:flex-row bg-white dark:bg-slate-900 rounded-3xl overflow-hidden border border-slate-100 dark:border-slate-800 hover:shadow-2xl transition-all duration-500'); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="w-full md:w-1/3 aspect-[16/9] md:aspect-auto overflow-hidden relative">
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

    <div class="p-8 flex flex-col flex-grow w-full md:w-2/3">
        <div class="flex items-center gap-3 text-[10px] font-black uppercase tracking-widest text-slate-400 mb-4">
            <span><?php echo get_the_date(); ?></span>
            <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
            <span><?php echo mds_pro_get_reading_time(); ?> min</span>
            <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
            <span><?php the_author(); ?></span>
        </div>

        <h3 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white leading-tight mb-6 group-hover:text-emerald-500 transition-colors">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <div class="text-base text-slate-500 dark:text-slate-400 line-clamp-3 mb-8 font-medium">
            <?php echo wp_trim_words( get_the_excerpt(), 30 ); ?>
        </div>

        <div class="mt-auto flex items-center justify-between">
            <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-widest text-emerald-500 hover:text-emerald-600 transition-colors">
                <?php esc_html_e( 'Leer más', 'mundialdesalsa-pro' ); ?>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
            <div class="flex items-center gap-4 text-slate-300">
                <div class="flex items-center gap-1">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    <span class="text-[10px] font-black"><?php echo get_post_meta( get_the_ID(), 'mds_views_count', true ) ?: '0'; ?></span>
                </div>
            </div>
        </div>
    </div>
</article>
