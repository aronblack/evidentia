<?php if ( ! empty( $content ) ) : ?>
	<h2 class="woocommerce-Reviews-title"><?php esc_html_e( 'Editorial Review', 'livre' ); ?></h2>
	<?php echo wpautop( $content ); ?>
<?php endif; ?>