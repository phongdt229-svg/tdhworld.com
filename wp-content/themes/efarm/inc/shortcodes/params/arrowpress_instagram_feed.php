<?php

// arrowpress instagram feed
add_shortcode( 'arrowpress_instagram_feed', 'arrowpress_shortcode_instagram_feed' );
add_action( 'vc_build_admin_page', 'arrowpress_load_instagram_feed_shortcode' );
add_action( 'vc_after_init', 'arrowpress_load_instagram_feed_shortcode' );

function arrowpress_shortcode_instagram_feed( $atts, $content = null ) {
	ob_start();
	if ( $template = arrowpress_shortcode_template( 'arrowpress_instagram_feed' ) ) {
		include $template;
	}

	return ob_get_clean();
}

function arrowpress_load_instagram_feed_shortcode() {
	$custom_class = arrowpress_vc_custom_class();
	vc_map( array(
		'name'     => "Arrowpress " . esc_html__( 'Instagram Feed', 'arrowpress-core' ),
		'base'     => 'arrowpress_instagram_feed',
		'category' => esc_html__( 'ArrowPress', 'arrowpress-core' ),
		'icon'     => 'arrowpress_vc_icon',
		'weight'   => - 50,
		"params"   => array(
			array(
				"type"       => "dropdown",
				"heading"    => esc_html__( "Layout", 'arrowpress-core' ),
				"param_name" => "layout",
				'std'        => 'layout1',
				'value'      => array(
					esc_html__( 'Instagram Slider', 'arrowpress-core' )    => 'layout2',
					esc_html__( 'Instagram Packery', 'arrowpress-core' )   => 'layout1',
					esc_html__( 'Instagram Packery 2', 'arrowpress-core' ) => 'layout3',
					esc_html__( 'Instagram Packery 3', 'arrowpress-core' ) => 'layout4',

				),
			),
			array(
				"type"       => "checkbox",
				"heading"    => esc_html__( "Show Space", 'arrowpress-core' ),
				"param_name" => "show_spacer",
				'std'        => 'yes',
				'value'      => array(
					esc_html__( 'Yes', 'arrowpress-core' ) => 'yes',
				),
			),
			array(
				"type"        => "number",
				"heading"     => esc_html__( "Per page", 'arrowpress-core' ),
				"param_name"  => "per_page",
				'default'     => '9',
				'description' => esc_html__( 'This field  determines how many blogs to show on the page', 'arrowpress-core' )
			),
			array(
				"type"       => "dropdown",
				"heading"    => esc_html__( "Number Column on Desktop Large (> 1365px)", "arrowpress-core" ),
				"param_name" => "items_desktop_large1",
				'std'        => 4,
				'value'      => array(
					esc_html__( '6', 'arrowpress-core' ) => 6,
					esc_html__( '5', 'arrowpress-core' ) => 5,
					esc_html__( '4', 'arrowpress-core' ) => 4,
					esc_html__( '3', 'arrowpress-core' ) => 3,
					esc_html__( '2', 'arrowpress-core' ) => 2,
					esc_html__( '1', 'arrowpress-core' ) => 1,
				),
				'dependency' => array(
					'element' => 'layout',
					'value'   => array( 'layout2' ),
				),
			),
			array(
				"type"       => "dropdown",
				"heading"    => esc_html__( "Number Column on Desktop Large (> 1200px)", "arrowpress-core" ),
				"param_name" => "items_desktop_large",
				'std'        => 4,
				'value'      => array(
					esc_html__( '6', 'arrowpress-core' ) => 6,
					esc_html__( '5', 'arrowpress-core' ) => 5,
					esc_html__( '4', 'arrowpress-core' ) => 4,
					esc_html__( '3', 'arrowpress-core' ) => 3,
					esc_html__( '2', 'arrowpress-core' ) => 2,
					esc_html__( '1', 'arrowpress-core' ) => 1,
				),
				'dependency' => array(
					'element' => 'layout',
					'value'   => array( 'layout2' ),
				),
			),
			array(
				"type"       => "dropdown",
				"heading"    => esc_html__( "Number Column on Desktop", "arrowpress-core" ),
				"param_name" => "items_desktop",
				'std'        => 2,
				'value'      => array(
					esc_html__( '4', 'arrowpress-core' ) => 4,
					esc_html__( '3', 'arrowpress-core' ) => 3,
					esc_html__( '2', 'arrowpress-core' ) => 2,
					esc_html__( '1', 'arrowpress-core' ) => 1,
				),
				'dependency' => array(
					'element' => 'layout',
					'value'   => array( 'layout2' ),
				),
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
				'dependency' => array(
					'element' => 'layout',
					'value'   => array( 'layout2' ),
				),
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
				'dependency' => array(
					'element' => 'layout',
					'value'   => array( 'layout2' ),
				),
			),
			array(
				"type"       => "checkbox",
				"heading"    => esc_html__( "Auto Play", 'arrowpress-core' ),
				"param_name" => "auto_play",
				'std'        => 'yes',
				'value'      => array( esc_html__( 'Yes', 'arrowpress-core' ) => 'yes' ),
				'dependency' => array(
					'element' => 'layout',
					'value'   => array( 'layout2' ),
				),
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Link Instagram", "arrowpress-core" ),
				"description" => esc_html__( "Input link instagram", "arrowpress-core" ),
				"param_name"  => "link_home",
				"admin_label" => true,
				'placeholder' => esc_html__( 'http://...', 'arrowpress-core' ),
				'dependency'  => array(
					'element' => 'layout',
					'value'   => array( 'layout1' ),
				),
			),
			$custom_class
		)
	) );

	if ( ! class_exists( 'WPBakeryShortCode_Arrowpress_Instagram_Feed' ) ) {
		class WPBakeryShortCode_Arrowpress_Instagram_Feed extends WPBakeryShortCode {
		}
	}
}
