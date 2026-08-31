<?php 

if ( ! class_exists( 'Carbon_Fields\Container' ) ) {
	return;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

if ( ! class_exists('Metabox_Page_Title')) {

	class Metabox_Page_Title {

		public function __construct() {
			add_action ( 'init', array( $this, 'render_metabox' ) );
		}

		public function render_metabox() {
			Container::make( 'term_meta', esc_html__( 'Page Title Background', 'livre' ) )
				->show_on_taxonomy( array( 'category', 'post_tag', 'product_tag', 'product_cat', 'book_author', 'book_publisher', 'book_series' ) )
				->add_fields( array(
					Field::make( 'image', 'livre_tax_page_title_background', esc_html__( 'Page Title Background Image (Preferred size : 1600x600 )', 'livre' ) ),
			));

			Container::make( 'term_meta', esc_html__( 'Subtitle', 'livre' ) )
				->show_on_taxonomy( array( 'book_author', 'product_cat' ) )
				->add_fields( array(
					Field::make( 'text', 'livre_tax_subtitle', esc_html__( 'Subtitle', 'livre' ) ),
			));

			Container::make( 'term_meta', esc_html__( 'Collection Details', 'livre' ) )
				->show_on_taxonomy( array( 'collections' ) )
				->add_fields( array(
					Field::make( 'text', 'livre_collection_type', esc_html__( 'Collection Type', 'livre' ) ),
					Field::make( 'image', 'livre_collection_cover', esc_html__( 'Cover Image', 'livre' ) ),
			));
		}

	}

	new Metabox_Page_Title();
}