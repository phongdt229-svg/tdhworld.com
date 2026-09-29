<?php

// arrowpress_products_filter
add_shortcode( 'arrowpress_products_filter', 'arrowpress_shortcode_products_filter' );
add_action( 'vc_build_admin_page', 'arrowpress_load_products_filter_shortcode' );
add_action( 'vc_after_init', 'arrowpress_load_products_filter_shortcode' );

function arrowpress_shortcode_products_filter( $atts, $content = null ) {
	ob_start();
	if ( $template = arrowpress_shortcode_template( 'arrowpress_product_filter' ) ) {
		include $template;
	}

	return ob_get_clean();
}

function arrowpress_load_products_filter_shortcode() {
	$animation_type     = arrowpress_vc_animation_type();
	$animation_duration = arrowpress_vc_animation_duration();
	$animation_delay    = arrowpress_vc_animation_delay();
	$custom_class       = arrowpress_vc_custom_class();
	$order_way_values   = arrowpress_vc_woo_order_way();

	vc_map( array(
		'name'     => "ArrowPress " . esc_html__( 'Products Filter', 'arrowpress' ),
		'base'     => 'arrowpress_products_filter',
		'category' => esc_html__( 'ArrowPress', 'arrowpress' ),
		'icon'     => 'arrowpress_vc_icon',
		'weight'   => - 50,
		"params"   => array(
			array(
				"type"        => "dropdown",
				"heading"     => esc_html__( "Columns", 'arrowpress-core' ),
				"param_name"  => "colunms",
				'std'         => '4',
				'value'       => array(
					esc_html__( '1 Column', 'arrowpress-core' )  => '1',
					esc_html__( '2 Columns', 'arrowpress-core' ) => '2',
					esc_html__( '3 Columns', 'arrowpress-core' ) => '3',
					esc_html__( '4 Columns', 'arrowpress-core' ) => '4',

				),
				"description" => esc_html__( "Select colunms.", "arrowpress-core" ),
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__( "ID Category Parent", "arrowpress-core" ),
				"param_name"  => "category_parent",
				"value"       => 0,
				"admin_label" => true
			),
			array(
				"type"       => "textfield",
				"heading"    => esc_html__( "ID excluded categories", "arrowpress-core" ),
				"param_name" => "exclude_cat",
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Slug Name Category", "arrowpress-core" ),
				"param_name"  => "slug_name",
				"value"       => "",
				"admin_label" => true,
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Order way', 'arrowpress-core' ),
				'param_name'  => 'order',
				'value'       => $order_way_values,
				'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
			),
			// Show filter
			array(
				"type"       => "checkbox",
				"heading"    => esc_html__( "Show filter", 'arrowpress-core' ),
				"param_name" => "show_filter",
				'std'        => 'yes',
				'value'      => array( esc_html__( 'Yes', 'arrowpress-core' ) => 'yes' )
			),
			array(
				"type"       => "checkbox",
				"heading"    => esc_html__( "Show All", 'arrowpress' ),
				"param_name" => "show_all",
				'std'        => 'yes',
				'value'      => array( esc_html__( 'Yes', 'arrowpress' ) => 'yes' ),
				"dependency" => array(
					'element' => 'show_filter',
					'value'   => array( 'yes' )
				),
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Number of products_filter to show", "arrowpress-core" ),
				"param_name"  => "number",
				"value"       => "8",
				"admin_label" => true
			),
			array(
				"type"       => "checkbox",
				"heading"    => esc_html__( "Show view more", 'arrowpress' ),
				"param_name" => "view_more",
				'std'        => 'yes',
				'value'      => array( esc_html__( 'Yes', 'arrowpress' ) => 'yes' ),
			),
			array(
				"type"       => "textfield",
				"heading"    => esc_html__( "Button text", "arrowpress-core" ),
				"param_name" => "btn_text",
				"value"      => "visit store",
			),
			array(
				"type"       => "vc_link",
				"heading"    => esc_html__( "Button Link", 'arrowpress-core' ),
				"param_name" => "link",
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( "Item delay", "arrowpress-core" ),
				'param_name' => 'item_delay',
				'std'        => 'yes',
				'value'      => array( esc_html__( 'Yes', 'arrowpress' ) => 'yes' )
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Filter Color', 'arrowpress-core' ),
				'param_name' => 'filter_color',
				'group'      => esc_html__( 'Styles', 'arrowpress-core' ),
			),
			array(
				'type'        => 'number',
				'heading'     => esc_html__( 'Filter font size', 'arrowpress-core' ),
				'param_name'  => 'filter_size',
				'group'       => esc_html__( 'Styles', 'arrowpress-core' ),
				'description' => 'px',
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Filter Border Color', 'arrowpress-core' ),
				'param_name' => 'filter_border_color',
				'group'      => esc_html__( 'Styles', 'arrowpress-core' ),
			),
			array(
				"type"       => "dropdown",
				"heading"    => esc_html__( "Filter Border Styles", 'arrowpress-core' ),
				"param_name" => "filter_border_style",
				'std'        => 'solid',
				'value'      => array(
					esc_html__( 'Dotted', 'arrowpress-core' ) => 'dotted',
					esc_html__( 'Dashed', 'arrowpress-core' ) => 'dashed',
					esc_html__( 'Solid', 'arrowpress-core' )  => 'solid',
					esc_html__( 'Double', 'arrowpress-core' ) => 'double',
					esc_html__( 'Groove', 'arrowpress-core' ) => 'groove',
					esc_html__( 'Ridge', 'arrowpress-core' )  => 'ridge',
				),
				'group'      => esc_html__( 'Styles', 'arrowpress-core' ),
			),
			$custom_class
		)
	) );

	if ( ! class_exists( 'WPBakeryShortCode_Arrowpress_Product_Filter' ) ) {
		class WPBakeryShortCode_Arrowpress_Product_Filter extends WPBakeryShortCode {
		}
	}
}
