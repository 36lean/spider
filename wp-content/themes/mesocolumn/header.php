<!DOCTYPE html>
<!--[if lt IE 7 ]>	<html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>		<html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>		<html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>		<html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">

<link rel="profile" href="http://gmpg.org/xfn/11">

<?php do_action( 'bp_head_before_title' ); ?>

<title><?php wp_title( '|', true, 'right' ); ?></title>

<?php do_action( 'bp_head_after_title' ); ?>

<!-- STYLESHEET INIT -->
<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" />

<!-- favicon.ico location -->
<?php
global $shortname, $option_upload_path, $option_upload_url;
$fav_icon_ext =  $shortname . '_fav_icon_ext';
$get_fav_icon_ext =  get_option($fav_icon_ext);
if( file_exists( $option_upload_path . '/' . $shortname . '_fav_icon.'.$get_fav_icon_ext ) ) { ?>
<link rel="icon" href="<?php echo $option_upload_url . '/' . $shortname . '_fav_icon.'.$get_fav_icon_ext; ?>" type="images/x-icon" />
<?php } ?>

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php $header_code = get_theme_option('header_code'); echo stripcslashes($header_code); ?>

<?php do_action( 'bp_head' ); ?>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?> id="custom">

<div class="product-with-desc secbody" id="<?php if( function_exists('is_in_woocommerce_page') && is_in_woocommerce_page() ) { ?>woo-wrapper<?php } ?>">

<?php do_action( 'bp_before_wrapper' ); ?>
<div id="wrapper">

<?php do_action( 'bp_before_wrapper_main' ); ?>
<div id="wrapper-main">

<?php do_action( 'bp_before_bodywrap' ); ?>
<div id="bodywrap" class="innerwrap">

<?php do_action( 'bp_before_bodycontent' ); ?>
<div id="bodycontent">

<?php do_action( 'bp_before_container' ); ?>
<!-- CONTAINER START -->
<section id="container">

<?php do_action( 'bp_before_top_nav' ); ?>
<nav class="top-nav iegradient effect-1" id="top-navigation" role="navigation">
<div class="innerwrap">

<?php wp_nav_menu( array( 'theme_location' => 'top', 'container' => false, 'menu_class' => 'sf-menu', 'fallback_cb' => 'mesocolumn_revert_wp_menu_page','walker' => new Custom_Description_Walker )); ?>

<div id="mobile-nav">
<?php if ( has_nav_menu( 'top' ) ) {  ?>
<p class="select-pri">
<?php _e('Select Page:', TEMPLATE_DOMAIN); ?> <?php dez_get_mobile_navigation( $type='top', $nav_name="top" ); ?>
</p>
<?php } ?>

<?php if ( has_nav_menu( 'primary' ) ) {  ?>
<p class="select-pri sec">
<?php _e('Select Category:', TEMPLATE_DOMAIN); ?> <?php dez_get_mobile_navigation( $type='main', $nav_name="primary" ); ?>
</p>
<?php } ?>
</div>

</div>
</nav>
<?php do_action( 'bp_after_top_nav' ); ?>

<?php do_action( 'bp_before_container_wrap' ); ?>
<div class="container-wrap">

<?php do_action( 'bp_before_header' ); ?>
<!-- HEADER START -->
<header class="iegradient" id="header" role="banner">

<div id="header-overlay" class="header-inner">
<div class="innerwrap">

<div<?php $header_overlay = get_theme_mod('custom_header_overlay'); if( get_header_image() && $header_overlay == 'Yes' ): ?> class="header-overlay-on"<?php endif; ?> id="siteinfo">
<hgroup>
<?php
global $shortname, $option_upload_path, $option_upload_url;
$header_logo_ext =  $shortname . '_header_logo_ext';
$get_header_logo_ext =  get_option($header_logo_ext);
if( file_exists( $option_upload_path . '/' . $shortname . '_header_logo.'.$get_header_logo_ext ) ) { ?>
<a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php echo $option_upload_url . '/' . $shortname . '_header_logo.'.$get_header_logo_ext; ?>" alt="<?php bloginfo('name'); ?>" /></a>
<span class="header-seo-span">
<<?php if( !is_singular() || is_page_template('page-templates/template-blog.php') ){ echo 'h1 '; } else { echo 'div '; } ?>><a href="<?php echo home_url( '/' ); ?>" title="<?php echo bloginfo('name'); ?>" rel="home"><?php bloginfo( 'name' ); ?></a><<?php if( !is_singular() || is_page_template('page-templates/template-blog.php') ){ echo '/h1 '; } else { echo '/div '; } ?>><p id="site-description"><?php echo bloginfo('description'); ?></p>
</span>
<?php } else { ?>
<<?php if( !is_singular() || is_page_template('page-templates/template-blog.php') ){ echo 'h1 '; } else { echo 'div '; } ?>><a href="<?php echo home_url( '/' ); ?>" title="<?php echo bloginfo('name'); ?>" rel="home"><?php bloginfo( 'name' ); ?></a><<?php if( !is_singular() || is_page_template('page-templates/template-blog.php') ){ echo '/h1 '; } else { echo '/div '; } ?>><p id="site-description"><?php echo bloginfo('description'); ?></p>
<?php } ?>
</hgroup>
</div>
<!-- SITEINFO END -->


<?php $header_banner = get_theme_option('header_embed'); if($header_banner != '') { ?>
<div<?php if( get_header_image() && $header_overlay == 'Yes' ): ?> class="header-overlay-on"<?php endif; ?> id="topbanner">
<?php echo stripcslashes( do_shortcode($header_banner) ); ?>
</div><!-- TOPBANNER END -->
<?php } ?>

</div>
</div>
<!-- end header-inner -->
</header>
<!-- HEADER END -->

<?php do_action( 'bp_after_header' ); ?>


<?php do_action( 'bp_before_main_nav' ); ?>
<!-- NAVIGATION START -->
<nav class="main-nav iegradient" id="main-navigation" role="navigation">
<div class="innerwrap">
<?php if( has_nav_menu('primary') ):
wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'sf-menu', 'fallback_cb' => '','walker' => new Custom_Description_Walker ));
else:
echo '<ul class="sf-menu">';
echo wp_list_categories('orderby=name&show_count=0&title_li=');
echo '</ul>';
endif;
?>
</div>
</nav>
<!-- NAVIGATION END -->
<?php do_action( 'bp_after_main_nav' ); ?>

<?php do_action( 'bp_before_custom_header' ); ?>
<?php
$header_overlay = get_theme_mod('custom_header_overlay');
if( get_header_image() && $header_overlay == 'No' ): ?>
<div id="custom-img-header"><img src="<?php echo header_image(); ?>" alt="" /></div>
<?php endif; ?>
<?php do_action( 'bp_after_custom_header' ); ?>


<?php do_action( 'bp_before_breadcrumbs' ); ?>
<?php $breadcrumb_on = get_theme_option('breadcrumbs_on'); if($breadcrumb_on == 'Enable'):
if( function_exists('is_in_woocommerce_page') && is_in_woocommerce_page() ):
else:
if(get_post_type() == 'post' || get_post_type() == 'page' ):
get_template_part('lib/templates/breadcrumbs');
endif;
endif;
endif; ?>
<?php do_action( 'bp_after_breadcrumbs' ); ?>