<?php
/**
 * Single Post Template
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$layout = mds_pro_get_layout('post');
?>

<main id="primary" class="site-main layout-<?php echo esc_attr($layout); ?> py-12">
    <div class="container mx-auto px-4">
        <?php if ( $layout === 'wide' ) : ?>
            <div class="max-w-4xl mx-auto">
        <?php else : ?>
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                <div class="lg:col-span-8">
        <?php endif; ?>

                <?php
                while ( have_posts() ) :
                    the_post();

                    // Track views
                    mds_pro_track_post_views();

                    get_template_part( 'template-parts/single/layout', $layout );

                    // Social Sharing
                    mds_pro_social_sharing();

                    // Related Posts
                    get_template_part( 'template-parts/post/related-posts' );

                endwhile;
                ?>

        <?php if ( $layout === 'wide' ) : ?>
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
