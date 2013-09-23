<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * The template for displaying Search Results pages.
 *
 * @package The Skeleton
 */

get_header(); ?>

	<?php $options = get_option( 'rskeleton_settings' ); ?>

<?php if ( empty($options['left_sidebar_archives']) ) { ?>
<div id="primary-custom" class="content-area-custom">
    <section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">        
      <?php } else { ?>
<div id="primary-custom" class="content-area-custom">
<section id="primary" class="content-area sidebar-left">
		<main id="main" class="site-main" role="main">
           <?php } ?>


		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'the-skeleton' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start Two Column Support */ ?>
<?php $counter = 1; ?>
 
<?php /* Start the Loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>
       
 
   <?php /* Two Column Support get class */ ?>
   <?php $class = ( $counter % 2  ? ' one' : '' ) ?>
   <?php $first = ( $counter < 3  ? ' first' : '' ) ?>
 
   <?php /* Two Column output open the div class */ ?>
   <div class="column<?php echo $class; echo $first; ?>">


				<?php get_template_part( 'content', 'search' ); ?>

</div>
 
   <?php $counter++; //Update Counter ?>
<?php /* End Two Column Support close div class */ ?>

			<?php endwhile; ?>

			<?php responsive_skeleton_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'search' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php $options = get_option( 'rskeleton_settings' ); ?>
<?php if ( empty($options['left_sidebar_archives']) ) { 
            get_sidebar(); }
       else { 
            get_sidebar('left'); } ?>
</div>
<?php get_footer(); ?>