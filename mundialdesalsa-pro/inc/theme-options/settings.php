<?php
/**
 * Theme Settings
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Basic settings logic
function mds_pro_get_all_options() {
    return get_option( 'mds_pro_options', array() );
}
