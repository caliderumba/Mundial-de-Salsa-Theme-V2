<?php
/**
 * Template part for displaying posts with Overlay layout in archives
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('archive-overlay-item mb-8'); ?>>
    <div class="relative overflow-hidden rounded-2xl shadow-lg group aspect-video">
        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'medium_large', [ 'class' => 'absolute inset-0 w-full h-full object-cover transition-all duration-700 group-hover:scale-110' ] ); ?>
        <?php else : ?>
            <img src="https://picsum.photos/seed/salsa<?php the_ID(); ?>/800/600" class="absolute inset-0 w-full h-full object-cover transition-all duration-700 group-hover:scale-110" alt="">
        <?php endif; ?>
        
        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent flex flex-col justify-end p-6 text-white">
            <div class="entry-categories mb-3">
                <?php
                $categories = get_the_category();
                if ( ! empty( $categories ) ) {
                    echo '<span class="bg-emerald-500 text-[9px] font-black uppercase tracking-widest px-3 py-1 rounded-lg">' . esc_html( $categories[0]->name ) . '</span>';
                }
                ?>
            </div>
            <h3 class="text-xl font-black leading-tight italic tracking-tight">
                <a href="<?php the_permalink(); ?>" class="text-white hover:text-emerald-400 transition-colors"><?php the_title(); ?></a>
            </h3>
        </div>
    </div>
</article>
