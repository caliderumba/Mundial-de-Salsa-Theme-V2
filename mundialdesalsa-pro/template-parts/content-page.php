<?php
/**
 * Template part for displaying page content in page.php
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header mb-8">
		<?php the_title( '<h1 class="entry-title text-4xl md:text-6xl font-black uppercase italic tracking-tighter leading-none text-slate-900 dark:text-white mb-4">', '</h1>' ); ?>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
        <div class="post-thumbnail mb-12 rounded-2xl overflow-hidden shadow-2xl">
            <?php the_post_thumbnail( 'full', [ 'class' => 'w-full h-auto' ] ); ?>
        </div>
    <?php endif; ?>

	<div class="entry-content prose prose-slate dark:prose-invert max-w-none text-slate-600 dark:text-slate-400 font-medium leading-relaxed">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'mundialdesalsa-pro' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer mt-12 pt-8 border-t border-slate-100 dark:border-slate-800">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'mundialdesalsa-pro' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link text-[10px] font-black uppercase tracking-widest text-emerald-500">',
				'</span>'
			);
			?>
		</footer>
	<?php endif; ?>
</article>
