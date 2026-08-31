<?php

global $post, $product, $woocommerce_loop;

$simularity_scores 	= wcbs_recommender_get_simularity( get_the_ID(), 'completed' );
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
    'post__in' 				=> $related
) );

$products 		= get_posts( $args );
$posts_per_page	= 5;

if ( $products && is_array( $products ) && count( $products ) ) :

	if ( $posts_per_page ) {
		$parts 		= array_chunk( $products, $posts_per_page );
		$products 	= $parts[0];
	}

	$get_section_title	= carbon_get_theme_option( 'wcbs_related_by_completed_section_title' );
	$section_title 		= ! empty( $get_section_title ) ? $get_section_title : esc_html__( 'Customers also purchased these products', 'livre' );

	?>
		<h2 class="section__title"><?php echo ''.$section_title; ?></h2>
		<ul class="product_list_widget">
			<?php
				foreach ( $products as $post ) : setup_postdata( $post );
					?>
					<li>
						<a href="<?php the_permalink(); ?>" class="product-image">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'shop_single' ); ?>
							<?php endif; ?>
						</a>
						<div class="product-detail">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<span class="product-title"><?php the_title(); ?></span>
							</a>
							<?php woocommerce_template_loop_rating(); ?>
							<?php woocommerce_template_loop_price(); ?>
						</div>
					</li>
					<?php 
				endforeach; // end of the loop. 
				wp_reset_postdata(); 
			?>
		</ul>

<?php endif;
