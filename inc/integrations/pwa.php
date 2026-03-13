<?php
/**
 * PWA Integration Module
 */

function mds_pro_pwa_init() {
    if ( get_option( 'mds_pwa_enabled', 'enabled' ) !== 'enabled' ) return;

    add_action( 'wp_head', 'mds_pro_pwa_manifest_link' );
    add_action( 'wp_footer', 'mds_pro_pwa_service_worker_script' );
}
add_action( 'init', 'mds_pro_pwa_init' );

function mds_pro_pwa_manifest_link() {
    echo '<link rel="manifest" href="' . get_template_directory_uri() . '/manifest.json">';
    echo '<meta name="theme-color" content="' . get_option( 'mds_primary_color', '#e11d48' ) . '">';
}

function mds_pro_pwa_service_worker_script() {
    ?>
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('<?php echo get_template_directory_uri(); ?>/service-worker.js')
                    .then(reg => console.log('Service Worker registered'))
                    .catch(err => console.log('Service Worker registration failed', err));
            });
        }
    </script>
    <?php
}
