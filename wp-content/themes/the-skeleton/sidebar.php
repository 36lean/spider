<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;


/**
 * The Sidebar containing the main widget areas.
 *
 * @package The Skeleton
 */
?>
	<div id="secondary" class="widget-area" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>
		<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

			

		

		<?php endif; // end sidebar widget area ?>
	</div><!-- #secondary -->