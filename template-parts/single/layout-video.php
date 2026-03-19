<?php
/**
 * Template part for displaying single posts with Video layout
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('py-12'); ?>>
    <div class="container mx-auto px-4">
        <?php mds_pro_breadcrumbs(); ?>
        
        <?php
        $video_url = get_post_meta( get_the_ID(), 'video_url', true );
        if ( ! empty( $video_url ) ) : ?>
            <div class="post-video-hero mb-12">
                <div class="aspect-video rounded-3xl shadow-2xl overflow-hidden bg-black">
                    <?php echo wp_oembed_get( $video_url ); ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="max-w-4xl mx-auto">
            <header class="entry-header mb-8">
                <div class="mb-4">
                    <span class="bg-red-600 text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full text-white flex items-center gap-2 w-fit">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                        Video
                    </span>
                </div>
                <?php the_title( '<h1 class="text-4xl md:text-5xl font-black leading-tight mb-6 text-slate-900 dark:text-white">', '</h1>' ); ?>
                
                <div class="flex items-center gap-4 text-sm font-bold uppercase tracking-widest text-slate-400">
                    <span><?php the_author(); ?></span>
                    <span><?php echo get_the_date(); ?></span>
                </div>
            </header>

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
