<?php 

/**
 * Custom Tax Reading List
 *
 * @return void
 * @author tokoo
 **/
add_action( 'init', 'livre_collections_taxo_registration' );
function livre_collections_taxo_registration() {

	if ( function_exists( 'register_extended_taxonomy' ) ) {

		register_extended_taxonomy( 'collections', 'product', array(),
		array(
			'singular' 	=> esc_html__( 'Collection', 'livre' ),
			'plural' 	=> esc_html__( 'Collections', 'livre' ),
			'slug'		=> 'collection',
		)
	);
	}

}