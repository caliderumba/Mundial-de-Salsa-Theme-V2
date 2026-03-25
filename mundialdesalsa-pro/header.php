<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

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

				<nav id="site-navigation" class="main-navigation hidden lg:block" aria-label="<?php esc_attr_e( 'Navegación Principal', 'mundialdesalsa-pro' ); ?>">
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
					<button 
                        id="mobile-menu-trigger" 
                        class="p-2 text-slate-900 dark:text-white hover:text-emerald-500 transition-colors" 
                        aria-label="<?php esc_attr_e( 'Abrir Menú', 'mundialdesalsa-pro' ); ?>"
                        aria-expanded="false"
                        aria-controls="side-panel"
                    >
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
	<div id="side-panel-overlay" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-[150] opacity-0 invisible transition-all duration-300" aria-hidden="true"></div>
	
    <nav 
        id="side-panel" 
        class="fixed top-0 left-0 w-[320px] h-full bg-[#000] text-white z-[200] transform -translate-x-full transition-transform duration-500 ease-in-out flex flex-col shadow-[10px_0_30px_rgba(0,0,0,0.5)]"
        aria-label="<?php esc_attr_e( 'Menú Lateral', 'mundialdesalsa-pro' ); ?>"
        aria-hidden="true"
    >
		<div class="p-6 flex justify-between items-center border-b border-white/5">
			<span class="text-xs font-black uppercase tracking-widest italic text-emerald-500"><?php bloginfo( 'name' ); ?></span>
			<button 
                id="side-panel-close" 
                class="p-2 text-white/40 hover:text-emerald-500 transition-colors"
                aria-label="<?php esc_attr_e( 'Cerrar Menú', 'mundialdesalsa-pro' ); ?>"
            >
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
				<h4 class="text-[9px] uppercase tracking-[0.3em] text-emerald-500 font-black mb-6"><?php esc_html_e( 'Lo Más Visto', 'mundialdesalsa-pro' ); ?></h4>
				<?php
				$trending_posts = mds_get_trending_posts( 3 );
				if ( ! empty( $trending_posts ) ) :
					echo '<ul class="space-y-4">';
					foreach ( $trending_posts as $post_item ) :
						?>
						<li>
							<a href="<?php echo esc_url( $post_item['link'] ); ?>" class="text-[13px] font-bold text-white/80 hover:text-emerald-500 transition-colors uppercase italic leading-tight block">
								<?php echo esc_html( $post_item['title'] ); ?>
							</a>
						</li>
						<?php
					endforeach;
					echo '</ul>';
				endif;
				?>
			</div>
		</div>

		<div class="p-8 border-t border-white/5 bg-white/[0.02]">
            <?php 
            $social_links = mds_get_social_links();
            if ( ! empty( $social_links ) ) : ?>
                <p class="text-[8px] uppercase tracking-widest text-white/20 text-center mb-4"><?php esc_html_e( 'Síguenos en redes', 'mundialdesalsa-pro' ); ?></p>
                <div class="flex gap-6 justify-center">
                    <?php foreach ( $social_links as $network => $data ) : ?>
                        <a href="<?php echo esc_url( $data['url'] ); ?>" target="_blank" rel="noopener" class="text-white/30 hover:text-emerald-500 transition-colors text-sm" title="<?php echo esc_attr( $data['label'] ); ?>">
                            <i class="<?php echo esc_attr( $data['icon'] ); ?>"></i>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
		</div>
	</nav>
