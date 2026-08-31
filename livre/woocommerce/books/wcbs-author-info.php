<?php 

/**
 * Author Info template
 *
 * @author 99Plugins
 * @package WooCommerce Book Store Plugins
 * @version 1.0.0
 */
 ?>

<?php if ( ! empty( $author_info ) ) : ?>
	<div class="grid-layout columns-3">
		<?php foreach ( $author_info as $author ) : ?>
			
			<?php 
				$get_author_img_id 		= carbon_get_term_meta( $author->term_id, 'wcbs_author_picture' );
				$get_author_birthday 	= carbon_get_term_meta( $author->term_id, 'wcbs_author_birthday' );
				$get_author_facebook 	= carbon_get_term_meta( $author->term_id, 'wcbs_author_facebook' );
				$get_author_twitter 	= carbon_get_term_meta( $author->term_id, 'wcbs_author_twitter' );
				$get_author_instagram 	= carbon_get_term_meta( $author->term_id, 'wcbs_author_instagram' );
				$get_author_gplus 		= carbon_get_term_meta( $author->term_id, 'wcbs_author_google_plus' );
			 ?>
			<div class="author-info-wrapper featured-author grid-item">
				<?php 
					
					$author_picture 	= wp_get_attachment_image_src( $get_author_img_id, 'thumbnail' ); 
					if ( ! empty( $get_author_img_id ) ) {
						echo '<figure class="featured-author__image">';
							echo '<img src="'.esc_url( $author_picture[0] ).'" alt="'.esc_html__( 'Author Picture', 'livre' ).'">';
						echo '</figure>';
					}
				 ?>
				<div class="author__details featured-author__detail">
					<h3 class="featured-author__name"><a href="<?php echo esc_url( get_term_link( $author->slug, 'book_author' ) ); ?>"><?php echo esc_attr( $author->name ); ?></a></h3>
					<span class="author-birthday featured-author__books">
						<?php if ( ! empty( $get_author_birthday ) ) : ?>
							<?php echo esc_attr( $get_author_birthday ); ?>
						<?php endif; ?>
					</span>
					<div class="author__bio">
						<?php echo wpautop( $author->description ); ?>
					</div>
					<div class="author-socials social-links small rounded text-center">
						<?php if ( ! empty( $get_author_facebook ) ) : ?>
							<a href="<?php echo esc_url( $get_author_facebook ); ?>" class="facebook"><i class="fa fa-facebook"></i></a>
						<?php endif; ?>
						<?php if ( ! empty( $get_author_twitter ) ) : ?>
							<a href="<?php echo esc_url( $get_author_twitter ); ?>" class="twitter"><i class="fa fa-twitter"></i></a>
						<?php endif; ?>
						<?php if ( ! empty( $get_author_instagram ) ) : ?>
							<a href="<?php echo esc_url( $get_author_instagram ); ?>" class="instagram"><i class="fa fa-instagram"></i></a>
						<?php endif; ?>
						<?php if ( ! empty( $get_author_gplus ) ) : ?>
							<a href="<?php echo esc_url( $get_author_gplus ); ?>" class="google-plus"><i class="fa fa-google-plus"></i></a>
						<?php endif; ?>
					</div>	
				</div>
			</div>

		<?php endforeach; ?>
	</div>
<?php endif; ?>
