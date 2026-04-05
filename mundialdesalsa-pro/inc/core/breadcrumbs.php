<?php
/**
 * MundialdeSalsa Pro Breadcrumbs Engine
 * 
 * Centralized logic for breadcrumbs.
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get breadcrumb data for the current context.
 * 
 * @return array Breadcrumb items.
 */
function mds_get_breadcrumb_data() {
    $items = [];
    
    // Home
    $items[] = [
        'text' => __( 'Inicio', 'mds-pro' ),
        'url'  => home_url( '/' )
    ];

    if ( is_category() ) {
        $items[] = [
            'text' => single_cat_title( '', false ),
            'url'  => get_category_link( get_queried_object_id() )
        ];
    } elseif ( is_singular( 'post' ) ) {
        $categories = get_the_category();
        if ( ! empty( $categories ) ) {
            $primary_cat = $categories[0];
            $items[] = [
                'text' => $primary_cat->name,
                'url'  => get_category_link( $primary_cat->term_id )
            ];
        }
        $items[] = [
            'text' => get_the_title(),
            'url'  => get_permalink()
        ];
    } elseif ( is_tag() ) {
        $items[] = [
            'text' => single_tag_title( '', false ),
            'url'  => get_tag_link( get_queried_object_id() )
        ];
    } elseif ( is_author() ) {
        $items[] = [
            'text' => get_the_author(),
            'url'  => get_author_posts_url( get_the_author_meta( 'ID' ) )
        ];
    } elseif ( is_archive() ) {
        $items[] = [
            'text' => get_the_archive_title(),
            'url'  => mds_get_current_url()
        ];
    } elseif ( is_search() ) {
        $items[] = [
            'text' => sprintf( __( 'Búsqueda: %s', 'mds-pro' ), get_search_query() ),
            'url'  => home_url( '/?s=' . get_search_query() )
        ];
    }

    return $items;
}

/**
 * Render breadcrumbs.
 */
function mds_pro_breadcrumbs() {
    if ( is_front_page() ) {
        return;
    }

    $items = mds_get_breadcrumb_data();
    if ( empty( $items ) ) {
        return;
    }

    echo '<nav class="mds-breadcrumbs text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-8" aria-label="Breadcrumb">';
    echo '<ol class="flex items-center gap-2 list-none p-0 m-0">';
    
    foreach ( $items as $index => $item ) {
        $is_last = ( $index === count( $items ) - 1 );
        
        echo '<li class="flex items-center gap-2">';
        if ( ! $is_last ) {
            echo '<a href="' . esc_url( $item['url'] ) . '" class="hover:text-slate-900 dark:hover:text-white transition-colors">' . esc_html( $item['text'] ) . '</a>';
            echo '<svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" class="text-slate-300"><polyline points="9 18 15 12 9 6"/></svg>';
        } else {
            echo '<span class="text-slate-900 dark:text-white truncate max-w-[200px]" aria-current="page">' . esc_html( $item['text'] ) . '</span>';
        }
        echo '</li>';
    }
    
    echo '</ol>';
    echo '</nav>';
}
