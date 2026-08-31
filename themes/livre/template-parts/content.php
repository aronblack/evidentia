<?php

/**
 * The Template for displaying content of post format standard
 *
 * @author 		tokoo
 * @version     2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
 
<?php if ( is_singular( 'post' ) ) { ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
		
		<header class="post__header">
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="post__image">
					<?php 
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'livre_blog_thumbnails_gallery' );
					?>
					<img src="<?php echo esc_url( $image_url[0] ); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
				</div>
			<?php endif; ?>
			<div class="post__date"><?php livre_published_date(); ?></div>
			<h1 class="post__title"><?php single_post_title(); ?></h1>
			<div class="post__meta">
				<?php livre_post_by_author(); ?>
				<?php echo livre_post_category( array(
						'before' => '<span class="categories">'.esc_html__( 'Under ', 'livre' ),
						'after'  => '</span>'
					) ); ?>
		</header>
		
		<div class="post__content entry-content">
			<?php the_content(); ?>
			<?php livre_pagination_page_break(); ?>
		</div>
		
		<footer class="post__footer">
			<?php echo livre_post_tags( array(
				'before' 	=> '<div class="post__tags"><strong>'. esc_html__( 'Tags ', 'livre' ).'</strong>',
				'after'  	=> '</div>',
				'separator' => ', '
			) ); ?>
			<?php livre_custom_social_share(); ?>
		</footer>

	</article>

<?php } else { ?>

	<?php
		$sticky 	= is_sticky() ? 'sticky' : '';
		$datasticky = '';

		if ( is_sticky() ) {
			$sticky_text = livre_get_option( 'stick_text' );

			if ( ! empty( $sticky_text ) ) {
				$datasticky = 'data-sticky="' . $sticky_text . '"';
			} else {
				$datasticky = 'data-sticky="' . esc_html__( 'Featured', 'livre' ) . '"';
			}
		}
	?>
	
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'grid-item ' ); ?> <?php printf( '%s', $datasticky ); ?>>
		<div class="post__inner">
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="post__image">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail(); ?>
					</a>
				</div>
			<?php endif; ?>					
			<div class="post__detail">
				<div class="post__header">
					<?php echo livre_post_category( array(
						'before' => '<span class="categories">',
						'after'  => '</span>'
					) ); ?>
					<h2 class="post__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				</div>
				<div class="post__meta">
					<div class="post__author">
						<?php echo get_avatar( get_the_author_meta('user_email'), $size = '32'); ?>
						<?php livre_post_by_author(); ?>
					</div>
					<?php echo livre_published_date(); ?>
					<?php //livre_pagination_page_break(); ?>
				</div>
			</div>
		</div>
	</article>

<?php }