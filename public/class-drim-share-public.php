<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://drim.io/drim-share/
 * @since      1.0.0
 *
 * @package    Drim_Share
 * @subpackage Drim_Share/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Drim_Share
 * @subpackage Drim_Share/public
 *
 */
class Drim_Share_Public {

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
	 * @param      string    $drim_share       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $drim_share, $version ) {

		$this->plugin_name = $drim_share;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/drim-share.min.css', array(), $this->version, 'all' );

	}

}
