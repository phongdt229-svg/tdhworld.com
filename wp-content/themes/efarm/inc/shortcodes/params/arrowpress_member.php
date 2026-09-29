<?php

add_shortcode( 'arrowpress_member', 'arrowpress_shortcode_member' );
add_action( 'vc_build_admin_page', 'arrowpress_load_member_shortcode' );
add_action( 'vc_after_init', 'arrowpress_load_member_shortcode' );

function arrowpress_shortcode_member( $atts, $content = null ) {
	ob_start();
	if ( $template = arrowpress_shortcode_template( 'arrowpress_member' ) ) {
		include $template;
	}

	return ob_get_clean();
}

function arrowpress_load_member_shortcode() {
	$custom_class   = arrowpress_vc_custom_class();
	$animation_type = arrowpress_animation_custom();

	vc_map( array(
		'name'     => "ArrowPress" . esc_html__( ' Member', 'arrowpress-core' ),
		'base'     => 'arrowpress_member',
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
					esc_html__( 'Layout 1', 'arrowpress-core' ) => 'layout1',
					esc_html__( 'Layout 2', 'arrowpress-core' ) => 'layout2',
					// esc_html__('Layout 3', 'arrowpress-core') => 'layout3',
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
				"type"        => "textfield",
				"heading"     => esc_html__( "Full Name", 'arrowpress-core' ),
				"param_name"  => "first_name",
				"admin_label" => true,
			),
			array(
				"type"       => "textarea",
				"heading"    => esc_html__( "Job", 'arrowpress-core' ),
				"param_name" => "job",
			),
			array(
				"type"       => "textarea",
				"heading"    => esc_html__( "Description", 'arrowpress-core' ),
				"param_name" => "desc",
				"dependency" => array(
					'element' => 'layout',
					'value'   => array( 'layout2' ),
				),
			),
			array(
				"type"       => "vc_link",
				"heading"    => esc_html__( "Link Facebook", 'arrowpress-core' ),
				"param_name" => "link_facebook",
			),
			array(
				"type"       => "vc_link",
				"heading"    => esc_html__( "Link Twitter", 'arrowpress-core' ),
				"param_name" => "link_twitter",
			),
			array(
				"type"       => "vc_link",
				"heading"    => esc_html__( "Link Google Plus", 'arrowpress-core' ),
				"param_name" => "link_google",
			),
			array(
				"type"       => "vc_link",
				"heading"    => esc_html__( "Link Linkedin", 'arrowpress-core' ),
				"param_name" => "link_linked",
			),
			// array(
			//     "type" => "vc_link",
			//     "heading" => esc_html__("Link", 'arrowpress-core'),
			//     "param_name" => "link",
			// ),
			array(
				"type"       => "dropdown",
				"heading"    => esc_html__( "Member info background type", 'arrowpress-core' ),
				"param_name" => "bg_type",
				'std'        => 'image',
				'value'      => array(
					esc_html__( 'Background image', 'arrowpress-core' ) => 'image',
					esc_html__( 'Color', 'arrowpress-core' )            => 'color',
					esc_html__( 'None', 'arrowpress-core' )             => 'none',
				),
				'dependency' => array(
					'element' => 'layout',
					'value'   => array( 'layout1', 'layout3' ),
				),
				'group'      => esc_html__( 'Skin', 'arrowpress-core' ),
			),

			array(
				'type'        => 'attach_image',
				'heading'     => esc_html__( 'Background Image for member info', 'arrowpress-core' ),
				'param_name'  => 'bg_image',
				'value'       => '',
				'description' => esc_html__( 'Upload image.', 'arrowpress-core' ),
				'dependency'  => array(
					'element' => 'bg_type',
					'value'   => array( 'image' ),
				),
				'group'       => esc_html__( 'Skin', 'arrowpress-core' ),
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Background color for member info', 'arrowpress-core' ),
				'param_name' => 'bg_main_color',
				'value'      => '',
				'dependency' => array(
					'element' => 'bg_type',
					'value'   => array( 'color' ),
				),
				'group'      => esc_html__( 'Skin', 'arrowpress-core' ),
			),
			array(
				"type"       => "colorpicker",
				"heading"    => esc_html__( "Member info background hover", 'arrowpress-core' ),
				"param_name" => "bg_hover",
				'dependency' => array(
					'element' => 'bg_type',
					'value'   => array( 'color' ),
				),
				'group'      => esc_html__( 'Skin', 'arrowpress-core' ),
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Name Color', 'arrowpress-core' ),
				'param_name' => 'name_color',
				'group'      => esc_html__( 'Skin', 'arrowpress-core' ),
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Name Hover Color', 'arrowpress-core' ),
				'param_name' => 'name_hover_color',
				'group'      => esc_html__( 'Skin', 'arrowpress-core' ),
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Job color', 'arrowpress-core' ),
				'param_name' => 'job_color',
				'group'      => esc_html__( 'Skin', 'arrowpress-core' ),
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Icon color', 'arrowpress-core' ),
				'param_name' => 'icon_color',
				'group'      => esc_html__( 'Skin', 'arrowpress-core' ),
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

	if ( ! class_exists( 'WPBakeryShortCode_arrowpress_Member' ) ) {
		class WPBakeryShortCode_arrowpress_Member extends WPBakeryShortCode {
		}
	}
}
