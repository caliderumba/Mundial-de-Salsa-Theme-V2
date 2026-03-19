<?php
/**
 * Register Custom Gutenberg Blocks
 */

function mds_pro_register_blocks() {
    if ( ! function_exists( 'register_block_type' ) ) {
        return;
    }

    // Register a simple block for Event Info
    wp_register_script(
        'mds-pro-event-block',
        get_template_directory_uri() . '/assets/js/blocks/event-block.js',
        array( 'wp-blocks', 'wp-element', 'wp-editor' )
    );

    register_block_type( 'mds-pro/event-info', array(
        'editor_script' => 'mds-pro-event-block',
    ) );
}
add_action( 'init', 'mds_pro_register_blocks' );
