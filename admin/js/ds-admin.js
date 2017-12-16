(function( $ ) {
	// 'use strict';

	$( document ).ready(
		function(){

			// change text color on plugin enable/disable
			$( "#ds_plugin_enable" ).change(
				function(){
					var enabled = $( this ).prop( "checked" );
					if ( true === enabled ) {
						$( ".onoff" ).attr( "class", "onoff ds_enabled" ); } else {
						$( ".onoff" ).attr( "class", "onoff ds_disabled" ); }
				}
			);

			// update the type/shape/style values for examples block
			$( "#ds_icon_type" ).change(
				function(){
					var type = $( this ).val();
					$( "#ds_example .ds_bttn" ).removeClass( "ds_icon ds_text ds_mixed" );
					$( "#ds_example .ds_bttn" ).addClass( "ds_" + type );

					if ( type == 'mixed' ) {
						$( "#ds_example" ).removeClass( "ds_align_center" );
						$( "#ds_example .ds_bttn svg" ).wrap( '<span class="anchor-item"></span>' );
						$( "#ds_example .ds_bttn .ds_network_name" ).wrap( '<span class="anchor-item"></span>' );
						$( "#ds_example .ds_bttn" ).each(
							function(){
								$( this ).find( ".anchor-item" ).wrapAll( '<div class="anchor-grid"></div>' );
							}
						);
					} else {
						$( "#ds_example" ).addClass( "ds_align_center" );
						if ( $( "#ds_example .ds_bttn svg" ).parent().is( "span" ) ) {
							$( "#ds_example .ds_bttn svg" ).unwrap(); }
						if ( $( "#ds_example .ds_bttn svg" ).parent().is( "div" ) ) {
							$( "#ds_example .ds_bttn svg" ).unwrap(); }
						if ( $( "#ds_example .ds_bttn .ds_network_name" ).parent().is( "span" ) ) {
							$( "#ds_example .ds_bttn .ds_network_name" ).unwrap(); }
					}
				}
			);

			$( "#ds_icon_shape" ).change(
				function(){
					$( "#ds_example .ds_bttn" ).removeClass( "ds_square ds_circle ds_round" );
					$( "#ds_example .ds_bttn" ).addClass( "ds_" + $( this ).val() );
				}
			);

			$( "#ds_icon_style" ).change(
				function(){
					var options = $( "#ds_icon_style option" );
					options.each(
						function(){
							$( "#ds_example .ds_bttn" ).removeClass( $( this ).val() );
						}
					);
					var style = $( this ).val();
					$( "#ds_example .ds_bttn" ).addClass( style );
				}
			);

		}
	);

})( jQuery );
