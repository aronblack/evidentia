<div class="user-auth-box tokoo-popup"> 
	<div class="user-auth-overlay"></div>
	<div class="user-auth-box-content grid-layout columns-2">
		<?php wc_print_notices(); ?>
		<button class="tokoo-popup__close"><i class="dripicons-cross"></i></button>
		<form method="post" class="login grid-item">
			<header class="section-header">
				<h2 class="section-title"><?php esc_html_e( 'Great to have you back', 'livre' ); ?></h2>
			</header>
			<?php do_action( 'woocommerce_login_form_start' ); ?>
			<div class="form-row login-username">
				<label for="username"><?php esc_html_e( 'Username or email address', 'livre' ); ?> <span class="required">*</span></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" placeholder="<?php esc_html_e( 'Your Username/Email', 'livre' ); ?>"/>
			</div>
			<div class="form-row login-password">
				<label for="password"><?php esc_html_e( 'Password', 'livre' ); ?> <span class="required">*</span></label>
				<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" placeholder="<?php esc_html_e( 'Your Password', 'livre' ); ?>" />
			</div>
			<?php do_action( 'woocommerce_login_form' ); ?>

			<div class="login-action">
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<label for="rememberme" class="inline">
					<input class="woocommerce-Input woocommerce-Input--checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php esc_html_e( 'Remember me', 'livre' ); ?>
				</label>
				<input type="submit" class="woocommerce-Button button" name="login" value="<?php esc_attr_e( 'Login', 'livre' ); ?>" />
			</div>
			<a class="lostpassword" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'livre' ); ?></a>
			<?php do_action( 'woocommerce_login_form_end' ); ?>
		</form>
		<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
		<form method="post" class="register grid-item">
			<header class="section-header">
				<h2 class="section-title"><?php esc_html_e( 'Need to create an account?', 'livre' ); ?></h2>
			</header>

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

			<div class="form-row register-username">
				<label for="reg_username"><?php esc_html_e( 'Username', 'livre' ); ?> <span class="required">*</span></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
			</div>
			<?php endif; ?>
			
			<div class="form-row register-email">
				<label for="reg_email"><?php esc_html_e( 'Email address', 'livre' ); ?> <span class="required">*</span></label>
				<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
			</div>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
			
			<div class="form-row register-password">
				<label for="reg_password"><?php esc_html_e( 'Password', 'livre' ); ?> <span class="required">*</span></label>
				<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" />
			</div>

			<?php endif; ?>

			<!-- Spam Trap -->
			<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php esc_html_e( 'Anti-spam', 'livre' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

			<?php do_action( 'woocommerce_register_form' ); ?>
			<?php do_action( 'register_form' ); ?>

			<div class="register-action">
				<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
				<input type="submit" class="woocommerce-Button button" name="register" value="<?php esc_attr_e( 'Register', 'livre' ); ?>" />
			</div>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>
		<?php endif; ?>
		
	</div>
</div>