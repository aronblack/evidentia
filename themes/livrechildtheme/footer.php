<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Livre
 */
?>
		<?php 
			$page_id 		= get_queried_object_id();
			$page_details 	= get_post_meta( $page_id, 'livre_page_details', true );
			$disable_footer = ! empty( $page_details['disable_footer'] ) ? $page_details['disable_footer'] : 0;  

			if ( 0 == $disable_footer ) : ?>

				<footer class="site-footer">

					<?php get_sidebar( 'footer' ); ?>
				
					<div class="site-footer__colophon">
						<div class="container">
							<div class="grid-layout columns-2 v-align">
								<div class="grid-item"><span><?php livre_footer_text(); ?></span></div>
								<div class="grid-item text-right">
									<?php 
										$footer_payment_logo = get_theme_mod( 'payment_logo' );
										if ( ! empty( $footer_payment_logo ) ) :
											echo '<img src="' . esc_url( $footer_payment_logo ) . '" alt="'.esc_html__( 'Custom Logo', 'livre' ).'">';
										endif;
									?>
								</div>
							</div>
						</div>
					</div>
				</footer>

			<?php endif; ?>
	</div>
	
	<?php if ( class_exists('WooCommerce') AND ! is_checkout() AND ! is_account_page() ): ?>
		<!-- HEADER FORM LOGIN -->
		<?php get_template_part( 'woocommerce/myaccount/header-form-login' ); ?>
	<?php endif ?>

	<?php wp_footer(); ?>
</body>
</html>
