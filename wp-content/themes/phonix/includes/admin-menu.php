<?php
function AdminLiveInit() {
// Live Settings Script for admin

wp_register_script( 'admin-live-script', get_template_directory_uri() . '/includes/js/admin-js.js');
wp_enqueue_script(  'admin-live-script' );

wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_enqueue_script('phoenix-tabs', get_template_directory_uri().'/includes/js/tabs.js');

wp_enqueue_style( 'st-admin-style', get_template_directory_uri() . '/includes/css/style.css' );
wp_enqueue_style( 'st-admin-tabs', get_template_directory_uri() . '/includes/css/jquery-tabs.css' );
}
if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'theme_settings'){
    add_action('admin_footer', 'AdminLiveInit');
}

add_action('admin_menu', 'phoenix_create_menu');

function phoenix_create_menu() {
    add_theme_page(__('Phoenix settings', 'phoenix'), __('Phoenix settings', 'phoenix'), 'administrator', 'theme_settings', 'phoenix_settings_page');

    add_action( 'admin_init', 'register_mysettings' );
}

function register_mysettings() {
    
    register_setting( 'phoenix-settings-group', 'phoenix_greeting_message' );
    register_setting( 'phoenix-settings-group', 'phoenix_slider' );
    register_setting( 'phoenix-settings-group', 'phoenix_near_slider' );
    register_setting( 'phoenix-settings-group', 'phoenix_greeting' );
    register_setting( 'phoenix-settings-group', 'phoenix_featured_posts_left' );
    register_setting( 'phoenix-settings-group', 'phoenix_featured_posts_count_left' );
    register_setting( 'phoenix-settings-group', 'phoenix_featured_posts_top' );
    register_setting( 'phoenix-settings-group', 'phoenix_featured_posts_count_top' );
    register_setting( 'phoenix-settings-group', 'phoenix_slider_cat' );
    
    // Footer options
    register_setting( 'phoenix-settings-group', 'phoenix_copyright' );
    
    // Social options
    register_setting( 'phoenix-settings-group', 'phoenix_twitter' );
    register_setting( 'phoenix-settings-group', 'phoenix_facebook' );
    register_setting( 'phoenix-settings-group', 'phoenix_pinterest' );
}

function phoenix_settings_page() {
?>
<div class="rt_wrap">
    <h2 id="rt_title"><?php _e('Theme settings', 'phoenix'); ?></h2>

    <form method="post" action="options.php" class="rt_opts" id="toeThemeEditOptionForm">

    <?php settings_fields('phoenix-settings-group'); ?>
    <div id="rt_tabs">
        <ul>
            <li class="rt_pages"><a href="#rt_pages"><?php _e('General', 'phoenix'); ?></a></li>
            <li class="rt_footer"><a href="#rt_footer"><?php _e('Footer', 'phoenix'); ?></a></li>
            <li class="rt_social"><a href="#rt_social"><?php _e('Social', 'phoenix'); ?></a></li>
        </ul>
        
        <div id="rt_pages"> 
            <h3><?php _e('Home page settings', 'phoenix'); ?></h3>
            
            <div class="rt_input rt_text">
                <div class="rt_description">
                    <label for="phoenix_greeting_message"><?php _e('Home greeting message', 'phoenix'); ?></label>
                    <small><?php _e('Default: We are glad to see you here!', 'phoenix'); ?></small>
                    <div class="rt_clearfix"></div>
                </div>
                <input name="phoenix_greeting_message" id="phoenix_greeting_message" type="text" value="<?php echo esc_attr(get_option('phoenix_greeting_message')); ?>" />
                <div class="rt_clearfix"></div>
            </div>
            
            <div class="rt_input rt_text">
                <div class="rt_description">
                    <label for="phoenix_slider"><?php _e('Hide / Show slider on home page', 'phoenix'); ?></label>
                    <div class="rt_clearfix"></div>
                </div>
                <input name="phoenix_slider" id="phoenix_slider" type="checkbox" value="1" <?php if ( 1 == get_option('phoenix_slider') ) echo 'checked="checked"';?> />
                <div class="rt_clearfix"></div>
            </div> 
            
            <div class="rt_input rt_text">
                <div class="rt_description">
                    <label for="phoenix_near_slider"><?php _e('Hide / Show greeting text block near the slider.', 'phoenix'); ?></label>
                    <div class="rt_clearfix"></div>
                </div>
                <input name="phoenix_near_slider" id="phoenix_near_slider" type="checkbox" value="1" <?php if ( 1 == get_option('phoenix_near_slider') ) echo 'checked="checked"';?> />
                <div class="rt_clearfix"></div>
            </div> 
            
            <div class="rt_input rt_text">
                <div class="rt_description">
                    <label for="phoenix_greeting"><?php _e('Greeting block text', 'phoenix'); ?></label>
                    <div class="rt_clearfix"></div>
                </div>
                <textarea name="phoenix_greeting" id="phoenix_greeting" style="height:120px;"><?php echo esc_attr(get_option('phoenix_greeting')); ?></textarea>
                <div class="rt_clearfix"></div>
            </div>
            <small>
                <?php _e('Default block code is:', 'phoenix'); ?>
                <?php $text = '
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
                    ';
                ?>
                <pre>
                <?php echo htmlspecialchars($text) ?>
                </pre>
            </small>
            
            <h3><?php _e('Featured posts with thumbs on left', 'phoenix'); ?></h3>
            <div class="rt_input rt_text">
                <div class="rt_description">
                    <label for="phoenix_featured_posts_count_left"><?php _e('Count of posts', 'phoenix'); ?></label>
                    <div class="rt_clearfix"></div>
                </div>
                <input name="phoenix_featured_posts_count_left" id="phoenix_featured_posts_count_left" type="text" value="<?php echo esc_attr(get_option('phoenix_featured_posts_count_left')); ?>" />
                <div class="rt_clearfix"></div>
            </div>
                
            <div class="rt_input rt_text">
                <div class="rt_description">
                    <label for="phoenix_featured_posts_left"><?php _e('Choose a featured posts category', 'phoenix'); ?></label>
                    <div class="rt_clearfix"></div>
                </div>
                <select name="phoenix_featured_posts_left" id="phoenix_featured_posts_left">
                	<option value="none" default="default"><?php _e('Choose a category', 'phoenix'); ?></option>
                    <?php    
                        $opt = get_option('phoenix_featured_posts_left');
                        $categories = get_categories('hide_empty=0&orderby=name');
                        foreach ($categories as $category_list ) {
                            $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
                            if ($category_list->cat_ID == $opt) {$selected = 'selected="selected"';} else {$selected = '';}
                            echo '<option value="'.$category_list->cat_ID.'" '.$selected.' >'.$category_list->cat_name.'</option>';
                        }
                    ?>
                </select>
                <div class="rt_clearfix"></div>
            </div>
            
            <h3><?php _e('Featured posts with thumbs on top', 'phoenix'); ?></h3>
            <div class="rt_input rt_text">
                <div class="rt_description">
                    <label for="phoenix_featured_posts_count_top"><?php _e('Count of posts', 'phoenix'); ?></label>
                    <div class="rt_clearfix"></div>
                </div>
                <input name="phoenix_featured_posts_count_top" id="phoenix_featured_posts_count_top" type="text" value="<?php echo esc_attr(get_option('phoenix_featured_posts_count_top')); ?>" />
                <div class="rt_clearfix"></div>
            </div>
                
            <div class="rt_input rt_text">
                <div class="rt_description">
                    <label for="phoenix_featured_posts_top"><?php _e('Choose a featured posts category', 'phoenix'); ?></label>
                    <div class="rt_clearfix"></div>
                </div>
                <select name="phoenix_featured_posts_top" id="phoenix_featured_posts_top">
                	<option value="none" default="default"><?php _e('Choose a category', 'phoenix'); ?></option>
                    <?php    
                        $opt = get_option('phoenix_featured_posts_top');
                        $categories = get_categories('hide_empty=0&orderby=name');
                        foreach ($categories as $category_list ) {
                            $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
                            if ($category_list->cat_ID == $opt) {$selected = 'selected="selected"';} else {$selected = '';}
                            echo '<option value="'.$category_list->cat_ID.'" '.$selected.' >'.$category_list->cat_name.'</option>';
                        }
                    ?>
                </select>
                <div class="rt_clearfix"></div>
            </div>
            
            <h3><?php _e('Slider', 'phoenix'); ?></h3>
            <div class="rt_input rt_text">
                <div class="rt_description">
                    <label for="phoenix_slider_cat"><?php _e('Choose a slider category', 'phoenix'); ?></label>
                    <div class="rt_clearfix"></div>
                </div>
                <select name="phoenix_slider_cat" id="phoenix_slider_cat">
                	<option value="none" default="default"><?php _e('Choose a category', 'phoenix'); ?></option>
                    <?php    
                        $opt = get_option('phoenix_slider_cat');
                        $categories = get_categories('hide_empty=0&orderby=name');
                        foreach ($categories as $category_list ) {
                            $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
                            if ($category_list->cat_ID == $opt) {$selected = 'selected="selected"';} else {$selected = '';}
                            echo '<option value="'.$category_list->cat_ID.'" '.$selected.' >'.$category_list->cat_name.'</option>';
                        }
                    ?>
                </select>
                <div class="rt_clearfix"></div>
            </div>
        
        </div>
        <div id="rt_footer">
            <div class="rt_input rt_text">
                <div class="rt_description">
                    <label for="phoenix_copyright"><?php _e('Copyright text', 'phoenix'); ?></label>
                    <div class="rt_clearfix"></div>
                </div>
                <input name="phoenix_copyright" id="phoenix_copyright" type="text" value="<?php echo esc_attr(get_option('phoenix_copyright')); ?>" />
                <div class="rt_clearfix"></div>
            </div>     
        </div>
        <div id="rt_social">
            <h3><?php _e('Social buttons', 'phoenix'); ?></h3>
                        
            <div class="rt_input rt_text">
                <div class="rt_description">
                    <label for="phoenix_twitter"><?php _e('Twitter', 'phoenix'); ?></label>
                    <small><?php _e('Link for your Twitter account', 'phoenix'); ?></small>
                    <div class="rt_clearfix"></div>
                </div>
                <input name="phoenix_twitter" id="phoenix_twitter" type="text" value="<?php echo esc_attr(get_option('phoenix_twitter')); ?>" />
                <div class="rt_clearfix"></div>
            </div>

            <div class="rt_input rt_text">
                <div class="rt_description">
                    <label for="phoenix_facebook"><?php _e('Facebook', 'phoenix'); ?></label>
                    <small><?php _e('Link for Facebook page', 'phoenix'); ?></small>
                    <div class="rt_clearfix"></div>
                </div>
                <input name="phoenix_facebook" id="phoenix_facebook" type="text" value="<?php echo esc_attr(get_option('phoenix_facebook')); ?>" />
                <div class="rt_clearfix"></div>
            </div>
            
            <div class="rt_input rt_text">
                <div class="rt_description">
                    <label for="phoenix_pinterest"><?php _e('Pinterest', 'phoenix'); ?></label>
                    <small><?php _e('Link for Pinterest', 'phoenix'); ?></small>
                    <div class="rt_clearfix"></div>
                </div>
                <input name="phoenix_pinterest" id="phoenix_pinterest" type="text" value="<?php echo esc_attr(get_option('phoenix_pinterest')); ?>" />
                <div class="rt_clearfix"></div>
            </div>
        </div>
        <div class="clear"></div>
        <div id="toeThemeEditFormMsg"><?php if(isset($_GET['settings-updated']) && $_GET['settings-updated'] == true) _e('Done', 'phoenix'); ?></div>
        <p class="submit">
            <input type="submit" style="margin-left:17px;" class="button-primary" value="<?php _e('Save settings', 'phoenix') ?>"/>
        </p>
    </div>

    </form>
</div>

<?php 
} 
?>
