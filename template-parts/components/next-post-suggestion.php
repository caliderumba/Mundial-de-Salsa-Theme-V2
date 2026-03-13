<?php
/**
 * Component: Next Article Suggestion (Slide-in)
 */
$next_post = get_next_post();
if ( $next_post ) :
?>
<div id="next-post-suggestion" class="position-fixed bottom-0 right-0 m-4 p-3 bg-white shadow-lg rounded-lg border-left border-primary" style="width: 300px; transform: translateX(120%); transition: transform 0.5s ease; z-index: 1050;">
    <button class="close-suggestion position-absolute top-0 right-0 p-2 btn btn-link text-muted small"><i class="lucide-x"></i></button>
    <div class="suggestion-label small text-primary font-weight-bold mb-2"><?php _e( 'Next Article', 'mundialdesalsa-pro' ); ?></div>
    <div class="suggestion-content d-flex align-items-center">
        <?php if ( has_post_thumbnail($next_post->ID) ) : ?>
            <div class="mr-3" style="width: 60px; flex-shrink: 0;">
                <?php echo get_the_post_thumbnail($next_post->ID, 'thumbnail', [ 'class' => 'rounded img-fluid' ]); ?>
            </div>
        <?php endif; ?>
        <h4 class="h6 m-0"><a href="<?php echo get_permalink($next_post->ID); ?>" class="text-dark text-decoration-none"><?php echo get_the_title($next_post->ID); ?></a></h4>
    </div>
</div>

<script>
document.addEventListener('scroll', function() {
    const suggestion = document.getElementById('next-post-suggestion');
    if (!suggestion) return;
    
    const scrollPercent = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
    if (scrollPercent > 70) {
        suggestion.style.transform = 'translateX(0)';
    } else {
        suggestion.style.transform = 'translateX(120%)';
    }
});
document.querySelector('.close-suggestion')?.addEventListener('click', () => {
    document.getElementById('next-post-suggestion').remove();
});
</script>
<?php endif; ?>
