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
        
        // Check if it has the mega-menu-pro class
        if ( in_array( 'mega-menu-pro', $classes ) ) {
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
            
            $output .= $indent . '<li class="menu-item mega-menu-item mega-menu-pro group relative">';
            $output .= '<a href="' . esc_url( $item->url ) . '" class="nav-link flex items-center gap-1 py-6">' . esc_html( $item->title ) . ' <i class="fa-solid fa-chevron-down text-[8px] opacity-50 group-hover:rotate-180 transition-transform"></i></a>';
            
            // Mega Menu Content Container (70/20/10 Layout)
            $output .= '<div class="mega-menu-content absolute left-1/2 -translate-x-1/2 top-full w-[1100px] bg-white dark:bg-slate-900 shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-[500] border-t-4 border-[var(--mds-primary)] mt-0 rounded-b-[var(--mds-radius)] overflow-hidden">';
            
            $output .= '<div class="flex flex-wrap">';
            
            // --- SECTION 1: 70% (Mundial de Salsa) ---
            $output .= '<div class="w-[70%] p-8 border-r border-gray-100 dark:border-slate-800 bg-gray-50/50 dark:bg-slate-800/20">';
            $output .= '<h4 class="text-[10px] uppercase tracking-[0.2em] text-[var(--mds-primary)] font-black mb-6">' . esc_html__( 'Mundial de Salsa: Lo Último', 'mundialdesalsa-pro' ) . '</h4>';
            
            $salsa_query = new WP_Query( array(
                'category_name'  => 'mundial-de-salsa',
                'posts_per_page' => 1,
                'no_found_rows'  => true,
            ) );
            
            if ( $salsa_query->have_posts() ) {
                while ( $salsa_query->have_posts() ) {
                    $salsa_query->the_post();
                    $output .= '<article class="relative h-[300px] rounded-[var(--mds-radius)] overflow-hidden group/salsa shadow-lg">';
                    $output .= '<a href="' . get_permalink() . '" class="block h-full w-full">';
                    if ( has_post_thumbnail() ) {
                        $output .= get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'w-full h-full object-cover transition-transform duration-700 group-hover/salsa:scale-105', 'loading' => 'lazy' ) );
                    } else {
                        $output .= '<img src="https://picsum.photos/seed/salsa/1200/800" class="w-full h-full object-cover" loading="lazy" alt="Salsa Default">';
                    }
                    $output .= '<div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>';
                    $output .= '<div class="absolute bottom-0 left-0 p-8 w-full">';
                    $output .= '<h5 class="text-2xl font-black text-white uppercase leading-tight group-hover/salsa:text-[var(--mds-primary)] transition-colors">' . get_the_title() . '</h5>';
                    $output .= '</div>';
                    $output .= '</a>';
                    $output .= '</article>';
                }
                wp_reset_postdata();
            }
            $output .= '</div>';
            
            // --- SECTION 2: 20% (Feria de Cali) ---
            $output .= '<div class="w-[20%] p-8 border-r border-gray-100 dark:border-slate-800">';
            $output .= '<h4 class="text-[10px] uppercase tracking-[0.2em] text-gray-400 font-black mb-6">' . esc_html__( 'Feria de Cali', 'mundialdesalsa-pro' ) . '</h4>';
            
            $feria_query = new WP_Query( array(
                'category_name'  => 'feria-de-cali',
                'posts_per_page' => 4,
                'no_found_rows'  => true,
            ) );
            
            if ( $feria_query->have_posts() ) {
                $output .= '<ul class="space-y-6">';
                while ( $feria_query->have_posts() ) {
                    $feria_query->the_post();
                    $output .= '<li class="flex items-center gap-3 group/item">';
                    if ( has_post_thumbnail() ) {
                        $output .= '<div class="w-12 h-12 rounded-lg overflow-hidden shrink-0 shadow-sm">';
                        $output .= get_the_post_thumbnail( get_the_ID(), 'thumbnail', array( 'class' => 'w-full h-full object-cover', 'loading' => 'lazy' ) );
                        $output .= '</div>';
                    }
                    $output .= '<a href="' . get_permalink() . '" class="text-[11px] font-bold uppercase leading-tight group-hover/item:text-[var(--mds-primary)] transition-colors line-clamp-2">' . get_the_title() . '</a>';
                    $output .= '</li>';
                }
                $output .= '</ul>';
                wp_reset_postdata();
            }
            $output .= '</div>';
            
            // --- SECTION 3: 10% (Petronio & Blog) ---
            $output .= '<div class="w-[10%] p-8 bg-gray-50/30 dark:bg-slate-800/10">';
            $output .= '<h4 class="text-[10px] uppercase tracking-[0.2em] text-gray-400 font-black mb-6">' . esc_html__( 'Más', 'mundialdesalsa-pro' ) . '</h4>';
            
            $more_query = new WP_Query( array(
                'category_name'  => 'petronio,blog',
                'posts_per_page' => 4,
                'no_found_rows'  => true,
            ) );
            
            if ( $more_query->have_posts() ) {
                $output .= '<ul class="space-y-6">';
                while ( $more_query->have_posts() ) {
                    $more_query->the_post();
                    $output .= '<li class="flex items-center gap-3 group/item">';
                    if ( has_post_thumbnail() ) {
                        $output .= '<div class="w-8 h-8 rounded-md overflow-hidden shrink-0 shadow-sm">';
                        $output .= get_the_post_thumbnail( get_the_ID(), 'thumbnail', array( 'class' => 'w-full h-full object-cover', 'loading' => 'lazy' ) );
                        $output .= '</div>';
                    }
                    $output .= '<a href="' . get_permalink() . '" class="text-[10px] font-bold uppercase leading-tight group-hover/item:text-[var(--mds-primary)] transition-colors line-clamp-2">' . get_the_title() . '</a>';
                    $output .= '</li>';
                }
                $output .= '</ul>';
                wp_reset_postdata();
            }
            $output .= '</div>';
            
            $output .= '</div>'; // End flex
            $output .= '</div>'; // End mega-menu-content
            $output .= '</li>';
        } else {
            // Standard Menu Item
            parent::start_el( $output, $item, $depth, $args, $id );
        }
    }
}
