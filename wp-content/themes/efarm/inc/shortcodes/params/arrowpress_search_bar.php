<?php

// arrowpress_search_bar
add_shortcode( 'arrowpress_search_bar', 'arrowpress_shortcode_search_bar' );
add_action( 'vc_build_admin_page', 'arrowpress_load_search_bar_shortcode' );
add_action( 'vc_after_init', 'arrowpress_load_search_bar_shortcode' );

function arrowpress_shortcode_search_bar( $atts, $content = null ) {
	ob_start();
	if ( $template = arrowpress_shortcode_template( 'arrowpress_search_bar' ) ) {
		include $template;
	}

	return ob_get_clean();
}

function arrowpress_load_search_bar_shortcode() {
	$custom_class = arrowpress_vc_custom_class();
	vc_map( array(
		'name'     => "ArrowPress " . esc_html__( 'Search Bar', 'arrowpress-core' ),
		'base'     => 'arrowpress_search_bar',
		'category' => esc_html__( 'ArrowPress', 'arrowpress-core' ),
		'icon'     => 'arrowpress_vc_icon',
		'weight'   => - 50,
		"params"   => array(
			array(
				"type"       => "textfield",
				"heading"    => esc_html__( "Title", 'arrowpress-core' ),
				"param_name" => "title",
			),
			$custom_class
		)
	) );

	if ( ! class_exists( 'WPBakeryShortCode_Search_Bar' ) ) {
		class WPBakeryShortCode_Search_Bar extends WPBakeryShortCode {
		}
	}
}
