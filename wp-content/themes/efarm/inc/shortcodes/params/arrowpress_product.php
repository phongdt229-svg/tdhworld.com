<?php

// arrowpress_product
add_shortcode( 'arrowpress_product', 'arrowpress_shortcode_product' );
add_action( 'vc_build_admin_page', 'arrowpress_load_product_shortcode' );
add_action( 'vc_after_init', 'arrowpress_load_product_shortcode' );

function arrowpress_shortcode_product( $atts, $content = null ) {
	ob_start();
	if ( $template = arrowpress_shortcode_template( 'arrowpress_product' ) ) {
		include $template;
	}

	return ob_get_clean();
}

function arrowpress_load_product_shortcode() {
	$custom_class     = arrowpress_vc_custom_class();
	$order_by_values  = arrowpress_vc_woo_order_by();
	$order_way_values = arrowpress_vc_woo_order_way();
	vc_map( array(
		'name'     => "ArrowPress " . esc_html__( 'Product', 'arrowpress-core' ),
		'base'     => 'arrowpress_product',
		'category' => esc_html__( 'ArrowPress', 'arrowpress-core' ),
		'icon'     => 'arrowpress_vc_icon',
		'weight'   => - 50,
		"params"   => array(
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Layout', 'arrowpress-core' ),
				'param_name'  => 'layout',
				'std'         => '',
				'value'       => array(
					esc_html__( 'Product Grid', 'arrowpress-core' )    => 'grid',
					esc_html__( 'Product Slide', 'arrowpress-core' )   => 'slide',
					esc_html__( 'Product List', 'arrowpress-core' )    => 'list',
					esc_html__( 'Product Packery', 'arrowpress-core' ) => 'packery',
				),
				"admin_label" => true,
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Layout style', 'arrowpress-core' ),
				'param_name'  => 'layout_style',
				'std'         => '',
				'value'       => array(
					esc_html__( 'Layout Style 1', 'arrowpress-core' ) => 'style_1',
					esc_html__( 'Layout Style 2', 'arrowpress-core' ) => 'style_2',
					esc_html__( 'Layout Style 3', 'arrowpress-core' ) => 'style_3',
					esc_html__( 'Layout Style 4', 'arrowpress-core' ) => 'style_4',
					esc_html__( 'Layout Style 5', 'arrowpress-core' ) => 'style_5',
				),
				"dependency"  => array(
					'element' => 'layout',
					'value'   => array( 'slide' )
				),
				"admin_label" => true,
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Image Position', 'arrowpress-core' ),
				'param_name' => 'image_position',
				'value'      => array(
					esc_html__( 'Image Right', 'arrowpress-core' ) => 'image_right',
					esc_html__( 'Image Left', 'arrowpress-core' )  => 'image_left',
				),
				"dependency" => array(
					'element' => 'layout_style',
					'value'   => array( 'style_2' )
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Type Pagination', 'arrowpress-core' ),
				'param_name' => 'type_pagination',
				'value'      => array(
					esc_html__( 'Dot Pagination', 'arrowpress-core' )   => 'dot_pagination',
					esc_html__( 'Arrow Pagination', 'arrowpress-core' ) => 'arrow_pagination',
				),
				"dependency" => array(
					'element' => 'layout_style',
					'value'   => array( 'style_2' )
				),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Product type', 'arrowpress-core' ),
				'param_name'  => 'shortcodes_layout',
				'std'         => '',
				'value'       => array(
					esc_html__( 'Rencent Products', 'arrowpress-core' )      => 'recent_products',
					esc_html__( 'Featured Products', 'arrowpress-core' )     => 'featured_products',
					esc_html__( 'Best-Selling Products', 'arrowpress-core' ) => 'best_selling_products',
					esc_html__( 'Top Rated Products', 'arrowpress-core' )    => 'top_rated_products',
					esc_html__( 'Sale Products', 'arrowpress-core' )         => 'sale_products',
				),
				"admin_label" => true,
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Per page', 'arrowpress-core' ),
				'value'       => 12,
				'param_name'  => 'per_page',
				'description' => __( 'The "per_page" shortcode determines how many products to show on the page', 'arrowpress-core' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Columns', 'arrowpress-core' ),
				'param_name'  => 'columns',
				'std'         => '4',
				'value'       => arrowpress_sh_commons( 'products_columns' ),
				'admin_label' => true,
				"dependency"  => array(
					'element' => 'layout',
					'value'   => array( 'grid' )
				),
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Category Slug Name", 'arrowpress-core' ),
				"param_name"  => "slug_name",
				"value"       => '',
				"admin_label" => true
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Order by', 'arrowpress-core' ),
				'param_name'  => 'orderby',
				'value'       => $order_by_values,
				'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'arrowpress-core' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Order way', 'arrowpress-core' ),
				'param_name'  => 'order',
				'value'       => $order_way_values,
				'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'arrowpress-core' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
			),
			array(
				"type"       => "checkbox",
				"heading"    => esc_html__( "Show view more", 'arrowpress-core' ),
				"param_name" => "view_more",
				'std'        => 'yes',
				'value'      => array( esc_html__( 'Yes', 'arrowpress-core' ) => 'yes' ),
			),
			array(
				"type"       => "dropdown",
				"heading"    => esc_html__( "Number Column on Desktop Large (> 1200px)", 'arrowpress-core' ),
				"param_name" => "items_desktop_large",
				'std'        => 3,
				'value'      => array(
					esc_html__( '4', 'arrowpress-core' ) => 4,
					esc_html__( '3', 'arrowpress-core' ) => 3,
					esc_html__( '2', 'arrowpress-core' ) => 2,
					esc_html__( '1', 'arrowpress-core' ) => 1,
				),
				"dependency" => array(
					'element' => 'layout',
					'value'   => array( 'slide' )
				),
				'group'      => esc_html__( 'Responsive Slide', 'arrowpress-core' ),
			),
			array(
				"type"       => "dropdown",
				"heading"    => esc_html__( "Number Column on Desktop", 'arrowpress-core' ),
				"param_name" => "items_desktop",
				'std'        => 2,
				'value'      => array(
					esc_html__( '4', 'arrowpress-core' ) => 4,
					esc_html__( '3', 'arrowpress-core' ) => 3,
					esc_html__( '2', 'arrowpress-core' ) => 2,
					esc_html__( '1', 'arrowpress-core' ) => 1,
				),
				"dependency" => array(
					'element' => 'layout',
					'value'   => array( 'slide' )
				),
				'group'      => esc_html__( 'Responsive Slide', 'arrowpress-core' )
			),
			array(
				"type"       => "dropdown",
				"heading"    => __( "Number Column on Tablets", "arrowpress-core" ),
				"param_name" => "items_tablets",
				'std'        => 2,
				'value'      => array(
					esc_html__( '4', 'arrowpress-core' ) => 4,
					esc_html__( '3', 'arrowpress-core' ) => 3,
					esc_html__( '2', 'arrowpress-core' ) => 2,
					esc_html__( '1', 'arrowpress-core' ) => 1,
				),
				"dependency" => array(
					'element' => 'layout',
					'value'   => array( 'slide' )
				),
				'group'      => esc_html__( 'Responsive Slide', 'arrowpress-core' )
			),
			array(
				"type"       => "dropdown",
				"heading"    => __( "Number Column on Mobile", "arrowpress-core" ),
				"param_name" => "items_mobile",
				'std'        => 1,
				'value'      => array(
					esc_html__( '4', 'arrowpress-core' ) => 4,
					esc_html__( '3', 'arrowpress-core' ) => 3,
					esc_html__( '2', 'arrowpress-core' ) => 2,
					esc_html__( '1', 'arrowpress-core' ) => 1,
				),
				"dependency" => array(
					'element' => 'layout',
					'value'   => array( 'slide' )
				),
				'group'      => esc_html__( 'Responsive Slide', 'arrowpress-core' )
			),
			$custom_class
		)
	) );

	if ( ! class_exists( 'WPBakeryShortCode_Arrowpress_Product' ) ) {
		class WPBakeryShortCode_Arrowpress_Product extends WPBakeryShortCode {
		}
	}
}
