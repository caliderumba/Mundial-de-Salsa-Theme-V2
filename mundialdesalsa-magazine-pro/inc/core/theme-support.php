<?php
/**
 * Theme Support and Features
 *
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Additional theme support logic.
add_action( 'after_setup_theme', function() {
    // Add support for responsive embeds.
    add_theme_support( 'responsive-embeds' );

    // Add support for wide and full alignment for Gutenberg blocks.
    add_theme_support( 'align-wide' );

    // Add support for editor styles.
    add_theme_support( 'editor-styles' );
    add_editor_style( 'assets/css/editor-style.css' );

    // Add support for custom line height.
    add_theme_support( 'custom-line-height' );

    // Add support for experimental link color.
    add_theme_support( 'experimental-link-color' );
});

