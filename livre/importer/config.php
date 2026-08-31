<?php 

/**
 * Demo content
 *
 * @return void
 * @author Alispx
 **/
add_filter( 'pt-ocdi/import_files', 'livre_config_import_files' );
function livre_config_import_files() {
	
	return array(
		array(
			'import_file_name'           => 'Livre Books',
			'categories'                 => array( 'Category 1', 'Category 2' ),
			'import_file_url'            => 'http://import.tokomoo.com/tokoo-demo-content/livre/books/content.xml',
			'import_widget_file_url'     => 'http://import.tokomoo.com/tokoo-demo-content/livre/books/widgets.json',
			'import_customizer_file_url' => 'http://import.tokomoo.com/tokoo-demo-content/livre/books/customizer.txt',
			'import_preview_image_url'   => 'http://import.tokomoo.com/tokoo-demo-content/livre/books/screenshot.png',
			'preview_url'                => 'http://www.demo.tokomoo.com/livre/books',
			'import_home_page'              => 'Homepage Livre v1',
			'import_blog_page'              => 'Blog',
			'import_available_menus'        => array(
				'livre-primary'   		=> 'Main Menu', // Menu Location and Title
			)
		),
		array(
		),
	);
}
