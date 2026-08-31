<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Livre
 */

get_header(); ?>

	<?php 
		/**
		 * livre_before_main_content hook
		 *
		 * @hooked themename_wrapper_start - 10 (outputs opening divs for the content)
		 */
		do_action( 'livre_before_main_content' );
	 ?>
	
	<div class="content-area <?php livre_columns_class_handles(); ?>">
		
		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

			<?php endwhile; ?>

		<?php endif; ?>

		<?php if ( class_exists( 'WooCommerce' ) && is_cart() ) : ?>
			<?php livre_display_cross_sells_product(); ?>
		<?php endif; ?>
	
	</div>

	<?php if ( livre_is_has_sidebar() ) : ?>
		<?php get_sidebar(); ?>
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
