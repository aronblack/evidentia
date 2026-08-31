
<?php if ( has_post_thumbnail() ) : ?>
	
	<?php $image = pustaka_get_featured_image_url(); ?>

	<div class="movie-images">
		<div class="movie-case">
			<img class="cover-placeholder" width=400 height=500 src="<?php echo pustaka_resize( $image, 400, 500 ); ?>">
			<div class="front-cover">
				<img width=400 height=500 src="<?php echo pustaka_resize( $image, 400, 500 ); ?>">
			</div>
			<div class="disc">
				<img width=280 height=280 src="<?php echo pustaka_resize( $image, 280, 280 ); ?>">
			</div>
			<div class="back-cover"></div>
		</div>
		<a href="#" class="see-gallery"><i class="dripicons-eye"></i> See Gallery</a>
	</div>

<?php endif; ?>