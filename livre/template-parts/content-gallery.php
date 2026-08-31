<?php

/**
 * The Template for displaying content of post format gallery
 *
 * @author 		tokoo
 * @version     2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?> 

<?php if ( is_singular( get_post_type() ) ) { ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
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
			<div class="featured-image gallery-slider">
				<ul class="slides">
					<?php foreach ( $attachments as $key => $attachment ) { ?>
						<?php $large_image = wp_get_attachment_image_src( $attachment->ID, 'livre_blog_masonry_gallery' ); ?>

						<li>
							<a href="<?php echo esc_url( $large_image[0] ); ?>"><img src="<?php echo '' . $large_image[0]; ?>" alt="<?php echo '' . get_the_title(); ?>">
						</li>
					<?php } ?>
				</ul><!-- .tile-layout -->
			</div>

		<?php 	} ?>

		<header class="post__header">
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="post__image">
					<?php 
					$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
					$image_url = wp_get_attachment_image_src( $post_thumbnail_id , 'livre_blog_thumbnails_gallery' );
					?>
					<div class="bg" style="background-image:url(<?php echo esc_url( $image_url[0] ); ?>)"></div>
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
				'separator' => ','
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
							<?php foreach ( $attachments as $key => $attachment ) { ?>
								<?php $large_image = wp_get_attachment_image_src( $attachment->ID, 'livre_blog_masonry_gallery' ); ?>
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
		</div><!-- .inner-post -->
	</article><!-- .hentry -->

<?php } ?>