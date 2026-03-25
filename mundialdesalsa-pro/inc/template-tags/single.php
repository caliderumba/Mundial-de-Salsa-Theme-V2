<?php
/**
 * Single Post Template Tags - Mundial de Salsa Pro
 * 
 * Helpers for rendering single post content.
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Renders the single post hero section.
 */
function mds_single_hero() {
    get_template_part( 'template-parts/single/hero' );
}

/**
 * Renders the single post meta section.
 */
function mds_single_meta() {
    get_template_part( 'template-parts/single/meta' );
}

/**
 * Renders the related posts section.
 */
function mds_single_related() {
    get_template_part( 'template-parts/single/related' );
}

/**
 * Renders the author box section.
 */
function mds_single_author_box() {
    get_template_part( 'template-parts/single/author-box' );
}
