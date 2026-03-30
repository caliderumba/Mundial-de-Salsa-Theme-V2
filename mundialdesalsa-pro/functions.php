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
	'inc/core/walkers.php',
	'inc/core/post-types.php',
	'inc/core/blocks.php',
	'inc/core/blocks-render.php',
	'inc/core/ajax-handlers.php',
	'inc/core/sidebars.php',
	'inc/core/images.php',
	'inc/core/videos.php',
	'inc/core/schema.php',
	'inc/core/social.php',
	'inc/core/breadcrumbs.php',
	'inc/core/editorial.php',
	'inc/core/custom-css.php',
    'inc/core/hooks.php',
	'inc/template-tags/single.php',
	'inc/admin/metaboxes.php',
	'inc/admin/metabox-config.php',
	'inc/admin/dashboard.php',
	'inc/admin/rest-api.php',
	'inc/builder/builder-init.php',
	'inc/modules/ads-system.php',
	'inc/modules/mega-menu.php',
	'inc/modules/traffic-engine.php',
	'inc/modules/layout-engine.php',
	'inc/widgets/trending-widget.php',
	'inc/performance/clean-up.php',
	'inc/integrations/pwa.php',
];

/**
 * Theme Options Layer (Must load before Redux)
 */
require_once __DIR__ . '/inc/theme-options/settings.php';
require_once __DIR__ . '/inc/theme-options/fields.php';
require_once __DIR__ . '/inc/theme-options/helpers.php';
require_once __DIR__ . '/inc/theme-options/admin-panel.php';

/**
 * Redux Framework Configuration
 */
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
 * Initialize Theme Options
 * 
 * Ensures the options array exists in the database with correct defaults.
 */
function mds_pro_init() {
    // Only run if options are not set
    if ( ! get_option( 'mds_pro_options' ) ) {
        $defaults = mds_pro_get_option_defaults();
        $default_options_file = __DIR__ . '/inc/theme-options/default-options.json';
        
        if ( file_exists( $default_options_file ) ) {
            $json_data = json_decode( file_get_contents( $default_options_file ), true );
            
            if ( is_array( $json_data ) ) {
                // Flatten the nested JSON structure to match Redux/Theme keys
                $flattened = array();
                foreach ( $json_data as $section => $fields ) {
                    if ( is_array( $fields ) ) {
                        foreach ( $fields as $key => $value ) {
                            // If the key exists in our flat defaults, use the JSON value
                            $flattened[$key] = $value;
                        }
                    }
                }
                $defaults = wp_parse_args( $flattened, $defaults );
            }
        }
        
        update_option( 'mds_pro_options', $defaults );
    }
}
add_action( 'after_setup_theme', 'mds_pro_init' );
