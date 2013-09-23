<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

get_header(); ?>

<div class="row">
    <div class="article category large-9 small-12 columns">
        <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
            <div class="category-post">
                <div class="zoom">
                    <a href="<?php the_permalink(); ?>"><span class="zoomer"></span></a>
                    <?php echo get_the_post_thumbnail($post->ID, 'large', array('title' => '')); ?>
                </div>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                
                <div class="post-date-comments">
                    <?php the_date(); ?> &#8226; <?php comments_number( _('0 comments', 'phoenix'), _('1 comments', 'phoenix'), _('% comments', 'phoenix') ); ?>
                </div>
                
                <?php the_excerpt(); ?>
                
                <a href="<?php the_permalink(); ?>" class="readmore"><?php _e('Continue reading', 'phoenix'); ?></a>
            </div>
        <?php endwhile; ?>
        <?php else : ?>
             <p><?php _e('Sorry, but nothing found.', 'phoenix'); ?></p>
        <?php endif; ?>
        <?php  
        global $wp_query;  
          
        $big = 999999999; // unic number, not change it, please. 
          
        $args = array(  
            'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) )  
            ,'format' => ''  
            ,'current' => max( 1, get_query_var('paged') )  
            ,'prev_text'    => __('&larr; Previous', 'phoenix')  
            ,'next_text'    => __('Next &rarr;', 'phoenix') 
            ,'total' => $wp_query->max_num_pages  
        );  
          
        echo paginate_links( $args );  
        ?>  
    </div>
    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>