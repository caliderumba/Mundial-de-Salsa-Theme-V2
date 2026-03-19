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
    $primary_color    = mds_pro_get_option( 'colors', 'primary', '#10b981' );
    $secondary_color  = mds_pro_get_option( 'colors', 'secondary', '#064e3b' );
    $bg_color         = mds_pro_get_option( 'colors', 'background', '#ffffff' );
    $text_color       = mds_pro_get_option( 'colors', 'text', '#1f2937' );
    $accent_color     = mds_pro_get_option( 'colors', 'accent', '#f59e0b' );
    
    $body_font        = mds_pro_get_option( 'typography', 'body_font', 'Inter' );
    $heading_font     = mds_pro_get_option( 'typography', 'headings_font', 'Space Grotesk' );
    $body_size        = mds_pro_get_option( 'typography', 'body_size', '16' );

    $is_dark_mode     = mds_pro_get_option( 'general', 'dark_mode', false );

    ?>
    <style id="mds-pro-custom-css">
        :root {
            --mds-primary: <?php echo esc_attr( $primary_color ); ?>;
            --mds-secondary: <?php echo esc_attr( $secondary_color ); ?>;
            --mds-accent: <?php echo esc_attr( $accent_color ); ?>;
            --mds-bg: <?php echo esc_attr( $bg_color ); ?>;
            --mds-text: <?php echo esc_attr( $text_color ); ?>;
            
            --mds-body-font: '<?php echo esc_attr( $body_font ); ?>', sans-serif;
            --mds-heading-font: '<?php echo esc_attr( $heading_font ); ?>', sans-serif;
            
            --mds-body-size: <?php echo esc_attr( $body_size ); ?>px;
        }

        /* Dark Mode Overrides */
        html.dark {
            --mds-bg: #020617; /* slate-950 */
            --mds-text: #e2e8f0; /* slate-200 */
        }

        <?php if ( $is_dark_mode ) : ?>
        /* Force dark mode if set in theme options */
        html {
            background-color: #020617;
            color: #e2e8f0;
        }
        <?php endif; ?>

        body {
            font-family: var(--mds-body-font);
            font-size: var(--mds-body-size);
            color: var(--mds-text);
            background-color: var(--mds-bg);
            transition: background-color 0.3s, color 0.3s;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: var(--mds-heading-font);
            color: var(--mds-heading);
        }

        a {
            color: var(--mds-link);
            text-decoration: none;
            transition: opacity 0.2s;
        }

        a:hover {
            opacity: 0.8;
        }

        .bg-primary { background-color: var(--mds-primary) !important; }
        .text-primary { color: var(--mds-primary) !important; }
        .border-primary { border-color: var(--mds-primary) !important; }
        
        .bg-secondary { background-color: var(--mds-secondary) !important; }
        .text-secondary { color: var(--mds-secondary) !important; }

        /* Custom Header Styles */
        <?php 
        $header_bg = mds_pro_get_option( 'header', 'header_bg_color', '#ffffff' );
        $menu_color = mds_pro_get_option( 'header', 'menu_text_color', '#1f2937' );
        ?>
        .site-header {
            background-color: <?php echo esc_attr( $header_bg ); ?>;
        }
        .main-navigation a {
            color: <?php echo esc_attr( $menu_color ); ?> !important;
        }

        /* Custom Footer Styles */
        <?php 
        $footer_bg = mds_pro_get_option( 'footer', 'footer_bg_color', '#111827' );
        $footer_text = mds_pro_get_option( 'footer', 'footer_text_color', '#9ca3af' );
        ?>
        .site-footer {
            background-color: <?php echo esc_attr( $footer_bg ); ?>;
            color: <?php echo esc_attr( $footer_text ); ?>;
        }

        /* Custom CSS from Theme Options */
        <?php echo mds_pro_get_option( 'custom_code', 'custom_css', '' ); ?>
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
