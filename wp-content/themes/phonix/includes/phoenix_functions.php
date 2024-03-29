<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

add_action( 'after_setup_theme', 'phoenix_setup' );

if ( ! function_exists( 'phoenix_setup' ) ):
    function phoenix_setup() {
        // Navigations
        register_nav_menus(array(
            'main-menu' => __('Main menu', 'phoenix')
        ));
        
        add_image_size( 'slide', 130, 100, true );

        /**
         * Sets up the content width value based on the theme's design and stylesheet.
         */
        if ( ! isset( $content_width ) )
            $content_width = 960;
            
        // This theme styles the visual editor with editor-style.css to match the theme style.
        add_editor_style();

        // Adds RSS feed links to <head> for posts and comments.
        add_theme_support( 'automatic-feed-links' );

        // Add posts thumbs
        add_theme_support( 'post-thumbnails' );	
        
        /*
         * This theme supports custom background color and image, and here
         * we also set up the default background color.
         */
        add_theme_support( 'custom-background', array(
            'default-color' => 'fff',
        ) );
        
        /*
         * Makes Phoenix available for translation.
         *
         * Translations can be added to the /languages/ directory.
         */
        load_theme_textdomain( 'phoenix', get_template_directory() . '/languages' );
    }
endif;

function phoenix_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar', 'phoenix'),
        'description' => __('Main right area', 'phoenix'),
        'id' => 'footer-sidebar',
        'before_title' => '<div class="widget-title">',
        'after_title' => '</div>
              <div class="widget-content">',
        'before_widget' => '<div id="%1$s" class="widget columns small-12 large-3 %2$s">',
        'after_widget' => '</div>
            </div>'
    ));

    register_sidebar(array(
        'name' => __('Footer Sidebar', 'phoenix'),
        'description' => __('Footer area', 'phoenix'),
        'id' => 'footer-sidebar',
        'before_title' => '<div class="widget-title">',
        'after_title' => '</div>
              <div class="widget-content">',
        'before_widget' => '<div id="%1$s" class="widget columns small-12 large-3 %2$s">',
        'after_widget' => '</div>
            </div>'
    ));

    register_sidebar(array(
        'name' => __('Single page sidebar', 'phoenix'),
        'description' => __('Sidebar for your widgets on single pages', 'phoenix'),
        'id' => 'side',
        'before_title' => '<div class="side-widget-title">',
        'after_title' => '</div><div class="side-widget-content">',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div></div>'
    ));
}
add_action( 'widgets_init', 'phoenix_widgets_init' );

/**
 * A safe way of adding JavaScripts to a WordPress generated page.
 */
if (!is_admin())
    add_action('wp_enqueue_scripts', 'phoenix_js');

if (!function_exists('phoenix_js')) {

    function phoenix_js() {
        // JS at the bottom for fast page loading. 
        // except for Modernizr which enables HTML5 elements & feature detects.
        wp_enqueue_script('jquery');
        wp_enqueue_script('modernizr', get_template_directory_uri() . '/includes/foundation/js/vendor/custom.modernizr.js', array('jquery'), '2.6.2', false);
        wp_enqueue_script('zepto', get_template_directory_uri() . '/includes/foundation/js/vendor/zepto.js', array('jquery'), '1.0', false);
        wp_enqueue_script('foundation', get_template_directory_uri() . '/includes/foundation/js/foundation.min.js', array('jquery'), '4.3.1', false);
        wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0', false);
        if ( is_singular() ) wp_enqueue_script( "comment-reply" );
        
        // stylesheet
        wp_enqueue_style('foundation-style', get_template_directory_uri() . '/includes/foundation/css/foundation.min.css', false, '4.1.6');
        wp_enqueue_style('phoenix-style', get_stylesheet_uri(), false, '1');
    }

}

// Comments
function phoenix_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'phoenix' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'phoenix' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment row">
            <div class="large-2 small-2 columns">
                <?php echo get_avatar( $comment, 64 ); ?>
            </div>
            <div class="large-10 small-10 columns">
                <header class="comment-meta comment-author">
                    <?php
                        printf( '<cite class="fn">%1$s</cite>', get_comment_author_link() );
                    ?>
                    <div class="reply">
                        &#8226; <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'phoenix' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                    </div><!-- .reply -->
                </header><!-- .comment-meta -->

                <?php if ( '0' == $comment->comment_approved ) : ?>
                    <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'phoenix' ); ?></p>
                <?php endif; ?>

                <section class="comment-content comment">
                    <?php comment_text(); ?>
                </section><!-- .comment-content -->
            </div>
		</article><!-- #comment-## -->
        <div class="clear"></div>
	<?php
		break;
	endswitch; // end comment_type check
}

// Responsive slider
function phoenix_responsive_slider(){
    if (get_option('phoenix_slider_cat')){
        $cat = get_option('phoenix_slider_cat');
    } else {
        $cat = 1;
    }
    $query = new WP_Query('cat='.$cat.'&posts_per_page=-1');
?>
    <ul data-orbit data-options="bullets:true">
<?php while($query->have_posts()){ $query->the_post(); ?>
        <li>
            <a href="<?php the_permalink(); ?>">
                 <?php echo get_the_post_thumbnail(get_the_id(), 'large', array('alt' => get_the_title())); ?>
            </a>
                   
            <div class="orbit-caption"><?php the_excerpt(); ?></div>
        </li>
<?php }?>
    </ul>
<?php 
    wp_reset_postdata();
} // end Responsive Slider

add_filter( 'wp_title', 'phoenix_title', 10, 3 );
function phoenix_title( $title, $sep, $seplocation )
{
    global $page, $paged;
    // Don't affect in feeds.
    if ( is_feed() )
        return $title;
    // Add the blog name
    if ( 'right' == $seplocation )
        $title .= get_bloginfo( 'name' );
    else
        $title = get_bloginfo( 'name' ) . $title;
    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        $title .= " {$sep} {$site_description}";
    // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 )
        $title .= " {$sep} " . sprintf( __( 'Page %s', 'phoenix' ), max( $paged, $page ) );
    return $title;
}

function phoenix_footer_script(){ ?>
    <script type="text/javascript">
                jQuery(document).foundation();
    </script>
<?php } 
add_action('wp_footer', 'phoenix_footer_script');

?>