<?php

// arrowpress_services
add_shortcode( 'arrowpress_services', 'arrowpress_shortcode_services' );
add_action( 'vc_build_admin_page', 'arrowpress_load_services_shortcode' );
add_action( 'vc_after_init', 'arrowpress_load_services_shortcode' );

function arrowpress_shortcode_services( $atts, $content = null ) {
	ob_start();
	if ( $template = arrowpress_shortcode_template( 'arrowpress_services' ) ) {
		include $template;
	}

	return ob_get_clean();
}

function arrowpress_load_services_shortcode() {
	$custom_class = arrowpress_vc_custom_class();
	vc_map( array(
		'name'     => "ArrowPress " . esc_html__( 'Services', 'arrowpress-core' ),
		'base'     => 'arrowpress_services',
		'category' => esc_html__( 'ArrowPress', 'arrowpress-core' ),
		'icon'     => 'arrowpress_vc_icon',
		'weight'   => - 50,
		"params"   => array(
			// array(
			//     "type" => "dropdown",
			//     "heading" => esc_html__("Layout Style", 'arrowpress-core'),
			//     "param_name" => "layout_style",
			//     'std' => '',
			//     'value' => array(
			//         esc_html__('Style 1', 'arrowpress-core') => 'style_1',
			//         esc_html__('Style 2', 'arrowpress-core') => 'style_2',
			//         esc_html__('Style 3', 'arrowpress-core') => 'style_3',
			//     ),
			// ),
			array(
				"type"       => "textfield",
				"heading"    => esc_html__( "Title", 'arrowpress-core' ),
				"param_name" => "title",
			),
			array(
				"type"       => "textarea",
				"heading"    => esc_html__( "Description", 'arrowpress-core' ),
				"param_name" => "description",
			),
			array(
				'type'        => 'attach_image',
				'heading'     => esc_html__( 'Image', 'arrowpress-core' ),
				'param_name'  => 'image',
				'value'       => '',
				'description' => esc_html__( 'Upload image.', 'arrowpress-core' ),
			),
			array(
				"type"        => "dropdown",
				"heading"     => esc_html__( "Text Align", 'arrowpress-core' ),
				"param_name"  => "text_align",
				'std'         => 'center',
				"value"       => array(
					esc_html__( 'Center', 'arrowpress-core' ) => 'center',
					esc_html__( 'Left', 'arrowpress-core' )   => 'left',
					esc_html__( 'Right', 'arrowpress-core' )  => 'right',
				),
				"description" => esc_html__( "Select heading align.", 'arrowpress-core' )
			),
			array(
				"type"       => "vc_link",
				"heading"    => esc_html__( "Link", 'arrowpress-core' ),
				"param_name" => "link",
			),
			array(
				'type'        => 'colorpicker',
				'heading'     => esc_html__( 'Title Color', 'arrowpress-core' ),
				'param_name'  => 'title_color',
				'description' => esc_html__( 'Select title color.', 'arrowpress-core' ),
				'group'       => 'Color',
			),
			array(
				'type'        => 'colorpicker',
				'heading'     => esc_html__( 'Description Color', 'arrowpress-core' ),
				'param_name'  => 'desc_color',
				'description' => esc_html__( 'Select description color.', 'arrowpress-core' ),
				'group'       => 'Color',
			),
			array(
				'type'        => 'colorpicker',
				'heading'     => esc_html__( 'Background Color', 'arrowpress-core' ),
				'param_name'  => 'bg_color_content',
				'description' => esc_html__( 'Select background color content.', 'arrowpress-core' ),
				'group'       => 'Color',
			),
			$custom_class
		)
	) );

	if ( ! class_exists( 'WPBakeryShortCode_Bonfire_Services' ) ) {
		class WPBakeryShortCode_Bonfire_Services extends WPBakeryShortCode {
		}
	}
}
