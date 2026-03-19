<?php
/**
 * Template part for displaying a message that posts cannot be found
 */
?>

<section class="no-results not-found py-24 text-center">
    <header class="page-header mb-12">
        <h1 class="text-5xl font-black uppercase italic tracking-tighter mb-6 text-slate-900 dark:text-white">No se encontró <span class="text-emerald-500">nada</span></h1>
    </header>

    <div class="page-content max-w-2xl mx-auto px-4">
        <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
            <p class="text-slate-500 dark:text-slate-400 text-lg mb-8">
                <?php
                printf(
                    wp_kses(
                        /* translators: %s: Post editor URL. */
                        __( '¿Listo para publicar tu primer artículo? <a href="%s" class="text-emerald-600 font-bold">Comienza aquí</a>.', 'mundialdesalsa-pro' ),
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
            <p class="text-slate-500 dark:text-slate-400 text-lg mb-8">
                <?php esc_html_e( 'Lo sentimos, pero nada coincidió con tus términos de búsqueda. Por favor, inténtalo de nuevo con algunas palabras clave diferentes.', 'mundialdesalsa-pro' ); ?>
            </p>
            <div class="max-w-md mx-auto">
                <?php get_search_form(); ?>
            </div>
        <?php else : ?>
            <p class="text-slate-500 dark:text-slate-400 text-lg mb-8">
                <?php esc_html_e( 'Parece que no podemos encontrar lo que estás buscando. Tal vez una búsqueda pueda ayudar.', 'mundialdesalsa-pro' ); ?>
            </p>
            <div class="max-w-md mx-auto">
                <?php get_search_form(); ?>
            </div>
        <?php endif; ?>
    </div>
</section>
