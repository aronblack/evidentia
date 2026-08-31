<?php

/**
 * The Template for displaying loop nav
 *
 * @author 		tokoo
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<?php if ( is_attachment() ) : ?>

	<div class="pagination">
		<?php previous_post_link( '%link', '<span class="previous">' . wp_kses( __( '<span class="meta-nav">&larr;</span> Return to entry', 'livre' ), array( 'span' => array( 'class' => array() ) ) ) . '</span>' ); ?>
	</div><!-- .loop-nav -->

<?php else :

	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<div class="posts-navigation"> 
		<?php if ( get_next_posts_link() ) : ?>
			<?php next_posts_link( wp_kses( __( 'Next <i class="fa fa-angle-right"></i>', 'livre' ), array( 'i' => array( 'class' => array() ) ) ) ); ?>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
			<?php previous_posts_link( wp_kses( __( '<i class="fa fa-angle-left"></i> Previous', 'livre' ), array( 'i' => array( 'class' => array() ) ) ) ); ?>
		<?php endif; ?>
	</div>

<?php endif; ?>