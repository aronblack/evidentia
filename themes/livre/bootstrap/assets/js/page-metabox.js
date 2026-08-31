(function( $ ) {
  "use strict";

	/* Page Templates Metabox */

	$("select#page_template").change(function(){
		$( "select#page_template option:selected").each(function(){
			switch($(this).attr("value")) {

				case "templates/archive.php" :
					$("#postdivrich").show();
					$("#commentstatusdiv").hide();
					$("#postimagediv").hide();
					$("#livre_page_details").show();
					$("#livre_contact_maps").hide();
				break;

				case "templates/contact.php" :
					$("#postdivrich").show();
					$("#livre_contact_maps").show();
					$("#commentstatusdiv").hide();
					$("#postimagediv").hide();
					$("#livre_page_details").show();
					$("#commentsdiv").hide();
				break;

				case "templates/blog.php" :
					$("#postdivrich").hide();
					$("#commentstatusdiv").hide();
					$("#postimagediv").hide();
					$("#livre_page_details").show();
					$("#livre_contact_maps").hide();
				break;

				default :
					$("#postdivrich").show();
					$("#commentstatusdiv").show();
					$("#postimagediv").show();
					$("#theme-layouts-post-meta-box").show();
					$("#livre_page_details").show();
					$("#livre_contact_maps").hide();
			}
		});
	}).change();

	/* End of Page Templates Metabox */

		var authors_metabox 		= $("#book_authordiv");
		var publishers_metabox 		= $("#book_publisherdiv");
		var series_metabox 			= $("#book_seriesdiv");
		var backcover_image_metabox = $("#BackCoverImage");
		var movie_metabox 			= $("#wcbs_movie_details");
		var audio_metabox 			= $("#wcbs_audio_details");
		var game_metabox 			= $("#wcbs_game_details");
		var custom_image 			= $("#livre_product_image_dimension");


	/* Product Type Metabox */
	$("input:radio[name=wcbs-product-type]").change(function(){
		$( "input:radio[name=wcbs-product-type]:checked").each(function(){
			switch($(this).attr("value")) {

				case "book" :
					authors_metabox.fadeIn();
					publishers_metabox.fadeIn();
					series_metabox.fadeIn();
					backcover_image_metabox.fadeIn();
					custom_image.fadeIn();
					movie_metabox.hide();
					audio_metabox.hide();
					game_metabox.hide();

				break;

				case "audio" :
					audio_metabox.fadeIn();
					authors_metabox.hide();
					publishers_metabox.hide();
					series_metabox.hide();
					backcover_image_metabox.hide();
					movie_metabox.hide();
					game_metabox.hide();
					custom_image.hide();

				break;

				case "movie" :
					movie_metabox.fadeIn();
					audio_metabox.hide();
					authors_metabox.hide();
					publishers_metabox.hide();
					series_metabox.hide();
					backcover_image_metabox.hide();
					game_metabox.hide();
					custom_image.hide();

				break;

				case "game" :
					movie_metabox.hide();
					audio_metabox.hide();
					authors_metabox.hide();
					publishers_metabox.hide();
					series_metabox.hide();
					backcover_image_metabox.hide();
					game_metabox.fadeIn();
					custom_image.hide();
				break;

				default :
					movie_metabox.hide();
					audio_metabox.hide();
					authors_metabox.hide();
					publishers_metabox.hide();
					series_metabox.hide();
					backcover_image_metabox.hide();
					game_metabox.hide();
					custom_image.hide();
				break;
			}
		});
	}).change();

	/* End of Page Templates Metabox */

}(jQuery));

