<?php
/**
 * The template for displaying the footer
 */
?>
	<footer id="colophon" class="site-footer">
		<?php get_template_part( 'template-parts/footer/footer-main' ); ?>
	</footer>
</div><!-- #page -->

    <!-- Floating Player -->
    <div id="floating-player" class="fixed bottom-6 right-6 z-50 transition-all duration-500 translate-y-20 opacity-0 pointer-events-none">
        <div class="relative group">
            <!-- Player Container -->
            <div id="player-container" class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl border border-slate-200 dark:border-slate-800 overflow-hidden w-80 sm:w-96 transition-all duration-500 max-h-0">
                <div class="p-4 bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Reproductor Mundial</span>
                    </div>
                    <button id="player-close" class="text-slate-400 hover:text-slate-600 dark:hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 6-12 12"/><path d="m6 6 12 12"/></svg>
                    </button>
                </div>
                <div class="aspect-video bg-black">
                    <iframe id="player-iframe" width="100%" height="100%" frameborder="0" allowtransparency="true" allow="encrypted-media; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
                </div>
            </div>

            <!-- Toggle Button -->
            <button id="player-toggle" class="absolute -bottom-2 -right-2 w-14 h-14 bg-emerald-500 hover:bg-emerald-600 text-white rounded-full shadow-lg flex items-center justify-center transition-all duration-300 hover:scale-110 active:scale-95 z-10">
                <div class="relative w-6 h-6">
                    <svg id="icon-play" class="absolute inset-0 transition-all duration-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
                    <svg id="icon-close" class="absolute inset-0 opacity-0 scale-0 transition-all duration-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 6-12 12"/><path d="m6 6 12 12"/></svg>
                </div>
            </button>
        </div>
    </div>

<?php wp_footer(); ?>
<?php echo mds_pro_get_option( 'footer_settings', 'footer_scripts', '' ); ?>
<?php echo mds_pro_get_option( 'custom_code', 'footer_code', '' ); ?>

</body>
</html>
