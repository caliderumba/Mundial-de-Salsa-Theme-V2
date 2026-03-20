<?php
/**
 * Redux Framework Configuration
 */

if ( ! class_exists( 'Redux' ) ) {
    return;
}

$opt_name = 'mds_pro_options';

$theme = wp_get_theme();

$args = array(
    'opt_name'             => $opt_name,
    'display_name'         => $theme->get( 'Name' ),
    'display_version'      => $theme->get( 'Version' ),
    'menu_type'            => 'menu',
    'allow_sub_menu'       => true,
    'menu_title'           => __( 'Panel MDS', 'mundialdesalsa-pro' ),
    'page_title'           => __( 'Panel MDS Pro', 'mundialdesalsa-pro' ),
    'google_api_key'       => '',
    'google_update_weekly' => false,
    'async_typography'     => true,
    'admin_bar'            => true,
    'admin_bar_icon'       => 'dashicons-performance',
    'admin_bar_priority'   => 50,
    'global_variable'      => 'mds_pro_options',
    'dev_mode'             => false,
    'update_notice'        => true,
    'customizer'           => true,
    'page_priority'        => null,
    'page_parent'          => 'themes.php',
    'page_permissions'     => 'manage_options',
    'menu_icon'            => 'dashicons-performance',
    'last_tab'             => '',
    'page_icon'            => 'icon-themes',
    'page_slug'            => 'mds_pro_options',
    'save_defaults'        => true,
    'default_show'         => false,
    'default_mark'         => '',
    'show_import_export'   => true,
);

Redux::setArgs( $opt_name, $args );

// Sections
Redux::setSection( $opt_name, array(
    'title'  => __( 'General', 'mundialdesalsa-pro' ),
    'id'     => 'general',
    'desc'   => __( 'Configuración general del sitio.', 'mundialdesalsa-pro' ),
    'icon'   => 'el el-home',
    'fields' => array(
        array(
            'id'       => 'site_name',
            'type'     => 'text',
            'title'    => __( 'Nombre del Sitio', 'mundialdesalsa-pro' ),
            'default'  => 'MundialdeSalsa Magazine',
        ),
        array(
            'id'       => 'favicon',
            'type'     => 'media',
            'title'    => __( 'Favicon', 'mundialdesalsa-pro' ),
        ),
        array(
            'id'       => 'dark_mode',
            'type'     => 'switch',
            'title'    => __( 'Modo Oscuro', 'mundialdesalsa-pro' ),
            'subtitle' => __( 'Activar el tema oscuro globalmente.', 'mundialdesalsa-pro' ),
            'default'  => false,
        ),
        array(
            'id'       => 'breadcrumbs',
            'type'     => 'switch',
            'title'    => __( 'Breadcrumbs', 'mundialdesalsa-pro' ),
            'default'  => true,
        ),
        array(
            'id'       => 'reading_progress',
            'type'     => 'switch',
            'title'    => __( 'Barra de Progreso de Lectura', 'mundialdesalsa-pro' ),
            'subtitle' => __( 'Muestra una barra de progreso en la parte superior de los artículos.', 'mundialdesalsa-pro' ),
            'default'  => true,
        ),
    ),
) );

Redux::setSection( $opt_name, array(
    'title'  => __( 'Redes Sociales', 'mundialdesalsa-pro' ),
    'id'     => 'social',
    'icon'   => 'el el-share',
    'fields' => array(
        array(
            'id'       => 'facebook_url',
            'type'     => 'text',
            'title'    => 'Facebook URL',
            'default'  => '#',
        ),
        array(
            'id'       => 'instagram_url',
            'type'     => 'text',
            'title'    => 'Instagram URL',
            'default'  => '#',
        ),
        array(
            'id'       => 'youtube_url',
            'type'     => 'text',
            'title'    => 'YouTube URL',
            'default'  => '#',
        ),
        array(
            'id'       => 'tiktok_url',
            'type'     => 'text',
            'title'    => 'TikTok URL',
            'default'  => '#',
        ),
        array(
            'id'       => 'twitter_url',
            'type'     => 'text',
            'title'    => 'Twitter/X URL',
            'default'  => '#',
        ),
    ),
) );

Redux::setSection( $opt_name, array(
    'title'  => __( 'Layout', 'mundialdesalsa-pro' ),
    'id'     => 'layout',
    'icon'   => 'el el-website',
    'fields' => array(
        array(
            'id'       => 'site_width',
            'type'     => 'slider',
            'title'    => __( 'Ancho del Sitio (px)', 'mundialdesalsa-pro' ),
            'subtitle' => __( 'Define el ancho máximo del contenedor principal.', 'mundialdesalsa-pro' ),
            'min'      => 1000,
            'max'      => 1600,
            'step'     => 10,
            'default'  => 1200,
        ),
        array(
            'id'       => 'header_width',
            'type'     => 'button_set',
            'title'    => __( 'Ancho del Header', 'mundialdesalsa-pro' ),
            'options'  => array(
                'full'  => 'Ancho Completo',
                'boxed' => 'En Caja (Boxed)',
            ),
            'default'  => 'boxed',
        ),
        array(
            'id'       => 'footer_width',
            'type'     => 'button_set',
            'title'    => __( 'Ancho del Footer', 'mundialdesalsa-pro' ),
            'options'  => array(
                'full'  => 'Ancho Completo',
                'boxed' => 'En Caja (Boxed)',
            ),
            'default'  => 'boxed',
        ),
        array(
            'id'       => 'homepage',
            'type'     => 'select',
            'title'    => __( 'Layout de Portada', 'mundialdesalsa-pro' ),
            'options'  => array(
                'magazine' => 'Magazine',
                'hero'     => 'Hero Focus',
                'news'     => 'News Grid',
            ),
            'default'  => 'magazine',
        ),
        array(
            'id'       => 'single_layout',
            'type'     => 'select',
            'title'    => __( 'Layout de Artículo', 'mundialdesalsa-pro' ),
            'options'  => array(
                'classic'  => 'Classic (Sidebar)',
                'wide'     => 'Wide (No Sidebar)',
                'magazine' => 'Magazine Style',
                'video'    => 'Video Layout',
                'minimal'  => 'Minimalist',
            ),
            'default'  => 'classic',
        ),
        array(
            'id'       => 'page_layout',
            'type'     => 'select',
            'title'    => __( 'Layout de Páginas', 'mundialdesalsa-pro' ),
            'options'  => array(
                'standard' => 'Estándar (Sidebar)',
                'full'     => 'Ancho Completo',
                'narrow'   => 'Estrecho (Centrado)',
            ),
            'default'  => 'standard',
        ),
        array(
            'id'       => 'sidebar_position',
            'type'     => 'button_set',
            'title'    => __( 'Posición de Sidebar', 'mundialdesalsa-pro' ),
            'options'  => array(
                'left'  => 'Izquierda',
                'right' => 'Derecha',
                'none'  => 'Sin Sidebar',
            ),
            'default'  => 'right',
        ),
        array(
            'id'       => 'responsive_gap',
            'type'     => 'spacing',
            'title'    => __( 'Espaciado Responsivo (Gap)', 'mundialdesalsa-pro' ),
            'subtitle' => __( 'Define el espacio entre bloques para Desktop y Mobile.', 'mundialdesalsa-pro' ),
            'mode'     => 'padding',
            'units'    => array( 'px', 'em', 'rem' ),
            'default'  => array(
                'padding-top'    => '30px',
                'padding-bottom' => '15px',
            ),
        ),
        array(
            'id'       => 'border_radius',
            'type'     => 'slider',
            'title'    => __( 'Radio de Borde (px)', 'mundialdesalsa-pro' ),
            'subtitle' => __( 'Define el redondeo de las esquinas en bloques y botones.', 'mundialdesalsa-pro' ),
            'min'      => 0,
            'max'      => 50,
            'step'     => 1,
            'default'  => 8,
        ),
    ),
) );

Redux::setSection( $opt_name, array(
    'title'  => __( 'Header', 'mundialdesalsa-pro' ),
    'id'     => 'header_settings',
    'icon'   => 'el el-cog',
    'fields' => array(
        array(
            'id'       => 'header_layout',
            'type'     => 'select',
            'title'    => __( 'Diseño de Cabecera', 'mundialdesalsa-pro' ),
            'options'  => array(
                'standard' => 'Estándar (Logo Izquierda, Menú Derecha)',
                'centered' => 'Centrado (Logo Arriba, Menú Abajo)',
                'minimal'  => 'Minimalista (Logo Centro, Menú Hamburguesa)',
                'split'    => 'Dividido (Menú Izquierda/Derecha, Logo Centro)',
            ),
            'default'  => 'standard',
        ),
        array(
            'id'       => 'header_sticky',
            'type'     => 'switch',
            'title'    => __( 'Cabecera Pegajosa (Sticky)', 'mundialdesalsa-pro' ),
            'default'  => true,
        ),
        array(
            'id'       => 'header_top_bar',
            'type'     => 'switch',
            'title'    => __( 'Mostrar Barra Superior', 'mundialdesalsa-pro' ),
            'default'  => true,
        ),
        array(
            'id'       => 'header_search',
            'type'     => 'switch',
            'title'    => __( 'Mostrar Buscador', 'mundialdesalsa-pro' ),
            'default'  => true,
        ),
        array(
            'id'       => 'header_logo',
            'type'     => 'media',
            'title'    => __( 'Logo Principal', 'mundialdesalsa-pro' ),
            'subtitle' => __( 'Sube tu logo en formato PNG o SVG.', 'mundialdesalsa-pro' ),
        ),
        array(
            'id'       => 'header_logo_dark',
            'type'     => 'media',
            'title'    => __( 'Logo Modo Oscuro', 'mundialdesalsa-pro' ),
            'subtitle' => __( 'Logo optimizado para fondos oscuros.', 'mundialdesalsa-pro' ),
        ),
        array(
            'id'       => 'header_height',
            'type'     => 'slider',
            'title'    => __( 'Altura de Cabecera (px)', 'mundialdesalsa-pro' ),
            'min'      => 60,
            'max'      => 120,
            'step'     => 1,
            'default'  => 80,
        ),
    ),
) );

Redux::setSection( $opt_name, array(
    'title'  => __( 'Performance', 'mundialdesalsa-pro' ),
    'id'     => 'performance',
    'icon'   => 'el el-dashboard',
    'fields' => array(
        array(
            'id'       => 'infinite_scroll',
            'type'     => 'switch',
            'title'    => __( 'Infinite Scroll / Load More', 'mundialdesalsa-pro' ),
            'subtitle' => __( 'Activar la carga de posts mediante AJAX.', 'mundialdesalsa-pro' ),
            'default'  => false,
        ),
        array(
            'id'       => 'lazy_load',
            'type'     => 'switch',
            'title'    => __( 'Lazy Load de Imágenes', 'mundialdesalsa-pro' ),
            'subtitle' => __( 'Optimizar la carga de imágenes.', 'mundialdesalsa-pro' ),
            'default'  => true,
        ),
        array(
            'id'       => 'minify_css',
            'type'     => 'switch',
            'title'    => __( 'Minificar CSS', 'mundialdesalsa-pro' ),
            'default'  => false,
        ),
        array(
            'id'       => 'pwa',
            'type'     => 'switch',
            'title'    => __( 'Activar PWA', 'mundialdesalsa-pro' ),
            'default'  => false,
        ),
        array(
            'id'       => 'amp_support',
            'type'     => 'switch',
            'title'    => __( 'Soporte AMP', 'mundialdesalsa-pro' ),
            'subtitle' => __( 'Habilitar soporte para Accelerated Mobile Pages.', 'mundialdesalsa-pro' ),
            'default'  => false,
        ),
    ),
) );

Redux::setSection( $opt_name, array(
    'title'  => __( 'Monetización', 'mundialdesalsa-pro' ),
    'id'     => 'monetization',
    'icon'   => 'el el-money',
    'fields' => array(
        array(
            'id'       => 'ad_header',
            'type'     => 'textarea',
            'title'    => __( 'Anuncio en Cabecera', 'mundialdesalsa-pro' ),
            'subtitle' => __( 'Pega aquí el código de tu anuncio (728x90).', 'mundialdesalsa-pro' ),
        ),
        array(
            'id'       => 'ad_sidebar',
            'type'     => 'textarea',
            'title'    => __( 'Anuncio en Sidebar', 'mundialdesalsa-pro' ),
            'subtitle' => __( 'Pega aquí el código de tu anuncio (300x250).', 'mundialdesalsa-pro' ),
        ),
        array(
            'id'       => 'ad_post_bottom',
            'type'     => 'textarea',
            'title'    => __( 'Anuncio al final del Post', 'mundialdesalsa-pro' ),
            'subtitle' => __( 'Pega aquí el código de tu anuncio.', 'mundialdesalsa-pro' ),
        ),
        array(
            'id'       => 'content_ad',
            'type'     => 'textarea',
            'title'    => __( 'Anuncio en Contenido', 'mundialdesalsa-pro' ),
        ),
        array(
            'id'       => 'newsletter_shortcode',
            'type'     => 'text',
            'title'    => __( 'Shortcode de Newsletter', 'mundialdesalsa-pro' ),
            'subtitle' => __( 'Pega el shortcode de tu formulario de suscripción.', 'mundialdesalsa-pro' ),
        ),
    ),
) );

// Review Settings Section
Redux::setSection( $opt_name, array(
    'title'      => __( 'Sistema de Críticas', 'mundialdesalsa-pro' ),
    'id'         => 'reviews',
    'icon'       => 'el el-star',
    'fields'     => array(
        array(
            'id'       => 'enable_reviews',
            'type'     => 'switch',
            'title'    => __( 'Habilitar Sistema de Críticas', 'mundialdesalsa-pro' ),
            'default'  => true,
        ),
        array(
            'id'       => 'review_title',
            'type'     => 'text',
            'title'    => __( 'Título del Box de Crítica', 'mundialdesalsa-pro' ),
            'default'  => __( 'Veredicto Mundial', 'mundialdesalsa-pro' ),
        ),
        array(
            'id'       => 'review_color',
            'type'     => 'color',
            'title'    => __( 'Color de Acento de Crítica', 'mundialdesalsa-pro' ),
            'default'  => '#10b981',
        ),
    ),
) );

Redux::setSection( $opt_name, array(
    'title'  => __( 'Footer', 'mundialdesalsa-pro' ),
    'id'     => 'footer_settings',
    'icon'   => 'el el-website-alt',
    'fields' => array(
        array(
            'id'       => 'footer_layout',
            'type'     => 'select',
            'title'    => __( 'Diseño de Footer', 'mundialdesalsa-pro' ),
            'options'  => array(
                'standard' => 'Estándar (4 Columnas)',
                'simple'   => 'Simple',
            ),
            'default'  => 'standard',
        ),
        array(
            'id'       => 'footer_bg_color',
            'type'     => 'color',
            'title'    => __( 'Color de Fondo Footer', 'mundialdesalsa-pro' ),
            'default'  => '#111827',
        ),
        array(
            'id'       => 'footer_text_color',
            'type'     => 'color',
            'title'    => __( 'Color de Texto Footer', 'mundialdesalsa-pro' ),
            'default'  => '#9ca3af',
        ),
        array(
            'id'       => 'copyright_text',
            'type'     => 'text',
            'title'    => __( 'Texto de Copyright', 'mundialdesalsa-pro' ),
            'default'  => '© ' . date('Y') . ' MundialdeSalsa Magazine. Todos los derechos reservados.',
        ),
        array(
            'id'       => 'footer_scripts',
            'type'     => 'textarea',
            'title'    => __( 'Scripts del Pie de Página', 'mundialdesalsa-pro' ),
            'subtitle' => __( 'Pega aquí tus códigos de seguimiento (Google Analytics, etc.).', 'mundialdesalsa-pro' ),
        ),
    ),
) );

Redux::setSection( $opt_name, array(
    'title'  => __( 'Tipografía', 'mundialdesalsa-pro' ),
    'id'     => 'typography',
    'icon'   => 'el el-font',
    'fields' => array(
        array(
            'id'       => 'body_font',
            'type'     => 'typography',
            'title'    => __( 'Fuente Principal', 'mundialdesalsa-pro' ),
            'google'   => true,
            'default'  => array(
                'font-family' => 'Inter',
                'font-size'   => '16px',
            ),
        ),
        array(
            'id'       => 'headings_font',
            'type'     => 'typography',
            'title'    => __( 'Fuente de Títulos', 'mundialdesalsa-pro' ),
            'google'   => true,
            'default'  => array(
                'font-family' => 'Space Grotesk',
            ),
        ),
    ),
) );

Redux::setSection( $opt_name, array(
    'title'  => __( 'Colores', 'mundialdesalsa-pro' ),
    'id'     => 'colors',
    'icon'   => 'el el-brush',
    'fields' => array(
        array(
            'id'       => 'primary',
            'type'     => 'color',
            'title'    => __( 'Color Primario', 'mundialdesalsa-pro' ),
            'default'  => '#10b981',
        ),
        array(
            'id'       => 'secondary',
            'type'     => 'color',
            'title'    => __( 'Color Secundario', 'mundialdesalsa-pro' ),
            'default'  => '#064e3b',
        ),
        array(
            'id'       => 'accent',
            'type'     => 'color',
            'title'    => __( 'Color de Acento', 'mundialdesalsa-pro' ),
            'default'  => '#f59e0b',
        ),
        array(
            'id'       => 'background',
            'type'     => 'color',
            'title'    => __( 'Color de Fondo', 'mundialdesalsa-pro' ),
            'default'  => '#ffffff',
        ),
        array(
            'id'       => 'text',
            'type'     => 'color',
            'title'    => __( 'Color de Texto', 'mundialdesalsa-pro' ),
            'default'  => '#1f2937',
        ),
    ),
) );

Redux::setSection( $opt_name, array(
    'title'  => __( 'Código Personalizado', 'mundialdesalsa-pro' ),
    'id'     => 'custom_code',
    'icon'   => 'el el-css',
    'fields' => array(
        array(
            'id'       => 'custom_css',
            'type'     => 'ace_editor',
            'title'    => __( 'CSS Personalizado', 'mundialdesalsa-pro' ),
            'mode'     => 'css',
            'theme'    => 'monokai',
        ),
        array(
            'id'       => 'header_code',
            'type'     => 'ace_editor',
            'title'    => __( 'Código en Header', 'mundialdesalsa-pro' ),
            'mode'     => 'html',
            'theme'    => 'monokai',
        ),
        array(
            'id'       => 'footer_code',
            'type'     => 'ace_editor',
            'title'    => __( 'Código en Footer', 'mundialdesalsa-pro' ),
            'mode'     => 'html',
            'theme'    => 'monokai',
        ),
    ),
) );
