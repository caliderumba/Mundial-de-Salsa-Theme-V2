<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    
    <!-- Tailwind CSS CDN for Demo -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['Cormorant Garamond', 'serif'],
                    },
                    colors: {
                        emerald: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            200: '#a7f3d0',
                            300: '#6ee7b7',
                            400: '#34d399',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b',
                        },
                    }
                }
            }
        }
    </script>
    
    <script>
        // Apply dark mode immediately to avoid flicker
        (function() {
            const theme = localStorage.getItem('mds_theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
    
    <!-- SEO Meta Tags -->
    <?php if ( is_single() || is_page() ) : ?>
        <meta name="description" content="<?php echo wp_trim_words( get_the_excerpt(), 25 ); ?>">
        <meta property="og:title" content="<?php the_title(); ?>">
        <meta property="og:description" content="<?php echo wp_trim_words( get_the_excerpt(), 25 ); ?>">
        <meta property="og:type" content="article">
        <meta property="og:url" content="<?php the_permalink(); ?>">
        <?php if ( has_post_thumbnail() ) : ?>
            <meta property="og:image" content="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>">
        <?php endif; ?>
    <?php else : ?>
        <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    <?php endif; ?>
    <meta name="twitter:card" content="summary_large_image">

	<?php wp_head(); ?>
    <?php echo mds_pro_get_option( 'ads', 'header_ad', '' ); ?>
</head>

<body <?php body_class('dark:bg-slate-950 dark:text-slate-200'); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'mundialdesalsa-pro' ); ?></a>

    <!-- Top Bar -->
    <div class="bg-slate-900 dark:bg-black text-white py-2 text-[10px] font-bold uppercase tracking-widest">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex gap-4">
                <span><?php echo date('l, F j, Y'); ?></span>
                <span class="text-emerald-400">MundialdeSalsa Pro Edition</span>
            </div>
            <div class="flex gap-4 items-center">
                <button id="dark-mode-toggle" class="p-2 hover:bg-white/10 rounded-full transition-colors flex items-center justify-center" aria-label="Toggle Dark Mode">
                    <svg id="sun-icon" class="hidden" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="5"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>
                    <svg id="moon-icon" class="hidden" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                </button>
                <a href="#" class="hover:text-emerald-400 transition-colors">Facebook</a>
                <a href="#" class="hover:text-emerald-400 transition-colors">Instagram</a>
                <a href="#" class="hover:text-emerald-400 transition-colors">YouTube</a>
            </div>
        </div>
    </div>

	<header id="masthead" class="site-header bg-white dark:bg-slate-900 border-b border-slate-100 dark:border-slate-800">
        <!-- Main Logo Area -->
        <div class="container mx-auto px-4 py-8 flex flex-col items-center gap-6">
            <div class="site-branding">
                <h1 class="text-5xl md:text-7xl font-black uppercase tracking-tighter italic leading-none text-slate-900 dark:text-white">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <?php 
                        $site_name = mds_pro_get_option( 'general', 'site_name', 'MundialdeSalsa' );
                        echo esc_html( $site_name );
                        ?><span class="text-emerald-500">.</span>
                    </a>
                </h1>
                <p class="text-center text-xs font-bold uppercase tracking-[0.3em] text-slate-400 mt-2">La Revista Digital de la Salsa</p>
            </div>
            
            <!-- Ad Space in Header (Optional) -->
            <?php if ( $header_ad = mds_pro_get_option('ads', 'header_ad') ) : ?>
                <div class="w-full max-w-4xl mx-auto">
                    <?php echo $header_ad; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Navigation -->
        <nav class="border-t border-slate-100 dark:border-slate-800 py-4">
            <div class="container mx-auto px-4 flex justify-center">
                <?php
                wp_nav_menu( [
                    'theme_location' => 'menu-1',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                    'menu_class'     => 'flex gap-8 text-xs font-black uppercase tracking-widest text-slate-900 dark:text-slate-200',
                    'fallback_cb'    => 'mds_pro_fallback_menu',
                ] );
                ?>
            </div>
        </nav>
	</header>

    <!-- News Ticker -->
    <div class="bg-emerald-500 text-white py-3 overflow-hidden">
        <div class="container mx-auto px-4 flex items-center gap-4">
            <span class="bg-white text-emerald-500 px-3 py-1 rounded text-[10px] font-black uppercase tracking-widest shrink-0">Última Hora</span>
            <div class="marquee-container overflow-hidden relative w-full h-5">
                <div class="marquee-content absolute whitespace-nowrap animate-marquee flex gap-12 text-xs font-bold uppercase tracking-widest">
                    <span>🔥 Cali se prepara para el Festival Mundial de Salsa 2026</span>
                    <span>🕺 Nuevos talentos emergen en la escena neoyorquina</span>
                    <span>💿 Marc Anthony anuncia gira mundial "Vivir Mi Vida"</span>
                    <span>🏆 Los mejores bailarines de Puerto Rico se reúnen en San Juan</span>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .animate-marquee {
            animation: marquee 30s linear infinite;
        }
        .animate-marquee:hover {
            animation-play-state: paused;
        }
    </style>
