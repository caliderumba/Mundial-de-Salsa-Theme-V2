<?php
/**
 * The template for displaying the footer
 */
?>
	<footer id="colophon" class="site-footer">
		<?php get_template_part( 'template-parts/footer/footer-main' ); ?>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>
<?php echo mds_pro_get_option( 'custom_code', 'footer_code', '' ); ?>

</body>
</html>
