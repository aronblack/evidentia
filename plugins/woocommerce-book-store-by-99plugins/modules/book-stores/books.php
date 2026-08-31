<?php 

use Carbon_Fields\Container;
use Carbon_Fields\Field;

// REGISTER THEME OPTIONS
Container::make( 'theme_options', esc_html__( 'WooCommerce Book Store', 'wcbs' ) )
	->set_page_parent( 'nn-plugins-dashboard.php' ) // identificator of the "Appearance" admin section
	->add_tab( esc_html__( 'General Settings', 'wcbs' ), array(
		Field::make( 'checkbox', 'wcbs_enable_book_details', esc_html__( 'Enable Book Details', 'wcbs' ) )
	->set_option_value( 'yes' )
	));

// REGISTER AUTHOR INFO
Container::make( 'term_meta', esc_html__( 'Author Info', 'wcbs' ) )
	->show_on_taxonomy( apply_filters( 'wcbs_author_taxonomy_name', 'book_author' ) )
	->add_fields( array(
		Field::make( 'image', 'wcbs_author_picture', esc_html__( 'Author Picture', 'wcbs' ) ),
		Field::make( 'date', 'wcbs_author_birthday', esc_html__( 'Author Birthday', 'wcbs' ) )
		->set_options( array(
			'dateFormat'	=> 'dd MM yy',
			'yearRange'		=> '1945:2020',
	        'currentText' 	=> esc_html__( 'Current Date', 'wcbs' ),
	    )),
		Field::make( 'text', 'wcbs_author_facebook', esc_html__( 'Facebook URL', 'wcbs' ) ),
		Field::make( 'text', 'wcbs_author_twitter', esc_html__( 'Twitter URL', 'wcbs' ) ),
		Field::make( 'text', 'wcbs_author_instagram', esc_html__( 'Instagram URL', 'wcbs' ) ),
		Field::make( 'text', 'wcbs_author_google_plus', esc_html__( 'Google Plus URL', 'wcbs' ) ),
));

// REGISTER PUBLISHER INFO
Container::make( 'term_meta', esc_html__( 'Publisher Info', 'wcbs' ) )
	->show_on_taxonomy( 'book_publisher' )
	->add_fields( array(
		Field::make( 'image', 'wcbs_publisher_picture' ),
		Field::make( 'text', 'wcbs_publisher_address', esc_html__( 'Address URL', 'wcbs' ) ),
		Field::make( 'text', 'wcbs_publisher_facebook', esc_html__( 'Facebook URL', 'wcbs' ) ),
		Field::make( 'text', 'wcbs_publisher_twitter', esc_html__( 'Twitter URL', 'wcbs' ) ),
		Field::make( 'text', 'wcbs_publisher_instagram', esc_html__( 'Instagram URL', 'wcbs' ) ),
		Field::make( 'text', 'wcbs_publisher_google_plus', esc_html__( 'Google Plus URL', 'wcbs' ) ),
));

// REGISTER SERIES INFO
Container::make( 'term_meta', esc_html__( 'Series Info', 'wcbs' ) )
	->show_on_taxonomy( 'book_series' )
	->add_fields( array(
		Field::make( 'image', 'wcbs_book_series_picture' ),
));

// REGISTER BOOK COVER METABOX
$book_details = carbon_get_theme_option( 'wcbs_enable_book_details' );

if ( true == $book_details ) {
	Container::make( 'post_meta', esc_html__( 'Back Cover Image', 'wcbs' ) )
		->show_on_post_type( 'product' )
		->set_context( 'side' )
		->set_priority( 'low' )
		->add_fields( array(
			Field::make( 'image', 'wcbs_book_back_cover_image', esc_html__( 'Back Cover', 'wcbs' ) )
	));

	Container::make( 'post_meta', esc_html__( 'Editorial Review', 'wcbs' ) )
		->show_on_post_type( 'product' )
		->set_priority( 'low' )
		->add_fields( array(
			Field::make( 'rich_text', 'wcbs_book_editorial_review', '' )
	));
}

/**
 * Register authors and publishers taxonomy
 *
 * @return void
 * @author alispx
 **/
add_action( 'init', 'wcbs_authors_register_taxonomy' );
function wcbs_authors_register_taxonomy() {
	// BOOK AUTHOR
	register_extended_taxonomy( apply_filters( 'wcbs_book_author_taxonomy_name', 'book_author' ), 'product', array(),
		array(
			'singular' 	=> apply_filters( 'wcbs_book_author_taxonomy_singular_name', esc_html__( 'Author', 'wcbs' ) ),
			'plural' 	=> apply_filters( 'wcbs_book_author_taxonomy_plural_name', esc_html__( 'Authors', 'wcbs' ) ),
			'slug'		=> apply_filters( 'wcbs_book_author_taxonomy_slug', 'book-author' ),
		)
	);
	// BOOK PUBLISHER
	register_extended_taxonomy( apply_filters( 'wcbs_book_publisher_taxonomy_name', 'book_publisher' ), 'product', array(),
		array(
			'singular' 	=> apply_filters( 'wcbs_book_publisher_taxonomy_singular_name', esc_html__( 'Publisher', 'wcbs' ) ),
			'plural' 	=> apply_filters( 'wcbs_book_publisher_taxonomy_plural_name', esc_html__( 'Publishers', 'wcbs' ) ),
			'slug'		=> apply_filters( 'wcbs_book_publisher_taxonomy_slug', 'book-publisher' ),
		)
	);

	// BOOK SERIES
	register_extended_taxonomy( apply_filters( 'wcbs_book_series_taxonomy_name', 'book_series' ), 'product', array(),
		array(
			'singular' 	=> apply_filters( 'wcbs_book_series_taxonomy_singular_name', esc_html__( 'Series', 'wcbs' ) ),
			'plural' 	=> apply_filters( 'wcbs_book_series_taxonomy_plural_name', esc_html__( 'Series', 'wcbs' ) ),
			'slug'		=> apply_filters( 'wcbs_book_series_taxonomy_slug', 'book-series' ),
		)
	);
}


/**
 * Override single product image
 *
 * @return void
 * @author 99Plugins
 **/
function wcbs_books_display_single_product_image() {
	global $product;
	
	wc_get_template( 'books/wcbs-single-book-image.php', 
		array( 
			'product' => $product, 
		), 
		'', 
		NN_WCBS_DIR . 'templates/' 
	);
}

/**
 * Display Book Author in single product
 *
 * @return void
 * @author 99Plugins
 **/
function wcbs_books_display_single_book_author() {

	$taxes 			= wp_get_object_terms( get_the_ID(), 'book_author' ); 
	$i 				= 0;
	$cats_length 	= count( $taxes ); 
	if ( ! empty( $taxes ) ) {
		echo '<div class="author">';
			foreach ( $taxes as $cat ) { 
				$separator = ( $i !== $cats_length - 1 ) ? ', ' : ''; ?>
				<a href="<?php echo get_term_link( $cat->slug, 'book_author' ); ?>"><?php echo esc_attr( $cat->name ) . $separator; ?></a>
			<?php $i++;
		}
		echo '</div>'; 
	}
}

/**
 * Display Book Author in shop page
 *
 * @return void
 * @author 99Plugins
 **/
function wcbs_books_display_book_author() {
	$taxes 			= wp_get_object_terms( get_the_ID(), 'book_author' ); 
	$i 				= 0;
	$cats_length 	= count( $taxes ); 
	if ( ! empty( $taxes ) ) {
		echo '<div class="product__meta"><div class="author">';
			foreach ( $taxes as $cat ) { 
				$separator = ( $i !== $cats_length - 1 ) ? ', ' : ''; ?>
				<a href="<?php echo get_term_link( $cat->slug, 'book_author' ); ?>"><?php echo esc_attr( $cat->name ) . $separator; ?></a>
			<?php $i++;
		}
		echo '</div></div>'; 
	}
}

/**
 * Display Book Publisher in single product
 *
 * @return void
 * @author 99Plugins
 **/
function wcbs_books_display_single_book_publisher() {
	$taxes 			= wp_get_object_terms( get_the_ID(), 'book_publisher' ); 
	$i 				= 0;
	$cats_length 	= count( $taxes ); 
	if ( ! empty( $taxes ) ) {
		echo '<div class="author">';
			foreach ( $taxes as $cat ) { 
				$separator = ( $i !== $cats_length - 1 ) ? ', ' : ''; ?>
				<a href="<?php echo get_term_link( $cat->slug, 'book_publisher' ); ?>"><?php echo esc_attr( $cat->name ) . $separator; ?></a>
			<?php $i++;
		}
		echo '</div>'; 
	}
}

/**
 * Display Book Series in single product
 *
 * @return void
 * @author 99Plugins
 **/
function wcbs_books_display_single_book_series() {
	$taxes 			= wp_get_object_terms( get_the_ID(), 'book_series' ); 
	$i 				= 0;
	$cats_length 	= count( $taxes ); 
	if ( ! empty( $taxes ) ) {
		echo '<div class="author">';
			foreach ( $taxes as $cat ) { 
				$separator = ( $i !== $cats_length - 1 ) ? ', ' : ''; ?>
				<a href="<?php echo get_term_link( $cat->slug, 'book_series' ); ?>"><?php echo esc_attr( $cat->name ) . $separator; ?></a>
			<?php $i++;
		}
		echo '</div>'; 
	}
}

/**
 * Create new Product tab
 *
 * @return void
 * @author 99Plugins
 **/
add_filter( 'woocommerce_product_tabs', 'wcbs_books_create_new_product_tab' );
function wcbs_books_create_new_product_tab( $tabs ) {
	$get_product_type 	= get_post_meta( get_the_ID(), 'wcbs_product_type', true );
	$product_type 		= ! empty( $get_product_type ) ? $get_product_type : 'regular';
	$authors 			= wp_get_object_terms( get_the_ID(), 'book_author' );

	if ( ! empty( $authors ) && 'book' == $product_type ) {
		$tabs['wcbs_book_author_info'] = array(
			'title' 	=> esc_html__( 'Meet The Author', 'wcbs' ),
			'priority' 	=> 25,  
			'callback' 	=> 'wcbs_book_display_author_info'
		);
		return $tabs;  
	}
}


/**
 * Display Author Info
 *
 * @return void
 * @author 
 **/
function wcbs_book_display_author_info() {
	wc_get_template( 'books/wcbs-author-info.php', 
		array( 
			'author_info' 	=> wp_get_object_terms( get_the_ID(), 'book_author' ), 
		), 
		'', 
		NN_WCBS_DIR . 'templates/' 
	);
}

/**
 * Display Author Info
 *
 * @return void
 * @author 
 **/
function wcbs_book_editorial_review_content() {
	wc_get_template( 'books/wcbs-editorial-review.php', 
		array( 
			'content' 	=> carbon_get_the_post_meta( 'wcbs_book_editorial_review' ), 
		), 
		'', 
		NN_WCBS_DIR . 'templates/' 
	);
}