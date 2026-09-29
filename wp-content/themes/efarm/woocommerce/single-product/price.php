<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
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
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$apr_settings = apr_check_theme_options();
$unit_product = get_post_meta( get_the_id(), 'unit_product', true );
global $product;
?>
<?php if ( isset( $apr_settings['product-price'] ) && $apr_settings['product-price'] ) : ?>
	<p class="price">
		<?php echo $product->get_price_html(); ?>
		<?php if ( $unit_product ) : ?>
			<span class="unit_price">/<?php echo force_balance_tags( $unit_product ); ?></span>
		<?php endif; ?>
	</p>
<?php endif; ?>
