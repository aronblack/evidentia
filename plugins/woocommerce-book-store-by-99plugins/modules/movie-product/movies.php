<?php

/**
 * Define metabox field for posts
 *
 * @return void
 * @author tokoo
 **/
add_filter( 'tokoo_metabox_options', 'wcbs_product_type_movie_metabox' );
function wcbs_product_type_movie_metabox( $metaboxes ) {

	$metaboxes[]    = array(
		'id'        => 'wcbs_movie_details',
		'title'     => esc_html__( 'Movie Details', 'pustaka' ),
		'post_type' => 'product',
		'context'   => 'normal',
		'priority'  => 'high',
		'sections'  => array(
			array(
				'name'  => 'the_movie_section',
				'title' => esc_html__( 'Movie Section', 'pustaka' ),
				'icon'  => 'fa fa-cog',
				'fields' => array(
					array( 
						'id'		=> 'video_type',
						'type'		=> 'select',
						'title' 	=> esc_html__( 'Select Video Type', 'wcbs' ),
						'options' 	=> array(
							'from_url' 		=> esc_html__( 'From URL', 'wcbs' ),
							'from_upload' 	=> esc_html__( 'From User Upload', 'wcbs' ),
						),
						'default'   => 'from_url',
					),
					array(
						'id'				=> 'video_urls',
						'type'				=> 'group',
						'title'				=> esc_html__( 'Video Item', 'pustaka' ),
						'button_title'		=> 'Add New',
						'accordion_title' 	=> 'Add New item',
						'dependency'		=> array( 'video_type', '==', 'from_url' ),
						'fields'			=> array(
							array(
								'id'    	=> 'url',
								'type'  	=> 'text',
								'title' 	=> esc_html__( 'Video URL', 'pustaka' ),
								'desc'  	=> esc_html__( 'Enter the video URL', 'pustaka' ),
							),
						),
					),
					array(
						'id'				=> 'video_files',
						'type'				=> 'group',
						'title'				=> esc_html__( 'Video Item', 'pustaka' ),
						'button_title'		=> 'Add New',
						'accordion_title' 	=> 'Add New item',
						'dependency'	=> array( 'video_type', '==', 'from_upload' ),
						'fields'			=> array(
							array(
								'id'    	=> 'file',
								'type'  	=> 'upload',
								'title' 	=> esc_html__( 'Upload Video', 'pustaka' ),
								'desc'  	=> esc_html__( 'upload the video file', 'pustaka' ),
								'settings'		=> array(
									'insert_title' => 'Use this video',
									'upload_type'  => 'video',
								),
							),
						),
					),
				), // end: fields
			), // end: a section
		),
	);

	return $metaboxes;
}

/**
 * Override single product image
 *
 * @return void
 * @author 99Plugins
 **/
function wcbs_movie_display_single_product_image() {
	global $product;
	
	wc_get_template( 'movies/thumbnails.php', 
		array( 
			'product' => $product, 
		), 
		'', 
		NN_WCBS_DIR . 'templates/' 
	);
}