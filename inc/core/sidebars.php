<?php
/**
 * Register widget areas.
 */
function mds_pro_widgets_init() {
	register_sidebar( [
		'name'          => esc_html__( 'Main Sidebar', 'mundialdesalsa-pro' ),
		'id'            => 'main-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'mundialdesalsa-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	] );

	register_sidebar( [
		'name'          => esc_html__( 'Footer Column 1', 'mundialdesalsa-pro' ),
		'id'            => 'footer-1',
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="footer-widget-title">',
		'after_title'   => '</h3>',
	] );

    // Additional footer columns...
}
add_action( 'widgets_init', 'mds_pro_widgets_init' );
