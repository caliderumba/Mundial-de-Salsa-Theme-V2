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

    // Font Awesome
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', [], '6.4.0' );

	// Main JS
	wp_enqueue_script( 'mds-pro-app', MDS_PRO_URI . '/assets/js/app.js', [ 'jquery' ], MDS_PRO_VERSION, false );

    // Theater Mode for Video Hero
    if ( is_single() ) {
        wp_enqueue_script( 'mds-pro-theater-mode', MDS_PRO_URI . '/assets/js/blocks/theater-mode.js', [], MDS_PRO_VERSION, true );
    }

    // Live Updates Script
    if ( is_page_template( 'template-live-coverage.php' ) || has_block( 'mds-pro/live-updates' ) ) {
        wp_enqueue_script( 'mds-pro-live-updates', MDS_PRO_URI . '/assets/js/live-updates.js', array( 'jquery' ), MDS_PRO_VERSION, true );
        wp_localize_script( 'mds-pro-live-updates', 'mdsLive', array(
            'ajaxUrl' => admin_url( 'admin-ajax.php' ),
            'nonce'   => wp_create_nonce( 'mds_live_nonce' ),
            'postId'  => get_the_ID(),
        ) );
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

/**
 * Performance: Resource Hints for external assets.
 */
function mds_pro_resource_hints( $urls, $relation_type ) {
    if ( 'preconnect' === $relation_type ) {
        $urls[] = 'https://fonts.googleapis.com';
        $urls[] = 'https://fonts.gstatic.com';
        $urls[] = 'https://cdnjs.cloudflare.com';
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'mds_pro_resource_hints', 10, 2 );

/**
 * Performance: Add defer attribute to non-critical scripts.
 */
function mds_pro_defer_scripts( $tag, $handle, $src ) {
    $defer_scripts = [
        'mds-pro-app',
        'mds-pro-theater-mode',
        'mds-pro-live-updates',
        'comment-reply'
    ];

    if ( in_array( $handle, $defer_scripts ) ) {
        return str_replace( ' src', ' defer src', $tag );
    }

    return $tag;
}
add_filter( 'script_loader_tag', 'mds_pro_defer_scripts', 10, 3 );
