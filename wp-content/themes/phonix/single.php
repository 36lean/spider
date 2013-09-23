<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

get_header(); ?>

<div class="row">
    <div class="article large-9 small-12 columns">
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php if(have_posts()) : while(have_posts()) : the_post(); ?>            
                <?php echo get_the_post_thumbnail($post->ID, 'large', array('title' => '')); ?>
                <h1><?php the_title(); ?></h1>
                
                <div class="post-date-comments">
                    <?php the_time('j F Y'); ?> &#8226; <?php comments_number( __('0 comments', 'phoenix'), __('1 comments', 'phoenix'), __('% comments', 'phoenix') ); ?>
                </div>
                
                <?php the_content('Read more...'); ?>
                
                <?php   
                $args = array(  
                 'before'           => '<p>' . __('Pages:', 'phoenix')  
                ,'after'            => '</p>'  
                ,'link_before'      => ''  
                ,'link_after'       => ''  
                ,'next_or_number'   => 'number'  
                ,'nextpagelink'     => __('Next page', 'phoenix')  
                ,'previouspagelink' => __('Previous page', 'phoenix')  
                ,'pagelink'         => '%'  
                ,'echo'             => 1 );   
                  
                wp_link_pages( $args );  
                ?>  
                
                <div class="post-date-comments">
                    <?php the_tags(); ?>
                </div>
                
                <div class="clear"></div>
                
                <?php if ( comments_open() ) : ?>
                    <?php comments_template( '', true ); ?>
                <?php endif; // comments_open() ?>

            <?php endwhile; ?>
            <?php else : ?>
                 <p><?php _e('Sorry, but nothing found.', 'phoenix'); ?></p>
            <?php endif; ?>            
            
        </div>
    </div>
    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>