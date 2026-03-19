<?php
/**
 * REST API Endpoints for Theme Options
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'rest_api_init', function () {
    register_rest_route( 'mds-pro/v1', '/options', array(
        'methods' => 'GET',
        'callback' => function() {
            return mds_pro_get_all_options();
        },
        'permission_callback' => function () {
            return current_user_can( 'edit_theme_options' );
        }
    ) );
} );
