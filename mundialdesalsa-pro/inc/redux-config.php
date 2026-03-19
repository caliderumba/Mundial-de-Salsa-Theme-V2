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
    ),
) );

Redux::setSection( $opt_name, array(
    'title'  => __( 'Layout', 'mundialdesalsa-pro' ),
    'id'     => 'layout',
    'icon'   => 'el el-website',
    'fields' => array(
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
            'id'       => 'single',
            'type'     => 'select',
            'title'    => __( 'Layout de Artículo', 'mundialdesalsa-pro' ),
            'options'  => array(
                'classic'  => 'Classic',
                'wide'     => 'Wide',
                'magazine' => 'Magazine',
                'video'    => 'Video',
                'minimal'  => 'Minimal',
            ),
            'default'  => 'classic',
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
    'title'  => __( 'Header', 'mundialdesalsa-pro' ),
    'id'     => 'header',
    'icon'   => 'el el-arrow-up',
    'fields' => array(
        array(
            'id'       => 'header_layout',
            'type'     => 'select',
            'title'    => __( 'Diseño de Header', 'mundialdesalsa-pro' ),
            'options'  => array(
                'standard' => 'Estándar',
                'centered' => 'Centrado',
                'minimal'  => 'Minimalista',
            ),
            'default'  => 'standard',
        ),
        array(
            'id'       => 'header_bg_color',
            'type'     => 'color',
            'title'    => __( 'Color de Fondo Header', 'mundialdesalsa-pro' ),
            'default'  => '#ffffff',
        ),
        array(
            'id'       => 'menu_text_color',
            'type'     => 'color',
            'title'    => __( 'Color de Texto Menú', 'mundialdesalsa-pro' ),
            'default'  => '#1f2937',
        ),
        array(
            'id'       => 'sticky_header',
            'type'     => 'switch',
            'title'    => __( 'Header Pegajoso', 'mundialdesalsa-pro' ),
            'default'  => true,
        ),
    ),
) );

Redux::setSection( $opt_name, array(
    'title'  => __( 'Footer', 'mundialdesalsa-pro' ),
    'id'     => 'footer',
    'icon'   => 'el el-arrow-down',
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
    ),
) );

Redux::setSection( $opt_name, array(
    'title'  => __( 'Publicidad', 'mundialdesalsa-pro' ),
    'id'     => 'ads',
    'icon'   => 'el el-megaphone',
    'fields' => array(
        array(
            'id'       => 'header_ad',
            'type'     => 'textarea',
            'title'    => __( 'Anuncio en Header', 'mundialdesalsa-pro' ),
            'subtitle' => __( 'Código HTML o AdSense.', 'mundialdesalsa-pro' ),
        ),
        array(
            'id'       => 'sidebar_ad',
            'type'     => 'textarea',
            'title'    => __( 'Anuncio en Sidebar', 'mundialdesalsa-pro' ),
        ),
        array(
            'id'       => 'content_ad',
            'type'     => 'textarea',
            'title'    => __( 'Anuncio en Contenido', 'mundialdesalsa-pro' ),
        ),
    ),
) );

Redux::setSection( $opt_name, array(
    'title'  => __( 'Performance', 'mundialdesalsa-pro' ),
    'id'     => 'performance',
    'icon'   => 'el el-dashboard',
    'fields' => array(
        array(
            'id'       => 'lazy_load',
            'type'     => 'switch',
            'title'    => __( 'Lazy Load de Imágenes', 'mundialdesalsa-pro' ),
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
