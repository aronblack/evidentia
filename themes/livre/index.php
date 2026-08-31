<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
	
	<?php 
		$blog_style 	= get_theme_mod( 'livre_blog_style', 'masonry' ); 
		$blog_columns 	= get_theme_mod( 'livre_blog_columns', '3' ); 
	?>

	<div class="content-area <?php livre_columns_class_handles(); ?>">
		<?php if ( 'list' == $blog_style ) : ?>
			<div class="post-list">
		<?php else : ?>
			<div class="post-<?php echo esc_attr( $blog_style ); ?> grid-layout columns-<?php echo esc_attr( $blog_columns ); ?>">
		<?php endif; ?>

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php 
						switch ( $blog_style ) {
							case 'masonry':
								get_template_part( 'template-parts/content-blog-masonry' );
								break;
							case 'list':
								get_template_part( 'template-parts/content-blog-list' );
								break;
							default:
								get_template_part( 'template-parts/content', get_post_format() );
								break;
						}
					?>

				<?php endwhile; ?>


			<?php else : ?>

				<?php get_template_part( 'template-parts/content', 'none' ); ?>

			<?php endif; ?>
			
		</div>
		
		<?php if ( get_previous_posts_link() || get_next_posts_link() ) : ?>
			<nav class="posts-navigation">
				<?php get_template_part( 'loop', 'nav' ); ?>
			</nav>
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
