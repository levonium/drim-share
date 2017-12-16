<?php
/**
 * Drim Share Social Networks
 *
 * @package    Drim_Share
 * @subpackage Drim_Share/admin/partials
 *
 * @link  https://drim.io/drim-share/
 * @since 1.0.1
 */

/**
 * Drim Share Networks Selection
 *
 * @since 1.0.1
 *
 * @package    Drim_Share
 * @subpackage Drim_Share/admin/partials
 *
 * @param string $networks_selected list of comma-separated selected social networks.
 */
function ds_select_networks( $networks_selected ) {

	// all available networks : array ( facebook => Facebook ).
	// this function is declared in drim_share-admin-functions.php file.
	$all_networks = ds_get_available_social_networks();

	// selected networks.
	$selected_networks_string = '';
	$selected_networks        = [];

	if ( $networks_selected && '' !== $networks_selected ) {
		$selected_networks_string = sanitize_text_field( $networks_selected );
		$selected_networks        = explode( ',', $selected_networks_string );
	}

	// not select networks.
	$not_selected_networks = array_diff( array_keys( $all_networks ), $selected_networks );

	printf(
		'<input type="hidden" id="ds_networks_" name="drim_share_settings_options[ds_networks_]" value="%s" />',
		esc_html( $selected_networks_string )
	);
	?>

	<div id="dsAllNetworks" class="list-group">

		<?php print_icons( $not_selected_networks ); ?>

	</div>

	<p> Drag the icons here and reorder.</p>

	<div id="dsSelectedNetworks" class="list-group">

		<?php
		if ( ! empty( $selected_networks ) ) {

			print_icons( $selected_networks );

		}
		?>

	</div>

	<p> * WhatsApp is visible on smaller screens only.</p>

	<script type="text/javascript">
		Sortable.create(dsAllNetworks, {
			group: {
				name: 'dsAllNetworks',
				sort: false,
				put: 'dsSelectedNetworks',
				pull: 'dsSelectedNetworks'
			},
			animation: 100
		});

		Sortable.create(dsSelectedNetworks, {
			group: {
				name: 'dsSelectedNetworks',
				put: 'dsAllNetworks',
				pull: 'dsAllNetworks'
			},
			animation: 100,
			onSort: function (/**Event*/evt) {
				var items = jQuery("#dsSelectedNetworks").find("span.list-group-item");
				var order = [];
				items.each(function(){
					order.push( jQuery(this).attr("id") );
				});
				jQuery("#ds_networks_").val(order);
			},
		});
	</script>
	<?php
}

/**
 * Prints network icons for selection
 *
 * @since 1.0.1
 *
 * @package    Drim_Share
 * @subpackage Drim_Share/admin/partials
 *
 * @param array $networks array of social network names.
 */
function print_icons( $networks ) {

	// get the svg icons file.
	include_once dirname( dirname( __FILE__ ) ) . '/inc/svg-functions.php';

	foreach ( $networks as $network ) {
	?>

		<span class="list-group-item ds_ex_icon ds_<?php echo esc_html( $network ); ?>" id="<?php echo esc_html( $network ); ?>"> 
			<?php echo ds_get_svg( array( 'icon' => 'ds_' . esc_html( $network ) ) ); ?>
		</span>

	<?php
	}
}
