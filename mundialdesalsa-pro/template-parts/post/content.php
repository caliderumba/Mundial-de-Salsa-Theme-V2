<?php
/**
 * Template part for displaying posts
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('mb-12 pb-12 border-b border-slate-100 dark:border-slate-800'); ?>>
    <header class="entry-header mb-6">
        <?php
        mds_pro_sponsored_badge();
        if ( is_singular() ) :
            the_title( '<h1 class="entry-title text-4xl md:text-6xl font-black uppercase italic tracking-tighter leading-none text-slate-900 dark:text-white mb-4">', '</h1>' );
        else :
            the_title( '<h2 class="entry-title text-3xl md:text-5xl font-black uppercase italic tracking-tighter leading-none text-slate-900 dark:text-white mb-4"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        endif;

        if ( 'post' === get_post_type() ) :
            ?>
            <div class="entry-meta flex gap-4 text-[10px] font-black uppercase tracking-widest text-slate-400">
                <span class="posted-on"><?php echo get_the_date(); ?></span>
                <span class="byline"><?php the_author(); ?></span>
                <span class="views-count">
                    <svg class="inline-block mr-1" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    <?php 
                    $views = get_post_meta( get_the_ID(), 'mds_pro_views_count', true );
                    echo $views ? esc_html( $views ) : '0';
                    ?> <?php esc_html_e( 'vistas', 'mundialdesalsa-pro' ); ?>
                </span>
                <span class="reading-time">
                    <svg class="inline-block mr-1" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    <?php echo mds_pro_get_reading_time(); ?> <?php esc_html_e( 'min lectura', 'mundialdesalsa-pro' ); ?>
                </span>
            </div>
            <?php
        endif;
        ?>
    </header>

    <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-thumbnail mb-8 rounded-2xl overflow-hidden">
            <?php the_post_thumbnail( 'full', [ 'class' => 'w-full h-auto' ] ); ?>
        </div>
    <?php endif; ?>

    <div class="entry-content prose prose-slate dark:prose-invert max-w-none text-slate-600 dark:text-slate-400 font-medium leading-relaxed">
        <?php
        the_content(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'mundialdesalsa-pro' ),
                    [
                        'span' => [
                            'class' => [],
                        ],
                    ]
                ),
                get_the_title()
            )
        );

        wp_link_pages(
            [
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'mundialdesalsa-pro' ),
                'after'  => '</div>',
            ]
        );
        ?>
    </div>

    <footer class="entry-footer mt-8 pt-8 border-t border-slate-100 dark:border-slate-800 flex justify-between items-center">
        <div class="cat-links text-[10px] font-black uppercase tracking-widest text-emerald-500">
            <?php the_category( ', ' ); ?>
        </div>
        <div class="tags-links text-[10px] font-black uppercase tracking-widest text-slate-400">
            <?php the_tags( '', ' ' ); ?>
        </div>
    </footer>
</article>
