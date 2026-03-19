<?php
/**
 * Template part for displaying single posts with Classic layout
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('py-12'); ?>>
    <div class="container mx-auto px-4">
        <?php mds_pro_breadcrumbs(); ?>
        
        <div class="max-w-4xl mx-auto">
            <header class="entry-header mb-8">
                <div class="mb-4">
                    <?php 
                    $categories = get_the_category();
                    if ( ! empty( $categories ) ) {
                        echo '<span class="bg-emerald-500 text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full text-white">' . esc_html( $categories[0]->name ) . '</span>';
                    }
                    ?>
                </div>
                <?php the_title( '<h1 class="text-4xl md:text-5xl font-black leading-tight mb-6 text-slate-900 dark:text-white">', '</h1>' ); ?>
                
                <div class="flex items-center gap-4 text-sm font-bold uppercase tracking-widest text-slate-400">
                    <span><?php the_author(); ?></span>
                    <span><?php echo get_the_date(); ?></span>
                </div>
            </header>

            <?php if ( has_post_thumbnail() ) : ?>
                <div class="post-thumbnail mb-12 rounded-2xl overflow-hidden shadow-xl">
                    <?php the_post_thumbnail( 'full', [ 'class' => 'w-full h-auto' ] ); ?>
                </div>
            <?php endif; ?>

            <div class="entry-content prose prose-slate dark:prose-invert prose-lg max-w-none">
                <?php the_content(); ?>
            </div>

            <footer class="entry-footer mt-16 pt-12 border-t border-slate-100 dark:border-slate-800">
                <?php
                get_template_part( 'template-parts/post/related-posts' );
                
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
                ?>
            </footer>
        </div>
    </div>
</article>
