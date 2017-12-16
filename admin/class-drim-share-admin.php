<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://drim.io/drim-share/
 * @since      1.0.0
 *
 * @package    Drim_Share
 * @subpackage Drim_Share/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Drim_Share
 * @subpackage Drim_Share/admin
 *
 */
class Drim_Share_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $drim_share    The ID of this plugin.
	 */
	private $drim_share;

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
	 * @param    string    $drim_share       The name of this plugin.
	 * @param    string    $version    The version of this plugin.
	 */
	public function __construct( $drim_share, $version ) {

		$this->plugin_name = $drim_share;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/drim-share-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-public', plugin_dir_url( dirname( __FILE__ ) ) . 'public/css/drim-share.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ds-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name . '-sortable', plugin_dir_url( __FILE__ ) . 'js/Sortable.js', array(), $this->version, false );

	}

	/**
	 * Register admin options and menu page.
	 *
	 * @since    1.0.0
	 */
	public function drim_share_register_admin_options() {
		require_once( plugin_dir_path( __FILE__ ) . 'partials/class-drim-share-options.php' );
	}

	/**
	 * Main admin functions.
	 *
	 * @since    1.0.0
	 */
	public function drim_share_admin_functions() {
		require_once( plugin_dir_path( __FILE__ ) . 'partials/drim-share-admin-functions.php' );
	}

		/**
		 * Plugin Settings Links
		 *
		 * @since 1.0.0
		 */
	public function drim_share_admin_settings_link() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/drim-share-settings-link.php';
	}

}
