<?php
$all_pages = get_pages('post_status=publish&post_type=page&hierarchical=0&parent=0');
$wp_pages = array();
foreach ($all_pages as $page_list ) {
$wp_pages[$page_list->ID] = $page_list->ID;
}


function dez_theme_pagecolor_option_register() {
global $wpdb, $wp_pages, $theme_name, $shortname, $options, $option_upload_path, $option_upload_url;
?>

<div id="custom-theme-option" class="wrap">
<?php screen_icon('edit'); echo "<h2>" . $theme_name . __( ' Page Color Options', TEMPLATE_DOMAIN ) . "</h2>"; ?>
<?php

if( isset($_GET["saved"]) ){
if ( $_REQUEST['saved'] ) echo '<div class="updated fade"><p><strong>'. $theme_name . __(' settings saved.', TEMPLATE_DOMAIN) . '</strong></p></div>';
}
if( isset($_GET["reset"]) ){
if ( $_REQUEST['reset'] ) echo '<div class="updated fade"><p><strong>'. $theme_name . __(' settings reset.', TEMPLATE_DOMAIN) . '</strong></p></div>';
}

$custom_notice = "<div class='custom-message'>". __('The color options only work if use custom menu for <strong>primary menu</strong> in appearance -> menus', TEMPLATE_DOMAIN) . "</div>";
echo $custom_notice;

?>


<form id="wp-theme-options" method="post" action="" enctype="multipart/form-data">

<table class="form-table">

<?php foreach ($wp_pages as $page_value) {
$page_id = $page_value;
$page_title = get_the_title( $page_id );
$page_value_option = 'tn_page_color_' . $page_id;
?>

<tr valign="top"><th scope="row"><?php echo $page_title; ?></th>
<td>

<div id="<?php echo esc_attr( strtolower($page_id) . '_picker' ); ?>" class="colorSelector">
<div style="background-color:<?php if( get_option( $page_value_option )) { echo get_option( $page_value_option ); } ?>"></div></div>
&nbsp;
<input class="of-color" name="<?php echo $page_value_option; ?>" id="<?php echo $page_value_option; ?>" type="text" value="<?php if( get_option( $page_value_option )) { echo get_option( $page_value_option ); } ?>" /><br /><label class="description" for="<?php echo $page_title; ?>">&nbsp;&nbsp;Choose a color for <?php echo $page_title; ?> page</label>
</td>
</tr>

<?php } ?>

</table>

<div style="float: left; margin: 20px 40px 0 0;" class="submit">
<input name="save" type="submit" class="button-primary sbutton" value="<?php echo esc_attr(__('Save Options',TEMPLATE_DOMAIN)); ?>" /><input type="hidden" name="action" value="save" />
</div>
</form>

<form method="post">
<div style="float: left; margin: 20px 40px 0 0;" class="submit">
<?php
$alert_message = __("Are you sure you want to delete all saved settings for pages color?.", TEMPLATE_DOMAIN ); ?>
<input name="reset" type="submit" class="button-secondary" onclick="return confirm('<?php echo $alert_message; ?>')" value="<?php echo esc_attr(__('Reset Options',TEMPLATE_DOMAIN)); ?>" />
<input type="hidden" name="action" value="reset" />
</div>
</form>


</div>

<?php

}



function dez_theme_pagecolor_admin_register() {
global $wpdb, $wp_pages, $theme_name, $shortname, $options, $option_upload_path, $option_upload_url;


if ( isset($_GET['page']) && $_GET['page'] == 'page-color' ) {

if ( isset($_POST["save"]) && 'save' == $_REQUEST['action'] ) {

foreach ( $wp_pages as $page_value ) {

$page_id = $page_value;
$page_value_option = 'tn_page_color_' . $page_id;

update_option( $page_value_option,  $_REQUEST[ $page_value_option ] );

if( isset( $_REQUEST[ $page_value_option ] ) ) { update_option( $page_value_option,  $_REQUEST[ $page_value_option ] ); } else { delete_option( $page_value_option ); }
}
header("Location: themes.php?page=page-color&saved=true");
die;

}

if( isset($_POST["reset"]) && 'reset' == $_REQUEST['action'] ) {

foreach ( $wp_pages as $page_value ) {

$page_id = $page_value;
$page_value_option = 'tn_page_color_' . $page_id;

delete_option( $page_value_option );
}
header("Location: themes.php?page=page-color&reset=true");
die;

}

}

add_theme_page(_g ($theme_name . __(' Pages Color' , TEMPLATE_DOMAIN)),  _g (__('Pages Color', TEMPLATE_DOMAIN)),  'edit_theme_options', 'page-color', 'dez_theme_pagecolor_option_register');
}

add_action('admin_menu', 'dez_theme_pagecolor_admin_register');


?>