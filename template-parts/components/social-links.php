<?php
/**
 * Component: Social Links
 */
$socials = [
    'facebook'  => 'https://facebook.com/mundialdesalsa',
    'twitter'   => 'https://twitter.com/mundialdesalsa',
    'instagram' => 'https://instagram.com/mundialdesalsa',
    'youtube'   => 'https://youtube.com/mundialdesalsa',
];
?>
<div class="social-links d-flex">
    <?php foreach ( $socials as $network => $url ) : ?>
        <a href="<?php echo esc_url( $url ); ?>" class="social-link-item mr-3 text-inherit opacity-75 hover-opacity-100" target="_blank">
            <i class="lucide-<?php echo $network; ?>"></i>
        </a>
    <?php endforeach; ?>
</div>
