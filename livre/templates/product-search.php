<?php

/**
 * Template Name: Product Search
 *
 * The Template for page template Product Search
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

	<form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" >
		<div class="row">
			<div class="col-md-6">
				<!-- BY INPUT -->
				<div class="product-search-input">
					<div class="form-group row">
						<label class="col-sm-4" for="product-search-keyword"><?php esc_html_e( 'Keyword :', 'livre' ); ?></label>
						<div class="col-sm-8">
							<input id="product-search-keyword" type="text" name="s">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4" for="product-search-isbn"><?php esc_html_e( 'ISBN :', 'livre' ); ?></label>
						<div class="col-md-8">
							<input id="product-search-isbn" type="text" name="ISBN">
						</div>
					</div>
					
					<!-- BY PRODUCT CATEGORY -->
				 	<div class="product-search-category row form-group">
				 		<label class="col-md-4">
							<?php esc_html_e( 'Category', 'livre' ); ?>
						</label>
						<div class="col-md-8">
					 		<?php
								$category = get_term_by( 'slug', get_query_var( 'product_cat' ), 'product_cat' ); 
								$cat_args = array(
									'taxonomy'        	=> 'product_cat',
									'show_option_all' 	=> esc_html__( 'All Categories', 'livre' ),
									'hide_empty'      	=> 1,
									'orderby'			=> 'ID',
									'order'				=> 'ASC',
									'name'				=> 'product_cat',
									'value_field' 		=> 'slug',
								);
								$category = get_term_by( 'slug', get_query_var( 'product_cat' ), 'product_cat' ); 
								if ( $category ) {
									$cat_args['selected'] = $category->term_id;							
								}
								wp_dropdown_categories( $cat_args );
							 ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">

				<!-- BY BOOK AUTHOR -->
				<div class="product-search-category row form-group">
					<label class="col-md-4">
						<?php esc_html_e( 'Author', 'livre' ); ?>
					</label>
					<div class="col-md-8">
				 		<?php
							$authors = get_term_by( 'slug', get_query_var( 'book_author' ), 'book_author' ); 
							$authors_args = array(
								'taxonomy'        	=> 'book_author',
								'show_option_all' 	=> esc_html__( 'All Authors', 'livre' ),
								'hide_empty'      	=> 1,
								'orderby'			=> 'ID',
								'order'				=> 'ASC',
								'name'				=> 'book_author',
								'value_field' 		=> 'slug',
							);
							$authors = get_term_by( 'slug', get_query_var( 'book_author' ), 'book_author' ); 
							if ( $authors ) {
								$authors_args['selected'] = $authors->term_id;							
							}
							wp_dropdown_categories( $authors_args );
						 ?>
					</div>
				</div>

				<!-- BY BOOK PUBLISHER -->
				<div class="product-search-category row form-group">
					<label class="col-md-4">
						<?php esc_html_e( 'Publisher', 'livre' ); ?>
					</label>
					<div class="col-md-8">
				 		<?php
							$publishers = get_term_by( 'slug', get_query_var( 'book_publisher' ), 'book_publisher' ); 
							$publishers_args = array(
								'taxonomy'        	=> 'book_publisher',
								'show_option_all' 	=> esc_html__( 'All Publishers', 'livre' ),
								'hide_empty'      	=> 1,
								'orderby'			=> 'ID',
								'order'				=> 'ASC',
								'name'				=> 'book_publisher',
								'value_field' 		=> 'slug',
							);
							$publishers = get_term_by( 'slug', get_query_var( 'book_publisher' ), 'book_publisher' ); 
							if ( $publishers ) {
								$publishers_args['selected'] = $publishers->term_id;							
							}
							wp_dropdown_categories( $publishers_args );
						 ?>
					</div>
				</div>

				<!-- BY BOOK SERIES -->
				<div class="product-search-category row form-group">
					<label class="col-md-4">
						<?php esc_html_e( 'Series', 'livre' ); ?>
					</label>
					<div class="col-md-8">
				 		<?php
							$publishers = get_term_by( 'slug', get_query_var( 'book_series' ), 'book_series' ); 
							$publishers_args = array(
								'taxonomy'        	=> 'book_series',
								'show_option_all' 	=> esc_html__( 'All Series', 'livre' ),
								'hide_empty'      	=> 1,
								'orderby'			=> 'ID',
								'order'				=> 'ASC',
								'name'				=> 'book_series',
								'value_field' 		=> 'slug',
							);
							$publishers = get_term_by( 'slug', get_query_var( 'book_series' ), 'book_series' ); 
							if ( $publishers ) {
								$publishers_args['selected'] = $publishers->term_id;							
							}
							wp_dropdown_categories( $publishers_args );
						 ?>
						
					</div>
				</div>
			</div>
		</div> 
	 	
		<div class="search-icon">
			<input type="submit" value="<?php esc_html_e( 'Search', 'livre' ); ?>">
		</div>
		<input type="hidden" name="post_type" value="product">
	 </form>

<?php
	/**
	 * livre_after_main_content hook
	 *
	 * @hooked tokoo_wrapper_end - 10 (outputs closing divs for the content)
	 */
	do_action( 'livre_after_main_content' );
?>

<?php get_footer(); ?>