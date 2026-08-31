<?php

global $post, $product, $woocommerce_loop;

$simularity_scores 	= wcbs_recommender_get_simularity( get_the_ID(), $activity_types );
$related 			= array();

if ( $simularity_scores ) {
	$related = array_keys( $simularity_scores );
}

if ( sizeof( $related ) == 0 )
	return; 

$args = apply_filters( 'woocommerce_related_products_by_completed_args', array(
    'post_type' 			=> 'product',
    'ignore_sticky_posts' 	=> 1,
    'no_found_rows' 		=> 1,
    'posts_per_page' 		=> -1,
    'orderby' 				=> $orderby,
    'post__in' 				=> $related
	) );

$woocommerce_loop['columns'] 	= $columns;
$products 						= get_posts( $args );

if ( $products && is_array( $products ) && count( $products ) ) :

	if ( $posts_per_page ) {
		$parts 		= array_chunk( $products, $posts_per_page );
		$products 	= $parts[0];
	}
	?>
	<div class="related products">
		<header class="section-header">
			<h2 class="section-title"><?php echo apply_filters( 'woocommerce_related_products_title_by_completed', $section_title ); ?></h2>
		</header>
		<div class="product-grid grid-layout columns-<?php echo esc_attr( $columns ); ?>">
			<?php
				foreach ( $products as $post ) : setup_postdata( $post );
					wc_get_template_part( 'content', 'product' );
				endforeach; // end of the loop.   
			?>
			<?php wp_reset_postdata(); ?>
		</div>
	</div>

<?php endif;
