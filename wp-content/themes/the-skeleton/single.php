<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * The Template for displaying all single posts.
 *
 * @package The Skeleton
 */

get_header(); ?>


<?php while ( have_posts() ) : the_post(); ?>

<div id="primary-single" class="content-area-single">

<?php $options = get_option( 'rskeleton_settings' ); ?>
<?php if ( empty($options['left_sidebar_archives']) ) { ?>
<div id="primary" class="content-area">
 <?php } else { ?>
<div id="primary" class="content-area sidebar-left">
 <?php } ?>


                        <?php responsive_skeleton_content_nav( 'nav-below' ); ?>
                        
                    <div class="crop-single">
			<?php get_template_part( 'content', 'single' ); ?>
                         
                    </div>
		</main><!-- #main -->
	</div><!-- #primary -->	            

<div class="comments-sidebar-toggle">
<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>
 <?php endwhile; // end of the loop. ?>
</div>


</div>
<?php get_footer(); ?>