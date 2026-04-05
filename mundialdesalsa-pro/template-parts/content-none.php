<?php
/**
 * Template part for displaying a message that posts cannot be found
 */
?>

<section class="no-results not-found py-24 text-center bg-slate-50 dark:bg-slate-900/50 rounded-3xl border-2 border-dashed border-slate-200 dark:border-slate-800">
	<header class="page-header mb-12">
		<h1 class="text-4xl md:text-6xl font-black uppercase italic tracking-tighter leading-none text-slate-900 dark:text-white mb-6">
            <?php esc_html_e( 'Nada encontrado', 'mundialdesalsa-pro' ); ?>
        </h1>
	</header>

	<div class="page-content max-w-xl mx-auto px-6">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			<p class="text-lg text-slate-500 dark:text-slate-400 mb-8">
				<?php
				printf(
					wp_kses(
						/* translators: 1: link to WP admin new post page. */
						__( '¿Listo para publicar tu primer artículo? <a href="%1$s" class="text-emerald-500 underline">Empieza aquí</a>.', 'mundialdesalsa-pro' ),
						array(
							'a' => array(
								'href' => array(),
                                'class' => array(),
							),
						)
					),
					esc_url( admin_url( 'post-new.php' ) )
				);
				?>
			</p>
		<?php elseif ( is_search() ) : ?>
			<p class="text-lg text-slate-500 dark:text-slate-400 mb-12">
				<?php esc_html_e( 'Lo sentimos, pero nada coincidió con sus términos de búsqueda. Por favor, inténtelo de nuevo con algunas palabras clave diferentes.', 'mundialdesalsa-pro' ); ?>
			</p>
			<div class="search-form-container max-w-md mx-auto">
                <?php get_search_form(); ?>
            </div>
		<?php else : ?>
			<p class="text-lg text-slate-500 dark:text-slate-400 mb-12">
				<?php esc_html_e( 'Parece que no podemos encontrar lo que estás buscando. Tal vez la búsqueda pueda ayudar.', 'mundialdesalsa-pro' ); ?>
			</p>
			<div class="search-form-container max-w-md mx-auto">
                <?php get_search_form(); ?>
            </div>
		<?php endif; ?>
	</div>
</section>
