<?php
/**
 * MundialdeSalsa Pro Hooks API
 * 
 * Centralized logic for theme hooks to allow extensibility.
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Header Hooks
 */
function mds_pro_before_header() {
    do_action( 'mds_pro_before_header' );
}

function mds_pro_after_header() {
    do_action( 'mds_pro_after_header' );
}

/**
 * Footer Hooks
 */
function mds_pro_before_footer() {
    do_action( 'mds_pro_before_footer' );
}

function mds_pro_after_footer() {
    do_action( 'mds_pro_after_footer' );
}

/**
 * Content Hooks
 */
function mds_pro_before_content() {
    do_action( 'mds_pro_before_content' );
}

function mds_pro_after_content() {
    do_action( 'mds_pro_after_content' );
}

function mds_pro_before_single_content() {
    do_action( 'mds_pro_before_single_content' );
}

function mds_pro_after_single_content() {
    do_action( 'mds_pro_after_single_content' );
}

/**
 * Sidebar Hooks
 */
function mds_pro_before_sidebar() {
    do_action( 'mds_pro_before_sidebar' );
}

function mds_pro_after_sidebar() {
    do_action( 'mds_pro_after_sidebar' );
}
