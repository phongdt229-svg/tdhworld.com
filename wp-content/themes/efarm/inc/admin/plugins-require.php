<?php
function arrow_get_all_plugins_require( $plugins ) {
	/*
	* Array of plugin arrays. Required keys are name and slug.
	* If the source is NOT from the .org repo, then source is also required.
	*/

	$plugins = array(
		array(
			'name'     => 'Redux Framework',
			'slug'     => 'redux-framework',
			'required' => true,
		),
		// This is an example of how to include a plugin bundled with a theme.
		array(
			'name'     => 'Slider Revolution',
			'slug'     => 'revslider',
			'premium'  => true,
			'required' => true,
			'icon'     => 'https://arrowtheme.github.io/demo-data/icon-plugins/revslider.png',
		),

		array(
			'name'     => 'WPBakery Visual Composer',
			'slug'     => 'js_composer',
			'premium'  => true,
			'required' => true,
			'icon'     => 'https://arrowtheme.github.io/demo-data/icon-plugins/js_composer.png',
		),
		array(
			'name'     => 'Ultimate Addons for Visual Composer',
			'slug'     => 'Ultimate_VC_Addons',
			'premium'  => true,
			'required' => true,
			'icon'     => 'https://arrowtheme.github.io/demo-data/icon-plugins/uavc.png',
		),

		array(
			'name'     => 'Contact Form 7',
			'slug'     => 'contact-form-7',
			'required' => true,
		),
		array(
			'name'     => 'Classic Widgets',
			'slug'     => 'classic-widgets',
			'icon'     => 'https://s.w.org/plugins/geopattern-icon/classic-widgets.svg',
			'required' => false,
		),
		array(
			'name'     => 'MailChimp for WordPress',
			'slug'     => 'mailchimp-for-wp',
			'required' => false,
		),

		array(
			'name'     => 'Woocommerce',
			'slug'     => 'woocommerce',
			'required' => true,
			'icon'     => 'https://ps.w.org/woocommerce/assets/icon.svg',
		),
		array(
			'name'     => esc_html__( 'WP Store Locator', 'efarm' ),
			'slug'     => 'wp-store-locator',
			'required' => false,
			'icon'     => 'https://ps.w.org/wp-store-locator/assets/icon-256x256.jpg',
		),

		array(
			'name'     => esc_html__( 'YITH WooCommerce Ajax Product Filter', 'efarm' ),
			'slug'     => 'yith-woocommerce-ajax-navigation',
			'required' => false,
			'icon'     => 'https://ps.w.org/yith-woocommerce-ajax-navigation/assets/icon-128x128.gif',
		),

		array(
			'name'     => esc_html__( 'YITH WooCommerce Quick View', 'barber' ),
			'slug'     => 'yith-woocommerce-quick-view',
			'required' => false,
			'icon'     => 'https://ps.w.org/yith-woocommerce-quick-view/assets/icon-128x128.gif',
		),

		array(
			'name'     => esc_html__( 'YITH WooCommerce Wishlist', 'efarm' ),
			'slug'     => 'yith-woocommerce-wishlist',
			'required' => false,
			'icon'     => 'https://ps.w.org/yith-woocommerce-wishlist/assets/icon-128x128.gif',
		),
	);

	return $plugins;
}

add_filter( 'arrowpress_core_get_all_plugins_require', 'arrow_get_all_plugins_require' );

//Add info for Dashboard Admin
if ( ! function_exists( 'arrowpress_efarm_links_guide_user' ) ) {
	function arrowpress_efarm_links_guide_user() {
		return array(
			'docs'      => 'https://docs.arrowtheme.com/efarm-a-multipurpose-food-farm-wordpress-theme/',
			'support'   => 'https://help.arrowtheme.com/',
			'knowledge' => 'https://help.arrowtheme.com/',
		);
	}
}
add_filter( 'arrowpress_theme_links_guide_user', 'arrowpress_efarm_links_guide_user' );

/**
 * Link purchase theme.
 */
if ( ! function_exists( 'arrowpress_efarm_link_purchase' ) ) {
	function arrowpress_efarm_link_purchase() {
		return 'https://themeforest.net/item/efarm-a-multipurpose-food-wordpress-theme/20109992';
	}
}
add_filter( 'arrowpress_envato_link_purchase', 'arrowpress_efarm_link_purchase' );

/**
 * Envato id.
 */
if ( ! function_exists( 'arrowpress_efarm_envato_item_id' ) ) {
	function arrowpress_efarm_envato_item_id() {
		return '20109992';
	}
}

add_filter( 'arrowpress_envato_item_id', 'arrowpress_efarm_envato_item_id' );

add_filter(
	'arrowpress_prefix_folder_download_data_demo',
	function () {
		return 'efarm';
	}
);


add_filter( 'arrowpress_core_list_child_themes', 'arrowpress_list_child_themes' );
function arrowpress_list_child_themes() {
	return array(
		'efarm-child' => array(
			'name'       => 'efarm Child',
			'slug'       => 'efarm-child',
			'screenshot' => 'https://arrowtheme.github.io/demo-data/efarm/child-themes/screenshot.png',
			'source'     => 'https://arrowtheme.github.io/demo-data/efarm/child-themes/efarm-child.zip',
			'version'    => '1.0.0',
		),
	);
}

//add_filter( 'arrowpress_download_data_demo', '__return_false' );

add_filter( 'arrowpress_importer_basic_settings', 'arrowpress_import_add_basic_settings' );
function arrowpress_import_add_basic_settings( $settings ) {
	//  $settings[] = 'apr_settings';
	$settings[] = 'permalink_structure';

	return $settings;
}


// import Setting Redus

add_filter( 'arrowpress_core_importer_packages', 'arrowpress_importer_add_redux_theme_settings_package_data' );
function arrowpress_importer_add_redux_theme_settings_package_data( $packages ) {
	$packages['redux_theme_settings'] = array(
		'title'       => esc_attr__( 'Redux Settings', 'efarm' ),
		'description' => esc_attr__( 'Import Redux Setting', 'efarm' ),
	);

	return $packages;
}

if ( class_exists( 'ReduxFramework' ) ) {
	add_filter( 'arrowpress_core_importer_step_redux_theme_settings', 'arrowpress_importer_add_callable_function_step_redux_theme_settings' );
}
function arrowpress_importer_add_callable_function_step_redux_theme_settings( $callable ) {
	return 'arrowpress_importer_process_step_redux_theme_settings';
}

function arrowpress_importer_process_step_redux_theme_settings() {
	$importer_ajax = new Arrowpress_Importer_AJAX();
	$dir           = $importer_ajax->get_current_demo_data_directory();
	$json_file     = $dir . '/redux_setting.php';

	if ( file_exists( $json_file ) ) {
		$response         = new Arrowpress_Import_REST_Response();
		$response->status = 'error';
		try {
			ob_start();
			include $json_file;
			$theme_options = ob_get_clean();
			$options       = json_decode( $theme_options, true );
			update_option( 'apr_settings', $options );
			$response->status        = 'success';
			$response->message       = 'import success';
			$response->percentage    = 100;
			$response->step_finished = 1;
		} catch ( Arrowpress_Error $exception ) {
			$response->message = $exception->getMessage();
		}

		return $response;
	}
}
