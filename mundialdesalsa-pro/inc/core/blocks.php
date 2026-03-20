<?php
/**
 * Register Custom Gutenberg Blocks
 */

require_once MDS_PRO_DIR . '/inc/core/blocks-render.php';

function mds_pro_register_blocks() {
    if ( ! function_exists( 'register_block_type' ) ) {
        return;
    }

    // Register editor script for all blocks
    wp_register_script(
        'mds-pro-blocks-editor',
        get_template_directory_uri() . '/assets/js/blocks/editor.js',
        array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components' )
    );

    // Post Grid Block
    register_block_type( 'mds-pro/post-grid', array(
        'editor_script'   => 'mds-pro-blocks-editor',
        'render_callback' => 'mds_pro_render_post_grid',
        'attributes'      => array(
            'postsPerPage' => array( 'type' => 'number', 'default' => 3 ),
            'columns'      => array( 'type' => 'number', 'default' => 3 ),
            'category'     => array( 'type' => 'string', 'default' => '' ),
            'layout'       => array( 'type' => 'string', 'default' => 'grid' ),
            'imagePos'     => array( 'type' => 'string', 'default' => 'top' ),
            'showExcerpt'  => array( 'type' => 'boolean', 'default' => true ),
            'showDate'     => array( 'type' => 'boolean', 'default' => true ),
            'showAuthor'   => array( 'type' => 'boolean', 'default' => false ),
        ),
    ) );

    // Advanced Heading Block
    register_block_type( 'mds-pro/advanced-heading', array(
        'editor_script'   => 'mds-pro-blocks-editor',
        'render_callback' => 'mds_pro_render_advanced_heading',
        'attributes'      => array(
            'content' => array( 'type' => 'string', 'source' => 'html', 'selector' => 'h1,h2,h3,h4,h5,h6' ),
            'tag'     => array( 'type' => 'string', 'default' => 'h2' ),
            'align'   => array( 'type' => 'string', 'default' => 'left' ),
            'color'   => array( 'type' => 'string', 'default' => 'text-slate-900 dark:text-white' ),
            'italic'  => array( 'type' => 'boolean', 'default' => true ),
        ),
    ) );

    // Container Block
    register_block_type( 'mds-pro/container', array(
        'editor_script'   => 'mds-pro-blocks-editor',
        'render_callback' => 'mds_pro_render_container',
        'attributes'      => array(
            'bgColor'  => array( 'type' => 'string', 'default' => 'transparent' ),
            'padding'  => array( 'type' => 'string', 'default' => 'py-12' ),
            'maxWidth' => array( 'type' => 'string', 'default' => 'max-w-7xl' ),
        ),
    ) );

    // MDS Bento Grid
    register_block_type( 'mds-pro/bento-grid', array(
        'editor_script'   => 'mds-pro-blocks-editor',
        'render_callback' => 'mds_pro_render_bento_grid',
        'attributes'      => array(
            'category' => array( 'type' => 'string', 'default' => '' ),
            'count'    => array( 'type' => 'number', 'default' => 3 ),
        ),
    ) );

    // MDS Smart List
    register_block_type( 'mds-pro/smart-list', array(
        'editor_script'   => 'mds-pro-blocks-editor',
        'render_callback' => 'mds_pro_render_smart_list',
        'attributes'      => array(
            'category' => array( 'type' => 'string', 'default' => '' ),
            'count'    => array( 'type' => 'number', 'default' => 5 ),
        ),
    ) );

    // MDS Editorial Highlights
    register_block_type( 'mds-pro/editorial-highlights', array(
        'editor_script'   => 'mds-pro-blocks-editor',
        'render_callback' => 'mds_pro_render_editorial_highlights',
    ) );

    // MDS Video Hero
    register_block_type( 'mds-pro/video-hero', array(
        'editor_script'   => 'mds-pro-blocks-editor',
        'render_callback' => 'mds_pro_render_video_hero',
    ) );

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
