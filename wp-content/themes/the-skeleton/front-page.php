<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Template Name: Site Front Page
 *
 * The template for displaying static site front page
 *
 * @package The Skeleton
 * 
 */

get_header(); ?>

<?php $options = get_option( 'rskeleton_settings' ); ?>


<?php if ( 1 == $options['woo_disabler'] ) { ?>
<header class="page-header woocommerce">
		<h1 class="page-title">
			<span><?php echo $options['woo_header']; ?></span>				
                       </h1>
				</header>

<div id="woocommerce-custom-shop" class="content-area-woo">
<div class="woocommerce-featured-wrapper">
<?php echo do_shortcode('[featured_products per_page="4" columns="4"]'); ?>
</div>
</div>

<?php } ?>


<?php if ( 1 == $options['featured_disabler'] ) { ?>
<header class="page-header featured">
		<h1 class="page-title">
			<span><?php echo $options['feature_header']; ?></span>				
                       </h1>
				</header>

<?php get_sidebar('home'); ?>
	
<?php } ?>

<?php if ( 1 == $options['blogging_disabler'] ) { ?>
<header class="page-header blogging">
		<h1 class="page-title">
			<span><?php echo $options['blogging_platform']; ?></span>				
                       </h1>
				</header>
<?php } ?>


<?php if ( ! empty($options['two_column']) ) { ?>

<?php if ( empty($options['left_sidebar_archives']) ) { ?>
<div id="primary-custom" class="content-area-custom">
<div id="primary" class="content-area blog-excerpt-summary">
<main id="main" class="site-main" role="main">
 <?php } else { ?>
<div id="primary-custom" class="content-area-custom">
<div id="primary" class="content-area blog-excerpt-summary sidebar-left">
<main id="main" class="site-main" role="main">
 <?php } ?>

<?php if ( have_posts() ) : ?>

<?php $options = get_option( 'rskeleton_settings' ); 
       if ( ! empty($options['query_front']) ) { 

         query_posts( $query_string . '&cat= '.$options['query_front'].' ' );

           } ?>
     

			<?php /* Start Two Column Support */ ?>
<?php $counter = 1; ?>
 
<?php /* Start the Loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>
       
 
   <?php /* Two Column Support get class http://digitalraindrops.net/2011/09/twenty-eleven-two-post-columns/ */ ?>
   <?php $class = ( $counter % 2  ? ' one' : '' ) ?>
   <?php $first = ( $counter < 3  ? ' first' : '' ) ?>
 
   <?php /* Two Column output open the div class */ ?>
   <div class="column<?php echo $class; echo $first; ?>">


			<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to overload this in a child theme then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>
           

</div>
 
   <?php $counter++; //Update Counter ?>
<?php /* End Two Column Support close div class */ ?>

         <?php endwhile; ?>

			<?php responsive_skeleton_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'index' ); ?>

		<?php endif; ?>


		</main><!-- #main -->
	</div>

<?php } ?><!-- end of 2 column  -->


<?php if ( empty($options['two_column']) ) { ?>

<?php if ( empty($options['left_sidebar_archives']) ) { ?>
<div id="primary-custom" class="content-area-custom one-column">
<div id="primary" class="content-area blog-excerpt-summary one-column">
<main id="main" class="site-main" role="main">
 <?php } else { ?>
<div id="primary-custom" class="content-area-custom one-column">
<div id="primary" class="content-area blog-excerpt-summary one-column sidebar-left">
<main id="main" class="site-main" role="main">
<?php } ?>

<?php if ( have_posts() ) : ?>

<?php $options = get_option( 'rskeleton_settings' ); 
       if ( ! empty($options['query_front']) ) { 

         query_posts( $query_string . '&cat= '.$options['query_front'].' ' );

           } ?>
   

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
  
			
			<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to overload this in a child theme then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>     
			
            
          <?php endwhile; ?>

			<?php responsive_skeleton_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'index' ); ?>

		<?php endif; ?>


		</main><!-- #main -->
		</div>

<?php } ?><!-- end of 1 column -->




<?php $options = get_option( 'rskeleton_settings' ); ?>
<?php if ( empty($options['left_sidebar_archives']) ) { 
            get_sidebar(); }
       else { 
            get_sidebar('left'); } ?>
</div><!-- #primary .content-area -->
<?php get_footer(); ?>