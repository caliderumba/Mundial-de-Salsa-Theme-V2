<?php
/**
 * Template part for displaying single posts with Wide layout
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('py-12'); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="w-full h-[60vh] min-h-[400px] relative mb-12">
            <?php the_post_thumbnail( 'full', [ 'class' => 'absolute inset-0 w-full h-full object-cover' ] ); ?>
            <div class="absolute inset-0 bg-black/30"></div>
            <div class="absolute inset-0 flex items-center justify-center text-center px-4">
                <div class="max-w-4xl">
                    <div class="mb-4">
                        <?php 
                        mds_pro_sponsored_badge();
                        $categories = get_the_category();
                        if ( ! empty( $categories ) ) {
                            echo '<span class="bg-emerald-500 text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full text-white">' . esc_html( $categories[0]->name ) . '</span>';
                        }
                        ?>
                    </div>
                    <?php the_title( '<h1 class="text-4xl md:text-6xl font-black leading-tight mb-6 text-white shadow-sm">', '</h1>' ); ?>
                    <div class="flex items-center justify-center gap-4 text-sm font-bold uppercase tracking-widest text-white/80">
                        <span><?php the_author(); ?></span>
                        <span><?php echo get_the_date(); ?></span>
                        <span><?php echo mds_pro_get_reading_time(); ?> min</span>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="container mx-auto px-4">
        <?php mds_pro_breadcrumbs(); ?>
        
        <div class="max-w-3xl mx-auto">
            <div class="entry-content prose prose-slate dark:prose-invert prose-lg max-w-none">
                <?php the_content(); ?>
            </div>

            <footer class="entry-footer mt-16 pt-12 border-t border-slate-100 dark:border-slate-800">
                <?php
                // Social Sharing
                mds_pro_social_sharing();

                get_template_part( 'template-parts/post/related-posts' );
                
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
                ?>
            </footer>
        </div>
    </div>
</article>
