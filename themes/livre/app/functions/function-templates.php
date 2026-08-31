<?php
/**
 * Custom template tags for this theme.
 * List of useful functions for theme usage and for help theme developer.
 * All functions need to call in the theme template.
 *
 * @package LivreCore
 * @version 1.0
 *
 * @author     Tokooo
 * @copyright  Copyright (c) 2015, Tokoo
 *
 * @license license.txt
 */

/**
 * Site title/logo.
 *
 * @since 1.0
 */
function livre_site_title() {
	$get_custom_logo 	= get_theme_mod( 'custom_logo' );
	$logo 				= wp_get_attachment_image_src( $get_custom_logo, 'full' );
	$retina_logo 		= get_theme_mod( 'livre_retina_logo' );
	$retina_logo 		= ! empty( $retina_logo ) ? 'srcset="' .esc_url( $retina_logo ). ' 2x"' : '';
	$logotag  			= ( is_home() || is_front_page() ) ? 'h1':'div';

	if ( has_custom_logo() ) {
		echo '<' . $logotag . ' class="site-logo">' . "\n";
			echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . get_bloginfo( 'name' ) . '" rel="home">' . "\n";
				echo '<img src="' . esc_url( $logo[0] ) . '" '.$retina_logo. ' alt="' . get_bloginfo( 'name' ) . '" />' . "\n";
			echo '</a>' . "\n";
		echo '</' . $logotag . '>' . "\n";
	} else {
		// Site Title
		$tag 		= ( is_home() || is_front_page() ) ? 'h1' : 'div';
		echo '<' . $logotag . ' class="site-logo">';
			echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . get_bloginfo( 'name' ) . '" rel="home">' . get_bloginfo( 'name' ) . '</a>';
		echo '</' . $logotag . '>' . "\n";
		echo ' <small class="site-description">' . get_bloginfo( 'description' ) . '</small>';
	}
}

/**
 * Dynamic footer text.
 *
 * @since 1.0
 */
function livre_footer_text() {

	$footer_default =
		sprintf( wp_kses( __( 'Copyright &copy; %s %s.', 'livre' ), array( 'a' => array( 'href' => array(), 'class' => array(), 'title' => array(), 'rel' => array() ), 'span' => array() ) ),
			date( 'Y' ), // [the-year]
			'<a class="site-link" href="' . home_url( '/' ) . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" rel="home"><span>' . get_bloginfo( 'name' ) . '</span></a>' // [site-link]
		);

	$wp_link = '<a class="wp-link" href="http://wordpress.org" title="' . esc_html__( 'State-of-the-art semantic personal publishing platform', 'livre' ) . '"><span>' . esc_html__( 'WordPress', 'livre' ) . '</span></a>'; // [wp-link]

	$theme = wp_get_theme( get_template() );
	$theme_link = '<a class="theme-link" href="' . esc_url( $theme->get( 'ThemeURI' ) ) . '" title="' . sprintf( esc_html__( '%s WordPress Theme', 'livre' ), $theme->get( 'Name' ) ) . '" rel="nofollow"><span>' . esc_attr( $theme->get( 'Name' ) ) . '</span></a>'; // [theme-link]

	if ( ! is_child_theme() ) {

		$footer_default .= sprintf( esc_html__( ' Powered by %s and %s.', 'livre' ), $wp_link, $theme_link );

	} else {

		$child_theme = wp_get_theme();
		$child_theme_link = '<a class="child-link" href="' . esc_url( $child_theme->get( 'ThemeURI' ) ) . '" title="' . sprintf( esc_html__( '%s WordPress Theme', 'livre' ), $child_theme->get( 'Name' ) ) . '"><span>' . esc_html( $child_theme->get( 'Name' ) ) . '</span></a>'; // [child-link]

		$footer_default .= sprintf( esc_html__( ' Powered by %s, %s and %s.', 'livre' ), $wp_link, $theme_link, $child_theme_link );

	}

	$footer_credits = livre_get_option( 'footer_content' );

	if ( ! empty( $footer_credits ) ) {
		echo ''.$footer_credits;
	} else {
		printf( $footer_default );
	}

}

/**
 * Post format link
 *
 * @since  1.0
 * @author tokoo
 **/
function livre_post_format_link( $args = array() ) {

	$defaults 	= array( 'before' => '', 'after' => '' );
	$args 		= wp_parse_args( $args, $defaults );

	$format 	= get_post_format();
	$url 		= ( empty( $format ) ? esc_url( get_permalink() ) : get_post_format_link( $format ) );

	return $args['before'] . '<a href="' . esc_url( $url ) . '" class="post-format-link">' . get_post_format_string( $format ) . '</a>' . $args['after'];
}

/**
 * Post author
 *
 * @since  1.0
 * @author tokoo
 **/
function livre_post_author_link( $args = array() ) {

	global $post;
	$author_id = $post->post_author;
	$post_type = get_post_type();

	if ( post_type_supports( $post_type, 'author' ) ) {

		$defaults = array(
				'before' => '',
				'after'  => ''
			);
		$args = wp_parse_args( $args, $defaults );

		$author = '<a class="url fn n" rel="author" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ) ) . '" title="' . esc_attr( get_the_author_meta( 'display_name', $author_id ) ) . '">'.get_the_author_meta( 'display_name', $author_id ) . '</a>';

		return $args['before'] . $author . $args['after'];
	}

	return '';
}

/**
 * Display Post Author
 *
 * @return void
 * @author tokoo
 **/
function livre_post_by_author( $args = array() ) {
	if ( is_singular( 'post' ) ) : ?>
		<span class="byline"><?php printf( esc_html__( 'Posted By %s', 'livre' ), livre_post_author_link( $args ) ); ?></span>
	<?php else : 
		if ( get_post_type( get_the_ID() ) == 'product' ) { 
			if ( class_exists( 'Wcbs' )) {
				$taxes 			= wp_get_object_terms( get_the_ID(), 'book_author' ); 
				$i 				= 0;
				$cats_length 	= count( $taxes ); 
				if ( ! empty( $taxes ) ) {
					echo '<span class="author">' . esc_html__( "By", "livre" );
						foreach ( $taxes as $cat ) { 
							$separator = ( $i !== $cats_length - 1 ) ? ', ' : ''; ?>
							<a href="<?php echo get_term_link( $cat->slug, 'book_author' ); ?>"><?php echo esc_attr( $cat->name ) . $separator; ?></a>
						<?php $i++;
					}
					echo '</span>'; 
				}
			}
		} else { ?>
		<span class="byline"><?php printf( esc_html__( 'By %s', 'livre' ), livre_post_author_link( $args ) ); ?></span>
		<?php } ?>
	<?php endif; 
}

/**
 * Post published date
 *
 * @since  1.0
 * @author tokoo
 **/
function livre_published_date( $args = array() ) {

	$defaults = array(
			'before'		=> '<span class="date"><a href="'.get_permalink( get_the_ID() ).'">',
			'after'			=> '</a></span>',
			'format'		=> get_option( 'date_format' ),
			'human_time'	=> '',
			'post_id'		=> get_the_ID()
		);
	$args = wp_parse_args( $args, $defaults );

	/* If $human_time is passed in, allow for '%s ago' where '%s' is the return value of human_time_diff(). */
	if ( ! empty( $args['human_time'] ) )
		$time = sprintf( $args['human_time'], human_time_diff( get_the_time( 'U', $args['post_id'] ), current_time( 'timestamp' ) ) );

	/* Else, just grab the time based on the format. */
	else
		$time = get_the_time( $args['format'], $args['post_id'] );

	$published = $time ;

	return $args['before'] . $published . $args['after'];
}

/**
 * Post Comment Link
 *
 * @since  1.0
 * @author tokoo
 **/
function livre_post_comment_link( $args = array() ) {

	$comment_option = livre_get_option( 'comment_form', 1 );
	if ( ! isset( $comment_option ) || false == $comment_option	|| ! comments_open() )
		return;

	$comments_link = '';
	$number = doubleval( get_comments_number() );

	$defaults = array(
			'zero'      => esc_html__( 'Leave a response', 'livre' ),
			'one'       => esc_html__( '%1$s Response', 'livre' ),
			'more'      => esc_html__( '%1$s Responses', 'livre' ),
			'css_class' => 'comments-link',
			'none'      => '',
			'before'    => '',
			'after'     => ''
		);
	$args = wp_parse_args( $args, $defaults );

	if ( 0 == $number && ! comments_open() && ! pings_open() ) {
		if ( $args['none'] )
			$comments_link = '<span class="' . esc_attr( $args['css_class'] ) . '">' . sprintf( $args['none'], number_format_i18n( $number ) ) . '</span>';
	}
	elseif ( 0 == $number )
		$comments_link = '<a class="' . esc_attr( $args['css_class'] ) . '" href="' . esc_url( get_permalink() ) . '#respond" title="' . sprintf( esc_html__( 'Comment on %1$s', 'livre' ), the_title_attribute( 'echo=0' ) ) . '"><i class="drip-icon-message"></i>' . sprintf( $args['zero'], number_format_i18n( $number ) ) . '</a>';
	elseif ( 1 == $number )
		$comments_link = '<a class="' . esc_attr( $args['css_class'] ) . '" href="' . esc_url( get_comments_link() ) . '" title="' . sprintf( esc_html__( 'Comment on %1$s', 'livre' ), the_title_attribute( 'echo=0' ) ) . '"><i class="drip-icon-message"></i>' . sprintf( $args['one'], number_format_i18n( $number ) ) . '</a>';
	elseif ( 1 < $number )
		$comments_link = '<a class="' . esc_attr( $args['css_class'] ) . '" href="' . esc_url( get_comments_link() ) . '" title="' . sprintf( esc_html__( 'Comment on %1$s', 'livre' ), the_title_attribute( 'echo=0' ) ) . '"><i class="drip-icon-message"></i>' . sprintf( $args['more'], number_format_i18n( $number ) ) . '</a>';

	if ( $comments_link )
		$comments_link = $args['before'] . $comments_link . $args['after'];

	return $comments_link;
}

/**
 * Post Edit Link
 *
 * @since  1.0
 * @author tokoo
 **/
function livre_post_edit_link( $args = array() ) {
	$post_type = get_post_type_object( get_post_type() );

	if ( !current_user_can( $post_type->cap->edit_post, get_the_ID() ) )
		return '';

	$defaults 	= array( 'before' => '', 'after' => '' );
	$args 		= wp_parse_args( $args, $defaults );

	return $args['before'] . '<span class="edit"><a class="post-edit-link" href="' . esc_url( get_edit_post_link( get_the_ID() ) ) . '" title="' . sprintf( esc_html__( 'Edit %1$s', 'livre' ), $post_type->labels->singular_name ) . '">' . esc_html__( 'Edit', 'livre' ) . '</a></span>' . $args['after'];
}

/**
 * Post Terms
 *
 * @since  1.0
 * @author tokoo
 **/
function livre_post_terms( $args = array() ) {

	$defaults = array(
		'id'        => get_the_ID(),
		'taxonomy'  => 'post_tag',
		'separator' => ', ',
		'before'    => '',
		'after'     => ''
	);
	$args = wp_parse_args( $args, $defaults );

	$args['before']	= ( empty( $args['before'] ) ? '<span class="' . $args['taxonomy'] . '">' : $args['before'] );
	$args['after']	= ( empty( $args['after'] ) ? '</span>' : $args['after'] );

	return get_the_term_list( $args['id'], $args['taxonomy'], $args['before'], $args['separator'], $args['after'] );
}

/**
 * Post Category
 *
 * @since  1.0
 * @author tokoo
 **/
function livre_post_category( $args = array() ) {
	$args['taxonomy'] = 'category';
	return livre_post_terms( $args );
}

/**
 * Post Tags
 *
 * @since  1.0
 * @author tokoo
 **/
function livre_post_tags( $args = array() ) {
	$args['taxonomy'] = 'post_tag';
	return livre_post_terms( $args );
}

/**
 * Featured Image
 *
 * @return void
 * @author tokoo
 **/
function livre_single_post_featured_image( $size = 'full', $default = false ) {

	// bounce back if doesn't have featured image nor default image is defined
	if ( ! has_post_thumbnail() && ! $default )
		return;

	echo '<figure class="featured-image">';

	if ( has_post_thumbnail() ) {
		echo '<a href="#">';
		echo get_the_post_thumbnail( get_the_ID(), 'livre' . $size );
		echo '</a>';
	} else if ( $default ) { }

	echo '</figure>';
}

/**
 * Featured Image in Blog List
 * $featured = false use for You May Also Read (using post-image instead of featured-image)
 */
function livre_post_featured_image( $size = 'full' ) {

	// default placeholder
	$featured_image = LIVRE_THEME_ASSETS_URI . '/img/imgo2.jpg';

	if ( has_post_thumbnail() ) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $size, false );
		if ( $image ) {
			$featured_image = $image[0];
		}
	}
	?>
		<div class="featured-image card-image-bg" data-bg-image="<?php echo esc_url( $featured_image ); ?>"></div>
	<?php

}

/**
 * Display post author box on single post.
 *
 */
function livre_post_author() {
	global $post;
	$author_id = $post->post_author;
	if ( livre_get_option( 'post_author', 1 ) && is_singular( 'post' ) ) { ?>

		<div class="post-author">
			<div class="post-author__avatar">
				<?php echo get_avatar( get_the_author_meta( 'user_email', $author_id ), apply_filters( 'livre_author_bio_avatar_size', 100 ) ); ?>
			</div>
			
			<h3 class="post-author__name">
				<?php echo get_the_author_meta( 'display_name', $author_id ); ?>
			</h3>
			
			<div class="post-author__bio">
				<?php echo wpautop( get_the_author_meta( 'description', get_query_var( 'author' ) ) ); ?>
			</div>

			<div class="post-author__social">

				<div class="social-links social-links--large">
					<?php
						$facebook 	= get_the_author_meta( 'facebook' );
						$twitter 	= get_the_author_meta( 'twitter' );
						$gplus 		= get_the_author_meta( 'gplus' );
						$pinterest 	= get_the_author_meta( 'pinterest' );
						$linkedin 	= get_the_author_meta( 'linkedin' );
						$instagram 	= get_the_author_meta( 'instagram' );
					?>
					<?php if ( $facebook ) : ?>
						<a href="http://facebook.com/<?php echo esc_attr( $facebook ); ?>" class="facebook"><i class="fa fa-facebook"></i></a>
					<?php endif; ?>
					<?php if ( $twitter ) : ?>
						<a href="http://twitter.com/<?php echo esc_attr( $twitter ); ?>" class="twitter"><i class="fa fa-twitter"></i></a>
					<?php endif; ?>
					<?php if ( $gplus ) : ?>
						<a href="http://plus.google.com/<?php echo esc_attr( $gplus ); ?>" class="google-plus"><i class="fa fa-google-plus"></i></a>
					<?php endif; ?>
					<?php if ( $pinterest ) : ?>
						<a href="<?php echo esc_url( $pinterest ); ?>" class="pinterest"><i class="fa fa-pinterest"></i></a>
					<?php endif; ?>
					<?php if ( $linkedin ) : ?>
						<a href="<?php echo esc_url( $linkedin ); ?>" class="linkedin"><i class="fa fa-linkedin"></i></a>
					<?php endif; ?>
					<?php if ( $instagram ) : ?>
						<a href="<?php echo esc_url( $instagram ); ?>" class="instagram"><i class="fa fa-instagram"></i></a>
					<?php endif; ?>
				</div><!-- .social-links -->
			</div>

		</div><!-- .post-author -->

		<div class="separator separator--arrow"></div>
	<?php
	}
}

/**
 * Display previous post and next post
 *
 * @return void
 **/
function livre_prev_next_post() {
	$previous_post 	= get_previous_post();
	$next_post 		= get_next_post();
	?>

	<?php if (  $previous_post || $next_post  ) : ?>

		<div class="post__nav">
			<?php if ( $previous_post ) : ?>
				<div class="post__nav--prev">
					<a href="<?php echo esc_url( get_permalink( $previous_post->ID ) ); ?>">
						<h2><?php echo esc_attr( $previous_post->post_title ); ?></h2>
						<?php echo livre_published_date( array(
							'before' => '<small class="date">',
							'after'  => '</small>'
						) ); ?>
					</a>
				</div>
			<?php endif; ?>
			<?php if ( $next_post ) : ?>
				<div class="post__nav--next">
					<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
						<h2><?php echo esc_attr( $next_post->post_title ); ?></h2>
						<?php echo livre_published_date( array(
							'before' => '<small class="date">',
							'after'  => '</small>'
						) ); ?>
					</a>
				</div>
			<?php endif; ?>
		</div> <!-- .post-navigation -->
		
		<div class="separator separator--arrow"></div>

	<?php endif; ?>

	<?php
}

/**
 * Related post function
 *
 * @return void
 **/
function livre_related_post() {

	$include_categories = wp_get_object_terms( get_the_ID(), 'category', array( 'fields' => 'ids' ) );
	$include_tags 		= wp_get_object_terms( get_the_ID(), 'post_tag', array( 'fields' => 'ids' ) );
	$exclude_categories = livre_get_option( 'disallow_by_category' );
	$exclude_tags 		= livre_get_option( 'disallow_by_tags' );
	$per_page 			= livre_get_option( 'related_number', 3 );

	if ( empty( $exclude_categories ) ) {
		$exclude_categories = array();
	}

	if ( empty( $exclude_tags ) ) {
		$exclude_tags = array();
	}

	$args = array(
		'post_type' 		=> 'post',
		'post_status' 		=> 'publish',
		'posts_per_page' 	=> $per_page,
		'order' 			=> 'rand',
		'orderby' 			=> 'date',
		'category__in' 		=> $include_categories,
		'tags__in' 			=> $include_tags,
		'category__not_in'  => $exclude_categories,
		'tags__not_in' 		=> $exclude_tags,
		'post__not_in' 		=> array( get_the_ID() ) );


	$related_items = new WP_Query( $args ); ?>

	<?php if ( $related_items->have_posts() ) : ?>

		<div class="post-related">

			<h3><?php esc_html_e( 'Related Posts', 'livre' ); ?></h3>

			<div class="posts-holder modern-style">
			<?php while ( $related_items->have_posts() ) : $related_items->the_post(); ?>
				
				<article class="type-post">

					<?php livre_single_post_featured_image( '_blog_modern' , true ); ?>
			
					<div class="author-avatar">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), 40 ); ?>
					</div>

					<div class="post-details">
						<h2 class="post-title">
							<a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
							</a>
						</h2>	

						<?php echo livre_published_date(); ?>

						<div class="post-summary">
							<?php echo wp_trim_words( get_the_content(), 20 ); ?>
						</div>
					</div>

				</article>

			<?php endwhile;  ?>
			<?php wp_reset_postdata(); ?>

			</div>

		</div><!-- .related -->

		<div class="separator separator--arrow"></div>
	<?php endif;

}

/**
 * Related Project function
 *
 * @return void
 **/
function livre_related_projects() {

	$include_categories = wp_get_object_terms( get_the_ID(), 'project_categories', array( 'fields' => 'ids' ) );

	$args = array(
			'post_type' 		=> 'tokoo-portfolio',
			'post_status' 		=> 'publish',
			'posts_per_page' 	=> 3,
			'order' 			=> 'rand',
			'orderby' 			=> 'date',
			'tax_query' 		=> array(
				array(
					'taxonomy' 	=> 'project_categories',
					'field' 	=> 'id',
					'terms' 	=> $include_categories
				)
			),
			'post__not_in' 		=> array( get_the_ID() ) );


	$related_items = new WP_Query( $args ); ?>

	<?php if ( $related_items->have_posts() ) : ?>

		<div class="related">

			<div class="related-title"><?php esc_html_e( 'Related Project', 'livre' ); ?></div>

			<div class="portfolio-holder card columns-3">

			<?php while ( $related_items->have_posts() ) : $related_items->the_post(); ?>

				<article class="portfolio portfolio--small card-item">
					<div class="portfolio-inner card-inner">
						<?php livre_post_featured_image(); ?>
						<div class="portfolio__detail">
							<div class="portfolio__data">
								<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<small class="entry-category"><?php livre_portfolio_get_categories(); ?></small>
							</div>
						</div>
					</div>
				</article>

			<?php endwhile;  ?>
			<?php wp_reset_postdata(); ?>

			</div>

		</div><!-- .related -->

	<?php endif;
}

/**
 * Display social share 
 *
 * @return void
 * @author tokoo
 **/
function livre_custom_social_share() {
	global $post;

	if ( has_post_thumbnail() ) {
		$image 		= wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large', false );
		$the_image 	= 'data-image="'.$image[0].'"';
	} else {
		$the_image 	= '';
	}

	if ( is_singular( 'product' ) ) {
		$share_title 	= '';
	} else {
		$share_title = esc_html__( 'Share Article', 'livre' );
	}
	
	if ( true == livre_get_option( 'social_share', 1 ) ) :
	?>
		<div class="post__share" data-title="<?php echo get_the_title(); ?>" data-text="<?php echo strip_tags( $post->post_excerpt ); ?>" <?php echo ''.$the_image; ?> data-url="<?php echo esc_url( get_permalink() ); ?>" data-width=640 data-height=480>
			<strong><?php echo ''.$share_title; ?></strong>
			<a href="" class="facebook s_facebook"><i class="fa fa-facebook"></i><span class="label">Facebook</span></a>
			<a href="" class="twitter s_twitter"><i class="fa fa-twitter"></i><span class="label">Twitter</span></a>
			<a href="" class="google-plus s_plus"><i class="fa fa-google-plus"></i><span class="label">Google+</span></a>
			<a href="" class="linkedin s_linkedin"><i class="fa fa-linkedin"></i><span class="label">LinkedIn</span></a>
		</div>
		<div class="separator separator--arrow"></div>
	<?php
	endif;
}

/**
 * Wrapper Start
 *
 * @return void
 * @since  1.0
 * @author tokoo
 **/
add_action( 'livre_before_main_content', 'livre_wrapper_start', 10 );
function livre_wrapper_start() {
	get_template_part( 'wrapper', 'start' );
}

/**
 * Wrapper End
 *
 * @return void
 * @since  1.0
 * @author tokoo
 **/
add_action( 'livre_after_main_content', 'livre_wrapper_end', 10 );
function livre_wrapper_end() {
	get_template_part( 'wrapper', 'end' );
}


/**
 * Filter post count
 */
add_filter( 'wp_list_categories', 'livre_cat_count_span' );
function livre_cat_count_span( $links ) {
	$links = str_replace( '</a> (', '</a> <span>(', $links );
	$links = str_replace( ')', ')</span>', $links );
	return $links;
}

/**
 * Portfolio item classes
 *
 * @return void
 * @author tokoo
 **/
function livre_portfolio_item_classes() {
	$meta 			= get_post_meta( get_the_ID(), 'livre_project_images_class', true );
	$categories 	= get_the_terms( get_the_ID(), 'project_categories' );
	$classes 		= '';
	$classes 		.= ! empty( $meta['masonry_class'] ) ? $meta['masonry_class'] . ' ' : 'small ';

	if ( $categories ) {
		foreach ( $categories as $class ) {
			$classes .= ' '. esc_attr( $class->slug );
		}
	}

	printf( $classes );
}

/**
 * Add pagination attributes
 *
 * @return void
 * @author tokoo
 **/
add_filter('next_posts_link_attributes', 'livre_nextposts_link_attributes');
function livre_nextposts_link_attributes() {
	return 'class="next-link button"';
}

add_filter('previous_posts_link_attributes', 'livre_prevposts_link_attributes');
function livre_prevposts_link_attributes() {
	return 'class="prev-link button"';
}

/**
 * pagination page break
 *
 * @return void
 * @author tokoo
 **/
function livre_pagination_page_break() {
	wp_link_pages( array(
		'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'livre' ) . '</span>',
		'after'       => '</div>',
		'link_before' => '<span>',
		'link_after'  => '</span>',
		'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'livre' ) . ' </span>%',
		'separator'   => '<span class="screen-reader-text">, </span>',
	) ); 
}

/**
 * Change ... with nlank
 *
 * @return void
 * @author tokoo
 **/
add_filter( 'excerpt_more', 'livre_excerpt_more' );
function livre_excerpt_more( $more ) {
	return '';
}

/**
 * Excerpt length
 *
 * @return void
 * @author tokoo
 **/
add_filter( 'excerpt_length', 'livre_custom_excerpt_length', 999 );
function livre_custom_excerpt_length( $length ) {
	return 20;
}