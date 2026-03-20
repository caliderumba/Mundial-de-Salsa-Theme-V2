<?php
/**
 * Enqueue scripts and styles.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function mds_pro_scripts() {
	// Main Stylesheet
    $style_url = get_stylesheet_uri();
    if ( mds_pro_get_option( 'performance', 'minify_css', false ) && file_exists( MDS_PRO_DIR . '/style.min.css' ) ) {
        $style_url = MDS_PRO_URI . '/style.min.css';
    }
	wp_enqueue_style( 'mds-pro-style', $style_url, [], MDS_PRO_VERSION );

	// Main JS
	wp_enqueue_script( 'mds-pro-app', MDS_PRO_URI . '/assets/js/app.js', [ 'jquery' ], MDS_PRO_VERSION, false );

    // Theater Mode for Video Hero
    if ( is_single() ) {
        wp_enqueue_script( 'mds-pro-theater-mode', MDS_PRO_URI . '/assets/js/blocks/theater-mode.js', [], MDS_PRO_VERSION, true );
    }

	// Threaded comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

    // Localize for AJAX
    global $wp_query;
    wp_localize_script( 'mds-pro-app', 'mds_pro_vars', [
        'ajax_url'      => admin_url( 'admin-ajax.php' ),
        'nonce'         => wp_create_nonce( 'mds_pro_nonce' ),
        'current_query' => json_encode( $wp_query->query_vars ),
    ]);
}
add_action( 'wp_enqueue_scripts', 'mds_pro_scripts' );
