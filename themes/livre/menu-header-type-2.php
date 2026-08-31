<?php

/**
 * The Template for displaying menu primary
 *
 * @author 		tokoo
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
	
<div class="hdr-widget hdr-widget--menu-main hdr-widget-dropdown-menu">
	<div class="menu-main-dropdown">
		<?php if ( has_nav_menu( 'livre-primary' ) ) : 

			$menu_args = array(
				'theme_location' => 'livre-primary',
				'container'      => false
			);

			if ( class_exists( 'Tokoo_Megamenus_Walker' ) )
				$menu_args['walker'] = new Tokoo_Megamenus_Walker;

			wp_nav_menu( $menu_args );

		else : ?>

			<ul class="menu">
				<?php wp_list_pages( array( 'depth' => 1,'sort_column' => 'menu_order','title_li' => '', 'include'  => 2 ) ) ?>
			</ul>
			
		<?php endif; ?>
	</div>

</div>