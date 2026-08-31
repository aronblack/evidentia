<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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
		<div class="post-grid grid-layout columns-2">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'template-parts/content', get_post_format() ); ?>

				<?php endwhile; ?>


			<?php else : ?>

				<?php get_template_part( 'template-parts/content', 'none' ); ?>

			<?php endif; ?>
			
		</div>
		
		<?php if ( get_previous_posts_link() || get_next_posts_link() ) : ?>
			<?php get_template_part( 'loop', 'nav' ); ?>
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
