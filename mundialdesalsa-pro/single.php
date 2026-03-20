<?php
/**
 * Single Post Template - Mundial de Salsa Pro
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

global $mds_pro_options;
$show_sidebar = mds_pro_get_option( 'layout', 'sidebar_position', 'right' ) !== 'none';
$show_author_box = mds_pro_get_option( 'post_settings', 'opt_show_author_box', true );
?>

<main id="primary" class="site-main py-12">
    <div class="container">
        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
                <header class="post-header mb-10 text-center">
                    <div class="mb-4">
                        <?php the_category(' '); ?>
                    </div>
                    <h1 class="text-4xl md:text-6xl font-black uppercase leading-tight mb-6">
                        <?php the_title(); ?>
                    </h1>
                    <div class="text-xs text-gray-500 uppercase tracking-widest">
                        <span><?php the_author(); ?></span> / <time><?php echo get_the_date(); ?></time>
                    </div>
                </header>

                <?php 
                // Render Video (SEO Priority: Before Content)
                mds_pro_render_post_video(); 
                ?>

                <?php if ( has_post_thumbnail() && empty( get_post_meta( get_the_ID(), 'mds_post_video_url', true ) ) && empty( get_post_meta( get_the_ID(), 'mds_post_video_embed', true ) ) ) : ?>
                    <div class="post-thumbnail mb-12 rounded-salsa overflow-hidden shadow-2xl">
                        <?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-auto' ) ); ?>
                    </div>
                <?php endif; ?>

                <div class="flex flex-wrap -mx-4">
                    <div class="w-full <?php echo $show_sidebar ? 'lg:w-2/3' : 'w-full'; ?> px-4">
                        
                        <?php 
                        // Render Highlights
                        mds_pro_render_post_highlights(); 
                        ?>

                        <div class="entry-content prose prose-lg max-w-none mb-12">
                            <?php the_content(); ?>
                        </div>

                        <?php 
                        // Render Sources
                        mds_pro_render_post_sources(); 
                        ?>

                        <?php if ( $show_author_box ) : ?>
                            <div class="author-box p-8 bg-gray-50 rounded-salsa flex flex-col md:flex-row items-center gap-8 mb-12 border-l-8 border-salsa">
                                <div class="author-avatar shrink-0">
                                    <?php echo get_avatar( get_the_author_meta( 'ID' ), 120, '', '', array('class' => 'rounded-full border-4 border-salsa shadow-lg') ); ?>
                                </div>
                                <div class="author-info text-center md:text-left">
                                    <h4 class="text-2xl font-black uppercase mb-2"><?php the_author(); ?></h4>
                                    <p class="text-gray-600 mb-6"><?php the_author_meta( 'description' ); ?></p>
                                    
                                    <div class="author-socials flex gap-4 justify-center md:justify-start">
                                        <?php 
                                        $socials = array(
                                            'facebook'  => array('url' => 'facebook_url', 'color' => '#1877F2', 'icon' => 'fa-facebook-f'),
                                            'instagram' => array('url' => 'instagram_url', 'color' => '#E4405F', 'icon' => 'fa-instagram'),
                                            'twitter'   => array('url' => 'twitter_url', 'color' => '#000000', 'icon' => 'fa-x-twitter'),
                                            'youtube'   => array('url' => 'youtube_url', 'color' => '#FF0000', 'icon' => 'fa-youtube'),
                                            'tiktok'    => array('url' => 'tiktok_url', 'color' => '#010101', 'icon' => 'fa-tiktok'),
                                        );

                                        foreach ($socials as $key => $social) :
                                            $url = mds_pro_get_option('social', $social['url'], '#');
                                            if ( $url && $url !== '#' ) : ?>
                                                <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" class="w-10 h-10 flex items-center justify-center rounded-full text-white transition-transform hover:scale-110" style="background-color: <?php echo $social['color']; ?>">
                                                    <i class="fab <?php echo $social['icon']; ?>"></i>
                                                </a>
                                            <?php endif;
                                        endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="related-posts mt-12 pt-12 border-t border-gray-200">
                            <h3 class="text-2xl font-black uppercase mb-8 border-b-4 border-salsa inline-block">Salsa Relacionada</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                <?php
                                $related_type = mds_pro_get_option( 'post_settings', 'related_posts_type', 'category' );
                                $related_args = array(
                                    'posts_per_page' => 3,
                                    'post__not_in'   => array(get_the_ID()),
                                    'orderby'        => 'rand',
                                );

                                if ($related_type === 'category') {
                                    $cats = wp_get_post_categories(get_the_ID());
                                    if ($cats) $related_args['category__in'] = $cats;
                                } else {
                                    $tags = wp_get_post_tags(get_the_ID());
                                    if ($tags) $related_args['tag__in'] = wp_list_pluck($tags, 'term_id');
                                }

                                $related_query = new WP_Query($related_args);
                                if ($related_query->have_posts()) :
                                    while ($related_query->have_posts()) : $related_query->the_post(); ?>
                                        <div class="related-item group">
                                            <a href="<?php the_permalink(); ?>" class="block">
                                                <div class="aspect-video mb-4 overflow-hidden rounded-salsa bg-gray-200">
                                                    <?php if (has_post_thumbnail()) : ?>
                                                        <?php the_post_thumbnail('medium', array('class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-110')); ?>
                                                    <?php endif; ?>
                                                </div>
                                                <h4 class="text-lg font-bold uppercase transition-colors group-hover:text-salsa">
                                                    <?php the_title(); ?>
                                                </h4>
                                            </a>
                                        </div>
                                    <?php endwhile; wp_reset_postdata();
                                endif; ?>
                            </div>
                        </div>
                    </div>

                    <?php if ( $show_sidebar ) : ?>
                        <aside class="w-full lg:w-1/3 px-4">
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
