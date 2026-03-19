<?php
/**
 * Template part for displaying single posts with Magazine layout
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('py-12'); ?>>
    <div class="container mx-auto px-4">
        <?php mds_pro_breadcrumbs(); ?>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-16">
            <header class="entry-header">
                <div class="mb-4">
                    <?php 
                    mds_pro_sponsored_badge();
                    $categories = get_the_category();
                    if ( ! empty( $categories ) ) {
                        echo '<span class="bg-emerald-500 text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full text-white">' . esc_html( $categories[0]->name ) . '</span>';
                    }
                    ?>
                </div>
                <?php the_title( '<h1 class="text-4xl md:text-6xl font-black leading-tight mb-8 text-slate-900 dark:text-white">', '</h1>' ); ?>
                
                <div class="flex items-center gap-4 text-sm font-bold uppercase tracking-widest text-slate-400">
                    <div class="flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </span>
                        <span><?php the_author(); ?></span>
                    </div>
                    <span><?php echo get_the_date(); ?></span>
                    <span><?php echo mds_pro_get_reading_time(); ?> min</span>
                </div>
            </header>
            
            <div class="relative">
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="rounded-3xl overflow-hidden shadow-2xl transform rotate-2">
                        <?php the_post_thumbnail( 'full', [ 'class' => 'w-full h-auto' ] ); ?>
                    </div>
                <?php endif; ?>
                <div class="absolute -bottom-6 -left-6 w-24 h-24 bg-emerald-500/10 rounded-full blur-2xl"></div>
            </div>
        </div>

        <div class="max-w-3xl mx-auto">
            <div class="entry-content magazine-dropcap prose prose-slate dark:prose-invert prose-lg max-w-none">
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

<style>
.magazine-dropcap > p:first-of-type::first-letter {
    float: left;
    font-size: 5rem;
    line-height: 1;
    padding: 0.5rem 0.75rem 0 0;
    font-weight: 900;
    color: #10b981;
}
</style>
