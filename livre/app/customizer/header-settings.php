<?php

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// General Section
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
add_filter( 'tokoo_new_customizer_data', 'livre_header_settings_data' );
function livre_header_settings_data( $customizer_options ) {


	/* ==================================================== *
	 *  Header Section  									*
	 * ==================================================== */
	$customizer_options[] = array(
		'slug'		=> 'livre_header_settings',
		'label'		=> esc_html__( 'Header', 'livre' ),
		'priority'	=> 6,
		'type' 		=> 'section'
	);

		/* ============================================================ *
			 *  Header Color Scheme											*
			 * ============================================================ */
			$customizer_options[] = array(
				'slug'    	=> 'livre_header_type',
				'type'  	=> 'select',
				'default'	=> 'type_1',
				'priority'	=> 0,
				'label' 	=> esc_html__( 'Header Type', 'livre' ),
				'section'	=> 'livre_header_settings',
				'output'    => false,
				'transport'	=> 'refresh',
				'choices'	=> array(
					'type_1' 	=> esc_html__( 'Type 1 - Default', 'livre' ),
					'type_2' 	=> esc_html__( 'Type 2', 'livre' ),
				),
			);
			$customizer_options[] = array(
				'slug'		=> 'livre_menu_opening_method',
				'default'	=> 'onclick',
				'priority'	=> 1,
				'label'		=> esc_html__( 'Menu Opening Method', 'livre' ),
				'section'	=> 'livre_header_settings',
				'output'    => false,
				'transport'	=> 'refresh',
				'type' 		=> 'select',
				'choices'	=> array(
					'onclick'		=> esc_html__( 'On Click', 'livre' ),
					'onhover'		=> esc_html__( 'On Hover', 'livre' ),
				)
			);

			$customizer_options[] = array(
				'slug'		=> 'livre_page_title_background',
				'default'	=> '',
				'priority'	=> 2,
				'label'		=> esc_html__( 'Global Page Title Background (1600x600 px)', 'livre' ),
				'section'	=> 'livre_header_settings', 
				'output'    => false,
				'transport'	=> 'refresh',
				'type' 		=> 'images'
			);

			$customizer_options[] = array(
				'slug'		=> 'livre_sticky_header',
				'default'	=> '',
				'priority'	=> 3,
				'label'		=> esc_html__( 'Sticky Header', 'livre' ),
				'section'	=> 'livre_header_settings', 
				'output'    => false,
				'transport'	=> 'refresh',
				'type' 		=> 'checkbox'
			);
			$customizer_options[] = array(
				'slug'		=> 'livre_header_cart_button_type',
				'default'	=> 'text',
				'priority'	=> 0,
				'label'		=> esc_html__( 'Cart Header Button Type', 'livre' ),
				'section'	=> 'livre_header_settings',
				'output'    => false,
				'transport'	=> 'refresh',
				'type' 		=> 'select',
				'choices'	=> array(
					'text'		=> esc_html__( 'Text', 'livre' ),
					'icon'		=> esc_html__( 'Icon', 'livre' ),
				)
			);

	return $customizer_options;
}

