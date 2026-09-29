<?php

$output   = $title = $orderby = $order = $items_desktop_large = $items_desktop = $items_tablets = $items_mobile = $el_class = '';
$per_page = 12;
$columns  = 4;
extract(
	shortcode_atts( array(
		'layout'              => 'grid',
		'layout_style'        => 'style_1',
		'image_position'      => 'image_right',
		'type_pagination'     => 'dot_pagination',
		'shortcodes_layout'   => 'recent_products',
		'slug_name'           => '',
		'per_page'            => 12,
		'columns'             => 4,
		'orderby'             => 'date',
		'order'               => 'desc',
		'view_more'           => 'yes',
		'items_desktop_large' => 3,
		'items_desktop'       => 3,
		'items_tablets'       => 2,
		'items_mobile'        => 1,
		'el_class'            => ''
	), $atts )
);

$shortcodes = '';
if ( $shortcodes_layout == 'recent_products' ) {
	$shortcodes = 'recent_products';
} elseif ( $shortcodes_layout == 'featured_products' ) {
	$shortcodes = 'featured_products';
} elseif ( $shortcodes_layout == 'best_selling_products' ) {
	$shortcodes = 'best_selling_products';
} elseif ( $shortcodes_layout == 'top_rated_products' ) {
	$shortcodes = 'top_rated_products';
} else {
	$shortcodes = 'sale_products';
}
//pagination
if ( $type_pagination == 'dot_pagination' && $layout_style == 'style_2' ) {
	$type_pagination_class = ' dot_pagination';
} else {
	$type_pagination_class = ' arrow_pagination';
}
//images position class
if ( $image_position == 'image_right' ) {
	$image_positon_class = '';
} else {
	$image_positon_class = ' image_left_pos';
}
//layout class
if ( $layout == 'slide' ) {
	$slide_class = ' product_slide';
	$slide_id    = 'product_slide_' . wp_rand();
} elseif ( $layout == 'list' ) {
	$slide_class = ' product_layout_list';
	$slide_id    = '';
} elseif ( $layout == 'packery' ) {
	$slide_class = ' product_layout_packery';
	$slide_id    = '';
} else {
	$slide_class = ' product_layout_grid';
	$slide_id    = '';
}
//layout style class
$layout_style_class = ' ';
if ( $layout == 'slide' ) {
	if ( $layout_style == 'style_2' ) {
		$layout_style_class = ' layout_style_2';
	} elseif ( $layout_style == 'style_3' ) {
		$layout_style_class = ' layout_style_2 layout_style_3';
	} elseif ( $layout_style == 'style_4' ) {
		$layout_style_class = ' layout_style_1 layout_style_4';
	} elseif ( $layout_style == 'style_5' ) {
		$layout_style_class = ' layout_style_2 layout_style_5';
	} else {
		$layout_style_class = ' layout_style_1';
	}
}

$el_class = arrowpress_shortcode_extract_class( $el_class );

$output = '<div class=" arrowpress-products wpb_content_element ' . $shortcodes . $slide_class . $layout_style_class . $el_class . $image_positon_class . $type_pagination_class . ' ' . $slide_id . '"';
$output .= '>';

global $woocommerce_loop;

$woocommerce_loop['columns'] = $columns;
if ( $layout == 'slide' ) {
	$woocommerce_loop['layout_style'] = $layout_style;
}
if ( $layout == 'grid' ) {
	$woocommerce_loop['layout'] = $layout;
}
if ( $layout == 'packery' ) {
	$woocommerce_loop['layout'] = $layout;
	$woocommerce_loop['i']      = 1;
}
ob_start();
?>
<?php
echo do_shortcode( '[' . $shortcodes . ' category="' . $slug_name . '" per_page="' . $per_page . '" columns="' . $columns . '" orderby="' . $orderby . '" order="' . $order . '"]' );
?>
<?php if ( $view_more ) : ?>
	<div class="btn-viewmore text-center">
		<a class="view_more btn btn-primary" href="<?php echo get_post_type_archive_link( 'product' ); ?>">
			<?php if ( $layout == 'packery' ): ?>
				<?php echo esc_html__( 'View more products', 'arrowpress-core' ); ?>
			<?php else: ?>
				<?php echo esc_html__( 'visit store ', 'arrowpress-core' ); ?>
			<?php endif; ?>
		</a>
	</div>
<?php endif; ?>
<?php if ( $layout == 'slide' ) : ?>
	<script type="text/javascript">
		jQuery(function ($) {
			$(document).ready(function () {
				$('.<?php echo esc_js( $slide_id ); ?> .product-grid').slick({
					slidesToScroll: 1,
					<?php if($layout_style == "style_4"): ?>
					slidesToScroll: 4,
					<?php endif;?>
					<?php if(is_rtl()):?>
					rtl: true,
					<?php endif; ?>
					infinite    : true,
					nextArrow   : '<button class="btn-prev"><i class="pe-7s-angle-right"></i></button>',
					prevArrow   : '<button class="btn-next"><i class="pe-7s-angle-left"></i></button>',
					slidesToShow: <?php echo esc_js( $items_desktop_large );?>,
					arrows      : true,
					dots        : true,
					responsive  : [
						{
							breakpoint: 1200,
							settings  : {
								slidesToShow: <?php echo esc_js( $items_desktop );?>,
							}
						},
						{
							breakpoint: 992,
							settings  : {
								slidesToShow: <?php echo esc_js( $items_tablets );?>,
							}
						},
						{
							breakpoint: 480,
							settings  : {
								slidesToShow: <?php echo esc_js( $items_mobile );?>,
							}
						},
					]
				});
			});
		});
	</script>
<?php endif; ?>
<?php
$output .= ob_get_clean();
$output .= '</div>' . arrowpress_shortcode_end_block_comment( 'arrowpress_product' ) . "\n";
echo $output;
wp_reset_postdata();
