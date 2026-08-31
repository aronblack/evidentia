<?php
/**
 * The template for displaying custom search form.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Livre
 */

if ( class_exists( 'WooCommerce' ) ) {
	$taxonomy  	= 'product_cat';
} else {
	$taxonomy  	= 'category';
}
?>

<form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" >
 	<div class="product-search-category">
 		<?php
			$category = get_term_by( 'slug', get_query_var( $taxonomy ), $taxonomy ); 
			$cat_args = array(
				'taxonomy'        	=> $taxonomy,
				'show_option_all' 	=> esc_html__( 'All Categories', 'livre' ),
				'hide_empty'      	=> 1,
				'orderby'			=> 'ID',
				'order'				=> 'ASC',
				'name'				=> $taxonomy,
				'value_field' 		=> 'slug',
				'id'				=> 'product-category-mobile'
			);
			$category = get_term_by( 'slug', get_query_var( $taxonomy ), $taxonomy ); 
			if ( $category ) {
				$cat_args['selected'] = $category->term_id;							
			}
			wp_dropdown_categories( $cat_args );
		 ?>
		<div class="fa fa-angle-down"></div>
	</div>
	<div class="product-search-input">
		<input id="product-search-keyword-mobile" type="text" name="s" placeholder="<?php esc_attr_e( 'Type to search keywords and hit enter', 'livre' ); ?>">

		<div class="search-icon">
			<div class="fa fa-search"></div>
		</div>
		<div class="line"></div>
	</div>
	<?php if ( class_exists( 'WooCommerce' ) ) : ?>
		<input type="hidden" name="post_type" value="product">
	<?php endif; ?>
 </form>
