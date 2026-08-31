<?php
if ( ! function_exists('tokoo_add_user_meta_field')) {
	/**
	 * Add user meta field
	 *
	 * @return void
	 **/
	add_filter( 'user_contactmethods', 'tokoo_add_user_meta_field' );
	function tokoo_add_user_meta_field( $profile_fields ) {
		// Add new fields
		$profile_fields['facebook'] 	= esc_html__( 'Facebook URL', 'tokoo-vitamins' );
		$profile_fields['twitter'] 		= esc_html__( 'Twitter URL', 'tokoo-vitamins' );
		$profile_fields['pinterest'] 	= esc_html__( 'Pinterest URL', 'tokoo-vitamins' );
		$profile_fields['instagram'] 	= esc_html__( 'Instagram URL', 'tokoo-vitamins' );
		$profile_fields['gplus'] 		= esc_html__( 'Google Plus URL', 'tokoo-vitamins' );
		$profile_fields['linkedin'] 	= esc_html__( 'Linkedin URL', 'tokoo-vitamins' );

		return $profile_fields;
	}
}


if ( ! function_exists('tokoo_social_share')) {
	/**
	 * Social Share
	 *
	 * @return void
	 * @author tokomoo
	 **/

	function tokoo_social_share() {
		global $post;

		if ( has_post_thumbnail() ) {
			$image 		= wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large', false );
			$the_image 	= 'data-image="'.$image[0].'"';
		} else {
			$the_image 	= '';
		}
		ob_start();
		?>
			<div class="post__share" data-title="<?php echo get_the_title(); ?>" data-text="<?php echo strip_tags( $post->post_excerpt ); ?>" <?php echo ''.$the_image; ?> data-url="<?php echo esc_url( get_permalink() ); ?>" data-width=640 data-height=480>
				<a href="#" class="facebook s_facebook"><i class="fa fa-facebook"></i><span class="label">Facebook</span></a>
				<a href="#" class="twitter s_twitter"><i class="fa fa-twitter"></i><span class="label">Twitter</span></a>
				<a href="#" class="google-plus s_plus"><i class="fa fa-google-plus"></i><span class="label">Google+</span></a>
				<a href="#" class="linkedin s_linkedin"><i class="fa fa-linkedin"></i><span class="label">LinkedIn</span></a>
			</div>
		<?php
		$share_html = ob_get_contents();
		ob_end_clean();

		echo apply_filters( 'tokoo_social_share_html', $share_html );
	}
}