<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

while ( have_posts() ) : the_post(); ?>

 <div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="product-overview">
		<?php do_action( 'yith_wcqv_product_image' ); ?>

		<div class="product-overview__summary">
			<h1 class="product__title"><?php single_post_title(); ?></h1>
			<div class="product__meta">
				<?php if ( function_exists( 'wcbs_books_display_single_book_author' ) ) : ?>
					<?php wcbs_books_display_single_book_author(); ?>
				<?php endif; ?>
				<?php livre_single_rating(); ?>
			</div>
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
	</div>

</div><!-- #product-<?php the_ID(); ?> -->

<?php endwhile; // end of the loop.