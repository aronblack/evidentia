<?php

return array(

	/*
	* Edit this file to add widget sidebars to your theme.
	* Place WordPress default settings for sidebars.
	* Add as many as you want, watch-out your commas!
	*/
 	array(

		'name'			=> esc_html__( 'Primary', 'livre' ),
		'id'			=> 'livre-primary',
		'description'	=> esc_html__( 'Area of primary sidebar', 'livre' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>'
	),
	array(
		'name'			=> esc_html__( 'Footer One', 'livre' ),
		'id'			=> 'livre-footer-1',
		'description'	=> esc_html__( 'Widget Area of Footer First column', 'livre' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>'
	),

	array(
		'name'			=> esc_html__( 'Footer Two', 'livre' ),
		'id'			=> 'livre-footer-2',
		'description'	=> esc_html__( 'Widget Area of Footer Second column', 'livre' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>'
	),

	array(
		'name'			=> esc_html__( 'Footer Three', 'livre' ),
		'id'			=> 'livre-footer-3',
		'description'	=> esc_html__( 'Widget Area of Footer Third column', 'livre' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>'
	),

	array(
		'name'			=> esc_html__( 'Footer Four', 'livre' ),
		'id'			=> 'livre-footer-4',
		'description'	=> esc_html__( 'Widget Area of Footer Fourth column', 'livre' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>'
	),

);