<?php

if ( ! class_exists( 'ReduxFramework' ) && file_exists( APR_ADMIN . '/ReduxCore/framework.php' ) ) {
	require_once( APR_ADMIN . '/ReduxCore/framework.php' );
}
require_once( APR_ADMIN . '/settings/config_custom_style.php' );
require_once( APR_ADMIN . '/settings/settings.php' );
require_once( APR_ADMIN . '/settings/save_settings.php' );
require_once( APR_ADMIN . '/user-profile.php' );

function apr_check_theme_options() {
	// check default options
	global $apr_settings;
	if ( ! get_option( 'apr_settings' ) ) {
		ob_start();
		include( APR_PLUGINS . '/theme_options.php' );
		$options              = ob_get_clean();
		$apr_default_settings = json_decode( $options, true );
		if ( is_array( $apr_default_settings ) || is_object( $apr_default_settings ) ) {
			foreach ( $apr_default_settings as $key => $value ) {
				if ( is_array( $value ) ) {
					foreach ( $value as $key1 => $value1 ) {
						if ( ! isset( $apr_settings[$key][$key1] ) || ! $apr_settings[$key][$key1] ) {
							$apr_settings[$key][$key1] = $apr_default_settings[$key][$key1];
						}
					}
				} else {
					if ( ! isset( $apr_settings[$key] ) ) {
						$apr_settings[$key] = $apr_default_settings[$key];
					}
				}
			}
		}
	}

	return $apr_settings;
}

if ( ! class_exists( 'ReduxFramework' ) ) {
	apr_check_theme_options();
}
//get theme layout options
function apr_layouts() {
	return array(
		'default'   => esc_html__( 'Default Layout', 'efarm' ),
		'wide'      => esc_html__( 'Wide', 'efarm' ),
		'fullwidth' => esc_html__( 'Full width', 'efarm' ),
		'boxed'     => esc_html__( 'Boxed', 'efarm' ),
	);
}

//get theme sidebar position options
function apr_sidebar_position() {
	return array(
		'default'       => esc_html__( 'Default Position', 'efarm' ),
		'left-sidebar'  => esc_html__( 'Left', 'efarm' ),
		'right-sidebar' => esc_html__( 'Right', 'efarm' ),
		'none'          => esc_html__( 'None', 'efarm' )
	);
}

function apr_rev_sliders_in_array() {
	if ( class_exists( 'RevSlider' ) ) {
		$theslider  = new RevSlider();
		$arrSliders = $theslider->getArrSliders();
		$arrA       = array();
		$arrT       = array();
		foreach ( $arrSliders as $slider ) {
			$arrA[] = $slider->getAlias();
			$arrT[] = $slider->getTitle();
		}
		if ( $arrA && $arrT ) {
			$result = array_combine( $arrA, $arrT );
		} else {
			$result = false;
		}

		return $result;
	}
}

//Apr popup
function apr_popup_layouts() {
	return array(
		'default' => esc_html__( 'Default Popup', 'efarm' ),
		'1'       => esc_html__( "Popup ", 'efarm' ),
	);
}

function apr_header_types() {
	return array(
		'default' => esc_html__( 'Default Header', 'efarm' ),
		'1'       => esc_html__( 'Header Type 1', 'efarm' ),
		'2'       => esc_html__( 'Header Type 2', 'efarm' ),
		'3'       => esc_html__( 'Header Type 3', 'efarm' ),
		'4'       => esc_html__( 'Header Type 4', 'efarm' ),
		'5'       => esc_html__( 'Header Type 5', 'efarm' ),
		'6'       => esc_html__( 'Header Type 6', 'efarm' ),
		'7'       => esc_html__( 'Header Type 7', 'efarm' ),
		'8'       => esc_html__( 'Header Type 8', 'efarm' ),
		'9'       => esc_html__( 'Header Type 9', 'efarm' ),
	);
}

function apr_seclect_slider() {
	$block_options = array();
	$args          = array(
		'numberposts' => - 1,
		'post_type'   => 'block',
		'post_status' => 'publish',
	);
	$posts         = get_posts( $args );
	foreach ( $posts as $_post ) {
		$block_options[$_post->ID] = $_post->post_title;

	}

	return $block_options;
}

function apr_header_positions() {
	return array(
		'default' => esc_html__( 'Default Position', 'efarm' ),
		'1'       => esc_html__( 'Top', 'efarm' ),
		'2'       => esc_html__( 'Bottom', 'efarm' ),
	);
}

function apr_preload_types() {
	return array(
		'default' => esc_html__( 'Default Preload', 'efarm' ),
		'1'       => esc_html__( 'Preload Type 1', 'efarm' ),
		'2'       => esc_html__( 'Preload Type 2', 'efarm' ),
		'3'       => esc_html__( 'Preload Type 3', 'efarm' ),
		'4'       => esc_html__( 'Preload Type 4', 'efarm' ),
		'5'       => esc_html__( 'Preload Type 5', 'efarm' ),
		'6'       => esc_html__( 'Preload Type 6', 'efarm' ),
		'7'       => esc_html__( 'Preload Type 7', 'efarm' ),
		'8'       => esc_html__( 'Preload Type 8', 'efarm' ),
		'9'       => esc_html__( 'Preload Type 9', 'efarm' ),
	);
}

function apr_list_menu() {
	$menus     = get_terms( 'nav_menu' );
	$menu_list = array();
	foreach ( $menus as $menu ) {
		$menu_list[$menu->term_id] = $menu->name . "";
	}

	return $menu_list;
}

function apr_footer_types() {
	return array(
		'default' => esc_html__( 'Default Footer', 'efarm' ),
		'1'       => esc_html__( 'Footer Type 1', 'efarm' ),
		'2'       => esc_html__( 'Footer Type 2', 'efarm' ),
		'3'       => esc_html__( 'Footer Type 3', 'efarm' ),
		'4'       => esc_html__( 'Footer Type 4', 'efarm' ),
	);
}

function apr_page_blog_layouts() {
	return array(
		"grid"    => esc_html__( "Grid", 'efarm' ),
		"list"    => esc_html__( "List", 'efarm' ),
		"masonry" => esc_html__( "Masonry", 'efarm' ),
		"packery" => esc_html__( "Packery", 'efarm' ),
	);
}

function apr_page_single_blog_layouts() {
	return array(
		"single-1" => esc_html__( "Single 1", 'efarm' ),
		"single-2" => esc_html__( "Single 2", 'efarm' ),
		"single-3" => esc_html__( "Single 3", 'efarm' ),
		"single-4" => esc_html__( "Single 4", 'efarm' ),
	);
}

function apr_page_blog_columns() {
	return array(
		"3" => esc_html__( "3 Columns", 'efarm' ),
		"1" => esc_html__( "1 Column", 'efarm' ),
		"2" => esc_html__( "2 Columns", 'efarm' ),
		"4" => esc_html__( "4 Columns", 'efarm' ),
	);
}

function apr_get_breadcrumbs_type() {
	return array(
		"type-1" => esc_html__( "Type 1", 'efarm' ),
		"type-2" => esc_html__( "Type 2", 'efarm' ),
		"type-3" => esc_html__( "Type 3", 'efarm' ),
	);
}

function apr_get_align() {
	return array(
		"left"   => esc_html__( "Left", 'efarm' ),
		"center" => esc_html__( "Center", 'efarm' ),
		"right"  => esc_html__( "Right", 'efarm' ),
	);
}

function apr_product_columns() {
	return array(
		"5" => esc_html__( "5", 'efarm' ),
		"4" => esc_html__( "4", 'efarm' ),
		"3" => esc_html__( "3", 'efarm' ),
		"2" => esc_html__( "2", 'efarm' ),
		"1" => esc_html__( "1", 'efarm' ),
	);
}

function apr_product_type() {
	return array(
		"only-grid" => esc_html__( "Grid", 'efarm' ),
		"only-list" => esc_html__( "List", 'efarm' ),
		//"grid-default" => esc_html__("Grid (default) / List", 'efarm'),
		//"list-default" => esc_html__("List (default) / Grid", 'efarm'),
	);
}

function apr_blog_columns() {
	return array(
		"2" => esc_html__( "2", 'efarm' ),
		"3" => esc_html__( "3", 'efarm' ),
		"4" => esc_html__( "4", 'efarm' ),
	);
}

function apr_gallery_columns() {
	return array(
		"3" => esc_html__( "3", 'efarm' ),
		"2" => esc_html__( "2", 'efarm' ),
		"4" => esc_html__( "4", 'efarm' ),
		"5" => esc_html__( "5", 'efarm' ),
	);
}

function apr_page_gallery_layouts() {
	return array(
		"1" => esc_html__( "Grid", 'efarm' ),
		"2" => esc_html__( "Masonry", 'efarm' ),
	);
}

function apr_gallery_style() {
	return array(
		"style1" => esc_html__( "Style 1", 'efarm' ),
		"style2" => esc_html__( "Style 2", 'efarm' ),
	);
}

function apr_get_block_name() {
	$block_options = array();
	$args          = array(
		'numberposts' => - 1,
		'post_type'   => 'block',
		'post_status' => 'publish',
	);
	$posts         = get_posts( $args );
	foreach ( $posts as $_post ) {
		$block_options[$_post->ID] = $_post->post_title;

	}

	return $block_options;
}

function apr_page_recipe_columns() {
	return array(
		"3" => esc_html__( "3", 'efarm' ),
		"2" => esc_html__( "2", 'efarm' ),
		"4" => esc_html__( "4", 'efarm' ),
	);
}

function apr_page_recipe_layouts() {
	return array(
		"list" => esc_html__( "List", 'efarm' ),
		"grid" => esc_html__( "Grid", 'efarm' ),
	);
}

function apr_page_knowledge_columns() {
	return array(
		"3" => esc_html__( "3", 'efarm' ),
		"2" => esc_html__( "2", 'efarm' ),
		"4" => esc_html__( "4", 'efarm' ),
	);
}

function apr_page_knowledge_layouts() {
	return array(
		"list" => esc_html__( "List", 'efarm' ),
		"grid" => esc_html__( "Grid", 'efarm' ),
	);
}

function apr_page_press_columns() {
	return array(
		"3" => esc_html__( "3", 'efarm' ),
		"2" => esc_html__( "2", 'efarm' ),
		"4" => esc_html__( "4", 'efarm' ),
	);
}

function apr_page_press_layouts() {
	return array(
		"grid"    => esc_html__( "Grid", 'efarm' ),
		"masonry" => esc_html__( "Masonry", 'efarm' ),
	);
}

function apr_book_get_services() {
	$block_options = array();
	$args          = array(
		'numberposts' => - 1,
		'post_type'   => 'services',
		'post_status' => 'publish',
	);
	$posts         = get_posts( $args );
	foreach ( $posts as $_post ) {
		$block_options[$_post->ID] = $_post->post_title;
	}

	return $block_options;
}
