<?php

/**
 * Get all categories
 *
 * @return void
 * @author tokoo
 **/
function livre_get_categories() {

	$cats 	= get_categories( array( 'hide_empty' => 0 ) );
	$result = array();
	if ( ! empty( $cats ) ) {
		foreach ( $cats as $cat ) {
			$result[$cat->cat_ID] = $cat->name;
		}
	}

	return $result;
}

/**
 * Get terms list
 *
 * @return void
 * @author tokoo
 **/
function livre_get_terms( $taxonomy = 'category', $id = false, $hide_empty =  false ) {
	$term_query = new WP_Term_Query( array( 'taxonomy' => $taxonomy, 'hide_empty' => $hide_empty ) );
	$results 	= array();
	if ( ! empty( $term_query->terms ) ) {
		foreach ( $term_query->terms as $term ) {
			if ( true == $id ) {
				$results[$term->term_id] = $term->name;
			} else {
				$results[$term->slug] = $term->name;
			}
		}
	}
	return $results;
}

/**
 * Get all users
 *
 * @return void
 * @author tokoo
 **/
function livre_get_users() {
	$users 		= get_users();
	$result 	= array();
	if ( ! empty( $users ) ) {
		foreach ( $users as $user ) {
			$result[] = array( 'value' => $user['id'], 'label' => $user['display_name'] );
		}
	}
	return $result;
}

/**
 * Get all posts
 *
 * @return void
 * @author
 **/
function livre_get_posts( $type = 'post' ) {

	$posts = get_posts( array(
		'posts_per_page' 	=> -1,
		'post_type'			=> $type,
	));

	$result 	= array();
	$result[0]	= esc_html__( 'Select Item', 'livre' );
	if ( ! empty( $posts ) ) {
		foreach ( $posts as $post )	{
			$result[$post->ID] = $post->post_title;
		}
	}
	return $result;
}

/**
 * Get all onsale product
 *
 * @return void
 * @author
 **/
function livre_get_onsale_products() {

	$args = array(
		'posts_per_page' 	=> -1,
		'post_type'			=> 'product',
	);
	if ( class_exists( 'WooCommerce' ) ) {
		$args['meta_query'] 	= WC()->query->get_meta_query();
		$args['post__in'] 		= array_merge( array( 0 ), wc_get_product_ids_on_sale() );
	}

	$posts 		= get_posts( $args );
	$result 	= array();
	$result[0]	= esc_html__( 'Select Item', 'livre' );
	if ( ! empty( $posts ) && class_exists( 'WooCommerce' ) ) {
		foreach ( $posts as $post )	{
			$the_product = wc_get_product( $post->ID );
			if ( $the_product->is_type( 'simple' ) ) {
				$result[$post->ID] = $post->post_title;
			}
		}
	}
	return $result;
}

/**
 * Get all pages
 *
 * @return void
 * @author tokoo
 **/
function livre_get_pages() {
	$pages 	= get_pages();
	$result = array();
	if ( ! empty( $pages ) ) {
		foreach ( $pages as $page ) {
			$result[$page->ID] = $page->post_title;
		}
	}
	return $result;
}

/**
 * Get all tags
 *
 * @return void
 * @author tokoo
 **/
function livre_get_tags() {
	$tags 	= get_tags( array( 'hide_empty' => 0 ) );
	$result = array();
	if ( ! empty( $tags ) ) {
		foreach ( $tags as $tag ) {
			$result[$tag->term_id] = $tag->name;
		}
	}
	return $result;
}

/**
 * Get Revolution Slider list
 *
 * @return void
 * @author tokoo
 **/
function livre_get_revolsider_list() {
	/**
	 * Get Revo Slider list
	 *
	 * @link https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress/issues/375
	 */
	global $wpdb;
	$sql 			= 'SELECT * FROM ' . $wpdb->prefix . 'revslider_sliders';
	$get_sliders 	= $wpdb->get_results( $wpdb->prepare( $sql ), ARRAY_A );

	if ( ! empty( $get_sliders ) ) {
		$revsliders['Default'] =  esc_html__( 'Select a Slider', 'livre' );
		foreach( $get_sliders as $slider ) {
			$revsliders[$slider->title] = $slider->alias;
		}
	} else {
		$revsliders['None'] =  esc_html__( 'No Slider Found', 'livre' );
	}

	return $revsliders;
}

/**
 * Get all registered sidebar
 *
 * @return void
 * @author tokoo
 **/
if ( ! function_exists('livre_get_all_sidebars')) {
	function livre_get_all_sidebars() {
		global $wp_registered_sidebars;
		$all_sidebars = array();
		if ( $wp_registered_sidebars && ! is_wp_error( $wp_registered_sidebars ) ) {
			foreach ( $wp_registered_sidebars as $sidebar ) {
				$all_sidebars[$sidebar['id']] = $sidebar['name'];
			}
		}
		return $all_sidebars;
	}
}

/**
 * Get all ninja form list
 *
 * @return void
 * @author tokoo
 **/
function livre_get_all_ninja_forms() {

	if ( function_exists( 'ninja_forms_get_all_forms' ) ) {
		$ninja_forms = ninja_forms_get_all_forms();
		if ( ! empty( $ninja_forms ) ) {
			foreach( $ninja_forms as $form ){
				$all_forms[0] 			= esc_html__( '-- None --', 'livre' );
				$all_fogrms[$form['id']] = $form['name'];
			}
		} else {
			$all_forms[0] 		= esc_html__( 'No Form Available', 'livre' );
		}

		return $all_forms;
	} else {
		return array( 0 => esc_html__( 'Ninja Form not installed', 'livre' ) );
	}
}


/**
 * Get all registered post type
 *
 * @return void
 * @author tokoo
 **/
function livre_get_registered_post_types() {

	$types 		= get_post_types( array( 'public'   => true, ), 'objects' );
	$results 	= array();
	if ( ! empty( $types ) ) {
		foreach ( $types as $type ) {
			$result[$type->name] = $type->labels->singular_name;
		}
	}

	return $results;
}


/**
 * Get all categories for widget field
 *
 * @return void
 * @author tokoo
 **/
function livre_widget_get_categories() {

	$cats 		= get_categories( array( 'hide_empty' => 0 ) );
	$results 	= array();
	if ( ! empty( $cats ) ) {
		foreach ( $cats as $cat ) {
			$results[] = array(
				'name' 	=> $cat->slug,
				'value' => $cat->name
				);
		}
	}

	return $results;
}

/**
 * Get all registered post type for widget field
 *
 * @return void
 * @author tokoo
 **/
function livre_widget_get_registered_post_types() {

	$types 		= get_post_types( array( 'public'   => true, ), 'objects' );
	$results 	= array();
	if ( ! empty( $types ) ) {
		foreach ( $types as $type ) {
			$results[] = array(
				'name' 		=> $type->labels->singular_name,
				'value' 	=> $type->name
			);
		}
	}

	return $results;
}

/**
 * Get all contact form 7 Form
 *
 * @return void
 * @author tokoo
 **/
if ( ! function_exists( 'livre_get_cf7_list_form' )) {
	function livre_get_cf7_list_form() {
		$datas 		= get_posts( array( 'post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1 ) );
		$results 	= array();
		if ( ! empty( $datas ) ) {
			foreach ( $datas as $data ) {
				$results[$data->ID] = $data->post_title;
			}	
		}
		return $results;
	}
}

/**
 * Get all product category 
 *
 * @return void
 * @author
 **/
 
function livre_get_product_category(){

	$result_category = array();

	
	$result_category = livre_get_terms( 'product_cat' );
 	$result_category['all'] = esc_html__( 'All Category', 'livre' );

    return $result_category;
 
}