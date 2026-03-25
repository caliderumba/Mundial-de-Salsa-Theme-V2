<?php
/**
 * Single Post Hero - Mundial de Salsa Pro
 * 
 * Displays the featured image or video thumbnail for a post.
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id    = get_the_ID();
$image_data = mds_get_primary_image_data( $post_id );
$video_data = mds_get_primary_video_data( $post_id );
$context    = mds_get_post_context( $post_id );

// Only render if we have a valid image or it's a video context with a fallback
if ( ! $image_data['has_image'] && ! $video_data['has_video'] ) {
    return;
}
?>

<header class="post-hero mb-10 relative group">
    <div class="aspect-video overflow-hidden rounded-2xl bg-slate-100 dark:bg-slate-800 shadow-2xl transition-transform duration-700 hover:scale-[1.01]">
        <?php if ( ! empty( $image_data['url'] ) ) : ?>
            <img 
                src="<?php echo esc_url( $image_data['url'] ); ?>" 
                alt="<?php echo esc_attr( $image_data['alt'] ); ?>"
                width="<?php echo esc_attr( $image_data['width'] ); ?>"
                height="<?php echo esc_attr( $image_data['height'] ); ?>"
                class="w-full h-full object-cover"
                loading="eager"
                fetchpriority="high"
                decoding="async"
            >
        <?php endif; ?>

        <?php if ( $context === 'video' && $video_data['has_video'] ) : ?>
            <div class="absolute inset-0 flex items-center justify-center bg-black/20 group-hover:bg-black/40 transition-colors" aria-hidden="true">
                <div class="w-20 h-20 bg-red-600 text-white rounded-full flex items-center justify-center shadow-2xl transform transition-transform group-hover:scale-110">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                </div>
                <span class="sr-only"><?php _e( 'Reproducir Video', 'mds-pro' ); ?></span>
            </div>
        <?php endif; ?>
    </div>

    <?php 
    // Only show "source" if it's external or explicitly provided, avoiding generic "local"
    if ( ! empty( $image_data['source'] ) && in_array( $image_data['source'], ['external', 'video'] ) ) : ?>
        <div class="mt-3 text-[10px] font-medium uppercase tracking-widest text-slate-400 flex items-center gap-2">
            <span class="w-4 h-[1px] bg-slate-200"></span>
            <span><?php printf( __( 'Origen: %s', 'mds-pro' ), esc_html( $image_data['source'] ) ); ?></span>
        </div>
    <?php endif; ?>
</header>
