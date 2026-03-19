<?php
/**
 * Admin REST API Endpoints
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Basic admin REST API logic
function mds_pro_admin_rest_init() {
    // Add admin-specific REST endpoints here
}
add_action( 'rest_api_init', 'mds_pro_admin_rest_init' );
