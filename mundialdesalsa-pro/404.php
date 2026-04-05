<?php
/**
 * The template for displaying 404 pages (not found)
 */

get_header();
?>

<main id="primary" class="site-main py-24 dark:bg-slate-950">
    <div class="container mx-auto px-4 text-center">
        <header class="page-header mb-12">
            <h1 class="text-[120px] md:text-[200px] font-black italic tracking-tighter leading-none text-slate-900 dark:text-white mb-8">
                404<span class="text-emerald-500">.</span>
            </h1>
            <h2 class="text-3xl md:text-5xl font-black uppercase italic tracking-tighter text-slate-900 dark:text-white mb-8">
                <?php esc_html_e( '¡Vaya! Esa página no se encuentra.', 'mundialdesalsa-pro' ); ?>
            </h2>
        </header>

        <div class="page-content max-w-2xl mx-auto">
            <p class="text-xl text-slate-500 dark:text-slate-400 mb-12 font-medium">
                <?php esc_html_e( 'Parece que no se encontró nada en esta ubicación. Tal vez intente una búsqueda o regrese al inicio.', 'mundialdesalsa-pro' ); ?>
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-6">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="bg-black dark:bg-white text-white dark:text-black font-black uppercase italic tracking-tighter px-10 py-5 hover:translate-x-2 hover:-translate-y-2 transition-transform shadow-[8px_8px_0px_0px_rgba(16,185,129,1)]">
                    <?php esc_html_e( 'Ir al Inicio', 'mundialdesalsa-pro' ); ?>
                </a>
                <button class="search-trigger bg-emerald-500 text-white font-black uppercase italic tracking-tighter px-10 py-5 hover:translate-x-2 hover:-translate-y-2 transition-transform shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] dark:shadow-[8px_8px_0px_0px_rgba(255,255,255,1)]">
                    <?php esc_html_e( 'Buscar algo', 'mundialdesalsa-pro' ); ?>
                </button>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
