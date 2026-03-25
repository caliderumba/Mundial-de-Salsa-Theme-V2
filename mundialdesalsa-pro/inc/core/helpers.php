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
 * Safely get theme option
 * 
 * @param string $section Section key.
 * @param string $key Option key.
 * @param mixed $default Default value.
 * @return mixed Option value.
 */
function mds_pro_get_option( $section, $key, $default = '' ) {
    $options = get_option( 'mds_pro_options' );
    if ( isset( $options[$section][$key] ) ) {
        return $options[$section][$key];
    }
    return $default;
}
