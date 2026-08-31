<?php

/**
 * Template Name: Archive
 *
 * The Template for page template archive
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

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post-content">
		<div class="content">
			<div class="entry-content">

				<div class="archive-wrap">

					<div class="row padding-30">
						<div class="col-md-6">

							<div class="latest-archive">
								<h3><?php esc_html_e( 'Last 20 Posts', 'livre' ); ?></h3>

								<ul class="archive-list">
									<?php wp_get_archives( array( 'type' => 'postbypost', 'limit' => 20 ) ); ?>
								</ul>
							</div><!-- .col-md-9-archive -->

							<div class="month-archive">
								<h3><?php esc_html_e( 'Monthly Archives', 'livre' ); ?></h3>
								<ul class="archive-list">
									<?php
									$variable = wp_get_archives( array( 'type' => 'monthly', 'show_post_count' => 'true', 'echo' => 0 ) );
									$variable = str_replace( '&nbsp;(', '<span class="cat-count">', $variable );
									$variable = str_replace( ')', '</span>', $variable );
									printf( $variable );
									?>
								</ul>
							</div><!-- .month-archive -->

							<div class="page-archive">
								<h3><?php esc_html_e( 'Page Archives', 'livre' ); ?></h3>
								<ul class="archive-list">
									<?php wp_list_pages('title_li=&depth=2'); ?>
								</ul>
							</div><!-- .page-archive -->

						</div>

						<div class="col-md-6">

							<div class="cat-archive">
								<h3><?php esc_html_e( 'Categories', 'livre' ); ?></h3>
								<ul class="archive-list">
									<?php wp_list_categories( 'depth=0&title_li=&show_count=1' ); ?>
								</ul>
							</div><!-- .cat-archive -->

						</div>
					</div>



				</div><!-- .archive-wrap -->

			</div><!-- .entry-content -->
		</div><!-- .content -->
	</div><!-- .post-content -->

</article>

<?php
	/**
	 * livre_after_main_content hook
	 *
	 * @hooked tokoo_wrapper_end - 10 (outputs closing divs for the content)
	 */
	do_action( 'livre_after_main_content' );
?>

<?php get_footer(); ?>