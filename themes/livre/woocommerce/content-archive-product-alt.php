<?php 
	$product_layout 			= livre_get_product_layout();
	$get_default_perpage 		= get_theme_mod( 'livre_product_per_page' );
	$product_specific_type_c 	= get_theme_mod( 'livre_product_specific_type_c' );
	$product_specific_type 		= get_theme_mod( 'livre_product_specific_type' );
	$show_product_dispay		= get_option( 'woocommerce_shop_page_display', '' );

	if ( isset ( $_GET['orderby'] ) ) {
		$sort 				= $_GET['orderby'];
	} else { $sort = ''; }

	$argsbook = array(
		'post_type'				=> 'product', 
		'posts_per_page'		=> $get_default_perpage,
		'ignore_sticky_posts'  	=> 1,
		'no_found_rows'        	=> 1,
		'meta_query' 		=> array( 'relation' => 'AND',
				array( 'key'     => 'wcbs_product_type', 'value'   => 'book' , 'compare' => 'EXISTS' ), 
				array( 'key'     => 'wcbs_product_type', 'value'   => 'book' , 'compare' => '=' ), 
			),
	);

	$argsmovie = array(
		'post_type'				=> 'product',
		'posts_per_page'		=> $get_default_perpage,
		'ignore_sticky_posts'  	=> 1,
		'no_found_rows'        	=> 1,
		'meta_query' 		=> array( 'relation' => 'AND',
				array( 'key'     => 'wcbs_product_type', 'value'   => 'movie' , 'compare' => 'EXISTS' ), 
				array( 'key'     => 'wcbs_product_type', 'value'   => 'movie' , 'compare' => '=' ), 
			),
	);

	$argsaudio = array(
		'post_type'				=> 'product',
		'posts_per_page'		=> $get_default_perpage,
		'ignore_sticky_posts'  	=> 1,
		'no_found_rows'        	=> 1,
		'meta_query' 		=> array( 'relation' => 'AND',
				array( 'key'     => 'wcbs_product_type', 'value'   => 'audio' , 'compare' => 'EXISTS' ), 
				array( 'key'     => 'wcbs_product_type', 'value'   => 'audio' , 'compare' => '=' ), 
			),
	);

	$argsgame = array(
		'post_type'				=> 'product',
		'posts_per_page'		=> $get_default_perpage,
		'ignore_sticky_posts'  	=> 1,
		'no_found_rows'        	=> 1,
		'meta_query' 		=> array( 'relation' => 'AND',
				array( 'key'     => 'wcbs_product_type', 'value'   => 'game' , 'compare' => 'EXISTS' ), 
				array( 'key'     => 'wcbs_product_type', 'value'   => 'game' , 'compare' => '=' ), 
			),
	);


	$args = array(
		'post_type'				=> 'product',
		'posts_per_page'		=> $get_default_perpage,
		'ignore_sticky_posts'  	=> 1,
		'no_found_rows'        	=> 1,
		'meta_query' 		=> array( 'relation' => 'AND',
				array( 'key'     => 'wcbs_product_type', 'value'   => 'regular' , 'compare' => 'EXISTS' ), 
				array( 'key'     => 'wcbs_product_type', 'value'   => 'regular' , 'compare' => '=' ), 
			),
	);

	if ( is_tax('book_series') ) {

		$args['tax_query'] = array( 
            array(
                'taxonomy' => 'book_series',
                'field' => 'id',
                'terms' => get_queried_object()->term_id ,
            )
		);
		
		$argsaudio['tax_query'] = array( 
            array(
                'taxonomy' => 'book_series',
                'field' => 'id',
                'terms' => get_queried_object()->term_id ,
            )
		);
		
		$argsbook['tax_query'] = array( 
            array(
                'taxonomy' => 'book_series',
                'field' => 'id',
                'terms' => get_queried_object()->term_id ,
            )
		);
		
		$argsgame['tax_query'] = array( 
            array(
                'taxonomy' => 'book_series',
                'field' => 'id',
                'terms' => get_queried_object()->term_id ,
            )
		);
		
		$argsmovie['tax_query'] = array( 
            array(
                'taxonomy' => 'book_series',
                'field' => 'id',
                'terms' => get_queried_object()->term_id ,
            )
        );
		}


	switch ( $sort ) {
		case 'popularity':
				$args['meta_key'] = 'total_sales';
				$args['order']    = 'DESC';
				$args['orderby'] = "$wpdb->postmeta.meta_value+0 DESC, $wpdb->posts.post_date DESC";

				$argsaudio['meta_key'] = 'total_sales';
				$argsaudio['order']    = 'DESC';
				$argsaudio['orderby'] = "$wpdb->postmeta.meta_value+0 DESC, $wpdb->posts.post_date DESC";

				$argsbook['meta_key'] = 'total_sales';
				$argsbook['order']    = 'DESC';
				$argsbook['orderby'] = "$wpdb->postmeta.meta_value+0 DESC, $wpdb->posts.post_date DESC";

				$argsgame['meta_key'] = 'total_sales';
				$argsgame['order']    = 'DESC';
				$argsgame['orderby'] = "$wpdb->postmeta.meta_value+0 DESC, $wpdb->posts.post_date DESC";

				$argsmovie['meta_key'] = 'total_sales';
				$argsmovie['order']    = 'DESC';
				$argsmovie['orderby'] = "$wpdb->postmeta.meta_value+0 DESC, $wpdb->posts.post_date DESC";
			break;	
		case 'rating':
				$args['meta_key'] = '_wc_average_rating'; // @codingStandardsIgnoreLine
				$args['orderby']  = array(
					'meta_value_num' => 'DESC',
					'ID'             => 'ASC',
				);

				$argsaudio['meta_key'] = '_wc_average_rating'; // @codingStandardsIgnoreLine
				$argsaudio['orderby']  = array(
					'meta_value_num' => 'DESC',
					'ID'             => 'ASC',
				);

				$argsbook['meta_key'] = '_wc_average_rating'; // @codingStandardsIgnoreLine
				$argsbook['orderby']  = array(
					'meta_value_num' => 'DESC',
					'ID'             => 'ASC',
				);

				$argsgame['meta_key'] = '_wc_average_rating'; // @codingStandardsIgnoreLine
				$argsgame['orderby']  = array(
					'meta_value_num' => 'DESC',
					'ID'             => 'ASC',
				);

				$argsmovie['meta_key'] = '_wc_average_rating'; // @codingStandardsIgnoreLine
				$argsmovie['orderby']  = array(
					'meta_value_num' => 'DESC',
					'ID'             => 'ASC',
				);
			break;
		case 'date':
				$args['orderby'] = 'date ID';
				$argsaudio['orderby'] = 'date ID';
				$argsbook['orderby'] = 'date ID';
				$argsgame['orderby'] = 'date ID';
				$argsmovie['orderby'] = 'date ID';
				break;	
		case 'price-desc':
				$args['meta_key'] = '_price';
				$args['order']    = 'DESC';
				$args['orderby']	= 'meta_value_num';

				$argsaudio['meta_key'] = '_price';
				$argsaudio['order']    = 'DESC';
				$argsaudio['orderby']	= 'meta_value_num';

				$argsbook['meta_key'] = '_price';
				$argsbook['order']    = 'DESC';
				$argsbook['orderby']	= 'meta_value_num';

				$argsgame['meta_key'] = '_price';
				$argsgame['order']    = 'DESC';
				$argsgame['orderby']	= 'meta_value_num';

				$argsmovie['meta_key'] = '_price';
				$argsmovie['order']    = 'DESC';
				$argsmovie['orderby']	= 'meta_value_num';
			break;
		case 'price':
				$args['meta_key'] 	= '_price';
				$args['order']    	= 'ASC';
				$args['orderby']	= 'meta_value_num';

				$argsaudio['meta_key'] 	= '_price';
				$argsaudio['order']    	= 'ASC';
				$argsaudio['orderby']	= 'meta_value_num';

				$argsbook['meta_key'] 	= '_price';
				$argsbook['order']    	= 'ASC';
				$argsbook['orderby']	= 'meta_value_num';

				$argsgame['meta_key'] 	= '_price';
				$argsgame['order']    	= 'ASC';
				$argsgame['orderby']	= 'meta_value_num';

				$argsmovie['meta_key'] 	= '_price';
				$argsmovie['order']    	= 'ASC';
				$argsmovie['orderby']	= 'meta_value_num';
			break;
	}

	if ( $product_specific_type_c == 1) {

		$the_products 		= new WP_Query();
		$the_book_products 	= new WP_Query();
		$the_movie_products = new WP_Query();
		$the_audio_products = new WP_Query();
		$the_game_products 	= new WP_Query();

		switch ( $product_specific_type) {
			case 'regular':
				$the_products = new WP_Query( $args );
				break;
			case 'book':
				$the_book_products = new WP_Query( $argsbook );
				break;
			case 'movie':
				$the_movie_products = new WP_Query( $argsmovie );
				break;
			case 'game':
				$the_game_products = new WP_Query( $argsgame );
				break;
			case 'audio':
				$the_audio_products = new WP_Query( $argsaudio );
				break;

			default:
				$the_book_products = new WP_Query( $argsbook );
				break;
		}
	} else {
		$the_products 		= new WP_Query( $args );
		$the_book_products 	= new WP_Query( $argsbook );
		$the_movie_products = new WP_Query( $argsmovie );
		$the_audio_products = new WP_Query( $argsaudio );
		$the_game_products 	= new WP_Query( $argsgame );
	}

	if ( $the_products->have_posts() ) : ?>

		<?php while ( $the_products->have_posts() ) : $the_products->the_post();
			
			// REGULAR PRODUCTS
			$get_product_type 	= get_post_meta( get_the_ID(), 'wcbs_product_type', true );
			$get_default_type 	= get_theme_mod( 'livre_product_default_type', 'regular' );
			$product_type 		= ! empty( $get_product_type ) ? $get_product_type : $get_default_type;

			ob_start();
				livre_woocommerce_content_product_layout($product_layout);
				$regular_products[] = ob_get_contents();
			ob_end_clean();

		endwhile; ?>
		<?php wp_reset_postdata(); ?>
	<?php endif; ?>

	<?php 
		if ( $the_book_products->have_posts() ) : 
	?>

	<?php while ( $the_book_products->have_posts() ) : $the_book_products->the_post();

		ob_start();
			livre_woocommerce_content_product_layout($product_layout);
			$book_products[] = ob_get_contents();
		ob_end_clean();

	endwhile; ?>
	<?php wp_reset_postdata(); ?>
	<?php endif; ?>

	<?php
	if ( $the_movie_products->have_posts() ) : ?>

		<?php while ( $the_movie_products->have_posts() ) : $the_movie_products->the_post();

			ob_start();
				livre_woocommerce_content_product_layout($product_layout);
				$movie_products[] = ob_get_contents();
			ob_end_clean();

		endwhile; ?>
		<?php wp_reset_postdata(); ?>
	<?php endif; ?>

	<?php 
	if ( $the_audio_products->have_posts() ) : ?>

		<?php while ( $the_audio_products->have_posts() ) : $the_audio_products->the_post();

			ob_start();
				livre_woocommerce_content_product_layout($product_layout);
				$audio_products[] = ob_get_contents();
			ob_end_clean();

		endwhile; ?>
		<?php wp_reset_postdata(); ?>
	<?php endif; ?>

	<?php 
	if ( $the_game_products->have_posts() ) : ?>

		<?php while ( $the_game_products->have_posts() ) : $the_game_products->the_post();

			ob_start();
				livre_woocommerce_content_product_layout($product_layout);
				$game_products[] = ob_get_contents();	
			ob_end_clean();

		endwhile; ?>
		<?php wp_reset_postdata(); ?>
	<?php endif; ?>

<!-- DISPLAY -->
<?php $shop_page_id = get_option( 'woocommerce_shop_page_id' ); ?>

<?php if ( ( $show_product_dispay == 'subcategories' ) or ($show_product_dispay == 'both') ) {
	woocommerce_product_loop_start();
	woocommerce_product_loop_end();
} ?>

<?php if ( $show_product_dispay != 'subcategories' ) { ?>
	<?php if ( ! empty( $regular_products ) ) : ?>
		<header class="section-header">
			<h2 class="section-title"><?php echo esc_html__( 'Regular', 'livre' ); ?></h2>
		</header>
		<?php get_template_part('woocommerce/loop/loop-start'); ?>
			<?php $reg = 1; ?> 
			<?php foreach ( $regular_products as $regular ) : ?>
					<?php echo ''.$regular; ?>
			<?php endforeach; ?>
		<?php woocommerce_product_loop_end(); ?>

		<div class="view-all">
			<a class="button button--primary" href="<?php echo esc_url( add_query_arg( 'product_type', 'regular', get_permalink( wc_get_page_id( 'shop' ) ) ) ); ?>"><?php esc_html_e( 'View All', 'livre' ); ?></a>
		</div>
	<?php endif; ?>

	<?php if ( ! empty( $book_products ) ) : ?>
		<header class="section-header">
			<h2 class="section-title"><?php echo esc_html__( 'Books ', 'livre' ); ?></h2>
		</header>
		<?php //get_template_part('woocommerce/loop/loop-start'); ?>
		<?php woocommerce_product_loop_start(); ?>
			<?php $book = 1; ?>
			<?php foreach ( $book_products as $buku ) : ?>
					<?php echo ''.$buku; ?>
			<?php endforeach; ?>
		<?php woocommerce_product_loop_end(); ?>

		<div class="view-all">
			<a class="button button--primary" href="<?php echo esc_url( add_query_arg( 'product_type', 'book', get_permalink( wc_get_page_id( 'shop' ) ) ) ); ?>"><?php esc_html_e( 'View All', 'livre' ); ?></a>
		</div>
	<?php endif; ?>

	<?php if ( ! empty( $movie_products ) ) : ?>
		<header class="section-header">
			<h2 class="section-title"><?php echo esc_html__( 'Movie', 'livre' ); ?></h2>
		</header>
		<?php get_template_part('woocommerce/loop/loop-start'); ?>
			<?php $mov = 1; ?>
			<?php foreach ( $movie_products as $movies ) : ?>
				<?php echo ''.$movies; ?>
			<?php endforeach; ?>
		<?php woocommerce_product_loop_end(); ?>

		<div class="view-all">
			<a class="button button--primary" href="<?php echo esc_url( add_query_arg( 'product_type', 'movie', get_permalink( wc_get_page_id( 'shop' ) ) ) ); ?>"><?php esc_html_e( 'View All', 'livre' ); ?></a>
		</div>
	<?php endif; ?>

	<?php if ( ! empty( $audio_products ) ) : ?>
		<header class="section-header">
			<h2 class="section-title"><?php echo esc_html__( 'Music', 'livre' ); ?></h2>
		</header>
		<?php get_template_part('woocommerce/loop/loop-start'); ?>
			<?php $mus = 1; ?>
			<?php foreach ( $audio_products as $musics ) : ?>
				<?php echo ''.$musics; ?>
			<?php endforeach; ?>
		<?php woocommerce_product_loop_end(); ?>

		<div class="view-all">
			<a class="button button--primary" href="<?php echo esc_url( add_query_arg( 'product_type', 'music', get_permalink( wc_get_page_id( 'shop' ) ) ) ); ?>"><?php esc_html_e( 'View All', 'livre' ); ?></a>
		</div>
	<?php endif; ?>

	<?php if ( ! empty( $game_products ) ) : ?>
		<header class="section-header">
			<h2 class="section-title"><?php echo esc_html__( 'Games', 'livre' ); ?></h2>
		</header>
		<?php get_template_part('woocommerce/loop/loop-start'); ?>
			<?php $game = 1; ?>
			<?php foreach ( $game_products as $games ) : ?>
				<?php echo ''.$games; ?>
			<?php endforeach; ?>
		<?php woocommerce_product_loop_end(); ?>

		<div class="view-all">
			<a class="button button--primary" href="<?php echo esc_url( add_query_arg( 'product_type', 'game', get_permalink( wc_get_page_id( 'shop' ) ) ) ); ?>"><?php esc_html_e( 'View All', 'livre' ); ?></a>
		</div>
	<?php endif; ?>
<?php } ?>