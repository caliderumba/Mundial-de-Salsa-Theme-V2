<?php
/**
 * Register widget area.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function mds_pro_widgets_init() {
	register_sidebar( [
		'name'          => esc_html__( 'Sidebar Principal', 'mundialdesalsa-pro' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Añade widgets aquí.', 'mundialdesalsa-pro' ),
		'before_widget' => '<section id="%1$s" class="widget bg-white dark:bg-slate-900 p-8 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-800 %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="text-xs font-black uppercase tracking-[0.3em] mb-8 text-slate-400 flex items-center gap-3"><span class="w-2 h-2 bg-emerald-500 rounded-full"></span>',
		'after_title'   => '</h3>',
	] );

    register_sidebar( [
		'name'          => esc_html__( 'Footer 1', 'mundialdesalsa-pro' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Widgets para la primera columna del footer.', 'mundialdesalsa-pro' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="text-white font-black uppercase tracking-widest text-xs mb-8 flex items-center gap-3"><span class="w-2 h-2 bg-emerald-500 rounded-full"></span>',
		'after_title'   => '</h4>',
	] );

    register_sidebar( [
		'name'          => esc_html__( 'Footer 2', 'mundialdesalsa-pro' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Widgets para la segunda columna del footer.', 'mundialdesalsa-pro' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="text-white font-black uppercase tracking-widest text-xs mb-8 flex items-center gap-3"><span class="w-2 h-2 bg-emerald-500 rounded-full"></span>',
		'after_title'   => '</h4>',
	] );
}
add_action( 'widgets_init', 'mds_pro_widgets_init' );
