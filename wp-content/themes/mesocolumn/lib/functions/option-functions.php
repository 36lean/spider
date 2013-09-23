<?php
////////////////////////////////////////////////////////////////////////////////
// get theme option
////////////////////////////////////////////////////////////////////////////////
if( !function_exists('get_theme_option') ):
function get_theme_option($option)
{
global $shortname;
return stripslashes(get_option($shortname . '_' . $option));
}
endif;

if( !function_exists('get_theme_settings') ):
function get_theme_settings($option)
{
return stripslashes(get_option($option));
}
endif;


////////////////////////////////////////////////////////////////////////////////
// get alt style list
////////////////////////////////////////////////////////////////////////////////
$alt_stylesheet_path = get_template_directory() . '/lib/styles/alt-styles/';
$alt_stylesheets = array();
if ( is_dir($alt_stylesheet_path) ) {
if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) {
while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
if(stristr($alt_stylesheet_file, ".css") !== false) {
$alt_stylesheets[] = $alt_stylesheet_file;
}
}
}
}
$styles_bulk_list = array_unshift($alt_stylesheets, "default.css");

////////////////////////////////////////////////////////////////////////////////
// global upload path
////////////////////////////////////////////////////////////////////////////////
$option_upload = wp_upload_dir();
$option_upload_path = $option_upload['basedir'];
$option_upload_url = $option_upload['baseurl'];


////////////////////////////////////////////////////////////////////////////////
// multiple string option page
////////////////////////////////////////////////////////////////////////////////
function _g($str) { return $str; }

function dez_theme_admin_head_script() {
global $shortname, $theme_version;
if( isset( $_GET["page"] ) ):
if ($_GET["page"] == "theme-options" || $_GET["page"] == "category-color" || $_GET["page"] == "page-color") {
wp_enqueue_script( 'theme-color-picker-js', get_template_directory_uri() . '/lib/admin/js/colorpicker.js', array( 'jquery' ), $theme_version );
wp_enqueue_script( 'theme-option-custom-js', get_template_directory_uri() . '/lib/admin/js/options-custom.js', array( 'jquery' ), $theme_version );
//add uniform js
wp_enqueue_script( 'theme-uniform-js', get_template_directory_uri() . '/lib/admin/js/uniform/jquery.uniform.js', array( 'jquery' ), $theme_version );
?>
<script type='text/javascript'>
 jQuery(function(){
 jQuery("select,textarea,input:checkbox,input:text,input:radio,input:file").uniform();
 });
</script>

<script type="text/javascript">
jQuery(document).ready(function(){
jQuery("select#<?php echo $shortname . '_body_font'; ?>, select#<?php echo $shortname . '_headline_font'; ?>, select#<?php echo $shortname . '_navigation_font'; ?>").change(function(){

var val = jQuery("select#<?php echo $shortname . '_body_font'; ?>").val();
var val2 = jQuery("select#<?php echo $shortname . '_headline_font'; ?>").val();
var val3 = jQuery("select#<?php echo $shortname . '_navigation_font'; ?>").val();

//var valx = val.replace(/ /g, "+");

jQuery("#cFontStyleWColor11").text('#testtext-<?php echo $shortname . "_body_font"; ?> { font-size: 16px; font-family: "'+ val +'" !important; }');

jQuery("#cFontStyleWColor12").text('#testtext-<?php echo $shortname . "_headline_font"; ?> { font-size: 16px; font-family: "'+ val2 +'" !important; }');

jQuery("#cFontStyleWColor13").text('#testtext-<?php echo $shortname . "_navigation_font"; ?> { font-size: 16px; font-family: "'+ val3 +'" !important; }');


WebFontConfig = {
google: { families: [ ''+ val +'', ''+ val2 +'', ''+ val3 +'' ] }
};
(function() {
        var wf = document.createElement('script');
        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
      })();
});
});

</script>

<?php
} endif;
}

function dez_theme_admin_head_style() {
global $shortname, $theme_version;
if( isset( $_GET["page"] ) ):
if ($_GET["page"] == "theme-options" || $_GET["page"] == "category-color" || $_GET["page"] == "page-color") {
wp_enqueue_style( 'admin-css', get_template_directory_uri() . '/lib/admin/css/admin.css', array(), $theme_version );
wp_enqueue_style( 'color-picker-main', get_template_directory_uri() . '/lib/admin/css/colorpicker.css', array(), $theme_version );
wp_enqueue_style( 'uniform-css', get_template_directory_uri() . '/lib/admin/js/uniform/css/uniform.default.css', array(), $theme_version );
?>

<style id="cFontStyleWColor11" type="text/css"></style>
<style id="cFontStyleWColor12" type="text/css"></style>
<style id="cFontStyleWColor13" type="text/css"></style>

<?php print "<style>"; ?>

<?php if(get_theme_option('body_font') == 'Choose a font' || get_theme_option('body_font') == ''): ?>

<?php else: ?>
#testtext-<?php echo $shortname . "_body_font"; ?> {
font-size: 16px; font-family: <?php echo get_theme_option('body_font'); ?>;
}
<?php endif; ?>

<?php if(get_theme_option('body_font') == 'Choose a font' || get_theme_option('headline_font') == ''): ?>
<?php else: ?>
#testtext-<?php echo $shortname . "_headline_font"; ?> {
font-size: 16px; font-family: <?php echo get_theme_option('headline_font'); ?>;
}
<?php endif; ?>

<?php if(get_theme_option('body_font') == 'Choose a font' || get_theme_option('navigation_font') == ''): ?>
<?php else: ?>
#testtext-<?php echo $shortname . "_navigation_font"; ?> {
font-size: 16px; font-family: <?php echo get_theme_option('navigation_font'); ?>;
}
<?php endif; ?>

<?php print "</style>"; ?>

<?php } endif;
}

add_action('admin_footer', 'dez_theme_admin_head_script');
add_action('admin_print_styles', 'dez_theme_admin_head_style');
add_action('admin_print_styles', 'dez_custom_google_font');

////////////////////////////////////////////////////////////////////////////////
// Theme Option
////////////////////////////////////////////////////////////////////////////////
$theme_data = wp_get_theme( TEMPLATE_DOMAIN );
$theme_version = $theme_data['Version'];
$theme_name = $theme_data['Name'];
$shortname = 'tn_'.TEMPLATE_DOMAIN;
$choose_count = array("Select a number","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20");

/* including fonts functions */
include_once( get_template_directory() . '/lib/functions/fonts-functions.php');

$categories = get_categories('hide_empty=0&orderby=name');
//print_r($categories);
$wp_cats = array();
foreach ($categories as $category_list ) {
$wp_cats[$category_list->cat_ID] = $category_list->slug;
}
array_unshift($wp_cats, "Choose a category");


$options = array (

/*header setting*/
array(
"header-title" => __("Header Setting", TEMPLATE_DOMAIN),
"name" => __("Site Logo", TEMPLATE_DOMAIN),
	"description" => __("Upload your logo here.", TEMPLATE_DOMAIN),
	"id" => $shortname."_header_logo",
    "filename" => $shortname."_header_logo",
	"type" => "uploads",
	"default" => ""),

array(
"name" => __("Favourite Icon", TEMPLATE_DOMAIN),
	"description" => __("Upload your fav icon here. <em>prefered 16x16 or 32x32 image dimension</em>", TEMPLATE_DOMAIN),
	"id" => $shortname."_fav_icon",
    "filename" => $shortname."_fav_icon",
	"type" => "uploads",
	"default" => ""),

/* typography setting */
array(
"header-title" => __("Typography Settings", TEMPLATE_DOMAIN),
"name" => __("Body Font", TEMPLATE_DOMAIN),
	"description" => __("Choose a font for the body text.", TEMPLATE_DOMAIN),
	"id" => $shortname."_body_font",
	"type" => "select-fonts",
	"options" => $font_family_group,
	"default" => ""),

array(
"name" => __("Headline and Title Font", TEMPLATE_DOMAIN),
	"description" => __("Choose a font for the headline text.", TEMPLATE_DOMAIN),
	"id" => $shortname."_headline_font",
	"type" => "select-fonts",
	"options" => $font_family_group,
	"default" => ""),

array(
"name" => __("Navigation Font", TEMPLATE_DOMAIN),
	"description" => __("Choose a font for the navigation text.", TEMPLATE_DOMAIN),
	"id" => $shortname."_navigation_font",
	"type" => "select-fonts",
	"options" => $font_family_group,
	"default" => ""),


/* Design setting */ 
array(
"header-title" => __("Designs Settings", TEMPLATE_DOMAIN),
"name" => __("Color Scheme", TEMPLATE_DOMAIN),
	"description" => __("Choose a color scheme that will be apply to default links color and sidebar widget header and footer widget header etc.", TEMPLATE_DOMAIN),
	"id" => $shortname."_main_color",
	"type" => "colorpicker",
	"default" => ""),

array(
"name" => __("Top Navigation Background Color", TEMPLATE_DOMAIN),
	"description" => __("Choose a background color for top navigation.", TEMPLATE_DOMAIN),
	"id" => $shortname."_topnav_color",
	"type" => "colorpicker",
	"default" => ""),

array(
"name" => __("Bottom Footer Background Color", TEMPLATE_DOMAIN),
	"description" => __("Choose a background color for bottom footer.", TEMPLATE_DOMAIN),
	"id" => $shortname."_footer_bottom_color",
	"type" => "colorpicker",
	"default" => ""),

/* posts setting */
array(
"header-title" => __("Posts Settings", TEMPLATE_DOMAIN),
"name" => __("Enter Post Excerpt Count", TEMPLATE_DOMAIN),
	"description" => __("Enter how many word count for all your post excerpt<br />*numeric only: 25,55,100", TEMPLATE_DOMAIN),
	"id" => $shortname."_post_custom_excerpt",
	"type" => "text",
	"default" => ""),

array(
"name" => __("Enter Post Excerpt More Text", TEMPLATE_DOMAIN),
	"description" => __("Enter your own more text for the excerpt", TEMPLATE_DOMAIN),
	"id" => $shortname."_post_excerpt_moretext",
	"type" => "text",
	"default" => "Continue Reading &raquo;"),

array(
"name" => __("Enable Related Posts", TEMPLATE_DOMAIN),
	"description" => __("Enable or disable related posts", TEMPLATE_DOMAIN),
	"id" => $shortname."_related_on",
	"type" => "radio",
	"options" => array('Disable','Enable'),
	"default" => "Disable"),

array(
"name" => __("How Many Related Posts?", TEMPLATE_DOMAIN),
"description" => __("Choose how many related post you want to show.", TEMPLATE_DOMAIN),
	"id" => $shortname."_related_count",
	"type" => "select",
   	"options" => $choose_count,
    "default" => ""),

array(
"name" => __("Enable Author Bio", TEMPLATE_DOMAIN),
	"description" => __("Enable or disable author bio in single posts", TEMPLATE_DOMAIN),
	"id" => $shortname."_author_bio_on",
	"type" => "radio",
	"options" => array('Disable','Enable'),
	"default" => "Disable"),

array(
"name" => __("Enable Breadcrumbs", TEMPLATE_DOMAIN),
	"description" => __("Enable or disable breadcrumbs", TEMPLATE_DOMAIN),
	"id" => $shortname."_breadcrumbs_on",
	"type" => "radio",
	"options" => array('Disable','Enable'),
	"default" => "Disable"),

array(
"name" => __("Enable Archive Header", TEMPLATE_DOMAIN),
	"description" => __("Enable or disable archive header", TEMPLATE_DOMAIN),
	"id" => $shortname."_archive_headline",
	"type" => "radio",
	"options" => array('Disable','Enable'),
	"default" => "Disable"),

array(
"name" => __("Enable Comments Close Notice", TEMPLATE_DOMAIN),
	"description" => __("Enable or disable comments close notice", TEMPLATE_DOMAIN),
	"id" => $shortname."_comment_notice",
	"type" => "radio",
	"options" => array('Enable','Disable'),
	"default" => "Enable"),


/* Featured Slider setting */
array(
"header-title" => __("Featured Slider Settings", TEMPLATE_DOMAIN),
"name" => __("Enable Featured Slider", TEMPLATE_DOMAIN),
"description" => __("Choose if you want to enable or disable featured slider.", TEMPLATE_DOMAIN),
	"id" => $shortname."_slider_on",
	"type" => "radio",
	"options" => array("Disable", "Enable"),
	"default" => "Disable"),


array(
"name" => __("Categories ID", TEMPLATE_DOMAIN),
"description" => __("Add a list of category ids if you want to use category as featured. <em>*leave blank to use bottom post ids featured</em><br /><small>example: 3,4,68</small>", TEMPLATE_DOMAIN),
	"id" => $shortname."_feat_cat",
	"type" => "text",
	"default" => ""),

array(
"name" => __("Limit to how many posts", TEMPLATE_DOMAIN),
"description" => __("How many posts in categories you listed you want to show?", TEMPLATE_DOMAIN),
	"id" => $shortname."_feat_cat_count",
	"type" => "select",
    "options" => $choose_count,
	"default" => ""),


array(
"name" => __("Posts ID", TEMPLATE_DOMAIN),
"description" => __("Add a list of post ids if you want to use posts as featured. <em>*leave blank to use above category ids featured</em><br /><strong style='font-size:13px;'>Post Type Supported: post, page, product, portfolio</strong><br /><small>example: 136,928,925,80,77,55,49</small>", TEMPLATE_DOMAIN),
	"id" => $shortname."_feat_post",
	"type" => "text",
	"default" => ""),



/* Home Featured setting */
array(
"header-title" => __("Home Featured Category", TEMPLATE_DOMAIN),
"name" => __("Homepage Featured Category 1", TEMPLATE_DOMAIN),
"description" => __("Choose which category to featured.", TEMPLATE_DOMAIN),
	"id" => $shortname."_side_feat_cat1",
	"type" => "select",
	"options" => $wp_cats,
    "default" => ""),
array(
"name" => __("How Many Posts?", TEMPLATE_DOMAIN),
"description" => __("Choose how many post you want to show.", TEMPLATE_DOMAIN),
	"id" => $shortname."_side_feat_cat1_count",
	"type" => "select",
   	"options" => $choose_count,
    "default" => ""),


array(
"name" => __("Homepage Featured Category 2", TEMPLATE_DOMAIN),
"description" => __("Choose which category to featured.", TEMPLATE_DOMAIN),
	"id" => $shortname."_side_feat_cat2",
	"type" => "select",
   	"options" => $wp_cats,
    "default" => ""),

array(
"name" => __("How Many Posts?", TEMPLATE_DOMAIN),
"description" => __("Choose how many post you want to show.", TEMPLATE_DOMAIN),
	"id" => $shortname."_side_feat_cat2_count",
	"type" => "select",
   	"options" => $choose_count,
    "default" => ""),


array(
"name" => __("Homepage Featured Category 3", TEMPLATE_DOMAIN),
"description" => __("Choose which category to featured.", TEMPLATE_DOMAIN),
	"id" => $shortname."_side_feat_cat3",
	"type" => "select",
	"options" => $wp_cats,
    "default" => ""),

array(
"name" => __("How Many Posts?", TEMPLATE_DOMAIN),
"description" => __("Choose how many post you want to show.", TEMPLATE_DOMAIN),
	"id" => $shortname."_side_feat_cat3_count",
	"type" => "select",
   	"options" => $choose_count,
    "default" => ""),

array(
"name" => __("Homepage Featured Category 4", TEMPLATE_DOMAIN),
"description" => __("Choose which category to featured.", TEMPLATE_DOMAIN),
	"id" => $shortname."_side_feat_cat4",
	"type" => "select",
	"options" => $wp_cats,
    "default" => ""),
array(
"name" => __("How Many Posts?", TEMPLATE_DOMAIN),
"description" => __("Choose how many post you want to show.", TEMPLATE_DOMAIN),
	"id" => $shortname."_side_feat_cat4_count",
	"type" => "select",
   	"options" => $choose_count,
    "default" => ""),

array(
"name" => __("Homepage Featured Category 5", TEMPLATE_DOMAIN),
"description" => __("Choose which category to featured.", TEMPLATE_DOMAIN),
	"id" => $shortname."_side_feat_cat5",
	"type" => "select",
	"options" => $wp_cats,
    "default" => ""),
array(
"name" => __("How Many Posts?", TEMPLATE_DOMAIN),
"description" => __("Choose how many post you want to show.", TEMPLATE_DOMAIN),
	"id" => $shortname."_side_feat_cat5_count",
	"type" => "select",
   	"options" => $choose_count,
    "default" => ""),

array(
"name" => __("Homepage Featured Category 6", TEMPLATE_DOMAIN),
"description" => __("Choose which category to featured.", TEMPLATE_DOMAIN),
	"id" => $shortname."_side_feat_cat6",
	"type" => "select",
	"options" => $wp_cats,
    "default" => ""),
array(
"name" => __("How Many Posts?", TEMPLATE_DOMAIN),
"description" => __("Choose how many post you want to show.", TEMPLATE_DOMAIN),
	"id" => $shortname."_side_feat_cat6_count",
	"type" => "select",
   	"options" => $choose_count,
    "default" => ""),
/*advertisement setting*/

array(
"header-title" => __("Advertisement Settings", TEMPLATE_DOMAIN),
"name" => __("468x60 or 728x90 Header Banner and Advertisment Embed Code", TEMPLATE_DOMAIN),
  "description" => __("Add Embed Code or Image Banner Here <em>*HTML Allowed</em>. Leave blank if not use.", TEMPLATE_DOMAIN),
	"id" => $shortname."_header_embed",
	"type" => "textarea",
	"default" => ""),


array(
"name" => __("Advertisement in First Post Loop", TEMPLATE_DOMAIN),
	"description" => __("Insert Ads code for the blog post <strong>first</strong> loop. It will appeared after 2 posts. <em>Leave blank if not use.</em>", TEMPLATE_DOMAIN),
	"id" => $shortname."_ads_code_one",
	"type" => "textarea",
	"default" => ""),


array(
"name" => __("Advertisement in Second Post Loop", TEMPLATE_DOMAIN),
	"description" => __("Insert Ads code for the blog post <strong>second</strong> loop. It will appeared after 4 posts. <em>Leave blank if not use.</em>", TEMPLATE_DOMAIN),
	"id" => $shortname."_ads_code_two",
	"type" => "textarea",
	"default" => ""),


array(
"name" => __("Advertisement in Single Post Top", TEMPLATE_DOMAIN),
	"description" => __("Insert Ads code for the single post <strong>top</strong>. It will appeared before post content. <em>Leave blank if not use.</em>", TEMPLATE_DOMAIN),
	"id" => $shortname."_ads_single_top",
	"type" => "textarea",
	"default" => ""),


array(
"name" => __("Advertisement in Single Post Bottom", TEMPLATE_DOMAIN),
	"description" => __("Insert Ads code for the single post <strong>bottom</strong>. It will appeared after post content. <em>Leave blank if not use.</em>", TEMPLATE_DOMAIN),
	"id" => $shortname."_ads_single_bottom",
	"type" => "textarea",
	"default" => ""),


array(
"name" => __("Advertisement in Right Sidebar", TEMPLATE_DOMAIN),
	"description" => __("Insert Ads code for the <strong>right</strong> sidebar. <em>Leave blank if not use.</em>", TEMPLATE_DOMAIN),
	"id" => $shortname."_ads_right_sidebar",
	"type" => "textarea",
	"default" => ""),

array( "name" => __("Header Code Insert", TEMPLATE_DOMAIN),
	"description" => __("Insert any code here. It will appeared after wp_head(). Leave blank if not use", TEMPLATE_DOMAIN),
	"id" => $shortname."_header_code",
	"type" => "textarea",
	"default" => ""),

array( "name" => __("Footer Code Insert", TEMPLATE_DOMAIN),
	"description" => __("Insert any code here. It will appeared after wp_footer(). <em>Leave blank if not use</em>", TEMPLATE_DOMAIN),
	"id" => $shortname."_footer_code",
	"type" => "textarea",
	"default" => ""),


/*banner setting*/
array(
"header-title" => __("Sidebar Banner Settings", TEMPLATE_DOMAIN),
"name" => __("Banner Ads 1", TEMPLATE_DOMAIN),
	"description" => __("Insert banner 1 HTML code. <em>*leave blank if not use</em>", TEMPLATE_DOMAIN),
	"id" => $shortname."_sponsor_banner_one",
	"type" => "textarea",
    "default" => ""),

array( "name" => __("Banner Ads 2", TEMPLATE_DOMAIN),
	"description" => __("Insert banner 2 HTML code. <em>*leave blank if not use</em>", TEMPLATE_DOMAIN),
	"id" => $shortname."_sponsor_banner_two",
	"type" => "textarea",
    "default" => ""),

array( "name" => __("Banner Ads 3", TEMPLATE_DOMAIN),
	"description" => __("Insert banner 3 HTML code. <em>*leave blank if not use</em>", TEMPLATE_DOMAIN),
	"id" => $shortname."_sponsor_banner_three",
	"type" => "textarea",
    "default" => ""),

array( "name" => __("Banner Ads 4", TEMPLATE_DOMAIN),
	"description" => __("Insert banner 4 HTML code. <em>*leave blank if not use</em>", TEMPLATE_DOMAIN),
	"id" => $shortname."_sponsor_banner_four",
	"type" => "textarea",
    "default" => ""),

array( "name" => __("Banner Ads 5", TEMPLATE_DOMAIN),
	"description" => __("Insert banner 5 HTML code. <em>*leave blank if not use</em>", TEMPLATE_DOMAIN),
	"id" => $shortname."_sponsor_banner_five",
	"type" => "textarea",
    "default" => ""),

array( "name" => __("Banner Ads 6", TEMPLATE_DOMAIN),
	"description" => __("Insert banner 6 HTML code. <em>*leave blank if not use</em>", TEMPLATE_DOMAIN),
	"id" => $shortname."_sponsor_banner_six",
	"type" => "textarea",
    "default" => "")
);

function dez_theme_admin_option_register() {
global $theme_name, $shortname, $options, $option_upload_path, $option_upload_url;
?>

<div id="custom-theme-option" class="wrap">
<?php screen_icon(); echo "<h2>" . $theme_name . __( ' Theme Options', TEMPLATE_DOMAIN ) . "</h2>"; ?>
<?php

if( isset($_GET["saved"]) ){
if ( $_REQUEST['saved'] ) echo '<div class="updated fade"><p><strong>'. $theme_name . __(' settings saved.', TEMPLATE_DOMAIN) . '</strong></p></div>';
}
if( isset($_GET["reset"]) ){
if ( $_REQUEST['reset'] ) echo '<div class="updated fade"><p><strong>'. $theme_name . __(' settings reset.', TEMPLATE_DOMAIN) . '</strong></p></div>';
}

?>

<form id="wp-theme-options" method="post" action="" enctype="multipart/form-data">

<table class="form-table">

<?php foreach ($options as $value) { ?>

<?php if( !empty( $value['header-title'] ) ): if ( $value['header-title'] != "" ) { ?>
<tr class="trtitle" valign="top">
<th scope="row"><h3><?php echo stripslashes($value['header-title']); ?></h3></th>
</tr>
<?php } endif; ?>


<?php if ( $value['type'] == "text" ) { ?>

<tr valign="top"><th scope="row"><?php echo $value['name']; ?></th>
<td>
<input class="regular-text" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes( get_option( $value['id']) ); } else { echo stripslashes($value['default']); } ?>" /><br />
<label class="description" for="<?php echo $value['id']; ?>"><?php echo $value['description']; ?></label>
</td>
</tr>

<?php } else if ( $value['type'] == "uploads" ) {
$uploads_ext =  $value['id'] . '_ext';
$get_uploads_ext =  get_option($uploads_ext);
?>

<tr valign="top"><th scope="row"><?php echo $value['name']; ?></th>
<td>
<?php if( file_exists( $option_upload_path . '/' . $value['filename'] . '.'. $get_uploads_ext) ) { ?>
<img src="<?php echo $option_upload_url . '/' . $value['filename'] . '.'. $get_uploads_ext; ?>" alt="<?php echo $value['id']; ?>" />
<br /><input type="submit" class="button-secondary" name="delete_<?php echo $value['filename']; ?>" value="Delete this image &raquo;" />
<?php } else { ?>
<input type="file" id="<?php echo $value['id']; ?>" name="<?php echo $value['filename']; ?>" size="50" />
<br />
<label class="description" for="<?php echo $value['id']; ?>"><?php echo $value['description']; ?></label>
<?php } ?>
</td>
</tr>

<?php } elseif ( $value['type'] == "radio" ) { // setting ?>

<tr valign="top"><th scope="row"><?php echo $value['name']; ?></th>
<td>
<?php foreach ($value['options'] as $option) {
$radio_setting = get_option($value['id']);
if($radio_setting != '') {
if (get_option($value['id']) == $option) { $checked = "checked=\"checked\""; } else { $checked = ""; }
} else {
if(get_option($value['id']) == $value['default'] ){ $checked = "checked=\"checked\""; } else { $checked = ""; }
} ?>
<input id="<?php echo $value['id']; ?>" type="radio" name="<?php echo $value['id']; ?>" value="<?php echo $option; ?>" <?php echo $checked; ?> />&nbsp;<?php echo $option; ?>&nbsp;&nbsp;&nbsp;
<?php } ?>
<br /><label class="description" for="<?php echo $value['id']; ?>"><?php echo $value['description']; ?></label>
</td>
</tr>


<?php } elseif ( $value['type'] == "checkbox" ) { // setting ?>

<tr valign="top"><th scope="row"><?php echo $value['name']; ?></th>
<td>
<?php if(get_option($value['id'])) { $checked = "checked=\"checked\""; } else { $checked = ""; } ?>
<input type="<?php echo $value['type']; ?>" class="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php echo $value['id']; ?>" <?php echo $checked; ?> />&nbsp;&nbsp;<?php echo $value['name']; ?>
<br /><label class="description" for="<?php echo $value['id']; ?>"><?php echo $value['description']; ?></label>
</td>
</tr>

<?php } elseif ( $value['type'] == "textarea" ) { // setting ?>

<tr valign="top"><th scope="row"><?php echo $value['name']; ?></th>
<td>
<?php
$embed_code = get_option( $value['id'] );
if($embed_code):
$valuey = stripslashes( $embed_code );
else:
$valuey = '';
endif;
?>
<textarea name="<?php echo $value['id']; ?>" class="mytext" cols="60%" rows="8" /><?php if ( $embed_code != "" ) { echo $valuey; } else { echo $value['default']; } ?>
</textarea><br />
<label class="description" for="<?php echo $value['id']; ?>"><?php echo $value['description']; ?></label>
</td>
</tr>

<?php } elseif ( $value['type'] == "colorpicker" ) { ?>

<tr valign="top"><th scope="row"><?php echo $value['name']; ?></th>
<td>

<div id="<?php echo esc_attr( $value['id'] . '_picker' ); ?>" class="colorSelector">
<div style="background-color:<?php if( get_option( $value['id'] )) { echo get_option( $value['id'] ); } ?>"></div></div>&nbsp;
<input class="of-color" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if( get_option( $value['id'] )) { echo get_option( $value['id'] ); } ?>" /><br /><label class="description" for="<?php echo $value['id']; ?>">&nbsp;&nbsp;<?php echo $value['description']; ?></label>
</td>
</tr>


<?php } elseif ( $value['type'] == "select" ) { ?>

<tr valign="top"><th scope="row"><?php echo $value['name']; ?></th>
<td>
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
<option<?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['default']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
<?php } ?>
</select><br />
<label class="description" for="<?php echo $value['id']; ?>"><?php echo $value['description']; ?></label>
</td>
</tr>


<?php } elseif ( $value['type'] == "select-fonts" ) { ?>

<tr valign="top"><th scope="row"><?php echo $value['name']; ?></th>
<td>
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
<option<?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == get_option( $value['default']) ) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
<?php } ?>
</select>
<div style="<?php $the_font_family = get_option( $value['id'] ); if( get_option( $value['id'] ) == '' || get_option( $value['id'] ) == 'Choose a font' ) { } else { echo 'font-family:'.$the_font_family.';'; } ?>" class="testtextbox" id="testtext-<?php echo $value['id']; ?>">The Quick Brown Fox Jumps Over The Lazy Dog. 1234567890</div>
<br />
<label class="description" for="<?php echo $value['id']; ?>"><?php echo $value['description']; ?></label>
</td>
</tr>

<?php } ?>

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

<?php }



function dez_theme_admin_menu_register() {
global $thetextlink,$theme_name, $shortname, $options, $option_upload_path, $option_upload_url;
if( isset($_GET['page']) && $_GET['page'] == 'theme-options' ) {
if( isset($_POST["save"]) && 'save' == $_REQUEST['action'] ) {

foreach ($options as $value) {

$file_upload_check = isset( $value['filename'] ) ? $value['filename'] : "";

if( $file_upload_check != '' ) {
if( $_FILES[ $value['filename'] ]['type'] ) {
//Get the file information
$userfile_name = $_FILES[ $value['filename'] ]['name'];
$userfile_sanitize_name = str_replace(" ","-",$userfile_name);
$userfile_sanitize_ext = substr($userfile_sanitize_name, strripos($userfile_sanitize_name, '.'));
$userfile_size = $_FILES[ $value['filename'] ]['size'];
$userfile_ext = end(explode(".", $userfile_name));

$userfile_tmp = $_FILES[ $value['filename'] ]['tmp_name'];

$allowed_file_types = array('.png','.jpg','.jpeg','.gif');
if ( in_array($userfile_sanitize_ext,$allowed_file_types) ) {
$large_image_location = $option_upload_path . '/' . $value['filename'] . '.' . $userfile_ext;
if(ereg('[^a-zA-Z0-9 ._.-]', $userfile_sanitize_name)){
echo "<p class=\"uperror\">" . __('The image name contain invalid character, rename it and try upload it again', TEMPLATE_DOMAIN) . "</p>";
} else {
move_uploaded_file($userfile_tmp, $large_image_location);
chmod($large_image_location, 0777);

update_option( $value['filename'] . '_ext',  $userfile_ext );
}
}
}
} //file upload check

}

foreach ($options as $value) {
if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'],  $_REQUEST[ $value['id'] ] ); } else { delete_option( $value['id'] ); }
}

header("Location: themes.php?page=theme-options&saved=true");
die;

}


foreach ($options as $value) {
$img_check = isset($value['filename']) ? $value['filename'] : "";
if ( isset( $_POST['delete_' . $img_check] )){
if( file_exists( $option_upload_path . '/' . $value['filename'] . '.' . get_option( $value['filename'] . '_ext') )) {
unlink($option_upload_path . '/' . $value['filename'] . '.' . get_option( $value['filename'] . '_ext') );
}
}
}

if( isset($_POST["reset"]) ){
if( 'reset' == $_REQUEST['action'] ) {

foreach ($options as $value) {
$img_check = isset($value['filename']) ? $value['filename'] : "";

if( $img_check ):
$file_up = $value['filename'] . '.' . get_option( $value['filename'] . '_ext');
if( file_exists( $option_upload_path . '/' . $file_up )) {
unlink( $option_upload_path . '/' . $file_up );
delete_option( $value['filename'] . '_ext' );
}
endif;

}

foreach ($options as $value) {
if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'],  $_REQUEST[ $value['id'] ] ); } else { delete_option( $value['id'] ); }
}

header("Location: themes.php?page=theme-options&reset=true");
die;
}
}

}


add_theme_page(_g ($theme_name . __(' Options' , TEMPLATE_DOMAIN)),  _g (__('Theme Options', TEMPLATE_DOMAIN)),  'edit_theme_options', 'theme-options', 'dez_theme_admin_option_register');
}

add_action('admin_menu', 'dez_theme_admin_menu_register');

/* including category color options functions */
include_once( get_template_directory() . '/lib/functions/category-color-functions.php');
include_once( get_template_directory() . '/lib/functions/page-color-functions.php');

?>