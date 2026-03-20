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
function mds_pro_custom_css() {
    // Layout Presets Logic
    $layout_preset = mds_pro_get_option( 'layout_pro', 'layout_preset', 'meloso' );
    
    $presets = array(
        'suave'  => array( 'width' => '1400', 'gap' => '40', 'radius' => '20' ),
        'meloso' => array( 'width' => '1200', 'gap' => '30', 'radius' => '12' ),
        'brava'  => array( 'width' => '1100', 'gap' => '20', 'radius' => '4' ),
    );

    if ( 'custom' === $layout_preset ) {
        $site_width    = mds_pro_get_option( 'layout_pro', 'custom_site_width', '1200' );
        $border_radius = mds_pro_get_option( 'layout_pro', 'custom_radius', '12' );
        $gap_desktop   = mds_pro_get_option( 'layout_pro', 'custom_gap', '30' );
    } else {
        $site_width    = $presets[$layout_preset]['width'];
        $border_radius = $presets[$layout_preset]['radius'];
        $gap_desktop   = $presets[$layout_preset]['gap'];
    }

    // Colors Logic
    $palette = mds_pro_get_option( 'colors_pro', 'color_palette', 'clasica' );
    $palettes = array(
        'clasica'  => '#e74c3c',
        'tropical' => '#2ecc71',
        'noche'    => '#8e44ad',
    );
    
    $primary_color = mds_pro_get_option( 'colors_pro', 'primary_color', $palettes[$palette] );

    // Mobile Gap (50% of desktop gap for mobile-first responsiveness)
    $gap_mobile = intval( $gap_desktop ) * 0.5;

    ?>
    <style id="mds-pro-custom-css">
        :root {
            --mds-primary: <?php echo esc_attr( $primary_color ); ?>;
            --mds-bg: #ffffff;
            --mds-text: #1f2937;
            
            /* Fluid Typography */
            --mds-font-heading: clamp(2rem, 5vw, 4rem);
            
            --mds-site-width: <?php echo esc_attr( $site_width ); ?>px;
            --mds-radius: <?php echo esc_attr( $border_radius ); ?>px;
            --mds-gap: <?php echo esc_attr( $gap_desktop ); ?>px;
        }

        @media (max-width: 768px) {
            :root {
                --mds-gap: <?php echo esc_attr( $gap_mobile ); ?>px;
            }
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--mds-text);
            background-color: var(--mds-bg);
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            text-transform: uppercase;
        }

        h1 { font-size: var(--mds-font-heading); }

        .container {
            max-width: var(--mds-site-width);
            margin: 0 auto;
            padding: 0 var(--mds-gap);
        }

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
    </style>
    <?php
}
add_action( 'wp_head', 'mds_pro_custom_css', 100 );

/**
 * Enqueue Google Fonts dynamically
 */
function mds_pro_enqueue_custom_fonts() {
    $body_font    = mds_pro_get_option( 'typography', 'body_font', 'Inter' );
    $heading_font = mds_pro_get_option( 'typography', 'headings_font', 'Space Grotesk' );
    
    $fonts = array_unique([$body_font, $heading_font]);
    $font_families = [];
    
    foreach ($fonts as $font) {
        $font_families[] = str_replace(' ', '+', $font) . ':wght@400;500;600;700';
    }
    
    if (!empty($font_families)) {
        $query_args = [
            'family' => implode('|', $font_families),
            'display' => 'swap',
        ];
        $fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
        wp_enqueue_style('mds-pro-custom-fonts', $fonts_url, [], null);
    }
}
add_action( 'wp_enqueue_scripts', 'mds_pro_enqueue_custom_fonts' );
