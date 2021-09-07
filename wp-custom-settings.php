<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/ankit2412
 * @since             1.0.0
 * @package           Wp_Custom_Settings
 *
 * @wordpress-plugin
 * Plugin Name:       WP Settings
 * Plugin URI:        https://github.com/ankit2412/wp-custom-settings
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Ankit Jani
 * Author URI:        https://github.com/ankit2412
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-custom-settings
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WP_CUSTOM_SETTINGS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-custom-settings-activator.php
 */
function activate_wp_custom_settings() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-custom-settings-activator.php';
	Wp_Custom_Settings_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-custom-settings-deactivator.php
 */
function deactivate_wp_custom_settings() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-custom-settings-deactivator.php';
	Wp_Custom_Settings_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_custom_settings' );
register_deactivation_hook( __FILE__, 'deactivate_wp_custom_settings' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-custom-settings.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_custom_settings() {

	$plugin = new Wp_Custom_Settings();
	$plugin->run();

}
run_wp_custom_settings();
