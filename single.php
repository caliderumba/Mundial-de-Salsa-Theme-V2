<?php
/**
 * Single Post Template
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <?php
                while ( have_posts() ) :
                    the_post();

                    // Track views
                    mds_pro_track_post_views();

                    // Check for multimedia content
                    $format = get_post_meta( get_the_ID(), '_mds_article_format', true );
                    $video_url = get_post_meta( get_the_ID(), '_mds_video_url', true );
                    $audio_url = get_post_meta( get_the_ID(), '_mds_audio_url', true );

                    get_template_part( 'template-parts/single/content', $format );

                    if ( $format === 'video' && ! empty( $video_url ) ) {
                        echo '<div class="post-video-wrapper mb-4">' . wp_oembed_get( $video_url ) . '</div>';
                    }

                    if ( $format === 'audio' && ! empty( $audio_url ) ) {
                        echo '<div class="post-audio-wrapper mb-4"><audio controls class="w-100" src="' . esc_url( $audio_url ) . '"></audio></div>';
                    }

                    the_content();

                    // Ad below content
                    echo mds_pro_get_ad( 'below-article' );

                    // Author Box
                    get_template_part( 'template-parts/components/author-box' );

                    // Related Posts
                    get_template_part( 'template-parts/components/related-posts' );

                    // Comments
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;

                    // Next Post Suggestion
                    get_template_part( 'template-parts/components/next-post-suggestion' );

                endwhile;
                ?>
            </div>
            <div class="col-lg-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
