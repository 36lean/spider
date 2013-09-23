<?php
///////////////////////////////////////////////////////////////////////////////
// woocommerce - start global hooks
///////////////////////////////////////////////////////////////////////////////

//remove default open and close wrapper for woocommerce
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
//add new open and close wrapper for woocommerce
add_action('woocommerce_before_main_content', 'woocommerce_theme_before_content', 10);
add_action('woocommerce_after_main_content', 'woocommerce_theme_after_content', 20);
// Remove add to cart button on archives
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
// Remove sale flash on archives
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );


///////////////////////////////////////////////////////////////////////////////
// woocommerce - conditional to check if woocommerce related page showed
///////////////////////////////////////////////////////////////////////////////
if( !function_exists('is_in_woocommerce_page')):
function is_in_woocommerce_page() {
return ( is_shop() || is_product_category() || is_product_tag() || is_product() || is_cart() || is_checkout() || is_account_page() ) ? true : false;
}
endif;

///////////////////////////////////////////////////////////////////////////////
// woocommerce - display tab on or off
///////////////////////////////////////////////////////////////////////////////
add_action('wp_head','dez_wooframework_tab_check');
if ( !function_exists( 'dez_wooframework_tab_check' ) ) {
function dez_wooframework_tab_check() {
if ( get_theme_option('remove_product_tab') == 'true' ) {
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
}
}
}

///////////////////////////////////////////////////////////////////////////////
// woocommerce - Change number or products per row to 4
///////////////////////////////////////////////////////////////////////////////
add_filter('loop_shop_columns', 'dez_woo_loop_columns');
if (!function_exists('dez_woo_loop_columns')) {
function dez_woo_loop_columns() {
return 4;
}
}


///////////////////////////////////////////////////////////////////////////////
// woocommerce - add before and after container class
///////////////////////////////////////////////////////////////////////////////
if (!function_exists('woocommerce_theme_before_content')) {
function woocommerce_theme_before_content() {?>
<!-- #content Starts -->
<div id="content">
<!-- .woo-content Starts -->
<div id="woo-container" class="woo-content">
<?php
}
}

if (!function_exists('woocommerce_theme_after_content')) {
function woocommerce_theme_after_content() { ?>
</div><!-- end .woo-content -->
</div><!-- end #content -->
<?php
}
}

function woocommerce_show_custom_ads_top() { ?>
<?php }

function woocommerce_show_custom_ads_bottom() { ?>
<?php echo '<div class="adsense-single">'; ?>
<?php echo '</div>'; ?>
<?php }


add_action( 'woocommerce_before_shop_loop', 'woocommerce_show_custom_ads_top', 20 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_show_custom_ads_bottom', 20 );
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_show_custom_ads_bottom', 5 );

///////////////////////////////////////////////////////////////////////////////
// Number of products per page - overwrite default wp paging
///////////////////////////////////////////////////////////////////////////////
add_filter('loop_shop_per_page', 'woocommerce_theme_products_per_page');
if (!function_exists('woocommerce_theme_products_per_page')) {
function woocommerce_theme_products_per_page() {
return '12';
}
}
update_option( 'woocommerce_show_subcategories', 'no' );
update_option( 'woocommerce_shop_show_subcategories', 'no' );


///////////////////////////////////////////////////////////////////////////////
// woocommerce - single product functions/filter
///////////////////////////////////////////////////////////////////////////////
//remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products',20);
//add_action( 'woocommerce_product_tab_panels', 'woocommerce_output_related_products', 20);

if (!function_exists('woocommerce_custom_output_related_products')) {
function woocommerce_custom_output_related_products() {
return woocommerce_related_products(4,4);
}
}

// Upsells
remove_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display');
add_action( 'woocommerce_after_single_product', 'woocommerce_output_upsells', 20);

if (!function_exists('woocommerce_output_upsells')) {
function woocommerce_output_upsells() {
woocommerce_upsell_display(4,4); // Display 3 products in rows of 3
}
}


///////////////////////////////////////////////////////////////////////////////
// woocommerce - add related product in tabs
///////////////////////////////////////////////////////////////////////////////
function woocommerce_adding_related_tab() {  ?>
<li class="related_tab"><a href="#tab-related"><?php _e('Related Products', TEMPLATE_DOMAIN); ?></a></li>
<?php }

if ( ! function_exists( 'woocommerce_product_related_tab' ) ) {
function woocommerce_product_related_tab() {
woocommerce_adding_related_tab();
}
}
//add_action( 'woocommerce_product_tabs', 'woocommerce_product_related_tab', 40 );

if ( ! function_exists( 'woo_product_related_panel' ) ) {
function woo_product_related_panel() {
global $product, $woocommerce_loop;
echo '<div class="panel" id="tab-related">';
$related = $product->get_related();
if ( sizeof($related) ):
echo '<div class="related products">'.'<h2>'.__('Related Products', TEMPLATE_DOMAIN).'</h2>'.'<p class="messages">' . __('No related product found for this item', TEMPLATE_DOMAIN) . '</p>'.'</div>';
else:
woocommerce_custom_output_related_products();
endif;
echo '</div>';
}
}
//add_action( 'woocommerce_product_tab_panels', 'woo_product_related_panel', 40 );


///////////////////////////////////////////////////////////////////////////////
// woocommerce - paging and search fucntion tweak
///////////////////////////////////////////////////////////////////////////////
function woocommerceframework_add_search_fragment ( $settings ) {
	$settings['add_fragment'] = '&post_type=product';
	return $settings;
} // End woocommerceframework_add_search_fragment()

function woocommerceframework_woo_pagination_defaults ( $settings ) {
	$settings['use_search_permastruct'] = false;
	return $settings;
} // End woocommerceframework_woo_pagination_defaults()


// Remove pagination (we're using the WooFramework default pagination)
remove_action( 'woocommerce_pagination', 'woocommerce_pagination', 10 );
//remove and move the sorting to top of the page
//remove_action( 'woocommerce_pagination', 'woocommerce_catalog_ordering', 20);
//add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10 );

//remove star rating near title
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action('woocommerce_inside_product_right', 'woocommerce_template_loop_rating',1);

add_action( 'woocommerce_pagination', 'woocommerceframework_pagination', 10 );

function woocommerceframework_pagination() {
if ( is_search() && is_post_type_archive() ) {
add_filter( 'woo_pagination_args', 'woocommerceframework_add_search_fragment', 10 );
add_filter( 'woo_pagination_args_defaults', 'woocommerceframework_woo_pagination_defaults', 10 );
}
if( function_exists('dez_custom_woo_pagination') ):
dez_custom_woo_pagination();
endif;
}



///////////////////////////////////////////////////////////////////////////////
// woocommerce - modify searchform
///////////////////////////////////////////////////////////////////////////////
function woo_get_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" action="' . esc_url(home_url( '/' )) . '" >
    <label class="screen-reader-text" for="s">' . __('Search Products:', TEMPLATE_DOMAIN) . '</label>
    <input type="search" results=5 autosave="'. esc_url(home_url( '/' )) .'" class="input-text" placeholder="'. esc_attr__('Search Products') .'" value="' . get_search_query() . '" name="s" id="s" />
    <input type="submit" class="button" id="searchsubmit" value="'. esc_attr__('Search', TEMPLATE_DOMAIN) .'" />
    <input type="hidden" name="post_type" value="product" />
    </form>';
    return $form;
}
//add_filter( 'get_search_form', 'woo_get_search_form' );


///////////////////////////////////////////////////////////////////////////////
// woocommerce - shop/catalog order filter
///////////////////////////////////////////////////////////////////////////////
//add_filter('woocommerce_get_catalog_ordering_args', 'am_woocommerce_catalog_orderby');
function am_woocommerce_catalog_orderby( $args ) {
    //$args['meta_key'] = '_price';
    //$args['orderby'] = 'meta_value_num';
    $args['orderby'] = 'date';
    $args['order'] = 'desc';
    return $args;
}

///////////////////////////////////////////////////////////////////////////////
// woocommerce - add sharing box
///////////////////////////////////////////////////////////////////////////////
function dez_woo_sharebox() {
echo '<br />';
}
//add_action('woocommerce_share', 'dez_woo_sharebox', 20 );

///////////////////////////////////////////////////////////////////////////////
// woocommerce - allow shortcode in excerpt
///////////////////////////////////////////////////////////////////////////////
if ( !function_exists('woocommerce_template_single_excerpt' )) {
function woocommerce_template_single_excerpt( $post ) {
global $post;
if ($post->post_excerpt) {
echo '<div itemprop="description">' . do_shortcode(wpautop(wptexturize($post->post_excerpt))) . '</div>';
}
}
}


///////////////////////////////////////////////////////////////////////////////
// woocommerce - allow shortcode in excerpt
///////////////////////////////////////////////////////////////////////////////
if (!function_exists('woocommerce_my_custom_excerpt')) {
function woocommerce_my_custom_excerpt( $post ) {
global $post;
echo '<div class="post-content">';
if ($post->post_excerpt) {
echo do_shortcode(wpautop(wptexturize($post->post_excerpt)));
} else {
echo "<p>";
echo wpautop( wptexturize( dez_get_custom_the_excerpt(30) ) );
echo "</p>";
}
echo '</div>';
}
}
add_action('woocommerce_inside_product_right', 'woocommerce_my_custom_excerpt',12);





///////////////////////////////////////////////////////////////////////////////
// woocommerce - allow thumbnail wrapper
///////////////////////////////////////////////////////////////////////////////
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

/**
 * WooCommerce Loop Product Thumbs
 **/

 if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {

	function woocommerce_template_loop_product_thumbnail() {
		echo woocommerce_get_product_thumbnail();
	}
 }


/**
 * WooCommerce Product Thumbnail
 **/
 if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {

 function woocommerce_get_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {
		global $post, $woocommerce;

		if ( ! $placeholder_width )
			$placeholder_width = $woocommerce->get_image_size( 'shop_catalog_image_width' );
		if ( ! $placeholder_height )
			$placeholder_height = $woocommerce->get_image_size( 'shop_catalog_image_height' );

			$output = '<div class="product-thumb">';

			if ( has_post_thumbnail() ) {

				$output .= get_the_post_thumbnail( $post->ID, $size );

			} else {

				$output .= '<img src="'. woocommerce_placeholder_img_src() .'" alt="Placeholder" width="' . $placeholder_width . '" height="' . $placeholder_height . '" />';

			}

			$output .= '</div>';

			return $output;
	}
 }



remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
add_action( 'woocommerce_inside_product_right', 'woocommerce_template_loop_price', 10);


function add_post_right_div_start() {
 echo '<div class="post-product-right">';
 echo '<h1 class="product-post post-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h1>';
 do_action('woocommerce_inside_product_right');
}
function add_post_right_div_end() {
 echo '</div>';
}

add_action('woocommerce_after_shop_loop_item','add_post_right_div_start',0);
add_action('woocommerce_after_shop_loop_item','add_post_right_div_end',99);
///////////////////////////////////////////////////////////////////////////////
// woocommerce - add head css
///////////////////////////////////////////////////////////////////////////////
function woo_wp_custom_css() {
if( function_exists('is_in_woocommerce_page') && is_in_woocommerce_page() ) { ?>
<?php print "<style type='text/css' media='all'>"; ?>
<?php if( is_cart() || is_checkout() ): ?>
div#woo-wrapper .content {width:95%;margin: 0;clear:both;}
div#woo-wrapper #post-entry article .post-content {float: none !important;padding:0;}
div#woo-wrapper article.page {border: 0 none !important;margin:0 !important;padding:0 !important;}
h3#order_review_heading { margin-top: 3em; }
.sidebar, footer.footer-top { display: none !important; }
<?php endif; ?>
<?php print "</style>"; ?>
<?php }
}
add_action('wp_head', 'woo_wp_custom_css', 20);
?>