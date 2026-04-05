<?php
/**
 * Global Theme Hooks - Mundial de Salsa Pro
 * 
 * Handles safe output of analytics, meta tags, and other head/footer injections.
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Output Google Analytics and Global Meta Tags safely in the head.
 * This content is treated as "trusted admin content".
 */
function mds_output_head_scripts() {
    // Analytics
    $analytics = mds_pro_get_option( 'general', 'google_analytics', '' );
    if ( ! empty( $analytics ) && is_string( $analytics ) ) {
        echo "<!-- Google Analytics -->\n";
        echo $analytics . "\n";
    }

    // Global Meta Tags
    $meta_tags = mds_pro_get_option( 'general', 'global_meta_tags', '' );
    if ( ! empty( $meta_tags ) && is_string( $meta_tags ) ) {
        echo "<!-- Global Meta Tags -->\n";
        echo $meta_tags . "\n";
    }
}
add_action( 'wp_head', 'mds_output_head_scripts', 1 );

/**
 * Add layout-specific classes to the body tag.
 * 
 * @param array $classes Existing body classes.
 * @return array Modified body classes.
 */
function mds_pro_body_classes( $classes ) {
    $layout = mds_pro_get_option( 'site_layout', 'full' );
    
    if ( 'boxed' === $layout ) {
        $classes[] = 'layout-boxed';
    } else {
        $classes[] = 'layout-full';
    }
    
    return $classes;
}
add_filter( 'body_class', 'mds_pro_body_classes' );

/**
 * Custom Comment Callback for Brutalist Style
 */
function mds_pro_comment_callback( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class( 'mb-8' ); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment-body flex gap-6 p-6 bg-white dark:bg-slate-900 border-2 border-black dark:border-white shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] dark:shadow-[8px_8px_0px_0px_rgba(255,255,255,1)]">
            <footer class="comment-meta flex-shrink-0">
                <div class="comment-author vcard">
                    <?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'], '', '', array( 'class' => 'rounded-none border-2 border-black dark:border-white' ) ); ?>
                </div>
            </footer>

            <div class="comment-content flex-grow">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <b class="fn text-sm font-black uppercase italic tracking-tighter"><?php echo get_comment_author_link(); ?></b>
                        <div class="comment-metadata text-[10px] font-black uppercase tracking-widest text-slate-400 mt-1">
                            <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                                <time datetime="<?php comment_time( 'c' ); ?>">
                                    <?php printf( _x( '%1$s at %2$s', '1: date, 2: time' ), get_comment_date(), get_comment_time() ); ?>
                                </time>
                            </a>
                            <?php edit_comment_link( __( 'Editar', 'mundialdesalsa-pro' ), '<span class="edit-link ml-2 text-emerald-500">', '</span>' ); ?>
                        </div>
                    </div>
                    
                    <div class="reply">
                        <?php
                        comment_reply_link( array_merge( $args, array(
                            'add_below' => 'comment',
                            'depth'     => $depth,
                            'max_depth' => $args['max_depth'],
                            'before'    => '<span class="text-[10px] font-black uppercase tracking-widest bg-emerald-500 text-white px-2 py-1">',
                            'after'     => '</span>'
                        ) ) );
                        ?>
                    </div>
                </div>

                <?php if ( '0' == $comment->comment_approved ) : ?>
                    <p class="comment-awaiting-moderation text-xs italic text-rose-500 mb-4"><?php _e( 'Tu comentario está esperando moderación.', 'mundialdesalsa-pro' ); ?></p>
                <?php endif; ?>

                <div class="text-sm font-medium leading-relaxed text-slate-600 dark:text-slate-400">
                    <?php comment_text(); ?>
                </div>
            </div>
        </article>
    <?php
}
