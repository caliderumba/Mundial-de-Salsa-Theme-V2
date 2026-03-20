<?php
/**
 * The main homepage template file
 *
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

/**
 * 2. Hero Slider Logic (Destacados)
 */
$destacados_cat_id = get_cat_ID('Destacados');
$slider_query = new WP_Query( array(
    'cat'            => $destacados_cat_id,
    'posts_per_page' => 3,
    'post_status'    => 'publish',
    'no_found_rows'  => true,
) );

$slider_ids = array();
?>

<main id="primary" class="site-main">

    <?php /* HERO SLIDER SECTION */ ?>
    <?php if ( $slider_query->have_posts() ) : ?>
        <section class="hero-slider relative h-[650px] bg-black overflow-hidden">
            <div class="slider-wrapper h-full">
                <?php while ( $slider_query->have_posts() ) : $slider_query->the_post(); 
                    $slider_ids[] = get_the_ID();
                ?>
                    <div class="slider-slide absolute inset-0 opacity-0 transition-opacity duration-1000 ease-in-out flex items-center" 
                         style="background: linear-gradient(to right, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.7) 100%), url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>') center/cover no-repeat;">
                        <div class="container mx-auto px-4">
                            <div class="max-w-4xl">
                                <span class="inline-block bg-[#e74c3c] text-white text-[10px] font-black uppercase tracking-[0.3em] px-4 py-1.5 mb-6">
                                    <?php esc_html_e( 'Destacado', 'mundialdesalsa-pro' ); ?>
                                </span>
                                <h2 class="text-5xl md:text-8xl font-black uppercase italic tracking-tighter text-[#e74c3c] mb-6 leading-[0.85]">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <div class="flex items-center gap-4 text-white/50 text-[11px] font-black uppercase tracking-widest mb-8">
                                    <span class="flex items-center gap-2">
                                        <i class="fa-regular fa-user text-[#e74c3c]"></i> <?php the_author(); ?>
                                    </span>
                                    <span class="w-1 h-1 bg-white/20 rounded-full"></span>
                                    <span class="flex items-center gap-2">
                                        <i class="fa-regular fa-calendar text-[#e74c3c]"></i> <?php echo get_the_date(); ?>
                                    </span>
                                </div>
                                <p class="text-white/80 text-lg md:text-xl font-medium max-w-2xl mb-10 line-clamp-3 leading-relaxed">
                                    <?php echo wp_trim_words( get_the_excerpt(), 25 ); ?>
                                </p>
                                <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-3 bg-[#e74c3c] text-white px-10 py-5 font-black uppercase tracking-widest hover:bg-white hover:text-black transition-all duration-500 group">
                                    <?php esc_html_e( 'Leer Noticia', 'mundialdesalsa-pro' ); ?>
                                    <i class="fa-solid fa-arrow-right group-hover:translate-x-2 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>

            <div class="slider-controls absolute bottom-12 left-1/2 -translate-x-1/2 flex gap-4 z-20">
                <?php for($i=0; $i<$slider_query->post_count; $i++): ?>
                    <button class="slider-dot w-16 h-1.5 bg-white/20 hover:bg-[#e74c3c] transition-all duration-300" data-index="<?php echo $i; ?>"></button>
                <?php endfor; ?>
            </div>
        </section>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const slides = document.querySelectorAll('.slider-slide');
                const dots = document.querySelectorAll('.slider-dot');
                let current = 0;

                function showSlide(index) {
                    slides.forEach(s => s.style.opacity = '0');
                    dots.forEach(d => d.style.backgroundColor = 'rgba(255,255,255,0.2)');
                    slides[index].style.opacity = '1';
                    dots[index].style.backgroundColor = '#e74c3c';
                    dots[index].style.width = '24px';
                    dots.forEach((d, i) => { if(i !== index) d.style.width = '16px'; });
                }

                function nextSlide() {
                    current = (current + 1) % slides.length;
                    showSlide(current);
                }

                dots.forEach((dot, index) => {
                    dot.addEventListener('click', () => {
                        current = index;
                        showSlide(current);
                    });
                });

                showSlide(0);
                setInterval(nextSlide, 6000);
            });
        </script>
    <?php endif; ?>

    <?php /* NEWS GRID SECTION */ ?>
    <section class="news-grid py-24 bg-slate-50 dark:bg-slate-900">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16 gap-6">
                <div class="section-header">
                    <span class="text-[11px] font-black uppercase tracking-[0.4em] text-[#e74c3c] mb-4 block">Magazine Pro</span>
                    <h2 class="text-5xl md:text-6xl font-black uppercase italic tracking-tighter text-slate-900 dark:text-white leading-none">
                        Últimas <span class="text-[#e74c3c]">Noticias</span>
                    </h2>
                </div>
                <div class="flex gap-4">
                    <a href="#" class="px-6 py-3 border-2 border-slate-200 dark:border-white/10 text-[10px] font-black uppercase tracking-widest hover:border-[#e74c3c] hover:text-[#e74c3c] transition-all">Ver Todas</a>
                </div>
            </div>

            <?php
            $news_query = new WP_Query( array(
                'post_type'      => 'post',
                'posts_per_page' => 8,
                'post__not_in'   => $slider_ids,
                'post_status'    => 'publish',
                'no_found_rows'  => true,
            ) );

            if ( $news_query->have_posts() ) : ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    <?php while ( $news_query->have_posts() ) : $news_query->the_post(); ?>
                        <article class="news-card group bg-white dark:bg-slate-800 rounded-[8px] overflow-hidden shadow-[0_4px_15px_rgba(231,76,60,0.15)] hover:-translate-y-2 transition-all duration-500">
                            <div class="card-thumb relative h-64 overflow-hidden">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail('medium_large', array('class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-700')); ?>
                                <?php endif; ?>
                                <div class="absolute top-5 left-5">
                                    <?php
                                    $cats = get_the_category();
                                    if ( ! empty( $cats ) ) : ?>
                                        <span class="bg-[#e74c3c] text-white text-[9px] font-black uppercase px-3 py-1 tracking-widest">
                                            <?php echo esc_html( $cats[0]->name ); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="card-content p-8">
                                <h3 class="text-2xl font-black uppercase italic tracking-tight text-slate-900 dark:text-white mb-6 line-clamp-2 leading-tight group-hover:text-[#e74c3c] transition-colors">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <div class="flex items-center justify-between">
                                    <div class="author-info flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-[#e74c3c]/20">
                                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 40 ); ?>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-[11px] font-black uppercase tracking-wider text-slate-900 dark:text-white"><?php the_author(); ?></span>
                                            <span class="text-[9px] uppercase text-slate-400 font-bold"><?php echo get_the_date(); ?></span>
                                        </div>
                                    </div>
                                    <a href="<?php the_permalink(); ?>" class="text-[#e74c3c] hover:translate-x-1 transition-transform">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php /* MODULAR CATEGORY SECTIONS */ ?>
    <section class="category-blocks py-24 bg-white dark:bg-slate-950">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
                
                <?php
                $blocks = [
                    ['title' => 'Orquestas', 'cat' => get_cat_ID('Orquestas')],
                    ['title' => 'Feria de Cali', 'cat' => 76],
                    ['title' => 'Escuelas', 'cat' => get_cat_ID('Escuelas')]
                ];

                foreach($blocks as $block):
                ?>
                    <div class="cat-block">
                        <div class="flex items-center gap-5 mb-10">
                            <h3 class="text-3xl font-black uppercase italic tracking-tighter text-slate-900 dark:text-white"><?php echo $block['title']; ?></h3>
                            <div class="flex-1 h-0.5 bg-[#e74c3c]/20"></div>
                        </div>

                        <?php
                        $block_query = new WP_Query( array(
                            'cat'            => $block['cat'],
                            'posts_per_page' => 3,
                            'post_status'    => 'publish',
                            'no_found_rows'  => true,
                        ) );

                        if ( $block_query->have_posts() ) : 
                            $is_feria = ($block['cat'] == 76);
                            ?>
                            <ul class="<?php echo $is_feria ? 'feria-news-list' : ''; ?> divide-y divide-slate-100 dark:divide-white/5">
                                <?php while ( $block_query->have_posts() ) : $block_query->the_post(); ?>
                                    <li class="py-5 group">
                                        <?php if ($is_feria) : ?>
                                            <a href="<?php the_permalink(); ?>" class="block font-bold text-slate-900 dark:text-white hover:text-[#e74c3c] transition-colors mb-1">
                                                <?php the_title(); ?>
                                            </a>
                                            <span class="text-[11px] text-slate-400">
                                                <?php echo get_the_date('j \d\e F, Y'); ?>
                                            </span>
                                        <?php else : ?>
                                            <a href="<?php the_permalink(); ?>" class="block">
                                                <h4 class="text-[14px] font-black uppercase italic tracking-tight text-slate-800 dark:text-white/80 group-hover:text-[#e74c3c] transition-colors leading-snug mb-2">
                                                    <?php the_title(); ?>
                                                </h4>
                                                <div class="flex items-center gap-3 text-[9px] font-bold uppercase tracking-widest text-slate-400">
                                                    <span><?php echo get_the_date(); ?></span>
                                                    <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                                                    <span><?php the_author(); ?></span>
                                                </div>
                                            </a>
                                        <?php endif; ?>
                                    </li>
                                <?php endwhile; wp_reset_postdata(); ?>
                            </ul>
                            <?php if ($is_feria) : ?>
                                <div class="text-center mt-10">
                                    <a href="<?php echo get_category_link($block['cat']); ?>" class="btn-vibrante">
                                        <?php esc_html_e( 'Explorar Feria', 'mundialdesalsa-pro' ); ?>
                                    </a>
                                </div>
                            <?php else : ?>
                                <a href="<?php echo get_category_link($block['cat']); ?>" class="inline-block mt-8 text-[10px] font-black uppercase tracking-[0.25em] text-[#e74c3c] hover:text-slate-900 dark:hover:text-white transition-colors">
                                    Explorar Más <i class="fa-solid fa-plus ml-1"></i>
                                </a>
                            <?php endif; ?>
                        <?php else: ?>
                            <p class="text-xs text-slate-400 italic"><?php esc_html_e( 'No hay noticias recientes en esta sección.', 'mundialdesalsa-pro' ); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </section>

</main>

<?php
get_footer();
