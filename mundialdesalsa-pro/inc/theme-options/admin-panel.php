<?php
/**
 * Admin Panel Logic
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Basic admin panel logic
function mds_pro_admin_menu() {
    // Add theme options page if not using Redux
}
add_action( 'admin_menu', 'mds_pro_admin_menu' );
