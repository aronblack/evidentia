<?php

/**
 * The Template for displaying menu user
 *
 * @author 		tokoo
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php if ( class_exists( 'WooCommerce' ) ) : ?>
		
	<div class="hdr-widget hdr-widget--menu-user">
		
		<?php if ( is_user_logged_in() ) : 
			
			$current_user = wp_get_current_user();

			if ( ( $current_user instanceof WP_User ) ) {
				echo '<button class="no-ui menu-user-avatar">';
					echo get_avatar( $current_user->user_email, 30 );
					if ( ! empty( $current_user->user_login ) ) {
						echo '<span class="user-name">';
							echo esc_attr( $current_user->user_login );
						echo '</span>';
					}
				echo '</button>';
			}
			?>

			<div class="menu-user-wrap">
				
				<?php if ( has_nav_menu( 'livre-user' ) ) : 

					$menu_args = array(
						'theme_location' => 'livre-user',
						'container'      => false
					);
					wp_nav_menu( $menu_args );

				else : ?>

					<ul class="menu">
						<?php 
						if ( class_exists('WCV_Vendors') && WCV_Vendors::is_vendor( $current_user->ID ) ) :
							$dashbroad_url = get_permalink(WC_Vendors::$pv_options->get_option( 'vendor_dashboard_page' )); ?>
							<li class="menu-item"><a href="<?php echo esc_url( $dashbroad_url ); ?>"><?php esc_html_e( 'My Dashboard', 'livre' ); ?></a></li>
						<?php endif; ?>	
						<?php 
						if ( class_exists('WCMp')) { ?>
							<li class="menu-item"><a href="<?php echo esc_url( wcmp_get_vendor_dashboard_endpoint_url(get_wcmp_vendor_settings('wcmp_vendor_announcements_endpoint', 'vendor', 'general' )) ); ?>"><?php esc_html_e( 'My Dashboard', 'livre' ); ?></a></li>
						<?php } ?>
						<li class="menu-item"><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><?php esc_html_e( 'My Account', 'livre' ); ?></a></li>
						<li class="menu-item"><a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>"><?php esc_html_e( 'My Orders', 'livre' ); ?></a></li>
						<?php if ( class_exists( 'YITH_WCWL' ) ) : ?>
							<?php $wishlist_page_id = get_option( 'yith_wcwl_wishlist_page_id' ); ?>
							<li class="menu-item"><a href="<?php echo esc_url( get_permalink( $wishlist_page_id ) ); ?>"><?php esc_html_e( 'My Wishlist', 'livre' ); ?></a></li>
						<?php endif; ?>
						<li class="menu-item"><a href="<?php echo wp_logout_url( home_url() ); ?>"><?php esc_html_e( 'Logout', 'livre' ); ?></a></li>
					</ul>
					
				<?php endif; ?>
			</div>

		<?php else : ?>

			<div class="menu-nologin-user-wrap">
				<a class="open-login-popup" href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>"><?php esc_html_e( 'Log In', 'livre' ); ?></a>
			</div>

		<?php endif; ?>
	</div>

<?php endif; ?>	