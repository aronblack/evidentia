<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://alispx.ninja
 * @since             1.3
 * @package           Wcbs
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce Book Store by 99plugins
 * Plugin URI:        http://99plugins.ninja
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.3
 * Author:            99plugins
 * Author URI:        http://alispx.ninja
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wcbs
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'NN_WCBS_VERSION', '1.2' );
define( 'NN_WCBS_SLUG', 'nn_wcbs' );
define( 'NN_WCBS_DIR', plugin_dir_path( __FILE__ ) );
define( 'NN_WCBS_URI', plugin_dir_url( __FILE__ ) );
define( 'NN_WCBS_ASSETS_URI', plugin_dir_url( __FILE__ ) . 'assets/' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wcbs-activator.php
 */
function activate_wcbs() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wcbs-activator.php';
	Wcbs_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wcbs-deactivator.php
 */
function deactivate_wcbs() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wcbs-deactivator.php';
	Wcbs_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wcbs' );
register_deactivation_hook( __FILE__, 'deactivate_wcbs' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wcbs.php';

// require_once NN_WCBS_DIR . 'modules/recommendation-engine/class-db-manager.php';
// $instance = new WCBS_Recommendation_Engine();
// $instance->instance();

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wcbs() {

	$plugin = new Wcbs();
	$plugin->run(); 

}
run_wcbs();
