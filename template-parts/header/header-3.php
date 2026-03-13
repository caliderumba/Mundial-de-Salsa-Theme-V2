<?php
/**
 * Header Layout 3: Top Bar + Logo Left + Menu Right
 */
?>
<div class="header-top-bar bg-secondary text-white py-2 small">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="top-bar-left">
            <span class="mr-3"><i class="lucide-calendar mr-1"></i><?php echo date('l, F j, Y'); ?></span>
            <?php get_template_part( 'template-parts/components/trending-ticker' ); ?>
        </div>
        <div class="top-bar-right d-flex align-items-center">
            <?php get_template_part( 'template-parts/components/social-links' ); ?>
            <div class="ml-3 border-left pl-3">
                <?php
                wp_nav_menu( [
                    'theme_location' => 'top-menu',
                    'container'      => false,
                    'menu_class'     => 'list-unstyled d-flex m-0 top-nav',
                ] );
                ?>
            </div>
        </div>
    </div>
</div>

<div class="header-main header-layout-3 py-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3">
                <div class="site-branding">
                    <?php if ( has_custom_logo() ) : the_custom_logo(); else : ?>
                        <h1 class="site-title m-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-7">
                <nav id="site-navigation" class="main-navigation">
                    <?php
                    wp_nav_menu( [
                        'theme_location' => 'main-menu',
                        'container'      => false,
                        'menu_class'     => 'nav-menu d-flex list-unstyled m-0 justify-content-center',
                    ] );
                    ?>
                </nav>
            </div>
            <div class="col-lg-2 text-right">
                <div class="header-actions">
                    <button class="search-toggle btn btn-link text-dark p-0"><i class="lucide-search"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
