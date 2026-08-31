<?php 

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// Register Panel
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
add_filter( 'tokoo_new_customizer_data', 'livre_customizer_posts_settings' );
function livre_customizer_posts_settings( $customizer_options ) {

	/* ===========================================================================================*
	 *  Posts Settings Panel 					 				  								  *
	 * ===========================================================================================*/
	$customizer_options[] = array(
		'slug'		=> 'livre_panel_posts_settings',
		'label'		=> esc_html__( 'Post', 'livre' ),
		'priority'	=> 8,
		'type' 		=> 'panel'
	);

		/* ==================================================== *
		 *  Post Settings Section                               *
		 * ==================================================== */
		$customizer_options[] = array(
			'slug'		=> 'livre_blog_index_settings',
			'label'		=> esc_html__( 'Blog Index', 'livre' ),
			'panel'	    => 'livre_panel_posts_settings',
			'type' 		=> 'section'
		);

			$customizer_options[] = array(
				'slug'		=> 'livre_blog_style',
				'default'	=> 'masonry',
				'label'		=> esc_html__( 'Blog Index Style', 'livre' ),
				'section'	=> 'livre_post_settings',
				'type' 		=> 'select',
				'transport'	=> 'refresh',
				'choices'	=> array(
					'masonry'	=> esc_html__( 'Masonry (default)', 'livre' ),
					'grid'		=> esc_html__( 'Grid', 'livre' ),
					'list'		=> esc_html__( 'List', 'livre' ),
				),
			);
			$customizer_options[] = array(
				'slug'		=> 'livre_blog_columns',
				'default'	=> '3',
				'label'		=> esc_html__( 'Blog Index Columns', 'livre' ),
				'section'	=> 'livre_post_settings',
				'type' 		=> 'select',
				'transport'	=> 'refresh',
				'choices'	=> array(
					'1'	=> '1',
					'2'	=> '2',
					'3'	=> '3',
				),
			);

		/* ==================================================== *
		 *  Post Settings Section                               *
		 * ==================================================== */
		$customizer_options[] = array(
			'slug'		=> 'livre_post_settings',
			'label'		=> esc_html__( 'Blog Post', 'livre' ),
			'panel'	    => 'livre_panel_posts_settings',
			'type' 		=> 'section'
		);

			$customizer_options[] = array(
				'slug'		=> 'livre_stick_text',
				'default'	=> '',
				'priority'	=> 1,
				'label'		=> esc_html__( 'Sticky Post Label', 'livre' ),
				'section'	=> 'livre_post_settings',
				'type' 		=> 'text',
				'transport'	=> 'refresh',
			);

		$pages = get_pages();

				if ( $pages ) {
					$pages_choices[] = esc_html__( '--none--', 'livre' );
					foreach ( $pages as $pages ) {
						$pages_choices[$pages->ID] = $pages->post_title;
				}
			}

		/* ==================================================== *
		 *  Related Post Section                               *
		 * ==================================================== */
		$customizer_options[] = array(
			'slug'		=> 'livre_related_settings',
			'label'		=> esc_html__( 'Related Post Settings', 'livre' ),
			'panel'	    => 'livre_panel_posts_settings',
			'type' 		=> 'section'
		);

			/* ============================================================ *
			 *  Related Data                                          *
			 * ============================================================ */
			$customizer_options[] = array(
				'slug'		=> 'livre_disallow_by_category',
				'default'	=> '',
				'priority'	=> 1,
				'label'		=> esc_html__( 'Disallow by Category', 'livre' ),
				'section'	=> 'livre_related_settings',
				'transport'	=> 'refresh',
				'type' 		=> 'category_dropdown'
			);

			$tags = get_tags();

			if ( $tags ) {
				$tags_choices[] = esc_html__( '--none--', 'livre' );
				foreach ( $tags as $tag ) {
					$tags_choices[$tag->term_id] = $tag->name;
				}
				$customizer_options[] = array(
					'slug'		=> 'livre_disallow_by_tags',
					'default'	=> '',
					'priority'	=> 2,
					'label'		=> esc_html__( 'Disallow by Tag', 'livre' ),
					'section'	=> 'livre_related_settings',
					'transport'	=> 'refresh',
					'type' 		=> 'select',
					'choices'   => $tags_choices
				);
			}

			$customizer_options[] = array(
				'slug'		=> 'livre_related_title',
				'default'	=> esc_html__( 'Related', 'livre' ),
				'priority'	=> 3,
				'label'		=> esc_html__( 'Related Title', 'livre' ),
				'section'	=> 'livre_related_settings',
				'transport'	=> 'refresh',
				'type' 		=> 'text'
			);

			$customizer_options[] = array(
				'slug'		=> 'livre_related_number',
				'default'	=> 3,
				'priority'	=> 4,
				'label'		=> esc_html__( 'Display Per Page', 'livre' ),
				'section'	=> 'livre_related_settings',
				'transport'	=> 'refresh',
				'type' 		=> 'text'
		);


	return $customizer_options;
}