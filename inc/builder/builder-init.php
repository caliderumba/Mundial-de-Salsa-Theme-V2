<?php
/**
 * Homepage Builder Logic
 */

function mds_pro_get_homepage_blocks() {
    $blocks = get_option( 'mundialdesalsa_homepage_blocks', [] );
    if ( empty( $blocks ) ) {
        // Default V2 blocks
        return [
            [ 'type' => 'featured-grid', 'limit' => 5 ],
            [ 'type' => 'trending', 'limit' => 5 ],
            [ 'type' => 'category-grid', 'category' => 0, 'limit' => 4 ],
            [ 'type' => 'video-block', 'limit' => 3 ],
            [ 'type' => 'editors-picks', 'limit' => 4 ],
            [ 'type' => 'newsletter-block' ],
        ];
    }
    return $blocks;
}

function mds_pro_render_homepage() {
    $blocks = mds_pro_get_homepage_blocks();
    foreach ( $blocks as $block ) {
        set_query_var( 'block_data', $block );
        get_template_part( 'template-parts/blocks/' . $block['type'] );
    }
}
