<?php
/**
 * 404 Error Page
 */

get_header();
?>

<main id="primary" class="site-main py-5 text-center">
    <div class="container">
        <div class="error-404 not-found py-5">
            <h1 class="display-1 font-weight-bold text-primary mb-4">404</h1>
            <h2 class="h2 mb-4"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'mundialdesalsa-pro' ); ?></h2>
            <p class="lead mb-5"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'mundialdesalsa-pro' ); ?></p>

            <div class="row justify-content-center">
                <div class="col-md-6">
                    <?php get_search_form(); ?>
                </div>
            </div>

            <div class="mt-5">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary btn-lg"><?php esc_html_e( 'Return to Homepage', 'mundialdesalsa-pro' ); ?></a>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
