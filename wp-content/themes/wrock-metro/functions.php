<?php
ob_start();
include_once get_template_directory() . '/functions/wrockmetro-functions.php';
if ('optionsframework_init') {
    /* ----------------------------------------------------------------------------------- */
    /* Options Framework Theme
      /*----------------------------------------------------------------------------------- */
    /* Set the file path based on whether the Options Framework Theme is a parent theme or child theme */
    //if (STYLESHEETPATH == get_template_directory()) {
        define('OPTIONS_FRAMEWORK_URL', get_template_directory() . '/functions/');
        define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/functions/');
   // } else {
        //define('OPTIONS_FRAMEWORK_URL', STYLESHEETPATH . '/functions/');
        //define('OPTIONS_FRAMEWORK_DIRECTORY', get_stylesheet_directory_uri() . '/functions/');
    //}
	/*
  Plugin Name: Options Framework
  Plugin URI: http://www.wptheming.com
  Description: A framework for building theme options.
  Version: 0.8
  Author: Devin Price
  Author URI: http://www.wptheming.com
  License: GPLv2
 */
    require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');
}

function wrockmetro_scripts() {

	wp_enqueue_script('topnavi', get_template_directory_uri().'/js/topnavi.js', array('jquery'), '1.0', false );
	wp_enqueue_style( 'wrockmetro-style', get_stylesheet_uri() );
/**
 * Enqueues the javascript for comment replys 
 * 
 * */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	}
add_action( 'wp_enqueue_scripts', 'wrockmetro_scripts' );

	
/**
 * Sets up the content width value based on the theme's design.
 */
if ( ! isset( $content_width ) )
	$content_width = 670;
	
	
	
	/*
	* Home Icon for Menu
	*/
	function wrockmetro_hdmenu() {
		echo '<ul>';
		if ('page' != get_option('show_on_front')) {
		if (is_front_page())
$class = 'class="current_page_item home-icon"';
else
$class = 'class="home-icon"';
			echo '<li ' . $class . ' ><a href="'.esc_url( home_url() ). '/"><img src="'. get_template_directory_uri() . '/images/home.jpg" width="26" height="24"/></a></li>';
		}
		wp_list_pages('title_li=');
		echo '</ul>';
	}

add_filter( 'wp_nav_menu_items', 'wrockmetro_home_link', 10, 2 );
function wrockmetro_home_link($items, $args) {
if (is_front_page())
$class = 'class="current_page_item home-icon"';
else
$class = 'class="home-icon"';
$homeMenuItem =
'<li ' . $class . '>' .
$args->before .
'<a href="' . esc_url( home_url( '/')). '" title="Home">' .
$args->link_before . '<img src="'. get_template_directory_uri() . '/images/home.jpg" width="26" height="24" alt="Home" />' . $args->link_after .
'</a>' .
$args->after .
'</li>';
$items = $homeMenuItem . $items;
return $items;
}


/* Enable support for post-thumbnails ********************************************/
		
	// If we want to ensure that we only call this function if
	// the user is working with WP 2.9 or higher,
	// let's instead make sure that the function exists first
	
function wrockmetro_theme_setup() { 
	add_theme_support( 'post-thumbnails', array( 'post' ) ); // Add it for posts
	set_post_thumbnail_size( 150, 150, true ); // Normal post thumbnails, 200 pixels wide by 200 pixels tall, hard crop mode
	
		/**
         * Wrockmetro translations.
         * Add your files into /languages/ directory.
		 * @see http://codex.wordpress.org/Function_Reference/load_theme_textdomain
         */
	    load_theme_textdomain('wrockmetro', get_template_directory() . '/languages');
		/**
         * Add callback for custom editor stylesheets. (editor-style.css)
         * @see http://codex.wordpress.org/Function_Reference/add_editor_style
         */
		 
        add_editor_style();
		register_nav_menus(
			array(
 				'wrockmetro-top-menu' => __('Top Menu' , 'wrockmetro' ),
 				'wrockmetro-navigation' => __('Navigation', 'wrockmetro' ),
			)		
		);
		
		/**
         * This feature enables post and comment RSS feed links to head.
         * @see http://codex.wordpress.org/Function_Reference/add_theme_support#Feed_Links
         */
        add_theme_support('automatic-feed-links');
		}
		/**
         * This feature adds a callbacks for image header display.
		 * In our case we are using this to display logo.
         * @see http://codex.wordpress.org/Custom_Headers
         */		
					add_theme_support('custom-header', array (
	        
			'default-image'			=> get_template_directory_uri() . '/images/logo.png',
	        'header-text'			=> false,
	        'flex-width'             => true,
	        'width'				    => 470,
		    'flex-height'            => true,
	        'height'			        => 100));
	// Add Support for Custom Backgrounds
		add_theme_support('custom-background', array(
			'default-color' => 'fff',
			));
		
	add_action( 'after_setup_theme', 'wrockmetro_theme_setup' );
	
function wrockmetro_post_meta_data() {
	printf( __( '%2$s  %4$s', 'wrockmetro' ),
	'meta-prep meta-prep-author posted', 
	sprintf( '<span itemprop="datePublished" class="timestamp updated">%3$s</span>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_html( get_the_date() )
	),
	'byline',
	sprintf( '<span class="author vcard" itemprop="author" itemtype="http://schema.org/Person"><span class="fn">%3$s</span></span>',
		get_author_posts_url( get_the_author_meta( 'ID' ) ),
		sprintf( esc_attr__( 'View all posts by %s', 'wrockmetro' ), get_the_author() ),
		esc_attr( get_the_author() )
		)
	);
}

/* Excerpt ********************************************/

    function wrockmetro_excerptlength_teaser($length) {
    return 10;
    }
    function wrockmetro_excerptlength_index($length) {
    return 45;
    }
    function wrockmetro_excerptmore($more) {
    return '...';
    }
    
    
    function wrockmetro_excerpt($length_callback='', $more_callback='') {
    global $post;
    
    add_filter('excerpt_length', $length_callback);
    add_filter('excerpt_more', $more_callback);
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>'.$output.'</p>';
    echo $output;
    }



/* Widgets ********************************************/

    function wrockmetro_widgets_init() {

	register_sidebar(array(
		'name' => __( 'Sidebar Right', 'wrockmetro' ),
	    'before_widget' => '<div class="box clearfloat"><div class="boxinside clearfloat">',
	    'after_widget' => '</div></div>',
	    'before_title' => '<h4 class="widgettitle">',
	    'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name' => __( 'Sidebar left', 'wrockmetro' ),
	    'before_widget' => '<div class="box clearfloat"><div class="boxinside clearfloat">',
	    'after_widget' => '</div></div>',
	    'before_title' => '<h4 class="widgettitle">',
	    'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name' => __( 'Bottom Menu 1', 'wrockmetro' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h4>',
	    'after_title' => '</h4>',
	));

	register_sidebar(array(
		'name' => __( 'Bottom Menu 2', 'wrockmetro' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h4>',
	    'after_title' => '</h4>',
	));	

	register_sidebar(array(
		'name' => __( 'Bottom Menu 3', 'wrockmetro' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h4>',
	    'after_title' => '</h4>',
	));	

	register_sidebar(array(
		'name' => __( 'Bottom Menu 4', 'wrockmetro' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h4>',
	    'after_title' => '</h4>',
	));	

}
add_action('widgets_init', 'wrockmetro_widgets_init');
//---------------------------- [ Pagenavi Function ] ------------------------------//
 
function wrockmetro_pagenavi() {
  global $wp_query, $wp_rewrite;
  $pages = '';
  $max = $wp_query->max_num_pages;
  if (!$current = get_query_var('paged')) $current = 1;
  $args['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
  $args['total'] = $max;
  $args['current'] = $current;
 
  $total = 1;
  $args['mid_size'] = 3;
  $args['end_size'] = 1;
  $args['prev_text'] = '&#171; Prev';
  $args['next_text'] = 'Next &raquo;';
 
  if ($max > 1) echo '<div class="wp-pagenavi">';
 echo $pages . paginate_links($args);
 if ($max > 1) echo '</div>';
}

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since Wrock Metro 1.6
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function wrockmetro_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'wrockmetro' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'wrockmetro_wp_title', 10, 2 );

ob_clean();
?>