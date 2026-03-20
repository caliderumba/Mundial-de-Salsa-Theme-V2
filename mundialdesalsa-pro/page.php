<?php
/**
 * The template for displaying all pages
 */

get_header();

$layout = mds_pro_get_layout('page');
?>

<main id="primary" class="site-main layout-<?php echo esc_attr($layout); ?> py-12">
    <div class="container mx-auto px-4">
        <?php if ( $layout === 'full' ) : ?>
            <div class="w-full">
        <?php elseif ( $layout === 'narrow' ) : ?>
            <div class="max-w-3xl mx-auto">
        <?php else : ?>
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                <div class="lg:col-span-8">
        <?php endif; ?>

                <?php
                while ( have_posts() ) :
                    the_post();

                    get_template_part( 'template-parts/content', 'page' );

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;

                endwhile;
                ?>

        <?php if ( $layout === 'full' ) : ?>
            </div>
        <?php elseif ( $layout === 'narrow' ) : ?>
            </div>
        <?php else : ?>
                </div>
                <div class="lg:col-span-4">
                    <?php get_sidebar(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
