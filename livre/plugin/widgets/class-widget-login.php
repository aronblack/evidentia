<?php
if ( class_exists( 'Tokoo_Widget' ) ) {

	if ( ! class_exists('Livre_Login_Form')) {
		// Create custom widget class extending WPH_Widget
		class Livre_Login_Form extends Tokoo_Widget {

			function __construct() {

				$args = array(
					'label' 		=> esc_html__( 'Tokoo - Login Form', 'livre' ),
					'description' 	=> esc_html__( 'A widget to display login form', 'livre' ),
				 );

				// fields array
				$args['fields'] = array(

					// Login Title
					array(
						'name' 		=> esc_html__( 'Login Title', 'livre' ),
						'desc' 		=> esc_html__( 'Enter the login title.', 'livre' ),
						'id' 		=> 'login_title',
						'type' 		=> 'text',
						'class' 	=> 'widefat',
						'std' 		=> '',
						'validate' 	=> 'alpha_dash',
						'filter' 	=> 'strip_tags|esc_attr'
					 ),

					// Logout Title
					array(
						'name' 		=> esc_html__( 'Logout Title', 'livre' ),
						'desc' 		=> esc_html__( 'Enter the logout title.', 'livre' ),
						'id' 		=> 'logout_title',
						'type' 		=> 'text',
						'class' 	=> 'widefat',
						'std' 		=> '',
						'validate' 	=> 'alpha_dash',
						'filter' 	=> 'strip_tags|esc_attr'
					 ),
				 ); // fields array

				$args['options'] 	= array(
						'width'		=> 350,
						'height'	=> 350
					);

				// create widget
				$this->create_widget( $args );
			}


			// Output function
			function widget( $args, $instance ) {

				extract( $args );

				printf( $args['before_widget'] );

				$title = ( is_user_logged_in() ) ? apply_filters( 'widget_title', $instance['login_title'] ) : apply_filters( 'widget_title', $instance['logout_title'] );

				if ( ! empty( $title ) )
					printf( '%s %s %s', $args['before_title'], $title, $args['after_title'] );

				if ( ! is_user_logged_in() ) { ?>

					<form name="wma_login_form" id="wma_login_form" action="<?php echo esc_url( home_url( '/' ) ); ?>/wp-login.php" method="post">
						<p class="login-username">
							<label for="user_login"><?php esc_html_e( 'Username', 'livre' ); ?></label>
							<input type="text" name="log" id="user_login" class="input" value="" size="20" placeholder="<?php esc_html_e( 'Username', 'livre' ); ?>">
						</p>
						<p class="login-password">
							<label for="user_pass"><?php esc_html_e( 'Password', 'livre' ); ?></label>
							<input type="password" name="pwd" id="user_pass" class="input" value="" size="20" placeholder="<?php esc_html_e( 'Password', 'livre' ); ?>">
						</p>
						<p>
							<input type="checkbox" name="rememberme" value="forever" />
							<label for="rememberme"><?php esc_html_e( 'Remember me', 'livre' ); ?></label>
						</p>
						<p class="login-submit">
							<button class="button" type="submit">
								<i class="fa fa-sign-in"></i> <?php esc_html_e( 'Login', 'livre' ); ?>
							</button>
							<input type="hidden" name="redirect_to" value="<?php echo esc_url( home_url( '/' ) ); ?>">
						</p>

					</form>

					<p>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>/wp-login.php?action=lostpassword"><?php esc_html_e( 'Lost your password?', 'livre' ); ?></a>
					</p>

					<?php

				} else {

					$current_user = wp_get_current_user(); ?>

					<ul class="no-list-style">
						<li>
							<?php esc_html_e( 'Welcome back,', 'livre' ); ?>
							<?php echo (isset($current_user->first_name) && $current_user->first_name != '') ? $current_user->first_name : $current_user->nickname; ?>.
						</li>
						<?php if ( current_user_can( 'edit_posts' ) ) : ?>
							<li>
								<a href="<?php echo esc_url( site_url() ); ?>/wp-admin/"><?php esc_html_e( 'Administration', 'livre' ); ?></a>
							</li>
						<?php endif; ?>
						<li>
							<a href="<?php echo esc_url( site_url() ); ?>/wp-admin/profile.php"><?php esc_html_e( 'Profile', 'livre' ); ?></a>
						</li>
						<li><a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?> "><?php esc_html_e( 'Logout', 'livre' ); ?></a></li>
					</ul>

					<?php
				}

				printf( $args['after_widget'] );

			}

		} // class
	}

}


if ( ! function_exists( 'Livre_Login_Form_init' ) && class_exists( 'Livre_Login_Form' ) ) {
	function Livre_Login_Form_init() {
		register_widget('Livre_Login_Form');
	}
	add_action('widgets_init', 'Livre_Login_Form_init');
}