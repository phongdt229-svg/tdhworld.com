<?php
namespace eFarm;
class ArrowPressShortcodesClass {
	private $shortcodes = array(
		"arrowpress_static_block", "arrowpress_container", "arrowpress_banner", "arrowpress_member", "arrowpress_slider_wrap", "arrowpress_testimonial", "arrowpress_recipe", "arrowpress_heading", "arrowpress_portfolio", "arrowpress_blog",
		"arrowpress_icon_box", "arrowpress_services", "arrowpress_search_bar", "arrowpress_product", "arrowpress_product_cate", "arrowpress_product_filter"
	);

	function __construct() {
		// Init plugins
		add_action( 'init', array( $this, 'initPlugin' ) );

		$this->addShortcodes();
		add_filter( 'the_content', array( $this, 'formatShortcodes' ) );
		add_filter( 'widget_text', array( $this, 'formatShortcodes' ) );
		add_action( 'vc_base_register_front_css', array( $this, 'arrowpress_iconpicker_base_register_css' ) );
		add_action( 'vc_base_register_admin_css', array( $this, 'arrowpress_iconpicker_base_register_css' ) );
		add_action( 'vc_backend_editor_enqueue_js_css', array( $this, 'arrowpress_iconpicker_editor_jscss' ) );
		add_action( 'vc_frontend_editor_enqueue_js_css', array( $this, 'arrowpress_iconpicker_editor_jscss' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'arrowpress_efarm_enqueue_script' ) );
	}

	// Init plugins
	function initPlugin() {

		$this->addTinyMCEButtons();
	}

	// Add buttons to tinyMCE
	function addTinyMCEButtons() {
		if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
			return;
		}

		if ( get_user_option( 'rich_editing' ) == 'true' ) {
			add_filter( 'mce_buttons', array( &$this, 'registerTinyMCEButtons' ) );
		}
	}

	function registerTinyMCEButtons( $buttons ) {
		array_push( $buttons, "arrowpress_shortcodes_button" );

		return $buttons;
	}

	// Add shortcodes
	function addShortcodes() {
		foreach ( $this->shortcodes as $shortcode ) {
			require_once( ARROWPRESS_SHORTCODES_PARAMS . $shortcode . '.php' );
		}
	}

	// Format shortcodes content
	function formatShortcodes( $content ) {
		$block = join( "|", $this->shortcodes );
		// opening tag
		$content = preg_replace( "/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/", "[$2$3]", $content );
		// closing tag
		$content = preg_replace( "/(<p>)?\[\/($block)](<\/p>|<br \/>)/", "[/$2]", $content );

		return $content;
	}

	function arrowpress_iconpicker_base_register_css() {
		wp_register_style( 'pestrokefont', get_template_directory_uri() . '/css/shortcode/pe-icon-7-stroke.css', false, APR_VERSION, 'screen' );
		wp_register_style( 'themifyfont', get_template_directory_uri() . '/css/shortcode/themify-icons.css', false, APR_VERSION, 'screen' );
		wp_register_style( 'arrowpressfont', get_template_directory_uri() . '/css/icomoon.css', false, APR_VERSION, 'screen' );
	}

	function arrowpress_iconpicker_editor_jscss() {
		wp_enqueue_style( 'pestrokefont' );
		wp_enqueue_style( 'themifyfont' );
		wp_enqueue_style( 'arrowpressfont' );
	}

	function arrowpress_efarm_enqueue_script() {
		wp_enqueue_script( 'custom-script', get_template_directory_uri() . '/inc/assets/js/functions.js', array( 'jquery' ), APR_VERSION, true );
		if ( is_rtl() ) {
			wp_enqueue_style( 'apr-core-style-rtl', APR_CSS . '/shortcode/apr_core_rtl.css' );
		} else {
			wp_enqueue_style( 'apr-core-style', APR_CSS . '/shortcode/apr_core.css' );
		}
	}
}

// Finally initialize code
new ArrowPressShortcodesClass();
