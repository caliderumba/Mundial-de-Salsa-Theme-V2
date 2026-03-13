<?php
/**
 * Archive Layout: Masonry Style
 */
?>
<article id="post-<?php the_ID(); ?>" <?php body_class('post-masonry-item mb-4'); ?>>
    <div class="card border-0 shadow-sm rounded-lg overflow-hidden">
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="post-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( 'large', [ 'class' => 'img-fluid' ] ); ?>
                </a>
            </div>
        <?php endif; ?>
        <div class="card-body">
            <div class="post-categories mb-2">
                <?php the_category( ' ' ); ?>
            </div>
            <h3 class="post-title h5 mb-2">
                <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none"><?php the_title(); ?></a>
            </h3>
            <div class="post-excerpt text-muted small">
                <?php echo wp_trim_words( get_the_excerpt(), 20 ); ?>
            </div>
        </div>
    </div>
</article>
