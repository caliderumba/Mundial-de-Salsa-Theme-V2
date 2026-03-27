<?php
/**
 * Theme Settings Engine
 * 
 * Centralized logic for reading and normalizing theme options.
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Ensure defaults and legacy map are loaded
require_once __DIR__ . '/defaults.php';
require_once __DIR__ . '/legacy-map.php';

/**
 * Get all theme options merged with defaults
 * 
 * @return array
 */
function mds_pro_get_all_options() {
    static $merged_options = null;
    
    if ( null !== $merged_options ) {
        return $merged_options;
    }
    
    global $mds_pro_options;
    
    // Try Redux global first
    $saved_options = ( isset( $mds_pro_options ) && is_array( $mds_pro_options ) && ! empty( $mds_pro_options ) ) ? $mds_pro_options : get_option( 'mds_pro_options', array() );
    
    // Ensure $saved_options is an array
    if ( ! is_array( $saved_options ) ) {
        $saved_options = array();
    }
    $defaults      = mds_pro_get_option_defaults();
    
    // Merge defaults with saved options
    $merged_options = wp_parse_args( $saved_options, $defaults );
    
    return apply_filters( 'mds_pro_all_options', $merged_options );
}

/**
 * Unified Theme Option Retrieval Function
 * 
 * The ONLY public entry point for theme options.
 * Handles:
 * 1. Modern: mds_pro_get_option( 'key', 'default' )
 * 2. Legacy Section: mds_pro_get_option( 'section', 'key', 'default' )
 * 3. Legacy Key: mds_pro_get_option( 'old_key', 'default' )
 * 
 * @param string $arg1 Key or Legacy Section.
 * @param mixed  $arg2 Default value or Legacy Key.
 * @param mixed  $arg3 Default value (only for legacy section calls).
 * @return mixed
 */
function mds_pro_get_option( $arg1, $arg2 = null, $arg3 = null ) {
    $num_args = func_num_args();
    $map      = mds_pro_get_legacy_option_map();
    $defaults = mds_pro_get_option_defaults();

    $target_key    = $arg1;
    $final_default = $arg2;

    // 1. Handle Legacy Section + Key + Default (3 args)
    // Example: mds_pro_get_option( 'layout', 'sidebar_position', 'right' )
    if ( $num_args === 3 ) {
        if ( isset( $map[$arg1] ) && is_array( $map[$arg1] ) && isset( $map[$arg1][$arg2] ) ) {
            $target_key = $map[$arg1][$arg2];
        }
        $final_default = $arg3;
    }
    // 2. Handle Legacy Key + Default (2 args) OR Modern Call
    // Example Legacy: mds_pro_get_option( 'sidebar_position', 'right' )
    // Example Modern: mds_pro_get_option( 'primary', '#e74c3c' )
    elseif ( $num_args === 2 ) {
        // Check if $arg1 is a legacy key that maps to a new key
        if ( isset( $map[$arg1] ) && is_string( $map[$arg1] ) ) {
            $target_key = $map[$arg1];
        }
        // Check if $arg1 is a legacy section name but only 2 args were passed
        elseif ( isset( $map[$arg1] ) && is_array( $map[$arg1] ) && isset( $map[$arg1][$arg2] ) ) {
             $target_key = $map[$arg1][$arg2];
             $final_default = null; // Try to find a global default later
        }
        $final_default = $arg2;
    }
    // 3. Handle Single arg (Modern or Legacy Key)
    elseif ( $num_args === 1 ) {
        if ( isset( $map[$arg1] ) && is_string( $map[$arg1] ) ) {
            $target_key = $map[$arg1];
        }
        $final_default = null;
    }

    // Now retrieve the value from the options array
    $options = mds_pro_get_all_options();
    
    if ( isset( $options[$target_key] ) ) {
        return apply_filters( "mds_pro_option_{$target_key}", $options[$target_key] );
    }

    // Fallback: If not found in options, return the provided default or the global default
    if ( null !== $final_default ) {
        return $final_default;
    }
    
    return isset( $defaults[$target_key] ) ? $defaults[$target_key] : null;
}

/**
 * Internal Compatibility Helper (Deprecated)
 * 
 * Redirects to the unified function.
 */
function mds_pro_get_option_compat( $section, $key = '', $default = '' ) {
    return mds_pro_get_option( $section, $key, $default );
}
