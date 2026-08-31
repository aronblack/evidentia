<?php 

/**
 * Trigger Hooks
 *
 * @return void
 * @author 99Plugins
 **/
add_action( 'init', 'wcbs_trigger_recommendation_engine_hooks' );
function wcbs_trigger_recommendation_engine_hooks() {
	$related_by_viewed 		= carbon_get_theme_option( 'wcbs_enable_related_by_viewed' );
	$related_by_completed 	= carbon_get_theme_option( 'wcbs_enable_related_by_completed' );

	if ( 'yes' == $related_by_viewed ) {
		add_action( 'woocommerce_after_single_product_summary', 'wcbs_recommender_output_viewed_products', 30 );
	}

	if ( 'yes' == $related_by_completed ) {
		add_action( 'woocommerce_after_single_product_summary', 'wcbs_recommender_output_completed_products', 35 );
	}

}

/**
 * Render output related product by viewed
 *
 * @return void
 * @author 99Plugins
 **/
function wcbs_recommender_output_viewed_products() {

	$get_section_title		= carbon_get_theme_option( 'wcbs_related_by_viewed_section_title' );
	$get_posts_per_page		= carbon_get_theme_option( 'wcbs_related_by_viewed_product_limit' );
	$get_columns			= carbon_get_theme_option( 'wcbs_related_by_viewed_product_columns' );
	$product_columns		= ! empty( $get_columns ) ? $get_columns : 6;
	$posts_per_page 		= ! empty( $get_posts_per_page ) ? $get_posts_per_page : 6;
	$section_title 			= ! empty( $get_section_title ) ? $get_section_title : esc_html__( 'Customers also viewed these products', 'wcbs' );

	woocommerce_reset_loop();
	wc_get_template( 'books/wcbs-related-viewed.php', 
		array(
			'posts_per_page' 	=> $posts_per_page,
			'section_title' 	=> $section_title,
			'orderby' 			=> '',
			'columns'			=> $product_columns,
			'activity_types' 	=> 'viewed'
		), 
		'',
		NN_WCBS_DIR . 'templates/' );
	woocommerce_reset_loop();
}

/**
 * Render output related product by completed
 *
 * @return void
 * @author 99Plugins
 **/
function wcbs_recommender_output_completed_products() {
	
	$get_section_title		= carbon_get_theme_option( 'wcbs_related_by_completed_section_title' );
	$get_posts_per_page		= carbon_get_theme_option( 'wcbs_related_by_completed_product_limit' );
	$get_columns			= carbon_get_theme_option( 'wcbs_related_by_completed_product_columns' );
	$product_columns		= ! empty( $get_columns ) ? $get_columns : 6;
	$posts_per_page 		= ! empty( $get_posts_per_page ) ? $get_posts_per_page : 6;
	$section_title 			= ! empty( $get_section_title ) ? $get_section_title : esc_html__( 'Customers also purchased these products', 'wcbs' );

	woocommerce_reset_loop();
	wc_get_template( 'books/wcbs-related-completed.php', 
		array(
			'posts_per_page' 	=> $posts_per_page,
			'section_title' 	=> $section_title,
			'orderby' 			=> '',
			'columns'			=> $product_columns,
			'activity_types' 	=> 'completed'
		), 
		'',
		NN_WCBS_DIR . 'templates/' );
	woocommerce_reset_loop();
}