<?php 
	$attachment_ids 	= $product->get_gallery_image_ids();
	$get_featured_img 	= wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'full' );
	$get_back_cover_img = carbon_get_the_post_meta( 'wcbs_book_back_cover_image' );
	$back_cover_img_src = wp_get_attachment_image_src( $get_back_cover_img, 'full' );
	
	if ( has_post_thumbnail() ) : ?>
		
		<div class="book-images">
			<div class="book">
				<?php $custom_image = get_post_meta( get_the_ID(), 'livre_product_image_dimension', true ); ?><?php if ( ! empty( $custom_image['width'] ) && ! empty( $custom_image['height'] ) && function_exists( 'livre_resize' )): ?>

					<img src="<?php echo livre_resize( $get_featured_img[0], $custom_image['width'], $custom_image['height'] ); ?>" class="placeholder">
				<?php else : ?>
					<?php the_post_thumbnail( 'shop_single', array( 'class' => 'placeholder' ) ); ?>
				<?php endif; ?>
				<div class="book__page book__page--front">
					<?php if ( ! empty( $custom_image['width'] ) && ! empty( $custom_image['height'] ) && function_exists( 'livre_resize' )): ?>
						<img src="<?php echo livre_resize( $get_featured_img[0], $custom_image['width'], $custom_image['height'] ); ?>">
					<?php else : ?>
						<?php the_post_thumbnail( 'shop_single' ); ?>
					<?php endif; ?>
				</div>
				<div class="book__page book__page--back">
					<?php if ( ! empty( $get_back_cover_img ) ) : ?>
						<img src="<?php echo esc_url( $back_cover_img_src[0] ); ?>" alt="<?php esc_html_e( 'Back Cover', 'livre' ); ?>">
					<?php endif; ?>
				</div>
				<div class="book__page book__page--first-page"></div>
				<div class="book__page book__page--second-page"></div>
				<div class="book__page book__page--side"></div>
				<div class="book__page book__page--side-paper"></div>
			</div>
			<div class="book__action">
				<button class="see-back button button--secondary">
					<i class="dripicons-clockwise"></i>
					<span><?php esc_html_e( 'Flip to Back', 'livre' ); ?></span>
				</button>
				<?php 
					echo '<button class="button see-inside productThumb button--secondary">
						<i class="dripicons-preview"></i>
						<span>'.esc_html__( 'Look Inside', 'livre' ).'</span>
					</button>';
				 ?>
			</div>
		</div>
		
		<!-- LOOK INSIDE POPUP -->
		<div class="tokoo-look-inside">
			<div class="overlay"></div>
			<div class="look-inside-box tab-detail-active tab-related-active">
				<!-- TITLE -->
				<header class="look-inside-book-title">
					<h2><span><?php esc_html_e( 'You are previewing:', 'livre' ); ?></span> <?php the_title(); ?></h2>
					<button class="look-inside__close no-ui"><i class="dripicons-cross"></i></button>
				</header>

				<!-- BOOK DETAILS -->
				<div class="look-inside-book-detail">
					<button class="toggle-detail-tab"><i class="dripicons-chevron-left"></i></button>
					<div class="tab-content">
						<div class="book-item">
							<div class="book-image">
								<?php the_post_thumbnail( 'shop_single' ); ?>
							</div>
							<div class="book-detail">
								<h2><?php the_title(); ?></h2>
								<?php wcbs_books_display_single_book_author(); ?>
								<?php livre_single_rating(); ?>
							</div>
						</div>

						<div class="book-meta"> 
							<?php do_action( 'woocommerce_product_additional_information', $product ); ?>
						</div>
						
						<?php 
							$args = array(
							    'post__in' => get_the_ID()
							);
							$comments_query = new WP_Comment_Query;
							$comments 		= $comments_query->query( $args ); 
						?>
						<?php if ( ! empty( $comments ) ) : ?>
							
							<h2 class="section__title"><?php esc_html_e( 'Useful Reviews', 'livre' ); ?></h2>
							<div class="book-review">
								
									<ol class="commentlist">
										<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ), $comments ); ?>
									</ol>

									<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
										echo '<nav class="woocommerce-pagination">';
										paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
											'prev_text' => '&larr;',
											'next_text' => '&rarr;',
											'type'      => 'list',
										) ) );
										echo '</nav>';
									endif; ?>
							</div>

						<?php endif; ?>

					</div>

				</div>

				<!-- MIDDLE CONTENT -->
				<div class="book-preview-pages">
					<div class="book-preview-tools">
						<button class="preview-zoom-in no-ui" title="Zoom in"><i class="dripicons-plus"></i></button>
						<button class="preview-zoom-out no-ui" title="Zoom out"><i class="dripicons-minus"></i></button>
					</div>
					<div class="book-pages-wrap">
						<div class="book-pages">
							<?php the_post_thumbnail( 'full' ); ?>
							<?php if ( ! empty( $attachment_ids ) ) : ?>
								<?php foreach ( $attachment_ids as $id ) : 
									$get_attachment_src = wp_get_attachment_image_src( $id, 'full' ); ?>
									<img src="<?php echo esc_url( $get_attachment_src[0] ); ?>">
								<?php endforeach;
							endif; ?>
							<?php if ( ! empty( $get_back_cover_img ) ) : ?>
								<img src="<?php echo esc_url( $back_cover_img_src[0] ); ?>" alt="<?php esc_html_e( 'Back Cover', 'livre' ); ?>">
							<?php endif; ?>
						</div>
					</div>
				</div>

				<!-- RIGHT CONTENT -->
				<div class="look-inside-book-related">
					<button class="toggle-related-tab"><i class="dripicons-chevron-right"></i></button>
					<div class="tab-content">
						<?php 
							$related_by_viewed_status 		= carbon_get_theme_option( 'wcbs_enable_related_by_viewed' );
							$related_by_completed_status 	= carbon_get_theme_option( 'wcbs_enable_related_by_completed' );

							if ( function_exists( 'wcbs_recommender_get_simularity' ) ) {
								$simularity_scores_viewed 		= wcbs_recommender_get_simularity( get_the_ID(), 'viewed' );
								$simularity_scores_completed 	= wcbs_recommender_get_simularity( get_the_ID(), 'completed' );
							} else {
								$simularity_scores_viewed 		= '';
								$simularity_scores_completed 	= '';
							}

							$related_by_viewed 				= array();
							$related_by_completed 			= array();

							if ( $simularity_scores_viewed ) {
								$related_by_viewed = array_keys( $simularity_scores_viewed );
							}

							if ( sizeof( $related_by_viewed ) !== 0 && ( 'yes' == $related_by_viewed_status )  ) {
								wc_get_template_part( 'books/wcbs-popup-related-by-viewed' );
							} else {
								wc_get_template_part( 'books/wcbs-popup-related' );
							}

							if ( $simularity_scores_completed ) {
								$related_by_completed = array_keys( $simularity_scores_completed );
							} 

							if ( sizeof( $related_by_completed ) !== 0 && ( 'yes' == $related_by_completed_status ) ) {
								wc_get_template_part( 'books/wcbs-popup-related-by-completed' );
							} else {
								wc_get_template_part( 'books/wcbs-popup-up-sells' );
							}
						 ?>
					</div>

				</div>
			</div>
		</div>

	<?php endif; 