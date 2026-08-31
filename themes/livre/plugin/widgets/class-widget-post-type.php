<?php
if ( class_exists( 'Tokoo_Widget' ) ) {

	if ( ! class_exists('Livre_Post_Type_List')) {
		// Create custom widget class extending WPH_Widget
		class Livre_Post_Type_List extends Tokoo_Widget {

			function __construct() {

				$args = array(
					'label' 		=> esc_html__( 'Tokoo - Post Type List', 'livre' ),
					'description' 	=> esc_html__( 'A custom widget to display most recent, popular or random data from any post type.', 'livre' ),
				 );

				// fields array
				$args['fields'] = array(

					// Title field
					array(
						'name' 		=> esc_html__( 'Title', 'livre' ),
						'desc' 		=> esc_html__( 'Enter the widget title.', 'livre' ),
						'id' 		=> 'title',
						'type' 		=> 'text',
						'class' 	=> 'widefat',
						'std' 		=> esc_html__( 'Post Type List', 'livre' ),
						'validate' 	=> 'alpha_dash',
						'filter' 	=> 'strip_tags|esc_attr'
					 ),

					// Limit
					array(
						'name' 		=> esc_html__( 'Limit', 'livre' ),
						'id' 		=> 'limit',
						'type'		=> 'number',
						'class' 	=> 'widefat',
						'std' 		=> 6,
						'filter'	=> 'esc_attr',
					 ),

					// Order
					array(
						'name' 		=> esc_html__( 'Order', 'livre' ),
						'desc' 		=> esc_html__( 'Enter the type order', 'livre' ),
						'id' 		=> 'order',
						'type'		=> 'select',
						'class' 	=> 'widefat',
						'std' 		=> '',
						'filter'	=> 'esc_attr',
						'fields' 	=> array(
								array(
									'name'  => esc_html__( 'Comment Count', 'livre' ),
									'value' => 'comment_count'
								 ),
								array(
									'name'  => esc_html__( 'Date', 'livre' ),
									'value' => 'date'
								 ),
								array(
									'name'  => esc_html__( 'Random', 'livre' ),
									'value' => 'rand'
								 )
						 ),
					 ),

					// Display Date
					array(
						'name' 		=> esc_html__( 'Display Date', 'livre' ),
						'id' 		=> 'date',
						'class' 	=> 'widefat',
						'type'		=> 'checkbox',
						'std' 		=> 1, // 0 or 1
						'filter'	=> 'strip_tags|esc_attr',
					 ),

					// Display Excerpt
					array(
						'name' 		=> esc_html__( 'Display Excerpt', 'livre' ),
						'id' 		=> 'excerpt',
						'class' 	=> 'widefat',
						'type'		=> 'checkbox',
						'std' 		=> 0, // 0 or 1
						'filter'	=> 'strip_tags|esc_attr',
					 ),

					 // Excerpt Length
					array(
						'name' 		=> esc_html__( 'Excerpt Length', 'livre' ),
						'id' 		=> 'length',
						'class' 	=> 'widefat',
						'type'		=> 'text',
						'std' 		=> 10, // 0 or 1
						'filter'	=> 'strip_tags|esc_attr',
					 ),

					// Display Thumbnail
					array(
						'name' 		=> esc_html__( 'Display Thumbnail', 'livre' ),
						'id' 		=> 'thumb',
						'class' 	=> 'widefat',
						'type'		=> 'checkbox',
						'std' 		=> 1, // 0 or 1
						'filter'	=> 'strip_tags|esc_attr',
					 ),

					// Thumbnail Size (height x width)
					array(
						'name' 		=> esc_html__( 'Thumbnail Size', 'livre' ),
						'id' 		=> 'thumb_size',
						'class' 	=> 'widefat',
						'type'		=> 'text',
						'std' 		=> '80x80',
						'filter'	=> 'strip_tags|esc_attr',
					 ),

					// Limit to Category
					array(
						'name' 		=> esc_html__( 'Limit to Category', 'livre' ),
						'id' 		=> 'cat',
						'type'		=> 'select',
						'class' 	=> 'widefat',
						'std' 		=> '',
						'filter'	=> 'esc_attr',
						'fields' 	=> livre_widget_get_categories()
					 ),

					// Choose the Post Types
					array(
						'name' 		=> esc_html__( 'Choose the Post Type', 'livre' ),
						'id' 		=> 'post_type',
						'type'		=> 'select',
						'class' 	=> 'widefat',
						'std' 		=> '',
						'filter'	=> 'esc_attr',
						'fields' 	=> livre_widget_get_registered_post_types()
					 ),

					// Display type
					array(
						'name' 		=> esc_html__( 'Display Type', 'livre' ),
						'desc' 		=> esc_html__( 'Select your preferred display', 'livre' ),
						'id' 		=> 'display_type',
						'type'		=> 'select',
						'class' 	=> 'widefat',
						'std' 		=> '',
						'filter'	=> 'esc_attr',
						'fields' 	=> array(
								array(
									'name'  => esc_html__( 'List', 'livre' ),
									'value' => 'list'
								 ),
								array(
									'name'  => esc_html__( 'Slide', 'livre' ),
									'value' => 'slide'
								 ),
						 ),
					 ),

				 ); // fields array

				$args['options'] 	= array(
						'width'		=> 350,
						'height'	=> 350
					);

				// create widget
				$this->create_widget( $args );

				$this->alt_option_name = 'livre_post_type_widget';

			}


			// Output function
			function widget( $args, $instance ) {

				$cache = wp_cache_get( 'livre_post_type_widget', 'widget' );

				if ( ! is_array( $cache ) )
					$cache = array();

				if ( ! isset( $args['widget_id'] ) )
					$args['widget_id'] = $this->id;

				if ( isset( $cache[ $args['widget_id'] ] ) ) {
					echo esc_attr( $cache[ $args['widget_id'] ] );
					return;
				}

				ob_start();

				extract( $args );

				$title 			= apply_filters( 'widget_title', $instance['title'] );
				$limit 			= isset( $instance['limit'] ) ? $instance['limit'] : 6;
				$order 			= $instance['order'];
				$excerpt 		= $instance['excerpt'];
				$length 		= (int)( $instance['length'] );
				$thumb 			= $instance['thumb'];
				$thumb_size 	= $instance['thumb_size'];
				$date 			= $instance['date'];
				$cat 			= $instance['cat'];
				$post_type 		= isset( $instance['post_type'] ) ? $instance['post_type'] : 'post';
				$display_type 	= $instance['display_type'];
				$ul_classes 	= ( 'slide' == $display_type ) ? 'slides' : 'post-list';

				printf( $before_widget );

				if ( $title ) {
					printf( '%s %s %s', $args['before_title'], $title, $args['after_title'] );
				}

				global $post;

				$post_args = array(
					'posts_per_page' 	=> $limit,
					'orderby' 			=> $order,
					'cat' 				=> $cat,
					'post_status'		=> 'publish',
					'post_type' 		=> $post_type
				);

			    $query = new WP_Query( $post_args );

			    if ( $query->have_posts() ) :  ?>

					<?php if ( 'slide' == $display_type ): ?>
						<div class="post-slider">
					<?php endif; ?>

					<ul class="<?php echo esc_attr( $ul_classes ); ?>">

						<?php while ( $query->have_posts() ) : $query->the_post();  ?>

							<?php if ( 'slide' == $display_type ) : ?>

								<li>

									<?php if ( $thumb == true ) {

										$image_url 	= wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
										if ( ! empty( $thumb_size ) ) {
											$image_size 	= explode( 'x', $thumb_size );
											$image_width 	= $image_size[0];
											$image_height 	= $image_size[1];
										} else {
											$image_width 	= 80;
											$image_height 	= 80;
										}
									?>
										<?php if ( $image_url ) : ?>
											<figure class="featured-image">
												<img class="lazyload" src="<?php echo esc_url( livre_resize( $image_url, $image_width, $image_height ) ); ?>" data-src="<?php echo esc_url( livre_resize( $image_url, $image_width, $image_height ) ); ?>" alt="<?php the_title_attribute(); ?>" width="<?php echo esc_attr( $image_width ); ?>" height="<?php echo esc_attr( $image_height ); ?>" />
											</figure>
										<?php endif; ?>
									<?php } ?>

									<div class="post-detail">

										<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' ); ?>

										<?php if ( $date == true ) { ?>
											<div class="entry-meta">
												<small class="date"><?php echo get_the_time( 'j F Y' ); ?></small>
											</div>
										<?php } ?>

										<?php if ( $excerpt ) {  ?>
											<p class="entry-summary"><?php echo wp_trim_words( get_the_content(), $length ); ?></p>
										<?php } ?>

									</div><!-- .post-detail -->

								</li>

							<?php else : ?>

								<li>

									<?php if ( $thumb == true ) {

										$image_url 	= wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
										if ( ! empty( $thumb_size ) ) {
											$image_size 	= explode( 'x', $thumb_size );
											$image_width 	= $image_size[0];
											$image_height 	= $image_size[1];
										} else {
											$image_width 	= 80;
											$image_height 	= 80;

										}
										?>
										<?php if ( $image_url ) : ?>
											<a href="<?php the_permalink(); ?>" rel="external nofollow" title="<?php the_title_attribute(); ?>" class="post-image">
												<img src="<?php echo esc_url( livre_resize( $image_url, $image_width, $image_height ) ); ?>" alt="<?php the_title_attribute(); ?>" width="<?php echo esc_attr( $image_width ); ?>" height="<?php echo esc_attr( $image_height ); ?>" />
											</a>
										<?php endif; ?>
									<?php } ?>

									<div class="post-detail">

										<?php the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h4>' ); ?>

										<?php if ( $date == true ) { ?>
											<small class="entry-date"><i class="drip-icon-calendar"></i>  <?php echo get_the_time( 'j F Y' ); ?></small>
										<?php } ?>

										<?php if( $excerpt ) {  ?>
											<p class="entry-summary"><?php echo wp_trim_words( $post->content, $length ); ?></p>
										<?php } ?>

									</div><!-- .post-detail -->

								</li>

							<?php endif; ?>

						<?php endwhile; ?>

					</ul>

				<?php if ( 'slide' == $display_type ): ?>
						</div>
					<?php endif; ?>

				<?php
				endif; // end $post_query
				wp_reset_postdata();

				printf( $after_widget );

				$cache[$args['widget_id']] = ob_get_flush();
				wp_cache_set( 'livre_post_type_widget', $cache, 'widget' );
			}

		} // class
	}

}

if ( ! function_exists( 'Livre_Post_Type_List_init' ) && class_exists( 'Livre_Post_Type_List' ) ) {
	function Livre_Post_Type_List_init() {
		register_widget('Livre_Post_Type_List');
	}
	add_action('widgets_init', 'Livre_Post_Type_List_init');
}