<?php
/**
 * The main homepage template file
 *
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$homepage_layout = get_option('mds_homepage_layout', 'magazine');

get_template_part('template-parts/homepage/' . $homepage_layout);

get_footer();
