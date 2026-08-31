<?php

/**
 * Template Name: Authors
 *
 * The Template for page template authors
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
	$author_page_id 		= get_queried_object_id();
	$author_page_details 	= get_post_meta( $author_page_id, 'livre_page_details', true );
		
		$args = array(
			'taxonomy' 		=> 'book_author',
			'orderby'		=> 'name',
			'order' 		=> 'ASC',
			'hide_empty' 	=> false,
		);
		$authors = new WP_Term_Query( $args );
	 ?>
	
	<div class="browse-author-by-alphabet filterable-nav">
		<a class="current" href="#" data-filter="*"><?php esc_html_e( 'All', 'livre' ); ?></a> <span class="filter-separator"></span>
		<?php foreach ( range( 'A', 'Z' ) as $char ) { ?>
			<a href="#" data-filter=".sort-<?php echo esc_attr( $char ); ?>"><?php echo esc_attr( $char ); ?></a>
		<?php } ?>
	</div> <!-- .browse-by-alphabet -->

	<div class="featured-author-grid author-index grid-layout columns-6">
	
	<?php 

		if ( ! empty( $authors ) ) :

			foreach ( $authors->get_terms() as $author ) : ?>
				
				<?php 
					$author_data 		= livre_get_meta( '_author_page' ); 
					$author_name = $author->name;

					if ( ! empty( $author_data )) {
						if ( $author_data['author_filter'] == 'last' ) {
							$data =  explode( ' ' , $author_name );
							$author_name = end( $data );
						}
					}
					
				?>
				<div class="featured-author grid-item sort-<?php livre_print_filter_class_alphabet( $author_name ); ?>">


					<?php 
						$get_author_img_id 	= carbon_get_term_meta( $author->term_id, 'wcbs_author_picture' );
					if ( ! empty( $get_author_img_id ) ) :
						$author_picture 	= wp_get_attachment_image_src( $get_author_img_id, 'thumbnail' ); ?>
						<figure class="featured-author__image <?php echo '' . $author_page_details['author_style']; ?>">
							<a href="<?php echo esc_url( get_term_link( $author->slug, 'book_author' ) ); ?>">
								<img src="<?php echo esc_url( $author_picture[0] ); ?>" alt="<?php echo esc_html__( 'Author Picture', 'livre' ); ?>">
							</a>
						</figure>
					<?php endif; ?>

					<h2 class="featured-author__name">
						<a href="<?php echo esc_url( get_term_link( $author->slug, 'book_author' ) ); ?>"><?php echo esc_attr( $author->name ); ?></a>
					</h2>
					<span class="featured-author__books">
						<?php echo sprintf( _n( '%s Published Book', '%s Published Books', $author->count, 'livre' ), number_format_i18n( $author->count ) ); ?>
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