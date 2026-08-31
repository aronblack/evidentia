<?php

/**
 * Define metabox field for posts
 *
 * @return void
 * @author tokoo
 **/
add_filter( 'tokoo_metabox_options', 'wcbs_product_type_audio_metabox' );
function wcbs_product_type_audio_metabox( $metaboxes ) {

	$metaboxes[]    = array(
		'id'        => 'wcbs_audio_details',
		'title'     => esc_html__( 'Audio Details', 'pustaka' ),
		'post_type' => 'product',
		'context'   => 'normal',
		'priority'  => 'high',
		'sections'  => array(
			array(
				'name'  => 'the_audio_section',
				'title' => esc_html__( 'Audio Section', 'pustaka' ),
				'icon'  => 'fa fa-cog',
				'fields' => array(
					array(
						'id'				=> 'audio_ids',
						'type'				=> 'group',
						'title'				=> esc_html__( 'Audio Items', 'pustaka' ),
						'button_title'		=> 'Add New',
						'accordion_title' 	=> 'Add New item',
						'fields'			=> array(
							array(
								'id'    		=> 'id',
								'type'  		=> 'upload',
								'title' 		=> esc_html__( 'Audio File', 'pustaka' ),
								'desc'  		=> esc_html__( 'Enter the audio file', 'pustaka' ),
								'settings'		=> array(
									'insert_title' => 'Use this audio',
									'upload_type'  => 'audio',
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
 * WooCommerce product data tab definition
 *
 * @return array
 */
add_filter( 'wc_cpdf_init', 'wcbs_product_type_audio_affiliate_metabox' );
function wcbs_product_type_audio_affiliate_metabox( $options ) {

     /** First product data tab starts **/
     /** ===================================== */

     $options['wcbs_affiliate_link_tab'] = array(

		array(
			'tab_name'    	=> esc_html__( 'Affiliate Link', 'wcbs' ),
			'wrapper_class' => 'show_if_external',
		),
		array(
			'id' 			=> 'wcbs_app_store_affiliate_link',
			'type' 			=> 'text',
			'label'			=> esc_html__( 'App Store Link', 'wcbs' ),
			'placeholder' 	=> esc_html__( 'http://', 'wcbs' ),
			'description'	=> esc_html__( 'Enter your App Store affiliate link', 'wcbs' ),
			'desc_tip'		=> true,
			'class'			=> 'medium'
		),
		array(
			'id' 			=> 'wcbs_play_store_affiliate_link',
			'type' 			=> 'text',
			'label'			=> esc_html__( 'Play Store Link', 'wcbs' ),
			'placeholder' 	=> esc_html__( 'http://', 'wcbs' ),
			'description'	=> esc_html__( 'Enter your Play Store affiliate link', 'wcbs' ),
			'desc_tip'		=> true,
			'class'			=> 'medium'
		),
	);

     return $options;
}


/**
 * Override single product image
 *
 * @return void
 * @author 99Plugins
 **/
function wcbs_audio_display_single_product_image() {
	global $product;
	
	wc_get_template( 'audios/thumbnails.php', 
		array( 
			'product' => $product, 
		), 
		'', 
		NN_WCBS_DIR . 'templates/' 
	);
}


