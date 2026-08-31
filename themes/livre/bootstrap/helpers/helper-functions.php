<?php

/**
 * Wrapping print_r function
 *
 * @return string
 * @author tokoo
 **/
function livre_dump( $string ) {
	echo '<pre>';
	var_dump( $string );
	echo '</pre>';
}

/**
* This is just a tiny wrapper function for the class above so that there is no
* need to change any code in your own WP themes. Usage is still the same :)
*/
if ( class_exists('Aq_Resize')) {
	function livre_resize( $url, $width = null, $height = null ) {
		$aq_resize = Aq_Resize::getInstance();
		return $aq_resize->process( $url, $width, $height, true, true, true );
	}	
}

/**
 * tokoo Metadata
 *
 * @since  1.0
 * @author tokoo
 **/
function livre_get_meta( $meta = '', $single = true ) {
	if ( is_home() ) {
		$id = get_option( 'page_for_posts' );
	} elseif ( class_exists( 'WooCommerce' ) ) { 
		if ( is_shop() || is_product_category() ) {
			$id = get_option( 'woocommerce_shop_page_id' ); 
		} else {
			$id = get_the_ID();
		} 
	} else { $id = get_the_ID();  }

	return get_post_meta( $id, 'livre' . $meta, $single );
}

/*
 * Funcion To Call Option
 *
 * @since  1.0
 */
function livre_get_option( $name, $default = null ) {
	return get_theme_mod( 'livre_' . $name, $default );
}

/**
 * Replaces "[...]" with just ...
 *
 * @since 1.0
 */
add_filter( 'excerpt_more', 'livre_auto_excerpt_more' );
function livre_auto_excerpt_more( $more ) {
	return ' &hellip;';
}

/**
 * Forked from hybrid_get_the_post_format_url.
 * Filters 'get_the_post_format_url' to make for a more robust and back-compatible function.  If WP did
 * not find a URL, check the post content for one.  If nothing is found, return the post permalink.
 *
 * @since 2.0
 */
function livre_get_the_post_format_url( $url = '', $post = null ) {

	if ( empty( $url ) ) {

		$post = is_null( $post ) ? get_post() : $post;

		/* Catch links that are not wrapped in an '<a>' tag. */
		$content_url = preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', make_clickable( $post->post_content ), $matches );

		$content_url = ! empty( $matches[1] ) ? esc_url_raw( $matches[1] ) : '';

		$url = ! empty( $content_url ) ? $content_url : esc_url( get_permalink( $post->ID ) );
	}

	return $url;

}

/**
 * Featured Image URL
 *
 * @return void
 * @author tokoo
 **/
function livre_get_featured_image_url( $size = 'full' ) {
	$url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $size, false );
	return esc_url( $url[0] );
}


/**
 * http://erricgunawan.com/blog/2012/06/30/menampilkan-tanggal-relatif-di-wordpress/
 */
function livre_time_since( $older_date, $newer_date = false ) {
	$chunks = array(
		'year'   => 60 * 60 * 24 * 365,
		'month'  => 60 * 60 * 24 * 30,
		'week'   => 60 * 60 * 24 * 7,
		'day'    => 60 * 60 * 24,
		'hour'   => 60 * 60,
		'minute' => 60,
		'second' => 1
	);

	$newer_date = ( $newer_date == false ) ? ( time() + ( 60 * 60 * get_option( "gmt_offset" ) ) ) : $newer_date;
	$since = $newer_date - $older_date;

	foreach ( $chunks as $key => $seconds )
		if ( ( $count = floor( $since / $seconds ) ) != 0 ) break;

	$messages = array(
		'year'   => _n( '%s year ago', '%s years ago', $count, 'livre' ),
		'month'  => _n( '%s month ago', '%s months ago', $count, 'livre' ),
		'week'   => _n( '%s week ago', '%s weeks ago', $count, 'livre' ),
		'day'    => _n( '%s day ago', '%s days ago', $count, 'livre' ),
		'hour'   => _n( '%s hour ago', '%s hours ago', $count, 'livre' ),
		'minute' => _n( '%s minute ago', '%s minutes ago', $count, 'livre' ),
		'second' => _n( '%s second ago', '%s seconds ago', $count, 'livre' )
		);
	return sprintf( $messages[$key], $count );
}

function livre_get_customize_option( $option_name = '', $default = '' ) {

	$options = get_option( 'tokoo_options' );

	if( ! empty( $option_name ) && ! empty( $options[$option_name] ) ) {
		return $options[$option_name];
	} else {
		return ( ! empty( $default ) ) ? $default : null;
	}

}

/**
 * Get youtube video ID from URL
 *
 * @return void
 * @author tokoo
 **/
function livre_get_youtube_video_id( $url = '' ) {
	parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
	return $my_array_of_vars['v'];
}

/**
 * Get attachment meta
 *
 * @return void
 * @author tokoo
 **/
function livre_get_attachment( $attachment_id ) {

	$attachment 		= get_post( $attachment_id );
	return array(
		'alt' 			=> get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'caption' 		=> $attachment->post_excerpt,
		'description' 	=> $attachment->post_content,
		'href' 			=> get_permalink( $attachment->ID ),
		'src' 			=> $attachment->guid,
		'title' 		=> $attachment->post_title
	);
}

