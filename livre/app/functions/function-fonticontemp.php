<?php 

add_action( 'media_buttons', 'livre_add_my_media_button', 15 );
function livre_add_my_media_button() {
    echo '<span class="tokoo-iconpicker-wrap"><a href="#" class="button tokoo-iconpicker-shortcode">'.esc_html__( 'Livre Icon', 'livre' ).'</a></span>';
}

/**
 * Load widgets js
 *
 * @return void
 * @author tokoo
 **/
add_action( 'admin_enqueue_scripts', 'livre_fi_shortcodes_scripts' );
function livre_fi_shortcodes_scripts() {
	wp_enqueue_script( 'livre_fi_shortcodes', LIVRE_THEME_URI . '/assets/js/fi-shortcodes.js', array( 'jquery' ), '', true );
	wp_enqueue_style( 'livre_fi_shortcodes', LIVRE_THEME_URI . '/assets/fonts/livre-icons/style.css' );
	wp_enqueue_style( 'livre_fi_shortcodes_admin', LIVRE_THEME_URI . '/bootstrap/assets/css/admin.css' );
}

/**
 * Load widgets js
 *
 * @return void
 * @author tokoo
 **/
add_action( 'wp_enqueue_scripts', 'livre_fi_shortcodes_scripts_front' );
function livre_fi_shortcodes_scripts_front() {
	wp_enqueue_style( 'livre_fi_shortcodes', LIVRE_THEME_URI . '/assets/fonts/livre-icons/style.css' );
}