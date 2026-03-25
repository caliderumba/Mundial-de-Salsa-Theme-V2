<?php
/**
 * Single Post Author Box - Mundial de Salsa Pro
 * 
 * Displays the author's avatar, name, and bio.
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$author_id   = get_the_author_meta( 'ID' );
$author_name = get_the_author_meta( 'display_name' );
$author_bio  = get_the_author_meta( 'description' );
$author_url  = get_author_posts_url( $author_id );
$author_avatar = get_avatar( $author_id, 120, '', $author_name, [ 'class' => 'rounded-full border-4 border-white dark:border-slate-800 shadow-xl' ] );

// Social Links (assuming theme options or user meta)
$social_links = [
    'facebook'  => get_the_author_meta( 'facebook_url' ),
    'twitter'   => get_the_author_meta( 'twitter_url' ),
    'instagram' => get_the_author_meta( 'instagram_url' ),
];
?>

<section class="author-box my-16 p-8 bg-slate-50 dark:bg-slate-900/50 rounded-3xl border border-slate-100 dark:border-slate-800 flex flex-col md:flex-row items-center md:items-start gap-8 transition-all hover:shadow-2xl hover:border-emerald-100 dark:hover:border-emerald-900/30">
    <div class="author-avatar flex-shrink-0">
        <a href="<?php echo esc_url( $author_url ); ?>" class="block transform transition-transform hover:scale-105">
            <?php echo $author_avatar; ?>
        </a>
    </div>

    <div class="author-info flex-grow text-center md:text-left">
        <div class="mb-2 flex flex-col md:flex-row md:items-center gap-2 md:gap-4">
            <h3 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">
                <a href="<?php echo esc_url( $author_url ); ?>" class="hover:text-emerald-600 transition-colors">
                    <?php echo esc_html( $author_name ); ?>
                </a>
            </h3>
            <span class="text-[10px] font-black uppercase tracking-[0.2em] text-emerald-600 bg-emerald-50 dark:bg-emerald-900/20 px-3 py-1 rounded-full self-center md:self-auto">Autor</span>
        </div>

        <?php if ( ! empty( $author_bio ) ) : ?>
            <div class="author-bio text-slate-600 dark:text-slate-400 leading-relaxed mb-6 font-medium">
                <?php echo wp_kses_post( $author_bio ); ?>
            </div>
        <?php endif; ?>

        <div class="author-social flex items-center justify-center md:justify-start gap-4">
            <?php foreach ( $social_links as $network => $url ) : if ( ! empty( $url ) ) : ?>
                <a href="<?php echo esc_url( $url ); ?>" class="w-10 h-10 flex items-center justify-center rounded-full bg-white dark:bg-slate-800 text-slate-400 hover:text-emerald-600 hover:shadow-lg transition-all" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-<?php echo esc_attr( $network ); ?>"></i>
                </a>
            <?php endif; endforeach; ?>
            
            <a href="<?php echo esc_url( $author_url ); ?>" class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 hover:text-emerald-600 transition-colors">
                Ver todos los artículos <i class="fas fa-arrow-right ml-2 text-[8px]"></i>
            </a>
        </div>
    </div>
</section>
