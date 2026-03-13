<?php
/**
 * Module: Mega Menu Logic
 */

class MDS_Mega_Menu {
    public function __construct() {
        add_filter( 'wp_nav_menu_objects', [ $this, 'add_mega_menu_content' ], 10, 2 );
    }

    public function add_mega_menu_content( $items, $args ) {
        if ( $args->theme_location !== 'main-menu' ) return $items;

        foreach ( $items as $item ) {
            // Check if menu item has a specific class or is a category
            if ( in_array( 'mega-menu', $item->classes ) && $item->type === 'taxonomy' ) {
                $item->description .= $this->render_mega_menu_posts( $item->object_id );
            }
        }

        return $items;
    }

    private function render_mega_menu_posts( $cat_id ) {
        $query = new WP_Query([
            'posts_per_page' => 4,
            'cat'            => $cat_id,
            'post_status'    => 'publish'
        ]);

        $output = '<div class="mega-menu-content row p-4 bg-white shadow-lg border-top">';
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();
                $output .= '<div class="col-3">';
                $output .= '<div class="mega-post-item">';
                if ( has_post_thumbnail() ) {
                    $output .= '<div class="mb-2 rounded overflow-hidden">' . get_the_post_thumbnail( get_the_ID(), 'mds-pro-list', [ 'class' => 'img-fluid' ] ) . '</div>';
                }
                $output .= '<h4 class="h6"><a href="' . get_permalink() . '" class="text-dark">' . get_the_title() . '</a></h4>';
                $output .= '</div></div>';
            }
            wp_reset_postdata();
        }
        $output .= '</div>';

        return $output;
    }
}
new MDS_Mega_Menu();
