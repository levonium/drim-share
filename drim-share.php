<?php

/**
 * The plugin bootstrap file
 *
 * @link              https://drim.io/drim-share/
 * @since             1.0.0
 * @package           Drim_Share
 *
 * @wordpress-plugin
 * Plugin Name:       Drim Share
 * Plugin URI:        https://drim.io/drim-share/
 * Description:       A simple lightweight and mobile friendly social sharing plugin.
 * Version:           1.0.0
 * Author:            Levon Avetyan
 * Author URI:        https://drim.io/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       drim-share
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-drim-share-activator.php
 */
function activate_drim_share() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-drim-share-activator.php';
	Drim_Share_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-drim-share-deactivator.php
 */
function deactivate_drim_share() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-drim-share-deactivator.php';
	Drim_Share_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_drim_share' );
register_deactivation_hook( __FILE__, 'deactivate_drim_share' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-drim-share.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_drim_share() {

	$plugin = new Drim_Share();
	$plugin->run();

}
run_drim_share();
