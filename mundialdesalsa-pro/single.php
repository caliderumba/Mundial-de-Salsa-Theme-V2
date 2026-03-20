<?php
/**
 * Single Post Template - Impactful & Vibrant
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

// Access Redux Global Options
global $mds_pro_options;
$show_sidebar = isset($mds_pro_options['single_sidebar_toggle']) ? $mds_pro_options['single_sidebar_toggle'] : true;
?>

<main id="primary" class="site-main py-12 bg-white dark:bg-slate-950">
    <div class="container mx-auto px-4">
        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('max-w-7xl mx-auto'); ?>>
                
                <!-- Post Header -->
                <header class="post-header mb-10 text-center max-w-5xl mx-auto">
                    <?php
                    $categories = get_the_category();
                    if ( ! empty( $categories ) ) :
                        echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '" class="inline-block bg-[#e74c3c] text-white text-[10px] font-black uppercase tracking-[0.2em] px-4 py-1 rounded-full mb-6 hover:bg-slate-900 transition-colors">' . esc_html( $categories[0]->name ) . '</a>';
                    endif;
                    ?>
                    
                    <h1 class="text-4xl md:text-6xl font-black uppercase tracking-tighter leading-[0.9] mb-8 text-slate-900 dark:text-white">
                        <?php the_title(); ?>
                    </h1>

                    <div class="flex items-center justify-center gap-6 text-xs text-slate-500 dark:text-slate-400 font-medium uppercase tracking-widest">
                        <div class="flex items-center gap-2">
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 32, '', '', array('class' => 'rounded-full border border-slate-200 dark:border-white/10') ); ?>
                            <span><?php the_author(); ?></span>
                        </div>
                        <span>/</span>
                        <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
                        <span>/</span>
                        <span><?php comments_number( '0 Comentarios', '1 Comentario', '% Comentarios' ); ?></span>
                    </div>
                </header>

                <!-- Featured Image -->
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="post-thumbnail mb-12 rounded-2xl overflow-hidden shadow-2xl aspect-[21/9] max-w-6xl mx-auto">
                        <?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-full object-cover' ) ); ?>
                    </div>
                <?php endif; ?>

                <!-- Post Content Wrapper -->
                <div class="row post-layout-row">
                    
                    <!-- Main Content Column -->
                    <div class="post-content-col <?php echo $show_sidebar ? 'col-md-8' : 'col-md-12'; ?>">
                        <div class="entry-content prose prose-lg dark:prose-invert max-w-none <?php echo ! $show_sidebar ? 'max-w-4xl mx-auto' : ''; ?>">
                            <?php the_content(); ?>
                        </div>

                        <!-- Tags & Share -->
                        <footer class="post-footer mt-16 pt-10 border-t border-slate-100 dark:border-white/5">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
                                <div class="post-tags flex flex-wrap gap-2">
                                    <?php the_tags( '', ' ', '' ); ?>
                                </div>
                                <div class="post-share flex items-center gap-4">
                                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Compartir:</span>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-400 hover:bg-[#e74c3c] hover:text-white transition-all"><i class="fa-brands fa-facebook-f"></i></a>
                                    <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" target="_blank" class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-400 hover:bg-[#e74c3c] hover:text-white transition-all"><i class="fa-brands fa-x-twitter"></i></a>
                                    <a href="https://api.whatsapp.com/send?text=<?php the_title(); ?>%20<?php the_permalink(); ?>" target="_blank" class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-400 hover:bg-[#e74c3c] hover:text-white transition-all"><i class="fa-brands fa-whatsapp"></i></a>
                                </div>
                            </div>
                        </footer>

                        <!-- Author Box -->
                        <?php if ( isset($mds_pro_options['opt_show_author_box']) && $mds_pro_options['opt_show_author_box'] ) : ?>
                            <div class="author-box mt-16 p-8 md:p-10 bg-slate-50 dark:bg-white/5 rounded-3xl border border-slate-100 dark:border-white/5 flex flex-col md:flex-row items-center md:items-start gap-8">
                                <div class="author-avatar shrink-0">
                                    <?php echo get_avatar( get_the_author_meta( 'ID' ), 120, '', '', array('class' => 'rounded-full border-4 border-[#e74c3c] shadow-xl') ); ?>
                                </div>
                                <div class="author-info text-center md:text-left">
                                    <span class="text-[10px] font-black uppercase tracking-widest text-[#e74c3c] mb-2 block">Escrito por</span>
                                    <h4 class="text-3xl font-black uppercase tracking-tight text-slate-900 dark:text-white mb-4"><?php the_author(); ?></h4>
                                    <p class="text-slate-600 dark:text-slate-400 leading-relaxed mb-6">
                                        <?php the_author_meta( 'description' ); ?>
                                    </p>
                                    
                                    <!-- Social Links from Redux -->
                                    <div class="author-social-links flex items-center justify-center md:justify-start gap-4">
                                        <?php 
                                        $socials = array(
                                            'facebook'  => array('url' => 'facebook_url', 'icon' => 'fa-facebook-f'),
                                            'instagram' => array('url' => 'instagram_url', 'icon' => 'fa-instagram'),
                                            'twitter'   => array('url' => 'twitter_url', 'icon' => 'fa-x-twitter'),
                                            'youtube'   => array('url' => 'youtube_url', 'icon' => 'fa-youtube'),
                                            'tiktok'    => array('url' => 'tiktok_url', 'icon' => 'fa-tiktok'),
                                        );

                                        foreach ($socials as $key => $social) :
                                            if ( ! empty($mds_pro_options[$social['url']]) ) : ?>
                                                <a href="<?php echo esc_url($mds_pro_options[$social['url']]); ?>" 
                                                   target="_blank" 
                                                   rel="noopener noreferrer" 
                                                   class="author-social-icon icon-<?php echo esc_attr($key); ?> w-10 h-10 flex items-center justify-center rounded-full text-white transition-transform hover:scale-110">
                                                    <i class="fa-brands <?php echo esc_attr($social['icon']); ?>"></i>
                                                </a>
                                            <?php endif;
                                        endforeach; ?>
                                        <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="text-xs font-bold uppercase tracking-widest text-slate-400 hover:text-[#e74c3c] transition-colors ml-2">Ver Perfil</a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Related Posts -->
                        <?php
                        $related_type = isset($mds_pro_options['related_posts_type']) ? $mds_pro_options['related_posts_type'] : 'category';
                        $related_args = array(
                            'posts_per_page' => 3,
                            'post__not_in'   => array(get_the_ID()),
                            'orderby'        => 'rand',
                        );

                        if ($related_type === 'category') {
                            $cats = wp_get_post_categories(get_the_ID());
                            if ($cats) {
                                $related_args['category__in'] = $cats;
                            }
                        } else {
                            $tags = wp_get_post_tags(get_the_ID());
                            if ($tags) {
                                $tag_ids = array();
                                foreach($tags as $tag) $tag_ids[] = $tag->term_id;
                                $related_args['tag__in'] = $tag_ids;
                            }
                        }

                        $related_query = new WP_Query($related_args);

                        if ($related_query->have_posts()) : ?>
                            <div class="related-posts-section mt-20">
                                <h3 class="text-2xl font-black uppercase tracking-tighter mb-10 pb-4 border-b-4 border-[#e74c3c] inline-block">Noticias Relacionadas</h3>
                                <div class="row related-posts-grid">
                                    <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
                                        <div class="col-md-4 mb-8">
                                            <div class="related-post-card group">
                                                <a href="<?php the_permalink(); ?>" class="block mb-4 overflow-hidden rounded-xl aspect-video shadow-md bg-slate-100 dark:bg-slate-800">
                                                    <?php if (has_post_thumbnail()) : ?>
                                                        <?php the_post_thumbnail('medium_large', array('class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-110')); ?>
                                                    <?php else : ?>
                                                        <div class="w-full h-full flex items-center justify-center">
                                                            <i class="fa-solid fa-image text-slate-300 text-3xl"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                </a>
                                                <h4 class="text-lg font-bold leading-tight">
                                                    <a href="<?php the_permalink(); ?>" class="text-slate-900 dark:text-white hover:text-[#e74c3c] transition-colors">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h4>
                                            </div>
                                        </div>
                                    <?php endwhile; wp_reset_postdata(); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Comments -->
                        <?php
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                        ?>
                    </div>

                    <!-- Sidebar Column -->
                    <?php if ( $show_sidebar ) : ?>
                        <aside class="post-sidebar-col col-md-4">
                            <?php get_sidebar(); ?>
                        </aside>
                    <?php endif; ?>

                </div>

            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php
get_footer();
