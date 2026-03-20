<?php
/**
 * Single Post Template - Impactful & Vibrant
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

// Access Redux Global Options
global $opt_mundial;
$show_sidebar = isset($opt_mundial['single_post_sidebar']) ? $opt_mundial['single_post_sidebar'] : true;
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
                <div class="post-layout-wrapper <?php echo $show_sidebar ? 'grid grid-cols-1 lg:grid-cols-12 gap-12' : 'full-width-content'; ?>">
                    
                    <!-- Main Content Column -->
                    <div class="<?php echo $show_sidebar ? 'lg:col-span-8' : 'max-w-4xl mx-auto'; ?>">
                        <div class="entry-content prose prose-lg dark:prose-invert max-w-none">
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
                        <div class="author-box mt-16 p-8 md:p-10 bg-slate-50 dark:bg-white/5 rounded-3xl border border-slate-100 dark:border-white/5 flex flex-col md:flex-row items-center md:items-start gap-8">
                            <div class="author-avatar shrink-0">
                                <?php echo get_avatar( get_the_author_meta( 'ID' ), 100, '', '', array('class' => 'rounded-full border-4 border-white dark:border-slate-800 shadow-lg') ); ?>
                            </div>
                            <div class="author-info text-center md:text-left">
                                <span class="text-[10px] font-black uppercase tracking-widest text-[#e74c3c] mb-2 block">Escrito por</span>
                                <h4 class="text-2xl font-black uppercase tracking-tight text-slate-900 dark:text-white mb-4"><?php the_author(); ?></h4>
                                <p class="text-slate-600 dark:text-slate-400 leading-relaxed mb-6">
                                    <?php the_author_meta( 'description' ); ?>
                                </p>
                                <div class="author-social flex items-center justify-center md:justify-start gap-4">
                                    <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="text-xs font-bold uppercase tracking-widest text-slate-400 hover:text-[#e74c3c] transition-colors">Ver Perfil</a>
                                </div>
                            </div>
                        </div>

                        <!-- Comments -->
                        <?php
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                        ?>
                    </div>

                    <!-- Sidebar Column -->
                    <?php if ( $show_sidebar ) : ?>
                        <aside class="lg:col-span-4">
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
