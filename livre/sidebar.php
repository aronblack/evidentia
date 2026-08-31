<?php

/**
 * The Template for displaying sidebar primary
 *
 * @author 		tokoo
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( class_exists( 'WooCommerce' ) ) {
	if ( is_shop()) {
		$id 			= get_option( 'woocommerce_shop_page_id' ); 
		$get_sidebar 	= get_post_meta( $id , 'livre_layouts_details' );
	}
	
} else { $get_sidebar 	= livre_get_meta( '_layouts_details' ); }

$sidebar_id 	= isset( $get_sidebar['custom_sidebar'] ) ? $get_sidebar['custom_sidebar'] : 'livre-primary';
?>

<?php if ( is_active_sidebar( $sidebar_id ) ) { ?>
	<aside class="widget-area sidebar col-md-4">
		<?php dynamic_sidebar( $sidebar_id ); ?>
	</aside>
<?php } ?>