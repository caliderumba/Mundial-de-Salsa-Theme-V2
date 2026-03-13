<?php
/**
 * Component: Breadcrumbs
 */
function mds_pro_breadcrumbs() {
    if ( is_front_page() ) return;

    echo '<nav class="mds-breadcrumbs" aria-label="breadcrumb">';
    echo '<ol class="breadcrumb list-unstyled d-flex m-0">';
    echo '<li class="breadcrumb-item"><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'mundialdesalsa-pro' ) . '</a></li>';

    if ( is_category() || is_single() ) {
        echo '<li class="breadcrumb-item">';
        the_category( ' </li><li class="breadcrumb-item"> ' );
        echo '</li>';
        if ( is_single() ) {
            echo '<li class="breadcrumb-item active" aria-current="page">' . get_the_title() . '</li>';
        }
    } elseif ( is_page() ) {
        echo '<li class="breadcrumb-item active" aria-current="page">' . get_the_title() . '</li>';
    }

    echo '</ol>';
    echo '</nav>';
}
