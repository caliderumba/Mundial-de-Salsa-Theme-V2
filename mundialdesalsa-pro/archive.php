<?php
/**
 * The template for displaying archive pages
 */

get_header();
?>

<main id="primary" class="site-main py-12 dark:bg-slate-950">
    <div class="container mx-auto px-4">
        <?php mds_pro_breadcrumbs(); ?>
        <header class="archive-header mb-12 border-b-2 border-slate-200 dark:border-slate-800 pb-8">
            <?php
            the_archive_title( '<h1 class="text-4xl font-black uppercase tracking-tighter italic mb-4 text-slate-900 dark:text-white">', '</h1>' );
            the_archive_description( '<div class="text-slate-500 dark:text-slate-400 max-w-2xl">', '</div>' );
            ?>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <div class="lg:col-span-8">
                <div id="archive-content" class="archive-posts-container">
                    <?php
                    if ( have_posts() ) :
                        $layout = mds_pro_get_layout('category');
                        $grid_class = ( $layout === 'grid' || $layout === 'magazine' || $layout === 'overlay' ) ? 'grid grid-cols-1 md:grid-cols-2 gap-8' : 'space-y-8';
                        
                        echo '<div class="' . esc_attr($grid_class) . '">';
                        while ( have_posts() ) : the_post();
                            get_template_part( 'template-parts/archive/' . $layout );
                        endwhile;
                        echo '</div>';

                        if ( mds_pro_get_option( 'performance', 'infinite_scroll', false ) ) : ?>
                            <div class="text-center py-12">
                                <button id="load-more-btn" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-3 px-8 rounded-2xl transition-all" data-page="1" data-max="<?php echo $wp_query->max_num_pages; ?>">
                                    <?php esc_html_e( 'Cargar más', 'mundialdesalsa-pro' ); ?>
                                </button>
                                <div class="loading-spinner hidden mt-4"><?php _e('Cargando más...', 'mundialdesalsa-pro'); ?></div>
                            </div>
                        <?php else : ?>
                            <div class="py-12">
                                <?php the_posts_pagination(); ?>
                            </div>
                        <?php endif;

                    else :
                        get_template_part( 'template-parts/content', 'none' );
                    endif;
                    ?>
                </div>
            </div>
            <aside class="lg:col-span-4">
                <?php get_sidebar(); ?>
            </aside>
        </div>
    </div>
</main>

<?php
get_footer();
