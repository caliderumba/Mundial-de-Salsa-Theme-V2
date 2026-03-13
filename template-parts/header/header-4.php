<?php
/**
 * Header Layout 4: Minimal Header (Logo Center + Icons Sides)
 */
?>
<div class="header-main header-layout-4 py-3 border-bottom">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-4">
                <button class="mobile-menu-toggle btn btn-link text-dark p-0 mr-3"><i class="lucide-menu"></i></button>
                <button class="search-toggle btn btn-link text-dark p-0"><i class="lucide-search"></i></button>
            </div>
            <div class="col-4 text-center">
                <div class="site-branding">
                    <?php if ( has_custom_logo() ) : the_custom_logo(); else : ?>
                        <h1 class="site-title h3 m-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-4 text-right">
                <div class="header-actions">
                    <button class="dark-mode-toggle btn btn-link text-dark p-0"><i class="lucide-moon"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
