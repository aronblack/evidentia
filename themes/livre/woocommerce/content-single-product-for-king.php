<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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
 * @version     3.0.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$get_back_cover_img = carbon_get_post_meta( get_the_ID() , 'wcbs_book_back_cover_image' );
$back_cover_img_src = wp_get_attachment_image_src( $get_back_cover_img, 'shop_single' );
?>

<div id="product-<?php the_ID(); ?>" <?php post_class( "deal-end-soon" ); ?>>
	<div class="product-overview__image">
		<div class="book-images">
			<div class="book">
				<?php the_post_thumbnail( 'shop_single' ); ?>
				<div class="book__page book__page--front">
					<?php the_post_thumbnail( 'shop_single' ); ?>
				</div>
				<div class="book__page book__page--back">
					<?php if ( ! empty( $get_back_cover_img ) ) : ?>
						<img src="<?php echo esc_url( $back_cover_img_src[0] ); ?>" alt="<?php esc_html_e( 'Back Cover', 'livre' ); ?>">
					<?php endif; ?>
				</div>
				<div class="book__page book__page--first-page"></div>
				<div class="book__page book__page--second-page"></div>
				<div class="book__page book__page--side"></div>
				<div class="book__page book__page--side-paper"></div>
			</div>
			<div class="book__action">
				<button class="see-back">
					<i class="dripicons-clockwise"></i>
					<span><?php esc_html_e( 'Flip to Back', 'livre' ); ?></span>
				</button>
			</div>
		</div>
		<!-- <div class="book"> -->
			<?php //if ( has_post_thumbnail() ) : ?>
				<?php //the_post_thumbnail( 'shop_single' ); ?>
			<?php //endif; ?>
		<!-- </div> -->
	</div> 

	<div class="product-overview__summary">
		<?php woocommerce_show_product_sale_flash(); ?>
		<h1 class="product__title"><?php the_title(); ?></h1>
		<div class="product__meta">
			<?php if ( function_exists( 'wcbs_books_display_single_book_author' ) ) : ?>
				<?php wcbs_books_display_single_book_author(); ?>
			<?php endif; ?>
			<?php woocommerce_template_single_rating(); ?>
		</div>
		<div class="product__excerpt">
			<?php livre_single_excerpt(); ?>
		</div>

		<?php if ( function_exists( 'wcbs_sales_countdown_display_single_content' ) ) : ?>
			<?php wcbs_sales_countdown_display_single_content(); ?>
		<?php endif; ?>
			
		<div class="product-action">
			<a href="<?php the_permalink(); ?>" class="single_add_to_cart_button button alt"><?php esc_html_e( 'See Details', 'livre' ); ?></a>
		</div>
	</div><!-- .summary -->


	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>