<?php
/**
 * Header Layout 1: Logo Left + Menu Right
 */
?>
<div class="header-main header-layout-1">
    <div class="container">
        <div class="header-inner d-flex align-items-center justify-content-between">
            <div class="site-branding">
                <?php
                if ( has_custom_logo() ) :
                    the_custom_logo();
                else :
                    ?>
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php
                endif;
                ?>
            </div>

            <nav id="site-navigation" class="main-navigation">
                <?php
                wp_nav_menu( [
                    'theme_location' => 'main-menu',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                    'menu_class'     => 'nav-menu d-flex list-unstyled m-0',
                ] );
                ?>
            </nav>

            <div class="header-actions d-flex align-items-center">
                <button class="search-toggle"><i class="lucide-search"></i></button>
                <button class="dark-mode-toggle"><i class="lucide-moon"></i></button>
            </div>
        </div>
    </div>
</div>
