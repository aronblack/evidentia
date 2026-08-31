<?php
/**
 * The template for displaying product widget entries
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product; ?>

<li>
	<?php if ( $show_image ) : ?>
		<a class="product-image" href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'shop_catalog' ); ?>
		</a>
	<?php endif; ?>
	<div class="product-detail">
		<span class="product-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
		<?php 
			$taxes 			= wp_get_object_terms( get_the_ID(), 'book_author' ); 
			$i 				= 0;
			$cats_length 	= count( $taxes ); 
			if ( ! empty( $taxes ) ) {
				echo '<span class="span-author">'.esc_html__( 'By', 'livre' );
					foreach ( $taxes as $cat ) { 
						$separator = ( $i !== $cats_length - 1 ) ? ', ' : ''; ?>
						<a href="<?php echo esc_url( get_term_link( $cat->slug, 'book_author' ) ); ?>"><?php echo esc_attr( $cat->name ) . $separator; ?></a>
					<?php $i++;
					}
				echo '</span>';
			}
		 ?>
	</div>
</li>
