<?php

// arrowpress_blog_cate
add_shortcode( 'arrowpress_blog_cate', 'arrowpress_shortcode_blog_cate' );
add_action( 'vc_build_admin_page', 'arrowpress_load_blog_cate_shortcode' );
add_action( 'vc_after_init', 'arrowpress_load_blog_cate_shortcode' );

function arrowpress_shortcode_blog_cate( $atts, $content = null ) {
	ob_start();
	if ( $template = arrowpress_shortcode_template( 'arrowpress_blog_cate' ) ) {
		include $template;
	}

	return ob_get_clean();
}

function arrowpress_load_blog_cate_shortcode() {
	$custom_class     = arrowpress_vc_custom_class();
	$order_by_values  = arrowpress_vc_woo_order_by();
	$order_way_values = arrowpress_vc_woo_order_way();
	vc_map( array(
		'name'     => "ArrowPress " . esc_html__( 'Blog Category', 'arrowpress-core' ),
		'base'     => 'arrowpress_blog_cate',
		'category' => esc_html__( 'ArrowPress', 'arrowpress-core' ),
		'icon'     => 'arrowpress_vc_icon',
		'weight'   => - 50,
		"params"   => array(
			array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Number of blog to show", 'arrowpress-core' ),
				"param_name"  => "number",
				"value"       => "8",
				"admin_label" => true
			),
			array(
				"type"             => "number",
				"class"            => "",
				"edit_field_class" => "vc_col-sm-4 items_to_show ult_margin_bottom",
				"heading"          => esc_html__( "Items On Desktop Large", 'arrowpress-core' ),
				"param_name"       => "slides_on_desk",
				"value"            => "4",
			),
			array(
				"type"             => "number",
				"class"            => "",
				"edit_field_class" => "vc_col-sm-4 items_to_show ult_margin_bottom",
				"heading"          => esc_html__( "Items On Desktop", 'arrowpress-core' ),
				"param_name"       => "slides_on_tabs",
				"value"            => "3",
			),
			array(
				"type"             => "number",
				"class"            => "",
				"edit_field_class" => "vc_col-sm-4 items_to_show ult_margin_bottom",
				"heading"          => esc_html__( "Items On Mobile", 'arrowpress-core' ),
				"param_name"       => "slides_on_mob",
				"value"            => "2",
			),
			array(
				"type"             => "number",
				"class"            => "",
				"edit_field_class" => "vc_col-sm-4 items_to_show ult_margin_bottom",
				"heading"          => esc_html__( "Items On Mobile Small", 'arrowpress-core' ),
				"param_name"       => "slides_on_mob_small",
				"value"            => "1",
			),
			array(
				"type"        => "dropdown",
				"heading"     => esc_html__( "Display", 'arrowpress-core' ),
				"param_name"  => "post_display_type",
				'std'         => '',
				'value'       => array(
					esc_html__( 'Recent', 'arrowpress-core' )      => 'recent',
					esc_html__( 'Featured', 'arrowpress-core' )    => 'featured',
					esc_html__( 'Most Viewed', 'arrowpress-core' ) => 'most-viewed',
				),
				"admin_label" => true,
				'group'       => 'Data'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Order by', 'arrowpress-core' ),
				'param_name'  => 'orderby',
				'value'       => $order_by_values,
				'description' => sprintf( esc_html__( 'Select how to sort retrieved category. More at %s.', 'arrowpress-core' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
				'group'       => 'Data'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Order way', 'arrowpress-core' ),
				'param_name'  => 'order',
				'value'       => $order_way_values,
				'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'arrowpress-core' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
				'group'       => 'Data'
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

	if ( ! class_exists( 'WPBakeryShortCode_ArrowPress_Blog_Cate' ) ) {
		class WPBakeryShortCode_ArrowPress_Blog_Cate extends WPBakeryShortCode {
		}
	}
}
