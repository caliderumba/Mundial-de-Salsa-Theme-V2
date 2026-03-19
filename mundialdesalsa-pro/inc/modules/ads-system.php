<?php
/**
 * Ads System
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Basic ads system logic
function mds_pro_get_ad( $location ) {
    return mds_pro_get_option( 'ads', $location . '_ad_code', '' );
}
