<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

get_header(); ?>

<section id="sliderNewsletter" class="row">
  <?php if (!get_option('phoenix_slider')): ?>
  <div class="columns small-12 <?php if (!get_option('phoenix_near_slider')){echo 'large-8';} else { echo 'large-12'; } ?>">
    <div id="slider">
        <?php phoenix_responsive_slider(); ?>
    </div>
  </div>
  <?php endif; ?>
  <?php if (!get_option('phoenix_near_slider')): ?>
  <div class="columns small-12 <?php if (!get_option('phoenix_slider')){echo 'large-4';} else { echo 'large-12'; } ?>">
    <div class="newsletter">
      <div class="indent">
        <?php if (get_option('phoenix_greeting') == ''): ?>
        <div class="item">
          <strong>Feature number one!</strong><br />
          Proin gravida nibh vel velit auctor aliquet.
        </div>
        <div class="item">
          <strong>Feature number one!</strong><br />
          Proin gravida nibh vel velit auctor aliquet.
        </div>
        <div class="item">
          <strong>Feature number one!</strong><br />
          Proin gravida nibh vel velit auctor aliquet.
        </div>
        <a href="#" class="button">Sign Up</a>
        <?php else: ?>
            <?php echo get_option('phoenix_greeting'); ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <?php endif; ?>
</section>

<div class="home-content row">
    <div class="spacing"></div>
    
    <div class="home-posts-nav">
        <div class="large-6 small-6 columns text-left alignleft">
            <?php previous_posts_link(); ?>
        </div>
        <div class="large-6 small-6 columns text-right alignright">
            <?php next_posts_link(); ?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="recent-posts large-12 small-12 columns"> 
        <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
            <div class="large-4 small-12 columns recent-post-item">
                <a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail($post->ID, 'large', array('alt' => get_the_title())); ?></a>
                <h2><?php the_title(); ?></h2>
                <div class="post-date-comments">
                    <?php the_date(); ?> &#8226; <?php comments_number( _('0 comments'), _('1 comments'), _('% comments') ); ?>
                </div>
                <div class="post-description">
                    <?php the_excerpt(); ?>
                </div>
                <a href="<?php the_permalink(); ?>" class="readmore"><?php _e('Continue reading', 'phoenix'); ?></a>
            </div>
        <?php endwhile; ?>
        <?php else : ?>
             <p><?php _e('Sorry, but nothing found.', 'phoenix'); ?></p>
        <?php endif; ?>
    </div>
    
    <div class="spacing"></div>
    
    <div class="posts-from-cat-left">
        <div class="post-slider-left-nav large-2 small-12 columns">
            <?php 
            if (get_option('phoenix_featured_posts_count_left')){
                $posts_count = get_option('phoenix_featured_posts_count_left');
            } else {
                $posts_count = 3;
            }
            
            if (get_option('phoenix_featured_posts_left')){
                $cat = get_option('phoenix_featured_posts_left');
            } else {
                $cat = 1;
            }
            
            $query = new WP_Query('cat='.$cat.'&posts_per_page='.$posts_count);
            while($query->have_posts()){ $query->the_post(); ?>            
                <a href="#" data-orbit-link="slide1-<?php the_ID(); ?>"><?php echo get_the_post_thumbnail($post->ID, 'slide', array('title' => '')); ?></a>
            <?php } ?>  
        </div>
        
        <div class="post-slider large-10 small-12 columns">
            <ul data-orbit data-options="bullets: false;">
                <?php
                while($query->have_posts()){ $query->the_post(); ?>            
                    <li data-orbit-slide="slide1-<?php the_ID(); ?>">
                        <h2><?php the_title(); ?></h2>
                        <?php the_excerpt(); ?>
                        <a href="<?php the_permalink(); ?>" class="readmore-slide"><?php _e('Continue reading', 'phoenix'); ?></a>
                    </li>
                <?php } ?>  
            </ul>
        </div>
        <?php wp_reset_postdata(); ?> 
        <div class="clear"></div>
    </div>
    
    <div class="spacing"></div>
    
    <div class="posts-from-cat-top">
        <div class="post-slider-left-nav large-12 small-12 columns">
            <?php 
            if (get_option('phoenix_featured_posts_count_left')){
                $posts_count = get_option('phoenix_featured_posts_count_left');
            } else {
                $posts_count = 3;
            }
            
            if (get_option('phoenix_featured_posts_left')){
                $cat = get_option('phoenix_featured_posts_left');
            } else {
                $cat = 1;
            }
            
            $query = new WP_Query('cat='.$cat.'&posts_per_page='.$posts_count);
            while($query->have_posts()){ $query->the_post(); ?>            
                <a href="#" data-orbit-link="slide2-<?php the_ID(); ?>"><?php echo get_the_post_thumbnail($post->ID, 'slide', array('title' => '')); ?></a>
            <?php } ?>  
        </div>
        
        <div class="post-slider2 large-12 small-12 columns">
            <ul data-orbit data-options="bullets: false;">
                <?php
                while($query->have_posts()){ $query->the_post(); ?>            
                    <li data-orbit-slide="slide2-<?php the_ID(); ?>">
                        <h2><?php the_title(); ?></h2>
                        <?php the_excerpt(); ?>
                        <a href="<?php the_permalink(); ?>" class="readmore-slide"><?php _e('Continue reading', 'phoenix'); ?></a>
                        <div class="clear"></div>
                    </li>
                <?php } ?>  
            </ul>
        </div>
        <?php wp_reset_postdata(); ?> 
    </div>
    
    <div class="spacing"></div>
    
</div>
<?php get_footer(); ?>