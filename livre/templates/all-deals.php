<?php

/**
 * Template Name: All Deals
 *
 * The Template for page template all deals
 *
 * @author 		tokoo
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header(); ?>
	
	<?php
		/**
		 * livre_before_main_content hook
		 *
		 * @hooked themename_wrapper_start - 10 (outputs opening divs for the content)
		 */
		do_action( 'livre_before_main_content' );
	 ?>
		
		<?php 
			$get_end_date 		= wcbs_get_wc_value( get_the_ID(), 'wcbs_product_sales_countdown_end' );
			$end_date 			= ! empty( $get_end_date ) ? $get_end_date : '';
			$meta_query   		= array();
	        $meta_query[] 		= WC()->query->visibility_meta_query();
	        $meta_query[] 		= WC()->query->stock_status_meta_query();
	        $meta_query   		= array_filter( $meta_query );
			$args = array(
				'post_type'		=> 'product', 
				'order'			=> 'DESC',
				'meta_query' 	=> $meta_query,
				'post__in' 		=> array_merge( array( 0 ), wc_get_product_ids_on_sale() ),
			);
			$the_products 	= new WP_Query( $args );
			$counter 		= 1;
		 ?>
		<?php if ( $the_products->have_posts() ) : ?>

			<div class="product-grid grid-layout columns-4">

				<?php while ( $the_products->have_posts() ) : $the_products->the_post(); 

					$the_product = wc_get_product( get_the_ID() );
					if ( $the_product->is_type( 'simple' ) ) {
						wc_get_template_part( 'content', 'product-for-king' );
					}

				$counter++; endwhile; ?>
				<?php wp_reset_postdata(); ?>

			</div>
			
		<?php endif; ?>

	 <?php
		/**
		 * livre_after_main_content hook
		 *
		 * @hooked themename_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'livre_after_main_content' );
	 ?>

<?php get_footer(); ?>