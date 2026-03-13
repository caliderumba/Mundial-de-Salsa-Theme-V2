<?php
/**
 * Component: Share Buttons
 */
$url = urlencode( get_permalink() );
$title = urlencode( get_the_title() );
?>
<div class="share-buttons d-flex align-items-center my-4">
    <span class="share-label font-weight-bold mr-3"><?php _e( 'Share:', 'mundialdesalsa-pro' ); ?></span>
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>" class="share-btn btn-facebook mr-2" target="_blank"><i class="lucide-facebook"></i></a>
    <a href="https://twitter.com/intent/tweet?url=<?php echo $url; ?>&text=<?php echo $title; ?>" class="share-btn btn-twitter mr-2" target="_blank"><i class="lucide-twitter"></i></a>
    <a href="https://api.whatsapp.com/send?text=<?php echo $title . '%20' . $url; ?>" class="share-btn btn-whatsapp mr-2" target="_blank"><i class="lucide-phone"></i></a>
    <a href="mailto:?subject=<?php echo $title; ?>&body=<?php echo $url; ?>" class="share-btn btn-email"><i class="lucide-mail"></i></a>
</div>
