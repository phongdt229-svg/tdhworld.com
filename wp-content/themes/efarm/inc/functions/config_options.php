<?php
function apr_scripts_styles() {
	wp_enqueue_style( 'apr-fonts', apr_fonts_url(), array(), null ); 
	//Load font icon css
	wp_enqueue_style( 'apr-font-awesomes', get_template_directory_uri() . '/css/font-awesome5.min.css', array(), APR_VERSION );
	wp_enqueue_style('font-awesome-4-shim', get_template_directory_uri() . '/css/v4-shims.css', array(), APR_VERSION);
	wp_enqueue_style( 'apr-font-common', get_template_directory_uri() . '/css/icomoon.css', array(), APR_VERSION );
	wp_enqueue_style( 'dashicons', get_template_directory_uri() . '/css/dashicons.css', array(), APR_VERSION );
	wp_enqueue_style( 'pe-icon-7-stroke', get_template_directory_uri() . '/css/pe-icon/pe-icon-7-stroke.css', array(), APR_VERSION );
	wp_enqueue_style( 'linearicons-free', get_template_directory_uri() . '/css/linearicons/linearicons.css', array(), APR_VERSION );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/plugin/bootstrap.min.css', array(), APR_VERSION );
	wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/css/plugin/jquery.fancybox.css', array(), APR_VERSION );
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/css/plugin/slick.css', array(), APR_VERSION );

	wp_enqueue_style( 'apr-animate', get_template_directory_uri() . '/css/animate.min.css', array(), APR_VERSION );
	if ( is_rtl() ) {
		//Load theme RTL css
		wp_enqueue_style( 'apr-theme-rtl', get_template_directory_uri() . '/css/theme_rtl.css', array(), APR_VERSION );
	} else {
		//Load theme css
		wp_enqueue_style( 'apr-themes', get_template_directory_uri() . '/css/theme.css', array(), APR_VERSION );
	}

	// Load skin stylesheet
	// wp_enqueue_style('apr-skin-theme', get_template_directory_uri() . '/css/config/skin.css', array(), APR_VERSION);

	// custom styles
	wp_deregister_style( 'apr-style' );
	wp_register_style( 'apr-style', get_template_directory_uri() . '/style.css',array(), APR_VERSION, 'all' );
	wp_enqueue_style( 'apr-style' );
	// css inline
 	$css_line = ':root{' . preg_replace( array( '/\s*(\w)\s*{\s*/', '/\s*(\S*:)(\s*)([^;]*)(\ s|\n)*;(\n|\s)*/', '/\n/', '/\s*}\s*/' ), array( '$1{ ', '$1$3;', "", '}' ),
			arrow_get_option_var_css() ) . '}';
	$css_line .= config_custom_style_css();
	wp_add_inline_style(
		'apr-style', $css_line
	);

}

add_action( 'wp_enqueue_scripts', 'apr_scripts_styles' );
