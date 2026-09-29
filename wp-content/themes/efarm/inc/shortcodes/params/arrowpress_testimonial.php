<?php

// arrowpress_testimonial
add_shortcode( 'arrowpress_testimonial', 'arrowpress_shortcode_testimonial' );
add_action( 'vc_build_admin_page', 'arrowpress_load_testimonial_shortcode' );
add_action( 'vc_after_init', 'arrowpress_load_testimonial_shortcode' );

function arrowpress_shortcode_testimonial( $atts, $content = null ) {
	ob_start();
	if ( $template = arrowpress_shortcode_template( 'arrowpress_testimonial' ) ) {
		include $template;
	}

	return ob_get_clean();
}

function arrowpress_load_testimonial_shortcode() {
	$animation_type = arrowpress_vc_animation_type();
	$custom_class   = arrowpress_vc_custom_class();

	vc_map( array(
		'name'     => "ArrowPress" . esc_html__( ' Testimonial', 'arrowpress-core' ),
		'base'     => 'arrowpress_testimonial',
		'category' => esc_html__( 'ArrowPress', 'arrowpress-core' ),
		'icon'     => 'arrowpress_vc_icon',
		'weight'   => - 50,
		"params"   => array(
			array(
				"type"        => "dropdown",
				"heading"     => esc_html__( "Layout", 'arrowpress-core' ),
				"param_name"  => "layout",
				'std'         => 'layout1',
				'value'       => array(
					esc_html__( 'Layout 1', 'arrowpress-core' ) => 'layout1',
					esc_html__( 'Layout 2', 'arrowpress-core' ) => 'layout2',
					esc_html__( 'Layout 3', 'arrowpress-core' ) => 'layout3',
					esc_html__( 'Layout 4', 'arrowpress-core' ) => 'layout4',
				),
				"admin_label" => true,
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Title small", 'arrowpress-core' ),
				"param_name"  => "title_small",
				"admin_label" => true,
				'dependency'  => array(
					'element' => 'layout',
					'value'   => 'layout2',
				),
			),
			array(
				"type"        => "textarea",
				"heading"     => esc_html__( "Title big", 'arowpress-core' ),
				"param_name"  => "title_big",
				"admin_label" => true,
				'dependency'  => array(
					'element' => 'layout',
					'value'   => 'layout2',
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
				"type"       => "textarea",
				"heading"    => esc_html__( "Description", "arrowpress-core" ),
				"param_name" => "description",
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Name", 'arrowpress-core' ),
				"param_name"  => "name_author",
				"admin_label" => true,
			),
			array(
				"type"        => "textfield",
				"heading"     => esc_html__( "Job", 'arrowpress-core' ),
				"param_name"  => "job_author",
				"admin_label" => true,
				'dependency'  => array(
					'element' => 'layout',
					'value'   => 'layout3',
				),
			),
			array(
				"type"        => "dropdown",
				"heading"     => esc_html__( "Testimonial Align", "arrowpress-core" ),
				"param_name"  => "testimonial_align",
				"value"       => array(
					esc_html__( 'Center', 'arrowpress-core' ) => 'center',
					esc_html__( 'Left', 'arrowpress-core' )   => 'left',
					esc_html__( 'Right', 'arrowpress-core' )  => 'right',
				),
				"description" => esc_html__( "Select testiomonial align.", "arrowpress-core" )
			),
			array(
				'type'        => 'colorpicker',
				'heading'     => esc_html__( 'Description Color', 'arrowpress-core' ),
				'param_name'  => 'desc_color',
				'admin_label' => true,
				'group'       => esc_html__( 'Skin', 'arrowpress-core' ),
			),
			array(
				'type'        => 'colorpicker',
				'heading'     => esc_html__( 'Job Color', 'arrowpress-core' ),
				'param_name'  => 'job_color',
				'admin_label' => true,
				'group'       => esc_html__( 'Skin', 'arrowpress-core' ),
				'dependency'  => array(
					'element' => 'layout',
					'value'   => 'layout3',
				),
			),
			array(
				'type'        => 'colorpicker',
				'heading'     => esc_html__( 'Name Color', 'arrowpress-core' ),
				'param_name'  => 'name_color',
				'admin_label' => true,
				'group'       => esc_html__( 'Skin', 'arrowpress-core' ),
			),
			array(
				'type'        => 'colorpicker',
				'heading'     => esc_html__( 'Title Small Color', 'arrowpress-core' ),
				'param_name'  => 'title_small_color',
				'admin_label' => true,
				'dependency'  => array(
					'element' => 'layout',
					'value'   => 'layout2',
				),
				'group'       => esc_html__( 'Skin', 'arrowpress-core' ),
			),
			array(
				'type'        => 'colorpicker',
				'heading'     => esc_html__( 'Title Big Color', 'arrowpress-core' ),
				'param_name'  => 'title_big_color',
				'admin_label' => true,
				'dependency'  => array(
					'element' => 'layout',
					'value'   => 'layout2',
				),
				'group'       => esc_html__( 'Skin', 'arrowpress-core' ),
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

	if ( ! class_exists( 'WPBakeryShortCode_ArrowPress_Testimonial' ) ) {
		class WPBakeryShortCode_ArrowPress_Testimonial extends WPBakeryShortCode {
		}
	}
}
