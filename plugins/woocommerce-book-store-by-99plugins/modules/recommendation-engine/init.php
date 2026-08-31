<?php 

require_once NN_WCBS_DIR . 'modules/recommendation-engine/hooks.php'; 

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'theme_options', esc_html__( 'WooCommerce Recommendation Engine', 'wcbs' ) )
	->set_page_parent( 'nn-plugins-dashboard.php' ) // identificator of the "Appearance" admin section
	->add_tab( esc_html__( 'General Settings', 'wcbs' ), array(
		// BY VIEWED
		Field::make( 'checkbox', 'wcbs_enable_related_by_viewed', esc_html__( 'Enable Your Recently Viewed Items', 'wcbs' ) )
			->set_default_value( 'yes' ),
		Field::make( 'text', 'wcbs_related_by_viewed_product_limit', esc_html__( 'Limit Product', 'wcbs' ) )
			->set_default_value( '6' ),
		Field::make( 'text', 'wcbs_related_by_viewed_product_columns', esc_html__( 'Product Columns', 'wcbs' ) )
			->set_default_value( '6' ),

		// BY COMPLETED
		Field::make( 'checkbox', 'wcbs_enable_related_by_completed', esc_html__( 'Enable Customers Who Bought This Item Also Bought', 'wcbs' ) )
			->set_default_value( 'yes' ),
		Field::make( 'text', 'wcbs_related_by_completed_product_limit', esc_html__( 'Limit Product', 'wcbs' ) )
			->set_default_value( '6' ),
		Field::make( 'text', 'wcbs_related_by_completed_product_columns', esc_html__( 'Product Columns', 'wcbs' ) )
			->set_default_value( '6' ),

	))

	->add_tab( esc_html__( 'Label Settings', 'wcbs' ), array(
		Field::make( 'text', 'wcbs_related_by_viewed_section_title', esc_html__( 'Your Recently Viewed Items Section Title', 'wcbs' ) )->set_default_value( 'Your Recently Viewed Items' ),
		Field::make( 'text', 'wcbs_related_by_completed_section_title', esc_html__( 'Customers Who Bought This Item Also Bought Section Title', 'wcbs' ) )->set_default_value( 'Customers Who Bought This Item Also Bought' ),
	));
