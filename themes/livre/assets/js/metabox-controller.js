(function( $ ) {
  "use strict";

	/* Post Format Status dedicated Metabox */

	// define var for metabox
	var status_metabox = $("#livre_embedded_link");

	// check initial state, if Status already selected, show the Metabox
	var post_format_radio = $("input:radio[name=post_format]:checked").val();
	check_post_format_state( 'status', status_metabox, post_format_radio );

	// do the thing while one of the radio is clicked
	$("input:radio[name=post_format]").click(function() {
		check_post_format_state( 'status', status_metabox, $(this).val() );
	});

	/* End of Post Format Status dedicated Metabox */

	/* Page Templates Metabox */

	$("select#page_template").change(function(){
		$( "select#page_template option:selected").each(function(){
			switch($(this).attr("value")) {

				case "templates/archive.php" :
					$("#postdivrich").show();
					$("#commentstatusdiv").hide();
					$("#postimagediv").hide();
					// $("#theme-layouts-post-meta-box").show();
					$("#livre_page_details").hide();
					$("#livre_contact_maps").hide();
					$("#livre_portfolio_details").hide();
				break;

				case "templates/contact.php" :
					$("#postdivrich").show();
					$("#livre_contact_maps").show();
					$("#commentstatusdiv").hide();
					$("#postimagediv").hide();
					// $("#theme-layouts-post-meta-box").hide();
					$("#livre_page_details").hide();
					$("#commentsdiv").hide();
					$("#livre_portfolio_details").hide();
				break;

				case "templates/blog.php" :
					$("#postdivrich").hide();
					$("#commentstatusdiv").hide();
					$("#postimagediv").hide();
					$("#livre_page_details").show();
					$("#livre_portfolio_details").hide();
					$("#livre_contact_maps").hide();
				break;

				case "templates/portfolios.php" :
					$("#postdivrich").show();
					$("#commentstatusdiv").hide();
					$("#postimagediv").hide();
					$("#livre_page_details").show();
					$("#livre_portfolio_details").show();
					$("#livre_contact_maps").hide();
				break;

				case "templates/fullwidth.php" :
					$("#postdivrich").show();
					$("#commentstatusdiv").hide();
					$("#postimagediv").hide();
					$("#livre_page_details").show();
					$("#livre_portfolio_details").hide();
					$("#livre_contact_maps").hide();
				break;

				default :
					$("#postdivrich").show();
					$("#commentstatusdiv").show();
					$("#postimagediv").show();
					$("#theme-layouts-post-meta-box").show();
					$("#livre_page_details").show();
					$("#livre_contact_maps").hide();
					$("#livre_portfolio_details").hide();
			}
		});
	}).change();

	/* End of Page Templates Metabox */

}(jQuery));

/**
 * Simplified function for Show/Hide Post Format Status special Metabox
 */
function check_post_format_state( format, metabox, check_var  ) {
	if ( format == check_var ) {
		metabox.fadeIn();
	} else {
		metabox.hide();
	}
}