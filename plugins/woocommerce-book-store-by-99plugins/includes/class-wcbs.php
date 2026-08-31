<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://alispx.ninja
 * @since      1.0.0
 *
 * @package    Wcbs
 * @subpackage Wcbs/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Wcbs
 * @subpackage Wcbs/includes
 * @author     99plugins <support@99plugins.ninja>
 */
class Wcbs {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Wcbs_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name 	= 'wcbs';
		$this->version 		= '1.2';

		$this->load_dependencies();
		$this->set_locale();
		$this->load_files();
		$this->loader->add_action( 'init', $this, 'load_modules', 5 );

	}

	function load_files() {
		// Load required files
		if ( ! class_exists( 'Carbon_Fields\Container' ) ) {
			require_once NN_WCBS_DIR . 'framework/fields/carbon-fields-plugin.php';
		}
		require_once NN_WCBS_DIR . 'framework/wc-fields/class-wc-product-data-fields.php';
		require_once NN_WCBS_DIR . 'framework/core/admin-menus.php';
		require_once NN_WCBS_DIR . 'framework/libraries/extended-cpts.php';
		require_once NN_WCBS_DIR . 'framework/libraries/extended-taxos.php';
		require_once NN_WCBS_DIR . 'includes/functions/data-source.php';
	}
	
	function load_modules() {
		require_once NN_WCBS_DIR . 'modules/multiple-products/multiple.php'; 
		require_once NN_WCBS_DIR . 'modules/book-stores/books.php'; 
		require_once NN_WCBS_DIR . 'modules/frequently-bought-together/fbt.php'; 
		// require_once NN_WCBS_DIR . 'modules/recommendation-engine/init.php'; 
		require_once NN_WCBS_DIR . 'modules/sales-countdown/sales-countdown.php'; 
		require_once NN_WCBS_DIR . 'modules/movie-product/movies.php'; 
		require_once NN_WCBS_DIR . 'modules/audio-product/audio.php'; 
		require_once NN_WCBS_DIR . 'modules/game-product/games.php'; 
	}
	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Wcbs_Loader. Orchestrates the hooks of the plugin.
	 * - Wcbs_i18n. Defines internationalization functionality.
	 * - Wcbs_Admin. Defines all hooks for the admin area.
	 * - Wcbs_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wcbs-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wcbs-i18n.php';

		$this->loader = new Wcbs_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Wcbs_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Wcbs_i18n();

		$this->loader->add_action( 'init', $plugin_i18n, 'load_plugin_textdomain', 0 );

	}


	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Wcbs_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
