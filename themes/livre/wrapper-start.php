<?php

/**
 * Content Wrappers "open div"
 *
 * @author 		tokoo
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<main class="main-content <?php livre_wrapper_class_handles(); ?>">
	<div class="container">
		<?php if ( livre_is_has_sidebar() ) : ?>
			<div class="row">
		<?php endif; ?>

 