<?php

/**
 * Create Menu Page
 *
 * @return void
 * @author 99plugins
 **/
if ( ! function_exists( 'nn_create_admin_menu' ) ) {
	add_action( 'admin_menu', 'nn_create_admin_menu', 10 );
	function nn_create_admin_menu() {
		$menu_position = apply_filters( 'nn_admin_menu_position', '63.5' );
		add_menu_page( '99Plugins', '99Plugins', 'manage_options', 'nn-plugins-dashboard.php', NULL, NULL, $menu_position );
	}
}

/**
 * Remove double sub Menu Page
 *
 * @return void
 * @author 99plugins
 **/
if ( ! function_exists( 'nn_remove_submenu_page' ) ) {
	add_action( 'admin_init', 'nn_remove_submenu_page' );
	function nn_remove_submenu_page() {
		remove_submenu_page( 'nn-plugins-dashboard.php', 'nn-plugins-dashboard.php' );
	}
}
