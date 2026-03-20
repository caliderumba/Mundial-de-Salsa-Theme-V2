<?php
/**
 * Server-side rendering for custom blocks
 */

/**
 * Render Post Grid Block
 */
function mds_pro_render_post_grid( $attributes ) {
    $posts_per_page = isset( $attributes['postsPerPage'] ) ? $attributes['postsPerPage'] : 3;
    $columns = isset( $attributes['columns'] ) ? $attributes['columns'] : 3;
    $category = isset( $attributes['category'] ) ? $attributes['category'] : '';
    $layout = isset( $attributes['layout'] ) ? $attributes['layout'] : 'grid'; // grid, list
    $image_pos = isset( $attributes['imagePos'] ) ? $attributes['imagePos'] : 'top'; // top, left, right
    $show_excerpt = isset( $attributes['showExcerpt'] ) ? $attributes['showExcerpt'] : true;
    $show_date = isset( $attributes['showDate'] ) ? $attributes['showDate'] : true;
    $show_author = isset( $attributes['showAuthor'] ) ? $attributes['showAuthor'] : false;

    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => $posts_per_page,
        'post_status'    => 'publish',
    );

    if ( ! empty( $category ) ) {
        if ( is_numeric( $category ) ) {
            $args['cat'] = $category;
        } else {
            $args['category_name'] = $category;
        }
    }

    $query = new WP_Query( $args );
    
    $grid_class = $layout === 'grid' ? 'grid grid-cols-1 md:grid-cols-' . esc_attr( $columns ) : 'flex flex-col';
    $output = '<div class="mds-pro-post-grid ' . $grid_class . ' gap-8 my-12">';

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            
            $article_class = 'group';
            if ( $layout === 'list' || $image_pos !== 'top' ) {
                $article_class .= ' flex flex-col md:flex-row gap-6 items-center';
                if ( $image_pos === 'right' ) {
                    $article_class .= ' md:flex-row-reverse';
                }
            }

            $output .= '<article class="' . esc_attr( $article_class ) . '">';
            
            if ( has_post_thumbnail() ) {
                $img_container_class = 'rounded-2xl overflow-hidden shadow-md group-hover:shadow-xl transition-all duration-300 shrink-0';
                if ( $layout === 'grid' && $image_pos === 'top' ) {
                    $img_container_class .= ' mb-4 w-full';
                } else {
                    $img_container_class .= ' w-full md:w-1/3';
                }
                
                $output .= '<div class="' . esc_attr( $img_container_class ) . '">';
                $output .= get_the_post_thumbnail( get_the_ID(), 'mds-pro-magazine', array( 'class' => 'w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500' ) );
                $output .= '</div>';
            }
            
            $content_class = 'flex-1';
            $output .= '<div class="' . $content_class . '">';
            $output .= '<h3 class="text-xl font-black uppercase italic tracking-tighter leading-none mb-2 group-hover:text-emerald-500 transition-colors"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
            
            if ( $show_date || $show_author ) {
                $output .= '<div class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-2">';
                if ( $show_author ) {
                    $output .= '<span>' . get_the_author() . '</span>';
                    if ( $show_date ) $output .= ' • ';
                }
                if ( $show_date ) {
                    $output .= '<span>' . get_the_date() . '</span>';
                }
                $output .= '</div>';
            }
            
            if ( $show_excerpt ) {
                $output .= '<div class="text-sm text-slate-600 dark:text-slate-400 line-clamp-2 mb-4">' . get_the_excerpt() . '</div>';
            }
            $output .= '</div>';
            
            $output .= '</article>';
        }
        wp_reset_postdata();
    } else {
        $output .= '<p>' . esc_html__( 'No posts found.', 'mundialdesalsa-pro' ) . '</p>';
    }

    $output .= '</div>';
    return $output;
}

/**
 * Render Advanced Heading Block
 */
function mds_pro_render_advanced_heading( $attributes, $content ) {
    $tag = isset( $attributes['tag'] ) ? $attributes['tag'] : 'h2';
    $align = isset( $attributes['align'] ) ? $attributes['align'] : 'left';
    $color = isset( $attributes['color'] ) ? $attributes['color'] : 'text-slate-900 dark:text-white';
    $italic = isset( $attributes['italic'] ) ? $attributes['italic'] : true;
    
    $classes = array(
        'font-black',
        'uppercase',
        'tracking-tighter',
        'leading-none',
        'mb-8',
        'text-4xl',
        'md:text-6xl',
        $color,
        'text-' . $align
    );

    if ( $italic ) {
        $classes[] = 'italic';
    }

    return '<' . esc_attr( $tag ) . ' class="' . esc_attr( implode( ' ', $classes ) ) . '">' . $content . '</' . esc_attr( $tag ) . '>';
}

/**
 * Render Container Block
 */
function mds_pro_render_container( $attributes, $content ) {
    $bg_color = isset( $attributes['bgColor'] ) ? $attributes['bgColor'] : 'transparent';
    $padding = isset( $attributes['padding'] ) ? $attributes['padding'] : 'py-12';
    $max_width = isset( $attributes['maxWidth'] ) ? $attributes['maxWidth'] : 'max-w-7xl';
    
    $classes = array(
        'mds-pro-container',
        $padding,
        $bg_color
    );

    return '<div class="' . esc_attr( implode( ' ', $classes ) ) . '"><div class="container mx-auto px-4 ' . esc_attr( $max_width ) . '">' . $content . '</div></div>';
}
