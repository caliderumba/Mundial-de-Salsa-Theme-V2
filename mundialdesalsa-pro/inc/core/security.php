<?php
/**
 * Security & Sanitization
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Basic security headers
function mds_pro_security_headers() {
    header( 'X-Content-Type-Options: nosniff' );
    header( 'X-Frame-Options: SAMEORIGIN' );
    header( 'X-XSS-Protection: 1; mode=block' );
}
add_action( 'send_headers', 'mds_pro_security_headers' );
