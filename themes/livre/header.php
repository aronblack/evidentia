<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Livre
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div class="site-content">
		
	<?php 
		$page_id 				= get_queried_object_id();
		$page_details 			= get_post_meta(  $page_id, 'livre_page_details', true );
		$disable_header 		= ! empty( $page_details['disable_header'] ) ? $page_details['disable_header'] : 0;  	
		$global_header_type 	= get_theme_mod( 'livre_header_type', 'type_1' );
		$header_type			= ! empty( $page_details['header_type'] ) ? $page_details['header_type'] : $global_header_type;

		if ( 0 == $disable_header ) : ?>

			<?php if ( 'type_2' == $header_type ) : ?>
				<?php get_header( 'type-2' ); ?>
			<?php else : ?>
				<?php get_header( 'type-1' ); ?>
			<?php endif ?>
			
			<?php get_template_part( 'loop-meta' ); ?>
	
		<?php endif; ?>
