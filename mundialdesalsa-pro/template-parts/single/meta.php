<?php
/**
 * Single Post Meta - Mundial de Salsa Pro
 * 
 * Displays the author, date, and reading time of a post.
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id      = get_the_ID();
$reading_time = mds_pro_get_reading_time( $post_id );
$is_updated   = mds_is_post_updated( $post_id );
$context      = mds_get_post_context( $post_id );
?>

<div class="post-meta flex flex-wrap items-center gap-y-4 gap-x-8 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-10 pb-8 border-b border-slate-100 dark:border-slate-800">
    
    <div class="meta-item flex items-center gap-3">
        <span class="text-slate-300 italic font-serif lowercase tracking-normal text-sm">por</span>
        <span class="text-slate-900 dark:text-white"><?php the_author(); ?></span>
    </div>

    <div class="meta-item flex items-center gap-3">
        <span class="text-slate-300 italic font-serif lowercase tracking-normal text-sm">publicado</span>
        <time class="text-slate-900 dark:text-white"><?php echo get_the_date(); ?></time>
    </div>

    <?php if ( $is_updated ) : ?>
        <div class="meta-item flex items-center gap-3 text-emerald-600">
            <span class="italic font-serif lowercase tracking-normal text-sm">actualizado</span>
            <time><?php echo get_the_modified_date(); ?></time>
        </div>
    <?php endif; ?>

    <?php if ( $reading_time ) : ?>
        <div class="meta-item flex items-center gap-3">
            <span class="text-slate-300 italic font-serif lowercase tracking-normal text-sm">lectura</span>
            <span class="text-slate-900 dark:text-white"><?php echo $reading_time; ?> min</span>
        </div>
    <?php endif; ?>

    <?php if ( $context === 'video' ) : ?>
        <div class="meta-item flex items-center gap-2 bg-slate-900 text-white px-3 py-1 rounded-full">
            <span class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
            <span>Video</span>
        </div>
    <?php endif; ?>
</div>
