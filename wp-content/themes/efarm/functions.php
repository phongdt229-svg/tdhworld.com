<?php
define( 'APR_VERSION', '2.1.4' );
define( 'APR_LIB', get_template_directory() . '/inc' );
define( 'APR_ADMIN', APR_LIB . '/admin' );
define( 'APR_PLUGINS', APR_LIB . '/plugins' );
define( 'APR_WIDGETS', APR_LIB . '/widgets' );
define( 'APR_FUNCTIONS', APR_LIB . '/functions' );
define( 'APR_METABOXES', APR_FUNCTIONS . '/metaboxes' );
define( 'APR_CSS', get_template_directory_uri() . '/css' );
define( 'APR_JS', get_template_directory_uri() . '/js' ); 
define( 'ARROWPRESS_SHORTCODES_PARAMS', APR_LIB . '/shortcodes/params/' );
define( 'ARROWPRESS_SHORTCODES_TEMPLATES', APR_LIB . '/shortcodes/templates/' );  

require_once( APR_ADMIN . '/functions.php' );
require_once( APR_FUNCTIONS . '/functions.php' );
require_once( APR_FUNCTIONS . '/config_options.php' );
require_once( APR_FUNCTIONS . '/taxonomy_metabox.php' );

//APR_CORE_PATH
require APR_ADMIN . '/arrow-core-installer/installer.php';
// check with arrowcore 2.0
if ( defined( 'ARROWPRESS_CORE_VERSION' ) ) {
	require_once APR_ADMIN . '/plugins-require.php';
	require_once( APR_ADMIN . '/posttypes/apr-post-type.php' );
	require_once( APR_LIB . '/shortcodes/shortcode.php' );
	require_once( APR_WIDGETS . '/functions.php' );
	require_once APR_ADMIN . '/metabox/metabox.php';
	if ( function_exists( 'arrowpress_importer_files' ) ) {
		deactivate_plugins( 'arrowpress_importer/arrowpress-importer.php' );
	}
}
// Set up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 1140;
}

if ( ! function_exists( 'apr_setup' ) ) {

	function apr_setup() {
		load_theme_textdomain( 'efarm', get_template_directory() . '/languages' );
		add_editor_style( array( 'style.css', 'style_rtl.css' ) );
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-formats', array(
			'image', 'video', 'audio', 'quote', 'link', 'gallery',
		) );
		// register menus
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'efarm' ),
		) );
		add_theme_support( 'custom-header' );
		add_theme_support( 'custom-background' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'arrowpress-core' );
	}

}
add_action( 'after_setup_theme', 'apr_setup' );

add_action( 'admin_enqueue_scripts', 'apr_admin_scripts_css' );
function apr_admin_scripts_css() {
	if ( is_rtl() ) {
		wp_enqueue_style( 'apr_admin_rtl_css', APR_CSS . '/admin-rtl.css', false );
	} else {
		wp_enqueue_style( 'apr_admin_css', APR_CSS . '/admin.css', false );
	}
}

add_action( 'admin_enqueue_scripts', 'apr_admin_scripts_js' );
function apr_admin_scripts_js() {
	wp_register_script( 'apr_admin_js', APR_JS . '/un-minify/admin.js', array( 'common', 'jquery', 'media-upload', 'thickbox' ), APR_VERSION, true );
	wp_enqueue_script( 'apr_admin_js' );
	wp_localize_script( 'apr_admin_js', 'apr_params', array(
		'apr_version' => APR_VERSION,
	) );
}

function apr_fonts_url() {
	$font_url = '';
	if ( 'off' !== _x( 'on', 'Google font: on or off', 'efarm' ) ) {
		$font_url = add_query_arg( 'family', urlencode( 'Asap:400,500,700|Poppins:300,400,500,600,700|Open Sans:300,300i,400,400i,600,700|Oswald:300,400,500,600,700|Lato:300,400,700|Montserrat:300,400,500,600,700&subset=latin,latin-ext,vietnamese' ), "//fonts.googleapis.com/css" );
	}

	return $font_url;
}

//Disable all woocommerce styles
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

function apr_scripts_js() {
	global $apr_settings, $wp_query;
	$cat = $wp_query->get_queried_object();
	if ( isset( $cat->term_id ) ) {
		$woo_cat = $cat->term_id;
	} else {
		$woo_cat = '';
	}
	$shop_list      = '';
	$apr_woo_enable = '';
	if ( class_exists( 'WooCommerce' ) ) {
		$shop_list      = is_product_category();
		$apr_woo_enable = 'yes';
	}

	$product_list_mode = $apr_settings['product-layouts'];
	if ( is_tax( 'product_cat' ) ) {
		$product_list_mode = get_metadata( 'product_cat', $woo_cat, 'list_mode_product', true );
	}
	$apr_number_cate          = ( isset( $apr_settings['number-cate'] ) && $apr_settings['number-cate'] != '' ) ? $apr_settings['number-cate'] : '';
	$apr_product_categories   = ( isset( $apr_settings['product-categories'] ) && $apr_settings['product-categories'] != '' ) ? $apr_settings['product-categories'] : '';
	$header_sticky_mobile     = isset( $apr_settings['header-sticky-mobile'] ) ? $apr_settings['header-sticky-mobile'] : '';
	$apr_text_day             = ( isset( $apr_settings['under-contr-day'] ) && $apr_settings['under-contr-day'] != '' ) ? $apr_settings['under-contr-day'] : 'Days';
	$apr_text_hour            = ( isset( $apr_settings['under-contr-hour'] ) && $apr_settings['under-contr-hour'] != '' ) ? $apr_settings['under-contr-hour'] : 'Hours';
	$apr_text_min             = ( isset( $apr_settings['under-contr-min'] ) && $apr_settings['under-contr-min'] != '' ) ? $apr_settings['under-contr-min'] : 'Mins';
	$apr_text_sec             = ( isset( $apr_settings['under-contr-sec'] ) && $apr_settings['under-contr-sec'] != '' ) ? $apr_settings['under-contr-sec'] : 'Secs';
	$apr_coming_subcribe_text = ( isset( $apr_settings['coming_subcribe_text'] ) && $apr_settings['coming_subcribe_text'] != '' ) ? $apr_settings['coming_subcribe_text'] : '';
	$apr_ajax_cart            = ( isset( $apr_settings['ajax-cart'] ) && $apr_settings['ajax-cart'] != '' ) ? $apr_settings['ajax-cart'] : '';
	// comment reply
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	// Loads our main js.

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), APR_VERSION, true );
	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array( 'jquery' ), APR_VERSION, true );
	wp_enqueue_script( 'isotop-imageloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array(), APR_VERSION, true );
	wp_enqueue_script( 'print-this', get_template_directory_uri() . '/js/printThis.js', array( 'jquery' ), APR_VERSION, true );
	wp_enqueue_script( 'isotope-packery', get_template_directory_uri() . '/js/packery-mode.pkgd.min.js', array( 'jquery' ), APR_VERSION, true );
	wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/js/jquery.fancybox.min.js', array( 'jquery' ), APR_VERSION, true );
	wp_enqueue_script( 'owlcarousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), APR_VERSION, true );
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/slick.min.js', array( 'jquery' ), APR_VERSION, true );

	wp_enqueue_script( 'countdown', get_template_directory_uri() . '/js/jquery.countdown.min.js', array( 'jquery' ), APR_VERSION, true );
	wp_enqueue_script( 'scrollreveal', get_template_directory_uri() . '/js/un-minify/scrollReveal.js', array( 'jquery' ), APR_VERSION, true );
	wp_enqueue_script( 'elevate-zoom', get_template_directory_uri() . '/js/un-minify/jquery.elevatezoom.js', array( 'jquery' ), APR_VERSION, true );
	wp_enqueue_script( 'appear', get_template_directory_uri() . '/js/un-minify/appear.js', array( 'jquery' ), APR_VERSION, true );

	wp_enqueue_script( 'validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array( 'jquery' ), APR_VERSION );
	if ( is_rtl() ) {
		wp_enqueue_script( 'apr-custom-rtl', get_template_directory_uri() . '/js/un-minify/custom-rtl.js', array( 'jquery' ), APR_VERSION, true );
	} else {
		wp_enqueue_script( 'apr-custom', get_template_directory_uri() . '/js/un-minify/custom.js', array( 'jquery' ), APR_VERSION, true );
	}
	wp_enqueue_script( 'apr-script', get_template_directory_uri() . '/js/un-minify/apr_theme.js', array( 'jquery' ), APR_VERSION, true );
	if ( isset( $apr_settings['js-code'] ) ) {
		wp_add_inline_script( 'apr-script', $apr_settings['js-code'] );
	}
	wp_localize_script( 'apr-script', 'apr_params', array(
		'ajax_url'                 => esc_js( admin_url( 'admin-ajax.php' ) ),
		'ajax_loader_url'          => esc_js( str_replace( array( 'http:', 'https' ), array( '', '' ), APR_CSS . '/images/ajax-loader.gif' ) ),
		'ajax_cart_added_msg'      => esc_html__( 'A product has been added to cart.', 'efarm' ),
		'ajax_compare_added_msg'   => esc_html__( 'A product has been added to compare', 'efarm' ),
		'apr_woo_enable'           => esc_js( $apr_woo_enable ),
		'ajax_cart_single'         => $apr_ajax_cart,
		'type_product'             => $product_list_mode,
		'shop_list'                => $shop_list,
		'apr_number_cate'          => $apr_number_cate,
		'apr_product_categories'   => $apr_product_categories,
		'under_end_date'           => $apr_settings['under-end-date'],
		'apr_text_day'             => $apr_text_day,
		'apr_text_hour'            => $apr_text_hour,
		'apr_text_min'             => $apr_text_min,
		'apr_text_sec'             => $apr_text_sec,
		'apr_like_text'            => esc_html__( 'Like', 'efarm' ),
		'apr_unlike_text'          => esc_html__( 'Unlike', 'efarm' ),
		'apr_coming_subcribe_text' => $apr_coming_subcribe_text,
		'header_sticky'            => $apr_settings['header-sticky'],
		'header_sticky_mobile'     => $header_sticky_mobile,
		'request_error'            => esc_html__( 'The requested content cannot be loaded. Please try again later.', 'efarm' ),
		'popup_close'              => esc_html__( 'Close', 'efarm' ),
		'popup_prev'               => esc_html__( 'Previous', 'efarm' ),
		'popup_next'               => esc_html__( 'Next', 'efarm' ),
	) );
}

add_action( 'wp_enqueue_scripts', 'apr_scripts_js' );
function apr_override_mce_options( $initArray ) {
	$opts                                 = '*[*]';
	$initArray['valid_elements']          = $opts;
	$initArray['extended_valid_elements'] = $opts;

	return $initArray;
}

add_filter( 'tiny_mce_before_init', 'apr_override_mce_options' );
