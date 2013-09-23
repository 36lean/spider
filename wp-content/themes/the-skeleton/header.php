<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <main id="main">
 *
 * @package The Skeleton
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
<?php 
if(defined('REGISTRATION_ERROR')) {
echo '<div class="blanky_cover"></div>';
}
if(!defined('REGISTRATION_ERROR') && !defined('REGISTERED_A_USER') ) {
echo '<div class="blanky_cover" style="display:none;"></div>';
}
if (defined('REGISTERED_A_USER')) {
echo '<div class="blanky_cover"></div>';
}
?>
	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
<div id="float-left-skel">
			<div class="site-title">
                        <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                         </div>
                         <div class="site-description">
		    <h2><?php bloginfo( 'description' ); ?></h2>
                         </div>
  </div>               

<nav id="site-secondary-navigation" class="secondary-navigation" role="navigation">

<?php wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?>

<!-- Add to cart function -->

                     <?php global $woocommerce; ?>

<div class="header-cart-woo">

<?php if(is_user_logged_in()): ?>
       <div id="login-div-skel2">
<a href="<?php echo wp_logout_url( $current_url ); ?>" title="<?php _e('Log Out', 'the-skeleton'); ?>"><?php _e('Logout', 'the-skeleton'); ?></a>
            </div><!-- end of login div skel2 -->

                             <?php endif ?>

 
            <?php if(!is_user_logged_in()): ?>


<script type="text/javascript">
jQuery(document).ready(function(){

    jQuery("#login-close-first.skel-form-close").click(function(){
     jQuery("#login-div-out").hide();
	jQuery(".blanky_cover").hide();
     
  });
});

jQuery(document).ready(function(){

    jQuery(".click-open-login").click(function(){
	jQuery(".blanky_cover").show();
     jQuery("#login-div-out").slideToggle(450);
     
  });
});

</script>

<div id="login-div-out" style="display:none;">
<div id="login-close-first" class="skel-form-close" tabindex="0" title="Close"></div>

<?php do_action( 'before_login_hook_skel' ); ?>

     <?php wp_login_form(); ?>
     <div id="wp-social-login-inte">

<?php do_action( 'wordpress_social_login' ); ?> 
<?php do_action( 'after_login_hook_skel' ); ?>
</div>
</div>

           <div id="login-div-skel2" class="click-open-login">
<a href="#" title="<?php _e('Sign in to your account', 'the-skeleton'); ?>"><?php _e('Sign In', 'the-skeleton'); ?></a>
        </div><!-- end of login div skel2 -->

                                 <?php endif ?>

<?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>
<div id="checkout-button-skel">
            <a href="<?php echo $woocommerce->cart->get_checkout_url(); ?>" title="<?php _e( 'Proceed to Checkout', 'the-skeleton' ); ?>" ><?php _e( 'Checkout', 'the-skeleton' ); ?></a>
                            </div>

               <div id="add-to-cart-woo">

                     <div id="float-places-skel">                  
                                   <img src="<?php echo get_template_directory_uri(); ?>/images/shopping_cart_woo.png">
                                </div>

                           <div class="add-woo-display">
                 <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'the-skeleton'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'the-skeleton'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
                           </div>
                    
               </div><!-- end of add-to-cart -->                          
<?php } ?>

<?php if(is_user_logged_in()): ?>
<?php $options = get_option( 'rskeleton_settings' ); ?>
         <div id="login-div-skel1">

<?php if ( in_array( 'bbpress/bbpress.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>

<?php global $userdata, $current_user; wp_get_current_user(); get_currentuserinfo(); ?>
<a title="<?php _e('View your profile', 'the-skeleton'); ?>" href="<?php echo bbp_get_user_profile_url( get_current_user_id() ); ?>">
<div id="user-profile-pic" style="margin-bottom: -5px;margin-right:5px;float:left;width:20px;">
<?php echo get_avatar($userdata->ID, 60); ?>
</div>
<?php echo $current_user->display_name ?></a>

<?php } ?>

<?php if ( ! in_array( 'bbpress/bbpress.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>
<?php global $userdata, $current_user; wp_get_current_user(); get_currentuserinfo(); ?>
<a title="<?php _e('View your profile', 'the-skeleton'); ?>" href="<?php echo site_url(); ?>/wp-admin/profile.php">
<div id="user-profile-pic" style="margin-bottom: -5px;margin-right:5px;float:left;width:20px;">
<?php echo get_avatar($userdata->ID, 60); ?>
</div>
<?php echo $current_user->display_name ?></a>

<?php } ?>

           </div><!-- end of login div skel1 -->
<?php endif ?>



<?php if(!is_user_logged_in()): ?>
<script type="text/javascript">
jQuery(document).ready(function(){

    jQuery("#register-close.skel-form-close").click(function(){
     jQuery("#register-skel").hide();
	jQuery(".blanky_cover").hide();
     
  });
});

jQuery(document).ready(function(){

    jQuery(".click-open-register").click(function(){
	jQuery(".blanky_cover").show();
     jQuery("#register-skel").slideToggle(450);
     
  });
});

</script>

<?php 
if(defined('REGISTRATION_ERROR')) {
echo '<div id="register-skel">';
}
if( !defined('REGISTRATION_ERROR') && !defined('REGISTERED_A_USER') ) {
echo '<div id="register-skel" style="display:none;">';
}
if (defined('REGISTERED_A_USER')) {
echo '<div id="register-skel">';
}
?>
<div id="register-close" class="skel-form-close" tabindex="0" title="Close"></div>

<?php do_action( 'before_register_hook_skel' ); ?>


<?php

if(defined('REGISTRATION_ERROR')) {
echo '<div id="login-errors-skel">';
}

if (defined('REGISTRATION_ERROR')) {
    foreach(unserialize(REGISTRATION_ERROR) as $error)
      echo "<div class=\"error\"><strong>ERROR: </strong>{$error}</div>";
  // errors here, if any
}

if(defined('REGISTRATION_ERROR')) {
echo '</div>';
}

if (defined('REGISTERED_A_USER')) {
    echo '<div id="login-errors-skel">Registration complete. Username and Password was e-mailed to '.REGISTERED_A_USER;
	echo '</div>';
}

?>



<?php 
global $wp;
$current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
?>
<form method="post" action="<?php echo add_query_arg('do', 'register', ''.$current_url.'' ); ?>">
  <p><label for="skel_user_login">
   <?php _e('Username', 'the-skeleton'); ?><br>
    <input type="text" name="skel_user_login" placeholder="Johnnyx" id="user_login" class="input" value="" size="20" />
  </label></p>

  <p><label for="skel_user_email">
   <?php _e('E-mail Address', 'the-skeleton'); ?><br>
   <input type="text" name="skel_user_email" placeholder="johnnyx@example.com" id="user_email" class="input" value="" size="25" />
  </label></p>

<?php $options = get_option( 'rskeleton_settings' ); ?>

   <p><label for="skel_spam">
   <?php _e('Confirm Your Human', 'the-skeleton'); ?><br>
     <input type="text" name="skel_spam" class="input" id="skel_spam" value="Delete this text" />
  </label></p>


<?php do_action( 'after_register_hook_skel' ); ?>
<?php do_action( 'wordpress_social_login' ); ?> 


<p class="submit">
  <input type="submit" name="wp-submit" id="wp-submit" value="Register" />
</p>

</form>
</div>


        <div id="login-div-skel1" class="click-open-register">
<a href="#" title="<?php _e('Create an Account', 'the-skeleton'); ?>"><?php _e('Create an Account', 'the-skeleton'); ?></a>
          </div><!-- end of login div skel1 -->
<?php endif ?>


</div><!-- End of header-cart-woo -->
                    
		</nav>
</div> <!-- end site-branding -->


		<nav id="site-navigation" class="main-navigation" role="navigation">
			<a id="menu-home-icon" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php _e('Welcome', 'the-skeleton'); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/images/home.png" alt="Find Us On Facebook"></a>

<h1 class="menu-toggle"><span class="menu-name"><?php _e( 'Menu', 'the-skeleton' ); ?></span><a id="menu-toggle-button"> &equiv;</a></h1>

			<div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'the-skeleton' ); ?>"><?php _e( 'Skip to content', 'the-skeleton' ); ?></a></div>


<?php $options = get_option( 'rskeleton_settings' ); ?>
<div id="social-links-im">
			<a title="<?php _e('Follow Us On Twitter', 'the-skeleton'); ?>" href="<?php echo $options['twitter_link']; ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png" alt="Follow Us On Twitter"></a>

<a title="<?php _e('Find Us On Facebook', 'the-skeleton'); ?>" href="<?php echo $options['facebook_link']; ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png" alt="Find Us On Facebook"></a>

<a title="<?php _e('E-mail Us', 'the-skeleton'); ?>" href="mailto:<?php echo $options['email_link']; ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/mail.png" alt="E-mail Us"></a>	
</div>


			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
	

		</nav><!-- #site-navigation --> 

	</header><!-- #masthead -->

	<div id="content" class="site-content">