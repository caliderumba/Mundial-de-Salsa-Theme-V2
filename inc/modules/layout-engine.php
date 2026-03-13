<?php
/**
 * Layout Engine: Dynamic Template Selection
 */

/**
 * Get the selected layout for different contexts
 */
function mds_pro_get_layout( $context = 'archive' ) {
    $option_key = 'mds_' . $context . '_layout';
    $default = ( $context === 'single' ) ? 'layout-1' : 'grid';
    
    return get_option( $option_key, $default );
}

/**
 * Filter the single template if a custom layout is selected in metabox
 */
function mds_pro_custom_single_layout( $template ) {
    if ( is_singular( 'post' ) ) {
        $custom_layout = get_post_meta( get_the_ID(), '_mds_custom_layout', true );
        if ( ! empty( $custom_layout ) && $custom_layout !== 'default' ) {
            // Logic to load specific layout part
        }
    }
    return $template;
}
add_filter( 'template_include', 'mds_pro_custom_single_layout' );
