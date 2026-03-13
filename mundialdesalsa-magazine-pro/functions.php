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
	'inc/core/theme-support.php',
	'inc/core/scripts.php',
	'inc/core/helpers.php',
	'inc/core/menus.php',
	'inc/core/sidebars.php',
	'inc/admin/theme-options.php',
	'inc/admin/metaboxes.php',
	'inc/admin/widgets.php',
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

foreach ( $mds_includes as $file ) {
	$filepath = __DIR__ . '/' . $file;
	if ( file_exists( $filepath ) ) {
		require_once $filepath;
	}
}

/**
 * Initialize Theme
 */
function mds_pro_init() {
    // Initialization logic if needed
}
add_action( 'after_setup_theme', 'mds_pro_init' );
