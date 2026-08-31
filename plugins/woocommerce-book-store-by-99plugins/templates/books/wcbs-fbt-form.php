<?php
/**
 * Form template
 *
 * @author 99Plugins
 * @package WooCommerce Frequently Bought Together by 99plugins
 * @version 1.0.0
 */

global $product;

$index  = $total_price = 0;
$thumbs = $checks = '';

if( ! isset( $products ) ) {
	return;
}

// set query
$url = ! is_null( $product ) ? get_permalink( $product->id ) : '';
$url = add_query_arg( 'action', 'wcbs_bought_together', $url );
$url = wp_nonce_url( $url, 'wcbs_bought_together' );

foreach( $products as $current ) {

	$id = $current->product_type == 'variation' ? $current->variation_id : $current->id;

	if ( $index > 0 )
		$thumbs .= '<td class="image_plus image_plus_' . $index . '" data-rel="offeringID_' . $index . '">+</td>';
	$thumbs .= '<td class="image-td" data-rel="offeringID_' . $index . '"><a href="' . get_permalink( $current->id ) . '">' . $current->get_image( 'shop_thumbnail' ) . '</a></td>';

	ob_start();
	?>
	<li class="wcbs-wfbt-item">
		<label for="offeringID_<?php echo $index ?>">
			<input type="hidden" name="offeringID[]" id="offeringID_<?php echo $index ?>" class="active" value="<?php echo $id ?>" />

			<span class="product-name">
				<?php echo ! $index ? esc_html__( 'This Item : ', 'wcbs' ) . $current->get_title() : $current->get_title(); ?>
			</span>

			<?php

			if ( $current->product_type == 'variation' ) {
				$attributes = $current->get_variation_attributes();
				$variations = array();

				foreach( $attributes as $key => $attribute ) {
					$key = str_replace( 'attribute_', '', $key );

					$terms = get_terms( sanitize_title( $key ), array(
						'menu_order' => 'ASC',
						'hide_empty' => false
					) );

					foreach ( $terms as $term ) {
						if ( ! is_object( $term ) || ! in_array( $term->slug, array( $attribute ) ) ) {
							continue;
						}
						$variations[] = $term->name;
					}
				}

				if( ! empty( $variations ) )
					echo '<span class="product-attributes"> &ndash; ' . implode( ', ', $variations ) . '</span>';
			}

			// echo product price
			echo ' &ndash; <span class="price">' . $current->get_price_html() . '</span>';
			?>

		</label>
	</li>
	<?php
		$checks 		.= ob_get_clean();
		$total_price 	+= floatval( $current->get_display_price() );
		$index++;
}

if ( $index < 2 ) {
	return; // exit if only available product is current
}

// set button label
$get_box_title  = carbon_get_theme_option( 'wcbs_fbt_box_title' );
?>

<div class="wcbs-fbt-section woocommerce">
	<?php if ( ! empty( $get_box_title ) ) : ?>
		<h3><?php echo esc_attr( $get_box_title ); ?></h3>
	<?php else : ?>
		<h3><?php esc_html_e( 'Frequently Bought Together', 'wcbs' ); ?></h3>
	<?php endif; ?>

	<form class="wcbs-fbt-form" method="post" action="<?php echo esc_url( $url ) ?>">
		<table class="wcbs-fbt-images">
			<tbody>
				<tr>
					<?php echo ''.$thumbs ?>
				</tr>
			</tbody>
		</table>

		<div class="wcbs-fbt-submit-block">
			<div class="price_text">
				<span class="total_price_label">
					<?php echo esc_attr( $total_label ); ?>
				</span>
				&nbsp;
				<span class="total_price" data-total="<?php echo ''.$total_price ?>">
					<?php echo wc_price( $total_price ) ?>
				</span>
			</div>
			<input type="submit" class="wcbs-fbt-submit-button button" value="<?php echo esc_attr( $button_label ); ?>">
		</div>

		<ul class="wcbs-fbt-items">
			<?php echo ''.$checks ?>
		</ul>

	</form>
</div>