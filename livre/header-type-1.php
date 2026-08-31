<?php

/**
 * The Template for displaying header type 1
 * used in Taxonomy Pages
 *
 * @author 		tokoo
 * @version     2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$sticky_header 	= get_theme_mod( 'livre_sticky_header', false );
?>

<div class="site-header-wrap <?php echo ( true == $sticky_header ) ? 'is-sticky' : ''; ?>"> 
	<div class="site-header site-header--type-1">
		<div class="container">
			<div class="hdr-widget hdr-widget--menu-main open-onclick">
				<button class="no-ui menu-main-toggle hamburger hamburger--elastic" type="button"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button>
			</div>
			<div class="hdr-widget hdr-widget--site-logo">
				<?php livre_site_title(); ?>
			</div>

			<?php get_template_part( 'menu', 'header-type-2' ); ?>
			
			<div class="hdr-widget hdr-widget--product-search search-dropdown">
				<button class="no-ui search-dropdown-toggle"><i class="ti-search"></i></button>
				<?php get_template_part( 'custom-search-form' ); ?>
			</div>
			
			<?php get_template_part( 'menu-user' ); ?>
			
			<?php if ( class_exists( 'WooCommerce' ) ) : ?>
				<div class="hdr-widget hdr-widget--menu-cart">
					<div class="menu-cart">
						<?php 
							$a_class 	= ! is_rtl() ? 'text-gradient' : 'no-gradient'; 
							$cart_type	= get_theme_mod( 'livre_header_cart_button_type', 'text' );
						?>
						<button class="menu-cart-trigger no-ui">
							<?php if ( 'icon' == $cart_type ) : ?>
								<span class="fa fa-shopping-cart"></span>
							<?php else : ?>
								<span class="<?php echo esc_attr( $a_class ); ?>">
									<?php esc_html_e( 'Cart', 'livre' ); ?> 
								</span>
							<?php endif ?>
							<span class="cart-count"><?php echo WC()->cart->cart_contents_count; ?></span>
						</button>
						<?php the_widget( 'WC_Widget_Cart' ); ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<div class="mobile-menu-wrap">
			<div class="hdr-widget--product-search">
				<?php get_template_part( 'custom-search-form-mobile' ); ?>
			</div>
			<nav class="mobile-menu"></nav>
			<?php get_template_part( 'menu-user' ); ?>
		</div>
	</div>
</div>



