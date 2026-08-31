<?php

/**
 * Define metabox field for sliders
 *
 * @return void
 * @author tokoo
 **/
if ( ! function_exists('livre_sliders_metabox')) {
	add_filter( 'tokoo_metabox_options', 'livre_sliders_metabox' );
	function livre_sliders_metabox( $metaboxes ) {

		$metaboxes[]    = array(
			'id'        => 'livre_sliders_details',
			'title'     => esc_html__( 'Sliders Details', 'livre' ),
			'post_type' => 'tokoo-slider',
			'context'   => 'normal',
			'priority'  => 'high',
			'sections'  => array(
				array(
					'name'  => 'slider_section',
					'title' => 'Slider Section',
					'icon'  => 'fa fa-cog',
					'fields' => array(
						array(
							'id'				=> 'slides',
							'type'				=> 'group',
							'title'				=> 'Slides Item',
							'button_title'		=> 'Add New',
							'accordion_title' 	=> 'Add New item',
							'fields'			=> array(
								array(
									'id'    	=> 'text_align',
									'type'  	=> 'select',
									'title' 	=> esc_html__( 'Text Align', 'livre' ),
									'desc'  	=> esc_html__( 'Select the text align', 'livre' ),
									'options'	=> array(
										'right'			=> esc_html__( 'Right', 'livre' ),
										'center'		=> esc_html__( 'Center', 'livre' ),
										'left'			=> esc_html__( 'Left', 'livre' ),
									)
								),
								array(
									'id'    		=> 'slider_image',
									'type'  		=> 'image',
									'title' 		=> esc_html__( 'Slider Image', 'livre' ),
									'desc'  		=> esc_html__( 'Select the slider image', 'livre' ),
								),
								array(
									'id'    	=> 'slider_title',
									'type'  	=> 'text',
									'title' 	=> esc_html__( 'Slider Title', 'livre' ),
									'desc'  	=> esc_html__( 'Enter the title', 'livre' ),
								),
								array(
									'id'       => 'slider_content',
									'type'     => 'wysiwyg',
									'title'    => 'Enter the slider content',
									'settings' => array(
										'textarea_rows' => 5,
										'tinymce'       => true,
										'media_buttons' => false,
									)
								),
								array(
									'id'    	=> 'slider_link',
									'type'  	=> 'text',
									'title' 	=> esc_html__( 'Slider Link', 'livre' ),
									'desc'  	=> esc_html__( 'Enter the link', 'livre' ),
								),
							),
						),
						
					), // end: fields
				), // end: a section
			),
		);

		return $metaboxes;
	}
}