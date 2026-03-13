<?php
/**
 * Block: Newsletter Signup
 */
?>
<section class="mds-block-newsletter my-5">
    <div class="container">
        <div class="newsletter-inner p-5 bg-primary text-white rounded-xl shadow-lg text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <i class="lucide-mail h1 mb-3"></i>
                    <h2 class="h2 mb-2"><?php _e( 'Subscribe to our Newsletter', 'mundialdesalsa-pro' ); ?></h2>
                    <p class="mb-4 opacity-75"><?php _e( 'Get the latest salsa news, events, and music directly in your inbox.', 'mundialdesalsa-pro' ); ?></p>
                    
                    <form class="newsletter-form d-flex">
                        <input type="email" class="form-control form-control-lg border-0 mr-2" placeholder="<?php esc_attr_e( 'Your email address...', 'mundialdesalsa-pro' ); ?>" required>
                        <button type="submit" class="btn btn-dark btn-lg px-5"><?php _e( 'Subscribe', 'mundialdesalsa-pro' ); ?></button>
                    </form>
                    <p class="small mt-3 opacity-50"><?php _e( 'We respect your privacy. Unsubscribe at any time.', 'mundialdesalsa-pro' ); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
