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
    'title'  => __( 'Cabecera y Navegación', 'mundialdesalsa-pro' ),
    'id'     => 'header_nav',
    'icon'   => 'el el-website',
    'fields' => array(
        array(
            'id'       => 'header_layout',
            'type'     => 'image_select',
            'title'    => __( 'Layout de Cabecera', 'mundialdesalsa-pro' ),
            'subtitle' => __( 'Selecciona la disposición de los elementos en el header.', 'mundialdesalsa-pro' ),
            'options'  => array(
                'left'   => array(
                    'alt' => 'Logo Izquierda',
                    'img' => 'https://placehold.co/200x100/e74c3c/ffffff?text=Logo+Izquierda',
                ),
                'center' => array(
                    'alt' => 'Logo Centro',
                    'img' => 'https://placehold.co/200x100/e74c3c/ffffff?text=Logo+Centro',
                ),
                'right'  => array(
                    'alt' => 'Logo Derecha',
                    'img' => 'https://placehold.co/200x100/e74c3c/ffffff?text=Logo+Derecha',
                ),
            ),
            'default'  => 'left',
        ),
        array(
            'id'       => 'header_transparent_home',
            'type'     => 'switch',
            'title'    => __( 'Header Transparente en Home', 'mundialdesalsa-pro' ),
            'subtitle' => __( 'Activa el fondo transparente para la cabecera solo en la página de inicio.', 'mundialdesalsa-pro' ),
            'default'  => false,
        ),
    ),
) );

Redux::setSection( $opt_name, array(
    'title'  => __( 'Diseño de Contenido', 'mundialdesalsa-pro' ),
    'id'     => 'content_design',
    'icon'   => 'el el-screen',
    'fields' => array(
        array(
            'id'       => 'single_sidebar_pos',
            'type'     => 'select',
            'title'    => __( 'Posición Sidebar (Single Post)', 'mundialdesalsa-pro' ),
            'options'  => array(
                'left'  => 'Izquierda',
                'right' => 'Derecha',
                'none'  => 'Sin Sidebar',
            ),
            'default'  => 'right',
        ),
        array(
            'id'       => 'category_sidebar_pos',
            'type'     => 'select',
            'title'    => __( 'Posición Sidebar (Categorías)', 'mundialdesalsa-pro' ),
            'options'  => array(
                'left'  => 'Izquierda',
                'right' => 'Derecha',
                'none'  => 'Sin Sidebar',
            ),
            'default'  => 'right',
        ),
        array(
            'id'       => 'news_grid_style',
            'type'     => 'button_set',
            'title'    => __( 'Estilo de Grilla de Noticias', 'mundialdesalsa-pro' ),
            'options'  => array(
                'grid' => 'Grid (Cuadrícula)',
                'list' => 'List (Lista)',
            ),
            'default'  => 'grid',
        ),
        array(
            'id'       => 'container_width',
            'type'     => 'slider',
            'title'    => __( 'Ancho del Contenedor (px)', 'mundialdesalsa-pro' ),
            'min'      => 1000,
            'max'      => 1600,
            'step'     => 10,
            'default'  => 1200,
        ),
    ),
) );

Redux::setSection( $opt_name, array(
    'title'  => __( 'Tipografía Pro', 'mundialdesalsa-pro' ),
    'id'     => 'typography_pro',
    'icon'   => 'el el-font',
    'fields' => array(
        array(
            'id'          => 'main_title_typo',
            'type'        => 'typography',
            'title'       => __( 'Títulos Principales', 'mundialdesalsa-pro' ),
            'google'      => true,
            'font-backup' => true,
            'default'     => array(
                'font-family' => 'Space Grotesk',
                'font-size'   => '48px',
                'font-weight' => '700',
            ),
        ),
        array(
            'id'          => 'subtitle_typo',
            'type'        => 'typography',
            'title'       => __( 'Subtítulos', 'mundialdesalsa-pro' ),
            'google'      => true,
            'font-backup' => true,
            'default'     => array(
                'font-family' => 'Inter',
                'font-size'   => '24px',
                'font-weight' => '600',
            ),
        ),
        array(
            'id'          => 'paragraph_typo',
            'type'        => 'typography',
            'title'       => __( 'Texto de Párrafo', 'mundialdesalsa-pro' ),
            'google'      => true,
            'font-backup' => true,
            'default'     => array(
                'font-family' => 'Inter',
                'font-size'   => '16px',
                'font-weight' => '400',
            ),
        ),
    ),
) );

Redux::setSection( $opt_name, array(
    'title'  => __( 'Colores Globales', 'mundialdesalsa-pro' ),
    'id'     => 'global_colors',
    'icon'   => 'el el-brush',
    'fields' => array(
        array(
            'id'      => 'primary',
            'type'    => 'color',
            'title'   => __( 'Color Primario', 'mundialdesalsa-pro' ),
            'default' => '#e74c3c',
        ),
        array(
            'id'      => 'secondary',
            'type'    => 'color',
            'title'   => __( 'Color Secundario', 'mundialdesalsa-pro' ),
            'default' => '#2c3e50',
        ),
        array(
            'id'      => 'accent',
            'type'    => 'color',
            'title'   => __( 'Color de Acento', 'mundialdesalsa-pro' ),
            'default' => '#f1c40f',
        ),
    ),
) );

Redux::setSection( $opt_name, array(
    'title'  => __( 'Pie de Página', 'mundialdesalsa-pro' ),
    'id'     => 'footer_pro',
    'icon'   => 'el el-website-alt',
    'fields' => array(
        array(
            'id'       => 'footer_columns',
            'type'     => 'select',
            'title'    => __( 'Columnas del Footer', 'mundialdesalsa-pro' ),
            'options'  => array(
                '1' => '1 Columna',
                '2' => '2 Columnas',
                '3' => '3 Columnas',
                '4' => '4 Columnas',
            ),
            'default'  => '4',
        ),
        array(
            'id'       => 'footer_credits',
            'type'     => 'text',
            'title'    => __( 'Aviso de Créditos', 'mundialdesalsa-pro' ),
            'default'  => '© ' . date('Y') . ' MundialdeSalsa Pro. Todos los derechos reservados.',
        ),
    ),
) );

Redux::setSection( $opt_name, array(
    'title'  => __( 'SEO & Scripts', 'mundialdesalsa-pro' ),
    'id'     => 'seo_scripts',
    'icon'   => 'el el-graph',
    'fields' => array(
        array(
            'id'       => 'google_analytics',
            'type'     => 'textarea',
            'title'    => __( 'Google Analytics / GTM', 'mundialdesalsa-pro' ),
            'subtitle' => __( 'Pega aquí el código de seguimiento (Head).', 'mundialdesalsa-pro' ),
        ),
        array(
            'id'       => 'footer_scripts',
            'type'     => 'textarea',
            'title'    => __( 'Scripts de Footer (Píxeles)', 'mundialdesalsa-pro' ),
            'subtitle' => __( 'Pega aquí códigos de Facebook Pixel, etc.', 'mundialdesalsa-pro' ),
        ),
        array(
            'id'       => 'global_meta_tags',
            'type'     => 'textarea',
            'title'    => __( 'Meta Tags Globales', 'mundialdesalsa-pro' ),
            'subtitle' => __( 'Tags adicionales para verificación de dominio, etc.', 'mundialdesalsa-pro' ),
        ),
        array(
            'id'       => 'custom_css',
            'type'     => 'ace_editor',
            'title'    => __( 'CSS Personalizado', 'mundialdesalsa-pro' ),
            'mode'     => 'css',
            'theme'    => 'monokai',
        ),
    ),
) );
