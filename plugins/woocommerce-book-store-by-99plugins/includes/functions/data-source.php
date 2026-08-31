<?php 

/**
 * Get all posts
 *
 * @return void
 * @author 
 **/
function wcbs_get_posts( $post_type = 'product' ) {

	$posts = get_posts( array(
		'posts_per_page' 	=> -1,
		'post_type'			=> $post_type
	));

	if ( ! empty( $posts ) ) {
		$result = array();
		foreach ( $posts as $post )	{
			$result[$post->ID] = $post->post_title;
		}
		return $result;
	}
}

/**
 * Get Product Meta
 *
 * @return void
 * @author 
 **/
function wcbs_get_wc_value( $post_id, $field_id ) {
	$meta_value = get_post_meta( $post_id, 'wc_productdata_options', true );
	$meta_value = isset( $meta_value[0] ) ? $meta_value[0] : '';
	return ( isset( $meta_value[$field_id] ) ) ? $meta_value[$field_id] : '';
}

/**
 * Get Option Value
 *
 * @return void
 * @author 99plugins
 **/
function wcbs_get_option( $key = '', $default = '' ) {
	if ( function_exists( 'carbon_get_theme_option' ) ) {
		$get_option = carbon_get_theme_option( $key );
		if ( ! empty( $get_option ) ) {
			return carbon_get_theme_option( $key );
		} else {
			return $default;
		}
	}
}

