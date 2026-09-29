<?php

add_shortcode( 'arrowpress_banner', 'arrowpress_shortcode_banner' );
add_action( 'vc_build_admin_page', 'arrowpress_load_banner_shortcode' );
add_action( 'vc_after_init', 'arrowpress_load_banner_shortcode' );

function arrowpress_shortcode_banner( $atts, $content = null ) {
	ob_start();
	if ( $template = arrowpress_shortcode_template( 'arrowpress_banner' ) ) {
		include $template;
	}

	return ob_get_clean();
}

function arrowpress_load_banner_shortcode() {
	$custom_class   = arrowpress_vc_custom_class();
	$animation_type = arrowpress_animation_custom();

	vc_map( array(
		'name'     => "ArrowPress " . esc_html__( 'Banner', 'arrowpress-core' ),
		'base'     => 'arrowpress_banner',
		'category' => esc_html__( 'ArrowPress', 'arrowpress-core' ),
		'icon'     => 'arrowpress_vc_icon',
		'weight'   => - 50,
		"params"   => array(
			array(
				"type"       => "dropdown",
				"heading"    => esc_html__( "Layout", 'arrowpress-core' ),
				"param_name" => "layout",
				'std'        => 'banner_style_1',
				'value'      => array(
					esc_html__( 'Banner type 1', 'arrowpress-core' ) => 'banner_style_1',
					esc_html__( 'Banner type 2', 'arrowpress-core' ) => 'banner_style_2',
					esc_html__( 'Banner type 3', 'arrowpress-core' ) => 'banner_style_3',
					esc_html__( 'Banner type 4', 'arrowpress-core' ) => 'banner_style_4',
					esc_html__( 'Banner type 5', 'arrowpress-core' ) => 'banner_style_5',
					esc_html__( 'Banner type 6', 'arrowpress-core' ) => 'banner_style_6',
				),
			),
			array(
				'type'        => 'attach_image',
				'heading'     => esc_html__( 'Image', 'arrowpress-core' ),
				'param_name'  => 'image',
				'value'       => '',
				'description' => esc_html__( 'Upload image.', 'arrowpress-core' ),
			),
			array(
				"type"        => "textarea",
				"heading"     => esc_html__( "Big Title", 'arrowpress-core' ),
				"param_name"  => "big_title",
				"admin_label" => true
			),
			array(
				"type"       => "textfield",
				"heading"    => esc_html__( "Small Title", 'arrowpress-core' ),
				"param_name" => "small_title",
				"dependency" => array(
					'element' => 'layout',
					'value'   => array( 'banner_style_1', 'banner_style_2', 'banner_style_4', 'banner_style_5', 'banner_style_6' )
				)
			),
			/*array(
				"type" => "textarea",
				"heading" => esc_html__("Description", 'arrowpress-core'),
				"param_name" => "desc",
				"dependency" => array(
					'element' => 'layout',
					'value' => array('banner_style_4')
				)
			), */
			array(
				"type"        => "dropdown",
				"heading"     => esc_html__( "Text Align", "arrowpress-core" ),
				"param_name"  => "text_align",
				'std'         => 'center',
				"value"       => array(
					esc_html__( 'Center', 'arrowpress-core' ) => 'center',
					esc_html__( 'Left', 'arrowpress-core' )   => 'left',
					esc_html__( 'Right', 'arrowpress-core' )  => 'right',
				),
				"description" => esc_html__( "Select heading align.", "arrowpress-core" )
			),
			array(
				"type"        => "number",
				"class"       => "",
				"heading"     => esc_html__( "Height banner", "arrowpress-core" ),
				"param_name"  => "height_banner",
				"value"       => "",
				'admin_label' => true,
				'description' => esc_html__( 'px', 'arrowpress-core' ),
				'group'       => 'Typography',
				"dependency"  => array(
					'element' => 'layout',
					'value'   => array( 'banner_style_1', 'banner_style_2', 'banner_style_3', 'banner_style_5' )
				)
			),
			array(
				"type"       => "textfield",
				"heading"    => esc_html__( "Button Text", "arrowpress-core" ),
				"param_name" => "btn_text",
				'value'      => esc_html__( 'Shop now', 'arrowpress-core' ),
				"dependency" => array(
					'element' => 'layout',
					'value'   => array( 'banner_style_1', 'banner_style_2', 'banner_style_3', 'banner_style_5', 'banner_style_6' )
				)
			),
			array(
				"type"        => "dropdown",
				"heading"     => esc_html__( "Button Type", 'arrowpress-core' ),
				"param_name"  => "btn_layout",
				'std'         => 'btn_layout_2',
				'value'       => array(
					esc_html__( 'Button Default', 'arrowpress-core' )   => 'btn_layout_1',
					esc_html__( 'Button No Border', 'arrowpress-core' ) => 'btn_layout_5',
					esc_html__( 'Button Primary', 'arrowpress-core' )   => 'btn_layout_2',
					esc_html__( 'Button Black', 'arrowpress-core' )     => 'btn_layout_3',
					esc_html__( 'Button White', 'arrowpress-core' )     => 'btn_layout_4',

				),
				"description" => esc_html__( "Select button type.", "arrowpress-core" ),
				"dependency"  => array(
					'element' => 'layout',
					'value'   => array( 'banner_style_1', 'banner_style_2', 'banner_style_3', 'banner_style_5', 'banner_style_6' )
				)
			),
			array(
				"type"       => "vc_link",
				"heading"    => esc_html__( "Link", 'arrowpress-core' ),
				"param_name" => "link",
			),
			//Skin
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( "Enable Default Overlay", "arrowpress-core" ),
				'param_name' => 'en_overlay',
				'std'        => '',
				'value'      => array( esc_html__( 'Yes', 'arrowpress-core' ) => 'yes' ),
				'dependency' => array(
					'element' => 'layout',
					'value'   => array( 'banner_style_1', 'banner_style_3', 'banner_style_4', 'banner_style_5' ),
				),
				'group'      => esc_html__( 'Skin', 'arrowpress-core' ),
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Background Overlay Color', 'arrowpress-core' ),
				'param_name' => 'bg_overlay_color',
				'dependency' => array(
					'element' => 'en_overlay',
					'value'   => array( 'yes' ),
				),
				'group'      => esc_html__( 'Skin', 'arrowpress-core' ),
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Background Color', 'arrowpress-core' ),
				'param_name' => 'bg_content_color',
				'dependency' => array(
					'element' => 'layout',
					'value'   => array( 'banner_style_2', 'banner_style_4' ),
				),
				'group'      => esc_html__( 'Skin', 'arrowpress-core' ),
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Background Color on Hover', 'arrowpress-core' ),
				'param_name' => 'bg_hover_color',
				'group'      => esc_html__( 'Skin', 'arrowpress-core' ),
				'dependency' => array(
					'element' => 'layout',
					'value'   => array( 'banner_style_2' ),
				),
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Title Color', 'arrowpress-core' ),
				'param_name' => 'title_color',
				'group'      => esc_html__( 'Skin', 'arrowpress-core' ),
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Small title and description Color', 'arrowpress-core' ),
				'param_name' => 'sm_title_color',
				'group'      => esc_html__( 'Skin', 'arrowpress-core' ),
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Button color', 'arrowpress-core' ),
				'param_name' => 'btn_color',
				'group'      => esc_html__( 'Skin', 'arrowpress-core' ),
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Button color hover', 'arrowpress-core' ),
				'param_name' => 'btn_color_hover',
				'group'      => esc_html__( 'Skin', 'arrowpress-core' ),
			),
			$custom_class,
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( "Enable Animation", "arrowpress-core" ),
				'param_name' => 'item_delay',
				'std'        => '',
				'value'      => array( esc_html__( 'Yes', 'arrowpress-core' ) => 'yes' ),
				'group'      => 'Animation'
			),
			array(
				"type"        => "dropdown",
				"heading"     => esc_html__( "Animation Type", "arrowpress-core" ),
				"param_name"  => "animation_type",
				"value"       => $animation_type,
				"description" => esc_html__( "Select Animation Style.", "arrowpress-core" ),
				'dependency'  => array(
					'element' => 'item_delay',
					'value'   => 'yes',
				),
				'group'       => 'Animation'
			),
			array(
				"type"        => "textfield",
				"class"       => "",
				"heading"     => esc_html__( "Animation Delay", "arrowpress-core" ),
				"description" => esc_html__( "Enter Animation Delay.", "arrowpress-core" ),
				'dependency'  => array(
					'element' => 'item_delay',
					'value'   => 'yes',
				),
				"param_name"  => "animation_delay",
				"value"       => 500,
				'group'       => 'Animation'
			),
			array(
				'type'       => 'css_editor',
				'heading'    => esc_html__( 'CSS box', 'arrowpress-core' ),
				'param_name' => 'css',
				'group'      => esc_html__( 'Design Options', 'arrowpress-core' ),
			),
		)
	) );
	if ( ! class_exists( 'WPBakeryShortCode_ArrowPress_Banner' ) ) {
		class WPBakeryShortCode_ArrowPress_Banner extends WPBakeryShortCode {
		}
	}
}
