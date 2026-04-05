<?php
/**
 * Custom CSS and Typography based on Theme Options
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Output custom CSS in the head
 */
/**
 * Get custom CSS variables based on theme options
 */
function mds_pro_get_custom_css_vars() {
    // Container Width
    $container_width = mds_pro_get_option( 'container_width', '1200' );
    $border_radius   = mds_pro_get_option( 'border_radius', '12' );
    $header_height   = mds_pro_get_option( 'header_height', '80' );

    // Typography
    $main_title = mds_pro_get_option( 'main_title_typo', array() );
    $subtitle   = mds_pro_get_option( 'subtitle_typo', array() );
    $paragraph  = mds_pro_get_option( 'paragraph_typo', array() );
    $nav_typo   = mds_pro_get_option( 'nav_typography', array() );

    // Colors
    $color_h1        = mds_pro_get_option( 'color_h1', '#e74c3c' );
    $color_subheader = mds_pro_get_option( 'color_subheader', '#2c3e50' );
    $color_text      = mds_pro_get_option( 'color_text', '#334155' );
    $color_accent    = mds_pro_get_option( 'color_accent', '#10b981' );
    $bg_page         = mds_pro_get_option( 'bg_page', '#f1f5f9' );
    $bg_content      = mds_pro_get_option( 'bg_content', '#ffffff' );

    // Custom CSS from Redux
    $custom_css = mds_pro_get_option( 'custom_css', '' );

    // Header Transparent
    $header_transparent = mds_pro_get_option( 'header_transparent_home', false ) && is_front_page();

    ob_start();
    ?>
    :root {
        --mds-primary: <?php echo esc_attr( $color_h1 ); ?>;
        --mds-secondary: <?php echo esc_attr( $color_subheader ); ?>;
        --mds-accent: <?php echo esc_attr( $color_text ); ?>;
        --mds-highlight: <?php echo esc_attr( $color_accent ); ?>;
        --mds-container-width: <?php echo esc_attr( $container_width ); ?>px;
        --mds-header-height: <?php echo esc_attr( $header_height ); ?>px;
        
        /* Typography Variables */
        --mds-font-main-title: <?php echo isset($main_title['font-family']) ? esc_attr($main_title['font-family']) : 'Space Grotesk'; ?>, sans-serif;
        --mds-font-subtitle: <?php echo isset($subtitle['font-family']) ? esc_attr($subtitle['font-family']) : 'Inter'; ?>, sans-serif;
        --mds-font-paragraph: <?php echo isset($paragraph['font-family']) ? esc_attr($paragraph['font-family']) : 'Inter'; ?>, sans-serif;
        --mds-font-nav: <?php echo isset($nav_typo['font-family']) ? esc_attr($nav_typo['font-family']) : 'Inter'; ?>, sans-serif;

        --mds-size-main-title: <?php echo isset($main_title['font-size']) ? esc_attr($main_title['font-size']) : '48px'; ?>;
        --mds-size-subtitle: <?php echo isset($subtitle['font-size']) ? esc_attr($subtitle['font-size']) : '24px'; ?>;
        --mds-size-paragraph: <?php echo isset($paragraph['font-size']) ? esc_attr($paragraph['font-size']) : '16px'; ?>;
        --mds-size-nav: <?php echo isset($nav_typo['font-size']) ? esc_attr($nav_typo['font-size']) : '13px'; ?>;

        --mds-weight-main-title: <?php echo isset($main_title['font-weight']) ? esc_attr($main_title['font-weight']) : '700'; ?>;
        --mds-weight-subtitle: <?php echo isset($subtitle['font-weight']) ? esc_attr($subtitle['font-weight']) : '600'; ?>;
        --mds-weight-paragraph: <?php echo isset($paragraph['font-weight']) ? esc_attr($paragraph['font-weight']) : '400'; ?>;
        --mds-weight-nav: <?php echo isset($nav_typo['font-weight']) ? esc_attr($nav_typo['font-weight']) : '700'; ?>;
        
        --mds-gap: 30px;
        --mds-radius: <?php echo esc_attr( $border_radius ); ?>px;
    }

    body {
        font-family: var(--mds-font-paragraph);
        font-size: var(--mds-size-paragraph);
        font-weight: var(--mds-weight-paragraph);
        color: <?php echo esc_attr( $color_text ); ?>;
        background-color: <?php echo esc_attr( $bg_page ); ?>;
    }

    #page {
        background-color: <?php echo esc_attr( $bg_content ); ?>;
    }

    h1, h2, h3, .main-title {
        color: <?php echo esc_attr( $color_h1 ); ?>;
        font-family: var(--mds-font-main-title);
        font-weight: var(--mds-weight-main-title);
        text-transform: uppercase;
    }

    h1 { font-size: var(--mds-size-main-title); }

    .subtitle, h4, h5, h6 {
        color: <?php echo esc_attr( $color_subheader ); ?>;
        font-family: var(--mds-font-subtitle);
        font-weight: var(--mds-weight-subtitle);
        font-size: var(--mds-size-subtitle);
    }

    .main-navigation a {
        font-family: var(--mds-font-nav);
        font-size: var(--mds-size-nav);
        font-weight: var(--mds-weight-nav);
        color: <?php echo isset($nav_typo['color']) ? esc_attr($nav_typo['color']) : 'inherit'; ?>;
    }

    .site-header {
        height: var(--mds-header-height);
    }
    .site-header .container > div {
        height: var(--mds-header-height);
    }

    .container {
        max-width: var(--mds-container-width);
        margin: 0 auto;
        padding: 0 20px;
    }

    <?php if ( $header_transparent ) : ?>
    .site-header {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        background: transparent !important;
        border-bottom: none !important;
        z-index: 50;
    }
    <?php endif; ?>

    .bg-salsa { background-color: var(--mds-primary); color: #fff; }
    .text-salsa { color: var(--mds-primary); }
    .border-salsa { border-color: var(--mds-primary); }
    
    .rounded-salsa { border-radius: var(--mds-radius); }

    /* Mega Menu Pro Styles */
    .mega-menu-pro .mega-menu-content {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    .mega-menu-pro article img {
        transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .mega-menu-pro article:hover img {
        transform: scale(1.05);
    }

    /* Mobile Accordion Nav */
    .mobile-accordion-nav a {
        display: block;
        font-size: 16px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: -0.02em;
        color: rgba(255, 255, 255, 0.7);
        transition: color 0.3s ease;
        padding: 10px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
    .mobile-accordion-nav a:hover {
        color: var(--mds-primary);
    }
    .mobile-accordion-nav .sub-menu {
        padding-left: 20px;
        margin-top: 10px;
        border-left: 2px solid var(--mds-primary);
    }

    /* Block Specific Styles */
    .mds-bento-grid article { border-radius: var(--mds-radius); }
    .mds-smart-list article img { border-radius: var(--mds-radius); }
    .mds-video-hero { border-radius: var(--mds-radius); }
    
    #mds-theater-container.theater-active {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 90vw;
        max-width: 1200px;
        z-index: 100;
        margin: 0;
    }
    
    #mds-theater-container.theater-active #mds-theater-toggle {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        background: white;
        color: black;
        z-index: 101;
    }

    <?php echo $custom_css; ?>
    <?php
    return ob_get_clean();
}

/**
 * Output custom CSS in the head
 */
function mds_pro_custom_css() {
    $css = mds_pro_get_custom_css_vars();
    echo '<style id="mds-pro-custom-css">' . $css . '</style>';
}
add_action( 'wp_head', 'mds_pro_custom_css', 100 );

/**
 * Output custom CSS in the block editor
 */
function mds_pro_editor_custom_css() {
    $css = mds_pro_get_custom_css_vars();
    wp_add_inline_style( 'wp-edit-blocks', $css );
}
add_action( 'enqueue_block_editor_assets', 'mds_pro_editor_custom_css' );

/**
 * Enqueue Google Fonts dynamically
 */
function mds_pro_enqueue_custom_fonts() {
    $fonts = array();
    
    $main_title_typo = mds_pro_get_option( 'main_title_typo', array() );
    $subtitle_typo   = mds_pro_get_option( 'subtitle_typo', array() );
    $paragraph_typo  = mds_pro_get_option( 'paragraph_typo', array() );
    $nav_typo        = mds_pro_get_option( 'nav_typography', array() );

    if ( isset( $main_title_typo['font-family'] ) ) $fonts[] = $main_title_typo['font-family'];
    if ( isset( $subtitle_typo['font-family'] ) ) $fonts[] = $subtitle_typo['font-family'];
    if ( isset( $paragraph_typo['font-family'] ) ) $fonts[] = $paragraph_typo['font-family'];
    if ( isset( $nav_typo['font-family'] ) ) $fonts[] = $nav_typo['font-family'];

    $fonts = array_unique( array_filter( $fonts ) );
    
    if ( empty( $fonts ) ) {
        return;
    }

    $font_families = [];
    foreach ( $fonts as $font ) {
        $font_families[] = 'family=' . str_replace( ' ', '+', $font ) . ':wght@400;500;600;700;900';
    }

    $fonts_url = 'https://fonts.googleapis.com/css2?' . implode( '&', $font_families ) . '&display=swap';
    wp_enqueue_style( 'mds-pro-custom-fonts', $fonts_url, array(), null );
}
add_action( 'wp_enqueue_scripts', 'mds_pro_enqueue_custom_fonts' );
