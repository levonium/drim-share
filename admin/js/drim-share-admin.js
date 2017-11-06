(function( $ ) {
	// 'use strict';

	$(document).ready(function(){
		// change the button styles on select change
		$(".ds_icon_set_select").change(function(){
			var type = 'ds_type_icon';
			if ( $(this).val().indexOf('ds_image') != -1 ) {
				type = 'ds_type_image';
			}
			var changeClass = "ds_wrapper ds_align_left ds_no_brdr ds_no_heading " + type + " " + $(this).val();
			$(this).parent().parent().find(".ds_wrapper").attr( "class", changeClass );
		});

		// show/hide whatsapp icon on checkbox change
		$("#ds_network_whatsapp").change(function(){
			var check = $(this).prop( "checked" );
			if ( true === check ) {
				$(".ds_whatsapp").addClass("ds_active");
			} else {
				$(".ds_whatsapp").removeClass("ds_active");
			}
		});

		// change text color on plugin enable/dispale
		$("#ds_plugin_enable").change(function(){
			var enabled = $(this).prop( "checked" );
			if ( true === enabled ) {
				$(".onoff").attr("class", "onoff ds_enabled");
			} else {
				$(".onoff").attr("class", "onoff ds_disabled");
			}
		});

		// open/close icon set image
		$(document).on("click touchstart",".set_open",function(){
			$(".ds_icon_set").fadeIn("slow");
			$("body").css( "overflow", "hidden");
		});
		$(document).on("click touchstart",".set_close",function(){
			ds_icon_set_popup_close();
		});
		$(document).on("click touchstart", function(event) {
				if(!$(event.target).closest(".set_open").length && !$(event.target).closest(".ds_icon_set").length) {
						if($(".ds_icon_set").is(":visible")) {
								ds_icon_set_popup_close();
						}
				}
		});
		$(document).on("keyup",function(e) {
			if (e.keyCode == 27) {
				ds_icon_set_popup_close();
			}
		});

	});

	function ds_icon_set_popup_close() {
		$(".ds_icon_set").fadeOut( "slow" );
		$("body").css( "overflow", "initial");
	}

})( jQuery );
