<?php
/**
 * Security & Sanitization
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Basic security headers
function mds_pro_security_headers() {
    if ( ! is_admin() ) {
        header( 'X-Content-Type-Options: nosniff' );
        header( 'X-Frame-Options: SAMEORIGIN' );
        header( 'X-XSS-Protection: 1; mode=block' );
        header( 'Referrer-Policy: strict-origin-when-cross-origin' );
    }
}
add_action( 'send_headers', 'mds_pro_security_headers' );

/**
 * Hardening: Disable XML-RPC for security if not needed.
 */
add_filter( 'xmlrpc_enabled', '__return_false' );

/**
 * Hardening: Remove WordPress version from head and feeds.
 */
function mds_pro_remove_wp_version() {
    return '';
}
add_filter( 'the_generator', 'mds_pro_remove_wp_version' );

/**
 * Hardening: Disable REST API for non-authenticated users (optional/configurable).
 * Only if the theme doesn't rely on it for public features.
 * Note: We use it for search/load more, so we keep it enabled but could restrict.
 */

/**
 * Sanitization: Ensure all theme options are sanitized on save.
 * (Redux handles this mostly, but we can add extra layers).
 */
