<?php

/**
 * Define metabox field for pages
 *
 * @return void
 * @author tokoo
 **/
if ( ! function_exists('livre_pages_metabox')) {
	add_filter( 'tokoo_metabox_options', 'livre_pages_metabox' );
	function livre_pages_metabox( $metaboxes ) {

		$metaboxes[]    = array(
			'id'        => 'livre_contact_maps',
			'title'     => esc_html__( 'Contact Maps', 'livre' ),
			'post_type' => 'page',
			'context'   => 'normal',
			'priority'  => 'high',
			'sections'  => array(
				array(
					'name'  => 'contact_form_section',
					'title' => esc_html__( 'Contact Form', 'livre' ),
					'icon'  => 'fa fa-envelope',
					'fields' => array(
						array(
							'id'    	=> 'contact_form',
							'type'  	=> 'select',
							'title' 	=> esc_html__( 'Select Contact Form', 'livre' ),
							'desc'  	=> esc_html__( 'Type the contact form from ninja form plugin', 'livre' ),
							'options'	=> livre_get_cf7_list_form(),
						),

					), // end: fields
				), // end: a section

				array(
					'name'  => 'contact_map_section',
					'title' => esc_html__( 'Contact Maps', 'livre' ),
					'icon'  => 'fa fa-map-marker',
					'fields' => array(
						array(
							'id'    	=> 'map_iframe',
							'type'  	=> 'textarea',
							'title' 	=> esc_html__( 'Map Location:', 'livre' ),
							'desc'  	=> esc_html__( 'Go to Google Maps and searh your Location. Click on menu near search text => Share or embed map => Embed map. Next copy iframe to this field', 'livre' ),
							'sanitize' 	=> false,
						),
						array(
							'id'    => 'map_height',
							'type'  => 'text',
							'title' => esc_html__( 'Height', 'livre' ),
							'desc'  => esc_html__( 'Map Height (px):', 'livre' ),
						),
						array(
							'id'    	=> 'tagline',
							'type'  	=> 'textarea',
							'title' 	=> esc_html__( 'Company Tagline', 'livre' ),
							'desc'  	=> esc_html__( 'Type the company tagline', 'livre' ),
						),
						array(
							'id'    	=> 'phone_number',
							'type'  	=> 'text',
							'title' 	=> esc_html__( 'Phone Number', 'livre' ),
							'desc'  	=> esc_html__( 'Type the phone number', 'livre' ),
						),
						array(
							'id'    	=> 'address',
							'type'  	=> 'wysiwyg',
							'title' 	=> esc_html__( 'Company Address', 'livre' ),
							'desc'  	=> esc_html__( 'Type the company address', 'livre' ),
							'settings' => array(
								'textarea_rows'	=> 5,
								'tinymce'		=> false,
								'media_buttons'	=> false,
							)
						),

					), // end: fields
				), // end: a section
			),
		);

		$metaboxes[]    = array(
			'id'        => 'livre_author_page',
			'title'     => esc_html__( 'Author Page', 'livre' ),
			'post_type' => 'page',
			'context'   => 'normal',
			'priority'  => 'high',
			'sections'  => array(
				array(
					'name'  => 'author_page_settings',
					'title' => esc_html__( 'Author Page Settings', 'livre' ),
					'icon'  => 'fa fa-envelope',
					'fields' => array(
						array(
							'id'    	=> 'author_filter',
							'type'  	=> 'select',
							'title' 	=> esc_html__( 'Select Author Filter', 'livre' ),
							'desc'  	=> esc_html__( 'Choose a filter author name', 'livre' ),
							'options'	=> array(
								'first'	=> esc_html__( 'First Name', 'livre' ),
								'last' 	=> esc_html__( 'Last Name', 'livre' ),
							),
						),

					), // end: fields
				), // end: a section
			),
		);


		$metaboxes[]    = array(
			'id'        => 'livre_page_details',
			'title'     => esc_html__( 'Page Details', 'livre' ),
			'post_type' => 'page',
			'context'   => 'normal',
			'priority'  => 'high',
			'sections'  => array(
				array(
					'name'  => 'page_section',
					'title' => esc_html__( 'Page Section', 'livre' ),
					'icon'  => 'fa fa-cog',
					'fields' => array(
						array(
							'id'    	=> 'per_page',
							'type'  	=> 'number',
							'title' 	=> esc_html__( 'Post Per Page', 'livre' ),
							'desc'  	=> esc_html__( 'Enter how many item will be displayed', 'livre' ),
							'default' 	=> 12,
						),
						array(
							'id'		=> 'perpage_page_subtitle',
							'type'		=> 'text',
							'title'		=> esc_html__( 'Page Section SubTitle', 'livre' ),
						),
						array(
							'id'		=> 'perpage_page_title_background',
							'type'		=> 'image',
							'title'		=> esc_html__( 'Page Title Background Image', 'livre' ),
							'desc'		=> esc_html__( 'preferred size (1600x6000)', 'livre' )
						),
						array(
							'id'		=> 'disable_header',
							'type'		=> 'switcher',
							'title'		=> esc_html__( 'Disable Header', 'livre' ),
							'desc'		=> esc_html__( 'Only recommended for page template composer', 'livre' )
						),
						array(
							'id'    	=> 'header_type',
							'type'  	=> 'select',
							'title' 	=> esc_html__( 'Header Type', 'livre' ),
							'desc'  	=> esc_html__( 'Choose header type', 'livre' ),
							'options'	=> array(
								'type_1' 	=> esc_html__( 'Type 1 - Default', 'livre' ),
								'type_2' 	=> esc_html__( 'Type 2', 'livre' ),
							),
						),
						array(
							'id'    	=> 'author_style',
							'type'  	=> 'select',
							'title' 	=> esc_html__( 'Author Image Style', 'livre' ),
							'desc'  	=> esc_html__( 'Choose Author Style , Only for page template Authors', 'livre' ),
							'options'	=> array(
								'circle' 	=> esc_html__( 'Type 1 - Circle', 'livre' ),
								'square' 	=> esc_html__( 'Type 2 - Square', 'livre' ),
							),
						),
						array(
							'id'		=> 'disable_footer',
							'type'		=> 'switcher',
							'title'		=> esc_html__( 'Disable Footer', 'livre' ),
							'desc'		=> esc_html__( 'Only recommended for page template composer', 'livre' )
						),
					), // end: fields
				), // end: a section
			),
		);

		$metaboxes[]    = array(
			'id'        => 'livre_layouts_details',
			'title'     => esc_html__( 'The Layouts Details', 'livre' ),
			'post_type' => 'page',
			'context'   => 'side',
			'priority'  => 'low',
			'sections'  => array(
				array(
					'name'  => 'the_layouts_section',
					'title' => esc_html__( 'Layouts Section', 'livre' ),
					'icon'  => 'fa fa-cog',
					'fields' => array(
						array(
							'id'		=> 'theme_layouts',
							'type'		=> 'image_select',
							'title' 	=> 'Choose Layout',
							'options' 	=> array(
								'one-column' 		=> get_template_directory_uri() .'/assets/img/layouts/one-column.png',
								'left-sidebar'		=> get_template_directory_uri() .'/assets/img/layouts/sidebar-left.png',
								'right-sidebar' 	=> get_template_directory_uri() .'/assets/img/layouts/sidebar-right.png',
							),
							'default'   => 'one-column',
						),
						array(
							'id'    	=> 'custom_sidebar',
							'type'  	=> 'select',
							'title' 	=> esc_html__( 'Custom Sidebar', 'livre' ),
							'desc'  	=> esc_html__( 'Choose custom sidebar for this page', 'livre' ),
							'options'	=> livre_get_all_sidebars(),
						),
					), // end: fields
				), // end: a section
			),
		);

		return $metaboxes;
	}
}