<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package The Skeleton
 */

get_header(); ?>

<?php $options = get_option( 'rskeleton_settings' ); ?>

<?php if ( in_array( 'bbpress/bbpress.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>
<?php if ( is_bbpress() || ! is_bbpress() ) { ?>

<?php if ( empty($options['left_sidebar_archives']) ) { ?>
<div id="primary-custom" class="content-area-custom">
    <section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">        
      <?php } else { ?>
<div id="primary-custom" class="content-area-custom">
<section id="primary" class="content-area sidebar-left">
		<main id="main" class="site-main" role="main">
           <?php } ?>

<?php }} ?>

<?php if ( ! in_array( 'bbpress/bbpress.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>

<?php if ( empty($options['left_sidebar_archives']) ) { ?>
<div id="primary-custom" class="content-area-custom">
    <section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">        
      <?php } else { ?>
<div id="primary-custom" class="content-area-custom">
<section id="primary" class="content-area sidebar-left">
		<main id="main" class="site-main" role="main">
           <?php } ?>

<?php } ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</section>


<?php if ( in_array( 'bbpress/bbpress.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>
<?php $options = get_option( 'rskeleton_settings' ); ?>
<?php if ( is_bbpress() ) { ?>
<?php 

if ( empty($options['left_sidebar_archives']) && empty($options['sidebar_bbpress'])  ) {
		get_sidebar(); }

if ( !empty($options['sidebar_bbpress']) && !empty($options['left_sidebar_archives']) ) { 
            get_sidebar('bbpress'); }

if ( !empty($options['left_sidebar_archives']) && empty($options['sidebar_bbpress'])  ) {
		get_sidebar('left'); }

if ( !empty($options['sidebar_bbpress']) && empty($options['left_sidebar_archives']) ) { 
            get_sidebar('bbpress'); }


?>
<?php }} ?>


</div><!-- #primary -->
<?php get_footer(); ?>