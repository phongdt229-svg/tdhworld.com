<?php

class Apr_Metabox {
	public function __construct() {
		add_filter( 'arrowpress_add_meta_boxes', array( $this, 'register_page_metabox' ) );
	}

	function register_page_metabox( $meta_boxes ) {
		$apr_layout                      = apr_layouts();
		$apr_sidebar_position            = apr_sidebar_position();
		$apr_sidebars                    = apr_sidebars();
		$apr_header_layout               = apr_header_types();
		$apr_preload_layout              = apr_preload_types();
		$apr_header_positions            = apr_header_positions();
		$apr_footer_layout               = apr_footer_types();
		$apr_popup_layout                = apr_popup_layouts();
		$apr_block_name                  = apr_get_block_name();
		$apr_block_name['default']       = 'default';
		$apr_slider                      = apr_rev_sliders_in_array();
		$apr_breadcrumbs_type            = apr_get_breadcrumbs_type();
		$apr_breadcrumbs_type['default'] = 'default';
		$apr_fonts                       = array(
			'default' => esc_html__( 'default', 'efarm' ),
			'Oswald'  => 'Oswald',
		);
		$meta_boxes[]                    = array(
			'id'         => 'layout_options',
			'title'      => __( 'Layout Options', 'efarm' ),
			'post_types' => array( 'page', 'post', 'knowledge', 'gallery', 'press', 'recipe' ),
			'fields'     => array(
				//Preload
				'preload'           => array(
					'id'      => 'preload',
					'label'   => esc_html__( 'Preload Layout', 'efarm' ),
					'type'    => 'select',
					'options' => $apr_preload_layout,
					'default' => 'default'
				),
				// header
				'header'            => array(
					'id'      => 'header',
					'label'   => esc_html__( 'Header Layout', 'efarm' ),
					'type'    => 'select',
					'options' => $apr_header_layout,
					'default' => 'default'
				),
				'header-position'   => array(
					'id'      => 'header-position',
					'label'   => esc_html__( 'Header Mobile Position', 'efarm' ),
					'type'    => 'select',
					'options' => $apr_header_positions,
					'default' => 'default'
				),
				//footer
				'footer'            => array(
					'id'      => 'footer',
					'label'   => esc_html__( 'Footer Layout', 'efarm' ),
					'type'    => 'select',
					'options' => $apr_footer_layout,
					'default' => 'default'
				),
				// Breadcrumbs
				'breadcrumbs'       => array(
					'id'    => 'breadcrumbs',
					'label' => esc_html__( 'Breadcrumbs', 'efarm' ),
					'desc'  => esc_html__( 'Hide breadcrumbs', 'efarm' ),
					'type'  => 'checkbox',
					'id_value' => true,
				),
				'breadcrumbs_style' => array(
					'id'      => 'breadcrumbs_style',
					'type'    => 'select',
					'label'   => esc_html__( 'Select Breadcrumbs Type', 'efarm' ),
					'options' => $apr_breadcrumbs_type,
					'default' => 'default'
				),
				"breadcrumbs_bg"    => array(
					"id"    => "breadcrumbs_bg",
					'label' => esc_html__( "Breadcrumbs Background", 'efarm' ),
					'desc'  => esc_html__( "Upload breadcrumbs background", "efarm" ),
					'type'             => 'image_advanced',
					'max_file_uploads' => 1,
				),
				'page_title'        => array( 
					'id'    => 'page_title',
					'label' => esc_html__( 'Page Title', 'efarm' ),
					'desc'  => esc_html__( 'Hide Page Title', 'efarm' ),
					'type'  => 'checkbox',
					'id_value' => true,
				),
				'show_header'       => array(
					'id'    => 'show_header',
					'label' => esc_html__( 'Header', 'efarm' ),
					'desc'  => esc_html__( 'Hide header', 'efarm' ),
					'type'  => 'checkbox'
				),
				//  Show Footer
				'show_footer'       => array(
					'id'    => 'show_footer',
					'label' => esc_html__( 'Footer', 'efarm' ),
					'desc'  => esc_html__( 'Hide footer', 'efarm' ),
					'type'  => 'checkbox'
				),
				//sidebar position
				'left-sidebar'      => array(
					'id'      => 'left-sidebar',
					'type'    => 'select',
					'label'   => esc_html__( 'Left Sidebar', 'efarm' ),
					'options' => $apr_sidebars,
					'default' => 'default'
				),
				'right-sidebar'     => array(
					'id'      => 'right-sidebar',
					'type'    => 'select',
					'label'   => esc_html__( 'Right Sidebar', 'efarm' ),
					'options' => $apr_sidebars,
					'default' => 'default'
				),
				// layout
				'layout'            => array(
					'id'      => 'layout',
					'label'   => esc_html__( 'Layout', 'efarm' ),
					'type'    => 'select',
					'options' => $apr_layout,
					'default' => 'default'
				),
				'hide_f_info'       => array(
					'id'    => 'hide_f_info',
					'label' => esc_html__( 'Hide footer info', 'efarm' ),
					'desc'  => esc_html__( 'Hide footer info', 'efarm' ),
					'type'  => 'checkbox'
				),
				'remove_space_br'   => array(
					'id'    => 'remove_space_br',
					'label' => esc_html__( 'Remove top space', 'efarm' ),
					'desc'  => esc_html__( 'Remove top space', 'efarm' ),
					'type'  => 'checkbox'
				),
				'remove_space'      => array(
					'id'    => 'remove_space',
					'label' => esc_html__( 'Remove bottom space', 'efarm' ),
					'desc'  => esc_html__( 'Remove bottom space', 'efarm' ),
					'type'  => 'checkbox'
				),
				'show_slider'       => array(
					'id'    => 'show_slider',
					'label' => esc_html__( 'Show Revolution Slider', 'efarm' ),
					'desc'  => esc_html__( 'Enable Slider', 'efarm' ),
					'type'  => 'checkbox'
				),
				'category_slider'   => array(
					'id'      => 'category_slider',
					'label'   => esc_html__( 'Select Revolution Slider', 'efarm' ),
					'desc'    => esc_html__( 'Slider will show if you show revolution slider', 'efarm' ),
					'type'    => 'select',
					'options' => $apr_slider,
					'default' => 'default'
				),
				'block_bottom'      => array(
					'id'      => 'block_bottom',
					'label'   => esc_html__( 'Select Bottom Banner', 'efarm' ),
					'desc'    => esc_html__( 'Choose a block to display at the bottom of pages. You can create a block in Static Block/Add New.', 'efarm' ),
					'type'    => 'select',
					'options' => $apr_block_name,
					'default' => 'default'
				),
			)
		);
		$meta_boxes[]                    = array(
			'id'         => 'main_color',
			'title'      => __( 'Main Color', 'efarm' ),
			'post_types' => array( 'page' ),
			'fields'     => array(
				'main_color'          => array(
					"id"    => "main_color",
					'label' => esc_html__( "Main Color", 'efarm' ),
					"type"  => "color",
					'desc'  => esc_html__( "Select different main color for page", "efarm" ),
				),
				'header_fixed'        => array(
					'id'    => 'header_fixed',
					'label' => esc_html__( 'Header Fixed', 'efarm' ),
					'type'  => 'checkbox'
				),
				'footer_fixed'        => array(
					'id'    => 'footer_fixed',
					'label' => esc_html__( 'Footer Fixed', 'efarm' ),
					'type'  => 'checkbox'
				),
				"logo_header_page"    => array(
					"id"    => "logo_header_page",
					'label' => esc_html__( "Logo header for page", 'efarm' ),
					'desc'  => esc_html__( "Upload logo header only page", 'efarm' ),
					'type'             => 'image_advanced',
					'max_file_uploads' => 1,
				),
				'header_layout_style' => array(
					'id'      => 'header_layout_style',
					'label'   => esc_html__( 'Select header layout for this page', 'efarm' ),
					'type'    => 'select',
					'options' => array(
						"default" => esc_html__( "Default", "efarm" ),
						"1"       => esc_html__( "Wide", "efarm" ),
						"2"       => esc_html__( "FullWidth", "efarm" ),
						"3"       => esc_html__( "Boxed", "efarm" ),
					),
					'default' => 'default',
				),
				'cus_font'            => array(
					'id'      => 'cus_font',
					'label'   => esc_html__( 'Select font family for header menu', 'efarm' ),
					'type'    => 'select',
					'options' => $apr_fonts,
					'default' => 'default',
					'group'   => 'font',
				),
				'body_bg'             => array(
					'id'    => 'body_bg',
					'label' => esc_html__( 'Body Background', 'efarm' ),
					'desc'  => esc_html__( "You should input hex color(ex: #e1e1e1).", 'efarm' ),
					'type'  => 'color',
				),
				'footer_bg'           => array(
					'id'    => 'footer_bg',
					'label' => esc_html__( 'Footer Background', 'efarm' ),
					'desc'  => esc_html__( "You should input hex color(ex: #e1e1e1).", 'efarm' ),
					'type'  => 'color',
				),
				'footer_text_color'   => array(
					'id'    => 'footer_text_color',
					'label' => esc_html__( 'Footer Color', 'efarm' ),
					'desc'  => esc_html__( "You should input hex color(ex: #e1e1e1).", 'efarm' ),
					'type'  => 'color',
				),
				"logo_footer_page"    => array(
					"id"    => "logo_footer_page",
					'label' => esc_html__( "Logo footer for page", 'efarm' ),
					'desc'  => esc_html__( "Upload logo footer only page", 'efarm' ),

					'type'             => 'image_advanced',
					'max_file_uploads' => 1,
				),
				'newletter_bg_img'    => array(
					'id'               => 'newletter_bg_img',
					'label'            => esc_html__( 'Newsletter Background Image', 'efarm' ),
					'desc'             => esc_html__( "Upload image newsletter only page", 'efarm' ),
					'type'             => 'image_advanced',
					'max_file_uploads' => 1,
				),
				'newletter_bg'        => array(
					'id'    => 'newletter_bg',
					'label' => esc_html__( 'Newsletter Background Color', 'efarm' ),
					'desc'  => esc_html__( "You should input hex color(ex: #d09f65).", 'efarm' ),
					'type'  => 'color',
				),
				'newletter_color'     => array(
					'id'    => 'newletter_color',
					'label' => esc_html__( 'Newsletter Color', 'efarm' ),
					'desc'  => esc_html__( "You should input hex color(ex: #fff).", 'efarm' ),
					'type'  => 'color',
				),
				'copyright_bg'        => array(
					'id'    => 'copyright_bg',
					'label' => esc_html__( 'Copyright Background Color', 'efarm' ),
					'desc'  => esc_html__( "You should input hex color(ex: #d09f65).", 'efarm' ),
					'type'  => 'color',
				),
				'copyright_color'     => array(
					'id'    => 'copyright_color',
					'label' => esc_html__( 'Copyright Color', 'efarm' ),
					'desc'  => esc_html__( "You should input hex color(ex: #d09f65).", 'efarm' ),
					'type'  => 'color',
				),
			)
		);
		$meta_boxes[]                    = array(
			'id'         => 'knowledge_options',
			'title'      => __( 'Knowledge Options', 'efarm' ),
			'post_types' => array( 'knowledge' ),
			'fields'     => array(
				"desc" => array(
					"id"    => "desc",
					'label' => esc_html__( "Short Description", 'efarm' ),
					"desc"  => esc_html__( "Content", 'efarm' ),
					"type"  => "wysiwyg"
				),
			)
		);
		$meta_boxes[]                    = array(
			'id'         => 'knowledge_options',
			'title'      => __( 'Knowledge Options', 'efarm' ),
			'post_types' => array( 'knowledge' ),
			'fields'     => array(
				"desc" => array(
					"id"    => "desc",
					'label' => esc_html__( "Short Description", 'efarm' ),
					"desc"  => esc_html__( "Content", 'efarm' ),
					"type"  => "wysiwyg"
				),
			)
		);
		$meta_boxes[]                    = array(
			'id'         => 'gallery_options',
			'title'      => __( 'Gallery options', 'efarm' ),
			'post_types' => array( 'gallery' ),
			'fields'     => array(
				array(
					'id'      => 'single_gallery_style',
					'type'    => 'select',
					'label'   => esc_html__( 'Single gallery layout', 'efarm' ),
					'options' => array(
						"default" => esc_html__( "Default", "efarm" ),
						"1"       => esc_html__( "Wide", "efarm" ),
						"2"       => esc_html__( "Slider", "efarm" ),
						"3"       => esc_html__( "Side Information", "efarm" ),
					),
					'default' => 'default'
				),
				array(
					'id'               => 'images_gallery',
					'label'            => esc_html__( 'Images Gallery', 'efarm' ),
					'desc'             => esc_html__( ' Select or Upload Image ', 'efarm' ),
					'default'          => '',
					'type'             => 'image_advanced',
					'max_file_uploads' => 999,
				),
			)
		);
		$meta_boxes[]                    = array(
			'id'         => 'press_options',
			'title'      => __( 'Press Media Options', 'efarm' ),
			'post_types' => array( 'press' ),
			'fields'     => array(
				"link_press" => array(
					"id"    => "link_press",
					'label' => esc_html__( "Input Link or Video", 'efarm' ),
					"desc"  => esc_html__( "Input Link PDF or Video", 'efarm' ),
					"type"  => "text"
				),
				"desc"       => array(
					"id"    => "desc",
					'label' => esc_html__( "Short Description", 'efarm' ),
					"desc"  => esc_html__( "Content", 'efarm' ),
					"type"  => "wysiwyg"
				),
			)
		);

		return $meta_boxes;
	}

}

if ( class_exists( 'Apr_Metabox' ) ) {
	new Apr_Metabox;
}

require_once APR_ADMIN . '/metabox/class_post_metabox.php';
require_once APR_ADMIN . '/metabox/class_recipe_metabox.php';

