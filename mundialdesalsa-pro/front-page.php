<?php
/**
 * The front page template file
 *
 * @package MundialdeSalsa_Pro
 */

get_header();

global $mds_pro_options;

/**
 * Helper function to inject related articles between silos
 */
function mds_pro_inject_related_silo( $category_slug, $count = 2 ) {
    $args = array(
        'category_name'  => $category_slug,
        'posts_per_page' => $count,
        'post__not_in'   => get_option( 'sticky_posts' ),
    );
    $query = new WP_Query( $args );

    if ( $query->have_posts() ) : ?>
        <div class="silo-interlinking my-8 p-6 bg-gray-50 rounded-[var(--mds-radius)] border-l-4 border-[var(--mds-primary)]">
            <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 block">Te puede interesar:</span>
            <ul class="space-y-2">
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <li>
                        <a href="<?php the_permalink(); ?>" class="text-sm font-bold hover:text-[var(--mds-primary)] transition-colors">
                            <i class="fas fa-chevron-right text-[10px] mr-2 text-salsa"></i><?php the_title(); ?>
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
    <?php endif;
    wp_reset_postdata();
}
?>

<div class="front-page-wrapper py-12">
    <div class="container mx-auto px-4">
        
        <?php
        /**
         * Standard WordPress Loop for Page Content
         * This allows Gutenberg blocks and editor content to appear on the homepage.
         */
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                if ( ! empty( get_the_content() ) ) :
                    ?>
                    <div class="front-page-editor-content mb-16 prose prose-slate dark:prose-invert max-w-none">
                        <?php the_content(); ?>
                    </div>
                    <?php
                endif;
            endwhile;
        endif;
        ?>
        
        <?php
        /**
         * Hardcoded Category Sections
         * These can be disabled from the Theme Options Panel.
         */
        if ( mds_pro_get_option( 'show_front_page_sections', true ) ) :
        ?>
            <!-- SECTION 1: 70% - Mundial de Salsa -->
        <section class="section-mundial mb-16">
            <div class="flex items-center justify-between mb-8 border-b-2 border-gray-100 pb-4">
                <h2 class="text-3xl font-black uppercase tracking-tighter">
                    Mundial de <span class="text-[var(--mds-primary)]">Salsa</span>
                </h2>
                <a href="<?php echo get_category_link( get_category_by_slug('mundial-de-salsa') ); ?>" class="text-xs font-bold uppercase tracking-widest hover:text-[var(--mds-primary)]">Ver todo</a>
            </div>

            <div class="flex flex-wrap -mx-[calc(var(--mds-gap)/2)]">
                <?php
                $args_salsa = array(
                    'category_name'  => 'mundial-de-salsa',
                    'posts_per_page' => 3,
                );
                $query_salsa = new WP_Query( $args_salsa );
                $count = 0;

                if ( $query_salsa->have_posts() ) :
                    while ( $query_salsa->have_posts() ) : $query_salsa->the_post();
                        if ( 0 === $count ) : ?>
                            <!-- Left: Big Featured Post -->
                            <div class="w-full lg:w-2/3 px-[calc(var(--mds-gap)/2)] mb-8 lg:mb-0">
                                <article class="relative h-[500px] rounded-[var(--mds-radius)] overflow-hidden group shadow-xl">
                                    <a href="<?php the_permalink(); ?>" class="block h-full w-full">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-full object-cover transition-transform duration-700 group-hover:scale-105' ) ); ?>
                                        <?php endif; ?>
                                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
                                        <div class="absolute bottom-0 left-0 p-8 md:p-12 w-full">
                                            <span class="inline-block bg-[var(--mds-primary)] text-white text-[10px] font-black uppercase px-4 py-1 rounded-full mb-4">Destacado</span>
                                            <h3 class="text-3xl md:text-5xl font-black text-white uppercase leading-tight mb-4 group-hover:text-[var(--mds-primary)] transition-colors">
                                                <?php the_title(); ?>
                                            </h3>
                                            <div class="text-gray-300 text-xs uppercase tracking-widest">
                                                <?php echo get_the_date(); ?> | <?php the_author(); ?>
                                            </div>
                                        </div>
                                    </a>
                                </article>
                            </div>
                            <div class="w-full lg:w-1/3 px-[calc(var(--mds-gap)/2)] flex flex-col gap-[var(--mds-gap)]">
                        <?php else : ?>
                            <!-- Right: Small Posts -->
                            <article class="relative h-[238px] rounded-[var(--mds-radius)] overflow-hidden group shadow-md">
                                <a href="<?php the_permalink(); ?>" class="block h-full w-full">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-110' ) ); ?>
                                    <?php endif; ?>
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                                    <div class="absolute bottom-0 left-0 p-6 w-full">
                                        <h4 class="text-lg font-bold text-white uppercase leading-tight group-hover:text-[var(--mds-primary)] transition-colors">
                                            <?php the_title(); ?>
                                        </h4>
                                    </div>
                                </a>
                            </article>
                        <?php endif;
                        $count++;
                    endwhile;
                    echo '</div>'; // Close right column
                endif;
                wp_reset_postdata();
                ?>
            </div>

            <?php mds_pro_inject_related_silo( 'feria-de-cali', 2 ); ?>
        </section>

        <!-- SECTION 2: 20% - Feria de Cali -->
        <section class="section-feria mb-16 bg-gray-900 -mx-4 px-4 py-16 text-white rounded-[var(--mds-radius)]">
            <div class="container mx-auto">
                <div class="flex items-center justify-between mb-12 border-b border-white/10 pb-4">
                    <h2 class="text-3xl font-black uppercase tracking-tighter">
                        Feria de <span class="text-[var(--mds-primary)]">Cali</span>
                    </h2>
                    <a href="<?php echo get_category_link( get_category_by_slug('feria-de-cali') ); ?>" class="text-xs font-bold uppercase tracking-widest hover:text-[var(--mds-primary)]">Explorar Feria</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-[var(--mds-gap)]">
                    <?php
                    $args_feria = array(
                        'category_name'  => 'feria-de-cali',
                        'posts_per_page' => 3,
                    );
                    $query_feria = new WP_Query( $args_feria );

                    if ( $query_feria->have_posts() ) :
                        while ( $query_feria->have_posts() ) : $query_feria->the_post(); ?>
                            <article class="group">
                                <a href="<?php the_permalink(); ?>" class="block">
                                    <div class="aspect-video mb-6 overflow-hidden rounded-[var(--mds-radius)] bg-gray-800">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-110' ) ); ?>
                                        <?php endif; ?>
                                    </div>
                                    <h3 class="text-xl font-black uppercase mb-3 transition-colors group-hover:text-[var(--mds-primary)]">
                                        <?php the_title(); ?>
                                    </h3>
                                    <div class="text-gray-400 text-[10px] uppercase tracking-widest">
                                        <?php echo get_the_date(); ?>
                                    </div>
                                </a>
                            </article>
                        <?php endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </section>

        <!-- SECTION 3: 10% - Petronio & Blog -->
        <section class="section-bottom">
            <div class="flex flex-wrap -mx-4">
                <!-- Petronio Column -->
                <div class="w-full md:w-1/2 px-4 mb-8 md:mb-0">
                    <div class="p-8 bg-white border-t-4 border-salsa rounded-[var(--mds-radius)] shadow-sm">
                        <h2 class="text-xl font-black uppercase tracking-tighter mb-6 flex items-center gap-2">
                            <i class="fas fa-drum text-salsa"></i> Petronio Álvarez
                        </h2>
                        <ul class="space-y-4">
                            <?php
                            $args_petronio = array(
                                'category_name'  => 'petronio',
                                'posts_per_page' => 4,
                            );
                            $query_petronio = new WP_Query( $args_petronio );

                            if ( $query_petronio->have_posts() ) :
                                while ( $query_petronio->have_posts() ) : $query_petronio->the_post(); ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>" class="text-sm font-bold uppercase hover:text-[var(--mds-primary)] transition-colors block border-b border-gray-50 pb-2">
                                            <?php the_title(); ?>
                                        </a>
                                    </li>
                                <?php endwhile;
                            endif;
                            wp_reset_postdata();
                            ?>
                        </ul>
                    </div>
                </div>

                <!-- Blog Column -->
                <div class="w-full md:w-1/2 px-4">
                    <div class="p-8 bg-white border-t-4 border-gray-900 rounded-[var(--mds-radius)] shadow-sm">
                        <h2 class="text-xl font-black uppercase tracking-tighter mb-6 flex items-center gap-2">
                            <i class="fas fa-pen-nib text-gray-900"></i> Blog & Notas
                        </h2>
                        <ul class="space-y-4">
                            <?php
                            $args_blog = array(
                                'category_name'  => 'blog',
                                'posts_per_page' => 4,
                            );
                            $query_blog = new WP_Query( $args_blog );

                            if ( $query_blog->have_posts() ) :
                                while ( $query_blog->have_posts() ) : $query_blog->the_post(); ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>" class="text-sm font-bold uppercase hover:text-[var(--mds-primary)] transition-colors block border-b border-gray-50 pb-2">
                                            <?php the_title(); ?>
                                        </a>
                                    </li>
                                <?php endwhile;
                            endif;
                            wp_reset_postdata();
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <?php endif; // End show_front_page_sections check ?>
    </div>
</div>

<?php
get_footer();
