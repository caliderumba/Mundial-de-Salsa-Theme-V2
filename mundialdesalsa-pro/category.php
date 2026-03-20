<?php
/**
 * Category Template - Mundial de Salsa Pro
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

global $mds_pro_options;
$show_sidebar = mds_pro_get_option( 'layout', 'sidebar_position', 'right' ) !== 'none';
?>

<main id="primary" class="site-main py-12">
    <div class="container">
        
        <header class="archive-header mb-12 border-b-4 border-salsa inline-block pb-2">
            <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tighter">
                <?php single_cat_title(); ?>
            </h1>
            <?php the_archive_description( '<div class="archive-description text-gray-500 mt-2">', '</div>' ); ?>
        </header>

        <div class="flex flex-wrap -mx-4">
            <div class="w-full <?php echo $show_sidebar ? 'lg:w-2/3' : 'w-full'; ?> px-4">
                
                <?php if ( have_posts() ) : ?>
                    <div class="category-posts-wrapper">
                        <?php 
                        $count = 0;
                        while ( have_posts() ) : the_post(); 
                            
                            if ( $count == 0 ) : ?>
                                <!-- Featured Post -->
                                <article id="post-<?php the_ID(); ?>" <?php post_class('relative h-[500px] mb-12 rounded-salsa overflow-hidden group shadow-2xl'); ?>>
                                    <a href="<?php the_permalink(); ?>" class="block h-full w-full">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-full object-cover transition-transform duration-700 group-hover:scale-110' ) ); ?>
                                        <?php endif; ?>
                                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
                                        <div class="absolute bottom-0 left-0 p-8 md:p-12 w-full">
                                            <span class="inline-block bg-salsa text-white text-xs font-black uppercase px-4 py-1 rounded-full mb-4">
                                                <?php single_cat_title(); ?>
                                            </span>
                                            <h2 class="text-3xl md:text-5xl font-black text-white uppercase leading-tight mb-4 group-hover:text-salsa transition-colors">
                                                <?php the_title(); ?>
                                            </h2>
                                            <div class="text-gray-300 text-xs uppercase tracking-widest">
                                                <?php echo get_the_date(); ?> | <?php the_author(); ?>
                                            </div>
                                        </div>
                                    </a>
                                </article>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <?php else : ?>
                                <!-- Grid Post -->
                                <article id="post-<?php the_ID(); ?>" <?php post_class('group'); ?>>
                                    <a href="<?php the_permalink(); ?>" class="block">
                                        <div class="aspect-video mb-4 overflow-hidden rounded-salsa bg-gray-200 shadow-md">
                                            <?php if ( has_post_thumbnail() ) : ?>
                                                <?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-110' ) ); ?>
                                            <?php endif; ?>
                                        </div>
                                        <h3 class="text-xl font-bold uppercase mb-2 transition-colors group-hover:text-salsa">
                                            <?php the_title(); ?>
                                        </h3>
                                        <div class="text-gray-500 text-[10px] uppercase tracking-widest">
                                            <?php echo get_the_date(); ?>
                                        </div>
                                    </a>
                                </article>
                            <?php endif; ?>
                            
                            <?php 
                            $count++;
                        endwhile; 
                        
                        if ( $count > 1 ) echo '</div>';
                        ?>
                        
                        <div class="pagination-wrapper mt-12 py-8 border-t border-gray-200 flex justify-center">
                            <?php the_posts_pagination( array(
                                'prev_text' => '<i class="fas fa-arrow-left"></i>',
                                'next_text' => '<i class="fas fa-arrow-right"></i>',
                                'class'     => 'mds-pagination',
                            ) ); ?>
                        </div>
                    </div>
                <?php else : ?>
                    <p class="text-gray-500 italic">No se encontraron noticias en esta categoría.</p>
                <?php endif; ?>

            </div>

            <?php if ( $show_sidebar ) : ?>
                <aside class="w-full lg:w-1/3 px-4">
                    <?php get_sidebar(); ?>
                </aside>
            <?php endif; ?>

        </div>
    </div>
</main>

<?php
get_footer();
