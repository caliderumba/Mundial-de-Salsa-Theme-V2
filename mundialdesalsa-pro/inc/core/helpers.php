<?php
/**
 * MundialdeSalsa Pro Generic Helpers
 * 
 * This file contains generic utility functions that don't fit into specific domains.
 * Domain-specific logic has been moved to:
 * - inc/core/ajax-handlers.php
 * - inc/core/social.php
 * - inc/core/editorial.php
 * - inc/core/images.php
 * - inc/core/videos.php
 * - inc/admin/metaboxes.php
 * - inc/modules/traffic-engine.php
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Note: mds_pro_get_option() has been moved to inc/theme-options/settings.php
 * to provide a unified entry point for modern and legacy calls.
 */

/**
 * Get current URL
 */
function mds_get_current_url() {
    global $wp;
    return home_url( add_query_arg( array(), $wp->request ) );
}
