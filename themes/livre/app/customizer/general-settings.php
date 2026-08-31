<?php 

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// Register Panel
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
add_filter( 'tokoo_new_customizer_data', 'livre_customizer_general_settings' );
function livre_customizer_general_settings( $customizer_options ) {

	/* ===========================================================================================*
	 *  General Settings Panel 					 				  								  *
	 * ===========================================================================================*/
	$customizer_options[] = array(
		'slug'		=> 'livre_panel_general_settings',
		'label'		=> esc_html__( 'General', 'livre' ),
		'priority'	=> 1,
		'type' 		=> 'panel'
	);

		// /* ==================================================== *
		//  *  Social Icons Section  								*
		//  * ==================================================== */
		// $customizer_options[] = array(
		// 	'slug'		=> 'livre_social_icons_settings',
		// 	'label'		=> esc_html__( 'Social Icons', 'livre' ),
		// 	'panel'	    => 'livre_panel_general_settings',
		// 	'priority'	=> 1,
		// 	'type' 		=> 'section'
		// );

		// 	/* ============================================================ *
		// 	 * Account Data  												*
		// 	 * ============================================================ */
		// 	$customizer_options[] = array(
		// 		'slug'		=> 'livre_fb',
		// 		'default'	=> '',
		// 		'priority'	=> 1,
		// 		'label'		=> esc_html__( 'Facebook Username', 'livre' ),
		// 		'section'	=> 'livre_social_icons_settings',
		// 		'type' 		=> 'text',
		// 		'transport'	=> 'refresh',
		// 	);
		// 	$customizer_options[] = array(
		// 		'slug'		=> 'livre_tw',
		// 		'default'	=> '',
		// 		'priority'	=> 2,
		// 		'label'		=> esc_html__( 'Twitter Username', 'livre' ),
		// 		'section'	=> 'livre_social_icons_settings',
		// 		'type' 		=> 'text',
		// 		'transport'	=> 'refresh',
		// 	);
		// 	$customizer_options[] = array(
		// 		'slug'		=> 'livre_gplus',
		// 		'default'	=> '',
		// 		'priority'	=> 5,
		// 		'label'		=> esc_html__( 'Google Plus Username', 'livre' ),
		// 		'section'	=> 'livre_social_icons_settings',
		// 		'type' 		=> 'text',
		// 		'transport'	=> 'refresh',
		// 	);
		// 	$customizer_options[] = array(
		// 		'slug'		=> 'livre_pinterest',
		// 		'default'	=> '',
		// 		'priority'	=> 6,
		// 		'label'		=> esc_html__( 'Pinterest Username', 'livre' ),
		// 		'section'	=> 'livre_social_icons_settings',
		// 		'type' 		=> 'text',
		// 		'transport'	=> 'refresh',
		// 	);
		// 	$customizer_options[] = array(
		// 		'slug'		=> 'livre_ig',
		// 		'default'	=> '',
		// 		'priority'	=> 7,
		// 		'label'		=> esc_html__( 'Instagram Username', 'livre' ),
		// 		'section'	=> 'livre_social_icons_settings',
		// 		'type' 		=> 'text',
		// 		'transport'	=> 'refresh',
		// 	);

		/* ==================================================== *
		 *  Page Loader Section                               *
		 * ==================================================== */
		
		
		/* ==================================================== *
		 *  MAP Section  										*
		 * ==================================================== */
		

		/* ==================================================== *
		 *  FORM Section  										*
		 * ==================================================== */
		$customizer_options[] = array(
			'slug'		=> 'livre_form_settings',
			'label'		=> esc_html__( 'Forms', 'livre' ),
			'priority'	=> 4,
			'panel' 	=> 'livre_panel_general_settings',
			'type' 		=> 'section'
		);

			$customizer_options[] = array(
				'slug'		=> 'livre_form_style',
				'default'	=> 'form-style-rounded',
				'priority'	=> 1,
				'label'		=> esc_html__( 'Form Style', 'livre' ),
				'section'	=> 'livre_form_settings',
				'transport'	=> 'refresh',
				'type' 		=> 'select',
				'choices'	=> array(
					'form-style-square' 	=> esc_html__( 'Square', 'livre' ),
					'form-style-radius' 	=> esc_html__( 'Radius', 'livre' ),
					'form-style-rounded' 	=> esc_html__( 'Rounded', 'livre' ),
				)
			);

		/* ==================================================== *
		 *  SITE IDENTITY										*
		 * ==================================================== */
		$customizer_options[] = array(
			'slug'		=> 'livre_retina_logo',
			'default'	=> '',
			'priority'	=> 10,
			'label'		=> esc_html__( 'Retina Logo', 'livre' ),
			'section'	=> 'title_tagline',
			'transport'	=> 'refresh',
			'type' 		=> 'images',
		);

	/* ==================================================== *
	 *  404 Section  										*
	 * ==================================================== */
	$customizer_options[] = array(
		'slug'		=> 'livre_page_404_settings',
		'label'		=> esc_html__( '404', 'livre' ),
		'priority'	=> 10,
		'panel'		=> 'livre_panel_general_settings',
		'type' 		=> 'section'
	);

		$customizer_options[] = array(
			'slug'		=> 'livre_404_bg_image',
			'default'	=> '',
			'priority'	=> 1,
			'label'		=> esc_html__( '404 Background Image', 'livre' ),
			'section'	=> 'livre_page_404_settings',
			'transport'	=> 'refresh',
			'type' 		=> 'images'
		);

	return $customizer_options;
}

/**
 * Modify Customizer section
 *
 * @return void
 * @author tokoo
 **/
add_action( 'customize_register', 'livre_modify_default_customizer_section' );
function livre_modify_default_customizer_section( $wp_customize ) {
	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'header_image' );
	$wp_customize->get_section( 'title_tagline' )->panel = 'livre_panel_general_settings';
	$wp_customize->get_section( 'title_tagline' )->priority = 0;
	$wp_customize->get_control( 'blogdescription' )->priority = 2;
	$wp_customize->get_control( 'display_header_text' )->priority = 5;
	$wp_customize->get_control( 'blogname' )->priority = 4;
	$wp_customize->get_control( 'site_icon' )->priority = 6;

}