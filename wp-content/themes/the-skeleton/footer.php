<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package The Skeleton
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">

<?php $options = get_option( 'rskeleton_settings' ); ?>
<?php if ( 1 == $options['footer_widgets_disabler'] ) { ?>
<?php get_sidebar('footer'); ?>
<?php } ?> 

<nav id="site-footer-navigation" class="footer-navigation" role="navigation">

<?php wp_nav_menu( array( 'theme_location' => 'third' ) ); ?>

     </nav> <!-- end of footer menu -->


	    <div class="site-info">
			<?php do_action( 'responsive_skeleton_credits' ); ?>
                        <div id="copyright"><?php _e('&copy; Copyright ', 'the-skeleton'); ?><?php echo date('Y'); ?> <?php echo $options['copyright_text']; ?></div>
                        
                 <div class="credits">

			<?php echo $options['credits_text']; ?>

                 </div><!-- credits -->
	
             </div><!-- .site-info -->

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>