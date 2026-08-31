<?php

/**
 * Installer for the recommendation engine extension.  Creates the woocommerce_sessions_history database table. 
 */
class WCBS_Recommender_Installer {

	public $version 			= '1.0';
	public $db_tbl_session_activity;
	public $db_tbl_recommendations;

	/**
	 * Execute the installation and update the wcbs_recommender_db_version option. 
	 * @global type $this
	 */
	public function install() {
		global $wpdb; 
		$this->db_tbl_session_activity 	= $wpdb->prefix . 'wcbs_session_activity';
		$this->db_tbl_recommendations 	= $wpdb->prefix . 'wcbs_recommendations';

		$this->install_database();
		update_option( 'wcbs_recommender_db_version', $this->version );
	}

	/**
	 * Creates the session history table for the current site.  Uses dbDelta. 
	 * @global wpdb $wpdb
	 * @global WooCommerce $woocommerce
	 * @global WC_Recommender $this
	 */
	private function install_database() {
		global $wpdb, $woocommerce;
		$wpdb->hide_errors();

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		
		if (get_option( 'wcbs_recommender_installed') != 1){
			$sql = "ALTER TABLE {$this->db_tbl_session_activity} DROP PRIMARY KEY";
			$wpdb->query($sql);
			
			$sql = "CREATE TABLE {$this->db_tbl_session_activity} (
	                activity_id int(11) NOT NULL AUTO_INCREMENT,
	                session_id varchar(32) NOT NULL,
	                activity_type varchar(255) NOT NULL,
	                product_id bigint(20) NOT NULL,
	                order_id varchar(45) NOT NULL DEFAULT '0',
	                user_id varchar(45) NOT NULL DEFAULT '0',
	                activity_date datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	                PRIMARY KEY  ( activity_id ) )";

			@dbDelta( $sql );

			$sql = "DROP TABLE {$this->db_tbl_recommendations}";
			$wpdb->query( $sql );
			
			$sql = "CREATE TABLE {$this->db_tbl_recommendations} (
			ID bigint(20) NOT NULL AUTO_INCREMENT,
			rkey varchar(255) NOT NULL,
			product_id bigint(20) NOT NULL,
			related_product_id bigint(20) NOT NULL,
			score float NOT NULL,
			PRIMARY KEY  ( ID ) )";
			
			@dbDelta($sql);
		}
	}

	/**
	 * Update the wcbs_recommender_db_version to 0. 
	 */
	public function uninstall() {
		update_option( "wcbs_recommender_db_version", 0 );
	}

}


/**
 * Installation functions
 */
function activate_wcbs_recommender() {
	$installer = new WCBS_Recommender_Installer();
	$installer->install();

	update_option( 'wcbs_recommender_installed', 1 );
}

/**
 * On plugin deactivation, trigger the uninstall function.  This does not destroy any tables or data. 
 */
function deactivate_wcbs_recommender() {
	
	$installer = new WCBS_Recommender_Installer();
	$installer->uninstall();

	update_option( 'wcbs_recommender_installed', 0 );
}

/**
 * Call the installation function on the WCBS_Recommender_Installer object.  
 * 
 *
 * This is triggerd from the main WC_Recommender class on activation and on version changes. 
 */
function install_wcbs_recommender() {
	$installer = new WCBS_Recommender_Installer();
	$installer->install();
}
