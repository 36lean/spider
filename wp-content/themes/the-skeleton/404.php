<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package The Skeleton
 */

get_header(); ?>


<?php $options = get_option( 'rskeleton_settings' ); ?>

<?php if ( empty($options['left_sidebar_archives']) ) { ?>
<div id="primary-custom" class="content-area-custom">
    <section id="primary" class="content-area error-404 not-found">
		<main id="main" class="site-main" role="main">        
      <?php } else { ?>
<div id="primary-custom" class="content-area-custom">
<section id="primary" class="content-area sidebar-left error-404 not-found">
		<main id="main" class="site-main" role="main">
           <?php } ?>


				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'the-skeleton' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'the-skeleton' ); ?></p>

					

           <div id="related-wrap-skel" class="widget">
           
                   <?php get_sidebar('related'); ?>

             </div><!-- end of related-wrap-skel -->


				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	

<?php $options = get_option( 'rskeleton_settings' ); ?>
<?php if ( empty($options['left_sidebar_archives']) ) { 
            get_sidebar(); }
       else { 
            get_sidebar('left'); } ?>
</div>
<?php get_footer(); ?>