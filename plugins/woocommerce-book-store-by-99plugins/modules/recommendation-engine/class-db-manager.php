<?php 

if ( ! class_exists( 'WCBS_Recommendation_Engine' ) ) {

		class WCBS_Recommendation_Engine {

			private static $instance;

			public static function instance() {
				if ( self::$instance == null ) {
					self::$instance = new WCBS_Recommendation_Engine();
				}

				return self::$instance;
			}
			
			public static $message_controller;
			public $template_url;
			public $similar_products 	= array();
			public $version 			= '1.0';
			public $db_tbl_session_activity;
			public $db_tbl_recommendations;

			/**
			 * Creates a new instance of the WCBS_Recommendation_Engine.
			 * @global type $wpdb
			 */
			public function __construct() {
				global $wpdb;
				$this->db_tbl_session_activity 	= $wpdb->prefix . 'wcbs_session_activity';
				$this->db_tbl_recommendations 	= $wpdb->prefix . 'wcbs_recommendations';

				require_once NN_WCBS_DIR . 'modules/recommendation-engine/class-db-installers.php';
				require_once NN_WCBS_DIR . 'modules/recommendation-engine/functions.php'; 

				$this->install();
				$recorder = new WCBS_Recommender_Recorder();
				if (get_option( 'wcbs_recommender_installed') != 1){
					$recorder->wcbs_recommender_begin_build_simularity( true );
				}	

				add_action( 'woocommerce_init', array( $this, 'on_woocommerce_init' ) );

				//Record product view
				add_action( 'template_redirect', array( &$this, 'on_template_redirect') );

				//Record that someone added the item to the cart.
				add_action( 'woocommerce_add_to_cart', array( &$this, 'on_add_to_cart'), 10, 6 );

				// Record data when a new order is placed
				add_action( 'woocommerce_checkout_order_processed', array( &$this, 'record_item_ordered'), 100 );

				// Record data when a new order is completed
				add_action( 'woocommerce_order_status_completed', array( &$this, 'record_update_order') );

				//Record the cancellation and product removal actions.
				add_action( 'woocommerce_order_status_refunded', array( $this, 'record_update_order' ) );
				add_action( 'woocommerce_order_status_cancelled', array( $this, 'record_update_order' ) );
				add_action( 'woocommerce_order_status_processing', array( $this, 'record_update_order' ) );
				add_action( 'woocommerce_order_status_on-hold', array( $this, 'record_update_order' ) );
				add_action( 'woocommerce_order_status_failed', array( $this, 'record_update_order' ) );
				add_action( 'woocommerce_order_status_pending', array( $this, 'record_update_order' ) );

				add_action( 'delete_posts', array( $this, 'on_delete_post' ) );
			}

			/**
			 * Installs the database tables and initial recommendations based on previous orders.
			 */
			public function install() {

				$this->activate();
				$this->deactivate();
				if ( get_option( 'wcbs_recommender_db_version' ) != $this->version ) {
					add_action( 'init', 'install_wcbs_recommender', 99 );

					if ( !wp_next_scheduled( 'wcbs_recommender_build' ) ) {
						wp_schedule_event( time(), 'twicedaily', 'wcbs_recommender_build' );
					}
				}
			}

			/**
			 * Runs when the plugin is activated.
			 */
			public function activate() {
				activate_wcbs_recommender();
				if ( !wp_next_scheduled( 'wcbs_recommender_build' ) ) {
					wp_schedule_event( time(), 'twicedaily', 'wcbs_recommender_build' );
				}
			}

			public function deactivate() {
				wp_clear_scheduled_hook( 'wcbs_recommender_build' );
			}

			public function on_woocommerce_init() {
				if ( (!is_admin() || defined( 'DOING_AJAX' ) ) && !defined( 'DOING_CRON' ) ) {
					//We need to force WooCommerce to set the session cookie
					if ( ! WC()->session->has_session() ) {
						 WC()->session->set_customer_session_cookie( true );
					}
				}
			}

			/**
			 * Hooks into the template_redirect to record product views.
			 */
			public function on_template_redirect() {
				if ( is_single() && is_product() ) {
					wcbs_recommender_record_product_view( get_the_ID() );
				}
			}

			/**
			 * Hooks into the add_to_cart action to record items being added to the cart.
			 * @param string $cart_item_key
			 * @param int $product_id
			 * @param int $quantity
			 * @param int|null $variation_id
			 * @param array|null $variation
			 * @param array|null $cart_item_data
			 */
			public function on_add_to_cart( $cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data ) {
				wcbs_recommender_record_product_in_cart( $product_id );
			}

			/**
			 * Hooks into the new order item action, records the ordered item.
			 * @param int $order_id
			 */
			public function record_item_ordered( $order_id ) {
				$order = new WC_Order( $order_id );
				$order_items = $order->get_items();
				foreach ( $order_items as $item ) {
					$product = $order->get_product_from_item( $item );
					if ( $product && is_object( $product ) ) {
						if ( $product->is_type( 'variable' ) ) {
							wcbs_recommender_record_product_ordered( $order_id, $product->id, $order->status );
							wcbs_recommender_record_product_ordered( $order_id, $product->variation_id, $order->status );
						} else {
							wcbs_recommender_record_product_ordered( $order_id, $product->id, $order->status );
						}
					}
				}
			}

			/**
			 * Hooks into the update order action, updates the status of the previously recorded order item.
			 * @param int $order_id
			 */
			public function record_update_order( $order_id ) {
				$order = new WC_Order( $order_id );
				$order_items = $order->get_items();
				foreach ( $order_items as $item ) {
					$product = $order->get_product_from_item( $item );
					if ( $product && is_object( $product ) ) {
						if ( $product->is_type( 'variable' ) ) {
							wcbs_recommender_update_recorded_product( $order_id, $product->id, $order->status );
							wcbs_recommender_update_recorded_product( $order_id, $product->variation_id, $order->status );
						} else {
							wcbs_recommender_update_recorded_product( $order_id, $product->id, $order->status );
						}
					} else {
						print_r( $product );
						die();
					}
				}
			}

			/**
			 * Hooks into the delete_post action.  Removes items from session history when the products and orders are deleted.
			 * @global wpdb $wpdb
			 * @param int $post_id
			 */
			public function on_delete_post( $post_id ) {
				global $wpdb;

				$type = $wpdb->get_var( $wpdb->prepare( 'SELECT post_type FROM $wpdb->posts WHERE post_id = %d', $post_id ) );

				if ( $type && $type == 'shop_order' ) {
					$order = new WC_Order( $post_id );
					$order_items = $order->get_items();

					$product_ids = array();
					foreach ( $order_items as $item ) {
						if ( $item->order_item_type == 'variable' ) {
							$product_ids[] = $item->variation_id;
						}
						$product_ids[] = $item->id;
					}

					$query = $wpdb->prepare( "DELETE FROM $this->db_tbl_session_activity WHERE product_id IN (%s) AND order_id > 0)", implode( ',', $product_ids ) );
					$wpdb->query( $query );
				} elseif ( $type && ($type == 'product' || $type == 'product_variation') ) {
					$query = $wpdb->prepare( "DELETE FROM $this->db_tbl_session_activity WHERE product_id = %d", $post_id );
					$wpdb->query( $query );
				}

				$wpdb->query( "DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_wc_recommender_%'" );
			}

			/**
			 * Hooks into the after_product_summary action to ouput the recommendations.
			 */
			public function on_after_product_summary() {
				$similar_products = wcbs_recommender_get_simularity( get_the_ID() );

				if ( $similar_products ) {
					echo 'You might also like<br />';
					echo '<ul>';
					foreach ( $similar_products as $product_id => $score ) {
						if ( $score > 0 ) {
							// 2.0 compat
							if ( function_exists( 'get_product' ) )
								$product = get_product( $product_id );
							else
								$product = new WC_Product( $product_id );
							echo '<li>' . $product->get_title() . '</li>';
						}
					}
					echo '</ul>';
				}
			}

		}

	}

	/**
	 * 
	 * @return WCBS_Recommendation_Engine
	 */
	function wcbsre() {
		return WCBS_Recommendation_Engine::instance();
	}

	$GLOBALS['wcbs_recommender'] = wcbsre();
