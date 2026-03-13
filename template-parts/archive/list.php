<?php
/**
 * Archive Layout: List Style
 */
?>
<article id="post-<?php the_ID(); ?>" <?php body_class('post-list-item d-flex mb-4 pb-4 border-bottom'); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-thumbnail mr-4">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail( 'mds-pro-list', [ 'class' => 'rounded-lg' ] ); ?>
            </a>
        </div>
    <?php endif; ?>

    <div class="post-content">
        <div class="post-categories mb-2">
            <?php the_category( ' ' ); ?>
        </div>
        <h3 class="post-title h4 mb-2">
            <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none"><?php the_title(); ?></a>
        </h3>
        <?php get_template_part( 'template-parts/components/post-meta' ); ?>
        <div class="post-excerpt mt-3 text-muted">
            <?php echo wp_trim_words( get_the_excerpt(), 25 ); ?>
        </div>
    </div>
</article>
