<?php

/**
 * Define metabox field for pages
 *
 * @return void
 * @author tokoo
 **/
if ( ! function_exists('livre_product_metabox')) {
	add_filter( 'tokoo_metabox_options', 'livre_product_metabox' );
	function livre_product_metabox( $metaboxes ) {

		$metaboxes[]    = array(
			'id'        => 'livre_product_image_dimension',
			'title'     => esc_html__( 'Custom Book Image Dimension', 'livre' ),
			'post_type' => 'product',
			'context'   => 'side',
			'priority'  => 'low',
			'sections'  => array(
				array(
					'name'  => 'product_section',
					'title' => esc_html__( 'Product Image Section', 'livre' ),
					'icon'  => 'fa fa-cog',
					'fields' => array(
						array(
							'id'    	=> 'width',
							'type'  	=> 'number',
							'title' 	=> esc_html__( 'Image Width', 'livre' ),
						),
						array(
							'id'    	=> 'height',
							'type'  	=> 'number',
							'title' 	=> esc_html__( 'Image Height', 'livre' ),
						),
					), // end: fields
				), // end: a section
			),
		);

		return $metaboxes;
	}
}