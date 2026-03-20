<?php
/**
 * MundialdeSalsa Magazine Pro functions and definitions
 *
 * @package MundialdeSalsa_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Define Constants
 */
define( 'MDS_PRO_VERSION', '1.0.0' );
define( 'MDS_PRO_DIR', get_template_directory() );
define( 'MDS_PRO_URI', get_template_directory_uri() );

/**
 * Core Engine Loader
 */
$mds_includes = [
	'inc/core/setup.php',
	'inc/core/scripts.php',
	'inc/core/helpers.php',
	'inc/core/walkers.php',
	'inc/core/post-types.php',
	'inc/core/blocks.php',
	'inc/core/sidebars.php',
	'inc/core/custom-css.php',
	'inc/theme-options/admin-panel.php',
	'inc/theme-options/settings.php',
	'inc/theme-options/fields.php',
	'inc/admin/metaboxes.php',
	'inc/admin/metabox-config.php',
	'inc/admin/dashboard.php',
	'inc/admin/rest-api.php',
	'inc/builder/builder-init.php',
	'inc/modules/ads-system.php',
	'inc/modules/mega-menu.php',
	'inc/modules/editorial-engine.php', // New: Trending & Views
	'inc/modules/traffic-engine.php',   // New: Infinite Scroll & Next Post
	'inc/modules/layout-engine.php',    // New: Dynamic Layout Switcher
	'inc/widgets/trending-widget.php',  // New: Trending Widget
	'inc/performance/clean-up.php',
	'inc/integrations/schema.php',
	'inc/integrations/pwa.php',
];

require __DIR__ . '/inc/redux-config.php';

foreach ( $mds_includes as $file ) {
	$filepath = __DIR__ . '/' . $file;
	if ( file_exists( $filepath ) ) {
		require_once $filepath;
	}
}

require __DIR__ . '/inc/core/security.php';
require __DIR__ . '/inc/theme-options/rest-api.php';

/**
 * SEO JSON-LD for Front Page
 */
function mds_pro_front_page_schema() {
    if ( ! is_front_page() ) {
        return;
    }

    $logo = has_custom_logo() ? wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0] : '';
    $site_name = get_bloginfo('name');
    $site_url = home_url();
    
    $schema = [
        "@context" => "https://schema.org",
        "@graph" => [
            [
                "@type" => "Organization",
                "@id" => $site_url . "/#organization",
                "name" => $site_name,
                "url" => $site_url,
                "logo" => [
                    "@type" => "ImageObject",
                    "url" => $logo
                ],
                "description" => get_bloginfo('description')
            ],
            [
                "@type" => "MusicEvent",
                "name" => "Mundial de Salsa " . date('Y'),
                "description" => "El evento de salsa más importante del mundo en Cali, Colombia.",
                "startDate" => date('Y') . "-12-25T18:00:00-05:00",
                "location" => [
                    "@type" => "Place",
                    "name" => "Cali, Colombia",
                    "address" => [
                        "@type" => "PostalAddress",
                        "addressLocality" => "Cali",
                        "addressRegion" => "Valle del Cauca",
                        "addressCountry" => "CO"
                    ]
                ],
                "organizer" => [
                    "@id" => $site_url . "/#organization"
                ]
            ]
        ]
    ];

    echo "\n" . '<script type="application/ld+json" id="mds-pro-schema">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
}
add_action( 'wp_head', 'mds_pro_front_page_schema' );

/**
 * SEO JSON-LD for Single Posts (NewsArticle)
 */
function mds_pro_single_post_schema() {
    if ( ! is_singular( 'post' ) ) {
        return;
    }

    global $post;
    $site_url = home_url();
    $logo = has_custom_logo() ? wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0] : '';

    $schema = [
        "@context" => "https://schema.org",
        "@type" => "NewsArticle",
        "mainEntityOfPage" => [
            "@type" => "WebPage",
            "@id" => get_permalink()
        ],
        "headline" => get_the_title(),
        "image" => [
            get_the_post_thumbnail_url($post->ID, 'full')
        ],
        "datePublished" => get_the_date('c'),
        "dateModified" => get_the_modified_date('c'),
        "author" => [
            "@type" => "Person",
            "name" => get_the_author(),
            "url" => get_author_posts_url(get_the_author_meta('ID'))
        ],
        "publisher" => [
            "@type" => "Organization",
            "name" => get_bloginfo('name'),
            "logo" => [
                "@type" => "ImageObject",
                "url" => $logo
            ]
        ],
        "description" => get_the_excerpt()
    ];

    echo "\n" . '<script type="application/ld+json" id="mds-pro-single-schema">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
}
add_action( 'wp_head', 'mds_pro_single_post_schema' );

/**
 * Initialize Theme
 */
function mds_pro_init() {
    if ( ! get_option( 'mds_pro_options' ) ) {
        $default_options_file = __DIR__ . '/inc/theme-options/default-options.json';
        if ( file_exists( $default_options_file ) ) {
            $default_options = json_decode( file_get_contents( $default_options_file ), true );
            update_option( 'mds_pro_options', $default_options );
        }
    }
}
add_action( 'after_setup_theme', 'mds_pro_init' );
