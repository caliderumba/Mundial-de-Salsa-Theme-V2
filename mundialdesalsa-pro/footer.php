<?php
/**
 * The template for displaying the footer
 * 
 * @package MundialdeSalsa_Pro
 */
?>

	<footer id="colophon" class="site-footer bg-slate-900 dark:bg-black text-white py-16 mt-12">
		<div class="container mx-auto px-4">
			<div class="grid grid-cols-1 md:grid-cols-3 gap-12">
				
				<?php /* Columna 1: Sobre Nosotros */ ?>
				<div class="footer-column about-us">
					<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
						<?php dynamic_sidebar( 'footer-1' ); ?>
					<?php else : ?>
						<h3 class="text-xl font-black uppercase tracking-tighter italic mb-6 text-emerald-500">Sobre Nosotros</h3>
						<p class="text-slate-400 text-sm leading-relaxed">
							<?php echo esc_html( get_bloginfo( 'description' ) ); ?>
						</p>
					<?php endif; ?>
				</div>

				<?php /* Columna 2: Enlaces Rápidos */ ?>
				<div class="footer-column quick-links">
					<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
						<?php dynamic_sidebar( 'footer-2' ); ?>
					<?php else : ?>
						<h3 class="text-xl font-black uppercase tracking-tighter italic mb-6 text-emerald-500">Enlaces Rápidos</h3>
						<nav class="footer-navigation">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'footer-menu',
									'menu_class'     => 'flex flex-col gap-3 text-sm text-slate-400',
									'container'      => false,
									'fallback_cb'    => false,
								)
							);
							?>
						</nav>
					<?php endif; ?>
				</div>

				<?php /* Columna 3: Redes Sociales */ ?>
				<div class="footer-column social-media">
					<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
						<?php dynamic_sidebar( 'footer-3' ); ?>
					<?php else : ?>
						<h3 class="text-xl font-black uppercase tracking-tighter italic mb-6 text-emerald-500">Síguenos</h3>
						<div class="flex gap-4">
							<?php
							$socials = array( 'facebook', 'instagram', 'youtube', 'twitter', 'tiktok' );
							foreach ( $socials as $social ) :
								$url = mds_pro_get_option( 'social', $social . '_url', '#' );
								if ( $url && '#' !== $url ) :
									?>
									<a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener" class="p-3 bg-white/5 hover:bg-emerald-500 rounded-lg transition-all duration-300">
										<span class="screen-reader-text"><?php echo esc_html( ucfirst( $social ) ); ?></span>
										<i class="fab fa-<?php echo esc_attr( $social ); ?>"></i>
									</a>
									<?php
								endif;
							endforeach;
							?>
						</div>
					<?php endif; ?>
				</div>

			</div>

			<div class="footer-bottom mt-16 pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-4 text-[10px] font-bold uppercase tracking-widest text-slate-500">
				<p class="copyright">
					&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'Todos los derechos reservados.', 'mundialdesalsa-pro' ); ?>
				</p>
				<p class="credits">
					<?php esc_html_e( 'Diseñado para melómanos.', 'mundialdesalsa-pro' ); ?>
				</p>
			</div>
		</div>
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php /* Optimización: Scripts de analítica (Google Analytics, Pixel, etc.) deben ir aquí o mediante hooks para no bloquear el renderizado */ ?>
<?php 
global $mds_pro_options;
if ( ! empty( $mds_pro_options['footer_scripts'] ) ) {
    echo $mds_pro_options['footer_scripts'];
}
?>

<?php wp_footer(); ?>

</body>
</html>
