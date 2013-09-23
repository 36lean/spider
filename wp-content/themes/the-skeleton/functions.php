<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * The Skeleton functions and definitions
 *
 * @package The Skeleton
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'responsive_skeleton_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function responsive_skeleton_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on The Skeleton, use a find and replace
	 * to change 'the-skeleton' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'the-skeleton', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );


        /**
         * Add callback for custom TinyMCE editor stylesheets. (editor-style.css)
         * @see http://codex.wordpress.org/Function_Reference/add_editor_style
         */
        add_editor_style();

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
        

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'the-skeleton' ),
                'secondary' => __( 'Secondary Menu', 'the-skeleton' ),
                'third' => __( 'Footer Menu', 'the-skeleton' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

        /**
	 * Enable support for WooCommerce
	 */
        add_theme_support( 'woocommerce' );

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'Skeleton_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'Skeleton_theme_wrapper_end', 10);

function Skeleton_theme_wrapper_start() {
  echo '<div id="primary-woocommerce" class="content-area-woocommerce"><main id="main" class="site-main" role="main"><div id="woocommerce-shop-plus">';
}

function Skeleton_theme_wrapper_end() {
  echo '</div></main></div>';
}

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'responsive_skeleton_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // responsive_skeleton_setup
add_action( 'after_setup_theme', 'responsive_skeleton_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function responsive_skeleton_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'the-skeleton' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	)                         
 );
}
add_action( 'widgets_init', 'responsive_skeleton_widgets_init' );

function responsive_skeleton_widgets_init2() {
	register_sidebar( array(
		'name'          => __( 'Sidebar Left', 'the-skeleton' ),
		'id'            => 'sidebar-left',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	)
);
}
add_action( 'widgets_init', 'responsive_skeleton_widgets_init2' );


function responsive_skeleton_widgets_init12() {
	register_sidebar( array(
		'name'          => __( 'Sidebar bbpress', 'the-skeleton' ),
		'id'            => 'sidebar-bbpress',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	)                         
 );
}
add_action( 'widgets_init', 'responsive_skeleton_widgets_init12' );



function responsive_skeleton_widgets_init3() {
	register_sidebar( array(
		'name'          => __( 'Widgets Column 1', 'the-skeleton' ),
		'id'            => 'sidebar-home1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	)
);
}
add_action( 'widgets_init', 'responsive_skeleton_widgets_init3' );

function responsive_skeleton_widgets_init4() {
	register_sidebar( array(
		'name'          => __( 'Widgets Column 2', 'the-skeleton' ),
		'id'            => 'sidebar-home2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	)
);
}
add_action( 'widgets_init', 'responsive_skeleton_widgets_init4' );

function responsive_skeleton_widgets_init5() {
	register_sidebar( array(
		'name'          => __( 'Widgets Column 3', 'the-skeleton' ),
		'id'            => 'sidebar-home3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	)
);
}
add_action( 'widgets_init', 'responsive_skeleton_widgets_init5' );

function responsive_skeleton_widgets_init6() {
	register_sidebar( array(
		'name'          => __( 'Related Sidebar 1', 'the-skeleton' ),
		'id'            => 'sidebar-related1',
		'before_widget' => '<aside id="%1$s" class="rps %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title rps">',
		'after_title'   => '</h1>',
	)
);
}
add_action( 'widgets_init', 'responsive_skeleton_widgets_init6' );

function responsive_skeleton_widgets_init7() {
	register_sidebar( array(
		'name'          => __( 'Related Sidebar 2', 'the-skeleton' ),
		'id'            => 'sidebar-related2',
		'before_widget' => '<aside id="%1$s" class="ras %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title ras">',
		'after_title'   => '</h1>',
	)
);
}
add_action( 'widgets_init', 'responsive_skeleton_widgets_init7' );

function responsive_skeleton_widgets_init8() {
	register_sidebar( array(
		'name'          => __( 'Footer Column 1', 'the-skeleton' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="footer1 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="footer-title">',
		'after_title'   => '</h1>',
	)                         
 );
}
add_action( 'widgets_init', 'responsive_skeleton_widgets_init8' );

function responsive_skeleton_widgets_init9() {
	register_sidebar( array(
		'name'          => __( 'Footer Column 2', 'the-skeleton' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="footer2 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="footer-title">',
		'after_title'   => '</h1>',
	)                         
 );
}
add_action( 'widgets_init', 'responsive_skeleton_widgets_init9' );

function responsive_skeleton_widgets_init10() {
	register_sidebar( array(
		'name'          => __( 'Footer Column 3', 'the-skeleton' ),
		'id'            => 'sidebar-4',
		'before_widget' => '<aside id="%1$s" class="footer3 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="footer-title">',
		'after_title'   => '</h1>',
	)                         
 );
}
add_action( 'widgets_init', 'responsive_skeleton_widgets_init10' );

function responsive_skeleton_widgets_init11() {
	register_sidebar( array(
		'name'          => __( 'Footer Column 4', 'the-skeleton' ),
		'id'            => 'sidebar-5',
		'before_widget' => '<aside id="%1$s" class="footer4 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="footer-title">',
		'after_title'   => '</h1>',
	)                         
 );
}
add_action( 'widgets_init', 'responsive_skeleton_widgets_init11' );


/**
 * Enqueue scripts and styles
 */
function responsive_skeleton_scripts() {
	wp_enqueue_style( 'the-skeleton-style', get_stylesheet_uri() );

	wp_enqueue_script( 'the-skeleton-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'the-skeleton-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'the-skeleton-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'responsive_skeleton_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Search bar in navigation menu.
 */
add_filter('wp_nav_menu_items','rskeleton_add_search_box', 10, 2);

function rskeleton_add_search_box($items, $args) {
    if($args->theme_location == 'primary') {
        ob_start();
        get_search_form();
        $searchform = ob_get_contents();
        ob_end_clean();
 
        return $items .= '<li id="searchform-item">' . $searchform . '</li>';
    }
    return $items;
}

/**
 * Replace excerpt more text
 */
function rskeleton_new_excerpt_more( $more ) {
	return '<span style="font-weight:700;"><a> ...</a></span>';
}
add_filter('excerpt_more', 'rskeleton_new_excerpt_more');


/**
 * Adds video option as featured image
 */
if( WP_ADMIN )
{
	add_action( 'save_post',  'rskeleton_save_related_video_item' );
	add_action( 'admin_menu', 'rskeleton_add_fv_box_fields' );
}

function rskeleton_add_fv_box_fields() {
    add_meta_box( 'docs_list', __( 'Featured Video', 'related-video' ), 'rskeleton_admin_fv_box_html', 'page', 'side' );
    add_meta_box( 'docs_list', __( 'Featured Video', 'related-video' ), 'rskeleton_admin_fv_box_html', 'post', 'side' );
}


function rskeleton_admin_fv_box_html()
{
    global $post;

    $rel_video = get_post_meta( $post->ID, '_related-video', true );
?>
    <div><p>Enter the video embed code:</p>
    <textarea name="rel_video" class="widefat" style="height:220px;"><?php echo $rel_video; ?></textarea>
    <input type="hidden" name="docs_check_nonce" id="docs_check_nonce" value="<?php echo wp_create_nonce( plugin_basename(__FILE__) ); ?>" />
    </div>
<?php
}


function rskeleton_save_related_video_item(){

    global $post;

	if( $post_id==null )
	{
		$post_id = $post->ID;
	}

        // security check, return the post id if access denied
        if ( !wp_verify_nonce( $_POST['docs_check_nonce'], plugin_basename(__FILE__) )) {
           return $post_id;
	}

	// return post id and bypass autosaves as well
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return $post_id;
	}

	// checking the current user permissions ....
	if ( $_POST['post_type'] == 'page' ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
			return $post_id;
	} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
	}

	// So we passed everything ...

        if ( isset($_POST['rel_video']) ) {
            // clean all doc meta, we are going to add all current ones again and the new ones ...
	    delete_post_meta($post_id, '_related-video');

	    $rel_video = $_POST['rel_video'];
	    add_post_meta( $post_id, '_related-video', $rel_video );
        }
	return;
}

/**
 * Number Of Products to show per page
 */
add_filter('loop_shop_per_page', 'rskeleton_show_products_per_page' );

function rskeleton_show_products_per_page() {
return 20;
}

/** reference woocommerce/templates/loop/add-to-cart.php
 * external read more text change - WooCommerce
 */
add_filter('external_add_to_cart_text', 'rskeleton_remove_ext_text');
add_filter('not_purchasable_text', 'rskeleton_remove_ext_text');
function rskeleton_remove_ext_text() {
		return __('See More', 'the-skeleton');
		}

/** 
 * Change excerpt length if two column
 */
function rskeleton_custom_excerpt_length( $length ) {
	return 27;
}
function hook_length() {
$options = get_option( 'rskeleton_settings' );
if ( $options['two_column'] == "1" ) {
add_filter( 'excerpt_length', 'rskeleton_custom_excerpt_length', 999 );
}}


/** 
 * Adds grandparent to menu
 */
add_filter( 'wp_nav_menu_objects', 'rskeleton_add_menu_parent_class' );
function rskeleton_add_menu_parent_class( $items ) {
	
	$parents = array();
	foreach ( $items as $item ) {
		if ( $item->menu_item_parent && $item->menu_item_parent > 1 ) {
			$parents[] = $item->menu_item_parent;
		}
	}
	
	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			$item->classes[] = 'grandparent'; 
		}
	}
	
	return $items;    
}

/** 
 * Adds admin menu
 * 
 */

// registers default values
	$defaults = array( 
                 'featured_disabler' => 1,
                 'blogging_platform' => __( 'Blogging Content', 'the-skeleton' ),
                 'feature_header' => __( 'Featured Content', 'the-skeleton' ),
                 'woo_header' => __( 'WooCommerce Featured Products', 'the-skeleton' ),
                 'blogging_disabler' => 1,
                 'copyright_text' => __( 'Your Copyright text goes here', 'the-skeleton' ),
                 'credits_text' => 'Theme: The Skeleton Pro by <a href="http://trottyzone.com/" rel="designer">TROTTYZONE</a>'

          );

	add_option( 'rskeleton_settings', $defaults );

// Hook for adding admin menus
add_action('admin_menu', 'responsive_skeleton_submenu_page');
add_action( 'admin_init', 'responsive_skeleton_theme_options_init' );

function responsive_skeleton_submenu_page() {
    add_theme_page(__('The Skeleton Pro Theme Options', 'the-skeleton'), __('Theme Options', 'the-skeleton'), 'edit_theme_options', 'responsive_skeleton_theme_options', 'responsive_skeleton_theme_settings');
}

function responsive_skeleton_theme_options_init() {	
register_setting( 'rskeleton_options', 'rskeleton_settings' );
}

function rskeleton_custom_css() {
$options = get_option( 'rskeleton_settings' );

if ( !empty ( $options['custom_css'] ) ) {

		echo '<style type="text/css">'.$options['custom_css'].'</style>';
}
	}
add_action( 'wp_head', 'rskeleton_custom_css' );


function responsive_skeleton_theme_settings() {
        // must check that the user has the required capability 
    if (!current_user_can('manage_options'))
    {
      wp_die( __('You do not have sufficient permissions to access this page.', 'the-skeleton') );
    }

 // variables for the field and option names 
    $hidden_field_name = 'rskeleton_submit_hidden';
	

// read options values
$options = get_option( 'rskeleton_settings' );

    if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {

        // Save the posted value in the database
update_option( 'rskeleton_settings', $options );

?>

<div class="updated"><p><strong><?php _e('settings saved.', 'the-skeleton'); ?></strong></p></div>

<?php 
}

          // Now display the settings editing screen
         echo '<div class="wrap">';
    
       // icon for settings
    echo '<div id="icon-themes" class="icon32"><br></div>';

      // header Name
    echo "<h2>" . __( 'The Skeleton Pro Theme Options', 'the-skeleton' ) . "</h2>";

?>

<form name="form" method="post" action="options.php" id="form1">

<?php settings_fields( 'rskeleton_options' );
			$options = get_option( 'rskeleton_settings' ); ?>

<script type="text/javascript">
jQuery(document).ready(function() {

jQuery(function () {
    jQuery(".show_hide").click(function() {
        
  jQuery(this).next().toggle();
      if( jQuery('.slidingDiv').length > 1) {
            jQuery('.slidingDiv table:vissible').hide();

            jQuery(this).next().show();
       }
    }); 
}); 


});
</script>

<?php submit_button(); ?>
<div id="rs-keep-stuff" style="width:80%;">

<!-- Front Page Editor -->
<div class="show_hide"><a href="#">
<table class="widefat" border="1" style="margin-top:5px;">
<thead>
	<tr>
                <th><?php _e('Front Page Editor', 'the-skeleton');  ?></th>	
		<th><div  style="font-size: 30px;float:right;padding-right:3px;">&equiv;</div></th>	
	</tr>
</thead>
</table>
</a></div>


<div class="slidingDiv" style="display:none;">
<table class="widefat" border="1">
<tbody>
        <tr>
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
               <td><?php _e('WooCommerce Header', 'the-skeleton');  ?></td>

              <td style="width:70%;"><input style="width:98%;" type="text" name="rskeleton_settings[woo_header]" value="<?php echo esc_attr($options['woo_header']); ?>" /></td>
        </tr>
</tbody>

<tbody>
        <tr>
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
               <td><?php _e('Feature Header', 'the-skeleton');  ?></td>

              <td style="width:70%;"><input style="width:98%;" type="text" name="rskeleton_settings[feature_header]" value="<?php echo esc_attr($options['feature_header']); ?>" /></td>
        </tr>
</tbody>

<tbody>
        <tr>
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
               <td><?php _e('Blogging Platform Header', 'the-skeleton');  ?></td>

              <td style="width:70%;"><input style="width:98%;" type="text" name="rskeleton_settings[blogging_platform]" value="<?php echo esc_attr($options['blogging_platform']); ?>" /></td>
        </tr>
</tbody>

<tbody>
        <tr>
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
               <td><?php _e('Show Post for Category', 'the-skeleton');  ?><br>- <span style="font-size:11px;"><?php _e('example 12, 15, 17', 'the-skeleton'); ?></span></td>

              <td style="width:70%;"><input style="width:98%;" type="text" name="rskeleton_settings[query_front]" value="<?php echo esc_attr($options['query_front']); ?>" /></td>
        </tr>
</tbody>

<tbody>
        <tr>
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
               <td><?php _e('Enable / Disable WooCommerce Section', 'the-skeleton');  ?></td>

              <td style="width:70%;"><input type="checkbox" name="rskeleton_settings[woo_disabler]" value="1" <?php checked($options['woo_disabler'], 1); ?> /></td>
        </tr>
</tbody>

<tbody>
        <tr>
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
               <td><?php _e('Enable / Disable Featured Section', 'the-skeleton');  ?></td>

              <td style="width:70%;"><input type="checkbox" name="rskeleton_settings[featured_disabler]" value="1" <?php checked($options['featured_disabler'], 1); ?> /></td>
        </tr>
</tbody>

<tbody>
        <tr>
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
               <td><?php _e('Enable / Disable Blogging Header', 'the-skeleton');  ?></td>

              <td style="width:70%;"><input type="checkbox" name="rskeleton_settings[blogging_disabler]" value="1" <?php checked($options['blogging_disabler'], 1); ?> /></td>
        </tr>
</tbody>


</table>
</div>
<!-- end of Front Page Editor -->


<!-- Sidebar Controller -->
<div class="show_hide"><a href="#">
<table class="widefat" border="1" style="margin-top:20px;">
<thead>
	<tr>
                <th><?php _e('Layout Controller', 'the-skeleton');  ?></th>	
		<th><div  style="font-size: 30px;float:right;padding-right:3px;">&equiv;</div></th>	
	</tr>
</thead>
</table>
</a></div>


<div class="slidingDiv" style="display:none;">
<table class="widefat" border="1">


<tbody>
        <tr>
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
               <td><?php _e('Turn on two Column Post', 'the-skeleton');  ?></td>

              <td style="width:70%;"><input type="checkbox" name="rskeleton_settings[two_column]" value="1" <?php checked($options['two_column'], 1); ?> /></td>
        </tr>
</tbody>


<tbody>
        <tr>
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
               <td><?php _e('Turn on Left Sidebar', 'the-skeleton');  ?></td>

              <td style="width:70%;"><input type="checkbox" name="rskeleton_settings[left_sidebar_archives]" value="1" <?php checked($options['left_sidebar_archives'], 1); ?> /></td>
        </tr>
</tbody>


<tbody>
        <tr>
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
               <td><?php _e('Turn on bbpress sidebar', 'the-skeleton');  ?></td>

              <td style="width:70%;"><input type="checkbox" name="rskeleton_settings[sidebar_bbpress]" value="1" <?php checked($options['sidebar_bbpress'], 1); ?> /></td>
        </tr>
</tbody>



</table>
</div>
<!-- end of Sidebar Controller -->


<!-- Social Links -->
<div class="show_hide"><a href="#">
<table class="widefat" border="1" style="margin-top:20px;">
<thead>
	<tr>
                <th><?php _e('Social Links', 'the-skeleton');  ?></th>	
		<th><div  style="font-size: 30px;float:right;padding-right:3px;">&equiv;</div></th>	
	</tr>
</thead>
</table>
</a></div>

<div class="slidingDiv" style="display:none;">
<table class="widefat" border="1">


<tbody>
        <tr>
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
               <td><?php _e('Twitter', 'the-skeleton');  ?></td>

              <td style="width:70%;"><input style="width:98%;" type="text" name="rskeleton_settings[twitter_link]" value="<?php echo esc_attr($options['twitter_link']); ?>" /></td>
        </tr>
</tbody>


<tbody>
        <tr>
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
               <td><?php _e('Facebook', 'the-skeleton');  ?></td>

              <td style="width:70%;"><input style="width:98%;" type="text" name="rskeleton_settings[facebook_link]" value="<?php echo esc_attr($options['facebook_link']); ?>" /></td>
        </tr>
</tbody>


<tbody>
        <tr>
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
               <td><?php _e('Email', 'the-skeleton');  ?></td>

              <td style="width:70%;"><input style="width:98%;" type="text" name="rskeleton_settings[email_link]" value="<?php echo esc_attr($options['email_link']); ?>" /></td>
        </tr>
</tbody>



</table>
</div>
<!-- end of Social Links -->




<!-- Footer Handler -->
<div class="show_hide"><a href="#">
<table class="widefat" border="1" style="margin-top:20px;">
<thead>
	<tr>
                <th><?php _e('Footer Handler', 'the-skeleton');  ?></th>	
		<th><div  style="font-size: 30px;float:right;padding-right:3px;">&equiv;</div></th>	
	</tr>
</thead>
</table>
</a></div>


<div class="slidingDiv" style="display:none;">
<table class="widefat" border="1">


<tbody>
        <tr>
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
               <td><?php _e('Copyright Text', 'the-skeleton');  ?></td>

              <td style="width:70%;"><input style="width:98%;" type="text" name="rskeleton_settings[copyright_text]" value="<?php echo esc_attr($options['copyright_text']); ?>" /></td>
        </tr>
</tbody>


<tbody>
        <tr>
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
               <td><?php _e('Credits Text', 'the-skeleton');  ?></td>

              <td style="width:70%;"><input style="width:98%;" type="text" name="rskeleton_settings[credits_text]" value="<?php echo esc_attr($options['credits_text']); ?>" /></td>
        </tr>
</tbody>


<tbody>
        <tr>
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
               <td><?php _e('Enable / Disable Footer Widgets', 'the-skeleton');  ?></td>

              <td style="width:70%;"><input type="checkbox" name="rskeleton_settings[footer_widgets_disabler]" value="1" <?php checked($options['footer_widgets_disabler'], 1); ?> /></td>
        </tr>
</tbody>


</table>
</div>
<!-- end of Footer Handler -->




<!-- Custom CSS -->
<div class="show_hide"><a href="#">
<table class="widefat" border="1" style="margin-top:20px;">
<thead>
	<tr>
                <th><?php _e('Custom CSS', 'the-skeleton');  ?></th>	
		<th><div  style="font-size: 30px;float:right;padding-right:3px;">&equiv;</div></th>	
	</tr>
</thead>
</table>
</a></div>

<div class="slidingDiv" style="display:none;">
<table class="widefat" border="1">
<tbody>
        <tr>
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
               <td>
<?php _e('
What is CSS?<br><br>
CSS language stands for Cascading Style Sheets which is used to style html content. You can change the fonts size, colours, margins of content, which lines to show or input, adjust height, width, background images etc.
<br><br>
Get help in our Support
', 'the-skeleton');  ?>
<a href="http://www.trottyzone.com/forums/forum/website-support/"><?php _e('Forum', 'the-skeleton');  ?></a>.
               </td>

              <td style="width:70%;"><textarea name="rskeleton_settings[custom_css]" style="width: 100%;height:500px;"><?php echo esc_attr($options['custom_css']); ?></textarea></td>
        </tr>
</tbody>
</table>
</div>
<!-- end of Custom CSS -->


</div>
</form>

<?php
}
/** 
 * End admin menu
 * 
 */
add_action('template_redirect', 'register_a_user');
function register_a_user(){
  if(isset($_GET['do']) && $_GET['do'] == 'register'):
    $errors = array();
    if(empty($_POST['skel_user_login']) || empty($_POST['skel_user_email'])) $errors[] = 'Please enter username or e-mail address.';
    if(!empty($_POST['skel_spam'])) $errors[] = 'Woops! look like you didn\'t delete that text.';

    $user_login = esc_attr($_POST['skel_user_login']);
    $user_email = esc_attr($_POST['skel_user_email']);
    require_once(ABSPATH.WPINC.'/registration.php');

    $sanitized_user_login = sanitize_user($user_login);
    $user_email = apply_filters('user_registration_email', $user_email);

    if(!is_email($user_email)) $errors[] = 'E-mail address is not correct.';
    elseif(email_exists($user_email)) $errors[] = 'E-mail address is already registered.';

    if(empty($sanitized_user_login) || !validate_username($user_login)) $errors[] = 'Username is not correct.';
    elseif(username_exists($sanitized_user_login)) $errors[] = 'Username is already registered.';

    if(empty($errors)):
      $user_pass = wp_generate_password();
      $user_id = wp_create_user($sanitized_user_login, $user_pass, $user_email);

      if(!$user_id):
        $errors[] = 'Oops! Registration has failed. Please try again.';
      else:
        update_user_option($user_id, 'default_password_nag', true, true);
        wp_new_user_notification($user_id, $user_pass);
      endif;
    endif;

    if(!empty($errors)) define('REGISTRATION_ERROR', serialize($errors));
    else define('REGISTERED_A_USER', $user_email);
  endif;
}
/** 
 * login from wp-login.php redirects to homepage
 * 
 */
function skel_login_redirect() {
  return '/';
}
add_filter('login_redirect', 'skel_login_redirect');