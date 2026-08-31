<?php

/**
 * Template Name: Publishers
 *
 * The Template for page template publishers
 *
 * @author 		tokoo
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header(); ?>

<?php
	/**
	 * livre_before_main_content hook
	 *
	 * @hooked tokoo_wrapper_start - 10 (outputs opening divs for the content)
	 */
	do_action( 'livre_before_main_content' );
?>

	<?php 
		$args = array(
			'taxonomy' 		=> 'book_publisher',
			'orderby'		=> 'name',
			'order' 		=> 'ASC',
			'hide_empty' 	=> false,
		);
		$publishers = new WP_Term_Query( $args );
	 ?>
	
	<div class="browse-author-by-alphabet filterable-nav">
		<a class="current" href="#" data-filter="*"><?php esc_html_e( 'All', 'livre' ); ?></a> <span class="filter-separator"></span>
		<?php foreach ( range( 'A', 'Z' ) as $char ) { ?>
			<a href="#" data-filter=".sort-<?php echo esc_attr( $char ); ?>"><?php echo esc_attr( $char ); ?></a>
		<?php } ?>
	</div> <!-- .browse-by-alphabet -->

	<div class="featured-author-grid author-index grid-layout columns-6">
	
	<?php 
		if ( ! empty( $publishers ) ) :

			foreach ( $publishers->get_terms() as $publisher ) : ?>
				
				<div class="featured-author grid-item sort-<?php livre_print_filter_class_alphabet( $publisher->name ); ?>">

					<?php 
						$get_publisher_img_id 	= carbon_get_term_meta( $publisher->term_id, 'wcbs_publisher_picture' );
					if ( ! empty( $get_publisher_img_id ) ) :
						$publisher_picture 	= wp_get_attachment_image_src( $get_publisher_img_id, 'thumbnail' ); ?>
						<figure class="featured-author__image">
							<a href="<?php echo esc_url( get_term_link( $publisher->slug, 'book_publisher' ) ); ?>">
								<img src="<?php echo esc_url( $publisher_picture[0] ); ?>" alt="<?php echo esc_html__( 'Publisher Picture', 'livre' ); ?>">
							</a>
						</figure>
					<?php endif; ?>

					<h2 class="featured-author__name">
						<a href="<?php echo esc_url( get_term_link( $publisher->slug, 'book_publisher' ) ); ?>"><?php echo esc_attr( $publisher->name ); ?></a>
					</h2>
					<span class="featured-author__books">
						<?php echo sprintf( _n( '%s Published Book', '%s Published Books', $publisher->count, 'livre' ), number_format_i18n( $publisher->count ) ); ?>
					</span>

				</div>

			<?php endforeach; ?>
		<?php endif; ?>

	</div>

<?php
	/**
	 * livre_after_main_content hook
	 *
	 * @hooked tokoo_wrapper_end - 10 (outputs closing divs for the content)
	 */
	do_action( 'livre_after_main_content' );
?>

<?php get_footer(); ?>