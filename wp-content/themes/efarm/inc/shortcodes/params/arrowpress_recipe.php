<?php

// foodfarm_recipe
add_shortcode( 'arrowpress_recipe', 'arrowpress_shortcode_recipe' );
add_action( 'vc_build_admin_page', 'arrowpress_load_recipe_shortcode' );
add_action( 'vc_after_init', 'arrowpress_load_recipe_shortcode' );

function arrowpress_shortcode_recipe( $atts, $content = null ) {
	ob_start();
	if ( $template = arrowpress_shortcode_template( 'arrowpress_recipe' ) ) {
		include $template;
	}

	return ob_get_clean();
}

function arrowpress_load_recipe_shortcode() {
	$custom_class     = arrowpress_vc_custom_class();
	$order_by_values  = arrowpress_vc_woo_order_by();
	$order_way_values = arrowpress_vc_woo_order_way();
	vc_map( array(
		'name'     => "ArrowPress " . esc_html__( 'Recipe', 'arrowpress-core' ),
		'base'     => 'arrowpress_recipe',
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
					esc_html__( 'Slide recipe', 'arrowpress-core' ) => 'slide',
				),
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Number of recipe to show", 'arrowpress-core' ),
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
				'type'       => 'checkbox',
				'heading'    => esc_html__( "Item delay", 'arrowpress-core' ),
				'param_name' => 'item_delay',
				'std'        => 'yes',
				'value'      => array( esc_html__( 'Yes', 'arrowpress-core' ) => 'yes' )
			),
			$custom_class
		)
	) );

	if ( ! class_exists( 'WPBakeryShortCode_Arrowpress_recipe' ) ) {
		class WPBakeryShortCode_Arrowpress_recipe extends WPBakeryShortCode {
		}
	}
}
