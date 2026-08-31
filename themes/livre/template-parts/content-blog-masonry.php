<?php

/**
 * The Template for displaying content of post format standard
 *
 * @author 		tokoo
 * @version     2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
 
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

<article id="post-<?php the_ID(); ?>" <?php post_class( 'grid-item' ); ?> <?php printf( '%s', $datasticky ); ?>>
	<div class="post__inner">
		
		<?php if ( 'gallery' == get_post_format() ) : ?>
			
			<div class="post__image gallery-slider">
				<?php
					$args = array(
						'orderby'        => 'rand',
						'post_type'      => 'attachment',
						'post_parent'    => get_the_ID(),
						'post_mime_type' => 'image',
						'post_status'    => null,
						'numberposts'    => 7,
						);
					$attachments = get_children( $args );

					if ( $attachments ) { ?>

						<ul class="slides">
							<?php foreach ( $attachments as $key => $attachment ) { ?>								<?php $large_image = wp_get_attachment_image_src( $attachment->ID, 'livre_blog_masonry_gallery' ); ?>
								<li>
									<a class="tokoo-lightbox" data-gall="post-gallery-<?php the_ID(); ?>" href="<?php echo esc_url( $large_image[0] ); ?>">
									<img src="<?php echo '' . $large_image[0]; ?>" alt="<?php esc_html_e( 'Post Images', 'livre' ); ?>">

									</a>
								</li>
							<?php } ?>
						</ul><!-- .tile-layout -->

					<?php }
				?>
			</div>

		<?php else : ?>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="post__image">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail( 'livre_blog_masonry' ); ?>
					</a>
				</div>
			<?php endif; ?>	
							
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

