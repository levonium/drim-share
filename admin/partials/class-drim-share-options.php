<?php
/**
 * Plugin admin options page
 *
 * @package    Drim_Share
 * @subpackage Drim_Share/admin/partials
 *
 * @link  https://drim.io/drim-share/
 * @since 1.0.0
 */

/**
 * Plugin options
 *
 * @package    Drim_Share
 * @subpackage Drim_Share/admin/partials
 */
class Drim_Share_Options {

	/**
	 * Initialize the class.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		add_action( 'admin_init', array( $this, 'drim_share_options_page_init' ) );
		add_action( 'admin_menu', array( $this, 'drim_share_register_admin_options_page' ) );
	}

	/**
	 * Get icon types.
	 *
	 * @since    1.0.1
	 */
	public function get_icon_types() {

		$_icon_types = [
			'icon'  => __( 'Icon Only', 'drim-share' ),
			'text'  => __( 'Text Only', 'drim-share' ),
			'mixed' => __( 'Icon & Text', 'drim-share' ),
		];

		return $_icon_types;
	}

	/**
	 * Get icon shapes.
	 *
	 * @since    1.0.1
	 */
	public function get_icon_shapes() {

		$_icon_shapes = [
			'square' => __( 'Square', 'drim-share' ),
			'round'  => __( 'Round', 'drim-share' ),
			'circle' => __( 'Circle', 'drim-share' ),
		];

		return $_icon_shapes;
	}

	/**
	 * Get icon styles.
	 *
	 * @since    1.0.1
	 */
	public function get_icon_styles() {

		$_icon_styles = [
			'ds_default'      => __( 'Default', 'drim-share' ),
			'ds_shadow'       => __( 'Outer Shadow', 'drim-share' ),
			'ds_shadow_inset' => __( 'Inner Shadow', 'drim-share' ),
			'ds_grey_default' => __( 'Grey & Corolful', 'drim-share' ),
			'ds_grey_white'   => __( 'Grey & White', 'drim-share' ),
			'ds_grey_black'   => __( 'Grey & Black', 'drim-share' ),
			'ds_black'        => __( 'Black & White', 'drim-share' ),
			'ds_white'        => __( 'White & Black', 'drim-share' ),
			'ds_nobg_default' => __( 'Simple Colorful', 'drim-share' ),
			'ds_nobg_white'   => __( 'Simple White', 'drim-share' ),
			'ds_nobg_black'   => __( 'Simple Black', 'drim-share' ),
		];

		return $_icon_styles;
	}

	/**
	 * Register admin options page.
	 */
	public function drim_share_register_admin_options_page() {

		// get plugin nice name.
		$drim      = new Drim_Share();
		$drim_name = $drim->get_plugin_nice_name();

		add_menu_page(
			$drim_name,
			$drim_name,
			'manage_options',
			'drim_share_options',
			array( $this, 'drim_share_ui' ),
			'dashicons-share-alt2',
			99
		);
	}

	/**
	 * Structure the admin options page
	 */
	public function drim_share_ui() {

		// get plugin nice name.
		$drim      = new Drim_Share();
		$drim_name = $drim->get_plugin_nice_name();

		$this->options = get_option( 'drim_share_settings_options' ); ?>

		<div class="wrap">
			<h1 class="wp-heading">
				<?php echo esc_html( $drim_name ); ?>
			</h1>

			<div class="ds_grid">
				<div class="ds_wrap ds_part_left">

					<form method="post" action="options.php">
						<?php
						settings_fields( 'drim_share_settings' );
						do_settings_sections( 'drim_share_options' );

						submit_button();
						?>
					</form>
				</div>

				<div class="ds_wrap ds_part_right">
					<?php include_once 'drim-share-admin-display-sidebar.php'; ?>
				</div>
			</div>

		</div><!-- .wrap -->

		<?php
	}

	/**
	 * Register and add settings
	 */
	public function drim_share_options_page_init() {

		// include settings fileds file.
		include_once 'drim-share-settings-fields.php';

		/*
		* Register Plugin Settings
		*/
		register_setting(
			'drim_share_settings',
			'drim_share_settings_options',
			array( $this, 'ds_validate_input_fields' )
		);

		// main settings section.
		add_settings_section(
			$dss_main_section[0],
			$dss_main_section[1],
			array( $this, 'print_' . $dss_main_section[0] . '_section_info' ),
			'drim_share_options'
		);

		foreach ( $dss_main as $settings_field_main ) {

			add_settings_field(
				$settings_field_main[0],
				$settings_field_main[1],
				array( $this, $settings_field_main[0] . '_callback' ),
				'drim_share_options',
				$dss_main_section[0]
			);

		}

		// content are settings section.
		add_settings_section(
			$dss_content_section[0],
			$dss_content_section[1],
			array( $this, 'print_' . $dss_content_section[0] . '_section_info' ),
			'drim_share_options'
		);

		foreach ( $dss_content as $settings_field_content ) {

			add_settings_field(
				$settings_field_content[0],
				$settings_field_content[1],
				array( $this, $settings_field_content[0] . '_callback' ),
				'drim_share_options',
				$dss_content_section[0]
			);

		}

		// fixed bars settings section.
		add_settings_section(
			$dss_fixed_section[0],
			$dss_fixed_section[1],
			array( $this, 'print_' . $dss_fixed_section[0] . '_section_info' ),
			'drim_share_options'
		);

		foreach ( $dss_fixed as $settings_field_fixed ) {

			add_settings_field(
				$settings_field_fixed[0],
				$settings_field_fixed[1],
				array( $this, $settings_field_fixed[0] . '_callback' ),
				'drim_share_options',
				$dss_fixed_section[0]
			);

		}

	}


	/**
	 * Validate and sanitize input fields
	 *
	 * @param string $input options name.
	 */
	public function ds_validate_input_fields( $input ) {

		// Create our array for storing the validated options.
		$output = array();

		// Loop through each of the incoming options.
		foreach ( $input as $key => $value ) {

			// Check to see if the current option has a value. If so, process it.
			if ( isset( $input[ $key ] ) ) {

				// Strip all HTML and PHP tags and properly handle quoted strings.
				$output[ $key ] = strip_tags( stripslashes( $input[ $key ] ) );

			}
		}

		// Return the array processing any additional functions filtered by this action.
		return apply_filters( 'ds_validate_input_fields', $output, $input );

	}


	/**
	 * Print the MAIN Section Content
	 */
	public function print_ds_settings_main_section_info() {
		printf(
			'<p>' . esc_html__( 'Adjust general plugin settings here.', 'drim-share' ) . '</p>'
		);
	}


	/**
	 * Enable/Disable Drim Share Buttons callback function
	 */
	public function ds_plugin_enable_callback() {

		$ds_opt      = isset( $this->options['ds_plugin_enable'] ) ? esc_attr( $this->options['ds_plugin_enable'] ) : '';
		$label_class = ( $ds_opt ) ? 'ds_enabled' : 'ds_disabled';

		printf(
			'<input type="checkbox" id="ds_plugin_enable" name="drim_share_settings_options[ds_plugin_enable]" value="1" %1$s />
    		<label class="onoff %2$s" for="ds_plugin_enable">' . esc_html__( 'Enable', 'drim-share' ) . '</label>',
			checked( 1, $ds_opt, false ),
			esc_html( $label_class )
		);

		echo '<p class="description">' . esc_html__( 'Check the box to enable the plugin.', 'drim-share' ) . '</p>';
	}


	/**
	 * Social networks selection field callback function
	 */
	public function ds_networks_callback() {

		$networks = '';
		if ( isset( $this->options['ds_networks_'] ) && '' !== $this->options['ds_networks_'] ) {
			$networks = sanitize_text_field( $this->options['ds_networks_'] );
		}

		include_once dirname( __FILE__ ) . '/drim-share-networks.php';
		ds_select_networks( $networks );

	}


	/******
	 * ***********************************************************
	 ******/


	/**
	 * Print the Content Section Content
	 */
	public function print_ds_content_settings_section_info() {
		printf(
			'<p>' . esc_html__( 'Adjust options for icons in content area.', 'drim-share' ) . '</p>'
		);
	}

	/**
	 * Buttons positions for content area
	 */
	public function ds_position_content_callback() {

		// get the svg icons file.
		include_once dirname( dirname( __FILE__ ) ) . '/inc/svg-functions.php';

		$ds_opt = isset( $this->options['ds_position_content'] ) ? esc_attr( $this->options['ds_position_content'] ) : 'none';
		?>
		<select class="regular-text" id="ds_position_content" name="drim_share_settings_options[ds_position_content]">
			<option value="none" <?php selected( $ds_opt, 'none' ); ?>> <?php esc_html_e( 'None', 'drim-share' ); ?> </option>
			<option value="above" <?php selected( $ds_opt, 'above' ); ?>> <?php esc_html_e( 'Above the content', 'drim-share' ); ?> </option>
			<option value="below" <?php selected( $ds_opt, 'below' ); ?>> <?php esc_html_e( 'Below the content', 'drim-share' ); ?> </option>
			<option value="both" <?php selected( $ds_opt, 'both' ); ?>> <?php esc_html_e( 'Both', 'drim-share' ); ?> </option>
		</select>
		<?php
	}

	/**
	 * Content Area Button Types selection callback function
	 */
	public function ds_icon_type_callback() {

		$ds_opt             = isset( $this->options['ds_icon_type'] ) ? esc_attr( $this->options['ds_icon_type'] ) : 'icon';
		?>
		<select class="regular-text" id="ds_icon_type" name="drim_share_settings_options[ds_icon_type]">
			<?php
			$select_options = $this->get_icon_types();
			foreach ( $select_options as $option => $value ) {
				echo '<option value="' . esc_html( $option ) . '" ' . selected( $ds_opt, $option ) . '> ' . esc_html( $value ) . '</option>';
			}
			?>
		</select>

		<?php
	}

	/**
	 * Content Area Button Shapes selection callback function
	 */
	public function ds_icon_shape_callback() {

		$ds_opt             = isset( $this->options['ds_icon_shape'] ) ? esc_attr( $this->options['ds_icon_shape'] ) : 'square';
		?>
		<select class="regular-text" id="ds_icon_shape" name="drim_share_settings_options[ds_icon_shape]">
			<?php
			$select_options = $this->get_icon_shapes();
			foreach ( $select_options as $option => $value ) {
				echo '<option value="' . esc_html( $option ) . '" ' . selected( $ds_opt, $option ) . '> ' . esc_html( $value ) . '</option>';
			}
			?>
		</select>

		<?php
		echo '<p class="description">' . esc_html__( '* Circle shape works only with "Icon Only" button type.', 'drim-share' ) . '</p>';

	}

	/**
	 * Content Area Buttons styles selection field callback function
	 */
	public function ds_icon_style_callback() {

		$ds_opt             = isset( $this->options['ds_icon_style'] ) ? esc_attr( $this->options['ds_icon_style'] ) : '';
		?>
		<select class="regular-text ds_icon_style_select" id="ds_icon_style" name="drim_share_settings_options[ds_icon_style]">
			<?php
			$select_options = $this->get_icon_styles();
			foreach ( $select_options as $option => $value ) {
				echo '<option value="' . esc_html( $option ) . '" ' . selected( $ds_opt, $option ) . '> ' . esc_html( $value ) . '</option>';
			}
			?>
		</select>

		<?php
		// include preview section.
		include_once 'drim-share-admin-display-icons.php';
	}


	/**
	 * Padding between social buttons field callback function
	 */
	public function ds_icons_padding_callback() {

		printf(
			'<div class="input-group">
    		<input type="number" class="regular-text" id="ds_icons_padding" name="drim_share_settings_options[ds_icons_padding]" value="%s" />
    		<span class="prepend"> px </span>
    		</div>',
			isset( $this->options['ds_icons_padding'] ) ? intval( $this->options['ds_icons_padding'] ) : 6
		);
		echo '<p class="description">' . esc_html__( 'Padding between icons (px).', 'drim-share' ) . '</p>';

	}

	/**
	 * Buttons Sizes callback function
	 */
	public function ds_icons_size_callback() {

		printf(
			'<div class="input-group">
    		<input type="number" class="regular-text" id="ds_icons_size" name="drim_share_settings_options[ds_icons_size]" value="%s" />
    		<span class="prepend"> &percnt; </span>
    		</div>',
			isset( $this->options['ds_icons_size'] ) ? intval( $this->options['ds_icons_size'] ) : 100
		);
		echo '<p class="description">' . esc_html__( 'Adjust the text and icon sizes.', 'drim-share' ) . '</p>';

	}


	/**
	 * Mixed Icons spliting into 2 lines callback function
	 */
	public function ds_mixed_icons_split_callback() {

		printf(
			'<div class="input-group">
    		<input type="number" class="regular-text" id="ds_mixed_icons_split" name="drim_share_settings_options[ds_mixed_icons_split]" value="%s" />
    		<span class="prepend"> = </span>
    		</div>',
			isset( $this->options['ds_mixed_icons_split'] ) ? intval( $this->options['ds_mixed_icons_split'] ) : 0
		);
		echo '<p class="description">' . esc_html__( 'Enter how many icons you\'d like to display in a line.', 'drim-share' ) . '</p>';

	}


	/**
	 * Mixed Icons hiding some network names callback function
	 */
	public function ds_mixed_icons_shorten_callback() {

		$ds_opt = isset( $this->options['ds_mixed_icons_shorten'] ) ? esc_attr( $this->options['ds_mixed_icons_shorten'] ) : '';

		printf(
			'<input type="checkbox" id="ds_mixed_icons_shorten" name="drim_share_settings_options[ds_mixed_icons_shorten]" value="1" %s/>
    		<label for="ds_mixed_icons_shorten">' . esc_html__( 'Display only 2 first network names.', 'drim-share' ) . '</label>',
			checked( 1, $ds_opt, false )
		);
		echo '<p class="description">' . esc_html__( '* For "Icon & Text" button type only.', 'drim-share' ) . '</p>';
		echo '<p class="description">' . esc_html__( '* This will remove the option to split into lines.', 'drim-share' ) . '</p>';

	}


	/**
	 * Sharing block alignment callback function
	 */
	public function ds_style_align_callback() {

		$ds_opt = isset( $this->options['ds_style_align'] ) ? esc_attr( $this->options['ds_style_align'] ) : '';
		?>
		<select class="regular-text" id="ds_style_align" name="drim_share_settings_options[ds_style_align]">
			<option value="ds_align_left"> <?php esc_html_e( 'Left', 'drim-share' ); ?> </option>
			<option value="ds_align_center" <?php selected( $ds_opt, 'ds_align_center' ); ?>> <?php esc_html_e( 'Center', 'drim-share' ); ?> </option>
			<option value="ds_align_right" <?php selected( $ds_opt, 'ds_align_right' ); ?>> <?php esc_html_e( 'Right', 'drim-share' ); ?> </option>
		</select>

		<?php
	}


	/**
	 * Sharing block borders callback function
	 */
	public function ds_style_borders_callback() {

		$ds_opt = isset( $this->options['ds_style_borders'] ) ? esc_attr( $this->options['ds_style_borders'] ) : '';
		?>
		<select class="regular-text" id="ds_style_borders" name="drim_share_settings_options[ds_style_borders]">
			<option value=""> <?php esc_html_e( 'No Line', 'drim-share' ); ?> </option>
			<option value="ds_brdr_top" <?php selected( $ds_opt, 'ds_brdr_top' ); ?>> <?php esc_html_e( 'Top Line', 'drim-share' ); ?> </option>
			<option value="ds_brdr_bottom" <?php selected( $ds_opt, 'ds_brdr_bottom' ); ?>> <?php esc_html_e( 'Bottom Line', 'drim-share' ); ?> </option>
			<option value="ds_brdr_both" <?php selected( $ds_opt, 'ds_brdr_both' ); ?>> <?php esc_html_e( 'Top & Bottom Lines', 'drim-share' ); ?> </option>
		</select>
		<?php
		echo '<p class="description">' . esc_html__( 'Choose if you want to separate the buttons from the content with lines.', 'drim-share' ) . '</p>';

		echo '<br />';

		printf(
			'<input type="text" class="regular-text" id="ds_style_border_color" name="drim_share_settings_options[ds_style_border_color]" value="%s" />',
			isset( $this->options['ds_style_border_color'] ) ? esc_attr( $this->options['ds_style_border_color'] ) : ''
		);
		echo '<p class="description">' . esc_html__( 'Line color (RGB, HEX values or color names). Leave empty to use your theme colors.', 'drim-share' ) . '</p>';
	}

	/**
	 * Heading before social buttons field callback function
	 */
	public function ds_heading_callback() {

		printf(
			'<input type="text" class="regular-text" id="ds_heading" name="drim_share_settings_options[ds_heading]" value="%s" />',
			isset( $this->options['ds_heading'] ) ? esc_attr( $this->options['ds_heading'] ) : ''
		);
		echo '<p class="description">' . esc_html__( 'Heading for the buttons. Leave empty for no heading.', 'drim-share' ) . '</p>';

	}


	/**
	 * Mobile Content Area Buttons callback function
	 */
	public function ds_position_content_mobile_callback() {

		$ds_opt = isset( $this->options['ds_position_content_mobile'] ) ? esc_attr( $this->options['ds_position_content_mobile'] ) : '';

		printf(
			'<input type="checkbox" id="ds_position_content_mobile" name="drim_share_settings_options[ds_position_content_mobile]" value="1" %s/>
    		<label for="ds_position_content_mobile">' . esc_html__( 'Hide sharing buttons in content area on mobile devices.', 'drim-share' ) . '</label>',
			checked( 1, $ds_opt, false )
		);
		echo '<p class="description">' . esc_html__( 'Once enabled the buttons will not be displayed on sreens smaller than 720px.', 'drim-share' ) . '</p>';

	}


	/**
	 * Post types: post field callback function
	 */
	public function ds_post_types_callback() {

		include_once dirname( __FILE__ ) . '/drim-share-post-types.php';
		ds_get_post_types();

	}


	/******
	 * ***********************************************************
	 ******/


	/**
	 * Print the Fixed Bars Section Content
	 */
	public function print_ds_fixed_settings_section_info() {
		echo '<p>';
		esc_html_e( 'Adjust options for icons in fixed bars.', 'drim-share' );
		echo '</p>';
	}

	/**
	 * Fixed Bars position callback function
	 */
	public function ds_position_sticky_callback() {

		$ds_opt = isset( $this->options['ds_position_sticky'] ) ? esc_attr( $this->options['ds_position_sticky'] ) : 'none';
		?>
		<select class="regular-text" id="ds_position_sticky" name="drim_share_settings_options[ds_position_sticky]">
			<option value="none" <?php selected( $ds_opt, 'none' ); ?>> <?php esc_html_e( 'None', 'drim-share' ); ?> </option>
			<option value="left" <?php selected( $ds_opt, 'left' ); ?>> <?php esc_html_e( 'Left', 'drim-share' ); ?> </option>
			<option value="right" <?php selected( $ds_opt, 'right' ); ?>> <?php esc_html_e( 'Right', 'drim-share' ); ?> </option>
		</select> 

		<?php
	}

	/**
	 * Content Area Button Shapes selection callback function
	 */
	public function ds_icon_shape_fixed_callback() {

		$ds_opt             = isset( $this->options['ds_icon_shape_fixed'] ) ? esc_attr( $this->options['ds_icon_shape_fixed'] ) : 'square';
		?>
		<select class="regular-text" id="ds_icon_shape_fixed" name="drim_share_settings_options[ds_icon_shape_fixed]">
			<?php
			$select_options = $this->get_icon_shapes();
			foreach ( $select_options as $option => $value ) {
				echo '<option value="' . esc_html( $option ) . '" ' . selected( $ds_opt, $option ) . '> ' . esc_html( $value ) . '</option>';
			}
			?>
		</select>

		<?php
	}

	/**
	 * Content Area Buttons styles selection field callback function
	 */
	public function ds_icon_style_fixed_callback() {

		// get the svg icons file.
		include_once dirname( dirname( __FILE__ ) ) . '/inc/svg-functions.php';

		$ds_opt             = isset( $this->options['ds_icon_style_fixed'] ) ? esc_attr( $this->options['ds_icon_style_fixed'] ) : '';
		?>
		<select class="regular-text ds_icon_style_fixed_select" id="ds_icon_style_fixed" name="drim_share_settings_options[ds_icon_style_fixed]">
			<?php
			$select_options = $this->get_icon_styles();
			foreach ( $select_options as $option => $value ) {
				echo '<option value="' . esc_html( $option ) . '" ' . selected( $ds_opt, $option ) . '> ' . esc_html( $value ) . '</option>';
			}
			?>
		</select>

		<?php
	}

	/**
	 * Padding between social buttons field callback function
	 */
	public function ds_icons_fixed_padding_callback() {

		printf(
			'<div class="input-group">
    		<input type="number" class="regular-text" id="ds_icons_fixed_padding" name="drim_share_settings_options[ds_icons_fixed_padding]" value="%s" />
    		<span class="prepend"> px </span>
    		</div>',
			isset( $this->options['ds_icons_fixed_padding'] ) ? intval( $this->options['ds_icons_fixed_padding'] ) : 0
		);
		echo '<p class="description">' . esc_html__( 'Padding between icons (px).', 'drim-share' ) . '</p>';

	}

	/**
	 * Buttons Sizes callback function
	 */
	public function ds_icons_fixed_size_callback() {

		printf(
			'<div class="input-group">
    		<input type="number" class="regular-text" id="ds_icons_fixed_size" name="drim_share_settings_options[ds_icons_fixed_size]" value="%s" />
    		<span class="prepend"> &percnt; </span>
    		</div>',
			isset( $this->options['ds_icons_fixed_size'] ) ? intval( $this->options['ds_icons_fixed_size'] ) : 100
		);
		echo '<p class="description">' . esc_html__( 'Adjust the icon sizes.', 'drim-share' ) . '</p>';

	}

	/**
	 * Mobile Fixed Buttons callback function
	 */
	public function ds_position_sticky_mobile_callback() {

		$ds_opt = isset( $this->options['ds_position_sticky_mobile'] ) ? esc_attr( $this->options['ds_position_sticky_mobile'] ) : '';

		printf(
			'<input type="checkbox" id="ds_position_sticky_mobile" name="drim_share_settings_options[ds_position_sticky_mobile]" value="1" %s/>
    		<label for="ds_position_sticky_mobile">' . esc_html__( 'Hide sharing buttons in content area on mobile devices.', 'drim-share' ) . '</label>',
			checked( 1, $ds_opt, false )
		);
		echo '<p class="description">' . esc_html__( 'Once enabled the buttons will not be displayed on sreens smaller than 720px.', 'drim-share' ) . '</p>';

	}

	/**
	 * Mobile Fixed & Full Buttons callback function
	 */
	public function ds_position_sticky_mobile_full_callback() {

		$ds_opt = isset( $this->options['ds_position_sticky_mobile_full'] ) ? esc_attr( $this->options['ds_position_sticky_mobile_full'] ) : '';

		printf(
			'<input type="checkbox" id="ds_position_sticky_mobile_full" name="drim_share_settings_options[ds_position_sticky_mobile_full]" value="1" %s/>
    		<label for="ds_position_sticky_mobile_full">' . esc_html__( 'Display stretched fixed bar on smaller screens.', 'drim-share' ) . '</label>',
			checked( 1, $ds_opt, false )
		);
		echo '<p class="description">' . esc_html__( '* The previous option should be disabled in order this one to affect.', 'drim-share' ) . '</p>';

	}

}

if ( is_admin() ) {
	$drim_share_settings_settings = new Drim_Share_Options();
}
