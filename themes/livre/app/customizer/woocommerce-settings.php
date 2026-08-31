<?php

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// WooCommerce Section
// -----------------------------------------------------------------------------------------------
// ===============================================================================================

if ( class_exists( 'WooCommerce' ) ) {

	add_filter( 'tokoo_new_customizer_data', 'livre_woocommerce_settings_data' );
	function livre_woocommerce_settings_data( $customizer_options ) {

		/* ===========================================================================================*
		 *  WooCommerce Settings Panel 					 				  								  *
		 * ===========================================================================================*/
		$customizer_options[] = array(
			'slug'		=> 'livre_panel_woo_settings',
			'label'		=> esc_html__( 'WooCommerce', 'livre' ),
			'priority'	=> 11,
			'type' 		=> 'panel'
		);

			/* ==================================================== *
			 *  Shop Page Section  									*
			 * ==================================================== */
			$customizer_options[] = array(
				'slug'		=> 'livre_shop_page_section',
				'label'		=> esc_html__( 'Shop Index', 'livre' ),
				'panel'		=> 'livre_panel_woo_settings',
				'priority'	=> 1,
				'type' 		=> 'section'
			);

				/* ============================================================ *
				 *  Shop Page Data  											*
				 * ============================================================ */
				$customizer_options[] = array(
					'slug'		=> 'livre_product_default_type',
					'default'	=> 'regular',
					'label'		=> esc_html__( 'Default Product Type', 'livre' ),
					'section'	=> 'livre_shop_page_section',
					'output'    => false,
					'transport'	=> 'refresh',
					'type' 		=> 'select',
					'choices'	=> array(
						'regular'		=> esc_html__( 'General - Default', 'livre' ),
						'book'			=> esc_html__( 'Book', 'livre' ),
						'movie'			=> esc_html__( 'Movie', 'livre' ),
						'audio'			=> esc_html__( 'Audio', 'livre' ),
						'game'			=> esc_html__( 'Game', 'livre' ),
					)
				);

				$customizer_options[] = array(
					'slug'		=> 'livre_product_layout',
					'default'	=> 'classic',
					'label'		=> esc_html__( 'Product Style', 'livre' ),
					'section'	=> 'livre_shop_page_section',
					'output'    => false,
					'transport'	=> 'refresh',
					'type' 		=> 'select',
					'choices'	=> array(
						'modern'		=> esc_html__( 'Modern', 'livre' ),
						'classic'		=> esc_html__( 'Classic', 'livre' ),
						'list'			=> esc_html__( 'List', 'livre' ),
					)
				);

				$customizer_options[] = array(
					'slug'		=> 'livre_product_specific_type_c',
					'default'	=> 0,
					'label'		=> esc_html__( 'Show Specific Product Type', 'livre' ),
					'section'	=> 'livre_shop_page_section',
					'type' 		=> 'checkbox'
				);
				
				$customizer_options[] = array(
					'slug'		=> 'livre_product_specific_type',
					'default'	=> 'book',
					'label'		=> esc_html__( 'Specific Product Type', 'livre' ),
					'section'	=> 'livre_shop_page_section',
					'output'    => false,
					'transport'	=> 'refresh',
					'type' 		=> 'select',
					'choices'	=> array(
						'regular'		=> esc_html__( 'Regular', 'livre' ),
						'book'			=> esc_html__( 'Book', 'livre' ),
						'movie'			=> esc_html__( 'Movie', 'livre' ),
						'audio'			=> esc_html__( 'Audio', 'livre' ),
						'game'			=> esc_html__( 'Game', 'livre' ),
					)
				);

				$customizer_options[] = array(
					'slug'		=> 'livre_product_category_count',
					'default'	=> 0,
					'label'		=> esc_html__( 'Hide Products Category Count', 'livre' ),
					'section'	=> 'livre_shop_page_section',
					'type' 		=> 'checkbox'
				);

				$customizer_options[] = array(
					'slug'		=> 'product_result_count',
					'default'	=> 0,
					'label'		=> esc_html__( 'Hide Products Result Count', 'livre' ),
					'section'	=> 'livre_shop_page_section',
					'type' 		=> 'checkbox'
				);

				$customizer_options[] = array(
					'slug'		=> 'livre_product_per_page',
					'default'	=> 9,
					'label'		=> esc_html__( 'Products Per Page', 'livre' ),
					'section'	=> 'livre_shop_page_section',
					'type' 		=> 'text'
				);

				$customizer_options[] = array(
					'slug'		=> 'livre_product_shop_loop_columns',
					'default'	=> '4',
					'label'		=> esc_html__( 'Product Columns', 'livre' ),
					'section'	=> 'livre_shop_page_section',
					'output'    => false,
					'transport'	=> 'refresh',
					'type' 		=> 'select',
					'choices'	=> array(
						'2'		=> 2,
						'3'		=> 3,
						'4'		=> 4,
						'5'		=> 5,
						'6'		=> 6,
					)
				);

				$customizer_options[] = array(
					'slug'		=> 'livre_product_sale_flash',
					'default'	=> 0,
					'label'		=> esc_html__( 'Hide Products Sale Flash', 'livre' ),
					'section'	=> 'livre_shop_page_section',
					'type' 		=> 'checkbox'
				);

				$customizer_options[] = array(
					'slug'		=> 'livre_product_category',
					'default'	=> 0,
					'label'		=> esc_html__( 'Hide Products Category', 'livre' ),
					'section'	=> 'livre_shop_page_section',
					'type' 		=> 'checkbox'
				);

				$customizer_options[] = array(
					'slug'		=> 'livre_product_title',
					'default'	=> 0,
					'label'		=> esc_html__( 'Hide Products Title', 'livre' ),
					'section'	=> 'livre_shop_page_section',
					'type' 		=> 'checkbox'
				);

				$customizer_options[] = array(
					'slug'		=> 'livre_product_star_rating',
					'default'	=> 0,
					'label'		=> esc_html__( 'Hide Products Star Rating', 'livre' ),
					'section'	=> 'livre_shop_page_section',
					'type' 		=> 'checkbox'
				);

				$customizer_options[] = array(
					'slug'		=> 'livre_product_price',
					'default'	=> 0,
					'label'		=> esc_html__( 'Hide Products Price', 'livre' ),
					'section'		=> 'livre_shop_page_section',
					'type' 		=> 'checkbox'
				);

				$customizer_options[] = array(
					'slug'		=> 'livre_product_add_to_cart',
					'default'	=> 0,
					'label'		=> esc_html__( 'Hide Products Quick Shop', 'livre' ),
					'section'	=> 'livre_shop_page_section',
					'type' 		=> 'checkbox'
				);

				$customizer_options[] = array(
					'slug'		=> 'livre_product_catalog_ordering',
					'default'	=> 0,
					'label'		=> esc_html__( 'Hide Products Catalog Ordering', 'livre' ),
					'section'	=> 'livre_shop_page_section',
					'type' 		=> 'checkbox'
				);

				$customizer_options[] = array(
					'slug'		=> 'livre_product_browse_by_tags',
					'default'	=> 0,
					'label'		=> esc_html__( 'Hide Browse by Tag', 'livre' ),
					'section'	=> 'livre_shop_page_section',
					'type' 		=> 'checkbox'
				);

			/* ==================================================== *
			 *  Single Product Section  							*
			 * ==================================================== */
			$customizer_options[] = array(
				'slug'		=> 'livre_single_product_section',
				'label'		=> esc_html__( 'Single Product', 'livre' ),
				'panel'		=> 'livre_panel_woo_settings',
				'priority'	=> 2,
				'type' 		=> 'section'
			);

				/* ============================================================ *
				 *  Single Product Data  										*
				 * ============================================================ */
				$customizer_options[] = array(
					'slug'		=> 'livre_enable_single_product_image_zoom',
					'default'	=> 1,
					'label'		=> esc_html__( 'Enable Single Products Image Zoom', 'livre' ),
					'section'	=> 'livre_single_product_section',
					'type' 		=> 'checkbox'
				);
				$customizer_options[] = array(
					'slug'		=> 'livre_product_single_sale_flash',
					'default'	=> 0,
					'label'		=> esc_html__( 'Hide Single Products Sale Flash', 'livre' ),
					'section'	=> 'livre_single_product_section',
					'type' 		=> 'checkbox'
				);

				$customizer_options[] = array(
					'slug'		=> 'livre_product_single_price',
					'default'	=> 0,
					'label'		=> esc_html__( 'Hide Single Products Price', 'livre' ),
					'section'	=> 'livre_single_product_section',
					'type' 		=> 'checkbox'
				);

				$customizer_options[] = array(
					'slug'		=> 'livre_product_single_add_to_cart',
					'default'	=> 0,
					'label'		=> esc_html__( 'Hide Single Products Add To Cart', 'livre' ),
					'section'	=> 'livre_single_product_section',
					'type' 		=> 'checkbox'
				);

				$customizer_options[] = array(
					'slug'		=> 'livre_product_single_excerpt',
					'default'	=> 0,
					'label'		=> esc_html__( 'Hide Single Products Excerpt', 'livre' ),
					'section'	=> 'livre_single_product_section',
					'type' 		=> 'checkbox'
				);

				$customizer_options[] = array(
					'slug'		=> 'livre_product_single_meta',
					'default'	=> 0,
					'label'		=> esc_html__( 'Hide Single Products Meta', 'livre' ),
					'section'	=> 'livre_single_product_section',
					'type' 		=> 'checkbox'
				);

				$customizer_options[] = array(
					'slug'		=> 'livre_product_single_rating',
					'default'	=> 0,
					'label'		=> esc_html__( 'Hide Single Products Rating', 'livre' ),
					'section'	=> 'livre_single_product_section',
					'type' 		=> 'checkbox'
				);

				$customizer_options[] = array(
					'slug'		=> 'livre_product_tabs',
					'default'	=> 0,
					'label'		=> esc_html__( 'Hide Single Products Tabs', 'livre' ),
					'section'	=> 'livre_single_product_section',
					'type' 		=> 'checkbox'
				);

			/* ==================================================== *
			 *  Related Product Section  							*
			 * ==================================================== */
			$customizer_options[] = array(
				'slug'		=> 'livre_related_product_section',
				'label'		=> esc_html__( 'Related Product', 'livre' ),
				'panel'		=> 'livre_panel_woo_settings',
				'priority'	=> 3,
				'type' 		=> 'section'
			);

				/* ============================================================ *
				 *  Related Product Data  										*
				 * ============================================================ */
				$customizer_options[] = array(
					'slug'		=> 'livre_product_related',
					'default'	=> 0,
					'label'		=> esc_html__( 'Hide Related Products', 'livre' ),
					'section'	=> 'livre_related_product_section',
					'type' 		=> 'checkbox'
				);

				$customizer_options[] = array(
					'slug'		=> 'livre_related_product_per_page',
					'default'	=> 4,
					'label'		=> esc_html__( 'Related Product Per Page', 'livre' ),
					'section'	=> 'livre_related_product_section',
					'type' 		=> 'text'
				);

				$customizer_options[] = array(
					'slug'		=> 'livre_related_product_title',
					'default'	=> '',
					'label'		=> esc_html__( 'Related Product Title', 'livre' ),
					'section'	=> 'livre_related_product_section',
					'type' 		=> 'text'
				);

				$customizer_options[] = array(
					'slug'		=> 'livre_related_product_layout',
					'default'	=> 'classic',
					'label'		=> esc_html__( 'Related Product Style', 'livre' ),
					'section'	=> 'livre_related_product_section',
					'output'    => false,
					'transport'	=> 'refresh',
					'type' 		=> 'select',
					'choices'	=> array(
						'modern'		=> esc_html__( 'Modern', 'livre' ),
						'classic'		=> esc_html__( 'Classic', 'livre' ),
					)
				);

				$customizer_options[] = array(
					'slug'		=> 'livre_related_product_columns',
					'default'	=> '4',
					'label'		=> esc_html__( 'Related Product Columns', 'livre' ),
					'section'	=> 'livre_related_product_section',
					'output'    => false,
					'transport'	=> 'refresh',
					'type' 		=> 'select',
					'choices'	=> array(
						'2'		=> 2,
						'3'		=> 3,
						'4'		=> 4,
						'5'		=> 5,
						'6'		=> 6,
					)
				);


			/* ==================================================== *
			 *  Upsells Product Section  							*
			 * ==================================================== */
			$customizer_options[] = array(
				'slug'		=> 'livre_upsells_product_section',
				'label'		=> esc_html__( 'Upsells Product', 'livre' ),
				'panel'		=> 'livre_panel_woo_settings',
				'priority'	=> 4,
				'type' 		=> 'section'
			);

				/* ============================================================ *
				 *  Upsells Product Data  										*
				 * ============================================================ */
				$customizer_options[] = array(
					'slug'		=> 'livre_product_upsells',
					'default'	=> 0,
					'label'		=> esc_html__( 'Hide Up-Sells Products', 'livre' ),
					'section'	=> 'livre_upsells_product_section',
					'type' 		=> 'checkbox'
				);

				$customizer_options[] = array(
					'slug'		=> 'livre_upsell_product_per_page',
					'default'	=> 4,
					'label'		=> esc_html__( 'Upsell Product Per Page', 'livre' ),
					'section'	=> 'livre_upsells_product_section',
					'type' 		=> 'text'
				);

				$customizer_options[] = array(
					'slug'		=> 'livre_upsell_product_title',
					'default'	=> '',
					'label'		=> esc_html__( 'Upsell Product Title', 'livre' ),
					'section'	=> 'livre_upsells_product_section',
					'type' 		=> 'text'
				);

				$customizer_options[] = array(
					'slug'		=> 'livre_upsells_product_layout',
					'default'	=> 'classic',
					'label'		=> esc_html__( 'Upsells Product Style', 'livre' ),
					'section'	=> 'livre_upsells_product_section',
					'output'    => false,
					'transport'	=> 'refresh',
					'type' 		=> 'select',
					'choices'	=> array(
						'modern'		=> esc_html__( 'Modern', 'livre' ),
						'classic'		=> esc_html__( 'Classic', 'livre' ),
					)
				);

				$customizer_options[] = array(
					'slug'		=> 'livre_upsells_product_columns',
					'default'	=> '4',
					'label'		=> esc_html__( 'Upsells Product Columns', 'livre' ),
					'section'	=> 'livre_upsells_product_section',
					'output'    => false,
					'transport'	=> 'refresh',
					'type' 		=> 'select',
					'choices'	=> array(
						'2'		=> 2,
						'3'		=> 3,
						'4'		=> 4,
						'5'		=> 5,
						'6'		=> 6,
					)
				);

			/* ==================================================== *
			 *  Category on Single Product Section  							*
			 * ==================================================== */
			$customizer_options[] = array(
				'slug'		=> 'livre_category_single_product_section',
				'label'		=> esc_html__( 'Category on Single Product', 'livre' ),
				'panel'		=> 'livre_panel_woo_settings',
				'priority'	=> 5,
				'type' 		=> 'section'
			);

				/* ============================================================ *
				 *  Category Single Product Data  								*
				 * ============================================================ */
				$customizer_options[] = array(
					'slug'		=> 'livre_category_single_product',
					'default'	=> 0,
					'label'		=> esc_html__( 'Hide Category on Single Product', 'livre' ),
					'section'	=> 'livre_category_single_product_section',
					'type' 		=> 'checkbox'
				);

				$customizer_options[] = array(
					'slug'		=> 'livre_category_single_product_per_page',
					'default'	=> 3,
					'label'		=> esc_html__( 'Category on Single Product Number', 'livre' ),
					'section'	=> 'livre_category_single_product_section',
					'type' 		=> 'text'
				);

			/* ==================================================== *
			 *  Cross Sells Product Section  							*
			 * ==================================================== */
			$customizer_options[] = array(
				'slug'		=> 'livre_cross_sells_product_section',
				'label'		=> esc_html__( 'Cross Sells Product', 'livre' ),
				'panel'		=> 'livre_panel_woo_settings',
				'priority'	=> 6,
				'type' 		=> 'section'
			);

				/* ============================================================ *
				 *  Cross Sells Product Data  										*
				 * ============================================================ */
				$customizer_options[] = array(
					'slug'		=> 'livre_product_cross_sells',
					'default'	=> 0,
					'label'		=> esc_html__( 'Hide Cross-Sells Products', 'livre' ),
					'section'		=> 'livre_cross_sells_product_section',
					'type' 		=> 'checkbox'
				);

		return $customizer_options;
	}
}

