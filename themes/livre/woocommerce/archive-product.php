<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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
 * @version 	3.4.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>
	
	<div class="container">
		<div class="row">
			<?php
				/**
				 * woocommerce_sidebar hook.
				 *
				 * @hooked woocommerce_get_sidebar - 10
				 */
				$get_layouts 	= livre_get_meta( '_layouts_details' );
				if ( livre_is_has_sidebar() && $get_layouts['theme_layouts']=='left-sidebar' ) : 
					do_action( 'woocommerce_sidebar' );
				endif;
			?>
			
			<div class="content-area <?php livre_columns_class_handles(); ?>">
				<article class="page type-page">

					<?php if ( apply_filters( 'woocommerce_show_page_title', false ) ) : ?>

						<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

					<?php endif; ?>

					<?php
						/**
						 * woocommerce_archive_description hook.
						 *
						 * @hooked woocommerce_taxonomy_archive_description - 10
						 * @hooked woocommerce_product_archive_description - 10
						 */
						do_action( 'woocommerce_archive_description' );
					?>
					
					<?php if ( have_posts() ) : ?>
						
						<?php wc_print_notices(); ?>
						
						<div class="product-sorting">
							<?php
								/**
								 * woocommerce_before_shop_loop hook.
								 *
								 * @hooked woocommerce_result_count - 20
								 * @hooked woocommerce_catalog_ordering - 30
								 */
								do_action( 'woocommerce_before_shop_loop' );
							?>
						</div>

						<?php if ( class_exists( 'Wcbs' ) && 'no' == livre_is_product_view_by_type() && ! isset( $_GET['post_type'] ) && ! is_tax( 'product_cat' ) && ! is_tax( 'product_tag' ) ) : ?>
							<?php wc_get_template_part( 'content-archive-product-alt' ); ?>
						<?php else : ?>

							<?php woocommerce_product_loop_start(); ?>

								<?php woocommerce_product_subcategories(); ?>

								<?php while ( have_posts() ) : the_post(); ?>
					
									<?php livre_woocommerce_content_product_layout(); ?>

								<?php endwhile; // end of the loop. ?>

							<?php woocommerce_product_loop_end(); ?>

							<?php
								/**
								 * woocommerce_after_shop_loop hook.
								 *
								 * @hooked woocommerce_pagination - 10
								 */
								do_action( 'woocommerce_after_shop_loop' );
							?>

						<?php endif; ?>

					<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

						<?php wc_get_template( 'loop/no-products-found.php' ); ?>

					<?php endif; ?>

				</article>
			</div>
				
				<?php 
					if ( livre_is_has_sidebar() && $get_layouts['theme_layouts']=='right-sidebar' ) : 
						do_action( 'woocommerce_sidebar' );
					endif;
				?>
		</div>
	</div>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

<?php get_footer( 'shop' ); ?>
