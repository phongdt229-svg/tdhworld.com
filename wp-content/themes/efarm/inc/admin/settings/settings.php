<?php

/**
 * Apr Settings Options
 */
if ( ! class_exists( 'Framework_Apr_Settings' ) ) {
	class Framework_Apr_Settings {

		public $ReduxFramework;

		public function __construct() {

			if ( ! class_exists( 'ReduxFramework' ) ) {

				return;
			}
			add_action( 'after_setup_theme', array( $this, 'initSettings' ), 10 );
		}

		public function initSettings() {
			$this->ReduxFramework = new ReduxFramework( $this->apr_get_setting_sections(), $this->apr_get_setting_arguments() );
		}

		public function apr_get_setting_sections() {
			$page_layout       = apr_layouts();
			$sidebar_positions = apr_sidebar_position();
			unset( $page_layout['default'] );
			unset( $sidebar_positions['default'] );
			$apr_seclect_banner = apr_seclect_slider();
			unset( $apr_seclect_banner['default'] );
			$menus     = get_terms( 'nav_menu' );
			$menu_list = apr_list_menu();
			$sections  = array(
				array(
					'icon'       => 'el-icon-edit',
					'icon_class' => 'icon',
					'title'      => esc_html__( 'General', 'efarm' ),
					'fields'     => array(),
				),
				array(
					'icon_class' => 'icon',
					'subsection' => true,
					'title'      => esc_html__( 'Layout', 'efarm' ),
					'fields'     => array(
						array(
							'id'      => 'layout',
							'type'    => 'button_set',
							'title'   => esc_html__( 'Layout', 'efarm' ),
							'options' => $page_layout,
							'default' => 'fullwidth',
						),
						array(
							'id'      => 'left-sidebar',
							'type'    => 'select',
							'title'   => esc_html__( 'Select Left Sidebar', 'efarm' ),
							'data'    => 'sidebars',
							'default' => '',
						),
						array(
							'id'      => 'right-sidebar',
							'type'    => 'select',
							'title'   => esc_html__( 'Select Right Sidebar', 'efarm' ),
							'data'    => 'sidebars',
							'default' => '',
						),
					),
				),
				array(
					'icon_class' => 'icon',
					'subsection' => true,
					'title'      => esc_html__( 'Logo, Favicon, Js Custom', 'efarm' ),
					'fields'     => array(
						array(
							'id'       => 'logo',
							'type'     => 'media',
							'url'      => true,
							'readonly' => false,
							'title'    => esc_html__( 'Logo', 'efarm' ),
							'required' => array(
								array(
									'header-type',
									'equals',
									array(
										'1',
										'4',
									),
								),
							),
							'default'  => array(
								'url'    => get_template_directory_uri() . '/images/logo.png',
								'height' => 44,
								'wide'   => 132,
							),
						),
						array(
							'id'       => 'favicon',
							'type'     => 'media',
							'url'      => true,
							'readonly' => false,
							'title'    => esc_html__( 'Favicon', 'efarm' ),
							'default'  => array(
								'url' => get_template_directory_uri() . '/images/favicon.ico',
							),
						),
						array(
							'id'       => 'js-code',
							'type'     => 'ace_editor',
							'title'    => esc_html__( 'JS Code', 'efarm' ),
							'subtitle' => esc_html__( 'Paste your JS code here.', 'efarm' ),
							'mode'     => 'javascript',
							'theme'    => 'chrome',
							'default'  => 'jQuery(document).ready(function(){});',
						),
					),
				),
				array(
					'icon_class' => 'icon',
					'subsection' => true,
					'title'      => esc_html__( 'View, Language Switcher', 'efarm' ),
					'fields'     => array(
						array(
							'id'       => 'wpml-switcher',
							'type'     => 'switch',
							'title'    => esc_html__( 'Show Language Switcher', 'efarm' ),
							'subtitle' => esc_html__( 'This option only works with WPML or Polylang plugins.', 'efarm' ),
							'desc'     => esc_html__( 'Show language switcher instead of view switcher menu.', 'efarm' ),
							'default'  => false,
							'on'       => esc_html__( 'Yes', 'efarm' ),
							'off'      => esc_html__( 'No', 'efarm' ),
						),
						array(
							'id'       => 'language_shortcode',
							'type'     => 'text',
							'title'    => esc_html__( 'Shortcode Language Switcher ', 'efarm' ),
							'subtitle' => esc_html__( 'This option only works with translation plugins other than WPML or Polylang plugins.', 'efarm' ),
							'desc'     => esc_html__( 'Ex: language-switcher', 'efarm' ),
							'required' => array(
								array(
									'wpml-switcher',
									'equals',
									array(
										true,
									),
								),
							),
						),
					),
				),

				array(
					'icon_class' => 'icon',
					'subsection' => true,
					'title'      => esc_html__( 'Preloader', 'efarm' ),
					'fields'     => array(
						array(
							'id'          => 'preload',
							'type'        => 'button_set',
							'title'       => esc_html__( 'Preload ', 'efarm' ),
							'description' => esc_html__( 'Enable Preload site', 'efarm' ),
							'options'     => array(
								'enable'  => esc_html__( 'Enable', 'efarm' ),
								'disable' => esc_html__( 'Disable', 'efarm' ),
							),
							'default'     => 'enable',
						),
						array(
							'id'       => 'preload-type',
							'type'     => 'image_select',
							'title'    => esc_html__( 'Preload Type', 'efarm' ),
							'subtitle' => esc_html__( 'Each page will have option for select preload type. Preload selection in each page will have higher priority than this general selection.', 'efarm' ),
							'options'  => $this->apr_preload_types(),
							'default'  => '9',
							'required' => array(
								array(
									'preload',
									'equals',
									array(
										'enable',
									),
								),
							),
						),
						array(
							'id'       => 'logo-preload',
							'type'     => 'media',
							'url'      => true,
							'readonly' => false,
							'title'    => esc_html__( 'Logo', 'efarm' ),
							'default'  => array(
								'url' => get_template_directory_uri() . '/images/logo2.png',
							),
							'required' => array(
								array(
									'preload-type',
									'equals',
									array(
										'2',
										'5',
									),
								),
							),
						),
						array(
							'id'       => 'preloader-bg',
							'type'     => 'color',
							'title'    => esc_html__( 'Preload background color', 'efarm' ),
							'validate' => 'color',
							'default'  => '',
							'required' => array(
								array(
									'preload',
									'equals',
									array(
										'enable',
									),
								),
							),
						),
						array(
							'id'       => 'preloader-color',
							'type'     => 'color',
							'title'    => esc_html__( 'Preload color icon', 'efarm' ),
							'validate' => 'color',
							'default'  => '',
							'required' => array(
								array(
									'preload',
									'equals',
									array(
										'enable',
									),
								),
							),
						),
					),
				),
				array(
					'icon'       => 'el-icon-css',
					'icon_class' => 'icon',
					'title'      => esc_html__( 'Skin', 'efarm' ),
				),
				array(
					'icon_class' => 'icon',
					'subsection' => true,
					'title'      => esc_html__( 'General', 'efarm' ),
					'fields'     => array(
						array(
							'id'      => 'general-bg',
							'type'    => 'background',
							'title'   => esc_html__( 'General Background', 'efarm' ),
							'default' => array(
								'background-color'      => '#fff',
								'background-image'      => '',
								'background-size'       => 'inherit',
								'background-repeat'     => 'no-repeat',
								'background-position'   => 'center center',
								'background-attachment' => 'inherit',
							),
							'output'  => array( 'body', '#error-page' ),
						),
						array(
							'id'         => 'general-font',
							'type'       => 'typography',
							'title'      => esc_html__( 'General Font', 'efarm' ),
							'google'     => true,
							'subsets'    => false,
							'font-style' => false,
							'text-align' => false,
							'default'    => array(
								'color'       => '#282828',
								'google'      => true,
								'font-weight' => '400',
								'font-family' => 'Poppins',
								'font-size'   => '14px',
								'line-height' => '24px',
							),
							'output'     => array( 'body', '#error-page' ),
						),
						array(
							'id'       => 'primary-color',
							'type'     => 'color_gradient',
							'title'    => esc_html__( 'Main color', 'efarm' ),
							'default'  => array(
								'from' => '#80bb01',
								'to'   => '#58d9cd',
							),
							'validate' => 'color',
						),
						array(
							'id'          => 'highlight-color',
							'type'        => 'color',
							'title'       => esc_html__( 'Highlight color', 'efarm' ),
							'default'     => '#222222',
							'validate'    => 'color',
							'transparent' => false,
						),
					),
				),
				array(
					'icon_class' => 'icon',
					'subsection' => true,
					'title'      => esc_html__( 'Breadcrumbs', 'efarm' ),
					'fields'     => array(
						array(
							'id'      => 'breadcrumbs_style',
							'type'    => 'button_set',
							'title'   => esc_html__( 'Breadcrumbs Layout', 'efarm' ),
							'options' => apr_get_breadcrumbs_type(),
							'default' => 'type-1',
						),
						array(

							'id'               => 'breadcrumbs-bg',
							'type'             => 'background',
							'title'            => esc_html__( 'Background', 'efarm' ),
							'background-color' => true,
							'default'          => array(
								'background-image'      => get_template_directory_uri() . '/images/bg-breadcrumb.jpg',
								'background-size'       => 'cover',
								'background-repeat'     => 'no-repeat',
								'background-position'   => 'center center',
								'background-attachment' => 'fixed',
								'background-color'      => 'none',
							),
							'required'         => array(
								'breadcrumbs_style',
								'equals',
								array(
									'type-1',
								),
							),
							'output'           => array(
								'background-image'      => '.side-breadcrumb.use_bg_image',
								'background-size'       => '.side-breadcrumb.use_bg_image',
								'background-repeat'     => '.side-breadcrumb.use_bg_image',
								'background-position'   => '.side-breadcrumb.use_bg_image',
								'background-attachment' => '.side-breadcrumb.use_bg_image',
								'background-color'      => '.side-breadcrumb.use_bg_image',
							),
						),
						array(

							'id'               => 'breadcrumbs2-bg',
							'type'             => 'background',
							'title'            => esc_html__( 'Background', 'efarm' ),
							'background-color' => true,
							'default'          => array(
								'background-image'      => 'none',
								'background-size'       => 'cover',
								'background-repeat'     => 'no-repeat',
								'background-position'   => 'center center',
								'background-attachment' => 'fixed',
								'background-color'      => '#f5f5f5',
							),
							'required'         => array(
								'breadcrumbs_style',
								'equals',
								array(
									'type-2',
								),
							),
							'output'           => array(
								'background-image'      => '.side-breadcrumb.type-2.use_bg_image',
								'background-size'       => '.side-breadcrumb.type-2.use_bg_image',
								'background-repeat'     => '.side-breadcrumb.type-2.use_bg_image',
								'background-position'   => '.side-breadcrumb.type-2.use_bg_image',
								'background-attachment' => '.side-breadcrumb.type-2.use_bg_image',
								'background-color'      => '.side-breadcrumb.type-2.use_bg_image',
							),
						),
						array(

							'id'               => 'breadcrumbs3-bg',
							'type'             => 'background',
							'title'            => esc_html__( 'Background', 'efarm' ),
							'background-color' => true,
							'default'          => array(
								'background-image'      => get_template_directory_uri() . '/images/bg-breadcrumb2.jpg',
								'background-size'       => 'cover',
								'background-repeat'     => 'no-repeat',
								'background-position'   => 'center center',
								'background-attachment' => 'fixed',
								'background-color'      => 'none',
							),
							'required'         => array(
								'breadcrumbs_style',
								'equals',
								array(
									'type-3',
								),
							),
							'output'           => array(
								'background-image'      => '.side-breadcrumb.type-3.use_bg_image',
								'background-size'       => '.side-breadcrumb.type-3.use_bg_image',
								'background-repeat'     => '.side-breadcrumb.type-3.use_bg_image',
								'background-position'   => '.side-breadcrumb.type-3.use_bg_image',
								'background-attachment' => '.side-breadcrumb.type-3.use_bg_image',
								'background-color'      => '.side-breadcrumb.type-3.use_bg_image',
							),
						),
						array(
							'id'       => 'breadcrumbs-overlay-color',
							'type'     => 'color',
							'title'    => esc_html__( 'Background Overlay Color', 'efarm' ),
							'validate' => 'color',
							'default'  => '#000',
						),
						array(
							'id'      => 'breadcrumbs_align',
							'type'    => 'button_set',
							'title'   => esc_html__( 'Breadcrumbs Align', 'efarm' ),
							'options' => apr_get_align(),
							'default' => 'center',
						),
						array(
							'id'             => 'breadcrumbs_padding',
							'type'           => 'spacing',
							'mode'           => 'padding',
							'units'          => array( 'px' ),
							'units_extended' => 'false',
							'title'          => esc_html__( 'Set padding for breadcrumb in desktop', 'efarm' ),
							'subtitle'       => esc_html__( 'Allow users to ajust breadcrumb spacing', 'efarm' ),
							'output'         => array( '.side-breadcrumb' ),
						),
						array(
							'id'          => 'title-breadcrumbs-font',
							'type'        => 'typography',
							'title'       => esc_html__( 'Title Page', 'efarm' ),
							'google'      => true,
							'subsets'     => false,
							'font-style'  => false,
							'text-align'  => false,
							'font-weight' => true,
							'line-height' => false,
							'default'     => array(
								'color'       => '#fff',
								'google'      => true,
								'font-family' => 'Asap',
								'font-size'   => '40px',
							),
						),
						array(
							'id'          => 'breadcrumbs-icon',
							'type'        => 'text',
							'title'       => esc_html__( 'Icon Home Breadcrumb', 'efarm' ),
							'placeholder' => esc_html__( 'fa fa-home', 'efarm' ),
							'desc'        => wp_kses(
								__( 'Add icon class you want here. You can find a lot of icons in these links <a target="_blank" href="http://fontawesome.io/icons/">Awesome icon</a> or <a target="_blank" href="https://linearicons.com/free">Linearicons </a>, and <a target="_blank" href="http://themes-pixeden.com/font-demos/7-stroke/">Pe stroke icon7 </a>', 'efarm' ),
								array(
									'a' => array(
										'href'   => array(),
										'target' => array(),
									),
								)
							),
						),
						array(
							'id'          => 'link-breadcrumbs-font',
							'type'        => 'typography',
							'title'       => esc_html__( 'Link Breadcrumb Option', 'efarm' ),
							'google'      => true,
							'subsets'     => false,
							'font-style'  => false,
							'text-align'  => false,
							'font-weight' => true,
							'line-height' => false,
							'default'     => array(
								'color'       => '#fdfdfd',
								'google'      => true,
								'font-family' => 'Poppins',
								'font-size'   => '14px',
							),
						),
					),
				),
				array(
					'icon_class' => 'icon',
					'subsection' => true,
					'title'      => esc_html__( 'Typography', 'efarm' ),
					'fields'     => array(
						array(
							'id'          => 'h1-font',
							'type'        => 'typography',
							'title'       => esc_html__( 'H1 Font', 'efarm' ),
							'google'      => true,
							'subsets'     => false,
							'font-style'  => false,
							'text-align'  => false,
							'font-weight' => false,
							'line-height' => false,
							'default'     => array(
								'color'       => '#000',
								'google'      => true,
								'font-family' => 'Poppins',
								'font-size'   => '40px',
							),
							'output'      => array( 'h1' ),
						),
						array(
							'id'          => 'h2-font',
							'type'        => 'typography',
							'title'       => esc_html__( 'H2 Font', 'efarm' ),
							'google'      => true,
							'subsets'     => false,
							'font-style'  => false,
							'text-align'  => false,
							'font-weight' => false,
							'line-height' => false,
							'default'     => array(
								'color'       => '#000',
								'google'      => true,
								'font-family' => 'Poppins',
								'font-size'   => '30px',
							),
							'output'      => array( 'h2' ),
						),
						array(
							'id'          => 'h3-font',
							'type'        => 'typography',
							'title'       => esc_html__( 'H3 Font', 'efarm' ),
							'google'      => true,
							'subsets'     => false,
							'font-style'  => false,
							'text-align'  => false,
							'font-weight' => false,
							'line-height' => false,
							'default'     => array(
								'color'       => '#000',
								'google'      => true,
								'font-family' => 'Poppins',
								'font-size'   => '20px',
							),
							'output'      => array( 'h3' ),
						),
						array(
							'id'          => 'h4-font',
							'type'        => 'typography',
							'title'       => esc_html__( 'H4 Font', 'efarm' ),
							'google'      => true,
							'subsets'     => false,
							'font-style'  => false,
							'text-align'  => false,
							'font-weight' => false,
							'line-height' => false,
							'default'     => array(
								'color'       => '#000',
								'google'      => true,
								'font-family' => 'Poppins',
								'font-size'   => '18px',
							),
							'output'      => array( 'h4' ),
						),
						array(
							'id'          => 'h5-font',
							'type'        => 'typography',
							'title'       => esc_html__( 'H5 Font', 'efarm' ),
							'google'      => true,
							'subsets'     => false,
							'font-style'  => false,
							'text-align'  => false,
							'font-weight' => false,
							'line-height' => false,
							'default'     => array(
								'color'       => '#000',
								'google'      => true,
								'font-family' => 'Poppins',
								'font-size'   => '16px',
							),
							'output'      => array( 'h5' ),
						),
						array(
							'id'          => 'h6-font',
							'type'        => 'typography',
							'title'       => esc_html__( 'H6 Font', 'efarm' ),
							'google'      => true,
							'subsets'     => false,
							'font-style'  => false,
							'text-align'  => false,
							'font-weight' => false,
							'line-height' => false,
							'default'     => array(
								'color'       => '#000',
								'google'      => true,
								'font-family' => 'Poppins',
								'font-size'   => '14px',
							),
							'output'      => array( 'h6' ),
						),
					),
				),
				array(
					'icon_class' => 'icon',
					'subsection' => true,
					'title'      => esc_html__( 'Custom', 'efarm' ),
					'fields'     => array(
						array(
							'id'       => 'custom-css-code',
							'type'     => 'ace_editor',
							'title'    => esc_html__( 'CSS', 'efarm' ),
							'subtitle' => esc_html__( 'Enter CSS code here.', 'efarm' ),
							'mode'     => 'css',
							'theme'    => 'monokai',
							'default'  => '',
						),
					),
				),
				$this->apr_add_header_section_options(),
				array(
					'icon_class' => 'el-icon-edit',
					'subsection' => true,
					'title'      => esc_html__( 'Side Header Information', 'efarm' ),
					'fields'     => array(
						array(
							'id'      => 'header-info',
							'type'    => 'switch',
							'title'   => esc_html__( 'Enable Side Header Information', 'efarm' ),
							'default' => false,
						),
						array(
							'id'          => 'header-info-icon',
							'type'        => 'text',
							'title'       => esc_html__( 'Icon Information', 'efarm' ),
							'default'     => 'pe-7s-edit',
							'placeholder' => esc_html__( 'pe-7s-edit', 'efarm' ),
							'required'    => array(
								'header-info',
								'equals',
								array(
									true,
								),
							),
							'desc'        => wp_kses(
								__( 'Add icon class you want here. You can find a lot of icons in these links <a target="_blank" href="http://fontawesome.io/icons/">Awesome icon</a> or <a target="_blank" href="https://linearicons.com/free">Linearicons </a>, <a target="_blank" href="http://themes-pixeden.com/font-demos/7-stroke/">Pe stroke icon7 </a> and <a target="_blank" href="https://www.dropbox.com/s/oy8lsb7u4eli7rt/barber_font.png?dl=0">Efarm icon list </a>', 'efarm' ),
								array(
									'a' => array(
										'href'   => array(),
										'target' => array(),
									),
								)
							),
						),
						array(
							'id'       => 'header-slogan',
							'type'     => 'textarea',
							'title'    => esc_html__( 'Slogan', 'efarm' ),
							'default'  => 'Lorem ipsum dolor sit amet gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auci. Proin gravida nibh vel veliau ctor aliquenean.',
							'required' => array(
								'header-info',
								'equals',
								array(
									true,
								),
							),
						),
						array(
							'id'       => 'side-twitter',
							'type'     => 'switch',
							'title'    => esc_html__( 'Show Twitter', 'efarm' ),
							'default'  => true,
							'required' => array( 'header-info', 'equals', true ),
						),
						array(
							'id'       => 'side-contact',
							'type'     => 'switch',
							'title'    => esc_html__( 'Show Contact Form', 'efarm' ),
							'default'  => false,
							'required' => array( 'header-info', 'equals', true ),
						),
						array(
							'id'       => 'form_contact',
							'type'     => 'textarea',
							'title'    => esc_html__( 'Contact form shortcode', 'efarm' ),
							'default'  => '',
							'required' => array( 'side-contact', 'equals', true ),
							'desc'     => esc_html__( 'Get contact form shortcode in Contact > Contact Forms', 'efarm' ),
						),
						array(
							'id'       => 'side-instagram',
							'type'     => 'switch',
							'title'    => esc_html__( 'Show Instagram', 'efarm' ),
							'default'  => false,
							'required' => array( 'header-info', 'equals', true ),
						),
						array(
							'id'       => 'iframe-instagram',
							'type'     => 'textarea',
							'required' => array( 'side-instagram', 'equals', true ),
							'title'    => esc_html__( 'Iframe Instagram', 'efarm' ),
							'desc'     => esc_html__( 'Get Iframe In Website http://instaembedder.com/ or http://widgets.websta.me/', 'efarm' ),
						),
						array(
							'id'      => 'header-contact',
							'type'    => 'switch',
							'title'   => esc_html__( 'Show Contact Us', 'efarm' ),
							'default' => true,
						),
						array(
							'id'       => 'header-callto',
							'type'     => 'text',
							'title'    => esc_html__( 'Callto', 'efarm' ),
							'default'  => '+84437955813',
							'required' => array(
								'header-contact',
								'equals',
								array(
									true,
								),
							),
						),
						array(
							'id'       => 'header-mailto',
							'type'     => 'text',
							'title'    => esc_html__( 'Mailto', 'efarm' ),
							'default'  => 'arrowpress@arrowhitech.com',
							'required' => array(
								'header-contact',
								'equals',
								array(
									true,
								),
							),
						),
						array(
							'id'       => 'header-address',
							'type'     => 'text',
							'title'    => esc_html__( 'Address', 'efarm' ),
							'default'  => 'New York, USA',
							'required' => array(
								'header-contact',
								'equals',
								array(
									true,
								),
							),
						),
					),
				),
				array(
					'icon_class' => 'el-icon-edit',
					'subsection' => true,
					'title'      => esc_html__( 'Header Styling', 'efarm' ),
					'fields'     => array(
						array(
							'id'       => 'height_header',
							'type'     => 'dimensions',
							'units'    => array( 'em', 'px', '%' ),
							'title'    => esc_html__( 'Set height header', 'efarm' ),
							'subtitle' => esc_html__( 'Allow users to set height for header', 'efarm' ),
							'width'    => false,
						),
						array(
							'id'       => 'height_header_sticky',
							'type'     => 'dimensions',
							'units'    => array( 'em', 'px', '%' ),
							'title'    => esc_html__( 'Set height header sticky', 'efarm' ),
							'subtitle' => esc_html__( 'Allow users to set height for header sticky', 'efarm' ),
							'width'    => false,
						),
						array(
							'id'       => 'logo_width',
							'type'     => 'dimensions',
							'units'    => array( 'em', 'px', '%' ),
							'title'    => esc_html__( 'Set logo image width and height', 'efarm' ),
							'subtitle' => esc_html__( 'Allow users to set width and height for header logo image', 'efarm' ),
							'height'   => true,
						),
						array(
							'id'     => 'logo_mobile',
							'type'   => 'dimensions',
							'units'  => array( 'em', 'px', '%' ),
							'title'  => esc_html__( '[Mobile] Set logo image width and height in mobile menu', 'efarm' ),
							'height' => true,
						),
						array(
							'id'             => 'logo_padding',
							'type'           => 'spacing',
							'mode'           => 'margin',
							'units'          => array( 'px' ),
							'units_extended' => 'false',
							'title'          => esc_html__( 'Set padding for header logo in desktop', 'efarm' ),
							'subtitle'       => esc_html__( 'Allow users to ajust logo spacing', 'efarm' ),
						),
						array(
							'id'             => 'menu_spacing',
							'type'           => 'spacing',
							'mode'           => 'margin',
							'units'          => array( 'px' ),
							'units_extended' => 'false',
							'title'          => esc_html__( 'Set padding for menu items', 'efarm' ),
							'subtitle'       => esc_html__( 'Allow users to ajust menu item spacing', 'efarm' ),
						),
						array(
							'id'      => 'header-style',
							'type'    => 'select',
							'title'   => esc_html__( 'Select header for styling', 'efarm' ),
							'options' => apr_header_types(),
							'default' => '1',
						),
						//Header 1, 2, 4
						array(
							'id'       => 'header-bg',
							'type'     => 'color',
							'title'    => esc_html__( 'Header background color', 'efarm' ),
							'validate' => 'color',
							'default'  => '#fff',
							'required' => array(
								'header-style',
								'equals',
								array(
									'1',
									'2',
									'4',
									'7',
									'9',
								),
							),
						),
						array(
							'id'          => 'header-menu-color',
							'type'        => 'color',
							'title'       => esc_html__( 'Header Menu Color', 'efarm' ),
							'default'     => '#282828',
							'validate'    => 'color',
							'transparent' => true,
							'required'    => array(
								'header-style',
								'equals',
								array(
									'1',
									'2',
									'4',
									'7',
									'9',
								),
							),
						),
						array(
							'id'       => 'header-bg-hover',
							'type'     => 'color',
							'title'    => esc_html__( 'Header background color hover submenu', 'efarm' ),
							'validate' => 'color',
							'default'  => '#f7f6f6',
							'required' => array(
								'header-style',
								'equals',
								array(
									'1',
									'2',
									'4',
									'7',
									'9',
								),
							),
						),
						array(
							'id'          => 'header-border-color',
							'type'        => 'color',
							'title'       => esc_html__( 'Header Submenu Border Color', 'efarm' ),
							'default'     => '#f0efef',
							'validate'    => 'color',
							'transparent' => true,
							'required'    => array(
								'header-style',
								'equals',
								array(
									'1',
									'2',
									'4',
									'7',
									'9',
								),
							),
						),
						//Header 3, 5
						array(
							'id'          => 'header2-bg',
							'type'        => 'color',
							'title'       => esc_html__( 'Header Background Color', 'efarm' ),
							'default'     => '#313131',
							'validate'    => 'color',
							'transparent' => true,
							'required'    => array(
								'header-style',
								'equals',
								array(
									'3',
									'8',
								),
							),
						),
						array(
							'id'          => 'header2-menu-color',
							'type'        => 'color',
							'title'       => esc_html__( 'Header Menu Color', 'efarm' ),
							'default'     => '#fff',
							'validate'    => 'color',
							'transparent' => true,
							'required'    => array(
								'header-style',
								'equals',
								array(
									'3',
									'5',
									'8',
								),
							),
						),
						array(
							'id'       => 'header2-bg-hover',
							'type'     => 'color',
							'title'    => esc_html__( 'Header background color hover submenu', 'efarm' ),
							'validate' => 'color',
							'default'  => '#222222',
							'required' => array(
								'header-style',
								'equals',
								array(
									'3',
									'5',
									'8',
								),
							),
						),
						array(
							'id'          => 'header2-border-color',
							'type'        => 'color',
							'title'       => esc_html__( 'Header Submenu Border Color', 'efarm' ),
							'default'     => '#555555',
							'validate'    => 'color',
							'transparent' => true,
							'required'    => array(
								'header-style',
								'equals',
								array(
									'3',
									'5',
									'8',
								),
							),
						),
						//Header 5
						array(
							'id'          => 'header5-bg',
							'type'        => 'color',
							'title'       => esc_html__( 'Header Background Color', 'efarm' ),
							'default'     => '#282828',
							'validate'    => 'color',
							'transparent' => true,
							'required'    => array(
								'header-style',
								'equals',
								array(
									'5',
								),
							),
						),
						//Header 7
						array(
							'id'          => 'header7-bg-top',
							'type'        => 'color',
							'title'       => esc_html__( 'Header Background Top Header', 'efarm' ),
							'default'     => '#282828',
							'validate'    => 'color',
							'transparent' => true,
							'required'    => array(
								'header-style',
								'equals',
								array(
									'7',
								),
							),
						),
						array(
							'id'          => 'header7-text-top',
							'type'        => 'color',
							'title'       => esc_html__( 'Header Color Top Header', 'efarm' ),
							'default'     => '#b1b1b1',
							'validate'    => 'color',
							'transparent' => true,
							'required'    => array(
								'header-style',
								'equals',
								array(
									'7',
								),
							),
						),
					),

				),
				array(
					'icon'       => 'el-icon-edit',
					'icon_class' => 'icon',
					'title'      => esc_html__( 'Footer', 'efarm' ),
					'fields'     => array(
						array(
							'id'       => 'footer-type',
							'type'     => 'image_select',
							'title'    => esc_html__( 'Footer Type', 'efarm' ),
							'options'  => $this->apr_footer_types(),
							'subtitle' => esc_html__( 'Each page will have option for select footer type. Footer selection in each page will have higher priority than this general selection.', 'efarm' ),
							'default'  => '1',
						),
						array(
							'id'      => 'footer-position',
							'type'    => 'switch',
							'title'   => esc_html__( 'Footer Fixed', 'efarm' ),
							'default' => false,
						),
						array(
							'id'       => 'logo_footer',
							'type'     => 'media',
							'url'      => true,
							'readonly' => false,
							'title'    => esc_html__( 'Footer logo', 'efarm' ),
							'required' => array(
								'footer-type',
								'equals',
								array(
									'1',
								),
							),
						),
						array(
							'id'       => 'logo_footer4',
							'type'     => 'media',
							'url'      => true,
							'readonly' => false,
							'title'    => esc_html__( 'Footer v4 logo', 'efarm' ),
							'required' => array(
								'footer-type',
								'equals',
								array(
									'4',
								),
							),
						),
						array(
							'id'       => 'show-contact-info',
							'type'     => 'switch',
							'title'    => esc_html__( 'Show Contact Info', 'efarm' ),
							'default'  => true,
							'on'       => esc_html__( 'Yes', 'efarm' ),
							'off'      => esc_html__( 'No', 'efarm' ),
							'required' => array(
								'footer-type',
								'equals',
								array(
									'3',
								),
							),
						),
						array(
							'id'       => 'address_footer',
							'type'     => 'text',
							'default'  => esc_html__( '19th street, City, NY 95822, USA', 'efarm' ),
							'title'    => esc_html__( 'Address', 'efarm' ),
							'required' => array( 'show-contact-info', 'equals', 1 ),
						),
						array(
							'id'       => 'phone_footer',
							'type'     => 'text',
							'default'  => esc_html__( '+84437955813', 'efarm' ),
							'title'    => esc_html__( 'Phone', 'efarm' ),
							'required' => array( 'show-contact-info', 'equals', 1 ),
						),
						array(
							'id'       => 'mail_footer',
							'type'     => 'text',
							'default'  => esc_html__( 'arrowpress@arrowhitech.com', 'efarm' ),
							'title'    => esc_html__( 'Email', 'efarm' ),
							'required' => array( 'show-contact-info', 'equals', 1 ),
						),
						array(
							'id'       => 'show-payment',
							'type'     => 'switch',
							'title'    => esc_html__( 'Show Payment', 'efarm' ),
							'default'  => false,
							'on'       => esc_html__( 'Yes', 'efarm' ),
							'off'      => esc_html__( 'No', 'efarm' ),
							'required' => array(
								'footer-type',
								'equals',
								array(
									'1',
								),
							),
						),
						array(
							'id'          => 'link-paypal',
							'type'        => 'text',
							'title'       => esc_html__( 'Paypal', 'efarm' ),
							'required'    => array( 'show-payment', 'equals', 1 ),
							'placeholder' => esc_html__( 'http://', 'efarm' ),
						),
						array(
							'id'          => 'link-visa',
							'type'        => 'text',
							'title'       => esc_html__( 'Visa', 'efarm' ),
							'required'    => array( 'show-payment', 'equals', 1 ),
							'placeholder' => esc_html__( 'http://', 'efarm' ),
						),
						array(
							'id'          => 'link-mastercard',
							'type'        => 'text',
							'title'       => esc_html__( 'Master card', 'efarm' ),
							'required'    => array( 'show-payment', 'equals', 1 ),
							'placeholder' => esc_html__( 'http://', 'efarm' ),
						),
						array(
							'id'          => 'link-discover',
							'type'        => 'text',
							'title'       => esc_html__( 'Discover', 'efarm' ),
							'required'    => array( 'show-payment', 'equals', 1 ),
							'placeholder' => esc_html__( 'http://', 'efarm' ),
						),
						array(
							'id'          => 'link-amex',
							'type'        => 'text',
							'title'       => esc_html__( 'Amex', 'efarm' ),
							'required'    => array( 'show-payment', 'equals', 1 ),
							'placeholder' => esc_html__( 'http://', 'efarm' ),
						),
						array(
							'id'       => 'footerinfo-title',
							'type'     => 'text',
							'title'    => esc_html__( 'Footer info title', 'efarm' ),
							'required' => array( 'footer-type', 'equals', '3' ),
							'default'  => esc_html__( 'About Us', 'efarm' ),
						),

						array(
							'id'       => 'footer-info',
							'type'     => 'textarea',
							'title'    => esc_html__( 'Footer Description', 'efarm' ),
							'required' => array(
								'footer-type',
								'equals',
								array(
									'1',
									'2',
									'3',
									'4',
								),
							),
						),
						array(
							'id'          => 'social-twitter',
							'type'        => 'text',
							'title'       => esc_html__( 'Twitter', 'efarm' ),
							'placeholder' => esc_html__( 'https://twitter.com/arrowpress1', 'efarm' ),
						),

						array(
							'id'          => 'social-facebook',
							'type'        => 'text',
							'title'       => esc_html__( 'Facebook', 'efarm' ),
							'placeholder' => esc_html__( 'https://facebook.com/arrowpress', 'efarm' ),
						),
						array(
							'id'          => 'social-google',
							'type'        => 'text',
							'title'       => esc_html__( 'Google', 'efarm' ),
							'placeholder' => esc_html__( 'http://', 'efarm' ),
						),
						array(
							'id'          => 'social-instagram',
							'type'        => 'text',
							'title'       => esc_html__( 'Instagram', 'efarm' ),
							'placeholder' => esc_html__( 'https://www.instagram.com/aprefarn/', 'efarm' ),
						),
						array(
							'id'          => 'social-pinterest',
							'type'        => 'text',
							'title'       => esc_html__( 'Pinterest', 'efarm' ),
							'default'     => '',
							'placeholder' => esc_html__( 'http://', 'efarm' ),
						),
						array(
							'id'          => 'social-dribbble',
							'type'        => 'text',
							'title'       => esc_html__( 'Dribbble', 'efarm' ),
							'default'     => '',
							'placeholder' => esc_html__( 'http://', 'efarm' ),
						),
						array(
							'id'          => 'social-linkedin',
							'type'        => 'text',
							'title'       => esc_html__( 'Linkedin', 'efarm' ),
							'default'     => '',
							'placeholder' => esc_html__( 'http://', 'efarm' ),
						),
						array(
							'id'          => 'social-behance',
							'type'        => 'text',
							'title'       => esc_html__( 'Behance', 'efarm' ),
							'default'     => '',
							'placeholder' => esc_html__( 'http://', 'efarm' ),
						),
						array(
							'id'      => 'footer-copyright',
							'type'    => 'textarea',
							'title'   => esc_html__( 'Copyright', 'efarm' ),
							'default' => wp_kses(
								__( ' Copyright @ 2017 <a target="_blank" href="http://hn.arrowpress.net/efarm">eFarm</a>. All Rights Reserved. Powered by <a target="_blank" href="http://www.arrowhitech.com/">ArrowHitech</a>.', 'efarm' ),
								array(
									'a' => array(
										'href'   => array(),
										'title'  => array(),
										'target' => array(),
									),
									'i' => array(
										'class'       => array(),
										'aria-hidden' => array(),
									),
								)
							),
						),
					),
				),

				array(
					'icon_class' => 'el-icon-edit',
					'subsection' => true,
					'title'      => esc_html__( 'Footer Styling', 'efarm' ),
					'fields'     => array(
						array(
							'id'      => 'footer-style',
							'type'    => 'select',
							'title'   => esc_html__( 'Select footer for styling', 'efarm' ),
							'options' => apr_footer_types(),
							'default' => '1',
						),
						array(
							'id'          => 'footer1-bg-color',
							'type'        => 'color',
							'title'       => esc_html__( 'Background color', 'efarm' ),
							'required'    => array(
								'footer-style',
								'equals',
								array(
									'1',
								),
							),
							'default'     => '#fff',
							'validate'    => 'color',
							'transparent' => false,
						),
						array(
							'id'          => 'footer4-bg-color',
							'type'        => 'color',
							'title'       => esc_html__( 'Background color', 'efarm' ),
							'required'    => array(
								'footer-style',
								'equals',
								array(
									'4',
								),
							),
							'default'     => '#2d2d2d',
							'validate'    => 'color',
							'transparent' => false,
						),
						array(
							'id'          => 'footer-bg-color',
							'type'        => 'color',
							'title'       => esc_html__( 'Background color', 'efarm' ),
							'required'    => array(
								'footer-style',
								'equals',
								array(
									'2',
									'3',
								),
							),
							'default'     => '#f5f5f5',
							'validate'    => 'color',
							'transparent' => false,
						),
						array(
							'id'          => 'footer-t-color',
							'type'        => 'color',
							'title'       => esc_html__( 'Title color', 'efarm' ),
							'required'    => array(
								'footer-style',
								'equals',
								array(
									'1',
									'2',
									'3',
								),
							),
							'default'     => '#282828',
							'validate'    => 'color',
							'transparent' => false,
						),
						array(
							'id'          => 'footer4-color',
							'type'        => 'color',
							'title'       => esc_html__( 'Footer text color', 'efarm' ),
							'required'    => array(
								'footer-style',
								'equals',
								array(
									'4',
								),
							),
							'default'     => '#fff',
							'validate'    => 'color',
							'transparent' => false,
						),
						array(
							'id'          => 'footer-color',
							'type'        => 'color',
							'title'       => esc_html__( 'Footer text color', 'efarm' ),
							'required'    => array(
								'footer-style',
								'equals',
								array(
									'1',
									'2',
									'3',
								),
							),
							'default'     => '#282828',
							'validate'    => 'color',
							'transparent' => false,
							'output'      => array( '.footer-v1', '.footer-v1 a' ),
						),
						array(
							'id'               => 'newsletter-bg',
							'type'             => 'background',
							'title'            => esc_html__( 'Newsletter background', 'efarm' ),
							'background-color' => true,
							'default'          => array(
								'background-image'      => get_template_directory_uri() . '/images/bg-newsletter.png',
								'background-size'       => 'cover',
								'background-repeat'     => 'no-repeat',
								'background-position'   => 'center center',
								'background-attachment' => 'inherit',
								'background-color'      => '#f5f5f5',
							),
							'output'           => array(
								'background-image'      => '.footer-v1 .footer-newsletter',
								'background-size'       => '.footer-v1 .footer-newsletter',
								'background-repeat'     => '.footer-v1 .footer-newsletter',
								'background-position'   => '.footer-v1 .footer-newsletter',
								'background-attachment' => '.footer-v1 .footer-newsletter',
								'background-color'      => '.footer-v1 .footer-newsletter',
							),
							'required'         => array(
								'footer-style',
								'equals',
								array(
									'1',
									'4',
								),
							),
						),
						array(
							'id'          => 'footer-social-color',
							'type'        => 'color',
							'title'       => esc_html__( 'Footer social color', 'efarm' ),
							'required'    => array(
								'footer-style',
								'equals',
								array(
									'1',
									'2',
									'3',
								),
							),
							'default'     => '#a9a9a9',
							'validate'    => 'color',
							'transparent' => false,
						),
						array(
							'id'          => 'footer1-copyright-bg',
							'type'        => 'color',
							'title'       => esc_html__( 'Footer copyright background color', 'efarm' ),
							'required'    => array(
								'footer-style',
								'equals',
								array(
									'1',
								),
							),
							'default'     => '#f5f5f5',
							'validate'    => 'color',
							'transparent' => false,
						),
						array(
							'id'          => 'footer4-copyright-bg',
							'type'        => 'color',
							'title'       => esc_html__( 'Footer copyright background color', 'efarm' ),
							'required'    => array(
								'footer-style',
								'equals',
								array(
									'4',
								),
							),
							'default'     => '#282828',
							'validate'    => 'color',
							'transparent' => false,
						),
						array(
							'id'          => 'footer-copyright-bg',
							'type'        => 'color',
							'title'       => esc_html__( 'Footer copyright background color', 'efarm' ),
							'required'    => array(
								'footer-style',
								'equals',
								array(
									'2',
									'3',
								),
							),
							'default'     => '#282828',
							'validate'    => 'color',
							'transparent' => false,
						),
						array(
							'id'          => 'footer1-copyright-color',
							'type'        => 'color',
							'title'       => esc_html__( 'Footer copyright color', 'efarm' ),
							'required'    => array(
								'footer-style',
								'equals',
								array(
									'1',
								),
							),
							'default'     => '#696969',
							'validate'    => 'color',
							'transparent' => false,
						),
						array(
							'id'          => 'footer-copyright-color',
							'type'        => 'color',
							'title'       => esc_html__( 'Footer copyright color', 'efarm' ),
							'required'    => array(
								'footer-style',
								'equals',
								array(
									'2',
									'3',
								),
							),
							'default'     => '#fff',
							'validate'    => 'color',
							'transparent' => false,
						),
					),
				),
				array(
					'icon'       => 'el-icon-th',
					'icon_class' => 'icon',
					'title'      => esc_html__( 'Blog archive', 'efarm' ),
					'fields'     => array(
						array(
							'id'   => '1',
							'type' => 'info',
							'desc' => esc_html__( 'Blog layout default', 'efarm' ),
						),
						array(
							'id'      => 'blog-title',
							'type'    => 'text',
							'title'   => esc_html__( 'Page Title', 'efarm' ),
							'default' => 'Blog',
						),
						array(
							'id'      => 'post-layout',
							'type'    => 'button_set',
							'title'   => esc_html__( 'Layout', 'efarm' ),
							'options' => $page_layout,
							'default' => 'fullwidth',
						),
						array(
							'id'      => 'left-post-sidebar',
							'type'    => 'select',
							'title'   => esc_html__( 'Select Left Sidebar', 'efarm' ),
							'data'    => 'sidebars',
							'default' => '',
						),
						array(
							'id'      => 'right-post-sidebar',
							'type'    => 'select',
							'title'   => esc_html__( 'Select Right Sidebar', 'efarm' ),
							'data'    => 'sidebars',
							'default' => '',
						),
						array(
							'id'      => 'post-layout-version',
							'type'    => 'button_set',
							'title'   => esc_html__( 'Blog Layout', 'efarm' ),
							'options' => apr_page_blog_layouts(),
							'default' => 'list',
						),
						array(
							'id'       => 'post-layout-columns',
							'type'     => 'button_set',
							'title'    => esc_html__( 'Blog Columns', 'efarm' ),
							'options'  => apr_page_blog_columns(),
							'default'  => '2',
							'required' => array(
								'post-layout-version',
								'equals',
								array(
									'grid',
									'masonry',
								),
							),
						),
						array(
							'id'       => 'post_per_page',
							'type'     => 'spinner',
							'title'    => esc_html__( 'Post show per page', 'efarm' ),
							'default'  => '9',
							'min'      => '1',
							'step'     => '1',
							'max'      => '50',
							'required' => array(
								'post-layout-version',
								'equals',
								array(
									'masonry',
								),
							),
						),
						array(
							'id'      => 'post_pagination',
							'type'    => 'button_set',
							'title'   => esc_html__( 'Pagination type', 'efarm' ),
							'options' => array(
								'1' => esc_html__( 'Load more', 'efarm' ),
								'2' => esc_html__( 'Next/Prev', 'efarm' ),
								'3' => esc_html__( 'Number', 'efarm' ),
							),
							'default' => '3',
						),
						array(
							'id'       => 'post-meta',
							'type'     => 'button_set',
							'title'    => esc_html__( 'Post Meta', 'efarm' ),
							'multi'    => true,
							'options'  => array(
								'author'  => esc_html__( 'Author', 'efarm' ),
								'comment' => esc_html__( 'Comment', 'efarm' ),
								'date'    => esc_html__( 'Date', 'efarm' ),
								'like'    => esc_html__( 'Like', 'efarm' ),
								'cat'     => esc_html__( 'Categories', 'efarm' ),
								'tag'     => esc_html__( 'Tags', 'efarm' ),
							),
							'default'  => array( 'cat', 'comment', 'date', 'tag' ),
							'required' => array(
								'post-layout-version',
								'equals',
								array(
									'list',
								),
							),
						),
						array(
							'id'       => 'post-meta2',
							'type'     => 'button_set',
							'title'    => esc_html__( 'Post Meta', 'efarm' ),
							'multi'    => true,
							'options'  => array(
								'author'  => esc_html__( 'Author', 'efarm' ),
								'comment' => esc_html__( 'Comment', 'efarm' ),
								'date'    => esc_html__( 'Date', 'efarm' ),
								'like'    => esc_html__( 'Like', 'efarm' ),
								'cat'     => esc_html__( 'Categories', 'efarm' ),
								'tag'     => esc_html__( 'Tags', 'efarm' ),
							),
							'default'  => array( 'tag', 'date' ),
							'required' => array(
								'post-layout-version',
								'equals',
								array(
									'masonry',
									'grid',
								),
							),
						),
						array(
							'id'      => 'blog-date-format',
							'type'    => 'switch',
							'title'   => esc_html__( 'Use default date format setting in Settings > General', 'efarm' ),
							'default' => false,
						),
						array(
							'id'     => 'blog_date_size',
							'type'   => 'dimensions',
							'units'  => array( 'em', 'px', '%' ),
							'title'  => esc_html__( 'Set blog date width and height', 'efarm' ),
							'height' => true,
						),
					),
				),
				array(
					'subsection' => true,
					'title'      => esc_html__( 'Single Blog', 'efarm' ),
					'fields'     => array(
						/*array(
							'id' => 'single-post-layout-version',
							'type' => 'button_set',
							'title' => esc_html__('Single Blog Layout', 'efarm'),
							'options' => apr_page_single_blog_layouts(),
							'default' => 'single-1'
						),  */
						array(
							'id'      => 'post-share',
							'type'    => 'button_set',
							'title'   => esc_html__( 'Post Share Links', 'efarm' ),
							'multi'   => true,
							'options' => array(
								'facebook' => esc_html__( 'Facebook', 'efarm' ),
								'twitter'  => esc_html__( 'Twitter', 'efarm' ),
								'pin'      => esc_html__( 'Pinterest', 'efarm' ),
								'insta'    => esc_html__( 'Instagram', 'efarm' ),
							),
						),
					),
				),
				array(
					'icon'       => 'el-icon-picture',
					'icon_class' => 'icon',
					'title'      => esc_html__( 'Portfolio', 'efarm' ),
					'fields'     => array(
						array(
							'id'   => '2',
							'type' => 'info',
							'desc' => esc_html__( 'Portfolio Archive Page', 'efarm' ),
						),
						array(
							'id'     => 'section-start',
							'type'   => 'section',
							'title'  => esc_html__( 'Changing portfolio slug', 'efarm' ),
							'indent' => true,
						),
						array(
							'id'       => 'gallery_slug',
							'type'     => 'text',
							'title'    => esc_html__( 'Custom Slug', 'efarm' ),
							'subtitle' => esc_html__( 'If you want your gallery post type to have a custom slug in the url, please enter it here.', 'efarm' ),
							'desc'     => esc_html__(
								'You will still have to refresh your permalinks after saving this! 
    This is done by going to Settings > Permalinks and clicking save.',
								'efarm'
							),
							'validate' => 'str_replace',
							'str'      => array(
								'search'      => ' ',
								'replacement' => '-',
							),
							'default'  => 'gallery',
						),
						array(
							'id'       => 'gallery_cat_slug',
							'type'     => 'text',
							'title'    => esc_html__( 'Custom Slug for Portfolio category', 'efarm' ),
							'subtitle' => esc_html__( 'If you want your gallery category to have a custom slug in the url, please enter it here.', 'efarm' ),
							'desc'     => esc_html__(
								'You will still have to refresh your permalinks after saving this! 
    This is done by going to Settings > Permalinks and clicking save.',
								'efarm'
							),
							'validate' => 'str_replace',
							'str'      => array(
								'search'      => ' ',
								'replacement' => '-',
							),
							'default'  => 'gallery_cat',
						),
						array(
							'id'     => 'section-end',
							'type'   => 'section',
							'indent' => false,
						),
						array(
							'id'       => 'gallery_tag_slug',
							'type'     => 'text',
							'title'    => esc_html__( 'Custom Slug for Portfolio tag', 'efarm' ),
							'subtitle' => esc_html__( 'If you want your gallery tag to have a custom slug in the url, please enter it here.', 'efarm' ),
							'desc'     => esc_html__(
								'You will still have to refresh your permalinks after saving this! 
    This is done by going to Settings > Permalinks and clicking save.',
								'efarm'
							),
							'validate' => 'str_replace',
							'str'      => array(
								'search'      => ' ',
								'replacement' => '-',
							),
							'default'  => 'gallery_tag',
						),
						array(
							'id'     => 'section-end',
							'type'   => 'section',
							'indent' => false,
						),
						array(
							'id'   => '3',
							'type' => 'info',
							'desc' => esc_html__( 'The below options is also available in each Gallery Category. Please go to Gallery > Gallery Category and edit a category for more detail. The selections in each category will have higher priority than below general selections', 'efarm' ),
						),
						array(
							'id'      => 'gallery_filter',
							'type'    => 'switch',
							'title'   => esc_html__( 'Show Filter', 'efarm' ),
							'default' => false,
							'on'      => esc_html__( 'Yes', 'efarm' ),
							'off'     => esc_html__( 'No', 'efarm' ),
						),
						array(
							'id'      => 'gallery-layout',
							'type'    => 'button_set',
							'title'   => esc_html__( 'General Layout', 'efarm' ),
							'options' => $page_layout,
							'default' => 'fullwidth',
						),
						array(
							'id'      => 'left-gallery-sidebar',
							'type'    => 'select',
							'title'   => esc_html__( 'Select Left Sidebar', 'efarm' ),
							'data'    => 'sidebars',
							'default' => '',
						),
						array(
							'id'      => 'right-gallery-sidebar',
							'type'    => 'select',
							'title'   => esc_html__( 'Select Right Sidebar', 'efarm' ),
							'data'    => 'sidebars',
							'default' => '',
						),
						array(
							'id'      => 'gallery-cols',
							'type'    => 'button_set',
							'title'   => esc_html__( 'Portfolio Columns', 'efarm' ),
							'options' => apr_gallery_columns(),
							'default' => '3',
						),
						array(
							'id'      => 'gallery-space',
							'type'    => 'switch',
							'title'   => esc_html__( 'Remove space', 'efarm' ),
							'default' => false,
							'on'      => esc_html__( 'Yes', 'efarm' ),
							'off'     => esc_html__( 'No', 'efarm' ),
						),
						array(
							'id'      => 'gallery-style',
							'type'    => 'button_set',
							'title'   => esc_html__( 'Portfolio Style', 'efarm' ),
							'options' => apr_gallery_style(),
							'default' => 'style1',
						),
						array(
							'id'      => 'gallery-style-version',
							'type'    => 'button_set',
							'title'   => esc_html__( 'Portfolio layouts', 'efarm' ),
							'options' => apr_page_gallery_layouts(),
							'default' => '2',
						),
						array(
							'id'      => 'gallery-loadmore-style',
							'type'    => 'button_set',
							'title'   => esc_html__( 'Portfolio loadmore style', 'efarm' ),
							'options' => array(
								'1' => esc_html__( 'Button style 1', 'efarm' ),
								'2' => esc_html__( 'Button style 2', 'efarm' ),
							),
							'default' => '1',
						),
						array(
							'id'      => 'gallery_per_page',
							'type'    => 'spinner',
							'title'   => esc_html__( 'Post show per page', 'efarm' ),
							'default' => '9',
							'min'     => '1',
							'step'    => '1',
							'max'     => '20',
						),
					),
				),
				array(
					'icon_class' => 'icon',
					'subsection' => true,
					'title'      => esc_html__( 'Single Portfolio', 'efarm' ),
					'fields'     => array(
						array(
							'id'   => '1',
							'type' => 'info',
							'desc' => esc_html__( 'Portfolio detail page', 'efarm' ),
						),
						array(
							'id'      => 'single_gallery_style',
							'type'    => 'button_set',
							'title'   => esc_html__( 'Single gallery layout', 'efarm' ),
							'options' => array(
								'1' => esc_html__( 'Wide', 'efarm' ),
								'2' => esc_html__( 'Slider', 'efarm' ),
								'3' => esc_html__( 'Side Information', 'efarm' ),
							),
							'default' => '2',
						),
					),
				),
				array(
					'icon'       => 'el-icon-picture',
					'icon_class' => 'icon',
					'title'      => esc_html__( 'Recipe', 'efarm' ),
					'fields'     => array(
						array(
							'id'   => '2',
							'type' => 'info',
							'desc' => esc_html__( 'Recipe Archive Page', 'efarm' ),
						),
						array(
							'id'     => 'section-start',
							'type'   => 'section',
							'title'  => esc_html__( 'Changing recipe slug', 'efarm' ),
							'indent' => true,
						),
						array(
							'id'       => 'recipe_slug',
							'type'     => 'text',
							'title'    => esc_html__( 'Custom Slug', 'efarm' ),
							'subtitle' => esc_html__( 'If you want your recipe post type to have a custom slug in the url, please enter it here.', 'efarm' ),
							'desc'     => esc_html__(
								'You will still have to refresh your permalinks after saving this! 
													This is done by going to Settings > Permalinks and clicking save.',
								'efarm'
							),
							'validate' => 'str_replace',
							'str'      => array(
								'search'      => ' ',
								'replacement' => '-',
							),
							'default'  => 'recipes',
						),
						array(
							'id'       => 'recipe_cat_slug',
							'type'     => 'text',
							'title'    => esc_html__( 'Custom Slug for Recipe category', 'efarm' ),
							'subtitle' => esc_html__( 'If you want your recipe category to have a custom slug in the url, please enter it here.', 'efarm' ),
							'desc'     => esc_html__(
								'You will still have to refresh your permalinks after saving this! 
    This is done by going to Settings > Permalinks and clicking save.',
								'efarm'
							),
							'validate' => 'str_replace',
							'str'      => array(
								'search'      => ' ',
								'replacement' => '-',
							),
							'default'  => 'recipe_cat',
						),
						array(
							'id'     => 'section-end',
							'type'   => 'section',
							'indent' => false,
						),
						array(
							'id'   => '3',
							'type' => 'info',
							'desc' => esc_html__( 'The below options is also available in each Recipe Category. Please go to Recipes > Recipe Category and edit a category for more detail. The selections in each category will have higher priority than below general selections', 'efarm' ),
						),
						array(
							'id'      => 'recipe-layout',
							'type'    => 'button_set',
							'title'   => esc_html__( 'Layout', 'efarm' ),
							'options' => $page_layout,
							'default' => 'fullwidth',
						),
						array(
							'id'      => 'left-recipe-sidebar',
							'type'    => 'select',
							'title'   => esc_html__( 'Select Left Sidebar', 'efarm' ),
							'data'    => 'sidebars',
							'default' => '',
						),
						array(
							'id'      => 'right-recipe-sidebar',
							'type'    => 'select',
							'title'   => esc_html__( 'Select Right Sidebar', 'efarm' ),
							'data'    => 'sidebars',
							'default' => '',
						),
						array(
							'id'      => 'recipe-search',
							'type'    => 'switch',
							'title'   => esc_html__( 'Show Search', 'efarm' ),
							'default' => true,
							'on'      => esc_html__( 'Yes', 'efarm' ),
							'off'     => esc_html__( 'No', 'efarm' ),
						),
						array(
							'id'      => 'recipe-layout-version',
							'type'    => 'button_set',
							'title'   => esc_html__( 'Recipe Layout', 'efarm' ),
							'options' => apr_page_recipe_layouts(),
							'default' => 'list',
						),
						array(
							'id'       => 'recipe-layout-columns',
							'type'     => 'button_set',
							'title'    => esc_html__( 'Recipe Columns', 'efarm' ),
							'options'  => apr_page_recipe_columns(),
							'default'  => '2',
							'required' => array(
								'recipe-layout-version',
								'equals',
								array(
									'grid',
								),
							),
						),
						array(
							'id'      => 'recipe_per_page',
							'type'    => 'spinner',
							'title'   => esc_html__( 'Recipe show per page', 'efarm' ),
							'default' => '6',
							'min'     => '1',
							'step'    => '1',
							'max'     => '50',
						),
						array(
							'id'      => 'recipe_pagination',
							'type'    => 'button_set',
							'title'   => esc_html__( 'Pagination type', 'efarm' ),
							'options' => array(
								'1' => esc_html__( 'Load more', 'efarm' ),
								'2' => esc_html__( 'Next/Prev', 'efarm' ),
								'3' => esc_html__( 'Number', 'efarm' ),
							),
							'default' => '3',
						),
						array(
							'id'      => 'recipe-meta',
							'type'    => 'button_set',
							'title'   => esc_html__( 'Recipe Meta', 'efarm' ),
							'multi'   => true,
							'options' => array(
								'author'  => esc_html__( 'Author', 'efarm' ),
								'comment' => esc_html__( 'Comment', 'efarm' ),
								'date'    => esc_html__( 'Date', 'efarm' ),
								'like'    => esc_html__( 'Like', 'efarm' ),
								'cat'     => esc_html__( 'Categories', 'efarm' ),
								'tag'     => esc_html__( 'Tags', 'efarm' ),
							),
							'default' => array( 'author', 'like' ),
						),
					),
				),
				array(
					'subsection' => true,
					'title'      => esc_html__( 'Single Recipe', 'efarm' ),
					'fields'     => array(
						array(
							'id'      => 'recipe-tab',
							'type'    => 'button_set',
							'title'   => esc_html__( 'Recipe tabs', 'efarm' ),
							'multi'   => true,
							'options' => array(
								'comment' => esc_html__( 'Comment', 'efarm' ),
								'share'   => esc_html__( 'Share', 'efarm' ),
								'print'   => esc_html__( 'Print', 'efarm' ),
								'content' => esc_html__( 'Content', 'efarm' ),
							),
							'default' => array( 'comment', 'share', 'print', 'content' ),
						),
						array(
							'id'      => 'recipe-share',
							'type'    => 'button_set',
							'title'   => esc_html__( 'Recipe Share Links', 'efarm' ),
							'multi'   => true,
							'options' => array(
								'facebook' => esc_html__( 'Facebook', 'efarm' ),
								'twitter'  => esc_html__( 'Twitter', 'efarm' ),
								'pin'      => esc_html__( 'Pinterest', 'efarm' ),
								'google'   => esc_html__( 'Goolge', 'efarm' ),
								'linkin'   => esc_html__( 'Linkedin', 'efarm' ),
							),
						),
						array(
							'id'       => 'recipe_print_shortcode',
							'type'     => 'text',
							'title'    => esc_html__( 'Print button shortcode', 'efarm' ),
							'subtitle' => esc_html__( 'Add shortcode for print button here. Default [print_button]', 'efarm' ),
							'default'  => '[print_button]',
						),
						array(
							'id'      => 'print_direction',
							'type'    => 'switch',
							'title'   => esc_html__( 'Display print button for recipe directions', 'efarm' ),
							'default' => true,
							'on'      => esc_html__( 'Yes', 'efarm' ),
							'off'     => esc_html__( 'No', 'efarm' ),
						),

					),
				),
				array(
					'icon'       => 'el-icon-picture',
					'icon_class' => 'icon',
					'title'      => esc_html__( 'Knowledge', 'efarm' ),
					'fields'     => array(
						array(
							'id'   => '2',
							'type' => 'info',
							'desc' => esc_html__( 'Knowledge Archive Page', 'efarm' ),
						),
						array(
							'id'     => 'section-start',
							'type'   => 'section',
							'title'  => esc_html__( 'Changing knowledge slug', 'efarm' ),
							'indent' => true,
						),
						array(
							'id'       => 'knowledge_slug',
							'type'     => 'text',
							'title'    => esc_html__( 'Custom Slug', 'efarm' ),
							'subtitle' => esc_html__( 'If you want your knowledge post type to have a custom slug in the url, please enter it here.', 'efarm' ),
							'desc'     => esc_html__(
								'You will still have to refresh your permalinks after saving this! 
													This is done by going to Settings > Permalinks and clicking save.',
								'efarm'
							),
							'validate' => 'str_replace',
							'str'      => array(
								'search'      => ' ',
								'replacement' => '-',
							),
							'default'  => 'knowledge',
						),
						array(
							'id'       => 'knowledge_cat_slug',
							'type'     => 'text',
							'title'    => esc_html__( 'Custom Slug for knowledge category', 'efarm' ),
							'subtitle' => esc_html__( 'If you want your knowledge category to have a custom slug in the url, please enter it here.', 'efarm' ),
							'desc'     => esc_html__(
								'You will still have to refresh your permalinks after saving this! 
    This is done by going to Settings > Permalinks and clicking save.',
								'efarm'
							),
							'validate' => 'str_replace',
							'str'      => array(
								'search'      => ' ',
								'replacement' => '-',
							),
							'default'  => 'knowledge_cat',
						),
						array(
							'id'     => 'section-end',
							'type'   => 'section',
							'indent' => false,
						),
						array(
							'id'   => '3',
							'type' => 'info',
							'desc' => esc_html__( 'The below options is also available in each Knowledge Category. Please go to Knowledge > Knowledge Category and edit a category for more detail. The selections in each category will have higher priority than below general selections', 'efarm' ),
						),
						array(
							'id'      => 'knowledge-layout',
							'type'    => 'button_set',
							'title'   => esc_html__( 'Layout', 'efarm' ),
							'options' => $page_layout,
							'default' => 'fullwidth',
						),
						array(
							'id'      => 'left-knowledge-sidebar',
							'type'    => 'select',
							'title'   => esc_html__( 'Select Left Sidebar', 'efarm' ),
							'data'    => 'sidebars',
							'default' => '',
						),
						array(
							'id'      => 'right-knowledge-sidebar',
							'type'    => 'select',
							'title'   => esc_html__( 'Select Right Sidebar', 'efarm' ),
							'data'    => 'sidebars',
							'default' => '',
						),
						array(
							'id'      => 'knowledge-layout-version',
							'type'    => 'button_set',
							'title'   => esc_html__( 'Knowledge Layout', 'efarm' ),
							'options' => apr_page_knowledge_layouts(),
							'default' => 'grid',
						),
						array(
							'id'       => 'knowledge-layout-columns',
							'type'     => 'button_set',
							'title'    => esc_html__( 'Knowledge Columns', 'efarm' ),
							'options'  => apr_page_knowledge_columns(),
							'default'  => '3',
							'required' => array(
								'knowledge-layout-version',
								'equals',
								array(
									'grid',
								),
							),
						),
						array(
							'id'      => 'knowledge_per_page',
							'type'    => 'spinner',
							'title'   => esc_html__( 'Knowledge show per page', 'efarm' ),
							'default' => '12',
							'min'     => '1',
							'step'    => '1',
							'max'     => '50',
						),
						array(
							'id'      => 'knowledge_pagination',
							'type'    => 'button_set',
							'title'   => esc_html__( 'Pagination type', 'efarm' ),
							'options' => array(
								'1' => esc_html__( 'Load more', 'efarm' ),
								'2' => esc_html__( 'Next/Prev', 'efarm' ),
								'3' => esc_html__( 'Number', 'efarm' ),
							),
							'default' => '1',
						),
						array(
							'id'      => 'knowledge-meta',
							'type'    => 'button_set',
							'title'   => esc_html__( 'Knowledge Meta', 'efarm' ),
							'multi'   => true,
							'options' => array(
								'author'  => esc_html__( 'Author', 'efarm' ),
								'comment' => esc_html__( 'Comment', 'efarm' ),
								'date'    => esc_html__( 'Date', 'efarm' ),
								'like'    => esc_html__( 'Like', 'efarm' ),
								'cat'     => esc_html__( 'Categories', 'efarm' ),
								'tag'     => esc_html__( 'Tags', 'efarm' ),
							),
							'default' => array( 'cat', 'like', 'comment', 'date' ),
						),
					),
				),
				array(
					'subsection' => true,
					'title'      => esc_html__( 'Single Knowledge', 'efarm' ),
					'fields'     => array(
						array(
							'id'      => 'knowledge-share',
							'type'    => 'button_set',
							'title'   => esc_html__( 'Knowledge Share Links', 'efarm' ),
							'multi'   => true,
							'options' => array(
								'facebook' => esc_html__( 'Facebook', 'efarm' ),
								'twitter'  => esc_html__( 'Twitter', 'efarm' ),
								'pin'      => esc_html__( 'Pinterest', 'efarm' ),
								'insta'    => esc_html__( 'Instagram', 'efarm' ),
							),
						),
					),
				),
				array(
					'icon'       => 'el-icon-picture',
					'icon_class' => 'icon',
					'title'      => esc_html__( 'Press Media', 'efarm' ),
					'fields'     => array(
						array(
							'id'   => '2',
							'type' => 'info',
							'desc' => esc_html__( 'Press Media Archive Page', 'efarm' ),
						),
						array(
							'id'     => 'section-start',
							'type'   => 'section',
							'title'  => esc_html__( 'Changing press media slug', 'efarm' ),
							'indent' => true,
						),
						array(
							'id'       => 'press_slug',
							'type'     => 'text',
							'title'    => esc_html__( 'Custom Slug', 'efarm' ),
							'subtitle' => esc_html__( 'If you want your press media post type to have a custom slug in the url, please enter it here.', 'efarm' ),
							'desc'     => esc_html__(
								'You will still have to refresh your permalinks after saving this! 
                                                    This is done by going to Settings > Permalinks and clicking save.',
								'efarm'
							),
							'validate' => 'str_replace',
							'str'      => array(
								'search'      => ' ',
								'replacement' => '-',
							),
							'default'  => 'press',
						),
						array(
							'id'       => 'press_cat_slug',
							'type'     => 'text',
							'title'    => esc_html__( 'Custom Slug for press media category', 'efarm' ),
							'subtitle' => esc_html__( 'If you want your press media category to have a custom slug in the url, please enter it here.', 'efarm' ),
							'desc'     => esc_html__(
								'You will still have to refresh your permalinks after saving this! 
    This is done by going to Settings > Permalinks and clicking save.',
								'efarm'
							),
							'validate' => 'str_replace',
							'str'      => array(
								'search'      => ' ',
								'replacement' => '-',
							),
							'default'  => 'press_cat',
						),
						array(
							'id'     => 'section-end',
							'type'   => 'section',
							'indent' => false,
						),
						array(
							'id'   => '3',
							'type' => 'info',
							'desc' => esc_html__( 'The below options is also available in each Press Media Category. Please go to Press Media > Press Media Category and edit a category for more detail. The selections in each category will have higher priority than below general selections', 'efarm' ),
						),
						array(
							'id'      => 'press-layout',
							'type'    => 'button_set',
							'title'   => esc_html__( 'Layout', 'efarm' ),
							'options' => $page_layout,
							'default' => 'fullwidth',
						),
						array(
							'id'      => 'left-press-sidebar',
							'type'    => 'select',
							'title'   => esc_html__( 'Select Left Sidebar', 'efarm' ),
							'data'    => 'sidebars',
							'default' => '',
						),
						array(
							'id'      => 'right-press-sidebar',
							'type'    => 'select',
							'title'   => esc_html__( 'Select Right Sidebar', 'efarm' ),
							'data'    => 'sidebars',
							'default' => '',
						),
						array(
							'id'      => 'press-layout-version',
							'type'    => 'button_set',
							'title'   => esc_html__( 'Press Media Layout', 'efarm' ),
							'options' => apr_page_press_layouts(),
							'default' => 'masonry',
						),
						array(
							'id'       => 'press-layout-columns',
							'type'     => 'button_set',
							'title'    => esc_html__( 'Press Media Columns', 'efarm' ),
							'options'  => apr_page_press_columns(),
							'default'  => '3',
							'required' => array(
								'press-layout-version',
								'equals',
								array(
									'grid',
									'masonry',
								),
							),
						),
						array(
							'id'      => 'press_per_page',
							'type'    => 'spinner',
							'title'   => esc_html__( 'Press media show per page', 'efarm' ),
							'default' => '9',
							'min'     => '1',
							'step'    => '1',
							'max'     => '50',
						),
						array(
							'id'      => 'press_show_all',
							'type'    => 'switch',
							'title'   => esc_html__( 'Show/Hiden all filter', 'efarm' ),
							'default' => false,
							'on'      => esc_html__( 'Yes', 'efarm' ),
							'off'     => esc_html__( 'No', 'efarm' ),
						),
						array(
							'id'      => 'press_pagination',
							'type'    => 'button_set',
							'title'   => esc_html__( 'Pagination type', 'efarm' ),
							'options' => array(
								'1' => esc_html__( 'Load more', 'efarm' ),
								'2' => esc_html__( 'Next/Prev', 'efarm' ),
								'3' => esc_html__( 'Number', 'efarm' ),
							),
							'default' => '1',
						),
						array(
							'id'      => 'press-meta',
							'type'    => 'button_set',
							'title'   => esc_html__( 'Press Media Meta', 'efarm' ),
							'multi'   => true,
							'options' => array(
								'author'  => esc_html__( 'Author', 'efarm' ),
								'comment' => esc_html__( 'Comment', 'efarm' ),
								'date'    => esc_html__( 'Date', 'efarm' ),
								'like'    => esc_html__( 'Like', 'efarm' ),
								'cat'     => esc_html__( 'Categories', 'efarm' ),
								'tag'     => esc_html__( 'Tags', 'efarm' ),
							),
							'default' => array( 'cat', 'date' ),
						),
						array(
							'id'      => 'select-slider',
							'type'    => 'select',
							'title'   => esc_html__( 'Select Banner Bottom', 'efarm' ),
							'options' => $apr_seclect_banner,
							'desc'    => esc_html__( 'Choose a static block to display at the top of pages. You can create a block in Static Block/Add New.', 'efarm' ),
							'default' => '',
						),
					),
				),
				array(
					'subsection' => true,
					'title'      => esc_html__( 'Single Press Media', 'efarm' ),
					'fields'     => array(
						array(
							'id'      => 'press-share',
							'type'    => 'button_set',
							'title'   => esc_html__( 'Press Media Share Links', 'efarm' ),
							'multi'   => true,
							'options' => array(
								'facebook' => esc_html__( 'Facebook', 'efarm' ),
								'twitter'  => esc_html__( 'Twitter', 'efarm' ),
								'pin'      => esc_html__( 'Pinterest', 'efarm' ),
								'insta'    => esc_html__( 'Instagram', 'efarm' ),
							),
						),
					),
				),
				array(
					'icon'       => 'el-icon-shopping-cart',
					'icon_class' => 'icon',
					'title'      => esc_html__( 'Shop', 'efarm' ),
					'fields'     => array(
						array(
							'id'      => 'product-categories',
							'type'    => 'switch',
							'title'   => esc_html__( 'Show Slider', 'efarm' ),
							'default' => true,
							'on'      => esc_html__( 'Yes', 'efarm' ),
							'off'     => esc_html__( 'No', 'efarm' ),
						),
						array(
							'id'       => 'number-cate',
							'type'     => 'text',
							'title'    => esc_html__( 'Show Number Slide Categories Desktop', 'efarm' ),
							'default'  => '4',
							'required' => array(
								'product-categories',
								'equals',
								array(
									true,
								),
							),
						),
						array(
							'id'      => 'product-cart',
							'type'    => 'switch',
							'title'   => esc_html__( 'Show Add to Cart button', 'efarm' ),
							'default' => true,
							'on'      => esc_html__( 'Yes', 'efarm' ),
							'off'     => esc_html__( 'No', 'efarm' ),
						),
						array(
							'id'      => 'product-price',
							'type'    => 'switch',
							'title'   => esc_html__( 'Show Product Price', 'efarm' ),
							'default' => true,
							'on'      => esc_html__( 'Yes', 'efarm' ),
							'off'     => esc_html__( 'No', 'efarm' ),
						),
						array(
							'id'      => 'product-label',
							'type'    => 'switch',
							'title'   => esc_html__( 'Show Product Label', 'efarm' ),
							'default' => false,
							'on'      => esc_html__( 'Yes', 'efarm' ),
							'off'     => esc_html__( 'No', 'efarm' ),
						),
					),
				),
				array(
					'icon_class' => 'icon',
					'subsection' => true,
					'title'      => esc_html__( 'Product listing', 'efarm' ),
					'fields'     => array(
						array(
							'id'   => '1',
							'type' => 'info',
							'desc' => esc_html__( 'Product listing', 'efarm' ),
						),
						array(
							'id'      => 'shop-layout',
							'type'    => 'button_set',
							'title'   => esc_html__( 'Layout', 'efarm' ),
							'options' => $page_layout,
							'default' => 'fullwidth',
						),
						array(
							'id'      => 'left-shop-sidebar',
							'type'    => 'select',
							'title'   => esc_html__( 'Select Left Sidebar', 'efarm' ),
							'data'    => 'sidebars',
							'default' => '',
						),
						array(
							'id'      => 'right-shop-sidebar',
							'type'    => 'select',
							'title'   => esc_html__( 'Select Right Sidebar', 'efarm' ),
							'data'    => 'sidebars',
							'default' => '',
						),
						array(
							'id'      => 'product-breadcrumb',
							'type'    => 'switch',
							'title'   => esc_html__( 'Show breadcrumb background following product category thumbnail', 'efarm' ),
							'default' => false,
							'on'      => esc_html__( 'Yes', 'efarm' ),
							'off'     => esc_html__( 'No', 'efarm' ),
							'desc'    => esc_html__( 'This option will work in product category page. If you uploaded product category thumbnail, the image will be displayed in breadcrumb part as background. Large image size will be recommended.', 'efarm' ),
						),
						array(
							'id'      => 'category-item',
							'type'    => 'text',
							'title'   => esc_html__( 'Products per Page', 'efarm' ),
							'desc'    => esc_html__( 'Comma separated list of product counts.', 'efarm' ),
							'default' => '8,16,24',
						),
						array(
							'id'      => 'product-layouts',
							'type'    => 'button_set',
							'title'   => esc_html__( 'Product Layouts', 'efarm' ),
							'options' => apr_product_type(),
							'default' => 'only-grid',
						),
						array(
							'id'       => 'product-cols',
							'type'     => 'button_set',
							'title'    => esc_html__( 'Product Columns', 'efarm' ),
							'options'  => apr_product_columns(),
							'default'  => '4',
							'required' => array(
								'product-layouts',
								'equals',
								array(
									'only-grid',
								),
							),
						),
						array(
							'id'      => 'product-quickview',
							'type'    => 'switch',
							'title'   => esc_html__( 'Show Quickview', 'efarm' ),
							'default' => true,
							'on'      => esc_html__( 'Yes', 'efarm' ),
							'off'     => esc_html__( 'No', 'efarm' ),
						),
						array(
							'id'      => 'product-compare',
							'type'    => 'switch',
							'title'   => esc_html__( 'Show Compare', 'efarm' ),
							'default' => true,
							'on'      => esc_html__( 'Yes', 'efarm' ),
							'off'     => esc_html__( 'No', 'efarm' ),
						),
						array(
							'id'      => 'product-wishlist',
							'type'    => 'switch',
							'title'   => esc_html__( 'Show Wishlist', 'efarm' ),
							'default' => true,
							'on'      => esc_html__( 'Yes', 'efarm' ),
							'off'     => esc_html__( 'No', 'efarm' ),
						),
						array(
							'id'      => 'product-rating',
							'type'    => 'switch',
							'title'   => esc_html__( 'Show Rating', 'efarm' ),
							'default' => false,
							'on'      => esc_html__( 'Yes', 'efarm' ),
							'off'     => esc_html__( 'No', 'efarm' ),
						),
						array(
							'id'      => 'product-hot',
							'type'    => 'switch',
							'title'   => esc_html__( 'Show "Hot" Label', 'efarm' ),
							'desc'    => esc_html__( 'Will be show in the featured product.', 'efarm' ),
							'default' => true,
							'on'      => esc_html__( 'Yes', 'efarm' ),
							'off'     => esc_html__( 'No', 'efarm' ),
						),
						array(
							'id'      => 'product-news',
							'type'    => 'switch',
							'title'   => esc_html__( 'Show "New" Label', 'efarm' ),
							'desc'    => esc_html__( 'Will be show in the recent product.', 'efarm' ),
							'default' => true,
							'on'      => esc_html__( 'Yes', 'efarm' ),
							'off'     => esc_html__( 'No', 'efarm' ),
						),
						array(
							'id'      => 'product-sale',
							'type'    => 'switch',
							'title'   => esc_html__( 'Show "Sale" Label', 'efarm' ),
							'desc'    => esc_html__( 'Will be show in the special product.', 'efarm' ),
							'default' => true,
							'on'      => esc_html__( 'Yes', 'efarm' ),
							'off'     => esc_html__( 'No', 'efarm' ),
						),
						array(
							'id'      => 'product-sale-percent',
							'type'    => 'switch',
							'title'   => esc_html__( 'Show Sale Price Percentage', 'efarm' ),
							'default' => false,
							'on'      => esc_html__( 'Yes', 'efarm' ),
							'off'     => esc_html__( 'No', 'efarm' ),
						),
					),
				),
				array(
					'icon_class' => 'icon',
					'subsection' => true,
					'title'      => esc_html__( 'Single Product', 'efarm' ),
					'fields'     => array(
						array(
							'id'      => 'single-product-layout',
							'type'    => 'button_set',
							'title'   => esc_html__( 'Layout', 'efarm' ),
							'options' => $page_layout,
							'default' => 'fullwidth',
						),
						array(
							'id'      => 'left-single-product-sidebar',
							'type'    => 'select',
							'title'   => esc_html__( 'Select Left Sidebar', 'efarm' ),
							'data'    => 'sidebars',
							'default' => '',
						),
						array(
							'id'      => 'right-single-product-sidebar',
							'type'    => 'select',
							'title'   => esc_html__( 'Select Right Sidebar', 'efarm' ),
							'data'    => 'sidebars',
							'default' => '',
						),
						array(
							'id'      => 'ajax-cart',
							'type'    => 'switch',
							'title'   => esc_html__( 'Show Ajax Add to cart', 'efarm' ),
							'default' => false,
							'on'      => esc_html__( 'Yes', 'efarm' ),
							'off'     => esc_html__( 'No', 'efarm' ),
						),
						array(
							'id'      => 'product-share',
							'type'    => 'switch',
							'title'   => esc_html__( 'Show Product share link', 'efarm' ),
							'default' => false,
							'on'      => esc_html__( 'Yes', 'efarm' ),
							'off'     => esc_html__( 'No', 'efarm' ),
						),
						array(
							'id'      => 'product-related',
							'type'    => 'switch',
							'title'   => esc_html__( 'Show Related Products', 'efarm' ),
							'default' => true,
							'on'      => esc_html__( 'Yes', 'efarm' ),
							'off'     => esc_html__( 'No', 'efarm' ),
						),
						array(
							'id'      => 'product-reviewtab',
							'type'    => 'switch',
							'title'   => esc_html__( 'Remove Product Review tab', 'efarm' ),
							'default' => false,
							'on'      => esc_html__( 'Yes', 'efarm' ),
							'off'     => esc_html__( 'No', 'efarm' ),
						),
						array(
							'id'      => 'product-destab',
							'type'    => 'switch',
							'title'   => esc_html__( 'Remove Product Description tab', 'efarm' ),
							'default' => false,
							'on'      => esc_html__( 'Yes', 'efarm' ),
							'off'     => esc_html__( 'No', 'efarm' ),
						),
						array(
							'id'      => 'product-infotab',
							'type'    => 'switch',
							'title'   => esc_html__( 'Remove Additional Information tab', 'efarm' ),
							'default' => false,
							'on'      => esc_html__( 'Yes', 'efarm' ),
							'off'     => esc_html__( 'No', 'efarm' ),
						),
						array(
							'id'      => 'product_tagtab',
							'type'    => 'switch',
							'title'   => esc_html__( 'Remove Tag Tab', 'efarm' ),
							'default' => false,
							'on'      => esc_html__( 'Yes', 'efarm' ),
							'off'     => esc_html__( 'No', 'efarm' ),
						),
						array(
							'id'      => 'product-reviewtab-name',
							'type'    => 'text',
							'title'   => esc_html__( 'Rename Product Review Tab', 'efarm' ),
							'default' => esc_html__( 'Reviews', 'efarm' ),
						),
						array(
							'id'      => 'product-destab-name',
							'type'    => 'text',
							'title'   => esc_html__( 'Rename Product Description Tab', 'efarm' ),
							'default' => esc_html__( 'Description', 'efarm' ),
						),
						array(
							'id'      => 'product-infotab-name',
							'type'    => 'text',
							'title'   => esc_html__( 'Rename Additional Information Tab', 'efarm' ),
							'default' => esc_html__( 'Additional Information', 'efarm' ),
						),
						array(
							'id'      => 'product-tagtab-name',
							'type'    => 'text',
							'title'   => esc_html__( 'Rename Tag Tab', 'efarm' ),
							'default' => esc_html__( 'Tags', 'efarm' ),
						),
					),
				),
				array(
					'icon'       => 'el-icon-cog',
					'icon_class' => 'icon',
					'title'      => esc_html__( '404 Page', 'efarm' ),
					'fields'     => array(
						array(
							'id'       => '404-bg-image',
							'type'     => 'media',
							'url'      => true,
							'readonly' => false,
							'title'    => esc_html__( 'Background image', 'efarm' ),
							'desc'     => esc_html__( 'Background image for 404 page', 'efarm' ),
							'default'  => array(
								'url' => get_template_directory_uri() . '/images/404.jpg',
							),
						),
						array(
							'id'      => '404-title',
							'type'    => 'text',
							'title'   => esc_html__( '404 title', 'efarm' ),
							'default' => esc_html__( '404', 'efarm' ),
						),
						array(
							'id'      => '404-content',
							'type'    => 'text',
							'title'   => esc_html__( '404 content', 'efarm' ),
							'default' => esc_html__( "The page you're looking for cannot be found", 'efarm' ),
						),
						array(
							'id'          => '404-color',
							'type'        => 'color',
							'title'       => esc_html__( 'Text color', 'efarm' ),
							'default'     => '#fff',
							'validate'    => 'color',
							'transparent' => false,
						),
						array(
							'id'      => '404_header',
							'type'    => 'image_select',
							'options' => $this->apr_header_types(),
							'default' => '3',
							'title'   => esc_html__( 'Header Type', 'efarm' ),
						),
						array(
							'id'      => '404_footer',
							'type'    => 'image_select',
							'options' => $this->apr_footer_types(),
							'default' => '1',
							'title'   => esc_html__( 'Footer Type', 'efarm' ),
						),
					),
				),
				array(
					'icon'       => 'el-icon-cog',
					'icon_class' => 'icon',
					'title'      => esc_html__( 'Coming soon', 'efarm' ),
					'fields'     => array(
						array(
							'id'      => 'coming_header_display',
							'type'    => 'switch',
							'title'   => esc_html__( 'Display header in coming soon page', 'efarm' ),
							'default' => false,
							'on'      => esc_html__( 'Yes', 'efarm' ),
							'off'     => esc_html__( 'No', 'efarm' ),
						),
						array(
							'id'       => 'coming_header',
							'type'     => 'image_select',
							'options'  => $this->apr_header_types(),
							'default'  => '6',
							'title'    => esc_html__( 'Header Type', 'efarm' ),
							'required' => array( 'coming_header_display', 'equals', true ),
						),
						array(
							'id'      => 'coming_footer_display',
							'type'    => 'switch',
							'title'   => esc_html__( 'Display footer in coming soon page', 'efarm' ),
							'default' => false,
							'on'      => esc_html__( 'Yes', 'efarm' ),
							'off'     => esc_html__( 'No', 'efarm' ),
						),
						array(
							'id'       => 'coming_footer',
							'type'     => 'image_select',
							'options'  => $this->apr_footer_types(),
							'default'  => '1',
							'title'    => esc_html__( 'Footer Type', 'efarm' ),
							'required' => array( 'coming_footer_display', 'equals', true ),
						),
						array(
							'id'       => 'under-bg-image',
							'type'     => 'media',
							'url'      => true,
							'readonly' => false,
							'title'    => esc_html__( 'Background image', 'efarm' ),
							'desc'     => esc_html__( 'Background image for coming soon page', 'efarm' ),
							'default'  => array(
								'url' => get_template_directory_uri() . '/images/coming-soon.jpg',
							),
						),
						array(
							'id'          => 'coming-overlay-color',
							'type'        => 'color',
							'title'       => esc_html__( 'Background overlay color', 'efarm' ),
							'default'     => '#000000',
							'validate'    => 'color',
							'transparent' => true,
						),
						array(
							'id'      => 'under-contr-title',
							'type'    => 'textarea',
							'title'   => esc_html__( 'Big Title', 'efarm' ),
							'default' => wp_kses(
								__( '<h3>Launching</h3><h2>Very soon</h2>', 'efarm' ),
								array(
									'a'  => array(
										'href'   => array( 'callto' => array() ),
										'title'  => array(),
										'target' => array(),
									),
									'i'  => array(
										'class'       => array(),
										'aria-hidden' => array(),
									),
									'h2' => array(
										'class' => array(),
									),
									'h3' => array(
										'class' => array(),
									),
								)
							),
						),
						array(
							'id'   => '1',
							'type' => 'info',
							'desc' => esc_html__( 'Countdown Timer', 'efarm' ),
						),
						array(
							'id'      => 'under-display-countdown',
							'type'    => 'switch',
							'title'   => esc_html__( 'Display countdown timer', 'efarm' ),
							'default' => true,
							'on'      => esc_html__( 'Yes', 'efarm' ),
							'off'     => esc_html__( 'No', 'efarm' ),
						),
						array(
							'id'       => 'under-end-date',
							'type'     => 'date',
							'title'    => esc_html__( 'End date', 'efarm' ),
							'default'  => '12/28/2017',
							'required' => array( 'under-display-countdown', 'equals', true ),
						),
						array(
							'id'      => 'under-contr-day',
							'type'    => 'text',
							'title'   => esc_html__( 'Text display under day number', 'efarm' ),
							'default' => esc_html__( 'D', 'efarm' ),
						),
						array(
							'id'      => 'under-contr-hour',
							'type'    => 'text',
							'title'   => esc_html__( 'Text display under hour number', 'efarm' ),
							'default' => esc_html__( 'H', 'efarm' ),
						),
						array(
							'id'      => 'under-contr-min',
							'type'    => 'text',
							'title'   => esc_html__( 'Text display under minute number', 'efarm' ),
							'default' => esc_html__( 'M', 'efarm' ),
						),
						array(
							'id'      => 'under-contr-sec',
							'type'    => 'text',
							'title'   => esc_html__( 'Text display under secs number', 'efarm' ),
							'default' => esc_html__( 'S', 'efarm' ),
						),
						array(
							'id'      => 'under-mail',
							'type'    => 'switch',
							'title'   => esc_html__( 'Display subcribe form', 'efarm' ),
							'default' => true,
							'on'      => esc_html__( 'Yes', 'efarm' ),
							'off'     => esc_html__( 'No', 'efarm' ),
						),
						array(
							'id'      => 'coming_subcribe_text',
							'type'    => 'text',
							'title'   => esc_html__( 'Submit button text in subcribe form', 'efarm' ),
							'default' => esc_html__( 'Notify me', 'efarm' ),
						),
					),
				),
			);

			return $sections;
		}

		protected function apr_add_header_section_options() {
			$apr_seclect_slider = apr_seclect_slider();
			unset( $apr_seclect_slider['default'] );
			$header = array(
				'icon'       => 'el-icon-edit',
				'icon_class' => 'icon',
				'title'      => esc_html__( 'Header', 'efarm' ),
				'fields'     => array(
					array(
						'id'       => 'header-type',
						'type'     => 'image_select',
						'title'    => esc_html__( 'Header Type', 'efarm' ),
						'subtitle' => esc_html__( 'Each page will have option for select header type. Header selection in each page will have higher priority than this general selection.', 'efarm' ),
						'options'  => $this->apr_header_types(),
						'default'  => '1',
					),
					array(
						'id'       => 'header-description',
						'type'     => 'textarea',
						'title'    => esc_html__( 'Header Description', 'efarm' ),
						'required' => array(
							'header-type',
							'equals',
							array(
								'1',
								'4',
								'5',
								'6',
								'7',
								'9',
							),
						),
					),
					array(
						'id'       => 'logo2',
						'type'     => 'media',
						'url'      => true,
						'readonly' => false,
						'title'    => esc_html__( 'Logo', 'efarm' ),
						'required' => array(
							array(
								'header-type',
								'equals',
								array(
									'3',
								),
							),
						),
						'default'  => array(
							'url'    => get_template_directory_uri() . '/images/logo2.png',
							'height' => 44,
							'wide'   => 132,
						),
					),
					array(
						'id'       => 'logo5',
						'type'     => 'media',
						'url'      => true,
						'readonly' => false,
						'title'    => esc_html__( 'Header logo', 'efarm' ),
						'required' => array(
							'header-type',
							'equals',
							array(
								'5',
							),
						),
						'default'  => array(
							'url' => get_template_directory_uri() . '/images/logo5.png',
						),
					),
					array(
						'id'       => 'logo6',
						'type'     => 'media',
						'url'      => true,
						'readonly' => false,
						'title'    => esc_html__( 'Header logo', 'efarm' ),
						'required' => array(
							'header-type',
							'equals',
							array(
								'6',
							),
						),
						'default'  => array(
							'url' => get_template_directory_uri() . '/images/logo6.png',
						),
					),
					array(
						'id'       => 'logo7',
						'type'     => 'media',
						'url'      => true,
						'readonly' => false,
						'title'    => esc_html__( 'Header logo', 'efarm' ),
						'required' => array(
							'header-type',
							'equals',
							array(
								'7',
							),
						),
						'default'  => array(
							'url' => get_template_directory_uri() . '/images/logo7.png',
						),
					),
					array(
						'id'       => 'logo9',
						'type'     => 'media',
						'url'      => true,
						'readonly' => false,
						'title'    => esc_html__( 'Header logo', 'efarm' ),
						'required' => array(
							'header-type',
							'equals',
							array(
								'9',
							),
						),
						'default'  => array(
							'url' => get_template_directory_uri() . '/images/logo9.png',
						),
					),
					array(
						'id'       => 'logo11',
						'type'     => 'media',
						'url'      => true,
						'readonly' => false,
						'title'    => esc_html__( 'Header logo', 'efarm' ),
						'required' => array(
							'header-type',
							'equals',
							array(
								'8',
							),
						),
						'default'  => array(
							'url' => get_template_directory_uri() . '/images/logo11.png',
						),
					),
					array(
						'id'       => 'select-slider',
						'type'     => 'select',
						'title'    => esc_html__( 'Select Top Slider', 'efarm' ),
						'options'  => $apr_seclect_slider,
						'desc'     => esc_html__( 'Choose a slider to display at the top of pages. You can create a block in Static Block/Add New.', 'efarm' ),
						'default'  => '',
						'required' => array(
							array(
								'header-type',
								'equals',
								array(
									'9',
								),
							),
						),
					),
					array(
						'id'      => 'header-fixed',
						'type'    => 'switch',
						'title'   => esc_html__( 'Enable Fixed Header (Header displays over content)', 'efarm' ),
						'default' => false,
					),
					array(
						'id'       => 'header-topheader',
						'type'     => 'switch',
						'title'    => esc_html__( 'Show Top Header', 'efarm' ),
						'default'  => true,
						'required' => array(
							array(
								'header-type',
								'equals',
								array(
									'1',
									'4',
									'5',
									'6',
									'7',
								),
							),
						),
					),
					array(
						'id'       => 'header-topheader-hidden',
						'type'     => 'switch',
						'title'    => esc_html__( 'Show Top Header', 'efarm' ),
						'default'  => false,
						'required' => array(
							array(
								'header-type',
								'equals',
								array(
									'8',
								),
							),
						),
					),
					array(
						'id'       => 'header-cate',
						'type'     => 'switch',
						'title'    => esc_html__( 'Show Categories', 'efarm' ),
						'default'  => true,
						'required' => array(
							array(
								'header-type',
								'equals',
								array(
									'5',
									'7',
								),
							),
						),
					),
					array(
						'id'      => 'header-search',
						'type'    => 'switch',
						'title'   => esc_html__( 'Show Search', 'efarm' ),
						'default' => true,
					),
					array(
						'id'          => 'header-search-icon',
						'type'        => 'text',
						'title'       => esc_html__( 'Icon Search', 'efarm' ),
						'default'     => 'pe-7s-search',
						'placeholder' => esc_html__( 'pe-7s-search', 'efarm' ),
						'required'    => array(
							'header-search',
							'equals',
							array(
								true,
							),
						),
						'desc'        => wp_kses(
							__( 'Add icon class you want here. You can find a lot of icons in these links <a target="_blank" href="http://fontawesome.io/icons/">Awesome icon</a> or <a target="_blank" href="https://linearicons.com/free">Linearicons </a>, <a target="_blank" href="http://themes-pixeden.com/font-demos/7-stroke/">Pe stroke icon7 </a> and <a target="_blank" href="https://www.dropbox.com/s/oy8lsb7u4eli7rt/barber_font.png?dl=0">Efarm icon list </a>', 'efarm' ),
							array(
								'a' => array(
									'href'   => array(),
									'target' => array(),
								),
							)
						),
					),
					array(
						'id'       => 'header-search-hidden',
						'type'     => 'switch',
						'title'    => esc_html__( 'Show Search', 'efarm' ),
						'default'  => false,
						'required' => array(
							array(
								'header-type',
								'equals',
								array(
									'8',
								),
							),
						),
					),
					array(
						'id'          => 'header-search-icon-hidden',
						'type'        => 'text',
						'title'       => esc_html__( 'Icon Search', 'efarm' ),
						'default'     => 'lnr lnr-magnifier',
						'placeholder' => esc_html__( 'lnr lnr-magnifier', 'efarm' ),
						'required'    => array(
							'header-search-hidden',
							'equals',
							array(
								true,
							),
						),
						'desc'        => wp_kses(
							__( 'Add icon class you want here. You can find a lot of icons in these links <a target="_blank" href="http://fontawesome.io/icons/">Awesome icon</a> or <a target="_blank" href="https://linearicons.com/free">Linearicons </a>, <a target="_blank" href="http://themes-pixeden.com/font-demos/7-stroke/">Pe stroke icon7 </a> and <a target="_blank" href="https://www.dropbox.com/s/oy8lsb7u4eli7rt/barber_font.png?dl=0">Efarm icon list </a>', 'efarm' ),
							array(
								'a' => array(
									'href'   => array(),
									'target' => array(),
								),
							)
						),
					),
					array(
						'id'       => 'header_search_style',
						'type'     => 'button_set',
						'title'    => esc_html__( 'Header Search Style', 'efarm' ),
						'options'  => array(
							'1' => esc_html__( 'Standard', 'efarm' ),
							'2' => esc_html__( 'Sidebar', 'efarm' ),
						),
						'default'  => '1',
						'required' => array(
							array(
								'header-type',
								'equals',
								array(
									'1',
								),
							),
						),
					),
					array(
						'id'       => 'header_search_style_2',
						'type'     => 'button_set',
						'title'    => esc_html__( 'Header Search Style', 'efarm' ),
						'options'  => array(
							'1' => esc_html__( 'Standard', 'efarm' ),
							'2' => esc_html__( 'Sidebar', 'efarm' ),
						),
						'default'  => '2',
						'required' => array(
							array(
								'header-type',
								'equals',
								array(
									'2',
									'4',
								),
							),
						),
					),
					array(
						'id'      => 'header_search_type',
						'type'    => 'button_set',
						'title'   => esc_html__( 'Header Search Type', 'efarm' ),
						'options' => array(
							'1' => esc_html__( 'Product (if Woocommerce enable)', 'efarm' ),
							'2' => esc_html__( 'Blog', 'efarm' ),
						),
						'default' => '1',
					),
					array(
						'id'      => 'enable_search_ajax',
						'type'    => 'switch',
						'title'   => esc_html__( 'Enable ajax search', 'efarm' ),
						'default' => true,
					),
					array(
						'id'       => 'header-minicart',
						'type'     => 'switch',
						'title'    => esc_html__( 'Show Mini Cart', 'efarm' ),
						'default'  => true,
						'required' => array(
							array(
								'header-type',
								'equals',
								array(
									'1',
									'2',
									'3',
									'4',
									'5',
									'7',
								),
							),
						),
					),
					array(
						'id'          => 'header-cart-icon',
						'type'        => 'text',
						'title'       => esc_html__( 'Icon Mini Cart', 'efarm' ),
						'default'     => 'pe-7s-cart',
						'placeholder' => esc_html__( 'pe-7s-cart', 'efarm' ),
						'required'    => array(
							'header-minicart',
							'equals',
							array(
								true,
							),
						),
						'desc'        => wp_kses(
							__( 'Add icon class you want here. You can find a lot of icons in these links <a target="_blank" href="http://fontawesome.io/icons/">Awesome icon</a> or <a target="_blank" href="https://linearicons.com/free">Linearicons </a>, <a target="_blank" href="http://themes-pixeden.com/font-demos/7-stroke/">Pe stroke icon7 </a> and <a target="_blank" href="https://www.dropbox.com/s/oy8lsb7u4eli7rt/barber_font.png?dl=0">Efarm icon list </a>', 'efarm' ),
							array(
								'a' => array(
									'href'   => array(),
									'target' => array(),
								),
							)
						),
					),
					array(
						'id'       => 'header-minicart-hidden',
						'type'     => 'switch',
						'title'    => esc_html__( 'Show Mini Cart', 'efarm' ),
						'default'  => false,
						'required' => array(
							array(
								'header-type',
								'equals',
								array(
									'8',
								),
							),
						),
					),
					array(
						'id'          => 'header-cart-icon-hidden',
						'type'        => 'text',
						'title'       => esc_html__( 'Icon Mini Cart', 'efarm' ),
						'placeholder' => esc_html__( 'icon-10', 'efarm' ),
						'default'     => 'icon-10',
						'required'    => array(
							'header-minicart-hidden',
							'equals',
							array(
								true,
							),
						),
						'desc'        => wp_kses(
							__( 'Add icon class you want here. You can find a lot of icons in these links <a target="_blank" href="http://fontawesome.io/icons/">Awesome icon</a> or <a target="_blank" href="https://linearicons.com/free">Linearicons </a>, <a target="_blank" href="http://themes-pixeden.com/font-demos/7-stroke/">Pe stroke icon7 </a> and <a target="_blank" href="https://www.dropbox.com/s/oy8lsb7u4eli7rt/barber_font.png?dl=0">Efarm icon list </a>', 'efarm' ),
							array(
								'a' => array(
									'href'   => array(),
									'target' => array(),
								),
							)
						),
					),
					array(
						'id'       => 'header-myaccount',
						'type'     => 'switch',
						'title'    => esc_html__( 'Show My Account', 'efarm' ),
						'default'  => false,
						'required' => array(
							array(
								'header-type',
								'equals',
								array(
									'1',
									'2',
								),
							),
						),
					),
					array(
						'id'          => 'header-myaccount-icon',
						'type'        => 'text',
						'title'       => esc_html__( 'Icon My Account', 'efarm' ),
						'placeholder' => esc_html__( 'lnr lnr-user', 'efarm' ),
						'default'     => 'lnr lnr-user',
						'required'    => array(
							'header-myaccount',
							'equals',
							array(
								true,
							),
						),
						'desc'        => wp_kses(
							__( 'Add icon class you want here. You can find a lot of icons in these links <a target="_blank" href="http://fontawesome.io/icons/">Awesome icon</a> or <a target="_blank" href="https://linearicons.com/free">Linearicons </a>, <a target="_blank" href="http://themes-pixeden.com/font-demos/7-stroke/">Pe stroke icon7 </a> and <a target="_blank" href="https://www.dropbox.com/s/oy8lsb7u4eli7rt/barber_font.png?dl=0">Efarm icon list </a>', 'efarm' ),
							array(
								'a' => array(
									'href'   => array(),
									'target' => array(),
								),
							)
						),
					),
					array(
						'id'      => 'header-social',
						'type'    => 'switch',
						'title'   => esc_html__( 'Show Social Link', 'efarm' ),
						'default' => false,
					),
					array(
						'id'          => 'social-header-twitter',
						'type'        => 'text',
						'title'       => esc_html__( 'Twitter', 'efarm' ),
						'placeholder' => esc_html__( 'http://', 'efarm' ),
						'required'    => array(
							'header-social',
							'equals',
							array(
								true,
							),
						),
					),
					array(
						'id'          => 'social-header-instagram',
						'type'        => 'text',
						'title'       => esc_html__( 'Instagram', 'efarm' ),
						'placeholder' => esc_html__( 'http://', 'efarm' ),
						'required'    => array(
							'header-social',
							'equals',
							array(
								true,
							),
						),
					),
					array(
						'id'          => 'social-header-facebook',
						'type'        => 'text',
						'title'       => esc_html__( 'Facebook', 'efarm' ),
						'placeholder' => esc_html__( 'http://', 'efarm' ),
						'required'    => array(
							'header-social',
							'equals',
							array(
								true,
							),
						),
					),
					array(
						'id'          => 'social-header-google',
						'type'        => 'text',
						'title'       => esc_html__( 'Google Plus', 'efarm' ),
						'placeholder' => esc_html__( 'http://', 'efarm' ),
						'required'    => array(
							'header-social',
							'equals',
							array(
								true,
							),
						),
					),
					array(
						'id'          => 'social-header-pinterest',
						'type'        => 'text',
						'title'       => esc_html__( 'Pinterest', 'efarm' ),
						'placeholder' => esc_html__( 'http://', 'efarm' ),
						'required'    => array(
							'header-social',
							'equals',
							array(
								true,
							),
						),
					),
					array(
						'id'      => 'header-sticky',
						'type'    => 'switch',
						'title'   => esc_html__( 'Enable Sticky', 'efarm' ),
						'default' => true,
					),
					array(
						'id'       => 'header-sticky-mobile',
						'type'     => 'switch',
						'required' => array( 'header-sticky', 'equals', 1 ),
						'title'    => esc_html__( 'Enable Sticky On Mobile ', 'efarm' ),
						'default'  => true,
					),
					array(
						'id'      => 'header_menu',
						'type'    => 'button_set',
						'title'   => esc_html__( 'Header Menu Mobile', 'efarm' ),
						'options' => array(
							'1' => esc_html__( 'Default', 'efarm' ),
							'2' => esc_html__( 'Style 2', 'efarm' ),
						),
						'default' => '1',
					),
					array(
						'id'      => 'mobile_account_tab',
						'type'    => 'switch',
						'title'   => esc_html__( '[Mobile] Enable Account tab ', 'efarm' ),
						'default' => true,
					),
					array(
						'id'      => 'header_postion',
						'type'    => 'button_set',
						'title'   => esc_html__( '[Mobile] Header Mobile Position', 'efarm' ),
						'options' => array(
							'1' => esc_html__( 'Top', 'efarm' ),
							'2' => esc_html__( 'Bottom', 'efarm' ),
						),
						'default' => '1',
					),
				),
			);

			return $header;
		}

		public function apr_get_setting_arguments() {
			$theme = wp_get_theme();
			$args  = array(
				// TYPICAL -> Change these values as you need/desire
				'opt_name'             => 'apr_settings',
				'display_name'         => esc_html__( 'Apr', 'efarm' ),
				'display_version'      => $theme->get( 'Version' ),
				'menu_type'            => 'menu',
				'allow_sub_menu'       => true,
				'menu_title'           => esc_html__( 'Apr Options', 'efarm' ),
				'page_title'           => esc_html__( 'Apr', 'efarm' ),
				'google_api_key'       => '',
				'google_update_weekly' => false,
				'async_typography'     => true,
				'admin_bar'            => true,
				'admin_bar_icon'       => 'dashicons-admin-generic',
				'admin_bar_priority'   => 50,
				'global_variable'      => '',
				'dev_mode'             => false,
				'update_notice'        => true,
				'customizer'           => false,
				'page_priority'        => null,
				'page_parent'          => 'themes.php',
				'page_permissions'     => 'manage_options',
				'menu_icon'            => '',
				'last_tab'             => '',
				'page_icon'            => 'icon-themes',
				'page_slug'            => '',
				'save_defaults'        => true,
				'default_show'         => false,
				'default_mark'         => '',
				'show_import_export'   => true,
				'transient_time'       => 60 * MINUTE_IN_SECONDS,
				'output'               => true,
				'output_tag'           => true,
				'database'             => '',
				'use_cdn'              => true,
				// HINTS
				'hints'                => array(
					'icon'          => 'el el-question-sign',
					'icon_position' => 'right',
					'icon_color'    => 'lightgray',
					'icon_size'     => 'normal',
					'tip_style'     => array(
						'color'   => 'red',
						'shadow'  => true,
						'rounded' => false,
						'style'   => '',
					),
					'tip_position'  => array(
						'my' => 'top left',
						'at' => 'bottom right',
					),
					'tip_effect'    => array(
						'show' => array(
							'effect'   => 'slide',
							'duration' => '500',
							'event'    => 'mouseover',
						),
						'hide' => array(
							'effect'   => 'slide',
							'duration' => '500',
							'event'    => 'click mouseleave',
						),
					),
				),
			);

			return $args;
		}

		protected function apr_header_types() {
			return array(
				'1' => array(
					'alt' => esc_html__( 'Header Type 1', 'efarm' ),
					'img' => get_template_directory_uri() . '/inc/admin/settings/headers/header-1.jpg',
				),
				'2' => array(
					'alt' => esc_html__( 'Header Type 2', 'efarm' ),
					'img' => get_template_directory_uri() . '/inc/admin/settings/headers/header-2.jpg',
				),
				'3' => array(
					'alt' => esc_html__( 'Header Type 3', 'efarm' ),
					'img' => get_template_directory_uri() . '/inc/admin/settings/headers/header-3.jpg',
				),
				'4' => array(
					'alt' => esc_html__( 'Header Type 4', 'efarm' ),
					'img' => get_template_directory_uri() . '/inc/admin/settings/headers/header-4.jpg',
				),
				'5' => array(
					'alt' => esc_html__( 'Header Type 5', 'efarm' ),
					'img' => get_template_directory_uri() . '/inc/admin/settings/headers/header-5.jpg',
				),
				'6' => array(
					'alt' => esc_html__( 'Header Type 6', 'efarm' ),
					'img' => get_template_directory_uri() . '/inc/admin/settings/headers/header-6.jpg',
				),
				'7' => array(
					'alt' => esc_html__( 'Header Type 7', 'efarm' ),
					'img' => get_template_directory_uri() . '/inc/admin/settings/headers/header-7.jpg',
				),
				'8' => array(
					'alt' => esc_html__( 'Header Type 8', 'efarm' ),
					'img' => get_template_directory_uri() . '/inc/admin/settings/headers/header-8.jpg',
				),
				'9' => array(
					'alt' => esc_html__( 'Header Type 9', 'efarm' ),
					'img' => get_template_directory_uri() . '/inc/admin/settings/headers/header-9.jpg',
				),
			);
		}

		protected function apr_footer_types() {
			return array(
				'1' => array(
					'alt' => esc_html__( 'Footer Type 1', 'efarm' ),
					'img' => get_template_directory_uri() . '/inc/admin/settings/footers/footer-1.jpg',
				),
				'2' => array(
					'alt' => esc_html__( 'Footer Type 2', 'efarm' ),
					'img' => get_template_directory_uri() . '/inc/admin/settings/footers/footer-2.jpg',
				),
				'3' => array(
					'alt' => esc_html__( 'Footer Type 3', 'efarm' ),
					'img' => get_template_directory_uri() . '/inc/admin/settings/footers/footer-3.jpg',
				),
				'4' => array(
					'alt' => esc_html__( 'Footer Type 4', 'efarm' ),
					'img' => get_template_directory_uri() . '/inc/admin/settings/footers/footer-4.jpg',
				),
			);
		}

		protected function apr_preload_types() {
			return array(
				'1' => array(
					'alt' => esc_html__( 'Preload Type 1', 'efarm' ),
					'img' => get_template_directory_uri() . '/inc/admin/settings/preload/preload-1.jpg',
				),
				'2' => array(
					'alt' => esc_html__( 'Preload Type 2', 'efarm' ),
					'img' => get_template_directory_uri() . '/inc/admin/settings/preload/preload-2.jpg',
				),
				'3' => array(
					'alt' => esc_html__( 'Preload Type 3', 'efarm' ),
					'img' => get_template_directory_uri() . '/inc/admin/settings/preload/preload-3.jpg',
				),
				'4' => array(
					'alt' => esc_html__( 'Preload Type 4', 'efarm' ),
					'img' => get_template_directory_uri() . '/inc/admin/settings/preload/preload-4.jpg',
				),
				'5' => array(
					'alt' => esc_html__( 'Preload Type 5', 'efarm' ),
					'img' => get_template_directory_uri() . '/inc/admin/settings/preload/preload-5.jpg',
				),
				'6' => array(
					'alt' => esc_html__( 'Preload Type 6', 'efarm' ),
					'img' => get_template_directory_uri() . '/inc/admin/settings/preload/preload-6.jpg',
				),
				'7' => array(
					'alt' => esc_html__( 'Preload Type 7', 'efarm' ),
					'img' => get_template_directory_uri() . '/inc/admin/settings/preload/preload-7.jpg',
				),
				'8' => array(
					'alt' => esc_html__( 'Preload Type 8', 'efarm' ),
					'img' => get_template_directory_uri() . '/inc/admin/settings/preload/preload-8.jpg',
				),
				'9' => array(
					'alt' => esc_html__( 'Preload Type 9', 'efarm' ),
					'img' => get_template_directory_uri() . '/inc/admin/settings/preload/preload-9.jpg',
				),
			);
		}
	}


	function apr_get_framework_settings() {
		global $aprReduxSettings;
		$aprReduxSettings = new Framework_Apr_Settings();

		return $aprReduxSettings;
	}

	apr_get_framework_settings();
}
