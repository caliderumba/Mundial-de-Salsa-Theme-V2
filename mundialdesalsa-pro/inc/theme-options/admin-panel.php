<?php
/**
 * Theme Dashboard & Admin Panel Logic
 * 
 * Provides a professional landing page for theme administrators.
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Theme Dashboard Menu
 */
function mds_pro_admin_menu() {
    add_menu_page(
        __( 'MDS Pro Dashboard', 'mundialdesalsa-pro' ),
        __( 'MDS Pro', 'mundialdesalsa-pro' ),
        'manage_options',
        'mds_pro_dashboard',
        'mds_pro_render_dashboard',
        'dashicons-performance',
        2
    );
    
    add_submenu_page(
        'mds_pro_dashboard',
        __( 'Dashboard', 'mundialdesalsa-pro' ),
        __( 'Dashboard', 'mundialdesalsa-pro' ),
        'manage_options',
        'mds_pro_dashboard',
        'mds_pro_render_dashboard'
    );
    
    // Add link to Redux Options as a submenu only if Redux is NOT active
    // If Redux is active, it will register itself as a submenu of mds_pro_dashboard
    if ( ! class_exists( 'Redux' ) ) {
        add_submenu_page(
            'mds_pro_dashboard',
            __( 'Opciones del Theme', 'mundialdesalsa-pro' ),
            __( 'Opciones del Theme', 'mundialdesalsa-pro' ),
            'manage_options',
            'mds_pro_options_panel',
            'mds_pro_render_no_redux'
        );
    }
}
add_action( 'admin_menu', 'mds_pro_admin_menu', 5 );

/**
 * Render message when Redux is missing
 */
function mds_pro_render_no_redux() {
    ?>
    <div class="wrap">
        <h1><?php _e( 'Redux Framework Requerido', 'mundialdesalsa-pro' ); ?></h1>
        <div class="notice notice-error">
            <p><?php _e( 'El plugin <strong>Redux Framework</strong> es necesario para configurar las opciones del theme. Por favor, instálalo y actívalo.', 'mundialdesalsa-pro' ); ?></p>
        </div>
    </div>
    <?php
}

/**
 * Render Theme Dashboard
 */
function mds_pro_render_dashboard() {
    $theme = wp_get_theme();
    ?>
    <div class="wrap mds-pro-dashboard">
        <div class="mds-dashboard-header" style="background: #1e1e1e; color: #fff; padding: 40px; border-radius: 8px; margin-top: 20px; display: flex; align-items: center; justify-content: space-between;">
            <div>
                <h1 style="color: #fff; margin: 0; font-size: 32px; font-weight: 800;"><?php echo esc_html( $theme->get( 'Name' ) ); ?> <span style="font-size: 14px; font-weight: 400; opacity: 0.7;">v<?php echo esc_html( $theme->get( 'Version' ) ); ?></span></h1>
                <p style="margin: 10px 0 0; font-size: 16px; opacity: 0.8;"><?php _e( 'Bienvenido al centro de control de tu theme premium.', 'mundialdesalsa-pro' ); ?></p>
            </div>
            <div class="mds-dashboard-actions">
                <a href="<?php echo admin_url( 'admin.php?page=mds_pro_options_panel' ); ?>" class="button button-primary button-hero"><?php _e( 'Configurar Theme', 'mundialdesalsa-pro' ); ?></a>
            </div>
        </div>

        <div class="mds-dashboard-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-top: 30px;">
            
            <!-- System Status -->
            <div class="mds-card" style="background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                <h3 style="margin-top: 0; border-bottom: 1px solid #eee; padding-bottom: 15px; display: flex; align-items: center;">
                    <span class="dashicons dashicons-info" style="margin-right: 10px;"></span>
                    <?php _e( 'Estado del Sistema', 'mundialdesalsa-pro' ); ?>
                </h3>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="padding: 8px 0; border-bottom: 1px solid #f9f9f9; display: flex; justify-content: space-between;">
                        <span><?php _e( 'Versión de PHP', 'mundialdesalsa-pro' ); ?></span>
                        <span class="status-tag <?php echo version_compare( PHP_VERSION, '7.4', '>=' ) ? 'text-success' : 'text-warning'; ?>" style="font-weight: 600;"><?php echo PHP_VERSION; ?></span>
                    </li>
                    <li style="padding: 8px 0; border-bottom: 1px solid #f9f9f9; display: flex; justify-content: space-between;">
                        <span><?php _e( 'Versión de WordPress', 'mundialdesalsa-pro' ); ?></span>
                        <span style="font-weight: 600;"><?php bloginfo( 'version' ); ?></span>
                    </li>
                    <li style="padding: 8px 0; border-bottom: 1px solid #f9f9f9; display: flex; justify-content: space-between;">
                        <span><?php _e( 'Redux Framework', 'mundialdesalsa-pro' ); ?></span>
                        <span class="status-tag <?php echo class_exists( 'Redux' ) ? 'text-success' : 'text-danger'; ?>" style="font-weight: 600;">
                            <?php echo class_exists( 'Redux' ) ? __( 'Activo', 'mundialdesalsa-pro' ) : __( 'No detectado', 'mundialdesalsa-pro' ); ?>
                        </span>
                    </li>
                </ul>
            </div>

            <!-- Quick Links -->
            <div class="mds-card" style="background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                <h3 style="margin-top: 0; border-bottom: 1px solid #eee; padding-bottom: 15px; display: flex; align-items: center;">
                    <span class="dashicons dashicons-external" style="margin-right: 10px;"></span>
                    <?php _e( 'Accesos Rápidos', 'mundialdesalsa-pro' ); ?>
                </h3>
                <div class="mds-links-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                    <a href="<?php echo admin_url( 'nav-menus.php' ); ?>" class="button" style="text-align: center;"><?php _e( 'Menús', 'mundialdesalsa-pro' ); ?></a>
                    <a href="<?php echo admin_url( 'widgets.php' ); ?>" class="button" style="text-align: center;"><?php _e( 'Widgets', 'mundialdesalsa-pro' ); ?></a>
                    <a href="<?php echo admin_url( 'customize.php' ); ?>" class="button" style="text-align: center;"><?php _e( 'Personalizar', 'mundialdesalsa-pro' ); ?></a>
                    <a href="<?php echo admin_url( 'edit.php?post_type=page' ); ?>" class="button" style="text-align: center;"><?php _e( 'Páginas', 'mundialdesalsa-pro' ); ?></a>
                </div>
            </div>

            <!-- Support & Docs -->
            <div class="mds-card" style="background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                <h3 style="margin-top: 0; border-bottom: 1px solid #eee; padding-bottom: 15px; display: flex; align-items: center;">
                    <span class="dashicons dashicons-sos" style="margin-right: 10px;"></span>
                    <?php _e( 'Soporte y Ayuda', 'mundialdesalsa-pro' ); ?>
                </h3>
                <p><?php _e( '¿Necesitas ayuda con la configuración? Consulta nuestra documentación técnica o contacta con el equipo de desarrollo.', 'mundialdesalsa-pro' ); ?></p>
                <div style="margin-top: 15px;">
                    <a href="#" class="button button-secondary"><?php _e( 'Documentación', 'mundialdesalsa-pro' ); ?></a>
                    <a href="#" class="button button-secondary"><?php _e( 'Soporte Técnico', 'mundialdesalsa-pro' ); ?></a>
                </div>
            </div>

        </div>
    </div>
    <style>
        .mds-pro-dashboard .text-success { color: #27ae60; }
        .mds-pro-dashboard .text-warning { color: #f39c12; }
        .mds-pro-dashboard .text-danger { color: #e74c3c; }
        .mds-pro-dashboard .button-hero { padding: 12px 30px !important; height: auto !important; font-size: 18px !important; }
    </style>
    <?php
}
