<?php
if ( class_exists( 'Tokoo_Widget' ) && class_exists( 'WooCommerce' ) ) {

	if ( ! class_exists('Pustaka_WC_Top_Products')) {
		// Create custom widget class extending WPH_Widget
		class Pustaka_WC_Top_Products extends Tokoo_Widget {

			function __construct() {

				$args = array(
					'label' 		=> esc_html__( 'WooCommerce Top Product', 'livre' ),
					'description' 	=> esc_html__( 'A custom widget to display best selling product', 'livre' ),
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
						'std' 		=> esc_html__( 'Top Products', 'livre' ),
						'validate' 	=> 'alpha_dash',
						'filter' 	=> 'strip_tags|esc_attr'
					 ),

					 // Show Post Count
					array(
						'name' 		=> esc_html__( 'Limit', 'livre' ),
						'desc' 		=> esc_html__( 'Limit product display', 'livre' ),
						'id' 		=> 'limit',
						'type'		=> 'text',
						'class' 	=> 'widefat',
						'std' 		=> '5',
					 ),

					array(
						'name' 		=> esc_html__( 'Show Image', 'livre' ),
						'desc' 		=> esc_html__( 'Show product image', 'livre' ),
						'id' 		=> 'show_image',
						'type'		=> 'checkbox',
						'class' 	=> 'widefat',
						'std' 		=> 0,
					 ),

				 ); // fields array

				$args['options'] 	= array(
						'width'		=> 350,
						'height'	=> 350
					);

				// create widget
				$this->create_widget( $args );
			}


			// Output function
			function widget( $args, $instance ) {

				extract( $args );

				$title 		= apply_filters( 'widget_title', $instance['title'] );
				$limit 		= ! empty( $instance['limit'] ) ? $instance['limit'] : 5;
				$show_image = ! empty( $instance['show_image'] ) ? true : false;

				printf( $args['before_widget'] ); 

				if ( $title ) {
					printf( '%s %s %s', $args['before_title'], $title, $args['after_title'] );
				}

				if ( true == $show_image ) {
					$ul_class = 'has_image';
				} else {
					$ul_class = '';
				}

				echo '<ul class="product_list_widget '.$ul_class.'">';

				$product_args = array(
					'post_type' 		=> 'product',
					'posts_per_page'	=> $limit,
					'no_found_rows'  	=> 1,
					'post_status'    	=> 'publish',
					'meta_key'       	=> '_wc_average_rating',
					'orderby'        	=> 'meta_value_num',
					'order'          	=> 'DESC',
					'meta_query'     	=> WC()->query->get_meta_query(),
					'tax_query'      	=> WC()->query->get_tax_query(),
				);
				$products = new WP_Query( $product_args );
				$loop = 1;
				if ( $products->have_posts() ) : while ( $products->have_posts() ) : $products->the_post();
					wc_get_template( 'content-widget-top-products.php', array( 'loop' => $loop, 'show_image' => $show_image ) );
				$loop++; endwhile;
				endif;

				wp_reset_postdata();

				echo '</ul>';

				printf( $args['after_widget'] );
			}

		} // class

	}

	if ( ! function_exists( 'pustaka_WC_Top_Products_init') && class_exists( 'Pustaka_WC_Top_Products' )) {	
		function pustaka_WC_Top_Products_init() {
			register_widget('Pustaka_WC_Top_Products');
		}
		add_action('widgets_init', 'pustaka_WC_Top_Products_init');
	}

}
 