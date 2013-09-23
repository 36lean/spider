<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

?>
<!DOCTYPE html>
<!--[if !IE]>      <html class="no-js non-ie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="no-js ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">

<title><?php wp_title( '|', true, 'right' ); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <header id="header" class="row">
      <div id="logo" class="small-12 large-8 columns">
        <span class="site-name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"><?php bloginfo('name'); ?></a></span><br />
        <span class="site-description"><?php bloginfo('description'); ?></span><br />
      </div>
      <div class="small-12 large-4 columns social-search">
        <form action="<?php echo esc_url( home_url( '/' ) ); ?>">
          <input type="text" name="s" id="s" />
        </form>
        <span class="socials">
            <?php if(get_option('phoenix_twitter')): ?>
                <a href="<?php echo esc_url(get_option('phoenix_twitter')); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png" alt="<?php _e('Follow us on Twiiter', 'phoenix'); ?>" /></a>
            <?php endif; ?>
            <?php if(get_option('phoenix_facebook')): ?>
                <a href="<?php echo esc_url(get_option('phoenix_facebook')); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png" alt="<?php _e('Like us on Facebook', 'phoenix'); ?>" /></a>
            <?php endif; ?>
            <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/mail.png" alt="<?php _e('Contact us via email', 'phoenix'); ?>" /></a>
            <?php if(get_option('phoenix_pinterest')): ?>
                <a href="<?php echo esc_url(get_option('phoenix_pinterest')); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/pinterest.png" alt="<?php _e('Pin us on Pinterest', 'phoenix'); ?>" /></a>
            <?php endif; ?>
        </span>
      </div>
    </header>
		
    <div id="main-navigation" class="row">
      <nav class="large-8 small-12 columns navigation">
        <?php wp_nav_menu( array(
				'theme_location' => 'main-menu',
				'container' => '',
				'menu_class' => 'nav',
				'menu_id' => 'main-nav',
				'fallback_cb' => 'wp_page_menu'
				)); ?>
						
				<div class="mobile-nav">
                    <a href="#" data-dropdown="drop2" class="small expand secondary radius button dropdown"><?php _e('Navigation', 'phoenix'); ?></a>
                    
                    <?php wp_nav_menu( array(
                    'theme_location' => 'main-menu',
                    'container' => false,
                    'menu_class' => 'f-dropdown',
                    'menu_id' => 'drop2',
                    'echo' => true,
                    'fallback_cb' => 'wp_page_menu'
                    )); ?>
				</div>
      </nav>
      <div class="large-4 small-12 columns welcome">
        <?php if ( is_home() ) : ?>
            <?php if (get_option('phoenix_greeting_message') == ''): ?>   
                <?php _e('We are glad to see you here!', 'phoenix'); ?>
            <?php else: ?>
                <?php echo get_option('phoenix_greeting_message'); ?>
            <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>