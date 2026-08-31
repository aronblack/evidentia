<?php

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// Color Section
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
add_filter( 'tokoo_new_customizer_data', 'livre_general_color_settings_data' );
function livre_general_color_settings_data( $customizer_options ) {

	/* ===========================================================================================*
	 *  General Settings Panel 					 				  								  *
	 * ===========================================================================================*/
	$customizer_options[] = array(
		'slug'		=> 'livre_panel_color_settings',
		'label'		=> esc_html__( 'Colors', 'livre' ),
		'priority'	=> 5,
		'type' 		=> 'panel'
	);

	/* ==================================================== *
	 *  Accent Color Settings Section | No Panel            *
	 * ==================================================== */
	$customizer_options[] = array(
		'slug'		=> 'livre_general_color_settings',
		'label'		=> esc_html__( 'General', 'livre' ),
		'priority'	=> 10,
		'panel'		=> 'livre_panel_color_settings',
		'type' 		=> 'section' 
	);

		/* ============================================================ *
		 *  Accent Color Settings Data                                  *
		 * ============================================================ */
		$customizer_options[] = array(
			'slug'		=> 'livre_accent_color',
			'default'   => '#eb8367',
			'label'     => esc_html__( 'Accent Color', 'livre' ),
			'section'	=> 'livre_general_color_settings',
			'output'	=> false,
			'transport'	=> 'refresh',
			'type'      => 'color', 
		);

		$customizer_options[] = array(
			'slug'		=> 'livre_body_color',
			'default'	=> '#f6f6f6',
			'label'		=> esc_html__( 'Body Background Color', 'livre' ),
			'section'	=> 'livre_general_color_settings',
			'output'	=> false,
			'transport'	=> 'refresh',
			'type'      => 'color',
		);

		$customizer_options[] = array(
			'slug'		=> 'livre_header_color',
			'default'	=> '#f6f6f6',
			'label'		=> esc_html__( 'Header Background Color', 'livre' ),
			'section'	=> 'livre_general_color_settings',
			'output'	=> false,
			'transport'	=> 'refresh',
			'type'      => 'color',
		);

		$customizer_options[] = array(
			'slug'		=> 'livre_footer_color',
			'default'	=> '#f6f6f6',
			'label'		=> esc_html__( 'Footer Background Color', 'livre' ),
			'section'	=> 'livre_general_color_settings',
			'output'	=> false,
			'transport'	=> 'refresh',
			'type'      => 'color',
		);

		$customizer_options[] = array(
			'slug'		=> 'livre_heading_color',
			'default'   => '#2B2B2B',
			'label'     => esc_html__( 'Heading Color', 'livre' ),
			'section'	=> 'livre_general_color_settings',
			'output'	=> false,
			'transport'	=> 'refresh',
			'type'      => 'color'
		);

		$customizer_options[] = array(
			'slug'		=> 'livre_text_color',
			'default'   => '#616161',
			'label'     => esc_html__( 'Text Color', 'livre' ),
			'section'	=> 'livre_general_color_settings',
			'output'	=> false,
			'transport'	=> 'refresh',
			'type'      => 'color'
		);

	/* ==================================================== *
	 *  Button Color           								*
	 * ==================================================== */
	$customizer_options[] = array(
		'slug'		=> 'livre_color_button_settings',
		'label'		=> esc_html__( 'Button', 'livre' ),
		'priority'	=> 11,
		'panel'		=> 'livre_panel_color_settings',
		'type' 		=> 'section' 
	);

		$customizer_options[] = array(
			'slug'		=> 'livre_primary_button_color',
			'default'   => '#eb8367',
			'label'     => esc_html__( 'Primary Button Color', 'livre' ),
			'section'	=> 'livre_color_button_settings',
			'output'	=> false,
			'transport'	=> 'refresh',
			'type'      => 'color'
		);

		$customizer_options[] = array(
			'slug'		=> 'livre_primary_button_color_hover',
			'default'   => '#eb8367',
			'label'     => esc_html__( 'Primary Button Hover Color', 'livre' ),
			'section'	=> 'livre_color_button_settings',
			'output'	=> false,
			'transport'	=> 'refresh',
			'type'      => 'color'
		);

		$customizer_options[] = array(
			'slug'		=> 'livre_primary_button_text_color',
			'default'   => '#ffffff',
			'label'     => esc_html__( 'Primary Button Text Color', 'livre' ),
			'section'	=> 'livre_color_button_settings',
			'output'	=> false,
			'transport'	=> 'refresh',
			'type'      => 'color'
		);

		$customizer_options[] = array(
			'slug'		=> 'livre_secondary_button_color',
			'default'   => '#b2dc71',
			'label'     => esc_html__( 'Secondary Button Color', 'livre' ),
			'section'	=> 'livre_color_button_settings',
			'output'	=> false,
			'transport'	=> 'refresh',
			'type'      => 'color'
		);

		$customizer_options[] = array(
			'slug'		=> 'livre_secondary_button_color_hover',
			'default'   => '#b2dc71',
			'label'     => esc_html__( 'Secondary Button Hover Color', 'livre' ),
			'section'	=> 'livre_color_button_settings',
			'output'	=> false,
			'transport'	=> 'refresh',
			'type'      => 'color'
		);

		$customizer_options[] = array(
			'slug'		=> 'livre_secondary_button_text_color',
			'default'   => '#ffffff',
			'label'     => esc_html__( 'Secondary Button Text Color', 'livre' ),
			'section'	=> 'livre_color_button_settings',
			'output'	=> false,
			'transport'	=> 'refresh',
			'type'      => 'color'
		);

	/* ==================================================== *
	 *  Page Title           								*
	 * ==================================================== */
	$customizer_options[] = array(
		'slug'		=> 'livre_color_page_title_settings',
		'label'		=> esc_html__( 'Page Title', 'livre' ),
		'priority'	=> 12,
		'panel'		=> 'livre_panel_color_settings',
		'type' 		=> 'section' 
	);

		$customizer_options[] = array(
			'slug'		=> 'livre_page_title_color',
			'default'   => '#222222',
			'label'     => esc_html__( 'Title Color', 'livre' ),
			'section'	=> 'livre_color_page_title_settings',
			'output'	=> false,
			'transport'	=> 'refresh',
			'type'      => 'color'
		);


	return $customizer_options;
}

