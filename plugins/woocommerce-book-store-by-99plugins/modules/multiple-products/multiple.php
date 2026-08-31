<?php 

/**
 * Add metabox
 *
 * @return void
 * @author 99plugins
 **/
add_action( 'add_meta_boxes', 'wcbs_multiple_products_add_meta_boxes', -100 );
function wcbs_multiple_products_add_meta_boxes( $post ){
	add_meta_box( 'wcbs_multiple_products_type', esc_html__( 'Product Type', 'wcbs' ), 'wcbs_multiple_product_build_metabox', 'product', 'normal', 'high' );
}

/**
 * Build metabox
 *
 * @return void
 * @author 99plugins
 **/
function wcbs_multiple_product_build_metabox( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'wcbs_multiple_products_meta_box_nonce' );
	$get_default_type 	= get_theme_mod( 'pustaka_product_default_type', 'regular' );
	$current_type 		= get_post_meta( $post->ID, 'wcbs_product_type', true );
	$current_type 		= empty( $current_type ) ? $get_default_type : $current_type;
	?>
	<div class="tokoo-product-type">
		<label class="tokoo-product-option">
			<input type="radio" name="wcbs-product-type" value="regular" <?php checked( $current_type, 'regular' ); ?>>
			<div class="tokoo-product-type-detail">
				<figure><img src="<?php echo get_template_directory_uri(); ?>/assets/img/pt-regular.png" alt=""></figure>
				<div class="tokoo-product-type-label"><?php esc_html_e( 'Regular', 'wcbs' ); ?></div>
			</div>
		</label>
		<label class="tokoo-product-option">
			<input type="radio" name="wcbs-product-type" value="book" <?php checked( $current_type, 'book' ); ?>>
			<div class="tokoo-product-type-detail">
				<figure><img src="<?php echo get_template_directory_uri(); ?>/assets/img/pt-book.png" alt=""></figure>
				<div class="tokoo-product-type-label"><?php esc_html_e( 'Book', 'wcbs' ); ?></div>
			</div>
		</label>
		<label class="tokoo-product-option">
			<input type="radio" name="wcbs-product-type" value="audio" <?php checked( $current_type, 'audio' ); ?>>
			<div class="tokoo-product-type-detail">
				<figure><img src="<?php echo get_template_directory_uri(); ?>/assets/img/pt-audio.png" alt=""></figure>
				<div class="tokoo-product-type-label"><?php esc_html_e( 'Audio', 'wcbs' ); ?></div>
			</div>
		</label>
		<label class="tokoo-product-option">
			<input type="radio" name="wcbs-product-type" value="movie" <?php checked( $current_type, 'movie' ); ?>>
			<div class="tokoo-product-type-detail">
				<figure><img src="<?php echo get_template_directory_uri(); ?>/assets/img/pt-movie.png" alt=""></figure>
				<div class="tokoo-product-type-label"><?php esc_html_e( 'Movie', 'wcbs' ); ?></div>
			</div>
		</label>
		<label class="tokoo-product-option">
			<input type="radio" name="wcbs-product-type" value="game" <?php checked( $current_type, 'game' ); ?>>
			<div class="tokoo-product-type-detail">
				<figure><img src="<?php echo get_template_directory_uri(); ?>/assets/img/pt-game.png" alt=""></figure>
				<div class="tokoo-product-type-label"><?php esc_html_e( 'Game', 'wcbs' ); ?></div>
			</div>
		</label>
	</div>
	<?php 
}

/**
 * Save metabox
 *
 * @return void
 * @author 99plugins
 **/
add_action( 'save_post', 'wcbs_multiple_products_save_meta', 10, 2 );
function wcbs_multiple_products_save_meta( $post_id, $post ) {   
	// verify nonce
	if ( ! isset( $_POST['wcbs_multiple_products_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['wcbs_multiple_products_meta_box_nonce'], basename(__FILE__) ) ) {
		return $post_id; 
	}
	
	$old = get_post_meta( $post_id, 'wcbs_product_type', true );
	$new = isset( $_POST['wcbs-product-type'] ) ? esc_attr( $_POST['wcbs-product-type'] ) : '';

	if ( $new && $new !== $old ) {
		update_post_meta( $post_id, 'wcbs_product_type', $new );
	} elseif ( '' === $new && $old ) {
		delete_post_meta( $post_id, 'wcbs_product_type', $old );
	}
}