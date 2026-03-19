<?php
/**
 * Layout Engine: Dynamic Layout Switcher
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Basic layout switching logic
function mds_pro_get_layout( $type = 'post' ) {
    $section = 'layout';
    $key = $type;
    
    if ( $type === 'category' || $type === 'archive' ) {
        $key = 'archive';
    } elseif ( $type === 'homepage' ) {
        $key = 'homepage';
    } elseif ( $type === 'post' || $type === 'single' ) {
        $key = 'single';
    }
    
    $default = 'classic';
    if ( $key === 'archive' ) $default = 'grid';
    if ( $key === 'homepage' ) $default = 'magazine';
    
    return mds_pro_get_option( $section, $key, $default );
}
