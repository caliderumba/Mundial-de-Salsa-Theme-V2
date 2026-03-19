<?php
/**
 * Theme Option Fields
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Robust options retrieval
function mds_pro_get_option( $section, $key, $default = '' ) {
    global $mds_pro_options;

    // Check Redux global first
    if ( isset( $mds_pro_options[$key] ) ) {
        $val = $mds_pro_options[$key];
        // Handle Redux typography field which returns an array
        if ( is_array( $val ) && isset( $val['font-family'] ) ) {
            return $val['font-family'];
        }
        return $val;
    }

    $options = get_option( 'mds_pro_options', [] );
    
    // Check if it's in the unified options array
    if ( isset( $options[$key] ) ) {
        $val = $options[$key];
        if ( is_array( $val ) && isset( $val['font-family'] ) ) {
            return $val['font-family'];
        }
        return $val;
    }

    // Legacy or individual check
    if ( isset( $options[$section][$key] ) ) {
        return $options[$section][$key];
    }
    
    // Fallback to individual options (for backward compatibility or direct settings)
    $individual_key = 'mds_' . $key;
    $individual_option = get_option( $individual_key );
    if ( $individual_option !== false ) {
        return $individual_option;
    }

    return $default;
}
