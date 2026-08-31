<?php

/**
 * Register the required plugins for this theme.
 *
 * @since 1.0
 */
add_action( 'tgmpa_register', 'livre_register_required_plugins' );
function livre_register_required_plugins() { 

	/* Plugins lists. */
	$plugins = array(

		array(
			'name'     				=> 'Tokoo Vitamins',
			'slug'     				=> 'tokoo-vitamins',
			'source'   				=> 'http://import.tokomoo.com/tokoo-plugins/tokoo-vitamins-6.5.2.zip',
			'required' 				=> true,
			'version' 				=> '6.5.2', 
			'force_activation' 		=> false,
			'force_deactivation' 	=> false
		),

		array(
			'name' 		=> 'WooCommerce Book Store by 99Plugins',
			'slug' 		=> 'woocommerce-book-store-by-99plugins',
			'source'   	=> 'http://import.tokomoo.com/tokoo-plugins/woocommerce-book-store-by-99plugins.zip',
			'required' 	=> true,
			'version' 	=> '1.3',
		),

		array(
			'name' 		=> 'Livre Addons',
			'slug' 		=> 'livre-addons',
			'source'   	=> 'http://import.tokomoo.com/tokoo-plugins/livre-addons-1.0.0.zip',
			'required' 	=> true,
			'version' 	=> '1.0.0',
		),

		// array(
		// 	'name' 		=> 'King Composer Page Builder',
		// 	'slug' 		=> 'kingcomposer',
		// 	'required' 	=> true,
		// ),

		array(
			'name' 		=> 'Elementor Website Builder',
			'slug' 		=> 'elementor',
			'required' 	=> true,
		),

		array(
			'name' 		=> 'Enable Jquery Migrate Helper',
			'slug' 		=> 'enable-jquery-migrate-helper',
			'required' 	=> true,
		),

		array(
			'name' 		=> 'One Click Demo Importer',
			'slug' 		=> 'one-click-demo-import',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Envato Market',
			'slug' 		=> 'envato-market',
			'required' 	=> false,
			'source' 	=> 'http://envato.github.io/wp-envato-market/dist/envato-market.zip',
		),

		array(
			'name' 		=> 'SMK Sidebar Generator',
			'slug' 		=> 'smk-sidebar-generator',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Regenerate Thumbnails',
			'slug' 		=> 'regenerate-thumbnails',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Contact Form 7',
			'slug' 		=> 'contact-form-7',
			'required' 	=> false,
		),

		array(
			'name'     => 'MailChimp for WordPress',
			'slug'     => 'mailchimp-for-wp',
			'required' => false
		),

		array(
			'name'     => 'WooCommerce',
			'slug'     => 'woocommerce',
			'required' => false
		),

		array(
			'name'     => 'YITH WooCommerce Wishlist',
			'slug'     => 'yith-woocommerce-wishlist',
			'required' => false
		),

		array(
			'name'     	=> 'YITH WooCommerce Quick View',
			'slug'     	=> 'yith-woocommerce-quick-view',
			'required' 	=> false
		),

	);

	$theme_text_domain 	= 'livre';
	$config 			= array(
		'domain'            => $theme_text_domain,          // Text domain - likely want to be the same as your theme.
		'default_path'      => '',                      // Default absolute path to pre-packaged plugins.
		'menu'              => 'livre-install-plugins', // Menu slug.
		'has_notices'       => true,                    // Show admin notices or not.
		'dismissable'       => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'       => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic'      => true,                   // Automatically activate plugins after installation or not.
		'message'           => '',                          // Message to output right before the plugins table
	);

	tgmpa( $plugins, $config );

}