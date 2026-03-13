<?php
/**
 * Archive Layout: Magazine Grid (Overlay)
 */
?>
<article id="post-<?php the_ID(); ?>" <?php body_class('post-magazine-item mb-4 position-relative overflow-hidden rounded-lg shadow-sm min-vh-25'); ?>>
    <div class="item-bg position-absolute w-100 h-100" style="background-image: url(<?php the_post_thumbnail_url('mds-pro-grid'); ?>); background-size: cover; background-position: center;"></div>
    <div class="item-overlay position-absolute w-100 h-100 d-flex align-items-end p-3" style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);">
        <div class="item-content text-white">
            <div class="post-categories mb-1 small">
                <?php the_category( ' ' ); ?>
            </div>
            <h3 class="post-title h6 m-0">
                <a href="<?php the_permalink(); ?>" class="text-white text-decoration-none"><?php the_title(); ?></a>
            </h3>
            <div class="post-meta mt-2 small opacity-75">
                <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
            </div>
        </div>
    </div>
</article>
