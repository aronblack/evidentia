<?php
/**
 * The template for displaying content of 404 and search no result.
 *
 * @package Livre
 */
?>

<div class="no-content-wrap">
	<div class="no-content-icon">
		<i class="dripicons-document"></i>
	</div>
	<div class="no-content-desc">
		<p>
			<?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'livre' ); ?>
		</p>
		<?php the_widget( 'WP_Widget_Search' ); ?>
		
	</div>
</div>


