<?php
/**
 * Template Name: Live Coverage Template
 * Template Post Type: post, page
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

global $mds_pro_options;
?>

<main id="primary" class="site-main py-12 bg-slate-50 dark:bg-slate-950">
    <div class="container">
        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
                <header class="post-header mb-12 text-center max-w-4xl mx-auto">
                    <div class="flex justify-center mb-6">
                        <span class="bg-red-600 text-white text-[10px] font-black uppercase tracking-widest px-3 py-1 rounded animate-pulse flex items-center gap-2">
                            <span class="w-2 h-2 bg-white rounded-full"></span> <?php _e( 'En Vivo', 'mundialdesalsa-pro' ); ?>
                        </span>
                    </div>
                    <h1 class="text-4xl md:text-7xl font-black uppercase italic tracking-tighter leading-none mb-6">
                        <?php the_title(); ?>
                    </h1>
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-widest flex items-center justify-center gap-4">
                        <span><?php the_author(); ?></span>
                        <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                        <time><?php echo get_the_date(); ?></time>
                    </div>
                </header>

                <div class="flex flex-wrap -mx-6">
                    <!-- Main Content Column -->
                    <div class="w-full lg:w-2/3 px-6">
                        <div class="bg-white dark:bg-slate-900 rounded-salsa shadow-xl overflow-hidden mb-12">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="aspect-video relative overflow-hidden">
                                    <?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-full object-cover' ) ); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="p-8 md:p-12">
                                <?php mds_pro_render_post_highlights(); ?>
                                
                                <div class="entry-content prose prose-lg dark:prose-invert max-w-none">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Live Timeline Sidebar -->
                    <div class="w-full lg:w-1/3 px-6">
                        <div class="sticky top-24">
                            <div class="bg-white dark:bg-slate-900 rounded-salsa shadow-xl p-8 border-t-4 border-salsa">
                                <h3 class="text-xl font-black uppercase italic tracking-tighter mb-8 flex items-center justify-between">
                                    <?php _e( 'Minuto a Minuto', 'mundialdesalsa-pro' ); ?>
                                    <button id="refresh-live-timeline" class="text-slate-400 hover:text-salsa transition-colors">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 4v6h-6M1 20v-6h6M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></svg>
                                    </button>
                                </h3>
                                
                                <div id="live-timeline-container">
                                    <?php 
                                    // We look for the live-updates block in the content or use a custom field
                                    $updates = get_post_meta( get_the_ID(), 'mds_live_updates', true );
                                    echo mds_pro_render_live_updates( array( 'updates' => $updates ) ); 
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php
get_footer();
