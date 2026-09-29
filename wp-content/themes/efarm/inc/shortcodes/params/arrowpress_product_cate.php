<?php

// arrowpress_product_cate
add_shortcode( 'arrowpress_product_cate', 'arrowpress_shortcode_product_cate' );
add_action( 'vc_build_admin_page', 'arrowpress_load_product_cate_shortcode' );
add_action( 'vc_after_init', 'arrowpress_load_product_cate_shortcode' );

function arrowpress_shortcode_product_cate( $atts, $content = null ) {
	ob_start();
	if ( $template = arrowpress_shortcode_template( 'arrowpress_product_cate' ) ) {
		include $template;
	}

	return ob_get_clean();
}

function arrowpress_load_product_cate_shortcode() {
	$custom_class     = arrowpress_vc_custom_class();
	$order_by_values  = arrowpress_vc_woo_order_by();
	$order_way_values = arrowpress_vc_woo_order_way();
	vc_map( array(
		'name'     => "ArrowPress " . esc_html__( 'Product Category', 'arrowpress-core' ),
		'base'     => 'arrowpress_product_cate',
		'category' => esc_html__( 'ArrowPress', 'arrowpress-core' ),
		'icon'     => 'arrowpress_vc_icon',
		'weight'   => - 50,
		"params"   => array(
			array(
				'type'        => 'number',
				'heading'     => esc_html__( 'Number', 'arrowpress-core' ),
				'value'       => 12,
				'param_name'  => 'number',
				'description' => esc_html__( 'The `number` field is used to display the number of categories.', 'arrowpress-core' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Columns', 'arrowpress-core' ),
				'param_name'  => 'columns',
				'std'         => '',
				'value'       => array(
					esc_html__( '2 Columns', 'arrowpress-core' ) => '2',
					esc_html__( '3 Columns', 'arrowpress-core' ) => '3',
					esc_html__( '4 Columns', 'arrowpress-core' ) => '4',
					esc_html__( '5 Columns', 'arrowpress-core' ) => '5',
					esc_html__( '6 Columns', 'arrowpress-core' ) => '6',
				),
				'admin_label' => true,
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Slug Name of parent category", "foodfarm-shortcodes" ),
				"param_name"  => "parent",
				"value"       => '',
				"admin_label" => true,
				'description' => esc_html__( 'Enter slug name of parent category to get all child categories.', 'foodfarm-shortcodes' ),
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__( "ID of excluded categories", 'arrowpress-core' ),
				"param_name"  => "ex_cat",
				"value"       => '',
				'description' => esc_html__( 'Enter ID of categories you want to hide (seperate each ID by comma)', 'arrowpress-core' ),
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
			// array(
			//     "type" => "checkbox",
			//     "heading" => esc_html__("Show button", 'arrowpress-core'),
			//     "param_name" => "view_more",
			//     'std' => 'yes',
			//     'value' => array(esc_html__('Yes', 'arrowpress-core') => 'yes'),
			// ),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Hide Empty', 'arrowpress-core' ),
				'param_name'  => 'hide_empty',
				'std'         => 'yes',
				'value'       => array(
					esc_html__( 'Yes', 'arrowpress-core' ) => 'yes',
					esc_html__( 'No', 'arrowpress-core' )  => 'no',
				),
				'description' => esc_html__( 'Hide empty cateogries', 'arrowpress-core' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Display product count', 'arrowpress-core' ),
				'param_name' => 'pad_count',
				'std'        => 'yes',
				'value'      => array(
					esc_html__( 'Yes', 'arrowpress-core' ) => 'yes',
					esc_html__( 'No', 'arrowpress-core' )  => 'no',
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Display image', 'arrowpress-core' ),
				'param_name' => 'dis_img',
				'std'        => 'yes',
				'value'      => array(
					esc_html__( 'Yes', 'arrowpress-core' ) => 'yes',
					esc_html__( 'No', 'arrowpress-core' )  => 'no',
				),
			),
			array(
				"type"       => "textfield",
				"heading"    => esc_html__( "Button text", 'arrowpress-core' ),
				"param_name" => "btn_text",
				"value"      => "",
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Title Color', 'arrowpress-core' ),
				'param_name' => 'title_color',
				'group'      => 'Style',
			),
			array(
				"type"       => "colorpicker",
				"heading"    => esc_html__( "Background color", 'arrowpress-core' ),
				"param_name" => "background_color",
				'group'      => 'Style',
			),
			array(
				"type"       => "colorpicker",
				"heading"    => esc_html__( "[Hover] Background hover color", 'arrowpress-core' ),
				"param_name" => "bg_hcolor",
				'group'      => 'Style',
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( '[Hover] Title Color', 'arrowpress-core' ),
				'param_name' => 'title_hcolor',
				'group'      => 'Style',
			),
			$custom_class,
			array(
				'type'       => 'css_editor',
				'heading'    => esc_html__( 'Css', 'arrowpress-core' ),
				'param_name' => 'css',
				'group'      => esc_html__( 'Design Option', 'arrowpress-core' ),
			)
		)
	) );

	if ( ! class_exists( 'WPBakeryShortCode_ArrowPress_Product_Cate' ) ) {
		class WPBakeryShortCode_ArrowPress_Product_Cate extends WPBakeryShortCode {
		}
	}
}
