<?php

/**
 * The Template for displaying sidebar primary
 *
 * @author 		tokoo
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$get_sidebar_columns 	= get_theme_mod( 'livre_sidebar_footer_columns', 2 );
switch ( $get_sidebar_columns ) {
	case '3':
			$columns = 'col-md-4';
		break;
	case '4':
			$columns = 'col-md-3';
		break;
	default:
			$columns = 'col-md-6';
		break;
}
?>

<?php if ( is_active_sidebar( 'livre-footer-1' ) || is_active_sidebar( 'livre-footer-2' ) || is_active_sidebar( 'livre-footer-3' ) || is_active_sidebar( 'livre-footer-4' ) ) : ?>

	<div class="site-footer__widget-area">
		<div class="container">
			<div class="grid-layout">

				<?php $counter = 1; ?>
				<?php while ( $counter <= $get_sidebar_columns ) : ?>
					<?php if ( is_active_sidebar( "livre-footer-{$counter}" ) ) : ?>
						<div class="grid-item <?php echo esc_attr( $columns ); ?>">
							<?php dynamic_sidebar( "livre-footer-{$counter}" ); ?>
						</div><!-- footer-<?php echo esc_attr( $counter ); ?> -->
					<?php endif; ?>

				<?php $counter++; endwhile; ?>

			</div>
		</div>
	</div>

<?php endif; ?>