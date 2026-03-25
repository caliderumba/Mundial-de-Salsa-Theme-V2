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

/**
 * Render MDS Bento Grid
 */
function mds_pro_render_bento_grid( $attributes ) {
    $category = isset( $attributes['category'] ) ? $attributes['category'] : '';
    $count = 3; // Fixed for bento layout

    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => $count,
        'post_status'    => 'publish',
    );

    if ( ! empty( $category ) ) {
        $args['category_name'] = $category;
    }

    $query = new WP_Query( $args );
    $output = '<div class="mds-bento-grid grid grid-cols-1 md:grid-cols-3 gap-6 my-12">';

    if ( $query->have_posts() ) {
        $i = 0;
        while ( $query->have_posts() ) {
            $query->the_post();
            $i++;
            
            $col_span = ( $i === 1 ) ? 'md:col-span-2' : 'md:col-span-1';
            $height = ( $i === 1 ) ? 'h-[400px] md:h-[600px]' : 'h-[290px]';
            $title_size = ( $i === 1 ) ? 'text-3xl md:text-5xl' : 'text-xl';

            $output .= '<article class="' . esc_attr( $col_span ) . ' relative group overflow-hidden rounded-salsa shadow-lg">';
            
            if ( has_post_thumbnail() ) {
                $output .= '<div class="absolute inset-0 z-0">';
                $output .= get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700' ) );
                $output .= '<div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>';
                $output .= '</div>';
            }

            $output .= '<div class="relative z-10 h-full flex flex-col justify-end p-8 ' . esc_attr( $height ) . '">';
            $cats = get_the_category();
            if ( ! empty( $cats ) ) {
                $output .= '<span class="inline-block bg-salsa text-white text-[10px] font-black uppercase tracking-widest px-3 py-1 rounded-full mb-4 self-start">' . esc_html( $cats[0]->name ) . '</span>';
            }
            $output .= '<h3 class="' . esc_attr( $title_size ) . ' font-black uppercase italic tracking-tighter leading-none text-white transition-colors group-hover:text-salsa"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
            $output .= '</div>';
            
            $output .= '</article>';
        }
        wp_reset_postdata();
    }

    $output .= '</div>';
    return $output;
}

/**
 * Render MDS Smart List
 */
function mds_pro_render_smart_list( $attributes ) {
    $category = isset( $attributes['category'] ) ? $attributes['category'] : '';
    $count = isset( $attributes['count'] ) ? $attributes['count'] : 5;

    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => $count,
        'post_status'    => 'publish',
    );

    if ( ! empty( $category ) ) {
        $args['category_name'] = $category;
    }

    $query = new WP_Query( $args );
    $output = '<div class="mds-smart-list space-y-6 my-12">';

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            
            $video_url = get_post_meta( get_the_ID(), 'mds_post_video_url', true );
            $audio_url = get_post_meta( get_the_ID(), 'mds_post_audio_url', true );
            
            $output .= '<article class="flex items-center gap-6 group">';
            
            if ( has_post_thumbnail() ) {
                $output .= '<div class="w-24 h-24 shrink-0 rounded-xl overflow-hidden shadow-md relative">';
                $output .= get_the_post_thumbnail( get_the_ID(), 'thumbnail', array( 'class' => 'w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500' ) );
                
                if ( ! empty( $video_url ) ) {
                    $output .= '<div class="absolute inset-0 flex items-center justify-center bg-black/40 text-white"><svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></div>';
                } elseif ( ! empty( $audio_url ) ) {
                    $output .= '<div class="absolute inset-0 flex items-center justify-center bg-black/40 text-white"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg></div>';
                }
                
                $output .= '</div>';
            }

            $output .= '<div class="flex-1">';
            $output .= '<h4 class="text-lg font-black uppercase italic tracking-tighter leading-tight group-hover:text-salsa transition-colors"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>';
            $output .= '<div class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mt-1">' . get_the_date() . '</div>';
            $output .= '</div>';
            
            $output .= '</article>';
        }
        wp_reset_postdata();
    }

    $output .= '</div>';
    return $output;
}

/**
 * Render MDS Editorial Highlights
 */
function mds_pro_render_editorial_highlights() {
    ob_start();
    mds_pro_render_post_highlights();
    return ob_get_clean();
}

/**
 * Render MDS Live Updates
 */
function mds_pro_render_live_updates( $attributes ) {
    $updates = isset( $attributes['updates'] ) ? $attributes['updates'] : array();
    
    if ( empty( $updates ) ) {
        return '<p class="text-slate-400 italic">' . __( 'No hay actualizaciones en vivo aún.', 'mundialdesalsa-pro' ) . '</p>';
    }

    $output = '<div class="mds-live-timeline relative pl-8 border-l-2 border-slate-100 dark:border-slate-800 space-y-10 my-12">';
    
    foreach ( $updates as $update ) {
        $time = isset( $update['time'] ) ? $update['time'] : date('H:i');
        $content = isset( $update['content'] ) ? $update['content'] : '';
        $title = isset( $update['title'] ) ? $update['title'] : '';

        $output .= '<div class="timeline-item relative">';
        $output .= '<div class="absolute -left-[41px] top-0 w-4 h-4 rounded-full bg-salsa border-4 border-white dark:border-slate-900 shadow-sm"></div>';
        $output .= '<div class="text-[10px] font-black uppercase tracking-widest text-salsa mb-1">' . esc_html( $time ) . '</div>';
        if ( ! empty( $title ) ) {
            $output .= '<h4 class="text-lg font-black uppercase italic tracking-tighter leading-none mb-2">' . esc_html( $title ) . '</h4>';
        }
        $output .= '<div class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">' . wp_kses_post( $content ) . '</div>';
        $output .= '</div>';
    }

    $output .= '</div>';
    return $output;
}

/**
 * Render MDS Live Score
 */
function mds_pro_render_live_score( $attributes ) {
    $scores = isset( $attributes['scores'] ) ? $attributes['scores'] : array();
    $title = isset( $attributes['title'] ) ? $attributes['title'] : 'Tabla de Posiciones';

    $output = '<div class="mds-live-score my-12 bg-slate-900 rounded-salsa overflow-hidden shadow-2xl border border-slate-800">';
    $output .= '<div class="bg-salsa p-4"><h3 class="text-white text-xl font-black uppercase italic tracking-tighter m-0">' . esc_html( $title ) . '</h3></div>';
    $output .= '<div class="p-2">';
    $output .= '<table class="w-full text-left border-collapse">';
    $output .= '<thead><tr class="text-[10px] font-black uppercase tracking-widest text-slate-500 border-b border-slate-800"><th class="p-4">#</th><th class="p-4">Participante</th><th class="p-4">Categoría</th><th class="p-4 text-right">Puntaje</th></tr></thead>';
    $output .= '<tbody class="text-white">';

    if ( ! empty( $scores ) ) {
        foreach ( $scores as $index => $score ) {
            $name = isset( $score['name'] ) ? $score['name'] : '-';
            $cat = isset( $score['category'] ) ? $score['category'] : '-';
            $pts = isset( $score['points'] ) ? $score['points'] : '0.00';
            
            $output .= '<tr class="border-b border-slate-800/50 hover:bg-white/5 transition-colors">';
            $output .= '<td class="p-4 font-black text-salsa">' . ( $index + 1 ) . '</td>';
            $output .= '<td class="p-4 font-bold">' . esc_html( $name ) . '</td>';
            $output .= '<td class="p-4 text-xs text-slate-400">' . esc_html( $cat ) . '</td>';
            $output .= '<td class="p-4 text-right font-black text-xl italic text-emerald-400">' . esc_html( $pts ) . '</td>';
            $output .= '</tr>';
        }
    } else {
        $output .= '<tr><td colspan="4" class="p-8 text-center text-slate-500 italic">' . __( 'Esperando resultados...', 'mundialdesalsa-pro' ) . '</td></tr>';
    }

    $output .= '</tbody></table></div></div>';
    return $output;
}

/**
 * Render MDS Audio Playlist
 */
function mds_pro_render_audio_playlist( $attributes ) {
    $category = isset( $attributes['category'] ) ? $attributes['category'] : '';
    $count = isset( $attributes['count'] ) ? $attributes['count'] : 10;

    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => $count,
        'post_status'    => 'publish',
        'meta_query'     => array(
            'relation' => 'OR',
            array( 'key' => 'mds_post_audio_url', 'compare' => 'EXISTS' ),
            array( 'key' => 'mds_post_audio_self', 'compare' => 'EXISTS' ),
        ),
    );

    if ( ! empty( $category ) ) {
        $args['category_name'] = $category;
    }

    $query = new WP_Query( $args );
    $output = '<div class="mds-audio-playlist my-12 bg-slate-50 dark:bg-slate-900 rounded-salsa p-6 border border-slate-100 dark:border-slate-800">';
    $output .= '<h3 class="text-xs font-black uppercase tracking-widest text-slate-400 mb-6 flex items-center gap-2"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg> ' . __( 'Playlist Editorial', 'mundialdesalsa-pro' ) . '</h3>';
    $output .= '<div class="space-y-4">';

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $audio_url = get_post_meta( get_the_ID(), 'mds_post_audio_url', true );
            $audio_self = get_post_meta( get_the_ID(), 'mds_post_audio_self', true );
            
            $output .= '<div class="audio-item flex items-center gap-4 p-3 bg-white dark:bg-slate-800 rounded-xl shadow-sm hover:shadow-md transition-all group">';
            $output .= '<div class="w-12 h-12 shrink-0 rounded-lg overflow-hidden">';
            $output .= get_the_post_thumbnail( get_the_ID(), 'thumbnail', array( 'class' => 'w-full h-full object-cover' ) );
            $output .= '</div>';
            $output .= '<div class="flex-1">';
            $output .= '<h4 class="text-sm font-bold uppercase italic tracking-tighter leading-none mb-1 group-hover:text-salsa transition-colors">' . get_the_title() . '</h4>';
            
            if ( ! empty( $audio_self['url'] ) ) {
                $output .= '<audio controls class="w-full h-8 mt-2 mds-mini-player"><source src="' . esc_url( $audio_self['url'] ) . '" type="audio/mpeg"></audio>';
            } elseif ( ! empty( $audio_url ) ) {
                $output .= '<div class="text-[10px] text-slate-400 uppercase font-black tracking-widest mt-1">' . __( 'External Audio', 'mundialdesalsa-pro' ) . '</div>';
            }
            
            $output .= '</div></div>';
        }
        wp_reset_postdata();
    } else {
        $output .= '<p class="text-slate-400 italic text-sm">' . __( 'No se encontraron audios.', 'mundialdesalsa-pro' ) . '</p>';
    }

    $output .= '</div></div>';
    return $output;
}

/**
 * Render MDS Video Hero
 */
function mds_pro_render_video_hero() {
    $video_url   = get_post_meta( get_the_ID(), 'mds_post_video_url', true );
    $video_embed = get_post_meta( get_the_ID(), 'mds_post_video_embed', true );
    $video_self  = get_post_meta( get_the_ID(), 'mds_post_video_self', true );

    if ( empty( $video_url ) && empty( $video_embed ) && empty( $video_self['url'] ) ) {
        return '';
    }

    ob_start();
    ?>
    <div class="mds-video-hero-wrapper relative mb-12" id="mds-theater-container">
        <div class="mds-video-hero bg-black overflow-hidden shadow-2xl relative z-20">
            <div class="container mx-auto">
                <?php mds_pro_render_post_video(); ?>
            </div>
        </div>
        <div class="flex justify-center mt-4">
            <button id="mds-theater-toggle" class="text-[10px] font-black uppercase tracking-widest px-4 py-2 border border-slate-200 rounded-full hover:bg-black hover:text-white transition-all">
                <?php _e( 'Modo Teatro', 'mundialdesalsa-pro' ); ?>
            </button>
        </div>
        
        <?php if ( ! empty( $video_url ) ) : ?>
            <script type="application/ld+json">
            {
              "@context": "https://schema.org",
              "@type": "VideoObject",
              "name": "<?php echo esc_js( get_the_title() ); ?>",
              "description": "<?php echo esc_js( wp_trim_words( get_the_excerpt(), 25 ) ); ?>",
              "thumbnailUrl": "<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>",
              "uploadDate": "<?php echo get_the_date( 'c' ); ?>",
              "contentUrl": "<?php echo esc_url( $video_url ); ?>"
            }
            </script>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
