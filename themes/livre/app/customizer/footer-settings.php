<?php

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// General Section
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
add_filter( 'tokoo_new_customizer_data', 'livre_footer_settings_data' );
function livre_footer_settings_data( $customizer_options ) {


	/* ==================================================== *
	 *  Footer Section  										*
	 * ==================================================== */
	$customizer_options[] = array(
		'slug'		=> 'livre_footer_settings',
		'label'		=> esc_html__( 'Footer', 'livre' ),
		'priority'	=> 10,
		'type' 		=> 'section'
	);

		$customizer_options[] = array(
			'slug'		=> 'livre_payment_logo',
			'default'	=> '',
			'priority'	=> 3,
			'label'		=> esc_html__( 'Payment Logo', 'livre' ),
			'section'	=> 'livre_footer_settings',
			'output'    => false,
			'transport'	=> 'postMessage',
			'type' 		=> 'images'
		);

		$customizer_options[] = array(
			'slug'		=> 'livre_footer_content',
			'default'	=> '',
			'priority'	=> 5,
			'label'		=> esc_html__( 'Footer Credits', 'livre' ),
			'section'	=> 'livre_footer_settings',
			'output'    => false,
			'transport'	=> 'refresh',
			'type' 		=> 'textarea'
		);

		$customizer_options[] = array(
			'slug'		=> 'livre_sidebar_footer_columns',
			'default'	=> '3',
			'label'		=> esc_html__( 'Footer Sidebar Columns', 'livre' ),
			'section'	=> 'livre_footer_settings',
			'output'    => false,
			'transport'	=> 'refresh',
			'type' 		=> 'select',
			'choices'	=> array(
				'2' => '2',
				'3' => '3',
				'4' => '4',
			)
		);

	return $customizer_options;
}

