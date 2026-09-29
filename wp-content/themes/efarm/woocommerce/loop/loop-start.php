<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */
?>
<?php 
global $wp_query;
global $product, $woocommerce_loop;
$apr_settings = apr_check_theme_options();
$cat = $wp_query->get_queried_object();
if(isset($cat->term_id)){
	$woo_cat = $cat->term_id;
}else{
	$woo_cat = '';
}
$product_list_mode = $apr_settings['product-layouts'];
if(is_tax('product_cat')){
    $product_list_mode = get_metadata('product_cat', $woo_cat, 'list_mode_product', true);
}
$product_type_class = '';
if($product_list_mode == "only-grid"){
	$product_type_class = "product-grid";
}
else if($product_list_mode == "only-list"){
	$product_type_class = "product-list";
}
else{
	$product_type_class = "product-grid"; 
}
$classes = " ";
if (isset($woocommerce_loop['layout']) && ($woocommerce_loop['layout'] == 'grid') || isset($woocommerce_loop['layout']) && ($woocommerce_loop['layout'] == 'packery')){
	//$classes = ' isotope';
}
   
?>
<div class="product_types clearfix <?php echo esc_attr($product_type_class);?> <?php echo esc_attr($classes);?>">


