<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product, $woocommerce_loop;

if ( ! $upsells = $product->get_upsell_ids() ) {
	return;
}

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => 5,
	'orderby'             => 'date',
	'post__in'            => $upsells,
	'post__not_in'        => array( $product->get_id() ),
	'meta_query'          => WC()->query->get_meta_query()
);

$products                    = new WP_Query( $args );
$woocommerce_loop['name']    = 'up-sells';

if ( $products->have_posts() ) : ?>

		
		<h2 class="section__title"><?php echo apply_filters( 'woocommerce_upsells_products_title', esc_html__( 'You may also like&hellip;', 'livre' ) ); ?></h2>

		<ul class="product_list_widget">

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<li>
					<a href="<?php the_permalink(); ?>" class="product-image">
						<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail( 'shop_single' ); ?>
						<?php endif; ?>
					</a>
					<div class="product-detail">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<span class="product-title"><?php the_title(); ?></span>
						</a>
						<?php woocommerce_template_loop_rating(); ?>
						<?php woocommerce_template_loop_price(); ?>
					</div>
				</li>

			<?php endwhile; // end of the loop. ?>
			<?php wp_reset_postdata(); ?>

		</ul>

<?php endif;

wp_reset_postdata();
