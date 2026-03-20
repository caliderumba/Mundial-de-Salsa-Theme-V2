<?php
/**
 * Mega Menu Hybrid Module
 *
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom Walker for Mega Menu
 */
class Mundial_Salsa_Mega_Menu_Walker extends Walker_Nav_Menu {

    /**
     * Start the element output.
     */
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        
        // Check if it has the mega-menu-feria class
        if ( in_array( 'mega-menu-feria', $classes ) ) {
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
            
            $output .= $indent . '<li class="menu-item mega-menu-item mega-menu-feria group relative">';
            $output .= '<a href="' . esc_url( $item->url ) . '" class="nav-link flex items-center gap-1">' . esc_html( $item->title ) . ' <i class="fa-solid fa-chevron-down text-[8px] opacity-50 group-hover:rotate-180 transition-transform"></i></a>';
            
            // Mega Menu Content Container
            $cat_id   = get_cat_ID( 'Feria de Cali' );
            $cat_link = $cat_id ? get_category_link( $cat_id ) : '#';

            $output .= '<div class="mega-menu-content absolute left-1/2 -translate-x-1/2 top-full w-[700px] bg-white dark:bg-slate-900 shadow-2xl p-6 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-[500] border-t-4 border-emerald-500 mt-2 rounded-b-xl">';
            
            $output .= '<div class="flex justify-between items-center mb-6 border-b border-slate-100 dark:border-slate-800 pb-3">';
            $output .= '<h4 class="text-[10px] uppercase tracking-[0.2em] text-emerald-600 font-black">' . esc_html__( 'Especial: Feria de Cali', 'mundialdesalsa-pro' ) . '</h4>';
            $output .= '<a href="' . esc_url( $cat_link ) . '" class="text-[9px] uppercase font-bold text-slate-400 hover:text-emerald-500 transition-colors">' . esc_html__( 'Ver todo', 'mundialdesalsa-pro' ) . ' →</a>';
            $output .= '</div>';
            
            // WP_Query for Feria de Cali
            $query_args = array(
                'category_name'  => 'feria-de-cali',
                'posts_per_page' => 3,
                'post_status'    => 'publish',
                'no_found_rows'  => true, // Performance optimization
            );
            
            $feria_query = new WP_Query( $query_args );
            
            if ( $feria_query->have_posts() ) {
                $output .= '<div class="grid grid-cols-3 gap-6">';
                while ( $feria_query->have_posts() ) {
                    $feria_query->the_post();
                    $output .= '<article class="mega-post-card group/post">';
                    
                    if ( has_post_thumbnail() ) {
                        $output .= '<div class="relative mb-3 overflow-hidden rounded-lg aspect-video bg-slate-100 dark:bg-slate-800">';
                        $output .= '<span class="feria-badge absolute top-2 left-2 z-10 bg-[#e74c3c] text-white text-[8px] font-black px-2 py-1 rounded uppercase tracking-widest">' . esc_html__( 'FERIA DE CALI', 'mundialdesalsa-pro' ) . '</span>';
                        $output .= '<a href="' . get_permalink() . '" class="block w-full h-full">';
                        $output .= get_the_post_thumbnail( get_the_ID(), 'mds-pro-thumbnail', array( 'class' => 'w-full h-full object-cover group-hover/post:scale-110 transition-transform duration-700' ) );
                        $output .= '</a>';
                        $output .= '</div>';
                    }
                    
                    $output .= '<h5 class="mega-post-title text-xs font-black leading-snug mb-2 text-[#2c3e50] dark:text-white uppercase tracking-tight italic">';
                    $output .= '<a href="' . get_permalink() . '" class="hover:text-[#e74c3c] transition-colors line-clamp-2">' . get_the_title() . '</a>';
                    $output .= '</h5>';
                    
                    $output .= '<div class="flex items-center gap-2 text-[9px] text-slate-400 font-mono uppercase">';
                    $output .= '<span>' . get_the_date() . '</span>';
                    $output .= '</div>';
                    
                    $output .= '</article>';
                }
                $output .= '</div>';
                
                // Security: Reset post data
                wp_reset_postdata();
            } else {
                $output .= '<div class="py-8 text-center">';
                $output .= '<p class="text-[10px] text-slate-400 uppercase tracking-widest">' . esc_html__( 'No hay noticias recientes de la Feria.', 'mundialdesalsa-pro' ) . '</p>';
                $output .= '</div>';
            }
            
            $output .= '</div>'; // End mega-menu-content
            $output .= '</li>';
        } else {
            // Standard Menu Item
            parent::start_el( $output, $item, $depth, $args, $id );
        }
    }
}
