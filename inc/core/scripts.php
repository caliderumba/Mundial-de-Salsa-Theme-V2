<?php
/**
 * Enqueue scripts and styles.
 */

function mds_pro_scripts() {
	// Main Stylesheet
	wp_enqueue_style( 'mds-pro-style', get_stylesheet_uri(), [], MDS_PRO_VERSION );
    
    // Google Fonts
    wp_enqueue_style( 'mds-pro-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Playfair+Display:ital,wght@0,700;1,700&display=swap', [], null );

	// Main JS
	wp_enqueue_script( 'mds-pro-main', MDS_PRO_URI . '/assets/js/main.js', [ 'jquery' ], MDS_PRO_VERSION, true );

	// Threaded comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

    // Localize for AJAX
    global $wp_query;
    wp_localize_script( 'mds-pro-main', 'mds_pro_vars', [
        'ajax_url'      => admin_url( 'admin-ajax.php' ),
        'nonce'         => wp_create_nonce( 'mds_pro_nonce' ),
        'current_query' => json_encode( $wp_query->query_vars ),
    ]);
}
add_action( 'wp_enqueue_scripts', 'mds_pro_scripts' );
