<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/ankit2412
 * @since      1.0.0
 *
 * @package    Wp_Custom_Settings
 * @subpackage Wp_Custom_Settings/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Custom_Settings
 * @subpackage Wp_Custom_Settings/admin
 * @author     Ankit Jani <nshjani@gmail.com>
 */
class Wp_Custom_Settings_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Custom_Settings_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Custom_Settings_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( 'jquery-ui-datepicker-style', plugin_dir_url( __FILE__ ) . 'css/jquery-ui.css', array(), '1.12.1', 'all' );		
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-custom-settings-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Custom_Settings_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Custom_Settings_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( 'jquery-ui-datepicker-script', plugin_dir_url( __FILE__ ) . 'js/jquery-ui.js', array( 'jquery' ), '1.12.1', true );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-custom-settings-admin.js', array( 'jquery', 'wp-color-picker', 'jquery-ui-datepicker-script' ), $this->version, true );

	}

	/**
	 * Add setting page in admin dashboard
	 * 
	 * @since    1.0.0
	 */
	public function wpcs_add_settings_page() {
		add_menu_page( 'WP Setting & Widget page', 'WP Setting & Widget page', 'manage_options', 'wpcs-setting-widget', array ( $this, 'wpcs_render_plugin_settings_page' ) );
	}

	/**
	 * Display setting page in admin dashboard
	 * 
	 * @since    1.0.0
	 */
	public function wpcs_render_plugin_settings_page() {
		// check user capabilities
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		if ( isset( $_GET['settings-updated'] ) ) {
			// add settings saved message with the class of "updated"
			add_settings_error( 'wpcs_messages', 'wpcs_message', __( 'Settings Saved', 'wp-custom-settings' ), 'updated' );
		}
	 
		// show error/update messages
		settings_errors( 'wpcs_messages' );
		?>
		<div class="wrap">
			<h2><?php echo __( 'WP Settings & Widget Page', 'wp-custom-settings' ); ?></h2>
			<button id='wpcs_reset_settings' name='wpcs-reset-settings-button' class='button button-primary'> <?php echo __('Reset All Settings', ); ?></button>
			<form id='wpcs_settings_form' action="options.php" method="post" enctype="multipart/form-data" >
				<?php 
				submit_button( 'Save Changes' );
				settings_fields( 'wpcs_setting_options' );
				do_settings_sections( 'wpcs_settings_plugin' ); 
				submit_button( 'Save Changes' ); ?>
			</form>
		</div>
		<?php
	}

	/**
	 * Register setting fields
	 * 
	 * @since    1.0.0
	 */
	public function wpcs_register_settings() {
		register_setting( 'wpcs_setting_options', 'wpcs_setting_options', array ( $this, 'wpcs_setting_options_validate' ) );

		add_settings_section( 'wpcs_plugin_setting', __( '', 'wp-custom-settings' ), null, 'wpcs_settings_plugin' );

		add_settings_field( 'wpcs_plugin_setting_title', __( 'Title', 'wp-custom-settings' ), array ( $this, 'wpcs_plugin_setting_title' ), 'wpcs_settings_plugin', 'wpcs_plugin_setting' );
		add_settings_field( 'wpcs_plugin_setting_desc', __( 'Description', 'wp-custom-settings' ), array ( $this, 'wpcs_plugin_setting_desc' ), 'wpcs_settings_plugin', 'wpcs_plugin_setting' );
		add_settings_field( 'wpcs_plugin_setting_editor_content', __( 'Editor Content', 'wp-custom-settings' ), array ( $this, 'wpcs_plugin_setting_editor_content' ), 'wpcs_settings_plugin', 'wpcs_plugin_setting' );
		add_settings_field( 'wpcs_plugin_setting_date', __( 'Date', 'wp-custom-settings' ), array ( $this, 'wpcs_plugin_setting_date' ), 'wpcs_settings_plugin', 'wpcs_plugin_setting' );
		add_settings_field( 'wpcs_plugin_setting_image', __( 'Image', 'wp-custom-settings' ), array ( $this, 'wpcs_plugin_setting_image' ), 'wpcs_settings_plugin', 'wpcs_plugin_setting' );
		add_settings_field( 'wpcs_plugin_setting_color_picker', __( 'Color Picker', 'wp-custom-settings' ), array ( $this, 'wpcs_plugin_setting_color_picker' ), 'wpcs_settings_plugin', 'wpcs_plugin_setting' );
	}

	/**
	 * Validate Settings Fields
	 * 
	 * @since    1.0.0
	 * @param    array    $input       The Settings post fileds
	 */
	public function wpcs_setting_options_validate( $input ) {

		/*$newinput['wpcs_plugin_setting_title'] = trim( $input['wpcs_plugin_setting_title'] );
		if ( '' == $newinput['wpcs_plugin_setting_title'] ) {
			$newinput['wpcs_plugin_setting_title'] = '';
		}*/

		if( ! empty( $_FILES["wpcs_plugin_setting_image"]["tmp_name"] ) ) {
			$urls = wp_handle_upload( $_FILES["wpcs_plugin_setting_image"], array( 'test_form' => FALSE ) );
			$input['wpcs_plugin_setting_image'] = $urls["url"];
			
		}
		return $input;
	}

	public function wpcs_plugin_setting_title() {
		$options = get_option( 'wpcs_setting_options' );
		?>
		<input type='text' name='wpcs_setting_options[wpcs_plugin_setting_title]' value='<?php echo ( ! empty ( $options['wpcs_plugin_setting_title'] ) ) ? esc_attr( $options['wpcs_plugin_setting_title'] ) : ''; ?>' />
		<?php
	}

	public function wpcs_plugin_setting_desc() {
		$options = get_option( 'wpcs_setting_options' );
		?>
		<textarea cols='40' rows='5' name='wpcs_setting_options[wpcs_plugin_setting_desc]'><?php echo ( ! empty( $options['wpcs_plugin_setting_desc'] ) ) ? esc_attr( $options['wpcs_plugin_setting_desc'] ) : ''; ?></textarea>
		<?php
	}

	public function wpcs_plugin_setting_editor_content() {
		$options = get_option( 'wpcs_setting_options' );
		$content   = ( ! empty( $options['wpcs_plugin_setting_editor_content'] ) ) ? esc_attr( $options['wpcs_plugin_setting_editor_content'] ) : '';
		$editor_id = 'wpcs_plugin_setting_editor_content';
		$args = array('textarea_name' => 'wpcs_setting_options[wpcs_plugin_setting_editor_content]'); 
		wp_editor( $content, $editor_id, $args );
	}

	public function wpcs_plugin_setting_date() {
		$options = get_option( 'wpcs_setting_options' );
		?>
		<input type='text' id='wpcs_plugin_setting_date' name='wpcs_setting_options[wpcs_plugin_setting_date]' value='<?php echo ( ! empty( $options['wpcs_plugin_setting_date'] ) ) ? esc_attr( $options['wpcs_plugin_setting_date'] ) : ''; ?>' />
		<?php
	}

	public function wpcs_plugin_setting_image() {
		$options = get_option( 'wpcs_setting_options' );
		?>
		<input type="file" id='wpcs_plugin_setting_image' name="wpcs_plugin_setting_image" /> 
        <?php 
		if ( ! empty( $options['wpcs_plugin_setting_image'] ) ) {
		echo '<img src="' . esc_attr( $options['wpcs_plugin_setting_image'] ) . '" width="200" height="200"/>';
		}
	}

	public function wpcs_plugin_setting_color_picker() {
		$options = get_option( 'wpcs_setting_options' );
		?>
		<input type='text' id='wpcs_plugin_setting_color_picker' name='wpcs_setting_options[wpcs_plugin_setting_color_picker]' value='<?php echo ( ! empty( $options['wpcs_plugin_setting_color_picker'] ) ) ? esc_attr( $options['wpcs_plugin_setting_color_picker'] ) : ''; ?>' />
		<?php
	}

	public function wpcs_load_widget() {
		register_widget( 'Wp_Custom_Settings_Widget' );
	}
}
