<?php

/**
 * Loads the admin styles & scripts.
 *
 * @since 1.0
 */
add_action( 'admin_enqueue_scripts', 'livre_admin_scripts' );
function livre_admin_scripts( $hook ) {

	/* Get theme version in style.css. */
	$theme = wp_get_theme( get_template(), get_theme_root( get_template_directory() ) );

	if ( 'post.php' == $hook || 'post-new.php' == $hook ) {
		wp_enqueue_script( 'livre-metabox-control-page', LIVRE_THEME_URI . '/bootstrap/assets/js/page-metabox.js', array( 'jquery' ), '', true );
	}
	
	do_action( 'livre_admin_scripts' );
}

/**
 * Load widgets js
 *
 * @return void
 * @author tokoo
 **/
add_action( 'admin_enqueue_scripts', 'livre_widget_scripts' );
function livre_widget_scripts( $hook ) {
	if ( 'widgets.php' === $hook ) {
		wp_enqueue_media();
		wp_enqueue_script( 'livre_widgets', LIVRE_THEME_URI . '/bootstrap/assets/js/tokoo-widgets.js', array( 'jquery' ), '', true );
	}
}

/**
 * Load Shortcode scripts and styles
 *
 * @return void
 * @author
 **/
add_action( 'wp_enqueue_scripts', 'livre_koo_shortcodes_scripts' );
function livre_koo_shortcodes_scripts() {
	if ( class_exists( 'Koo_Shortcodes' ) ) {
		wp_enqueue_script( 'livre_shortcodes_scripts', LIVRE_THEME_URI . '/bootstrap/assets/js/koo-shortcodes.js', array( 'jquery' ), '', true );
		wp_enqueue_style( 'livre_shortcodes_style', LIVRE_THEME_URI . '/bootstrap/assets/css/koo-shortcodes.css' );
	}

}


/**
 * Get Font URL
 *
 * @return void
 * @author tokoo
 **/
function livre_fonts_url() {

	$fonts_url 		= '';
	$hind_guntur 	= esc_html_x( 'on', 'Open Sans font: on or off', 'livre' );
	$playfair 		= esc_html_x( 'on', 'Playfair Display font: on or off', 'livre' );
	 
	if ( 'off' !== $hind_guntur || 'off' !== $playfair ) {
		$font_families = array();
	 
		if ( 'off' !== $hind_guntur ) {
			$font_families[] = 'Open+Sans:300,400,500,600';
		}
		 
		if ( 'off' !== $playfair ) {
			$font_families[] = 'Playfair+Display:100,100italic,400,400italic,700';
		}
		 
		$query_args = array(
			'family' => implode( '|', $font_families ),
		);
		 
		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	}
	 
	return esc_url_raw( $fonts_url );
}

/**
 * Loads the theme styles & scripts.
 *
 * @since 1.0
 */
add_action( 'wp_enqueue_scripts', 'livre_frontend_scripts', 99 );
function livre_frontend_scripts() {

	/* Get theme version in style.css. */
	$theme = wp_get_theme( get_template(), get_theme_root( get_template_directory() ) );

	/* Load parent style.css in child theme. */
	if ( is_child_theme() )
		wp_enqueue_style( 'livre-parent-style', get_template_directory_uri() . '/style.css', array(), $theme->Version );

	/* Load google fonts. */
	wp_enqueue_style( 'livre-fonts', livre_fonts_url(), array(), $theme->Version );

	/* Load main style.css */
	wp_enqueue_style( 'style', get_stylesheet_uri(), array(), $theme->Version );
	wp_enqueue_style( 'livre-style-main', LIVRE_THEME_ASSETS_URI . '/css/main.css', array(), $theme->Version );
	wp_enqueue_style( 'livre-style-font-icons', LIVRE_THEME_ASSETS_URI . '/css/font-icons.css', array(), $theme->Version );

	/* Load comment reply. */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' ); 
	}

	/* Load bundled jQuery. */ 
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-datepicker' );

	/* Load custom js plugins. */

	wp_enqueue_script( 'livre-gmaps3', LIVRE_THEME_ASSETS_URI . '/js/plugins/gmap3.js', array( 'jquery' ), $theme->Version, true );
	wp_enqueue_script( 'livre-isotope', LIVRE_THEME_ASSETS_URI . '/js/plugins/isotope.pkgd.min.js', array( 'jquery' ), $theme->Version, true );
	wp_enqueue_script( 'livre-final-countdown', LIVRE_THEME_ASSETS_URI . '/js/plugins/jquery.finalCountdown.min.js', array( 'jquery' ), $theme->Version, true );
	wp_enqueue_script( 'livre-flexslider', LIVRE_THEME_ASSETS_URI . '/js/plugins/jquery.flexslider.min.js', array( 'jquery' ), $theme->Version, true );
	wp_enqueue_script( 'livre-hoverintent', LIVRE_THEME_ASSETS_URI . '/js/plugins/jquery.hoverIntent.js', array( 'jquery' ), $theme->Version, true );
	wp_enqueue_script( 'livre-lazyload', LIVRE_THEME_ASSETS_URI . '/js/plugins/jquery.lazyload.min.js', array( 'jquery' ), $theme->Version, true );
	wp_enqueue_script( 'livre-sticky-kit', LIVRE_THEME_ASSETS_URI . '/js/plugins/jquery.sticky-kit.min.js', array( 'jquery' ), $theme->Version, true );
	wp_enqueue_script( 'livre-modernizr', LIVRE_THEME_ASSETS_URI . '/js/plugins/modernizr.js', array( 'jquery' ), $theme->Version, true );
	wp_enqueue_script( 'livre-scroll-magic', LIVRE_THEME_ASSETS_URI . '/js/plugins/ScrollMagic.min.js', array( 'jquery' ), $theme->Version, true );
	wp_enqueue_script( 'livre-slick', LIVRE_THEME_ASSETS_URI . '/js/plugins/slick.min.js', array( 'jquery' ), $theme->Version, true );
	//wp_enqueue_script( 'livre-smooth-scroll', LIVRE_THEME_ASSETS_URI . '/js/plugins/smoothscroll.js', array( 'jquery' ), $theme->Version, true );
	wp_enqueue_script( 'livre-social-share', LIVRE_THEME_ASSETS_URI . '/js/plugins/social-share.js', array( 'jquery' ), $theme->Version, true );
	wp_enqueue_script( 'livre-text-gradient', LIVRE_THEME_ASSETS_URI . '/js/plugins/text-gradient.js', array( 'jquery' ), $theme->Version, true );
	wp_enqueue_script( 'livre-venobox', LIVRE_THEME_ASSETS_URI . '/js/plugins/venobox.min.js', array( 'jquery' ), $theme->Version, true );

	/* Load custom js method. */
	wp_enqueue_script( 'livre-main', LIVRE_THEME_ASSETS_URI . '/js/main.js', array( 'jquery' ), $theme->Version, true );

	wp_localize_script( 'livre-main' , 'livre_translate', array(
		'days'		=> esc_html__( 'days', 'livre' ),
		'hr'		=> esc_html__( 'hr', 'livre' ),
		'min'		=> esc_html__( 'min', 'livre' ),
		'sec'		=> esc_html__( 'sec', 'livre' ),
	) );

	$accent_color = get_theme_mod( 'livre_accent_color', '#eb8367' );
	wp_localize_script( 'livre-main', 'livre_js_var',
		array( 
			'accent_color' => $accent_color,
		)
	);
}

add_action( 'wp_head', 'livre_customizer_print_out_css', 20 );
function livre_customizer_print_out_css() {
	$accent_color 				= get_theme_mod( 'livre_accent_color', '#eb8367' );
	$background_color 			= get_theme_mod( 'livre_body_color', '#f6f6f6' );
	$footer_background_color 	= get_theme_mod( 'livre_footer_color', '#ffffff' );
	$header_background_color 	= get_theme_mod( 'livre_header_color', '#ffffff' );
	$text_color     			= get_theme_mod( 'livre_text_color', '#616161' );
	// $heading-color    : #222; //#2B2B2B
	
	// Fonts
	$global_font_size  		=  get_theme_mod( 'livre_global_font_size', '16px' );
	$body_font  			=  get_theme_mod( 'livre_body_font', 'Roboto' );
	$heading_font 			=  get_theme_mod( 'livre_heading_font', 'Roboto' );

	$body_font_weight    	= get_theme_mod( 'livre_body_font_weight', '400' ); 
	$body_letter_spacing 	= get_theme_mod( 'livre_body_letter_spacing', '0' );
	$body_line_height    	= get_theme_mod( 'livre_body_line_height', '1.8' );

	$heading_font_weight 	= get_theme_mod( 'livre_heading_font_weight', 700 );
	$heading_letter_spacing = get_theme_mod( 'livre_heading_letter_spacing', 0 );

	// BUTTON COLORS
	$primary_button_color 			= get_theme_mod( 'livre_primary_button_color', '#eb8367' );
	$primary_button_hover_color 	= get_theme_mod( 'livre_primary_button_color_hover', '#eb8367' );
	$primary_button_text 			= get_theme_mod( 'livre_primary_button_text_color', '#ffffff' );

	$secondary_button_color 		= get_theme_mod( 'livre_secondary_button_color', '#b2dc71' );
	$secondary_button_hover_color	= get_theme_mod( 'livre_secondary_button_color_hover', '#b2dc71' );
	$secondary_button_text			= get_theme_mod( 'livre_secondary_button_text_color', '#ffffff' );

	// PAGE TITLE
	$page_title_color			= get_theme_mod( 'livre_page_title_color', '#222222' );

	// QUOTE 
	$quote_font = get_theme_mod( 'livre_quote_font', 'Sacramento' );

	// PRODUCT DESCRIPTION
	$product_description_font 		 = get_theme_mod( 'livre_product_description_font', 'Merriweather' );
	$product_description_font_size 	 = get_theme_mod( 'livre_product_description_font_size', '18' ).'px';

	$styles = '';
	$styles .="

		.product-overview__summary .woocommerce-product-details__short-description{
			font-family: $product_description_font;
			font-size: $product_description_font_size;
		}

		.hamburger-inner,
		.hamburger-inner::before, .hamburger-inner::after,
		.product-overview__summary .onsale{
			background-color : $accent_color;
		}
		.page-header-bg .bg:before{
			background-color : $accent_color;
		}
		.post-grid .post__inner:after, .post-masonry .post__inner:after,
		.hdr-widget--product-search .product-search-input .line,
		.user-auth-box .user-auth-box-content:before{
			background-color : $accent_color;
		}
		.menu-main-wrapper .menu > .menu-item a:before,
		.menu-user-wrap .menu> .menu-item a:after,
		.hdr-widget--menu-cart .menu-cart-trigger .cart-count,
		.hdr-widget-dropdown-menu .menu > .menu-item > a:before,
		.hdr-widget-dropdown-menu .sub-menu .menu-item a:before,
		.widget.widget_price_filter .price_slider.ui-slider .ui-slider-range{
			background-color : $accent_color;
		}
		.menu-main-wrapper .menu-item.mega-menu > .sub-menu .sub-menu a:after,
		.widget_search form input[type='submit'],
		.product-list .product__image .onsale,
		.wc_payment_methods.payment_methods .wc_payment_method label:after,
		.comment .reply a:after{
			background-color: $accent_color;
		}

		.product__detail-nav li.active a, .product__detail-nav li:hover a,
		.user-auth-box .user-auth-box-content .tokoo-popup__close,
		.wc_payment_methods.payment_methods .wc_payment_method label:before,
		.bypostauthor .comment-body,
		.bypostauthor .avatar
		{
			border-color: $accent_color;
		}
		.hdr-widget--site-logo a,
		.hdr-widget-dropdown-menu .menu-item:hover > a,
		.site-footer a,
		.product-list .product__price,.product-modern .product__action .ajax_add_to_cart,
		.widget.widget_price_filter .price_slider_amount .price_label span,
		.deal-tab-grid .deal-tab-nav li.active a{
			color: $accent_color;
		}

		.hdr-widget-dropdown-menu .sub-menu .menu-item a:before,
		.hdr-widget-dropdown-menu .menu > .menu-item > a:before,
		.product-modern .product__image a:after{
			background-color : $accent_color;
		}
		
		.product-grid .product__action .comment-respond .form-submit input, .comment-respond .form-submit .product-grid .product__action input, .product-grid .product__action .widget.widget_product_search input[type=\"submit\"], .widget.widget_product_search .product-grid .product__action input[type=\"submit\"],
		.added_to_cart.wc-forward,
		.product-grid .product__price,
		.product-overview .product-action .price,
		.product__detail-nav li.active a, .product__detail-nav li:hover a,
		.menu-main-wrapper .menu-item:not(.mega-menu) .sub-menu li:hover > a,
		.widget.widget_shopping_cart .quantity,
		.widget.widget_shopping_cart .total .amount,
		.product-grid .product__action .button,
		.menu-main-wrapper .menu > .menu-item:hover > a
		{ 
			color: $accent_color;
		}

		
		.tagcloud a,
		.section-header:after,
		.product-grid .product .onsale{
			background-color: $accent_color;
		}
		
		.widget.widget_product_search,
		.deal-tab-grid .deal-tab-nav li.active a {
			border-color: $accent_color;
		}
		
		.hdr-widget--menu-cart .menu-cart-trigger .cart-count,
		.star-rating span:before,
		.star-rating span:before,
		.single-post .post__meta a,
		.product-layout-view a:hover, .product-layout-view a.active,
		.post-grid .post__meta span a:hover, .post-masonry .post__meta span a:hover,
		.widget.widget_shopping_cart .quantity,
		.widget.widget_shopping_cart .total .amount,
		.post .post__content.entry-content a,
		{
			color: $accent_color;
		}

		
		body{
			font-family    : $body_font;
			font-size      : $global_font_size;
			font-weight    : $body_font_weight;
			letter-spacing : $body_letter_spacing;
			line-height    : $body_line_height;
			background-color: $background_color;
			color: $text_color;
		}
		
		.site-header{
			background-color: $header_background_color;
		}

		.site-footer__colophon{
			background-color: $footer_background_color;
		}
		
		h1,h2,h3,h4,h5,h6,
		.single-post .post__title,
		.widget-title,
		.page-header .page-title{
			font-family: $heading_font;
			font-weight    : $heading_font_weight;
			letter-spacing : $heading_letter_spacing;
		}

		.page-header .page-title{
			color: $page_title_color
		}
	
		button,.button,input[type='button'],input[type='submit']{
			background-color: $primary_button_color;
			color: $primary_button_text;
		}
		button:hover,.button:hover,input[type='button']:hover,input[type='submit']:hover{
			background-color: $primary_button_hover_color;
		}
		
		.button.button--secondary,input[type='reset'],.button.checkout{
			background-color: $secondary_button_color;
			color: $secondary_button_text;
		}
		.button.button--secondary:hover,input[type='reset']:hover,.button.checkout:hover{
			background-color: $secondary_button_hover_color;
		}
		
	";

	$styles = "\n".'<style type="text/css">'.trim( $styles ).'</style>'."\n";
	printf( '%s', $styles );
}

