<?php

/**
 * Template Name: Contact
 *
 * The Template for page template contact
 *
 * @author 		tokoo
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header(); ?>

	<?php 
		/**
		 * livre_before_main_content hook
		 *
		 * @hooked tokoo_wrapper_start - 10 (outputs opening divs for the content)
		 */
		do_action( 'livre_before_main_content' );
	 ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	 	<div class="container">
			<div class="content page-contact">
				<div class="entry-content">
					
					<?php 
						$maps_data 		= livre_get_meta( '_contact_maps' ); 
						$map_location 	= ! empty( $maps_data['map_iframe'] ) ? $maps_data['map_iframe'] : '';
						$map_height 	= ! empty( $maps_data['map_height'] ) ? $maps_data['map_height'] : '';
					?>

					

					<div class="contact-map default-map-height">
					<?php
					$map_width = '100%';
					if ( ! $map_height) {
						$map_height = '350px';
					}

					$map_location = preg_replace( array('/width="\d+"/i', '/height="\d+"/i'), array(
						sprintf('width="%s"', $map_width ),
						sprintf('height="%d"', intval( $map_height ))
					),
				   	$map_location );
					echo '' . $map_location;
					?>
					</div>

					<div class="row">

						<div class="col-md-6">
							<?php if ( class_exists( 'Tokoo_Vitamins' ) ) : ?>
							
								<div class="contact-detail">

									<?php if ( isset( $maps_data['address'] ) && ! empty( $maps_data['address'] ) ) : ?>
										<address class="address">
											<i class="fa fa-map-marker icon"></i>
											<?php echo wpautop( $maps_data['address'] ); ?>
										</address><!-- .contact-address -->
									<?php endif; ?>

									<?php if ( isset( $maps_data['phone_number'] ) && ! empty( $maps_data['phone_number'] ) ) : ?>
										<div class="phone">
											<i class="fa fa-phone"></i>
											<a href="tel:<?php echo esc_attr( $maps_data['phone_number'] ); ?>" class="has-icon">
												<?php printf( $maps_data['phone_number'] ); ?>
											</a>
										</div><!-- .contact-phone -->
									<?php endif; ?>
 
								</div>

								<hr class="separator m40">

								<?php if ( isset( $maps_data['tagline'] ) && ! empty( $maps_data['tagline'] ) ) : ?>
									<div class="entry-content">
										<?php printf( $maps_data['tagline'] ); ?>
									</div><!-- .entry-content -->
								<?php endif; ?>

								<?php the_content(); ?>

							<?php else: ?>

								<p><?php esc_html_e( 'Please activate Tokoo Vitamins extension in order to use this page template.', 'livre' ); ?></p>

							<?php endif; ?>
						</div>
						<div class="col-md-6">

							<?php if ( class_exists( 'WPCF7_ContactForm' ) ) { ?>
								<?php if ( ! empty( $maps_data['contact_form'] ) ) : ?>
									<?php 
										echo do_shortcode( '[contact-form-7 id="'.$maps_data['contact_form'].'"]' );
									 ?>
								<?php endif; ?>
							<?php } else {
								comments_template();
								} ?>
						</div>

					</div>

				</div><!-- .entry-content -->
			</div><!-- .content -->
		</div><!-- .post-content -->

	</div>

	<?php
		/**
		 * livre_after_main_content hook
		 *
		 * @hooked tokoo_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'livre_after_main_content' );
	 ?>

<?php get_footer(); ?>