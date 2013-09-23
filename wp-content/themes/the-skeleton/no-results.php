<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package The Skeleton
 */
?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php _e( 'Nothing Found', 'the-skeleton' ); ?></h1>
	</header><!-- .page-header -->


	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p style="text-align:center;"><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'the-skeleton' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		

			<p style="text-align:center;"><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'the-skeleton' ); ?></p>
			

		<?php else : ?>

			<p style="text-align:center;"><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'the-skeleton' ); ?></p>
			
                      

		<?php endif; ?>


              <div id="related-wrap-skel" class="widget">
           
                   <?php get_sidebar('related'); ?>

             </div><!-- end of related-wrap-skel -->


	</div><!-- .page-content -->
</section><!-- .no-results -->