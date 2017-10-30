(function( $ ) {
	'use strict';

	$(document).ready(function(){
		// change the button styles on select change
		$(".drim_share_style_select").change(function(){
			var changeClass = "ds_wrapper ds_align_left ds_no_brdr ds_no_heading " + $(this).val();
			$(this).parent().parent().find(".ds_wrapper").attr( "class", changeClass );
		});

		// show/hide whatsapp icon on checkbox change
		$("#drim_share_mobile_icons_whatsapp").change(function(){
			var check = $(this).prop( "checked" );
			if ( true === check ) {
				$(".ds_whatsapp").addClass("ds_active");
			} else {
				$(".ds_whatsapp").removeClass("ds_active");
			}
		});

		// change text color on plugin enable/dispale
		$("#drim_share_enable_buttons").change(function(){
			var enabled = $(this).prop( "checked" );
			if ( true === enabled ) {
				$(".onoff").attr("class", "onoff ds_enabled");
			} else {
				$(".onoff").attr("class", "onoff ds_disabled");
			}
		});


/*
		// add classes to .foem-table tables
		var tables = $(".form-table");
		var i = 0;
		tables.each(function(){
			i++;
			$(this).addClass("table_" + i);
		});
*/

	});


})( jQuery );
