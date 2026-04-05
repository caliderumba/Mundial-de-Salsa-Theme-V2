<?php
/**
 * The template for displaying comments
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area mt-16">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title text-2xl font-black uppercase italic tracking-tighter mb-10 pb-4 border-b-4 border-black dark:border-white inline-block">
			<?php
			$comment_count = get_comments_number();
			if ( '1' === $comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'Un comentario en &ldquo;%1$s&rdquo;', 'mundialdesalsa-pro' ),
					'<span>' . get_the_title() . '</span>'
				);
			} else {
				printf(
					/* translators: 1: comment count, 2: title. */
					esc_html( _nx( '%1$s comentarios en &ldquo;%2$s&rdquo;', '%1$s comentarios en &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'mundialdesalsa-pro' ) ),
					number_format_i18n( $comment_count ),
					'<span>' . get_the_title() . '</span>'
				);
			}
			?>
		</h2>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list space-y-8">
			<?php
			wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
				'avatar_size' => 60,
                'callback'   => 'mds_pro_comment_callback'
			) );
			?>
		</ol>

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments text-slate-500 italic mt-8"><?php esc_html_e( 'Los comentarios están cerrados.', 'mundialdesalsa-pro' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	comment_form( array(
        'class_form' => 'comment-form space-y-6',
        'title_reply' => __( 'Deja un comentario', 'mundialdesalsa-pro' ),
        'title_reply_to' => __( 'Responde a %s', 'mundialdesalsa-pro' ),
        'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title text-xl font-black uppercase italic tracking-tighter mb-8">',
        'title_reply_after' => '</h3>',
        'submit_button' => '<button name="%1$s" type="submit" id="%2$s" class="%3$s bg-black dark:bg-white text-white dark:text-black font-black uppercase italic tracking-tighter px-8 py-4 hover:translate-x-2 hover:-translate-y-2 transition-transform shadow-[8px_8px_0px_0px_rgba(16,185,129,1)]">%4$s</button>',
        'class_submit' => 'submit-btn',
        'comment_field' => '<div class="comment-form-comment"><label for="comment" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">' . _x( 'Comentario', 'noun' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required" class="w-full p-4 bg-slate-50 dark:bg-slate-900 border-2 border-slate-100 dark:border-slate-800 focus:border-emerald-500 outline-none transition-colors"></textarea></div>',
        'fields' => array(
            'author' => '<div class="grid grid-cols-1 md:grid-cols-2 gap-6"><div class="comment-form-author"><label for="author" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">' . __( 'Nombre', 'mundialdesalsa-pro' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245" ' . $aria_req . ' class="w-full p-4 bg-slate-50 dark:bg-slate-900 border-2 border-slate-100 dark:border-slate-800 focus:border-emerald-500 outline-none transition-colors" /></div>',
            'email' => '<div class="comment-form-email"><label for="email" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">' . __( 'Email', 'mundialdesalsa-pro' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label><input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes" ' . $aria_req . ' class="w-full p-4 bg-slate-50 dark:bg-slate-900 border-2 border-slate-100 dark:border-slate-800 focus:border-emerald-500 outline-none transition-colors" /></div></div>',
        )
    ) );
	?>

</div>
