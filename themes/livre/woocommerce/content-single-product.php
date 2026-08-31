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
 * @version 	3.6.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
	/** 
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
		echo get_the_password_form();
		return;
	 }
?>

<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
		<div class="col-md-6">
			<h1 class="product__title"><?php single_post_title(); ?></h1>
			<?php livre_single_product_sale_flash(); ?>

			<div class="product__meta">
				<?php if ( function_exists( 'wcbs_books_display_single_book_author' ) ) : ?>
					<?php wcbs_books_display_single_book_author(); ?>
				<?php endif; ?>
				<?php livre_single_rating(); ?>
			</div>
		</div>
		<div class="col-md-6">
			<div class="product-single-price text-right">
				<?php woocommerce_template_single_price() ?>
			</div>
		</div>
	</div>

	<hr class="white-space">

	<div class="product-overview__image">
		<?php
			/**
			 * woocommerce_before_single_product_summary hook.
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10 : removed
			 * @hooked woocommerce_show_product_images - 20 : removed
			 */
			do_action( 'woocommerce_before_single_product_summary' );
		?>
	</div>

	<div class="product-overview__summary">
		<div class="product__excerpt">
			<?php livre_single_excerpt(); ?>
		</div>
		<div class="product-action">
			<?php
				/**
				 * woocommerce_single_product_summary hook.
				 *
				 * @hooked woocommerce_template_single_title - 5 : removed
				 * @hooked woocommerce_template_single_rating - 10 :removed
				 * @hooked woocommerce_template_single_price - 10 
				 * @hooked woocommerce_template_single_excerpt - 20 : removed
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 */
				do_action( 'woocommerce_single_product_summary' );
			?>
		</div>
	</div><!-- .summary -->

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>