<?php 

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'theme_options', esc_html__( 'Frequently Bought Together', 'wcbs' ) )
	->set_page_parent( 'nn-plugins-dashboard.php' ) // identificator of the "Appearance" admin section
	->add_tab( esc_html__( 'General Settings', 'wcbs' ), array(
		Field::make( 'text', 'wcbs_fbt_box_title', esc_html__( 'Box Title', 'wcbs' ) )->set_width(50),
		Field::make( 'select', 'wcbs_fbt_box_position', esc_html__( 'Box Position', 'wcbs' ) )
		->add_options( array(
			'below_product_summary' 	=> esc_html__( 'Below Product Summary', 'wcbs' ),
			'above_related_products'	=> esc_html__( 'Above Related Products', 'wcbs' ),
			'below_related_products' 	=> esc_html__( 'Below Related Products', 'wcbs' ),
			'custom' 					=> esc_html__( 'Display Manually', 'wcbs' ),
		))->set_width(50),
	))
	
	->add_tab( esc_html__( 'Label Settings', 'wcbs' ), array(
		
		// LABEL FOR TOTAL 
		Field::make( 'separator', 'wcbs_fbt_label_for_total', esc_html__( 'Label for Total', 'wcbs' ) ),
		Field::make( 'text', 'wcbs_fbt_total_label_single_product', esc_html__( 'Total Label For Single Product', 'wcbs' ) )->set_width(50),
		Field::make( 'text', 'wcbs_fbt_total_label_double_products', esc_html__( 'Total Label For Double Products', 'wcbs' ) )->set_width(50),
		Field::make( 'text', 'wcbs_fbt_total_label_three_products', esc_html__( 'Total Label For Three Products', 'wcbs' ) )->set_width(50),
		Field::make( 'text', 'wcbs_fbt_total_label_multiple_products', esc_html__( 'Total Label For Multiple Products', 'wcbs' ) )->set_width(50), 

		// LABEL FOR BUTTON
		Field::make( 'separator', 'wcbs_fbt_label_for_button', esc_html__( 'Label for Button', 'wcbs' ) ),
		Field::make( 'text', 'wcbs_fbt_button_label_single_product', esc_html__( 'Button Label For Single Product', 'wcbs' ) )->set_width(50),
		Field::make( 'text', 'wcbs_fbt_button_label_double_products', esc_html__( 'Button Label For Double Products', 'wcbs' ) )->set_width(50),
		Field::make( 'text', 'wcbs_fbt_button_label_three_products', esc_html__( 'Button Label For Three Products', 'wcbs' ) )->set_width(50),
		Field::make( 'text', 'wcbs_fbt_button_label_multiple_products', esc_html__( 'Button Label For Multiple Products', 'wcbs' ) )->set_width(50),
		
	))

	->add_tab( esc_html__( 'Style Settings', 'wcbs' ), array(
		
		// BUTTON STYLE 
		Field::make( 'color', "wcbs_fbt_button_color", esc_html__( 'Button Background Color', 'wcbs' ) )->set_width(25),
		Field::make( 'color', "wcbs_fbt_button_hover_color", esc_html__( 'Button Background Hover Color', 'wcbs' ) )->set_width(25),
		Field::make( 'color', "wcbs_fbt_button_text_color", esc_html__( 'Button Text Color', 'wcbs' ) )->set_width(25),
		Field::make( 'color', "wcbs_fbt_button_text_hover_color", esc_html__( 'Button Text Hover Color', 'wcbs' ) )->set_width(25),
		// Field::make( 'image', "wcbs_fbt_loader_image", esc_html__( 'Loader Image', 'wcbs' ) )
		
	));


/**
 * WooCommerce product data tab definition
 *
 * @return array
 */
add_filter( 'wc_cpdf_init', 'wcbs_fbt_product_metabox' );
function wcbs_fbt_product_metabox( $options ) {

     /** First product data tab starts **/
     /** ===================================== */

     $options['wcbs_fbt_tab'] = array(

		array(
			'tab_name'    => esc_html__( 'Frequently Bought Together', 'wcbs' ),
		),
		array(
			'id' 			=> '_wcbs_fbt_products',
			'type' 			=> 'multiselect',
			'label'			=> esc_html__( 'Select Products', 'wcbs' ),
			'placeholder' 	=> esc_html__( 'Select the Products', 'wcbs' ),
			'options' 		=> wcbs_get_posts(),
			'description'	=> esc_html__( 'Field description.', 'wcbs' ),
			'desc_tip'		=> true,
			'class'			=> 'medium'
		),
	);

     return $options;

}

/**
 * Add group to cart
 *
 * @return void
 * @author 
 **/
add_action( 'wp_loaded', 'wcbs_fbt_add_group_to_cart', 20 );
function wcbs_fbt_add_group_to_cart() {

	if( ! ( isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'wcbs_bought_together' && wp_verify_nonce( $_REQUEST[ '_wpnonce' ], 'wcbs_bought_together' ) ) ) {
		return;
	}

	if( ! isset( $_POST['offeringID'] ) ) {
		return;
	}

	$mess = array();

	foreach( $_POST['offeringID'] as $id ) {

		$product = wc_get_product( $id );

		$attr = array();
		$variation_id = '';
		$product_id = $product->id;

		if( $product->product_type == 'variation' ) {
			$attr           = $product->get_variation_attributes();
			$variation_id   = $product->variation_id;
		}

		if( WC()->cart->add_to_cart( $product_id, 1, $variation_id, $attr ) ) {
			if( version_compare( WC()->version, '2.6', '>=' ) ) {
				$mess[$product_id] = 1;
			}
			else {
				$mess[] = $product_id;
			}
		}
	}

	if( ! empty( $mess ) ) {
		wc_add_to_cart_message( $mess );
	}

	if( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) {
		$cart_url = function_exists('wc_get_cart_url') ? wc_get_cart_url() : WC()->cart->get_cart_url();
		wp_safe_redirect( $cart_url );
		exit;
	}
	else {
		//redirect to product page
		$dest = remove_query_arg( array( 'action', '_wpnonce' ) );
		wp_redirect( esc_url( $dest ) );
		exit;
	}

}

/**
 * Position
 *
 * @return void
 * @author 
 **/
add_action( 'init', 'wcbs_fbt_trigger_hooks' );
function wcbs_fbt_trigger_hooks() {
	$form_placements = wcbs_get_option( 'wcbs_fbt_box_position', 'below_product_summary' );
	if ( is_singular( 'product' ) ) {
		switch ( $form_placements ) {
			case 'below_product_summary':
				add_action( 'woocommerce_single_product_summary', 'wcbs_fbt_render_form', 60 );
				break;

			case 'above_related_products':
				add_action( 'woocommerce_after_single_product_summary', 'wcbs_fbt_render_form', 10 );
				break;

			case 'below_related_products':
				add_action( 'woocommerce_after_single_product_summary', 'wcbs_fbt_render_form', 30 );
				break;
			
			default:
				break;
		}
	}
}

/**
 * Render Form
 *
 * @return void
 * @author 99Plugins
 **/
function wcbs_fbt_render_form() {

	global $product;

	// get meta for current product
	$group  = wcbs_get_wc_value( get_the_ID(), '_wcbs_fbt_products' );

	if ( empty( $group ) || $product->product_type == 'grouped' || $product->product_type == 'external' ) {
		return;
	}

	$product_id = $product->id;

	if ( $product->product_type == 'variable' ) {

		$variations = $product->get_children();

		if( empty( $variations ) ) {
			return;
		}
		// get first product variation
		$product_id = array_shift( $variations );
		$product 	= wc_get_product( $product_id );
	}

	$products[] = $product;
	foreach( $group as $the_id ) {
		$current 	= wc_get_product( $the_id );
		$products[] = $current;
	}

	$get_label_for_single_product_total 		= wcbs_get_option( 'wcbs_fbt_total_label_single_product', 'Price for this Item' );
	$get_label_for_double_product_total 		= wcbs_get_option( 'wcbs_fbt_total_label_double_products', 'Price for 2 Items' );
	$get_label_for_three_product_total 			= wcbs_get_option( 'wcbs_fbt_total_label_three_products', 'Price for 3 Items' );
	$get_label_for_multiple_product_total 		= wcbs_get_option( 'wcbs_fbt_total_label_multiple_products', 'Price for All Items' );

	$get_label_for_single_product_button 		= wcbs_get_option( 'wcbs_fbt_button_label_single_product', 'Add Item to Cart' );
	$get_label_for_double_product_button 		= wcbs_get_option( 'wcbs_fbt_button_label_double_products', 'Add 2 Items to Cart' );
	$get_label_for_three_product_button 		= wcbs_get_option( 'wcbs_fbt_button_label_three_products', 'Add 3 Items to Cart' );
	$get_label_for_multiple_product_button 		= wcbs_get_option( 'wcbs_fbt_button_label_multiple_products', 'Add All Items to Cart' );

	$count_products = count( $group ) + 1;
	switch ( $count_products ) {
		case 1:
			$button_label 	= $get_label_for_single_product_button;
			$total_label 	= $get_label_for_single_product_total;
			break;
		case 2:
			$button_label 	= $get_label_for_double_product_button;
			$total_label 	= $get_label_for_double_product_total;
			break;
		case 3:
			$button_label 	= $get_label_for_three_product_button;
			$total_label 	= $get_label_for_three_product_total;
			break;
		
		default:
			$button_label 	= $get_label_for_multiple_product_button;
			$total_label 	= $get_label_for_multiple_product_total;
			break;
	}

	wc_get_template( 'books/wcbs-fbt-form.php', 
		array( 
			'products' 		=> $products, 
			'button_label' 	=> $button_label, 
			'total_label' 	=> $total_label, 
		), 
		'', 
		NN_WCBS_DIR . 'templates/'  
	);
}

/**
 * Render styles
 *
 * @return void
 * @author 
 **/
add_action( 'wp_head', 'wcbs_fbt_custom_styles', 99 );
function wcbs_fbt_custom_styles() {
	$button_bg_color 			= wcbs_get_option( 'wcbs_fbt_button_color' ); 
	$button_bg_hover_color  	= wcbs_get_option( 'wcbs_fbt_button_hover_color' ); 
	$button_text_color  		= wcbs_get_option( 'wcbs_fbt_button_text_color' ); 
	$button_text_hover_color 	= wcbs_get_option( 'wcbs_fbt_button_text_hover_color' ); 
		
	if ( ! empty( $button_bg_hover_color ) || ! empty( $button_text_hover_color ) && is_singular( 'product' ) ) {
	?>
		<style type="text/css">
			.wcbs-fbt-submit-button:hover {
				background-color : <?php echo ''.$button_bg_hover_color; ?> !important;
				color : <?php echo ''.$button_text_hover_color; ?> !important;
			}
		</style>
	<?php 
	}
}