<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 9.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly 
}

global $product, $woocommerce_loop;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
// Increase loop count
$entries_count = 0;
$post_term_arr = get_the_terms( get_the_ID(), 'product_cat' );
$post_term_filters = '';
$post_term_names = '';
if( is_array( $post_term_arr ) && count( $post_term_arr ) > 0 ) {
    foreach ( $post_term_arr as $post_term ) {

        $post_term_filters .= $post_term->slug . ' ';
        $post_term_names .= $post_term->name . ', ';
    }
}

$post_term_filters = trim( $post_term_filters );
$post_term_names = substr( $post_term_names, 0, -2 );
$classes[] = "item";
$classes[] = $post_term_filters;
$sub_title_product = get_post_meta(get_the_id(), 'sub_title_product', true);
if (isset($woocommerce_loop['layout_style']) && ($woocommerce_loop['layout_style'] == 'style_2' || $woocommerce_loop['layout_style'] == 'style_3'))
    $classes[] = 'product_style_2';
if(isset($woocommerce_loop['layout']) && ($woocommerce_loop['layout'] == 'packery')){
	$index_size2 = array('3','6','13','16','23','26','33','36','43','46');
	$classes[] = "";
	if(in_array($woocommerce_loop['i'], $index_size2)){
		$classes[] = 'image_size2';
	}else{
		$classes[] = 'image_size';
	} 
}
?>
<div <?php post_class($classes); ?>>
	<div class="product-content clearfix">
		<div class="product-image">
			<?php if(isset($woocommerce_loop['layout']) && ($woocommerce_loop['layout'] == 'packery')): ?>
				<?php if(in_array($woocommerce_loop['i'], $index_size2)): ?>
					<a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
						<?php echo $product->get_image('apr_shop_packery'); ?>
					</a>
				<?php else: ?>
					<a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
						<?php echo $product->get_image('apr_shop_packery_2'); ?>
					</a>
				<?php endif;?>
				<?php
					/**
					 * woocommerce_before_shop_loop_item_title_packery hook.
					 *
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 */
					do_action( 'woocommerce_before_shop_loop_item_title_packery' );
				?>
			<?php else: ?>
				<?php
					/**
					 * woocommerce_before_shop_loop_item_title hook.
					 *
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 */
					do_action( 'woocommerce_before_shop_loop_item_title' );
				?>
			<?php endif;?>
			<div class="product-action product-action-grid">
				<?php if(class_exists('YITH_WCQV') || class_exists('YITH_WCWL') || class_exists('WooCommerce')) :?>
				<div class="action_item_box">
				<?php
				/**
				 * woocommerce_product_action hook.
				 *
				 * @hooked apr_wishlist_custom - 10
				 * @hooked apr_compare_product - 20
				 * @hooked apr_quickview - 30
				 */
				do_action( 'woocommerce_product_action' );
				?>
				</div>
				<?php endif;?>
			</div>
		</div>
		<?php if (isset($woocommerce_loop['layout_style']) && $woocommerce_loop['layout_style'] == 'style_3'): ?>
			<div class="product-action product-action-list">
				<?php if(class_exists('YITH_WCQV') || class_exists('YITH_WCWL') || class_exists('WooCommerce')) :?>
				<div class="action_item_box">
				<?php
				/**
				 * woocommerce_product_action hook.
				 *
				 * @hooked apr_wishlist_custom - 10
				 * @hooked apr_compare_product - 20
				 * @hooked apr_quickview - 30
				 */
				do_action( 'woocommerce_product_action_list' );
				?>
				</div>
				<?php endif;?>
            </div>
		<?php endif;?>	
		<div class="product-desc">
			<?php if (isset($woocommerce_loop['layout_style']) && ($woocommerce_loop['layout_style'] == 'style_2' || $woocommerce_loop['layout_style'] == 'style_3' || $woocommerce_loop['layout_style'] == 'style_5')):?>
				<span class="term_name"><?php echo get_the_term_list($post->ID,'product_cat', '', ', ' ); ?></span>
			<?php endif;?>	
			<h3><a href="<?php the_permalink(); ?>" class="product-name"><?php the_title(); ?></a></h3>
			<?php if($sub_title_product) :?>
				<p class="sub_title"><?php echo force_balance_tags($sub_title_product); ?></p>
			<?php endif;?>	
			<?php if (isset($woocommerce_loop['layout_style']) && ($woocommerce_loop['layout_style'] == 'style_2' || $woocommerce_loop['layout_style'] == 'style_3' || $woocommerce_loop['layout_style'] == 'style_5')):?>
				<?php the_excerpt();?>
			<?php endif;?>
            <?php
            /**
             * woocommerce_after_shop_loop_item_title hook
             *
             * @hooked woocommerce_template_loop_rating - 5
             * @hooked woocommerce_template_loop_price - 10
             */
            do_action('woocommerce_after_shop_loop_item_title');
			?>
			<div class="product-action product-action-list">
				<?php if(class_exists('YITH_WCQV') || class_exists('YITH_WCWL') || class_exists('WooCommerce')) :?>
				<div class="action_item_box">
				<?php
				/**
				 * woocommerce_product_action hook.
				 *
				 * @hooked apr_wishlist_custom - 10
				 * @hooked apr_compare_product - 20
				 * @hooked apr_quickview - 30
				 */
				do_action( 'woocommerce_product_action_list' );
				?>
				</div>
				<?php endif;?>
            </div>
		</div>
	</div>
</div>
<?php 
    $entries_count++;
	if(isset($woocommerce_loop['layout']) && ($woocommerce_loop['layout'] == 'packery')){
		$woocommerce_loop['i']++;
	}
?>