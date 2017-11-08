(function( $ ) {
	// 'use strict';

	$(document).ready(function(){

		// show/hide whatsapp icon on checkbox change
		$("#ds_network_whatsapp").change(function(){
			var check = $(this).prop( "checked" );
			if ( true === check ) {
				$(".ds_whatsapp").addClass("ds_active");
			} else {
				$(".ds_whatsapp").removeClass("ds_active");
			}
		});

		// change text color on plugin enable/disable
		$("#ds_plugin_enable").change(function(){
			var enabled = $(this).prop( "checked" );
			if ( true === enabled ) { $(".onoff").attr("class", "onoff ds_enabled"); }
			else { $(".onoff").attr("class", "onoff ds_disabled"); }
		});

		// update the type/shape/style values for examples block
		$("#ds_button_type").change(function(){
			var type = $(this).val();
			$("#ds_example .ds_bttn").removeClass( "ds_icon ds_text ds_mixed" );
			$("#ds_example .ds_bttn").addClass( "ds_" + type );

			if ( type == 'mixed' ){
				$("#ds_example .ds_bttn svg").wrap('<span class="anchor-item"></span>');
				$("#ds_example .ds_bttn .ds_network_name").wrap('<span class="anchor-item"></span>');
				$("#ds_example .ds_bttn").each(function(){
					$(this).find(".anchor-item").wrapAll('<div class="anchor-grid"></div>');
				});
			} else {
				if ( $("#ds_example .ds_bttn svg").parent().is("span") ) { $("#ds_example .ds_bttn svg").unwrap(); }
				if ( $("#ds_example .ds_bttn svg").parent().is("div") ) { $("#ds_example .ds_bttn svg").unwrap(); }
				if ( $("#ds_example .ds_bttn .ds_network_name").parent().is("span") ) { $("#ds_example .ds_bttn .ds_network_name").unwrap(); }
			}
		});
		$("#ds_shape").change(function(){
			$("#ds_example .ds_bttn").removeClass( "ds_square ds_circle ds_round" );
			$("#ds_example .ds_bttn").addClass( "ds_" + $(this).val() );
		});

		$("#ds_icon_set").change(function(){
			var options = $("#ds_icon_set option");
			options.each(function(){
				$("#ds_example .ds_bttn").removeClass( $(this).val() );
			});
			var style = $(this).val();
			$("#ds_example .ds_bttn").addClass( style );
		});

	});

	// show/hide help/images popup
	$(document).on("click touchstart", ".q_open", function() {
		$(".ds_help_popup").fadeIn("slow", function(){
			$(this).css( "display", "grid" );
		});
		$("body").css( "overflow", "hidden" );
		var imageName = $(this).attr("data-open");
		var images = $(".ds_help_popup img");
		images.each(function(){
			if ( $(this).hasClass( "ds_" + imageName ) ) {
				$(this).addClass( "ds_active" );
			} else {
				$(this).removeClass( "ds_active" );
			}
		});
	});
	$(document).on("click touchstart", ".q_close", function() {
		$(".ds_help_popup").fadeOut("slow");
		$("body").css( "overflow", "inherit" );
	});
	$(document).on("click touchstart", function(event) {
		if(!$(event.target).closest('.q_open').length && !$(event.target).closest('.ds_help_popup img').length ) {
			if($('.ds_help_popup').is(":visible")) {
				$('.ds_help_popup').fadeOut("slow");
				$("body").css( "overflow", "inherit" );
			}
		}
	});

})( jQuery );
