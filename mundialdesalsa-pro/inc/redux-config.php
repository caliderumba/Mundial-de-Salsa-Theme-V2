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
    'menu_title'           => __( 'Panel MDS Pro', 'mundialdesalsa-pro' ),
    'page_title'           => __( 'Opciones del Theme', 'mundialdesalsa-pro' ),
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
    'page_priority'        => 3,
    'page_parent'          => 'themes.php',
    'page_permissions'     => 'manage_options',
    'menu_icon'            => 'dashicons-performance',
    'last_tab'             => '',
    'page_icon'            => 'icon-themes',
    'page_slug'            => 'mds_pro_options_panel',
    'save_defaults'        => true,
    'default_show'         => false,
    'default_mark'         => '',
    'show_import_export'   => true,
);

Redux::setArgs( $opt_name, $args );

// Load defaults to use in Redux definitions
$defaults = mds_pro_get_option_defaults();

// --- DASHBOARD / WELCOME ---
Redux::setSection( $opt_name, array(
    'title'  => __( 'Dashboard', 'mundialdesalsa-pro' ),
    'id'     => 'dashboard_welcome',
    'icon'   => 'el el-dashboard',
    'fields' => array(
        array(
            'id'      => 'welcome_info',
            'type'    => 'info',
            'style'   => 'success',
            'title'   => __( 'Bienvenido a MundialdeSalsa Pro', 'mundialdesalsa-pro' ),
            'desc'    => __( 'Desde este panel puedes controlar cada aspecto visual y funcional de tu sitio web editorial. Diseñado para ofrecer una experiencia premium y profesional.', 'mundialdesalsa-pro' ),
        ),
        array(
            'id'       => 'site_status',
            'type'     => 'info',
            'style'    => 'info',
            'title'    => __( 'Estado del Sistema', 'mundialdesalsa-pro' ),
            'desc'     => sprintf( __( 'Versión del Theme: %s | WordPress: %s', 'mundialdesalsa-pro' ), $theme->get( 'Version' ), get_bloginfo( 'version' ) ),
        ),
    ),
) );

// --- BRANDING ---
Redux::setSection( $opt_name, array(
    'title'  => __( 'Branding', 'mundialdesalsa-pro' ),
    'id'     => 'branding_pro',
    'icon'   => 'el el-briefcase',
    'fields' => array(
        array(
            'id'       => 'site_logo',
            'type'     => 'media',
            'title'    => __( 'Logo Principal', 'mundialdesalsa-pro' ),
            'subtitle' => __( 'Sube el logo principal de tu sitio.', 'mundialdesalsa-pro' ),
            'default'  => $defaults['site_logo'],
        ),
        array(
            'id'       => 'site_logo_dark',
            'type'     => 'media',
            'title'    => __( 'Logo para Modo Oscuro', 'mundialdesalsa-pro' ),
            'subtitle' => __( 'Logo alternativo cuando el modo oscuro está activo.', 'mundialdesalsa-pro' ),
            'default'  => $defaults['site_logo_dark'],
        ),
        array(
            'id'       => 'site_favicon',
            'type'     => 'media',
            'title'    => __( 'Favicon', 'mundialdesalsa-pro' ),
            'default'  => $defaults['site_favicon'],
        ),
        array(
            'id'       => 'site_retina_logo',
            'type'     => 'switch',
            'title'    => __( 'Soporte para Retina', 'mundialdesalsa-pro' ),
            'default'  => $defaults['site_retina_logo'],
        ),
    ),
) );

// --- GLOBAL COLORS ---
Redux::setSection( $opt_name, array(
    'title'  => __( 'Colores Globales', 'mundialdesalsa-pro' ),
    'id'     => 'global_colors',
    'icon'   => 'el el-brush',
    'fields' => array(
        array(
            'id'      => 'color_h1',
            'type'    => 'color',
            'title'   => __( 'Color Títulos H1', 'mundialdesalsa-pro' ),
            'default' => $defaults['color_h1'],
        ),
        array(
            'id'      => 'color_subheader',
            'type'    => 'color',
            'title'   => __( 'Color Subheader', 'mundialdesalsa-pro' ),
            'default' => $defaults['color_subheader'],
        ),
        array(
            'id'      => 'color_text',
            'type'    => 'color',
            'title'   => __( 'Color Texto', 'mundialdesalsa-pro' ),
            'default' => $defaults['color_text'],
        ),
        array(
            'id'      => 'color_accent',
            'type'    => 'color',
            'title'   => __( 'Color de Acento', 'mundialdesalsa-pro' ),
            'default' => $defaults['color_accent'],
        ),
        array(
            'id'      => 'bg_page',
            'type'    => 'color',
            'title'   => __( 'Color de Fondo de Página', 'mundialdesalsa-pro' ),
            'default' => $defaults['bg_page'],
        ),
        array(
            'id'      => 'bg_content',
            'type'    => 'color',
            'title'   => __( 'Color de Fondo de Contenido', 'mundialdesalsa-pro' ),
            'default' => $defaults['bg_content'],
        ),
    ),
) );

// --- TYPOGRAPHY ---
Redux::setSection( $opt_name, array(
    'title'  => __( 'Tipografía', 'mundialdesalsa-pro' ),
    'id'     => 'typography_pro',
    'icon'   => 'el el-font',
    'fields' => array(
        array(
            'id'          => 'main_title_typo',
            'type'        => 'typography',
            'title'       => __( 'Títulos Principales', 'mundialdesalsa-pro' ),
            'google'      => true,
            'font-backup' => true,
            'default'     => $defaults['main_title_typo'],
        ),
        array(
            'id'          => 'subtitle_typo',
            'type'        => 'typography',
            'title'       => __( 'Subtítulos', 'mundialdesalsa-pro' ),
            'google'      => true,
            'font-backup' => true,
            'default'     => $defaults['subtitle_typo'],
        ),
        array(
            'id'          => 'paragraph_typo',
            'type'        => 'typography',
            'title'       => __( 'Texto de Párrafo', 'mundialdesalsa-pro' ),
            'google'      => true,
            'font-backup' => true,
            'default'     => $defaults['paragraph_typo'],
        ),
        array(
            'id'          => 'nav_typography',
            'type'        => 'typography',
            'title'       => __( 'Tipografía de Navegación', 'mundialdesalsa-pro' ),
            'google'      => true,
            'font-backup' => true,
            'default'     => $defaults['nav_typography'],
        ),
    ),
) );

// --- DESIGN SYSTEM ---
Redux::setSection( $opt_name, array(
    'title'  => __( 'Design System', 'mundialdesalsa-pro' ),
    'id'     => 'design_system',
    'icon'   => 'el el-magic',
    'fields' => array(
        array(
            'id'       => 'site_layout',
            'type'     => 'button_set',
            'title'    => __( 'Diseño del Sitio', 'mundialdesalsa-pro' ),
            'options'  => array(
                'full'  => 'Full Width',
                'boxed' => 'Boxed',
            ),
            'default'  => $defaults['site_layout'],
        ),
        array(
            'id'       => 'container_width',
            'type'     => 'slider',
            'title'    => __( 'Ancho del Contenedor (px)', 'mundialdesalsa-pro' ),
            'min'      => 1000,
            'max'      => 1600,
            'step'     => 10,
            'default'  => $defaults['container_width'],
        ),
        array(
            'id'       => 'border_radius',
            'type'     => 'slider',
            'title'    => __( 'Radio de Bordes (px)', 'mundialdesalsa-pro' ),
            'min'      => 0,
            'max'      => 30,
            'step'     => 1,
            'default'  => $defaults['border_radius'],
        ),
    ),
) );

// --- HEADER BUILDER SETTINGS ---
Redux::setSection( $opt_name, array(
    'title'  => __( 'Header Builder', 'mundialdesalsa-pro' ),
    'id'     => 'header_builder',
    'icon'   => 'el el-website',
    'fields' => array(
        array(
            'id'       => 'header_sticky',
            'type'     => 'switch',
            'title'    => __( 'Header Sticky', 'mundialdesalsa-pro' ),
            'default'  => $defaults['header_sticky'],
        ),
        array(
            'id'       => 'header_topbar',
            'type'     => 'switch',
            'title'    => __( 'Activar Topbar', 'mundialdesalsa-pro' ),
            'default'  => $defaults['header_topbar'],
        ),
        array(
            'id'       => 'header_breaking_news',
            'type'     => 'switch',
            'title'    => __( 'Breaking News en Header', 'mundialdesalsa-pro' ),
            'default'  => $defaults['header_breaking_news'],
        ),
    ),
) );

// --- HEADER DESKTOP ---
Redux::setSection( $opt_name, array(
    'title'  => __( 'Header Desktop', 'mundialdesalsa-pro' ),
    'id'     => 'header_desktop',
    'icon'   => 'el el-screen',
    'fields' => array(
        array(
            'id'       => 'header_layout',
            'type'     => 'image_select',
            'title'    => __( 'Layout Desktop', 'mundialdesalsa-pro' ),
            'options'  => array(
                'left'   => array( 'alt' => 'Logo Izquierda', 'img' => 'https://placehold.co/200x100/e74c3c/ffffff?text=Logo+Izquierda' ),
                'center' => array( 'alt' => 'Logo Centro', 'img' => 'https://placehold.co/200x100/e74c3c/ffffff?text=Logo+Centro' ),
                'split'  => array( 'alt' => 'Split Header', 'img' => 'https://placehold.co/200x100/e74c3c/ffffff?text=Split+Header' ),
            ),
            'default'  => $defaults['header_layout'],
        ),
        array(
            'id'       => 'header_height',
            'type'     => 'slider',
            'title'    => __( 'Altura del Header (px)', 'mundialdesalsa-pro' ),
            'min'      => 60,
            'max'      => 150,
            'step'     => 1,
            'default'  => $defaults['header_height'],
        ),
    ),
) );

// --- HEADER TABLET ---
Redux::setSection( $opt_name, array(
    'title'  => __( 'Header Tablet', 'mundialdesalsa-pro' ),
    'id'     => 'header_tablet',
    'icon'   => 'el el-tablet',
    'fields' => array(
        array(
            'id'       => 'header_tablet_sticky',
            'type'     => 'switch',
            'title'    => __( 'Sticky en Tablet', 'mundialdesalsa-pro' ),
            'default'  => true,
        ),
    ),
) );

// --- HEADER MOBILE ---
Redux::setSection( $opt_name, array(
    'title'  => __( 'Header Mobile', 'mundialdesalsa-pro' ),
    'id'     => 'header_mobile',
    'icon'   => 'el el-iphone-home',
    'fields' => array(
        array(
            'id'       => 'header_mobile_sticky',
            'type'     => 'switch',
            'title'    => __( 'Sticky en Mobile', 'mundialdesalsa-pro' ),
            'default'  => $defaults['header_mobile_sticky'],
        ),
    ),
) );

// --- NAVIGATION ---
Redux::setSection( $opt_name, array(
    'title'  => __( 'Navegación / Menú', 'mundialdesalsa-pro' ),
    'id'     => 'navigation_pro',
    'icon'   => 'el el-lines',
    'fields' => array(
        array(
            'id'      => 'nav_info',
            'type'    => 'info',
            'style'   => 'info',
            'title'   => __( 'Configuración de Menú', 'mundialdesalsa-pro' ),
            'desc'    => __( 'Asegúrate de que tus menús estén asignados en Apariencia > Menús.', 'mundialdesalsa-pro' ),
        ),
    ),
) );

// --- FOOTER BUILDER SETTINGS ---
Redux::setSection( $opt_name, array(
    'title'  => __( 'Footer Builder', 'mundialdesalsa-pro' ),
    'id'     => 'footer_builder',
    'icon'   => 'el el-website-alt',
    'fields' => array(
        array(
            'id'       => 'footer_layout',
            'type'     => 'button_set',
            'title'    => __( 'Layout del Footer', 'mundialdesalsa-pro' ),
            'options'  => array(
                'standard' => 'Standard',
                'minimal'  => 'Minimal',
            ),
            'default'  => $defaults['footer_layout'],
        ),
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
            'default'  => $defaults['footer_columns'],
        ),
        array(
            'id'       => 'footer_bg',
            'type'     => 'color',
            'title'    => __( 'Color de Fondo Footer', 'mundialdesalsa-pro' ),
            'default'  => $defaults['footer_bg'],
        ),
        array(
            'id'       => 'footer_credits',
            'type'     => 'text',
            'title'    => __( 'Créditos del Footer', 'mundialdesalsa-pro' ),
            'default'  => $defaults['footer_credits'],
        ),
    ),
) );

// --- ARTICLE / SINGLE POST ---
Redux::setSection( $opt_name, array(
    'title'  => __( 'Artículo / Single', 'mundialdesalsa-pro' ),
    'id'     => 'single_post_pro',
    'icon'   => 'el el-edit',
    'fields' => array(
        array(
            'id'       => 'single_featured_image',
            'type'     => 'switch',
            'title'    => __( 'Mostrar Imagen Destacada', 'mundialdesalsa-pro' ),
            'default'  => $defaults['single_featured_image'],
        ),
        array(
            'id'       => 'single_post_meta',
            'type'     => 'switch',
            'title'    => __( 'Mostrar Meta del Post', 'mundialdesalsa-pro' ),
            'default'  => $defaults['single_post_meta'],
        ),
        array(
            'id'       => 'single_author_box',
            'type'     => 'switch',
            'title'    => __( 'Caja de Autor', 'mundialdesalsa-pro' ),
            'default'  => $defaults['single_author_box'],
        ),
        array(
            'id'       => 'single_related_posts',
            'type'     => 'switch',
            'title'    => __( 'Posts Relacionados', 'mundialdesalsa-pro' ),
            'default'  => $defaults['single_related_posts'],
        ),
    ),
) );

// --- ARCHIVES ---
Redux::setSection( $opt_name, array(
    'title'  => __( 'Archivos / Categorías', 'mundialdesalsa-pro' ),
    'id'     => 'archives_pro',
    'icon'   => 'el el-folder-open',
    'fields' => array(
        array(
            'id'       => 'archive_layout',
            'type'     => 'image_select',
            'title'    => __( 'Layout de Archivos', 'mundialdesalsa-pro' ),
            'options'  => array(
                'grid' => array( 'alt' => 'Grid', 'img' => 'https://placehold.co/200x100/e74c3c/ffffff?text=Grid' ),
                'list' => array( 'alt' => 'List', 'img' => 'https://placehold.co/200x100/e74c3c/ffffff?text=List' ),
            ),
            'default'  => $defaults['archive_layout'],
        ),
    ),
) );

// --- BLOCKS / BUILDER DEFAULTS ---
Redux::setSection( $opt_name, array(
    'title'  => __( 'Bloques / Builder', 'mundialdesalsa-pro' ),
    'id'     => 'blocks_builder',
    'icon'   => 'el el-th-large',
    'fields' => array(
        array(
            'id'       => 'block_animation',
            'type'     => 'switch',
            'title'    => __( 'Animaciones en Bloques', 'mundialdesalsa-pro' ),
            'default'  => true,
        ),
    ),
) );

// --- VIDEO / GALLERY / RADIO ---
Redux::setSection( $opt_name, array(
    'title'  => __( 'Video / Galería / Radio', 'mundialdesalsa-pro' ),
    'id'     => 'media_pro',
    'icon'   => 'el el-play-circle',
    'fields' => array(
        array(
            'id'       => 'video_autoplay',
            'type'     => 'switch',
            'title'    => __( 'Autoplay Videos', 'mundialdesalsa-pro' ),
            'default'  => false,
        ),
    ),
) );

// --- ADS MANAGER ---
Redux::setSection( $opt_name, array(
    'title'  => __( 'Ads Manager', 'mundialdesalsa-pro' ),
    'id'     => 'ads_manager',
    'icon'   => 'el el-usd',
    'fields' => array(
        array(
            'id'       => 'ad_header',
            'type'     => 'textarea',
            'title'    => __( 'Anuncio en Header', 'mundialdesalsa-pro' ),
            'subtitle' => __( 'Pega aquí el código de tu anuncio.', 'mundialdesalsa-pro' ),
        ),
        array(
            'id'       => 'ad_article_top',
            'type'     => 'textarea',
            'title'    => __( 'Anuncio Inicio Artículo', 'mundialdesalsa-pro' ),
        ),
        array(
            'id'       => 'ad_article_bottom',
            'type'     => 'textarea',
            'title'    => __( 'Anuncio Final Artículo', 'mundialdesalsa-pro' ),
        ),
    ),
) );

// --- SOCIAL / CONTACT ---
Redux::setSection( $opt_name, array(
    'title'  => __( 'Social / Contacto', 'mundialdesalsa-pro' ),
    'id'     => 'social_contact',
    'icon'   => 'el el-address-book',
    'fields' => array(
        array(
            'id'      => 'social_facebook',
            'type'    => 'text',
            'title'   => __( 'Facebook URL', 'mundialdesalsa-pro' ),
            'default' => $defaults['social_facebook'],
        ),
        array(
            'id'      => 'social_twitter',
            'type'    => 'text',
            'title'   => __( 'Twitter / X URL', 'mundialdesalsa-pro' ),
            'default' => $defaults['social_twitter'],
        ),
    ),
) );

// --- PERFORMANCE ---
Redux::setSection( $opt_name, array(
    'title'  => __( 'Rendimiento', 'mundialdesalsa-pro' ),
    'id'     => 'performance_pro',
    'icon'   => 'el el-dashboard',
    'fields' => array(
        array(
            'id'      => 'enable_lazyload',
            'type'    => 'switch',
            'title'   => __( 'Activar Lazy Load', 'mundialdesalsa-pro' ),
            'default' => $defaults['enable_lazyload'],
        ),
        array(
            'id'      => 'enable_minify',
            'type'    => 'switch',
            'title'   => __( 'Minificar CSS/JS', 'mundialdesalsa-pro' ),
            'default' => $defaults['enable_minify'],
        ),
        array(
            'id'      => 'enable_preloader',
            'type'    => 'switch',
            'title'   => __( 'Activar Preloader', 'mundialdesalsa-pro' ),
            'default' => $defaults['enable_preloader'],
        ),
    ),
) );

// --- INTEGRATIONS / CUSTOM CODE ---
Redux::setSection( $opt_name, array(
    'title'  => __( 'Integraciones / Código', 'mundialdesalsa-pro' ),
    'id'     => 'integrations_custom',
    'icon'   => 'el el-cog',
    'fields' => array(
        array(
            'id'       => 'google_analytics',
            'type'     => 'textarea',
            'title'    => __( 'Google Analytics / GTM', 'mundialdesalsa-pro' ),
        ),
        array(
            'id'       => 'custom_css',
            'type'     => 'ace_editor',
            'title'    => __( 'CSS Personalizado', 'mundialdesalsa-pro' ),
            'mode'     => 'css',
            'theme'    => 'monokai',
        ),
        array(
            'id'       => 'custom_js',
            'type'     => 'ace_editor',
            'title'    => __( 'JS Personalizado', 'mundialdesalsa-pro' ),
            'mode'     => 'javascript',
            'theme'    => 'monokai',
        ),
    ),
) );

// --- MAINTENANCE MODE ---
Redux::setSection( $opt_name, array(
    'title'  => __( 'Modo Mantenimiento', 'mundialdesalsa-pro' ),
    'id'     => 'maintenance_mode_section',
    'icon'   => 'el el-wrench',
    'fields' => array(
        array(
            'id'       => 'maintenance_mode',
            'type'     => 'switch',
            'title'    => __( 'Activar Modo Mantenimiento', 'mundialdesalsa-pro' ),
            'subtitle' => __( 'Muestra una página de mantenimiento a los visitantes no logueados.', 'mundialdesalsa-pro' ),
            'default'  => false,
        ),
        array(
            'id'       => 'maintenance_title',
            'type'     => 'text',
            'title'    => __( 'Título de Mantenimiento', 'mundialdesalsa-pro' ),
            'default'  => __( 'Mantenimiento en curso', 'mundialdesalsa-pro' ),
            'required' => array( 'maintenance_mode', '=', true ),
        ),
        array(
            'id'       => 'maintenance_message',
            'type'     => 'textarea',
            'title'    => __( 'Mensaje de Mantenimiento', 'mundialdesalsa-pro' ),
            'default'  => __( 'Estamos trabajando para ofrecerte la mejor experiencia salsera. Volvemos pronto.', 'mundialdesalsa-pro' ),
            'required' => array( 'maintenance_mode', '=', true ),
        ),
    ),
) );

// --- IMPORT / EXPORT ---
Redux::setSection( $opt_name, array(
    'title' => __( 'Importar / Exportar', 'mundialdesalsa-pro' ),
    'id'    => 'import_export',
    'icon'  => 'el el-refresh',
    'fields' => array(
        array(
            'id'            => 'opt-import-export',
            'type'          => 'import_export',
            'title'         => 'Import Export',
            'subtitle'      => 'Save and restore your Redux options',
            'full_width'    => false,
        ),
    ),
) );

// --- PRESETS / SKINS ---
Redux::setSection( $opt_name, array(
    'title'  => __( 'Presets / Skins', 'mundialdesalsa-pro' ),
    'id'     => 'presets_skins',
    'icon'   => 'el el-magic',
    'fields' => array(
        array(
            'id'       => 'active_skin',
            'type'     => 'palette',
            'title'    => __( 'Seleccionar Skin', 'mundialdesalsa-pro' ),
            'options'  => array(
                'default' => array( '#e74c3c', '#2c3e50', '#334155', '#ffffff' ),
                'dark'    => array( '#10b981', '#0f172a', '#94a3b8', '#020617' ),
                'ocean'   => array( '#3b82f6', '#1e3a8a', '#64748b', '#f8fafc' ),
            ),
            'default'  => 'default',
        ),
    ),
) );
