	
<?php if ( has_post_thumbnail() ) : ?>
	
	<?php 
		$image 		= wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); 
		$product 	= wc_get_product( get_the_ID() );
	 ?>
	<div class="music-cover-wrap">
		<div class="music-cover">
			<img class="cover-placeholder" src="<?php echo esc_url( $image[0] ); ?>" alt="<?php esc_html_e( 'Featured Image', 'livre' ); ?>">
			<div class="front-cover">
				<img class="cover" src="<?php echo esc_url( $image[0] ); ?>" alt="<?php esc_html_e( 'Featured Image', 'livre' ); ?>">
				<button class="play"><i class="dripicons-media-play"></i></button>
			</div>
			<img class="disc" src="<?php echo get_template_directory_uri(); ?>/assets/img/disc.png" alt="<?php esc_html_e( 'Featured Image', 'livre' ); ?>">
		</div>
		
		<?php if ( $product->is_type( 'external' ) ) : ?>
			<?php 
				$get_app_store_link 	= wcbs_get_wc_value( get_the_ID(), 'wcbs_app_store_affiliate_link' );
				$get_play_store_link 	= wcbs_get_wc_value( get_the_ID(), 'wcbs_play_store_affiliate_link' );
			 ?>
			<?php if ( ! empty( $get_app_store_link ) ) : ?>
				<a href="<?php echo esc_url( $get_app_store_link ) ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/appstore.png" alt="<?php esc_html_e( 'App Store', 'livre' ); ?>"></a>
			<?php endif; ?>

			<?php if ( ! empty( $get_play_store_link ) ) : ?>
				<a href="<?php echo esc_url( $get_play_store_link ) ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/playstore.png" alt="<?php esc_html_e( 'Play Store', 'livre' ); ?>"></a>
			<?php endif; ?>

		<?php endif; ?>

		<?php 
			$get_audio 	= get_post_meta( get_the_ID(), 'wcbs_audio_details', true );
			
			if ( ! $product->is_type( 'external' ) && ! empty( $get_audio['audio_ids'] ) ) : 
			
			$ids = array();
			foreach ( $get_audio['audio_ids'] as $file ) :
				$ids[] = attachment_url_to_postid( $file['id'] );
			endforeach; 

			if ( ! empty( $ids ) ) {
				echo do_shortcode( '[playlist artists=true ids="'.implode( ',', $ids ).'"]' );
			}
		endif; ?>
	</div>

<?php endif; ?>