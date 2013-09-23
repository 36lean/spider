<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;


/**
 * The Sidebar for the Related Post.
 *
 * @package The Skeleton
 */
?>

<div class="related-post-skel">
		<?php do_action( 'before_sidebar' ); ?>
		<?php if ( ! dynamic_sidebar( 'sidebar-related1' ) ) : ?>

			

		<?php endif; // end sidebar widget area ?>
</div> <!-- end of related-post-skel -->

<div class="related-ad-box-skel">
		<?php do_action( 'before_sidebar' ); ?>
		<?php if ( ! dynamic_sidebar( 'sidebar-related2' ) ) : ?>

			

		<?php endif; // end sidebar widget area ?>
</div> <!-- end of related-ad-box-skel -->