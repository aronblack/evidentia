<?php

/**
 * tokoo functions and definitions
 *
 * @package Livre
 */

/* Define static constant */
define( 'LIVRE_THEME_DIR', get_template_directory() );
define( 'LIVRE_THEME_URI', get_template_directory_uri() );
define( 'LIVRE_THEME_APP_DIR', LIVRE_THEME_DIR . '/app' );
define( 'LIVRE_THEME_APP_URI', LIVRE_THEME_URI . '/app' );
define( 'LIVRE_THEME_CORE_DIR', LIVRE_THEME_DIR . '/bootstrap/core' );
define( 'LIVRE_THEME_CORE_URI', LIVRE_THEME_URI . '/bootstrap/core' );
define( 'LIVRE_THEME_ASSETS_DIR', LIVRE_THEME_URI . '/assets' );
define( 'LIVRE_THEME_ASSETS_URI', LIVRE_THEME_URI . '/assets' );
define( 'LIVRE_THEME_VERSION', '2.0.0' );
define( 'LIVRE_OPTIMIZE_MODE', true );


/**
 * Initial setup
 *
 * @return void
 * @author tokoo
 **/
require_once( LIVRE_THEME_DIR . '/bootstrap/class-tgm-plugin-activation.php' );
require_once( LIVRE_THEME_DIR . '/bootstrap/plugins.php' );
require_once( LIVRE_THEME_DIR . '/bootstrap/class-autoloaders.php' );
require_once( LIVRE_THEME_DIR . '/plugin/index.php' );
require_once( LIVRE_THEME_DIR . '/bootstrap/setup.php' );

// Setup oneclick demo importer
require_once( LIVRE_THEME_DIR . '/importer/config.php' );
require_once( LIVRE_THEME_DIR . '/importer/after-import.php' );