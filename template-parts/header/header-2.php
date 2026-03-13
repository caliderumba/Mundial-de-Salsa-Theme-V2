<?php
/**
 * Header Layout 2: Centered Logo + Menu Below
 */
?>
<div class="header-main header-layout-2 text-center">
    <div class="container">
        <div class="header-top-branding py-4">
            <div class="site-branding">
                <?php
                if ( has_custom_logo() ) :
                    the_custom_logo();
                else :
                    ?>
                    <h1 class="site-title m-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php
                endif;
                ?>
            </div>
        </div>

        <nav id="site-navigation" class="main-navigation border-top border-bottom py-2">
            <?php
            wp_nav_menu( [
                'theme_location' => 'main-menu',
                'menu_id'        => 'primary-menu',
                'container'      => false,
                'menu_class'     => 'nav-menu d-flex justify-content-center list-unstyled m-0',
            ] );
            ?>
        </nav>
    </div>
</div>
