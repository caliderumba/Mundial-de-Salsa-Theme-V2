<?php
/**
 * Single Post Template - Mundial de Salsa Pro
 * 
 * Orchestrates the single post display using modular template parts.
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) : the_post(); 
    $post_id = get_the_ID();
    $context = function_exists('mds_get_post_context') ? mds_get_post_context( $post_id ) : 'news';
    $show_sidebar = function_exists('mds_pro_get_option') ? mds_pro_get_option( 'layout', 'sidebar_position', 'right' ) !== 'none' : true;
?>

<main id="primary" class="site-main py-12 bg-white dark:bg-slate-950 transition-colors duration-500" data-editorial-context="<?php echo esc_attr( $context ); ?>">
    <div class="container mx-auto px-4 max-w-7xl">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            
            <?php 
            // 1. Breadcrumbs
            if ( function_exists('mds_pro_breadcrumbs') ) {
                mds_pro_breadcrumbs();
            }

            // 2. Hero Section (Image/Video)
            if ( function_exists('mds_single_hero') ) {
                mds_single_hero(); 
            }
            ?>

            <div class="flex flex-col lg:flex-row gap-12">
                <div class="w-full <?php echo $show_sidebar ? 'lg:w-2/3' : 'w-full max-w-4xl mx-auto'; ?>">
                    
                    <header class="post-header mb-10">
                        <div class="mb-4 flex flex-wrap items-center gap-4 text-[10px] font-black uppercase tracking-[0.2em] text-emerald-600">
                            <?php 
                            $categories = get_the_category();
                            if ( ! empty( $categories ) ) : 
                                foreach ( $categories as $cat ) : ?>
                                    <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" class="hover:text-slate-900 dark:hover:text-white transition-colors">
                                        <?php echo esc_html( $cat->name ); ?>
                                    </a>
                                <?php endforeach; 
                            endif; ?>
                        </div>
                        
                        <h1 class="text-4xl md:text-6xl font-black text-slate-900 dark:text-white leading-[1.1] tracking-tight mb-8">
                            <?php the_title(); ?>
                        </h1>

                        <?php 
                        // 3. Meta Editorial (Author, Date, Reading Time)
                        if ( function_exists('mds_single_meta') ) {
                            mds_single_meta(); 
                        }
                        ?>
                    </header>

                    <div class="entry-content prose prose-xl dark:prose-invert max-w-none prose-slate prose-headings:font-black prose-headings:tracking-tight prose-a:text-emerald-600 prose-img:rounded-3xl prose-img:shadow-2xl mb-12">
                        
                        <?php 
                        // Video Specific Highlights
                        if ( $context === 'video' ) : 
                            $video_highlights = get_post_meta( $post_id, 'mds_video_highlights', true );
                            if ( ! empty( $video_highlights ) ) : ?>
                                <div class="video-highlights mb-10 p-8 bg-slate-900 text-white rounded-3xl border-l-8 border-red-600 shadow-xl">
                                    <h4 class="text-red-500 uppercase tracking-widest text-xs font-black mb-4">Puntos clave del video</h4>
                                    <div class="prose-invert text-slate-300">
                                        <?php echo wp_kses_post( $video_highlights ); ?>
                                    </div>
                                </div>
                            <?php endif; 
                        endif; ?>

                        <?php the_content(); ?>
                    </div>

                    <?php 
                    // 4. Highlights Block (Legacy/Alternative)
                    $highlights = get_post_meta( $post_id, 'mds_post_highlights', true );
                    if ( ! empty( $highlights ) && $context !== 'video' ) : ?>
                        <div class="post-highlights bg-yellow-50 dark:bg-yellow-900/10 p-8 rounded-3xl mb-12 border-l-8 border-yellow-400 shadow-sm">
                            <h3 class="text-sm font-black uppercase tracking-widest mb-4 text-yellow-700 dark:text-yellow-500">Lo más destacado</h3>
                            <div class="prose prose-sm dark:prose-invert leading-relaxed">
                                <?php echo wp_kses_post( $highlights ); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php 
                    // 5. Sources Block
                    $sources = get_post_meta( $post_id, 'mds_post_sources', true );
                    if ( ! empty( $sources ) ) : ?>
                        <div class="post-sources mt-16 p-6 bg-slate-50 dark:bg-slate-900/50 rounded-2xl border border-slate-100 dark:border-slate-800 mb-12">
                            <h5 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-4">Fuentes y Referencias</h5>
                            <div class="text-sm text-slate-600 dark:text-slate-400">
                                <?php echo wp_kses_post( $sources ); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php 
                    // 6. Author Box
                    if ( function_exists('mds_single_author_box') ) {
                        mds_single_author_box(); 
                    }
                    ?>

                    <?php 
                    // 7. Related Posts
                    if ( function_exists('mds_single_related') ) {
                        mds_single_related(); 
                    }

                    // 8. Comments
                    if ( comments_open() || get_comments_number() ) : ?>
                        <div class="comments-area mt-16 p-8 bg-slate-50 dark:bg-slate-900/50 rounded-3xl border border-slate-100 dark:border-slate-800">
                            <?php comments_template(); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if ( $show_sidebar ) : ?>
                    <aside class="w-full lg:w-1/3 mt-12 lg:mt-0">
                        <div class="sticky top-24">
                            <?php get_sidebar(); ?>
                        </div>
                    </aside>
                <?php endif; ?>
            </div>

        </article>
    </div>
</main>

<?php 
endwhile; 

get_footer();
