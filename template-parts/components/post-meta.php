<?php
/**
 * Component: Post Meta
 */
?>
<div class="entry-meta d-flex align-items-center text-muted small">
    <div class="meta-item author-meta mr-3">
        <?php echo get_avatar( get_the_author_meta( 'ID' ), 24, '', '', [ 'class' => 'rounded-circle mr-1' ] ); ?>
        <span><?php the_author_posts_link(); ?></span>
    </div>
    <div class="meta-item date-meta mr-3">
        <i class="lucide-calendar mr-1"></i>
        <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
    </div>
    <div class="meta-item comments-meta">
        <i class="lucide-message-square mr-1"></i>
        <span><?php comments_number( '0', '1', '%' ); ?></span>
    </div>
</div>
