<?php 

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// Register Panel
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
add_filter( 'tokoo_new_customizer_data', 'livre_customizer_page_settings' );
function livre_customizer_page_settings( $customizer_options ) {

	/* ===========================================================================================*
	 *  Page Settings Panel 					 				  								  *
	 * ===========================================================================================*/
	$customizer_options[] = array(
		'slug'		=> 'livre_panel_page_settings',
		'label'		=> esc_html__( 'Page', 'livre' ),
		'priority'	=> 9,
		'type' 		=> 'panel'
	);

		/* ==================================================== *
		 *  Page Settings Section                               *
		 * ==================================================== */
		$customizer_options[] = array(
			'slug'		=> 'livre_page_settings',
			'label'		=> esc_html__( 'Page', 'livre' ),
			'panel'	    => 'livre_panel_page_settings',
			'priority'	=> 1,
			'type' 		=> 'section'
		);

			/* ============================================================ *
			 *  Page Settings Data                                          *
			 * ============================================================ */
			$customizer_options[] = array(
				'slug'		=> 'livre_post_author',
				'default'	=> 1,
				'priority'	=> 1,
				'label'		=> esc_html__( 'Post Author Box', 'livre' ),
				'section'	=> 'livre_page_settings',
				'selector'	=> '.post-author',
				'transport'	=> 'postMessage',
				'type' 		=> 'checkbox'
			);

			$customizer_options[] = array(
				'slug'		=> 'livre_comment_form',
				'default'	=> 1,
				'priority'	=> 2,
				'label'		=> esc_html__( 'Post/Page Comments', 'livre' ),
				'section'	=> 'livre_page_settings',
				'selector'	=> '.comments-area',
				'transport'	=> 'postMessage',
				'type' 		=> 'checkbox'
			);

			$customizer_options[] = array(
				'slug'		=> 'livre_social_share',
				'default'	=> 1,
				'priority'	=> 3,
				'label'		=> esc_html__( 'Social Share Buttons', 'livre' ),
				'section'	=> 'livre_page_settings',
				'selector'	=> '.social-share-holder',
				'transport'	=> 'postMessage',
				'type' 		=> 'checkbox'
			);

	return $customizer_options;
}