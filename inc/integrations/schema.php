<?php
/**
 * SEO Schema Generator
 */

function mds_pro_generate_schema() {
    if ( ! is_singular() ) return;

    global $post;
    $schema = [
        '@context' => 'https://schema.org',
        '@type'    => 'NewsArticle',
        'headline' => get_the_title(),
        'datePublished' => get_the_date('c'),
        'dateModified'  => get_the_modified_date('c'),
        'author' => [
            '@type' => 'Person',
            'name'  => get_the_author(),
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name'  => get_bloginfo('name'),
            'logo'  => [
                '@type' => 'ImageObject',
                'url'   => get_site_icon_url(),
            ]
        ],
        'image' => get_the_post_thumbnail_url($post->ID, 'full'),
    ];

    // Add VideoObject if video exists
    $video_url = get_post_meta($post->ID, '_mds_video_url', true);
    if ( ! empty($video_url) ) {
        $schema['video'] = [
            '@type' => 'VideoObject',
            'name'  => get_the_title(),
            'contentUrl' => $video_url,
            'uploadDate' => get_the_date('c'),
        ];
    }

    echo '<script type="application/ld+json">' . json_encode($schema) . '</script>';
}
add_action( 'wp_head', 'mds_pro_generate_schema' );
