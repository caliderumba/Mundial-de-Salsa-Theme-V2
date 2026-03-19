<?php
/**
 * Template part for displaying single posts with Minimal layout
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('py-12'); ?>>
    <div class="container mx-auto px-4">
        <?php mds_pro_breadcrumbs(); ?>
        
        <div class="max-w-2xl mx-auto">
            <header class="entry-header mb-12 text-center">
                <?php the_title( '<h1 class="text-3xl md:text-4xl font-light leading-tight mb-4 text-slate-800 dark:text-white">', '</h1>' ); ?>
                <div class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">
                    <span><?php echo get_the_date(); ?></span>
                </div>
            </header>

            <div class="entry-content prose prose-slate dark:prose-invert prose-lg max-w-none leading-relaxed text-slate-600 dark:text-slate-400">
                <?php the_content(); ?>
            </div>

            <footer class="entry-footer mt-16 pt-12 border-t border-slate-50 dark:border-slate-800">
                <?php
                // Related Posts
                get_template_part( 'template-parts/post/related-posts' );

                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
                ?>
            </footer>
        </div>
    </div>
</article>
