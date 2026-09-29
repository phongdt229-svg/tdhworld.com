<?php

// foodfarm_portfolio
add_shortcode( 'arrowpress_portfolio', 'arrowpress_shortcode_portfolio' );
add_action( 'vc_build_admin_page', 'arrowpress_load_portfolio_shortcode' );
add_action( 'vc_after_init', 'arrowpress_load_portfolio_shortcode' );

function arrowpress_shortcode_portfolio( $atts, $content = null ) {
	ob_start();
	if ( $template = arrowpress_shortcode_template( 'arrowpress_portfolio' ) ) {
		include $template;
	}

	return ob_get_clean();
}

function arrowpress_load_portfolio_shortcode() {
	$custom_class     = arrowpress_vc_custom_class();
	$order_by_values  = arrowpress_vc_woo_order_by();
	$order_way_values = arrowpress_vc_woo_order_way();
	vc_map( array(
		'name'     => "ArrowPress " . esc_html__( 'Portfolio', 'arrowpress-core' ),
		'base'     => 'arrowpress_portfolio',
		'category' => esc_html__( 'ArrowPress', 'arrowpress-core' ),
		'icon'     => 'arrowpress_vc_icon',
		'weight'   => - 50,
		"params"   => array(
			array(
				"type"       => "dropdown",
				"heading"    => esc_html__( "Layout", 'arrowpress-core' ),
				"param_name" => "layout",
				'std'        => 'grid',
				'value'      => array(
					esc_html__( 'Grid 1', 'arrowpress-core' )     => 'grid',
					esc_html__( 'Slide 1', 'arrowpress-core' )    => 'slide',
					esc_html__( 'Packery 1', 'arrowpress-core' )  => 'masonry_1',
					esc_html__( 'Packery 2', 'arrowpress-core' )  => 'masonry_2',
					esc_html__( 'Packery 3', 'arrowpress-core' )  => 'masonry_5',
					esc_html__( 'Packery 4', 'arrowpress-core' )  => 'masonry_6',
					esc_html__( 'Masonry 1 ', 'arrowpress-core' ) => 'masonry_3',
					esc_html__( 'Masonry 2', 'arrowpress-core' )  => 'masonry_4',
				),
			),
			array(
				"type"       => "dropdown",
				"heading"    => esc_html__( "Style", 'arrowpress-core' ),
				"param_name" => "layout_style",
				'std'        => 'layout_style_1',
				'value'      => array(
					esc_html__( 'Layout Style 1', 'arrowpress-core' ) => 'layout_style_1',
					esc_html__( 'Layout Style 2', 'arrowpress-core' ) => 'layout_style_2',
					esc_html__( 'Layout Style 3', 'arrowpress-core' ) => 'layout_style_3',
				),
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Big Title", 'arrowpress-core' ),
				"param_name"  => "big_title",
				"value"       => "",
				'dependency'  => array(
					'element' => 'layout',
					'value'   => array( 'masonry_2' ),
				),
				"admin_label" => true
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Small Title", 'arrowpress-core' ),
				"param_name"  => "small_title",
				"value"       => "",
				'dependency'  => array(
					'element' => 'layout',
					'value'   => array( 'masonry_2' ),
				),
				"admin_label" => true
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Number of portfolio to show", 'arrowpress-core' ),
				"param_name"  => "number",
				"value"       => "8",
				"admin_label" => true
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Category ID", 'arrowpress-core' ),
				"description" => esc_html__( "Enter ID of category.", 'arrowpress-core' ),
				"param_name"  => "cat",
				"admin_label" => true
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Order way', 'arrowpress-core' ),
				'param_name'  => 'order',
				'value'       => $order_way_values,
				'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'arrowpress-core' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
			),

			array(
				"type"        => "dropdown",
				"heading"     => esc_html__( "Portfolio Columns", 'arrowpress-core' ),
				"param_name"  => "columns",
				'std'         => 3,
				'value'       => array(
					esc_html__( '2 Columns', 'arrowpress-core' ) => '2',
					esc_html__( '3 Columns', 'arrowpress-core' ) => '3',
					esc_html__( '4 Columns', 'arrowpress-core' ) => '4',
				),
				'dependency'  => array(
					'element' => 'layout',
					'value'   => array( 'masonry_3', 'grid', 'masonry_4' ),
				),
				"admin_label" => true
			),
			array(
				"type"       => "checkbox",
				"heading"    => esc_html__( "Display filter", 'arrowpress-core' ),
				"param_name" => "show_filter",
				'std'        => 'yes',
				'value'      => array( esc_html__( 'Yes', 'arrowpress-core' ) => 'yes' )
			),
			array(
				"type"       => "dropdown",
				"heading"    => esc_html__( " Filter Align", 'arrowpress-core' ),
				"param_name" => "filter_align",
				'std'        => 'center',
				'value'      => array(
					esc_html__( 'Center', 'arrowpress-core' ) => 'center',
					esc_html__( 'Left', 'arrowpress-core' )   => 'left',
					esc_html__( 'Right', 'arrowpress-core' )  => 'right',
				),
				'dependency' => array(
					'element' => 'show_filter',
					'value'   => array( 'yes' ),
				),
			),
			// array(
			//     "type" => "checkbox",
			//     "heading" => esc_html__("Show link gallery", 'arrowpress-core'),
			//     "param_name" => "show_link",
			//     'value' => array(esc_html__('Yes', 'arrowpress-core') => 'yes')
			// ),
			// array(
			//     "type" => "textfield",
			//     "heading" => esc_html__("Enter gallery link text", 'arrowpress-core'),
			//     "param_name" => "hireusnow",
			//     'value' => array(esc_html__('Yes', 'arrowpress-core') => 'yes'),
			//     'dependency' => array(
			//         'element' => 'show_link',
			//         'value' => array('yes'),
			//     ),
			// ),
			array(
				"type"       => "checkbox",
				"heading"    => esc_html__( "Show Space", 'arrowpress-core' ),
				"param_name" => "show_space",
				'std'        => 'yes',
				'value'      => array(
					esc_html__( 'Yes', 'arrowpress-core' ) => 'yes'
				),
			),
			array(
				"type"       => "checkbox",
				"heading"    => esc_html__( "Show load more", 'arrowpress-core' ),
				"param_name" => "show_viewmore",
				'value'      => array( esc_html__( 'Yes', 'arrowpress-core' ) => 'yes' )
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Load More text", 'arrowpress-core' ),
				"description" => esc_html__( "Default: View more projects", 'arrowpress-core' ),
				"param_name"  => "loadmore_text",
			),
			array(
				"type"       => "dropdown",
				"heading"    => esc_html__( "Load More Style", 'arrowpress-core' ),
				"param_name" => "loadmore_style",
				'std'        => 'btn-style1',
				'value'      => array(
					esc_html__( 'Button style 1', 'arrowpress-core' ) => 'btn-style1',
					esc_html__( 'Button style 2', 'arrowpress-core' ) => 'btn-style2',
					esc_html__( 'Button style 3', 'arrowpress-core' ) => 'btn-style3',
				),
			),
			array(
				"type"        => "number",
				"class"       => "",
				"heading"     => esc_html__( "Space Top Button", 'arrowpress-core' ),
				"param_name"  => "space_top_btn",
				"value"       => "",
				'admin_label' => true,
				'description' => esc_html__( 'px', 'arrowpress-core' ),
				'group'       => 'Typography'
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Filter Color', 'arrowpress-core' ),
				'param_name' => 'filter_color',
				'group'      => esc_html__( 'Skin', 'arrowpress-core' ),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( "Item delay", 'arrowpress-core' ),
				'param_name' => 'item_delay',
				'std'        => 'yes',
				'value'      => array( esc_html__( 'Yes', 'arrowpress-core' ) => 'yes' )
			),
			$custom_class
		)
	) );

	if ( ! class_exists( 'WPBakeryShortCode_Arrowpress_Portfolio' ) ) {
		class WPBakeryShortCode_Arrowpress_Portfolio extends WPBakeryShortCode {
		}
	}
}
