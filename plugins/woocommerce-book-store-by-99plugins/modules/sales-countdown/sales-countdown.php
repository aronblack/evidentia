<?php 

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'theme_options', esc_html__( 'WooCommerce Product Countdown', 'wcbs' ) )
	->set_page_parent( 'nn-plugins-dashboard.php' ) // identificator of the "Appearance" admin section
	->add_tab( esc_html__( 'General Settings', 'wcbs' ), array(
		// BY VIEWED
		Field::make( 'checkbox', 'wcbs_enable_product_sales_countdown', esc_html__( 'Enable Product Sales Countdown Feature', 'wcbs' ) )
			->set_default_value( 'yes' ),

));


/**
 * WooCommerce product data tab definition
 *
 * @return array
 */
add_filter( 'wc_cpdf_init', 'wcbs_product_sales_countdown_metabox' );
function wcbs_product_sales_countdown_metabox( $options ) {

	 /** First product data tab starts **/
	 /** ===================================== */

	 $options['wcbs_sc_tab'] = array(

		array(
			'tab_name'    => esc_html__( 'Sales Countdown', 'wcbs' ),
		),
		array(
			'id'			=> 'wcbs_enable_product_sales_countdown',
			'type' 			=> 'checkbox',
			'label' 		=> esc_html__( 'Enable', 'wcbs' ),
			'description' 	=> esc_html__( 'Enable Product Sales Countdown.', 'wcbs' ),
			'desc_tip' 		=> false,
	   ),
		array(
			'id' 			=> 'wcbs_product_sales_countdown_start',
			'type' 			=> 'datepicker',
			'label' 		=> esc_html__( 'Start Date', 'wcbs' ),
			'placeholder' 	=> esc_html__( 'Choose the start date', 'wcbs' ),
			'class' 		=> 'large',
			'description' 	=> esc_html__( 'Choose the start date', 'wcbs' ),
			'desc_tip' 		 => true,
	   ),
		array(
			'id' 			=> 'wcbs_product_sales_countdown_end',
			'type' 			=> 'datepicker',
			'label' 		=> esc_html__( 'End Date', 'wcbs' ),
			'placeholder' 	=> esc_html__( 'Choose the end date', 'wcbs' ),
			'class' 		=> 'large',
			'description' 	=> esc_html__( 'Choose the end date', 'wcbs' ),
			'desc_tip' 		 => true,
	   ),

	);

	 return $options;

}

add_action( 'woocommerce_single_product_summary', 'wcbs_sales_countdown_display_single_content', 31 );
function wcbs_sales_countdown_display_single_content() {
	$product 			= wc_get_product( get_the_ID() );
	$get_regular_price 	= get_post_meta( get_the_ID(), '_regular_price', true );
	$get_sale_price 	= get_post_meta( get_the_ID(), '_sale_price', true );
	$regular_price 		= ! empty( $get_regular_price ) ? $get_regular_price : '';
	$sale_price 		= ! empty( $get_sale_price ) ? $get_sale_price : '';

	if ( function_exists( 'wcbs_get_wc_value' ) ) {
		$get_countdown_status 	= wcbs_get_wc_value( get_the_ID(), 'wcbs_enable_product_sales_countdown' );
		$get_start_date 		= wcbs_get_wc_value( get_the_ID(), 'wcbs_product_sales_countdown_start' );
		$start_date 			= ! empty( $get_start_date ) ? $get_start_date : '';
		$get_end_date 			= wcbs_get_wc_value( get_the_ID(), 'wcbs_product_sales_countdown_end' );
		$end_date 				= ! empty( $get_end_date ) ? $get_end_date : '';
	}
	?>
	
	<?php if ( 'yes' == $get_countdown_status && $product->is_type( 'simple' ) ) : ?>
		
		<div class="product__price">
			<?php if ( ! is_singular( 'product' ) ) : ?>
				<div class="price">
					<div class="sale-price"><?php echo wc_price( $sale_price ); ?></div>
					<div class="regular-price"><del><?php echo wc_price( $regular_price ); ?></del> <?php esc_html_e( 'Reg. Price', 'wcbs' ); ?></div>
				</div>
			<?php endif; ?>

			<div class="product-deals-info">
				<div class="deal-countdown">
					<div class="label">Ends in</div>
					<div id="sales-countdown<?php the_ID(); ?>" class="product-date product-date-count-down" data-date="<?php echo esc_attr( $end_date ); ?>">
					</div>
				</div>
				<div class="deal-saving">
					<?php 
						$selisih 			= $regular_price - $sale_price;
						$deal_saving 		= ( $selisih / $regular_price ) * 100;
					 ?>
					<span class="saving">
						<span class="label"><?php esc_html_e( 'Saving', 'wcbs' ); ?></span>
						<span class="value"><?php echo round( $deal_saving ); ?>%</span>
					</span>
					<span class="saving">
						<span class="label"><?php esc_html_e( 'Value', 'wcbs' ); ?></span>
						<span class="value"><?php echo wc_price( $regular_price ); ?></span>
					</span>
					<span class="saving">
						<span class="label"><?php esc_html_e( 'You Save', 'wcbs' ); ?></span>
						<span class="value"><?php echo wc_price( $selisih ); ?></span>
					</span>
				</div>
			</div>
		</div>

	<?php endif; ?>
	<?php 
}

function wcbs_sales_countdown_display_content() {
	?>
	<div class="product-deals-info">
		<?php 
			if ( function_exists( 'wcbs_get_wc_value' ) ) {
				$get_countdown_status 	= wcbs_get_wc_value( get_the_ID(), 'wcbs_enable_product_sales_countdown' );
				$get_start_date 		= wcbs_get_wc_value( get_the_ID(), 'wcbs_product_sales_countdown_start' );
				$start_date 			= ! empty( $get_start_date ) ? $get_start_date : '';
				$get_end_date 			= wcbs_get_wc_value( get_the_ID(), 'wcbs_product_sales_countdown_end' );
				$end_date 			= ! empty( $get_end_date ) ? $get_end_date : '';
			}
				$get_regular_price 	= get_post_meta( get_the_ID(), '_regular_price', true );
				$get_sale_price 	= get_post_meta( get_the_ID(), '_sale_price', true );
				$regular_price 		= ! empty( $get_regular_price ) ? $get_regular_price : '';
				$sale_price 		= ! empty( $get_sale_price ) ? $get_sale_price : '';
		 ?>
		<div class="deal-countdown">
			<span><?php esc_html_e( 'Ends in', 'wcbs' ); ?> </span>
			<span id="sales-countdown<?php the_ID(); ?>" class="product-date product-date-count-down" data-date="<?php echo esc_attr( $end_date ); ?>">
			</span>
		</div>
	</div>
	<?php 
}