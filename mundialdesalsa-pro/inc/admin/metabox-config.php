<?php
/**
 * Redux Metaboxes Configuration
 * Theme: Mundial de Salsa Pro
 */

if ( ! class_exists( 'Redux_Metaboxes' ) ) {
    return;
}

$opt_name = "mds_pro_options";

// Define the Metabox
$metabox = array(
    'id'         => 'mds_pro_post_options',
    'title'      => __( 'Opciones Avanzadas de Entrada', 'mundialdesalsa-pro' ),
    'post_types' => array( 'post' ),
    'position'   => 'normal', // normal, advanced, side
    'priority'   => 'high',   // high, core, default, low
    'sections'   => array(
        // Section: Video Format
        array(
            'title'  => __( 'Video Format', 'mundialdesalsa-pro' ),
            'id'     => 'mds_section_video',
            'icon'   => 'el el-video',
            'fields' => array(
                array(
                    'id'       => 'mds_post_video_url',
                    'type'     => 'text',
                    'title'    => __( 'Video URL (YouTube/Vimeo)', 'mundialdesalsa-pro' ),
                    'subtitle' => __( 'Pega el enlace directo del video.', 'mundialdesalsa-pro' ),
                    'validate' => 'url',
                ),
                array(
                    'id'       => 'mds_post_video_embed',
                    'type'     => 'textarea',
                    'title'    => __( 'Iframe Embed Code', 'mundialdesalsa-pro' ),
                    'subtitle' => __( 'Pega el código iframe si prefieres un embed personalizado.', 'mundialdesalsa-pro' ),
                ),
                array(
                    'id'       => 'mds_post_video_self',
                    'type'     => 'media',
                    'url'      => true,
                    'title'    => __( 'Self-Hosted Video (MP4)', 'mundialdesalsa-pro' ),
                    'mode'     => 'video',
                ),
                array(
                    'id'       => 'mds_post_video_layout',
                    'type'     => 'image_select',
                    'title'    => __( 'Video Layout', 'mundialdesalsa-pro' ),
                    'subtitle' => __( 'Elige cómo se verá el reproductor en la parte superior.', 'mundialdesalsa-pro' ),
                    'options'  => array(
                        'full'     => array(
                            'alt' => 'Full Width',
                            'img' => 'https://placehold.co/200x100/e74c3c/ffffff?text=Full+Width',
                        ),
                        'boxed'    => array(
                            'alt' => 'Boxed',
                            'img' => 'https://placehold.co/200x100/e74c3c/ffffff?text=Boxed',
                        ),
                        'sidebar'  => array(
                            'alt' => 'With Sidebar',
                            'img' => 'https://placehold.co/200x100/e74c3c/ffffff?text=Sidebar',
                        ),
                    ),
                    'default'  => 'full',
                ),
            ),
        ),
        // Section: Featured Image & Tagline
        array(
            'title'  => __( 'Featured & Tagline', 'mundialdesalsa-pro' ),
            'id'     => 'mds_section_featured',
            'icon'   => 'el el-picture',
            'fields' => array(
                array(
                    'id'       => 'mds_post_crop_size',
                    'type'     => 'select',
                    'title'    => __( 'Custom Crop Size', 'mundialdesalsa-pro' ),
                    'options'  => array(
                        'featured-main' => 'Featured Main (1200x600)',
                        'card-thumb'    => 'Card Thumb (400x250)',
                        'full'          => 'Original Size',
                    ),
                    'default'  => 'featured-main',
                ),
                array(
                    'id'       => 'mds_post_img_caption',
                    'type'     => 'text',
                    'title'    => __( 'Caption Text', 'mundialdesalsa-pro' ),
                ),
                array(
                    'id'       => 'mds_post_img_attribution',
                    'type'     => 'text',
                    'title'    => __( 'Attribution (Créditos)', 'mundialdesalsa-pro' ),
                    'placeholder' => 'Ej: Foto por Juan Pérez',
                ),
                array(
                    'id'       => 'mds_post_tagline',
                    'type'     => 'text',
                    'title'    => __( 'Tagline / Bajada', 'mundialdesalsa-pro' ),
                ),
                array(
                    'id'       => 'mds_post_tagline_tag',
                    'type'     => 'select',
                    'title'    => __( 'HTML Tag para Tagline', 'mundialdesalsa-pro' ),
                    'options'  => array(
                        'h2' => 'H2',
                        'h3' => 'H3',
                        'p'  => 'Párrafo (p)',
                    ),
                    'default'  => 'p',
                ),
                array(
                    'id'       => 'mds_post_highlights',
                    'type'     => 'multi_text',
                    'title'    => __( 'Post Highlights', 'mundialdesalsa-pro' ),
                    'subtitle' => __( 'Añade puntos clave destacados de la noticia.', 'mundialdesalsa-pro' ),
                ),
            ),
        ),
        // Section: Layout & Categorization
        array(
            'title'  => __( 'Categorización Pro', 'mundialdesalsa-pro' ),
            'id'     => 'mds_section_tax',
            'icon'   => 'el el-tags',
            'fields' => array(
                array(
                    'id'       => 'mds_primary_category',
                    'type'     => 'select',
                    'title'    => __( 'Categoría Principal', 'mundialdesalsa-pro' ),
                    'data'     => 'categories',
                    'subtitle' => __( 'Esta categoría aparecerá destacada en las tarjetas.', 'mundialdesalsa-pro' ),
                ),
                array(
                    'id'       => 'mds_primary_tag',
                    'type'     => 'select',
                    'title'    => __( 'Tag Principal', 'mundialdesalsa-pro' ),
                    'data'     => 'tags',
                ),
            ),
        ),
        // Section: Multimedia (Audio & Gallery)
        array(
            'title'  => __( 'Multimedia', 'mundialdesalsa-pro' ),
            'id'     => 'mds_section_multimedia',
            'icon'   => 'el el-mic',
            'fields' => array(
                array(
                    'id'    => 'mds_audio_divider',
                    'type'  => 'section',
                    'title' => __( 'Audio Settings', 'mundialdesalsa-pro' ),
                    'indent' => true,
                ),
                array(
                    'id'       => 'mds_post_audio_url',
                    'type'     => 'text',
                    'title'    => __( 'SoundCloud / Audio URL', 'mundialdesalsa-pro' ),
                ),
                array(
                    'id'       => 'mds_post_audio_embed',
                    'type'     => 'textarea',
                    'title'    => __( 'Audio Embed Code', 'mundialdesalsa-pro' ),
                ),
                array(
                    'id'       => 'mds_post_audio_file',
                    'type'     => 'media',
                    'title'    => __( 'Local Audio File', 'mundialdesalsa-pro' ),
                    'mode'     => 'audio',
                ),
                array(
                    'id'       => 'mds_post_audio_layout',
                    'type'     => 'button_set',
                    'title'    => __( 'Audio Player Layout', 'mundialdesalsa-pro' ),
                    'options'  => array(
                        'minimal' => 'Minimal',
                        'full'    => 'Full Player',
                        'sticky'  => 'Sticky Bottom',
                    ),
                    'default'  => 'minimal',
                ),
                array(
                    'id'    => 'mds_gallery_divider',
                    'type'  => 'section',
                    'title' => __( 'Gallery Settings', 'mundialdesalsa-pro' ),
                    'indent' => true,
                ),
                array(
                    'id'       => 'mds_post_gallery',
                    'type'     => 'gallery',
                    'title'    => __( 'Galería de Fotos', 'mundialdesalsa-pro' ),
                    'subtitle' => __( 'Sube fotos de orquestas y bailarines.', 'mundialdesalsa-pro' ),
                ),
                array(
                    'id'       => 'mds_post_gallery_layout',
                    'type'     => 'button_set',
                    'title'    => __( 'Gallery Display', 'mundialdesalsa-pro' ),
                    'options'  => array(
                        'grid'   => 'Grid',
                        'slider' => 'Slider',
                        'masonry' => 'Masonry',
                    ),
                    'default'  => 'grid',
                ),
            ),
        ),
        // Section: Sources / Via
        array(
            'title'  => __( 'Sources & Via', 'mundialdesalsa-pro' ),
            'id'     => 'mds_section_sources',
            'icon'   => 'el el-link',
            'fields' => array(
                array(
                    'id'       => 'mds_post_sources',
                    'type'     => 'multi_text',
                    'title'    => __( 'Fuentes (Sources)', 'mundialdesalsa-pro' ),
                    'subtitle' => __( 'Añade los nombres de las fuentes.', 'mundialdesalsa-pro' ),
                ),
                array(
                    'id'       => 'mds_post_source_links',
                    'type'     => 'multi_text',
                    'title'    => __( 'Enlaces de Fuentes', 'mundialdesalsa-pro' ),
                    'subtitle' => __( 'Añade los enlaces correspondientes en el mismo orden.', 'mundialdesalsa-pro' ),
                    'validate' => 'url',
                ),
            ),
        ),
    ),
);

Redux_Metaboxes::setBox( $opt_name, $metabox );
