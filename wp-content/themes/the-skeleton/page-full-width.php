<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Template Name: Page Full-Width - No Sidebar
 *
 * The template for displaying full-width pages.
 *
 * @package The Skeleton
 * 
 */

get_header(); ?>

<div id="primary" class="content-area full-width-page">
	<div id="content" class="site-content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

			<?php comments_template(); ?>

		<?php endwhile; // end of the loop. ?>

	</div><!-- #content .site-content -->
</div><!-- #primary .content-area -->

<?php get_footer(); ?>