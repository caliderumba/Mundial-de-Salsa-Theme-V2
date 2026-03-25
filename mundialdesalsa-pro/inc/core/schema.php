<?php
/**
 * MundialdeSalsa Pro Schema Engine
 * 
 * Centralized logic for JSON-LD Schema.
 * 
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Output JSON-LD Schema in wp_head
 */
function mds_output_schema() {
    // Allow disabling schema via filter
    if ( ! apply_filters( 'mds_enable_schema', true ) ) {
        return;
    }

    $graph = [];

    // 1. Organization
    $graph[] = mds_get_schema_organization();

    // 2. WebSite
    $graph[] = mds_get_schema_website();

    // 3. Breadcrumbs
    if ( function_exists( 'mds_get_breadcrumb_data' ) ) {
        $breadcrumbs = mds_get_breadcrumb_data();
        if ( ! empty( $breadcrumbs ) ) {
            $graph[] = mds_get_schema_breadcrumbs( $breadcrumbs );
        }
    }

    // 4. Singular Content
    if ( is_singular() ) {
        $post_id = get_the_ID();
        
        // WebPage Node
        $graph[] = mds_get_schema_webpage( $post_id );

        // Article/NewsArticle Node
        if ( is_singular( 'post' ) ) {
            $graph[] = mds_get_schema_article( $post_id );
            
            // VideoObject Node (if applicable)
            $video = mds_get_primary_video_data( $post_id );
            if ( $video['has_video'] ) {
                $graph[] = mds_get_schema_video( $post_id, $video );
            }
        }
    }

    if ( ! empty( $graph ) ) {
        echo "\n" . '<!-- MDS Pro Schema Graph -->' . "\n";
        echo '<script type="application/ld+json" id="mds-pro-schema-graph">' . "\n";
        echo wp_json_encode( [
            '@context' => 'https://schema.org',
            '@graph'   => array_values( array_filter( $graph ) )
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . "\n";
        echo '</script>' . "\n";
    }
}
add_action( 'wp_head', 'mds_output_schema' );

/**
 * Organization Schema
 */
function mds_get_schema_organization() {
    $site_url = trailingslashit( home_url() );
    $logo = function_exists('mds_pro_get_option') ? mds_pro_get_option( 'header_settings', 'header_logo', [] ) : [];
    
    $schema = [
        '@type' => 'Organization',
        '@id'   => $site_url . '#organization',
        'name'  => get_bloginfo( 'name' ),
        'url'   => $site_url,
    ];

    if ( ! empty( $logo['url'] ) ) {
        $schema['logo'] = [
            '@type' => 'ImageObject',
            'url'   => esc_url_raw( $logo['url'] ),
            'width' => 600,
            'height' => 60
        ];
    }

    // Social profiles
    $social = []; // Could be fetched from options
    if ( ! empty( $social ) ) {
        $schema['sameAs'] = $social;
    }

    return $schema;
}

/**
 * WebSite Schema
 */
function mds_get_schema_website() {
    $site_url = trailingslashit( home_url() );
    return [
        '@type' => 'WebSite',
        '@id'   => $site_url . '#website',
        'url'   => $site_url,
        'name'  => get_bloginfo( 'name' ),
        'publisher' => [
            '@id' => $site_url . '#organization'
        ],
        'potentialAction' => [
            '@type' => 'SearchAction',
            'target' => $site_url . '?s={search_term_string}',
            'query-input' => 'required name=search_term_string'
        ]
    ];
}

/**
 * WebPage Schema
 */
function mds_get_schema_webpage( $post_id ) {
    $permalink = get_permalink( $post_id );
    return [
        '@type' => 'WebPage',
        '@id'   => $permalink . '#webpage',
        'url'   => $permalink,
        'name'  => get_the_title( $post_id ),
        'isPartOf' => [
            '@id' => trailingslashit( home_url() ) . '#website'
        ],
        'breadcrumb' => [
            '@id' => $permalink . '#breadcrumb'
        ],
        'datePublished' => get_the_date( 'c', $post_id ),
        'dateModified'  => get_the_modified_date( 'c', $post_id ),
    ];
}

/**
 * Breadcrumb Schema
 */
function mds_get_schema_breadcrumbs( $items ) {
    $list_items = [];
    foreach ( $items as $index => $item ) {
        if ( empty( $item['url'] ) || empty( $item['text'] ) ) continue;
        
        $list_items[] = [
            '@type'    => 'ListItem',
            'position' => $index + 1,
            'item'     => [
                '@type' => 'WebPage',
                '@id'   => esc_url_raw( $item['url'] ),
                'name'  => esc_html( $item['text'] )
            ]
        ];
    }

    return [
        '@type'           => 'BreadcrumbList',
        '@id'             => get_permalink() . '#breadcrumb',
        'itemListElement' => $list_items
    ];
}

/**
 * Article Schema
 */
function mds_get_schema_article( $post_id ) {
    $context = function_exists('mds_get_post_context') ? mds_get_post_context( $post_id ) : 'news';
    $type    = ( $context === 'news' || $context === 'video' ) ? 'NewsArticle' : 'Article';
    
    $image_data = mds_get_primary_image_data( $post_id );
    $author_id  = get_post_field( 'post_author', $post_id );
    $site_url   = trailingslashit( home_url() );

    $schema = [
        '@type' => $type,
        '@id'   => get_permalink( $post_id ) . '#article',
        'isPartOf' => [
            '@id' => get_permalink( $post_id ) . '#webpage'
        ],
        'mainEntityOfPage' => [
            '@id' => get_permalink( $post_id ) . '#webpage'
        ],
        'headline' => get_the_title( $post_id ),
        'datePublished' => get_the_date( 'c', $post_id ),
        'dateModified'  => get_the_modified_date( 'c', $post_id ),
        'author' => [
            '@type' => 'Person',
            '@id'   => get_author_posts_url( $author_id ) . '#person',
            'name'  => get_the_author_meta( 'display_name', $author_id ),
            'url'   => get_author_posts_url( $author_id )
        ],
        'publisher' => [
            '@id' => $site_url . '#organization'
        ],
        'description' => wp_strip_all_tags( get_the_excerpt( $post_id ) )
    ];

    if ( $image_data['has_image'] ) {
        $schema['image'] = [
            '@type' => 'ImageObject',
            'url'   => esc_url_raw( $image_data['url'] ),
            'width' => $image_data['width'],
            'height' => $image_data['height']
        ];
    }

    return $schema;
}

/**
 * VideoObject Schema
 */
function mds_get_schema_video( $post_id, $video ) {
    $image_data = mds_get_primary_image_data( $post_id );
    
    return [
        '@type'        => 'VideoObject',
        '@id'          => get_permalink( $post_id ) . '#video',
        'name'         => get_the_title( $post_id ),
        'description'  => wp_strip_all_tags( get_the_excerpt( $post_id ) ),
        'thumbnailUrl' => [ esc_url_raw( $image_data['url'] ) ],
        'uploadDate'   => get_the_date( 'c', $post_id ),
        'embedUrl'     => esc_url_raw( $video['embed_url'] )
    ];
}
