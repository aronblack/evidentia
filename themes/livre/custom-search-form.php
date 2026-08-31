<?php
/**
 * The template for displaying custom search form.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Livre
 */
?>

<form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" >
	<div class="product-search-input">
		<input id="product-search-keyword" type="text" name="s" placeholder="<?php esc_attr_e( 'Search', 'livre' ); ?>">
		<button type="submit" class="search-icon no-ui">
			<i class="fa fa-search"></i>
		</button>
		<div class="line"></div>
	</div>
 </form>
