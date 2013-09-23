<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Template Name: Site Map - No Sidebars
 *
 * The template for displaying list Categorys, pages and post
 *
 * @package The Skeleton
 * 
 */

get_header(); ?>


<div id="primary" class="content-area content-sitemap">
<main id="main" class="site-main" role="main">
        
	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
        
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
				<header class="entry-header">
							<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

							<?php if ( 'post' == get_post_type() ) : ?>
							<div class="entry-meta">
							<?php responsive_skeleton_posted_on(); ?>
							</div><!-- .entry-meta -->
							<?php endif; ?>
				</header><!-- .entry-header -->
	
<div class="sitemap title general"><?php _e('Here is our list of Categories, Posts and Pages.', 'the-skeleton'); ?></div>
	        <div class="entry-content">
                              
	
                    <div class="sitemap grid1">
                        <h1 class="sitemap title categories"><?php _e('Categories', 'the-skeleton'); ?></h1>
                            <ul><?php wp_list_categories('sort_column=name&optioncount=1&hierarchical=0&title_li='); ?></ul>
                    </div><!-- end of .col-300 -->
                    
                    <div class="sitemap grid2">
                        <h1 class="sitemap title post"><?php _e('Posts', 'the-skeleton'); ?></h1>
                            <ul><?php $archive_query = new WP_Query('posts_per_page=-1');
                                    while ($archive_query->have_posts()) : $archive_query->the_post(); ?>
                                        <li>
                                            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'the-skeleton'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a>
                                        </li>
                                    <?php endwhile; ?>
                            </ul>  
                    </div><!-- end of .col-300 -->
                     
                    <div class="sitemap grid3">
                          <h1 class="sitemap title pages"><?php _e('Pages', 'the-skeleton'); ?></h1>
                            <ul><?php wp_list_pages("title_li=" ); ?></ul>               
                    </div><!-- end of .col-300 fit -->
                


				
                <?php wp_link_pages(array('before' => '<div class="page-links">' . __('Pages:', 'the-skeleton'), 'after' => '</div>')); ?> 

                </div><!-- end of .entry-content -->   				

			
			
            </article><!-- end of #post-<?php the_ID(); ?> -->
            
        <?php 
		endwhile; 

		if (  $wp_query->max_num_pages > 1 ) : 
			?>
			<nav role="navigation" id="nav-below" class="post-navigation">
				<div class="nav-previous"><?php next_posts_link( __( '&#8249; Previous', 'the-skeleton' ), $wp_query->max_num_pages ); ?></div>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer &#8250;', 'the-skeleton' ), $wp_query->max_num_pages ); ?></div>
			</div><!-- end of .navigation -->
			<?php 
		endif;

	else : 

		get_template_part( 'no-results', 'index' );

	endif; 
	?>  
      
</div><!-- end of #content-sitemap -->

<?php get_footer(); ?>