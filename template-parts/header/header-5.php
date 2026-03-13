<?php
/**
 * Header Layout 5: Magazine Header (Logo Top + Large Menu Below)
 */
?>
<div class="header-main header-layout-5 pt-4">
    <div class="container text-center">
        <div class="site-branding mb-4">
            <?php if ( has_custom_logo() ) : the_custom_logo(); else : ?>
                <h1 class="site-title display-3 font-weight-bold"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
            <?php endif; ?>
        </div>
        
        <nav id="site-navigation" class="main-navigation border-top border-bottom py-3">
            <?php
            wp_nav_menu( [
                'theme_location' => 'main-menu',
                'container'      => false,
                'menu_class'     => 'nav-menu d-flex justify-content-center list-unstyled m-0 font-weight-bold text-uppercase',
            ] );
            ?>
        </nav>
    </div>
</div>
