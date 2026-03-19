<?php
/**
 * Archive Layout: Grid Style
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('group'); ?>>
    <div class="relative overflow-hidden rounded-2xl mb-4 aspect-[4/3]">
        <?php if ( has_post_thumbnail() ) : ?>
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail( 'medium_large', [ 'class' => 'w-full h-full object-cover transition-transform duration-700 group-hover:scale-110' ] ); ?>
            </a>
        <?php endif; ?>
        <div class="absolute top-4 left-4">
            <?php 
            $categories = get_the_category();
            if ( ! empty( $categories ) ) {
                echo '<span class="bg-emerald-500 text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full text-white shadow-lg">' . esc_html( $categories[0]->name ) . '</span>';
            }
            ?>
        </div>
    </div>

    <div class="px-2">
        <h3 class="text-xl font-bold leading-tight mb-3 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors text-slate-900 dark:text-white">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        <div class="flex items-center gap-3 text-[10px] font-bold uppercase tracking-widest text-slate-400">
            <span><?php the_author(); ?></span>
            <span class="w-1 h-1 bg-slate-200 dark:bg-slate-800 rounded-full"></span>
            <span><?php echo get_the_date(); ?></span>
        </div>
    </div>
</article>
