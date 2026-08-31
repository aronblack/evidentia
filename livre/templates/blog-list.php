<?php

/**
 * Template Name: Blog List
 *
 * The Template for page template blog List
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
		 * @hooked themename_wrapper_start - 10 (outputs opening divs for the content)
		 */
		do_action( 'livre_before_main_content' );
	 ?>

	<div class="content-area <?php livre_columns_class_handles(); ?>">
		<div class="post-list">
					
				<?php
					if ( 0 != get_query_var( 'paged' ) ) {
						$paged = absint( get_query_var( 'paged' ) );
					} elseif ( 0 != get_query_var( 'page' ) ) {
						$paged = absint( get_query_var( 'page' ) );
					} else {
						$paged = 1;
					}

					$page_metas 		= livre_get_meta( '_page_details' );
					$blog_args   		= array(
						'post_type'         => 'post',
						'posts_per_page'    => ( ! empty( $page_metas['per_page'] ) ) ? $page_metas['per_page'] : 12,
						'post_status'       => 'publish',
						'order'             => 'DESC',
						'orderby'           => 'date',
						'paged'             => $paged
					);

					$temp 		= $wp_query;
					$wp_query 	= null;
					$wp_query 	= new WP_Query();
					$wp_query->query( $blog_args );

				if ( $wp_query->have_posts() ) : ?>
					
					<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

						<?php get_template_part( 'template-parts/content', 'blog-list' ); ?>

					<?php endwhile; ?>
					
						<?php ob_start(); ?>
							<?php if ( get_previous_posts_link() || get_next_posts_link() ) : ?>
								<div class="posts-navigation ajax-navigation">
									<?php get_template_part( 'loop', 'nav' ); ?>
								</div>
							<?php endif; ?>
						<?php $paginations[] = ob_get_contents(); ?>
						<?php ob_end_clean(); ?>

					<?php else : ?>
							
						<?php get_template_part( 'template-parts/content', 'none' ); ?>

				<?php
					endif;
					$wp_query = null;
					$wp_query = $temp;  // Reset
				?>
				<?php wp_reset_postdata(); ?>

		</div>

		<?php if ( ! empty( $paginations ) ) : ?>
			<?php foreach ( $paginations as $paging ) : ?>
				<?php echo ''.$paging; ?>
			<?php endforeach; ?>
		<?php endif; ?>
		
	</div>
	
	<?php if ( livre_is_has_sidebar() ) : ?>
		<?php get_sidebar(); ?>
	<?php endif; ?>
	
	<?php
		/**
		 * livre_after_main_content hook
		 *
		 * @hooked themename_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'livre_after_main_content' );
	 ?>


<?php get_footer(); ?>
