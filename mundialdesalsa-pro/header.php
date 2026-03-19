<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ( is_single() && mds_pro_get_option( 'performance', 'amp_support', false ) ) : ?>
        <link rel="amphtml" href="<?php echo esc_url( get_permalink() . 'amp/' ); ?>">
    <?php endif; ?>
	<link rel="profile" href="https://gmpg.org/xfn/11">
    
    <!-- Tailwind CSS CDN for Demo -->
    <script src="https://cdn.tailwindcss.com"></script>
    
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

<?php 
$playlist_url = '';
if ( is_single() ) {
    $playlist_url = get_post_meta( get_the_ID(), '_mds_playlist_url', true );
}
?>
<body <?php body_class('dark:bg-slate-950 dark:text-slate-200'); ?> data-playlist="<?php echo esc_attr( $playlist_url ); ?>">
<?php wp_body_open(); ?>

<?php if ( is_single() && mds_pro_get_option( 'general', 'reading_progress', true ) ) : ?>
    <div id="reading-progress-bar" class="fixed top-0 left-0 h-1 bg-emerald-500 z-[9999] transition-all duration-100 w-0"></div>
<?php endif; ?>

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
                <div class="flex gap-3 ml-2 border-l border-white/10 pl-4">
                    <?php
                    $social_links = [
                        'facebook'  => [
                            'url'  => mds_pro_get_option( 'social', 'facebook_url', '#' ),
                            'icon' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>'
                        ],
                        'instagram' => [
                            'url'  => mds_pro_get_option( 'social', 'instagram_url', '#' ),
                            'icon' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>'
                        ],
                        'youtube'   => [
                            'url'  => mds_pro_get_option( 'social', 'youtube_url', '#' ),
                            'icon' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.42a2.78 2.78 0 0 0-1.94 2C1 8.11 1 12 1 12s0 3.89.42 5.58a2.78 2.78 0 0 0 1.94 2c1.71.42 8.6.42 8.6.42s6.88 0 8.6-.42a2.78 2.78 0 0 0 1.94-2C23 15.89 23 12 23 12s0-3.89-.42-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/></svg>'
                        ],
                        'tiktok'    => [
                            'url'  => mds_pro_get_option( 'social', 'tiktok_url', '#' ),
                            'icon' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12.525.02c1.31 0 2.57.51 3.51 1.42.92.91 1.42 2.15 1.42 3.44 0 .09 0 .18-.01.26 1.18-.02 2.35.32 3.32.98.97.66 1.73 1.58 2.18 2.65.45 1.07.59 2.25.4 3.39-.19 1.14-.73 2.19-1.54 3.01-.81.82-1.85 1.38-2.99 1.61-1.14.23-2.33.13-3.41-.28-1.08-.41-2.02-1.14-2.71-2.08-.69-.94-1.08-2.08-1.12-3.26v-6.4c-.52.35-1.13.54-1.76.54-1.77 0-3.21-1.44-3.21-3.21 0-1.77 1.44-3.21 3.21-3.21.07 0 .14 0 .21.01V.02h.5z"/></svg>'
                        ],
                        'twitter'   => [
                            'url'  => mds_pro_get_option( 'social', 'twitter_url', '#' ),
                            'icon' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>'
                        ],
                    ];
                    foreach ( $social_links as $key => $data ) :
                        if ( $data['url'] && $data['url'] !== '#' ) : ?>
                            <a href="<?php echo esc_url( $data['url'] ); ?>" target="_blank" class="hover:text-emerald-400 transition-colors" title="<?php echo ucfirst( $key ); ?>">
                                <?php echo $data['icon']; ?>
                            </a>
                        <?php endif;
                    endforeach; ?>
                </div>
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
