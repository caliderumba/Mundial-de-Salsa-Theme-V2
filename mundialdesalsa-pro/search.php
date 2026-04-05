<?php
/**
 * The template for displaying search results pages
 */

get_header();
?>

<main id="primary" class="site-main py-12 dark:bg-slate-950">
    <div class="container mx-auto px-4">
        <?php mds_pro_breadcrumbs(); ?>
        
        <header class="page-header mb-12 border-b-4 border-black dark:border-white pb-10">
            <h1 class="text-4xl md:text-6xl font-black uppercase italic tracking-tighter leading-none text-slate-900 dark:text-white mb-4">
                <?php
                /* translators: %s: search query. */
                printf( esc_html__( 'Resultados para: %s', 'mundialdesalsa-pro' ), '<span class="text-emerald-500">' . get_search_query() . '</span>' );
                ?>
            </h1>
            <p class="text-slate-500 dark:text-slate-400 font-medium uppercase tracking-widest text-xs">
                <?php 
                global $wp_query;
                printf( _n( 'Se encontró %d resultado', 'Se encontraron %d resultados', $wp_query->found_posts, 'mundialdesalsa-pro' ), $wp_query->found_posts );
                ?>
            </p>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <div class="lg:col-span-8">
                <?php if ( have_posts() ) : ?>
                    <div class="space-y-12">
                        <?php
                        while ( have_posts() ) :
                            the_post();
                            get_template_part( 'template-parts/archive/list' );
                        endwhile;
                        ?>
                    </div>

                    <div class="py-12">
                        <?php the_posts_pagination(); ?>
                    </div>

                <?php else : ?>
                    <?php get_template_part( 'template-parts/content', 'none' ); ?>
                <?php endif; ?>
            </div>

            <aside class="lg:col-span-4">
                <?php get_sidebar(); ?>
            </aside>
        </div>
    </div>
</main>

<?php
get_footer();
