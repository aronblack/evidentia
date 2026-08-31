
<?php if ( has_post_thumbnail() ) : ?>
	
	<?php 
		$image 				= wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); 
		$get_video 			= get_post_meta( get_the_ID(), 'wcbs_game_details', true );
		$attachment_ids 	= $product->get_gallery_image_ids();
		
	?>

	<div class="movie-images">
		<div class="movie-case">
			<img class="cover-placeholder" width=400 height=500 src="<?php echo esc_url( $image[0] ); ?>">
			<div class="front-cover">
				<img width=400 height=500 src="<?php echo esc_url( $image[0] ); ?>">
			</div>
			<div class="disc">
				<img width=280 height=280 src="<?php echo esc_url( $image[0] ); ?>">
			</div>
			<div class="back-cover"></div>
		</div>
	
		<!-- DATA TRAILER -->
		<?php 
			if ( ! empty( $get_video['video_type'] ) && 'from_url' == $get_video['video_type'] ) {
				if ( ! empty( $get_video['video_urls'] ) ) {
					$counter = 1;
					foreach ( $get_video['video_urls'] as $vid ) { ?>
						<?php if ( 1 == $counter ) : ?>
							<a href="<?php echo esc_url( $vid['url'] ); ?>" data-vbtype="video" data-autoplay="true" data-gall="product-trailer" class="venobox see-gallery"><i class="ti-video-clapper"></i> <?php esc_html_e( 'See Trailer', 'livre' ); ?></a>
						<?php else : ?>
							<a href="<?php echo esc_url( $vid['url'] ); ?>" data-vbtype="video" data-autoplay="true" class="venobox" data-gall="product-trailer"></a>
						<?php endif; ?>
					<?php 
					$counter++; }
				}
			} else if ( ! empty( $get_video['video_type'] ) && 'from_upload' == $get_video['video_type'] ) {
				if ( ! empty( $get_video['video_files'] ) ) {
					$counter = 1;
					foreach ( $get_video['video_files'] as $vid ) { ?>
						<?php if ( 1 == $counter ) : ?>
							<a href="<?php echo esc_url( $vid['file'] ); ?>" data-vbtype="video" data-autoplay="true" data-gall="product-trailer" class="venobox see-gallery"><i class="ti-video-clapper"></i> <?php esc_html_e( 'See Trailer', 'livre' ); ?></a>
						<?php else : ?>
							<a href="<?php echo esc_url( $vid['file'] ); ?>" class="venobox" data-gall="product-trailer"></a>
						<?php endif; ?>
					<?php 
					$counter++; }
				}
			}
		 ?>

		<a href="<?php echo esc_url( $image[0] ); ?>"  data-gall="product-gallery" class="venobox see-gallery"><i class="ti-gallery"></i> <?php esc_html_e( 'See Gallery', 'livre' ); ?></a>
		<?php if ( ! empty( $attachment_ids ) ) : 
			foreach ( $attachment_ids as $id ) : 
				$get_attachment_src = wp_get_attachment_image_src( $id, 'full' ); ?>
					<a href="<?php echo esc_url( $get_attachment_src[0] ); ?>" class="venobox" data-gall="product-gallery"></a>
			<?php endforeach;
		endif; ?>
	</div>

<?php endif; ?>