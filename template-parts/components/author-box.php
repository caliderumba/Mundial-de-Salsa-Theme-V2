<?php
/**
 * Component: Author Box
 */
?>
<div class="author-box d-flex align-items-start p-4 bg-light rounded-lg my-5">
    <div class="author-avatar mr-4">
        <?php echo get_avatar( get_the_author_meta( 'ID' ), 90, '', '', [ 'class' => 'rounded-circle' ] ); ?>
    </div>
    <div class="author-info">
        <h4 class="author-name mb-2"><?php the_author_posts_link(); ?></h4>
        <p class="author-bio text-muted mb-3"><?php the_author_meta( 'description' ); ?></p>
        <div class="author-social d-flex">
            <?php
            $twitter = get_the_author_meta( 'twitter' );
            $facebook = get_the_author_meta( 'facebook' );
            if ( $twitter ) echo '<a href="' . esc_url( $twitter ) . '" class="mr-3"><i class="lucide-twitter"></i></a>';
            if ( $facebook ) echo '<a href="' . esc_url( $facebook ) . '" class="mr-3"><i class="lucide-facebook"></i></a>';
            ?>
        </div>
    </div>
</div>
