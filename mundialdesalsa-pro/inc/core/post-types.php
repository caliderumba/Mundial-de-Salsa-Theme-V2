<?php
/**
 * Register Custom Post Types
 */

function mds_pro_register_post_types() {
    // Events
    register_post_type( 'event', array(
        'labels' => array(
            'name'               => __( 'Eventos', 'mundialdesalsa-pro' ),
            'singular_name'      => __( 'Evento', 'mundialdesalsa-pro' ),
            'add_new'            => __( 'Añadir Nuevo', 'mundialdesalsa-pro' ),
            'add_new_item'       => __( 'Añadir Nuevo Evento', 'mundialdesalsa-pro' ),
            'edit_item'          => __( 'Editar Evento', 'mundialdesalsa-pro' ),
            'new_item'           => __( 'Nuevo Evento', 'mundialdesalsa-pro' ),
            'view_item'          => __( 'Ver Evento', 'mundialdesalsa-pro' ),
            'search_items'       => __( 'Buscar Eventos', 'mundialdesalsa-pro' ),
            'not_found'          => __( 'No se encontraron eventos', 'mundialdesalsa-pro' ),
            'not_found_in_trash' => __( 'No hay eventos en la papelera', 'mundialdesalsa-pro' ),
        ),
        'public'              => true,
        'has_archive'         => true,
        'rewrite'             => array( 'slug' => 'eventos' ),
        'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
        'menu_icon'           => 'dashicons-calendar-alt',
        'show_in_rest'        => true,
    ) );

    // Academies
    register_post_type( 'academy', array(
        'labels' => array(
            'name'               => __( 'Academias', 'mundialdesalsa-pro' ),
            'singular_name'      => __( 'Academia', 'mundialdesalsa-pro' ),
            'add_new'            => __( 'Añadir Nueva', 'mundialdesalsa-pro' ),
            'add_new_item'       => __( 'Añadir Nueva Academia', 'mundialdesalsa-pro' ),
            'edit_item'          => __( 'Editar Academia', 'mundialdesalsa-pro' ),
            'new_item'           => __( 'Nueva Academia', 'mundialdesalsa-pro' ),
            'view_item'          => __( 'Ver Academia', 'mundialdesalsa-pro' ),
            'search_items'       => __( 'Buscar Academias', 'mundialdesalsa-pro' ),
            'not_found'          => __( 'No se encontraron academias', 'mundialdesalsa-pro' ),
            'not_found_in_trash' => __( 'No hay academias en la papelera', 'mundialdesalsa-pro' ),
        ),
        'public'              => true,
        'has_archive'         => true,
        'rewrite'             => array( 'slug' => 'academias' ),
        'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
        'menu_icon'           => 'dashicons-welcome-learn-more',
        'show_in_rest'        => true,
    ) );

    // Artists
    register_post_type( 'artist', array(
        'labels' => array(
            'name'               => __( 'Artistas', 'mundialdesalsa-pro' ),
            'singular_name'      => __( 'Artista', 'mundialdesalsa-pro' ),
            'add_new'            => __( 'Añadir Nuevo', 'mundialdesalsa-pro' ),
            'add_new_item'       => __( 'Añadir Nuevo Artista', 'mundialdesalsa-pro' ),
            'edit_item'          => __( 'Editar Artista', 'mundialdesalsa-pro' ),
            'new_item'           => __( 'Nuevo Artista', 'mundialdesalsa-pro' ),
            'view_item'          => __( 'Ver Artista', 'mundialdesalsa-pro' ),
            'search_items'       => __( 'Buscar Artistas', 'mundialdesalsa-pro' ),
            'not_found'          => __( 'No se encontraron artistas', 'mundialdesalsa-pro' ),
            'not_found_in_trash' => __( 'No hay artistas en la papelera', 'mundialdesalsa-pro' ),
        ),
        'public'              => true,
        'has_archive'         => true,
        'rewrite'             => array( 'slug' => 'artistas' ),
        'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
        'menu_icon'           => 'dashicons-groups',
        'show_in_rest'        => true,
    ) );
}
add_action( 'init', 'mds_pro_register_post_types' );

/**
 * Register Taxonomies
 */
function mds_pro_register_taxonomies() {
    // Event Categories
    register_taxonomy( 'event_cat', 'event', array(
        'labels' => array(
            'name'          => __( 'Categorías de Eventos', 'mundialdesalsa-pro' ),
            'singular_name' => __( 'Categoría de Evento', 'mundialdesalsa-pro' ),
        ),
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite'      => array( 'slug' => 'categoria-evento' ),
    ) );

    // Artist Types
    register_taxonomy( 'artist_type', 'artist', array(
        'labels' => array(
            'name'          => __( 'Tipos de Artistas', 'mundialdesalsa-pro' ),
            'singular_name' => __( 'Tipo de Artista', 'mundialdesalsa-pro' ),
        ),
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite'      => array( 'slug' => 'tipo-artista' ),
    ) );
}
add_action( 'init', 'mds_pro_register_taxonomies' );
