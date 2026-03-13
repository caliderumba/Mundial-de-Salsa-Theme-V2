<?php
/**
 * Archive Layout: Grid Style
 */
?>
<article id="post-<?php the_ID(); ?>" <?php body_class('post-grid-item mb-4'); ?>>
    <div class="card border-0 bg-transparent">
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="post-thumbnail mb-3 overflow-hidden rounded-lg">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( 'mds-pro-grid', [ 'class' => 'img-fluid transition-transform' ] ); ?>
                </a>
            </div>
        <?php endif; ?>

        <div class="card-body p-0">
            <div class="post-categories mb-2">
                <?php the_category( ' ' ); ?>
            </div>
            <h3 class="post-title h5 mb-2">
                <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none"><?php the_title(); ?></a>
            </h3>
            <?php get_template_part( 'template-parts/components/post-meta' ); ?>
        </div>
    </div>
</article>
