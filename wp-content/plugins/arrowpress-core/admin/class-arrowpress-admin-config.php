<?php

/**
 * Class Arrowpress_Admin_Config
 *
 * @since 1.1.0
 */
class Arrowpress_Admin_Config extends Arrowpress_Singleton {
	/**
	 * @since 1.1.0
	 *
	 * @var null
	 */
	private static $configs = null;

	/**
	 * Arrowpress_Admin_Config constructor.
	 */
	protected function __construct() {
		$this->set_config();
	}

	/**
	 * Set configs.
	 *
	 * @since 1.1.0
	 */
	private function set_config() { 
		self::$configs = array(
			'api_check_self_update' => 'https://arrowtheme.github.io/arrowpress-core/update-check.json',
			'api_update_plugins'    => 'http://updates.arrowtheme.com/wp-json/thim_em/v1/plugins',
			'api_arrow_market'       => 'https://updates.arrowtheme.com/wp-json/arrow-market/v1',
			'personal_token'        => '4ioVySRBtxOEcrCSSEFzi55YPNZzO7cl',
			'host_envato_app'       => 'https://updates.arrowtheme.com/thim-envato-market',
			'host_downloads'        => 'http://updates.arrowtheme.com/thim-envato-market',
 			'demo_data'             => 'https://arrowtheme.github.io/demo-data/',
			'host_downloads_api'    => 'https://updates.arrowtheme.com/',
		);
	}

	/**
	 * Get config by key.
	 *
	 * @since 1.1.0
	 *
	 * @param      $key
	 * @param null $default
	 *
	 * @return mixed|null
	 */
	public static function get( $key, $default = null ) {
		if ( ! isset( self::$configs[ $key ] ) ) {
			return $default;
		}

		return apply_filters( "arrowpress_core_ac_$key", self::$configs[ $key ] );
	}
}
