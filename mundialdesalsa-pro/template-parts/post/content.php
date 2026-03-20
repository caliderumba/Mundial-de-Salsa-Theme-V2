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
                <button class="favorite-btn group flex items-center gap-1 hover:text-rose-500 transition-colors duration-300" data-post-id="<?php the_ID(); ?>">
                    <svg class="favorite-icon transition-all duration-300 group-hover:scale-110" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                    <span class="favorite-text"><?php esc_html_e( 'Guardar', 'mundialdesalsa-pro' ); ?></span>
                </button>
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

        // Review Box
        if ( is_singular() && mds_pro_get_option( 'reviews', 'enable_reviews', true ) ) :
            $rating = get_post_meta( get_the_ID(), '_mds_pro_review_rating', true );
            $pros   = get_post_meta( get_the_ID(), '_mds_pro_review_pros', true );
            $cons   = get_post_meta( get_the_ID(), '_mds_pro_review_cons', true );
            $title  = mds_pro_get_option( 'reviews', 'review_title', __( 'Veredicto Mundial', 'mundialdesalsa-pro' ) );
            $color  = mds_pro_get_option( 'reviews', 'review_color', '#10b981' );

            if ( ! empty( $rating ) ) :
                ?>
                <div class="mds-review-box mt-12 p-8 bg-slate-50 dark:bg-slate-800/50 rounded-3xl border-2 border-slate-100 dark:border-slate-800 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/5 -mr-16 -mt-16 rounded-full"></div>
                    
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8 relative z-10">
                        <div>
                            <h3 class="text-xs font-black uppercase tracking-[0.3em] text-slate-400 mb-2"><?php echo esc_html( $title ); ?></h3>
                            <h4 class="text-3xl font-black uppercase italic tracking-tighter text-slate-900 dark:text-white"><?php the_title(); ?></h4>
                        </div>
                        <div class="flex flex-col items-center justify-center w-24 h-24 rounded-2xl bg-white dark:bg-slate-900 shadow-xl border border-slate-100 dark:border-slate-800">
                            <span class="text-4xl font-black italic tracking-tighter text-emerald-500 leading-none"><?php echo esc_html( $rating ); ?></span>
                            <span class="text-[8px] font-black uppercase tracking-widest text-slate-400 mt-1">Puntos</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
                        <?php if ( ! empty( $pros ) ) : ?>
                            <div class="space-y-4">
                                <h5 class="text-[10px] font-black uppercase tracking-widest text-emerald-500 flex items-center gap-2">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                                    Lo Bueno
                                </h5>
                                <ul class="space-y-2 text-sm font-bold text-slate-600 dark:text-slate-300">
                                    <?php 
                                    $pros_list = explode( "\n", $pros );
                                    foreach ( $pros_list as $pro ) : if ( trim( $pro ) ) : ?>
                                        <li class="flex items-start gap-2">
                                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mt-1.5 shrink-0"></span>
                                            <?php echo esc_html( trim( $pro ) ); ?>
                                        </li>
                                    <?php endif; endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <?php if ( ! empty( $cons ) ) : ?>
                            <div class="space-y-4">
                                <h5 class="text-[10px] font-black uppercase tracking-widest text-rose-500 flex items-center gap-2">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                    Lo Malo
                                </h5>
                                <ul class="space-y-2 text-sm font-bold text-slate-600 dark:text-slate-300">
                                    <?php 
                                    $cons_list = explode( "\n", $cons );
                                    foreach ( $cons_list as $con ) : if ( trim( $con ) ) : ?>
                                        <li class="flex items-start gap-2">
                                            <span class="w-1.5 h-1.5 bg-rose-500 rounded-full mt-1.5 shrink-0"></span>
                                            <?php echo esc_html( trim( $con ) ); ?>
                                        </li>
                                    <?php endif; endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
            endif;
        endif;
        ?>
    </div>

    <footer class="entry-footer mt-8 pt-8 border-t border-slate-100 dark:border-slate-800 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
        <div class="flex flex-col gap-4">
            <div class="cat-links text-[10px] font-black uppercase tracking-widest text-emerald-500">
                <?php the_category( ', ' ); ?>
            </div>
            <?php get_template_part( 'template-parts/post/reactions' ); ?>
        </div>
        <div class="tags-links text-[10px] font-black uppercase tracking-widest text-slate-400">
            <?php the_tags( '', ' ' ); ?>
        </div>
    </footer>
</article>
