<?php 

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// Register Section
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
add_filter( 'tokoo_new_customizer_data', 'livre_customizer_typography_settings' );
function livre_customizer_typography_settings( $customizer_options ) {

	/* ===========================================================================================*
	 *  Typography Settings Panel 					 				  								  *
	 * ===========================================================================================*/
	$customizer_options[] = array(
		'slug'		=> 'livre_panel_typography_settings',
		'label'		=> esc_html__( 'Typography', 'livre' ),
		'priority'	=> 12,
		'type' 		=> 'panel'
	);

	/* ==================================================== *
	 *  Body Font Settings Section                         *
	 * ==================================================== */
	$customizer_options[] = array(
		'slug'		=> 'livre_body_font_settings',
		'label'		=> esc_html__( 'Body Font Style', 'livre' ),
		'priority'	=> 1,
		'panel'		=> 'livre_panel_typography_settings',
		'type' 		=> 'section'
	);

		/* ============================================================ *
		 *  Typography Color Settings Data                              *
		 * ============================================================ */
		$customizer_options[] = array(
			'slug'		=> 'livre_body_font',
			'default'	=> 'Roboto',
			'label'		=> esc_html__( 'Font Family', 'livre' ),
			'section'	=> 'livre_body_font_settings',
			'transport'	=> 'refresh',
			'type' 		=> 'google_font',
			'font_amount'	=> 5000,
		);

		$customizer_options[] = array(
			'slug'      => 'livre_body_font_size',
			'default'   => '18',
			'label'     => esc_html__( 'Font Size', 'livre' ),
			'section'   => 'livre_body_font_settings',
			'output'    => 'false',
			'min'       => 10,
			'max'       => 24,
			'transport' => 'refresh',
			'type'      => 'slider_input'
		);

		$customizer_options[] = array(
			'slug'      => 'livre_body_font_weight',
			'default'   => '400',
			'label'     => esc_html__( 'Font Weight', 'livre' ),
			'section'   => 'livre_body_font_settings',
			'output'    => 'false',
			'transport' => 'refresh',
			'type'      => 'select',
			'choices'	=> array(
				'300' => '300',
				'400' => '400',
				'600' => '600',
				'700' => '700',
			)
		);

		$customizer_options[] = array(
			'slug'      => 'livre_body_line_height',
			'default'   => '1.7',
			'label'     => esc_html__( 'Line Height', 'livre' ),
			'section'   => 'livre_body_font_settings',
			'output'    => 'false',
			'transport' => 'refresh',
			'type'      => 'text'
		);

	/* ==================================================== *
	 *  Heading Font Settings Section                         *
	 * ==================================================== */
	$customizer_options[] = array(
		'slug'		=> 'livre_heading_font_settings',
		'label'		=> esc_html__( 'Heading Font Style', 'livre' ),
		'priority'	=> 2,
		'panel'		=> 'livre_panel_typography_settings',
		'type' 		=> 'section'
	);

		/* ============================================================ *
		 *  Typography Heading Settings Data                              *
		 * ============================================================ */
		$customizer_options[] = array(
			'slug'		=> 'livre_heading_font',
			'default'	=> 'Roboto',
			'label'		=> esc_html__( 'Font Family', 'livre' ),
			'section'	=> 'livre_heading_font_settings',
			'transport'	=> 'refresh',
			'type' 		=> 'google_font',
			'font_amount'	=> 5000,
		); 

		$customizer_options[] = array(
			'slug'      => 'livre_heading_font_weight',
			'default'   => '700',
			'label'     => esc_html__( 'Font Weight', 'livre' ),
			'section'   => 'livre_heading_font_settings',
			'output'    => 'false',
			'transport' => 'refresh',
			'type'      => 'select',
			'choices'	=> array(
				'300' => '300',
				'400' => '400',
				'600' => '600',
				'700' => '700',
			)
		);

		$customizer_options[] = array(
			'slug'      => 'livre_heading_text_transform',
			'default'   => false,
			'label'     => esc_html__( 'Transform Text', 'livre' ),
			'section'   => 'livre_heading_font_settings',
			'output'    => 'false',
			'transport' => 'refresh',
			'type'      => 'checkbox'
		);

		$customizer_options[] = array(
			'slug'      => 'livre_heading_letter_spacing',
			'default'   => '18',
			'label'     => esc_html__( 'Letter Spacing', 'livre' ),
			'section'   => 'livre_heading_font_settings',
			'output'    => 'false',
			'min'       => -5,
			'max'       => 5,
			'transport' => 'refresh',
			'type'      => 'slider_input'
		);


	/* ==================================================== *
	 *  Quote/Decoration Font Settings Section                         *
	 * ==================================================== */
	$customizer_options[] = array(
		'slug'		=> 'livre_quote_font_settings',
		'label'		=> esc_html__( 'Quote / Decoration', 'livre' ),
		'priority'	=> 3,
		'panel'		=> 'livre_panel_typography_settings',
		'type' 		=> 'section'
	);

		/* ============================================================ *
		 *  Typography Quote/Decoration Settings Data                              *
		 * ============================================================ */
		$customizer_options[] = array(
			'slug'		=> 'livre_quote_font',
			'default'	=> 'Merriweather',
			'label'		=> esc_html__( 'Font Family', 'livre' ),
			'section'	=> 'livre_quote_font_settings',
			'transport'	=> 'refresh',
			'type' 		=> 'google_font',
			'font_amount'	=> 5000,
		);

	/* ==================================================== *
	 *  Product Description Font Settings Section           *
	 * ==================================================== */
	$customizer_options[] = array(
		'slug'		=> 'livre_product_description_font_settings',
		'label'		=> esc_html__( 'Product Description', 'livre' ),
		'priority'	=> 4,
		'panel'		=> 'livre_panel_typography_settings',
		'type' 		=> 'section'
	);

		/* ============================================================ *
		 *  Typography Product Description Settings Data                              *
		 * ============================================================ */
		$customizer_options[] = array(
			'slug'		=> 'livre_product_description_font',
			'default'	=> 'Merriweather',
			'label'		=> esc_html__( 'Font Family', 'livre' ),
			'section'	=> 'livre_product_description_font_settings',
			'transport'	=> 'refresh',
			'type' 		=> 'google_font',
			'font_amount'	=> 5000,
		);
		$customizer_options[] = array(
			'slug'      => 'livre_product_description_font_size',
			'default'   => '18',
			'label'     => esc_html__( 'Font Size', 'livre' ),
			'section'   => 'livre_product_description_font_settings',
			'output'    => 'false',
			'min'       => 10,
			'max'       => 24,
			'transport' => 'refresh',
			'type'      => 'slider_input'
		);

	return $customizer_options;
}

