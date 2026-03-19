<?php
/**
 * MundialdeSalsa Magazine Pro functions and definitions
 *
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Define Constants
 */
define( 'MDS_PRO_VERSION', '1.0.0' );
define( 'MDS_PRO_DIR', get_template_directory() );
define( 'MDS_PRO_URI', get_template_directory_uri() );

/**
 * Core Engine Loader
 */
$mds_includes = [
	'inc/core/setup.php',
	'inc/core/scripts.php',
	'inc/core/helpers.php',
	'inc/core/sidebars.php',
	'inc/core/custom-css.php',
	'inc/theme-options/admin-panel.php',
	'inc/theme-options/settings.php',
	'inc/theme-options/fields.php',
	'inc/admin/metaboxes.php',
	'inc/admin/dashboard.php',
	'inc/admin/rest-api.php',
	'inc/builder/builder-init.php',
	'inc/modules/ads-system.php',
	'inc/modules/mega-menu.php',
	'inc/modules/editorial-engine.php', // New: Trending & Views
	'inc/modules/traffic-engine.php',   // New: Infinite Scroll & Next Post
	'inc/modules/layout-engine.php',    // New: Dynamic Layout Switcher
	'inc/performance/clean-up.php',
	'inc/integrations/schema.php',
	'inc/integrations/pwa.php',
];

require __DIR__ . '/inc/redux-config.php';

foreach ( $mds_includes as $file ) {
	$filepath = __DIR__ . '/' . $file;
	if ( file_exists( $filepath ) ) {
		require_once $filepath;
	}
}

require __DIR__ . '/inc/core/security.php';
require __DIR__ . '/inc/theme-options/rest-api.php';

/**
 * Initialize Theme
 */
function mds_pro_init() {
    if ( ! get_option( 'mds_pro_options' ) ) {
        $default_options_file = __DIR__ . '/inc/theme-options/default-options.json';
        if ( file_exists( $default_options_file ) ) {
            $default_options = json_decode( file_get_contents( $default_options_file ), true );
            update_option( 'mds_pro_options', $default_options );
        }
    }
}
add_action( 'after_setup_theme', 'mds_pro_init' );
