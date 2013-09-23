<?php
$categories2 = get_categories('hide_empty=0&orderby=name');
$wp_cats2 = array();
foreach ($categories2 as $category_list ) {
$wp_cats2[$category_list->cat_ID] = $category_list->cat_name;
}


function dez_theme_catcolor_option_register() {
global $wpdb, $wp_cats2, $theme_name, $shortname, $options, $option_upload_path, $option_upload_url;
?>

<div id="custom-theme-option" class="wrap">
<?php screen_icon('edit'); echo "<h2>" . $theme_name . __( ' Category Color Options', TEMPLATE_DOMAIN ) . "</h2>"; ?>
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

<?php foreach ($wp_cats2 as $cat_value) {
$cat_id = get_cat_ID($cat_value);
$cat_value_option = 'tn_cat_color_' . $cat_id;
?>

<tr valign="top"><th scope="row"><?php echo $cat_value; ?></th>
<td>

<div id="<?php echo esc_attr( strtolower($cat_id) . '_picker' ); ?>" class="colorSelector">
<div style="background-color:<?php if( get_option( $cat_value_option )) { echo get_option( $cat_value_option ); } ?>"></div></div>
&nbsp;
<input class="of-color" name="<?php echo $cat_value_option; ?>" id="<?php echo $cat_value_option; ?>" type="text" value="<?php if( get_option( $cat_value_option )) { echo get_option( $cat_value_option ); } ?>" /><br /><label class="description" for="<?php echo $cat_value; ?>">&nbsp;&nbsp;Choose a color for <?php echo $cat_value; ?> category</label>
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
$alert_message = __("Are you sure you want to delete all saved settings for this theme?.", TEMPLATE_DOMAIN ); ?>
<input name="reset" type="submit" class="button-secondary" onclick="return confirm('<?php echo $alert_message; ?>')" value="<?php echo esc_attr(__('Reset Options',TEMPLATE_DOMAIN)); ?>" />
<input type="hidden" name="action" value="reset" />
</div>
</form>


</div>

<?php

}



function dez_theme_catcolor_admin_register() {
global $wpdb, $wp_cats2, $theme_name, $shortname, $options, $option_upload_path, $option_upload_url;
if ( isset($_GET['page']) && $_GET['page'] == 'category-color' ) {
if ( isset($_POST["save"]) && 'save' == $_REQUEST['action'] ) {

foreach ( $wp_cats2 as $cat_value ) {
$cat_id = get_cat_ID($cat_value);
$cat_value_option = 'tn_cat_color_' . $cat_id;

update_option( $cat_value_option,  $_REQUEST[ $cat_value_option ] );

if( isset( $_REQUEST[ $cat_value_option ] ) ) { update_option( $cat_value_option,  $_REQUEST[ $cat_value_option ] ); } else { delete_option( $cat_value_option ); }
}
header("Location: themes.php?page=category-color&saved=true");
die;

}

if( isset($_POST["reset"]) && 'reset' == $_REQUEST['action'] ) {

foreach ( $wp_cats2 as $cat_value ) {
$cat_id = get_cat_ID($cat_value);
$cat_value_option = 'tn_cat_color_' . $cat_id;

delete_option( $cat_value_option );
}
header("Location: themes.php?page=category-color&reset=true");
die;

}

}

add_theme_page(_g ($theme_name . __(' Category Color' , TEMPLATE_DOMAIN)),  _g (__('Category Color', TEMPLATE_DOMAIN)),  'edit_theme_options', 'category-color', 'dez_theme_catcolor_option_register');
}

add_action('admin_menu', 'dez_theme_catcolor_admin_register');


?>