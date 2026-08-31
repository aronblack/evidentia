<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Livre
 */

get_header(); ?>

<div class="main-content">
	<header class="entry-header">
		<strong class="fourohfour"><span class="char-1">4</span><span class="char-2"><i class="dripicons-search"></i></span><span class="char-4">4</span></strong>
		<h1 class="entry-title"><?php esc_html_e( 'Oops! That page can\'t be found.', 'livre' ); ?></h1>
	</header><!-- .entry-header -->

	<div class="no-content-wrap">
		<?php the_widget( 'WP_Widget_Search' ); ?>
	</div>
	
</div>

<?php get_footer(); ?>
