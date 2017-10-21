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
	 * @param      string    $drim_share       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $drim_share, $version ) {

		$this->plugin_name = $drim_share;
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
		 * defined in Drim_Share_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Drim_Share_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/drim-share-admin.css', array(), $this->version, 'all' );

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
		 * defined in Drim_Share_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Drim_Share_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/drim-share-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
		public function drim_add_buttons() {
			require_once( plugin_dir_path( __FILE__ ) . 'partials/drim-share-admin-display.php' );
		}

	/**
	 * Register admin options and menu page.
	 *
	 * @since    1.0.0
	 */
		public function drim_register_admin_options() {
			require_once( plugin_dir_path( __FILE__ ) . 'partials/drim-share-admin-options.php' );
		}

	/**
	 * Main admin functions.
	 *
	 * @since    1.0.0
	 */
		public function drim_admin_functions() {
			require_once( plugin_dir_path( __FILE__ ) . 'partials/drim-share-admin-functions.php' );
		}


}
