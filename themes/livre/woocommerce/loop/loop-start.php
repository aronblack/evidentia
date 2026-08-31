<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */
$get_shop_loop_columns 	= get_theme_mod( 'livre_product_shop_loop_columns', 4 );
$product_layout 		= livre_get_product_layout();

switch ( $product_layout ) {
	case 'modern':
		echo '<div class="product-modern grid-layout columns-'.$get_shop_loop_columns.'">';
		break;
	case 'list':
		echo '<div class="product-list">';
		break;
	
	default:
		echo '<div class="product-grid grid-layout columns-'.$get_shop_loop_columns.'">';
		break;
}

