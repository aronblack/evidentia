<?php

/**
 * The Template for displaying loop meta
 * used in Taxonomy Pages
 *
 * @author 		tokoo
 * @version     2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// bounce back in ... well, you know lah
if ( is_page_template( 'templates/composer.php' ) || is_page_template( 'templates/page-builder-full.php' ) || is_404() || is_singular( 'product' ) || is_singular( 'post' ) )
	return;
?>

<div class="page-header page-header--center">
	<div class="page-header-bg">
		<?php 
			$page_details 	= livre_get_meta( '_page_details' );
			if ( is_page() && ! empty( $page_details['perpage_page_title_background'] ) ) {
				$get_page_title_bg 	= wp_get_attachment_image_src( $page_details['perpage_page_title_background'], 'full' );
				$page_title_bg 		=  $get_page_title_bg[0];
			} else if ( ( is_category() || is_tag() || is_tax() ) && null !== livre_get_page_title_background_image_src()  ) {
				$page_title_bg 		= livre_get_page_title_background_image_src();
			} else {
				$page_title_bg 		=  get_theme_mod( 'livre_page_title_background' );
			}
		 ?>
		<div class="bg" style="background-image:url(<?php echo esc_url( $page_title_bg ); ?>)"></div>
	</div>

	<div class="container">

		<?php if ( is_404() ) { ?>

			<h2 class="page-title"><?php esc_html_e( 'Page Not Found', 'livre' ); ?></h2>

		<?php } elseif ( is_home() ) {

			$title 		= esc_html__( 'Blog', 'livre' );
			$posts_page = get_option( 'page_for_posts' );
			if ( ! empty( $posts_page ) && is_numeric( $posts_page ) ) {
				$title = get_the_title( $posts_page );
			}
			?>
			<h2 class="page-title"><?php echo esc_attr( $title ); ?></h2>

		<?php } elseif ( is_category() ) { ?>

			<?php $cat_title = single_cat_title( '', false ); ?>
			<h2 class="page-title"><?php printf( wp_kses( __( 'Category: <strong>%s</strong>', 'livre' ), array( 'strong' => array() ) ), $cat_title ); ?></h2>

		<?php } elseif ( is_tag() ) { ?>

			<?php $tag_title = single_tag_title( '', false ); ?>
			<h2 class="page-title"><?php printf( wp_kses( __( 'Tag: <strong>%s</strong>', 'livre' ), array( 'strong' => array() ) ), $tag_title ); ?></h2>

		<?php } elseif ( is_tax( 'collections' ) ) { ?>

			<h2 class="page-title"><?php single_term_title(); ?></h2>
			<small class="page-subtitle"><?php echo term_description( get_queried_object_id(), 'collections' ); ?></small>

		<?php } elseif ( is_tax() ) { ?>

			<h2 class="page-title"><?php single_term_title(); ?></h2>
			<?php if ( is_tax('book_series') ) {
					$book_series_data = get_term( get_queried_object()->term_id, 'book_series' ); ?>
					<span> <?php echo '' . $book_series_data->description; ?></span>
			<?php } ?>

		<?php } elseif ( is_author() ) { ?>

			<?php $author_name = get_the_author_meta( 'display_name', get_query_var( 'author' ) ); ?>
			<h2 class="page-title fn n"><?php printf( wp_kses( __( 'Author: <strong>%s</strong>', 'livre' ), array( 'strong' => array() ) ), $author_name ); ?></h2>

		<?php } elseif ( is_search() ) { ?>

			<h2 class="page-title"><?php esc_html_e( 'Search Result ', 'livre' ); ?></h2>
			<div class="loop-description">
				<?php echo wpautop( sprintf( __( 'You are browsing the search results for "%s"', 'livre' ), esc_attr( get_search_query() ) ) ); ?>
			</div><!-- .loop-description -->

		<?php } elseif ( function_exists( 'tribe_is_month' ) && tribe_is_month() ) { ?>

			<h2 class="page-title">
				<?php esc_html_e( 'Events', 'livre' ); ?>
			</h2>

		<?php } elseif ( is_singular( 'tribe_events' ) ) { ?>

			<h2 class="event-title"><?php single_post_title(); ?></h2>

		<?php } elseif ( is_page() ) { ?>
			<?php if ( is_front_page() && class_exists( 'woocommerce') && is_shop() ){ ?>
				<h2 class="page-title"><?php echo get_the_title( wc_get_page_id( 'shop' ) ); ?></h2>
			<?php } else { ?>
			<h2 class="page-title"><?php echo get_the_title(); ?></h2>
			<?php } ?>
			<?php if ( ! empty( $page_details['perpage_page_subtitle'] ) ) : ?>
				<small class="page-subtitle"><?php echo ''.$page_details['perpage_page_subtitle']; ?></small>
			<?php endif; ?>

		<?php } elseif ( is_post_type_archive() ) { ?>
			
			<?php if ( class_exists( 'woocommerce') && is_shop() ){ ?>
				<h2 class="page-title"><?php echo get_the_title( wc_get_page_id( 'shop' ) ); ?></h2>
			<?php } else { ?>
				<h2 class="page-title"> 
					<?php post_type_archive_title(); ?>
				</h2>
			<?php } ?>

		<?php } elseif ( is_day() || is_month() || is_year() ) { ?>

			<?php
				if ( is_day() )
					$date = get_the_time( esc_html__( 'F d, Y', 'livre' ) );
				elseif ( is_month() )
					$date = get_the_time( esc_html__( 'F Y', 'livre' ) );
				elseif ( is_year() )
					$date = get_the_time( esc_html__( 'Y', 'livre' ) );
			?>

			<h2 class="page-title"><?php printf( $date ); ?></h2>

		<?php } elseif ( get_page_template_slug( get_the_ID() ) ) { // check if the page using page template ?>

			<h2 class="page-title"><?php echo get_post_field( 'post_title', get_queried_object_id() ); ?></h2>

		<?php } ?>

	</div>
</div>

