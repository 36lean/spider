<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;
?>

<?php if ( is_active_sidebar( 'footer-sidebar' ) ) : ?>
<div class="wide gradient">
	<aside class="row footer-bar">
		<?php dynamic_sidebar( 'footer-sidebar' ); ?>
	</aside>
</div>
<?php endif; ?>

<footer id="footer" class="row">
	<div class="copyright columns large-6 small-6">
		<?php echo get_option('phoenix_copyright'); ?>
	</div>
	<div class="powered columns large-6 small-6"><?php esc_attr_e('Powered by', 'phoenix'); ?> <a href="<?php echo esc_url('http://wordpress.org/'); ?>" title="<?php esc_attr_e('WordPress', 'phoenix'); ?>">
                    <?php printf('WordPress'); ?></a></div>
</footer>

<?php wp_footer(); ?>

</body>
</html>