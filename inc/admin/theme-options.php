<?php
/**
 * Theme Options Panel using native WordPress Settings API
 */

function mds_pro_add_admin_menu() {
    add_menu_page(
        __( 'Mundial de Salsa Options', 'mundialdesalsa-pro' ),
        __( 'MDS Options', 'mundialdesalsa-pro' ),
        'manage_options',
        'mds_pro_options',
        'mds_pro_options_page',
        'dashicons-layout',
        2
    );
}
add_action( 'admin_menu', 'mds_pro_add_admin_menu' );

function mds_pro_options_page() {
    ?>
    <div class="wrap">
        <h1><?php _e( 'Mundial de Salsa Magazine Pro Options', 'mundialdesalsa-pro' ); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields( 'mds_pro_options_group' );
            do_settings_sections( 'mds_pro_options' );
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function mds_pro_settings_init() {
    // General
    register_setting( 'mds_pro_options_group', 'mds_header_layout' );
    register_setting( 'mds_pro_options_group', 'mds_primary_color' );
    register_setting( 'mds_pro_options_group', 'mds_dark_mode' );
    
    // Layouts
    register_setting( 'mds_pro_options_group', 'mds_archive_layout' );
    register_setting( 'mds_pro_options_group', 'mds_single_layout' );
    
    // Performance
    register_setting( 'mds_pro_options_group', 'mds_lazy_load' );
    register_setting( 'mds_pro_options_group', 'mds_infinite_scroll' );

    add_settings_section(
        'mds_pro_general_section',
        __( 'General Settings', 'mundialdesalsa-pro' ),
        null,
        'mds_pro_options'
    );

    add_settings_section(
        'mds_pro_layout_section',
        __( 'Layout Settings', 'mundialdesalsa-pro' ),
        null,
        'mds_pro_options'
    );

    // Fields...
    add_settings_field(
        'mds_header_layout',
        __( 'Header Layout', 'mundialdesalsa-pro' ),
        'mds_header_layout_render',
        'mds_pro_options',
        'mds_pro_general_section'
    );

    add_settings_field(
        'mds_archive_layout',
        __( 'Default Archive Layout', 'mundialdesalsa-pro' ),
        'mds_archive_layout_render',
        'mds_pro_options',
        'mds_pro_layout_section'
    );
}

function mds_archive_layout_render() {
    $val = get_option( 'mds_archive_layout', 'grid' );
    ?>
    <select name="mds_archive_layout">
        <option value="grid" <?php selected( $val, 'grid' ); ?>>Grid Layout</option>
        <option value="list" <?php selected( $val, 'list' ); ?>>List Layout</option>
        <option value="masonry" <?php selected( $val, 'masonry' ); ?>>Masonry Layout</option>
        <option value="magazine" <?php selected( $val, 'magazine' ); ?>>Magazine Grid</option>
    </select>
    <?php
}
add_action( 'admin_init', 'mds_pro_settings_init' );

function mds_header_layout_render() {
    $val = get_option( 'mds_header_layout', 'header-1' );
    ?>
    <select name="mds_header_layout">
        <option value="header-1" <?php selected( $val, 'header-1' ); ?>>Layout 1: Logo Left + Menu Right</option>
        <option value="header-2" <?php selected( $val, 'header-2' ); ?>>Layout 2: Centered Logo</option>
        <option value="header-3" <?php selected( $val, 'header-3' ); ?>>Layout 3: Top Bar + Logo Left</option>
    </select>
    <?php
}
