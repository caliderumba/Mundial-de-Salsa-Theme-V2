<?php
/**
 * Custom Menu Walkers
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Split Menu Walker
 * Filters menu items to show only half of them based on 'left' or 'right' side.
 */
class MDS_Pro_Split_Walker extends Walker_Nav_Menu {
    private $side;
    private $item_count = 0;
    private $total_items = 0;

    public function __construct( $side = 'left' ) {
        $this->side = $side;
    }

    public function walk( $elements, $max_depth, ...$args ) {
        $this->total_items = count( $elements );
        $midpoint = ceil( $this->total_items / 2 );

        $filtered_elements = array();
        $count = 0;

        foreach ( $elements as $element ) {
            $count++;
            if ( 'left' === $this->side ) {
                if ( $count <= $midpoint ) {
                    $filtered_elements[] = $element;
                }
            } else {
                if ( $count > $midpoint ) {
                    $filtered_elements[] = $element;
                }
            }
        }

        return parent::walk( $filtered_elements, $max_depth, ...$args );
    }
}
