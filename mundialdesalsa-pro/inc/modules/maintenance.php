<?php
/**
 * Maintenance Mode Module - Mundial de Salsa Pro
 * 
 * Displays a maintenance page if enabled in theme options.
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handle Maintenance Mode Redirect
 */
function mds_pro_maintenance_mode() {
    $enabled = mds_pro_get_option( 'maintenance_mode', false );
    
    if ( ! $enabled ) {
        return;
    }

    // Allow admins to see the site
    if ( current_user_can( 'manage_options' ) || is_login() ) {
        return;
    }

    $title   = mds_pro_get_option( 'maintenance_title', __( 'Mantenimiento en curso', 'mundialdesalsa-pro' ) );
    $message = mds_pro_get_option( 'maintenance_message', __( 'Estamos trabajando para ofrecerte la mejor experiencia salsera. Volvemos pronto.', 'mundialdesalsa-pro' ) );
    $logo    = mds_pro_get_option( 'site_logo', [] );
    $logo_url = isset( $logo['url'] ) ? $logo['url'] : '';

    // Set 503 Service Unavailable header
    status_header( 503 );
    header( 'Retry-After: 3600' );

    ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo esc_html( $title ); ?></title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;900&display=swap');
            body { font-family: 'Inter', sans-serif; }
            .brutalist-card {
                box-shadow: 12px 12px 0px 0px #10b981;
                border: 4px solid #000;
            }
        </style>
    </head>
    <body class="bg-slate-50 flex items-center justify-center min-h-screen p-6">
        <div class="max-w-2xl w-full bg-white p-12 brutalist-card text-center">
            <?php if ( $logo_url ) : ?>
                <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="mx-auto mb-12 max-h-24">
            <?php else : ?>
                <h2 class="text-4xl font-black uppercase italic tracking-tighter mb-12"><?php bloginfo( 'name' ); ?></h2>
            <?php endif; ?>

            <h1 class="text-5xl md:text-7xl font-black uppercase italic tracking-tighter leading-none mb-8 text-slate-900">
                <?php echo esc_html( $title ); ?>
            </h1>
            
            <p class="text-xl text-slate-600 mb-12 leading-relaxed">
                <?php echo wp_kses_post( $message ); ?>
            </p>

            <div class="flex justify-center gap-6">
                <div class="animate-bounce">
                    <i class="fas fa-compact-disc text-emerald-500 text-4xl"></i>
                </div>
            </div>

            <div class="mt-16 pt-8 border-t-2 border-slate-100 text-[10px] font-black uppercase tracking-widest text-slate-400">
                &copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit;
}
add_action( 'template_redirect', 'mds_pro_maintenance_mode' );

/**
 * Helper to check if we are on the login page
 */
function is_login() {
    return in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) );
}
