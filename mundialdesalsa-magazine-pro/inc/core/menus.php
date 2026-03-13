<?php
/**
 * Navigation Menus and Walkers
 *
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Custom Menu Walker for Bootstrap or specific layouts
 */
class MDS_Pro_Menu_Walker extends Walker_Nav_Menu {
    // Custom walker logic can go here
}

/**
 * Helper to check if a menu has items
 */
function mds_pro_has_menu( $location ) {
    return has_nav_menu( $location );
}

