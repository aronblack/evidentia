<?php

/**
 * The Template for displaying menu primary
 *
 * @author 		tokoo
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
	
<div class="hdr-widget hdr-widget--menu-main open-<?php echo get_theme_mod( 'livre_menu_opening_method', 'onclick' ); ?>">
	<button class="no-ui menu-main-toggle hamburger hamburger--elastic" type="button"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button>
	<div class="menu-main-wrapper">
		
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

		<div class="menu-background">
			<div class="menu-main-background"></div>
			<div class="sub-bg-container"></div>
		</div>

	</div>
</div>