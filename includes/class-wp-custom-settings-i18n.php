<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/ankit2412
 * @since      1.0.0
 *
 * @package    Wp_Custom_Settings
 * @subpackage Wp_Custom_Settings/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wp_Custom_Settings
 * @subpackage Wp_Custom_Settings/includes
 * @author     Ankit Jani <nshjani@gmail.com>
 */
class Wp_Custom_Settings_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wp-custom-settings',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
