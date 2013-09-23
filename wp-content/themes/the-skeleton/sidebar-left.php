<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;


/**
 * The Sidebar for the left.
 *
 * @package The Skeleton
 */
?>
	<div id="secondary" class="widget-area" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>
		<?php if ( ! dynamic_sidebar( 'sidebar-left' ) ) : ?>



		<?php endif; // end sidebar widget area ?>
	</div><!-- #secondary -->