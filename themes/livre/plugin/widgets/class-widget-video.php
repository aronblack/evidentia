<?php
if ( class_exists( 'Tokoo_Widget' ) ) {
	if ( ! class_exists('Livre_Video')) {
		// Create custom widget class extending WPH_Widget
		class Livre_Video extends Tokoo_Widget {

			function __construct() {

				$args = array(
					'label' 		=> esc_html__( 'Tokoo - Video', 'livre' ),
					'description' 	=> esc_html__( 'A custom widget to display video such as from youtube, vimeo and etc.', 'livre' ),
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
						'std' 		=> esc_html__( 'Video', 'livre' ),
						'validate' 	=> 'alpha_dash',
						'filter' 	=> 'strip_tags|esc_attr'
					 ),

					 // Show Post Count
					array(
						'name' 		=> esc_html__( 'Video URL', 'livre' ),
						'desc' 		=> esc_html__( 'Enter video URL', 'livre' ),
						'id' 		=> 'video_url',
						'type'		=> 'text',
						'class' 	=> 'widefat',
						'std' 		=> '',
						'filter'	=> 'esc_url',
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
				$video_url 	= esc_url( $instance['video_url'] );

				printf( $args['before_widget'] );

				if ( $title ) {
					printf( '%s %s %s', $args['before_title'], $title, $args['after_title'] );
				}

				$output = get_transient( 'videowidget_' . $widget_id );

				if ( !empty( $video_url ) ) {

					echo '<div class="video-widget">';
					echo do_shortcode('[video src="' . $video_url . '"]' );
					echo '</div>';

				}


				printf( $args['after_widget'] );
			}

		} // class
	}
}


if ( ! function_exists( 'Livre_Video_init' ) && class_exists( 'Livre_Video' ) ) {
	function Livre_Video_init() {
		register_widget('Livre_Video');
	}
	add_action('widgets_init', 'Livre_Video_init');
}