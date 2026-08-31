<?php

/**
 * The Template for displaying content of post format standard
 *
 * @author 		tokoo
 * @version     2.0
 */ 

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'type-page' ); ?>>
	<?php livre_single_post_featured_image( '_blog_thumbnail' ); ?>
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
	<?php wp_link_pages( array( 'before' => '<div class="article-paging">' . '<strong>' . esc_html__( 'Pages:', 'livre' ) . '</strong>', 'after' => '</div>' ) ); ?>

	<?php if ( livre_get_option( 'comment_form', 1 ) && comments_open() ) comments_template(); // Loads the comments.php template. ?>

</article><!-- .hentry -->

