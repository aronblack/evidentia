<?php 

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// Register Panel
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
add_filter( 'tokoo_new_customizer_data', 'livre_customizer_layout_settings' );
function livre_customizer_layout_settings( $customizer_options ) {

	/* ==================================================== *
	 *  Site Section  										*
	 * ==================================================== */
	$customizer_options[] = array(
		'slug'		=> 'livre_layout_settings',
		'label'		=> esc_html__( 'Layout', 'livre' ),
		'priority'	=> 3,
		'type' 		=> 'section'
	);

		/* ============================================================ *
		 *  Layout Data  													*
		 * ============================================================ */
		$customizer_options[] = array(
			'slug'		=> 'livre_global_layout',
			'default'	=> 'fullwidth',
			'priority'	=> 1,
			'label'		=> esc_html__( 'Global Site Layout', 'livre' ),
			'section'	=> 'livre_layout_settings',
			'output'    => false,
			'transport'	=> 'refresh',
			'type' 		=> 'select',
			'choices'	=> array(
				'fullwidth'			=> esc_html__( 'Fullwidth', 'livre' ),
				'left-sidebar'		=> esc_html__( 'Left Sidebar', 'livre' ),
				'right-sidebar'		=> esc_html__( 'Right Sidebar', 'livre' ),
			)
		);


	return $customizer_options;
}

