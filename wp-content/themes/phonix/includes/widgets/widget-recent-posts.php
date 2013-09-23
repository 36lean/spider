<?php
/*---------------------------------------------------------------------------------*/
/* Recent Posts */
/*---------------------------------------------------------------------------------*/
class Phoenix_RecentPosts extends WP_Widget {
	var $settings = array( 'title', 'post_count' );

	function Phoenix_RecentPosts() {
		$widget_ops = array( 'description' => 'Displaying recent posts.' );
		parent::WP_Widget( false, __( 'Phoenix - Recent posts', 'woothemes' ), $widget_ops );
	}

	function widget( $args, $instance ) {
		$settings = $this->phoenix_get_settings();
		extract( $args, EXTR_SKIP );
		$instance = wp_parse_args( $instance, $settings );
		extract( $instance, EXTR_SKIP );

		?>
			<?php echo $before_widget; ?>
			<?php if ( $title ) { echo $before_title . apply_filters( 'widget_title', $title, $instance, $this->id_base ) . $after_title; } ?>
			
            <?php 
            if ($post_count == ''){
                $post_count = 1;
            } else {
                $post_count = $post_count;
            }
            
            $query = new WP_Query('post_type=post&posts_per_page='.$post_count);
            while($query->have_posts()){ $query->the_post(); ?>            
                <div class="recent_post recent_post_item<?php the_id(); ?>">
                    <h4><?php the_title(); ?></h4>
                    <div class="post-date-comments">
                        <?php the_date(); ?> &#8226; <?php comments_number( _('0 comments'), _('1 comments'), _('% comments') ); ?>
                    </div>
                    <div class="post-description">
                        <?php the_excerpt(); ?>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="readmore"><?php _e('Continue reading', 'phoenix'); ?></a>
                </div>
            <?php } ?>  
            <?php wp_reset_postdata(); ?>
			
            <?php echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		foreach ( array( 'read_more_text', 'read_more_url' ) as $setting )
			$new_instance[$setting] = strip_tags( $new_instance[$setting] );
		return $new_instance;
	}

	/**
	 * Provides an array of the settings with the setting name as the key and the default value as the value
	 * This cannot be called get_settings() or it will override WP_Widget::get_settings()
	 */
	function phoenix_get_settings() {
		// Set the default to a blank string
		$settings = array_fill_keys( $this->settings, '' );
		return $settings;
	}

	function form( $instance ) {
		$instance = wp_parse_args( $instance, $this->phoenix_get_settings() );
		extract( $instance, EXTR_SKIP );
		?>
		<p>
		   <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','phoenix'); ?></label>
		   <input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo esc_attr( $title ); ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
		</p>
		<p>
		   <label for="<?php echo $this->get_field_id('post_count'); ?>"><?php _e('Posts count:','phoenix'); ?></label>
		   <input type="text" name="<?php echo $this->get_field_name('post_count'); ?>"  value="<?php echo esc_attr( $post_count ); ?>" class="widefat" id="<?php echo $this->get_field_id('post_count'); ?>" />
		</p>
		<?php
	}
} 

register_widget( 'Phoenix_RecentPosts' );