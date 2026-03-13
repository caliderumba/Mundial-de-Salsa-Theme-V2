<?php
/**
 * The template for displaying archive pages
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <header class="archive-header py-5 border-bottom mb-5">
            <?php
            the_archive_title( '<h1 class="page-title display-4 font-weight-bold">', '</h1>' );
            the_archive_description( '<div class="archive-description lead text-muted mt-3">', '</div>' );
            ?>
        </header>

        <div class="row">
            <div class="col-lg-8">
                <div class="archive-layout-wrapper" id="archive-content">
                    <?php
                    if ( have_posts() ) :
                        $layout = mds_pro_get_layout('archive');
                        echo '<div class="row layout-' . esc_attr($layout) . '">';
                        while ( have_posts() ) : the_post();
                            $col_class = ( $layout === 'grid' || $layout === 'magazine' ) ? 'col-md-6' : 'col-12';
                            echo '<div class="' . $col_class . '">';
                            get_template_part( 'template-parts/archive/' . $layout );
                            echo '</div>';
                        endwhile;
                        echo '</div>';

                        if ( get_option('mds_infinite_scroll') === 'enabled' ) {
                            echo '<div class="load-more-container text-center my-5"><button id="load-more" class="btn btn-outline-primary px-5">' . __('Load More', 'mundialdesalsa-pro') . '</button></div>';
                        } else {
                            the_posts_navigation();
                        }

                    else :
                        get_template_part( 'template-parts/content-none' );
                    endif;
                    ?>
                </div>
            </div>
            <div class="col-lg-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
