<?php
/**
 * The template for displaying all single posts.
 *
 * @package Livre
 */

get_header(); ?>


	<?php
		/**
		 * livre_before_main_content hook
		 *
		 * @hooked themename_wrapper_start - 10 (outputs opening divs for the content)
		 */
		do_action( 'livre_before_main_content' );
	 ?>
	
	<div class="content-area col-md-8">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
				
				<?php livre_prev_next_post(); ?>
				
				<?php if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif; ?>

			<?php endwhile; ?>

		<?php endif; ?>

	</div>

	<?php get_sidebar(); ?>

	<?php
		/**
		 * livre_after_main_content hook
		 *
		 * @hooked themename_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'livre_after_main_content' );
	 ?>

<?php get_footer(); ?>
