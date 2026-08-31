<?php

/**
 * Get site layout
 *
 * @return void
 * @author tokoo
 **/
function livre_get_site_layout() {
	$global_layout 	= get_theme_mod( 'livre_global_layout', 'fullwidth' );
	$get_layouts 	= livre_get_meta( '_layouts_details' );
	$layout 		= ! empty( $get_layouts['theme_layouts'] ) ? $get_layouts['theme_layouts'] : $global_layout;
	return $layout;
}

/**
 * Wrapper Class Handles
 *
 * @return void
 * @author tokoo
 **/
function livre_wrapper_class_handles() {
	$get_layouts 	= livre_get_site_layout(); 
	
	if ( ! empty( $get_layouts ) ) {
		switch ( $get_layouts ) {
			case 'left-sidebar':
				echo esc_attr( ' has-sidebar layout-left-sidebar' );
				break;
			case 'right-sidebar':
				echo esc_attr( ' has-sidebar layout-right-sidebar' );
				break;
			default:
				echo '';
				break;
		}
	}
}

/**
 * Column Class Handles
 *
 * @return void
 * @author tokoo
 **/
function livre_columns_class_handles() {
	$get_layouts 	= livre_get_site_layout(); 

	if ( ! empty( $get_layouts ) ) {
		switch ( $get_layouts ) {
			case 'left-sidebar':
			case 'right-sidebar':
				echo esc_attr( 'col-md-8' );
				break;
			default:
				echo '';
				break;
		}
	}

}

/**
 * Post holder columns
 *
 * @return void
 * @author tokoo
 **/
function livre_post_holder_columns() {
	if ( livre_is_has_sidebar() ) {
		echo 'columns-2';
	} else {
		echo '';
	}

}

/**
 * undocumented function
 *
 * @return void
 * @author 
 **/
function livre_is_has_sidebar() { 
	$get_layouts 	= livre_get_site_layout(); 
	if ( ! empty( $get_layouts ) && ( 'left-sidebar' == $get_layouts || 'right-sidebar' == $get_layouts ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * undocumented function
 *
 * @return void
 * @author 
 **/
function livre_print_filter_class_alphabet( $string = '' ) {
	if ( ! empty( $string ) ) {
		$string = $string[0];
		echo strtoupper( $string );
	}
}

/**
 * Get page title background Image
 *
 * @return void
 * @author tokoo
 **/
function livre_get_page_title_background_image_src() {
	if ( function_exists( 'carbon_get_term_meta' ) ) {
		$id 				= get_queried_object_id();
		$get_tax_bg_img_id 	= carbon_get_term_meta( $id, 'livre_tax_page_title_background' );
		$get_bg_image_src 	= wp_get_attachment_image_src( $get_tax_bg_img_id, 'full' );
		
		if ( ! empty( $get_tax_bg_img_id ) ) {
			return $get_bg_image_src[0];
		} else {
			return null;
		}
	}
}
