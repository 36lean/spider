<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<!--
* DD_belatedPNG: Adds IE6 support: PNG images for CSS background-image and HTML <IMG/>.
* Author: Drew Diller
* Email: drew.diller@gmail.com
* URL: http://www.dillerdesign.com/experiment/DD_belatedPNG/
* Version: 0.0.8a
* Licensed under the MIT License: http://dillerdesign.com/experiment/DD_belatedPNG/#license
-->
	<!--[if IE 6]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/DD_belatedPNG_0.0.8a-min.js"></script>
	<script>
		DD_belatedPNG.fix('*');
	</script>
	<![endif]-->
	<?php //comments_popup_script(); // off by default ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="wrapper">
<!-- BEGIN UPPER MENU Change from WordPress menu  -->
<div id="top-menu">	
	<div id="top-menu-inner" class="clearfix">
<div class="first">
			<?php	if ('wp_nav_menu') {		wp_nav_menu(array('container' => '', 'theme_location' => 'wrockmetro-top-menu', 'fallback_cb' => 'wrockmetro_hdmenu'));
			}	else {	wrockmetro_hdmenu();}	
			?>
	</div></div>	</div> <!-- end div #top-menu-inner -->

<!-- BEGIN HEADER -->
	<div id="header">
    <div id="header-inner" class="clearfix">
		<div id="logo">
			<?php if ( get_header_image() != '' ) : ?>
                      <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" /></a>
    <?php endif; // header image was removed ?>
    <?php if ( !get_header_image() ) : ?>
            <h1 class="site-title">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
   <?php endif; // header image was removed (again) ?>
		</div>
		<div id="search"><?php get_search_form(); ?></div>			
	    </div> <!-- end div #header-inner -->
	</div> <!-- end div #header -->
	<!-- END HEADER -->

	<!-- BEGIN TOP NAVIGATION -->		
	<div id="navigation" class="nav"> 
    <div id="navigation-inner" class="clearfix">
	<div class="secondary">		<?php
			if (('wp_nav_menu')) {
				wp_nav_menu(array('container' => '', 'theme_location' => 'wrockmetro-navigation', 'fallback_cb' => 'wrockmetro_hdmenu'));
			}
			else {
				wrockmetro_hdmenu();
			}
			?>
		</div></div></div> 
	<!-- END TOP NAVIGATION -->