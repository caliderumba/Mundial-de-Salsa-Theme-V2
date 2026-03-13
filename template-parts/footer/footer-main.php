<?php
/**
 * Footer Main Template
 */
?>
<div class="footer-top py-5 bg-dark text-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="footer-branding mb-4">
                    <?php if ( has_custom_logo() ) : the_custom_logo(); else : ?>
                        <h2 class="h3 text-white"><?php bloginfo( 'name' ); ?></h2>
                    <?php endif; ?>
                </div>
                <p class="opacity-75"><?php bloginfo( 'description' ); ?></p>
                <div class="footer-social mt-4">
                    <?php get_template_part( 'template-parts/components/social-links' ); ?>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                <h4 class="h6 text-uppercase font-weight-bold mb-4"><?php _e( 'Quick Links', 'mundialdesalsa-pro' ); ?></h4>
                <?php
                wp_nav_menu( [
                    'theme_location' => 'footer-menu',
                    'container'      => false,
                    'menu_class'     => 'list-unstyled footer-links',
                ] );
                ?>
            </div>

            <div class="col-lg-3 col-md-4 mb-4 mb-md-0">
                <h4 class="h6 text-uppercase font-weight-bold mb-4"><?php _e( 'Popular Categories', 'mundialdesalsa-pro' ); ?></h4>
                <ul class="list-unstyled footer-links">
                    <?php
                    $categories = get_categories( [ 'number' => 5, 'orderby' => 'count', 'order' => 'DESC' ] );
                    foreach( $categories as $cat ) {
                        echo '<li><a href="' . get_category_link($cat->term_id) . '">' . $cat->name . ' (' . $cat->count . ')</a></li>';
                    }
                    ?>
                </ul>
            </div>

            <div class="col-lg-3 col-md-4">
                <h4 class="h6 text-uppercase font-weight-bold mb-4"><?php _e( 'Newsletter', 'mundialdesalsa-pro' ); ?></h4>
                <p class="small opacity-75 mb-3"><?php _e( 'Subscribe to get the latest updates.', 'mundialdesalsa-pro' ); ?></p>
                <form class="footer-newsletter d-flex">
                    <input type="email" class="form-control form-control-sm bg-secondary border-0 text-white" placeholder="Email...">
                    <button class="btn btn-primary btn-sm ml-1"><i class="lucide-send"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="footer-bottom py-4 bg-black text-white-50 border-top border-secondary">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                <p class="m-0 small">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php _e( 'All rights reserved.', 'mundialdesalsa-pro' ); ?></p>
            </div>
            <div class="col-md-6 text-center text-md-right">
                <p class="m-0 small"><?php _e( 'Developed with ❤️ for Salsa lovers.', 'mundialdesalsa-pro' ); ?></p>
            </div>
        </div>
    </div>
</div>
