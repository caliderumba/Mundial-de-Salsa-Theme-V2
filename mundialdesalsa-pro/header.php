<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php /* Rendimiento: Sugerencias de preconnect para Google Fonts y CDN */ ?>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="preconnect" href="https://cdnjs.cloudflare.com">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <?php 
    global $mds_pro_options;
    if ( ! empty( $mds_pro_options['google_analytics'] ) ) {
        echo $mds_pro_options['google_analytics'];
    }
    if ( ! empty( $mds_pro_options['global_meta_tags'] ) ) {
        echo $mds_pro_options['global_meta_tags'];
    }
    ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class( 'dark:bg-slate-950 dark:text-slate-200' ); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Saltar al contenido', 'mundialdesalsa-pro' ); ?></a>

	<?php /* Estructura HTML5: Header semántico con clases compatibles con Elementor */ ?>
	<header id="masthead" class="site-header sticky top-0 z-[100] bg-white/95 dark:bg-slate-950/95 backdrop-blur-md shadow-sm border-b border-slate-100 dark:border-slate-800 transition-all duration-300">
		<div class="container mx-auto px-4">
			<div class="flex justify-between items-center h-20">
				
				<div class="site-branding flex items-center">
					<?php
					if ( has_custom_logo() ) :
						the_custom_logo();
					else :
						?>
						<h1 class="site-title text-2xl font-black uppercase tracking-tighter italic leading-none text-slate-900 dark:text-white">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<?php bloginfo( 'name' ); ?><span class="text-emerald-500">.</span>
							</a>
						</h1>
						<?php
					endif;
					?>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation hidden lg:block">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
							'container'      => false,
							'menu_class'     => 'flex gap-8 text-[11px] font-black uppercase tracking-widest text-slate-900 dark:text-slate-200',
							'fallback_cb'    => false,
							'walker'         => new Mundial_Salsa_Mega_Menu_Walker(),
						)
					);
					?>
				</nav><!-- #site-navigation -->

				<div class="header-actions flex items-center gap-4">
					<button id="mobile-menu-trigger" class="p-2 text-slate-900 dark:text-white" aria-label="<?php esc_attr_e( 'Menú', 'mundialdesalsa-pro' ); ?>">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
					</button>
					<button class="search-trigger p-2 hover:text-emerald-500 transition-colors" aria-label="<?php esc_attr_e( 'Buscar', 'mundialdesalsa-pro' ); ?>">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
					</button>
				</div>

			</div>
		</div>
	</header><!-- #masthead -->

	<?php /* Mobile Off-Canvas Side Panel */ ?>
	<div id="side-panel-overlay" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-[150] opacity-0 invisible transition-all duration-300"></div>
	<nav id="side-panel" class="fixed top-0 left-0 w-[320px] h-full bg-[#000] text-white z-[200] transform -translate-x-full transition-transform duration-500 ease-in-out flex flex-col shadow-[10px_0_30px_rgba(0,0,0,0.5)]">
		<div class="p-6 flex justify-between items-center border-b border-white/5">
			<span class="text-xs font-black uppercase tracking-widest italic text-[var(--mds-primary)]"><?php bloginfo( 'name' ); ?></span>
			<button id="side-panel-close" class="p-2 text-white/40 hover:text-[var(--mds-primary)] transition-colors">
				<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
			</button>
		</div>

		<div class="flex-1 overflow-y-auto p-8">
			<?php /* Mobile Accordion Menu (Text Only) */ ?>
			<div class="mb-12">
				<h4 class="text-[9px] uppercase tracking-[0.3em] text-white/20 font-black mb-6"><?php esc_html_e( 'Menú Principal', 'mundialdesalsa-pro' ); ?></h4>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'container'      => false,
						'menu_class'     => 'mobile-accordion-nav space-y-4',
						'fallback_cb'    => false,
						'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					)
				);
				?>
			</div>

			<?php /* Quick Links Section */ ?>
			<div class="side-panel-news">
				<h4 class="text-[9px] uppercase tracking-[0.3em] text-[var(--mds-primary)] font-black mb-6"><?php esc_html_e( 'Lo Más Visto', 'mundialdesalsa-pro' ); ?></h4>
				<?php
				$trending_query = new WP_Query( array(
					'posts_per_page' => 3,
					'post_status'    => 'publish',
					'orderby'        => 'meta_value_num',
					'meta_key'       => 'mds_pro_views_count',
					'no_found_rows'  => true,
				) );

				if ( $trending_query->have_posts() ) :
					echo '<ul class="space-y-4">';
					while ( $trending_query->have_posts() ) : $trending_query->the_post();
						?>
						<li>
							<a href="<?php the_permalink(); ?>" class="text-[13px] font-bold text-white/80 hover:text-[var(--mds-primary)] transition-colors uppercase italic leading-tight block">
								<?php the_title(); ?>
							</a>
						</li>
						<?php
					endwhile;
					echo '</ul>';
					wp_reset_postdata();
				endif;
				?>
			</div>
		</div>

		<div class="p-8 border-t border-white/5 bg-white/[0.02]">
			<p class="text-[8px] uppercase tracking-widest text-white/20 text-center mb-4"><?php esc_html_e( 'Síguenos en redes', 'mundialdesalsa-pro' ); ?></p>
			<div class="flex gap-6 justify-center">
				<a href="#" class="text-white/30 hover:text-[#e74c3c] transition-colors text-sm"><i class="fa-brands fa-facebook-f"></i></a>
				<a href="#" class="text-white/30 hover:text-[#e74c3c] transition-colors text-sm"><i class="fa-brands fa-instagram"></i></a>
				<a href="#" class="text-white/30 hover:text-[#e74c3c] transition-colors text-sm"><i class="fa-brands fa-x-twitter"></i></a>
			</div>
		</div>
	</nav>
