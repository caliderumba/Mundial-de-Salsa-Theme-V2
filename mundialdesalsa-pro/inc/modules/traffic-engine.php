<?php
/**
 * Traffic Engine: Infinite Scroll & Next Post
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Basic infinite scroll logic
function mds_pro_infinite_scroll() {
    if ( is_singular() || is_paged() ) {
        return;
    }
    // Add scripts for infinite scroll here
}
add_action( 'wp_enqueue_scripts', 'mds_pro_infinite_scroll' );
