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

// Access Redux Global Options
global $mds_pro_options;
$show_sidebar = isset($mds_pro_options['single_sidebar_toggle']) ? $mds_pro_options['single_sidebar_toggle'] : true;
?>

<main id="primary" class="site-main py-12 bg-white dark:bg-slate-950">
    <div class="container mx-auto px-4">
        
        <!-- Category Header -->
        <header class="archive-header mb-12 border-b-4 border-[#e74c3c] inline-block pb-2">
            <h1 class="text-4xl font-black uppercase tracking-tighter text-slate-900 dark:text-white">
                <?php single_cat_title(); ?>
            </h1>
            <?php the_archive_description( '<div class="archive-description text-slate-500 mt-2">', '</div>' ); ?>
        </header>

        <div class="row category-layout-row">
            
            <!-- Main Content Column -->
            <div class="category-content-col <?php echo $show_sidebar ? 'col-md-8' : 'col-md-12'; ?>">
                
                <?php if ( have_posts() ) : ?>
                    <div class="category-posts-wrapper">
                        <?php 
                        $count = 0;
                        while ( have_posts() ) : the_post(); 
                            
                            if ( $count == 0 ) : ?>
                                <!-- Featured Post (First Item) -->
                                <div class="col-12 mb-10">
                                    <article id="post-<?php the_ID(); ?>" <?php post_class('category-featured-post group relative rounded-2xl overflow-hidden shadow-2xl h-[450px]'); ?>>
                                        <a href="<?php the_permalink(); ?>" class="absolute inset-0 z-0">
                                            <?php if ( has_post_thumbnail() ) : ?>
                                                <?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-full object-cover transition-transform duration-700 group-hover:scale-110' ) ); ?>
                                            <?php else : ?>
                                                <div class="w-full h-full bg-slate-200 dark:bg-slate-800"></div>
                                            <?php endif; ?>
                                        </a>
                                        
                                        <!-- Gradient Overlay -->
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent z-10"></div>
                                        
                                        <!-- Content -->
                                        <div class="absolute bottom-0 left-0 p-8 md:p-12 z-20 w-full">
                                            <div class="category-badge-wrapper mb-4">
                                                <span class="bg-[#e74c3c] text-white text-[10px] font-black uppercase tracking-[0.2em] px-4 py-1 rounded-full">
                                                    <?php single_cat_title(); ?>
                                                </span>
                                            </div>
                                            <h2 class="text-3xl md:text-5xl font-black uppercase tracking-tighter leading-none text-white drop-shadow-lg">
                                                <a href="<?php the_permalink(); ?>" class="hover:text-[#e74c3c] transition-colors">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h2>
                                            <div class="flex items-center gap-4 mt-4 text-xs text-white/70 font-bold uppercase tracking-widest">
                                                <span><?php the_author(); ?></span>
                                                <span>/</span>
                                                <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                
                                <!-- Start Grid for subsequent posts -->
                                <div class="row category-grid">
                            <?php else : ?>
                                <!-- Grid Post (Subsequent Items) -->
                                <div class="col-md-6 mb-8">
                                    <article id="post-<?php the_ID(); ?>" <?php post_class('category-grid-item flex gap-4 group'); ?>>
                                        <div class="grid-thumb shrink-0 w-32 h-24 md:w-40 md:h-28 rounded-xl overflow-hidden shadow-md">
                                            <a href="<?php the_permalink(); ?>" class="block h-full">
                                                <?php if ( has_post_thumbnail() ) : ?>
                                                    <?php the_post_thumbnail( 'medium', array( 'class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-110' ) ); ?>
                                                <?php else : ?>
                                                    <div class="w-full h-full bg-slate-100 dark:bg-slate-800"></div>
                                                <?php endif; ?>
                                            </a>
                                        </div>
                                        <div class="grid-content flex flex-col justify-center">
                                            <h3 class="text-lg font-black uppercase tracking-tight leading-tight mb-2">
                                                <a href="<?php the_permalink(); ?>" class="text-slate-900 dark:text-white hover:text-[#e74c3c] transition-colors">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>
                                            <time class="text-[10px] font-bold uppercase tracking-widest text-slate-400" datetime="<?php echo get_the_date('c'); ?>">
                                                <?php echo get_the_date(); ?>
                                            </time>
                                        </div>
                                    </article>
                                </div>
                            <?php endif; ?>
                            
                            <?php 
                            $count++;
                        endwhile; 
                        
                        // Close grid div if it was opened
                        if ( $count > 1 ) echo '</div>';
                        ?>
                        
                        <!-- Pagination -->
                        <div class="pagination-wrapper mt-12">
                            <?php the_posts_pagination( array(
                                'prev_text' => '<i class="fa-solid fa-arrow-left"></i>',
                                'next_text' => '<i class="fa-solid fa-arrow-right"></i>',
                                'class'     => 'mds-pagination',
                            ) ); ?>
                        </div>
                    </div>
                <?php else : ?>
                    <p class="text-slate-500 italic">No se encontraron noticias en esta categoría.</p>
                <?php endif; ?>

            </div>

            <!-- Sidebar Column -->
            <?php if ( $show_sidebar ) : ?>
                <aside class="category-sidebar-col col-md-4">
                    <?php get_sidebar(); ?>
                </aside>
            <?php endif; ?>

        </div>
    </div>
</main>

<?php
get_footer();
