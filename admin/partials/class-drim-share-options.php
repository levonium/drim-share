<?php
/**
 * Plugin admin options page
 *
 * @link       https://drim.io/drim-share/
 * @since      1.0.0
 *
 * @package    Drim_Share
 * @subpackage Drim_Share/admin/partials
 */

class Drim_Share_Options {

	private $options;

	public function __construct() {
		add_action( 'admin_init', array( $this, 'drim_share_options_page_init' ) );
		add_action( 'admin_menu', array( $this, 'drim_share_register_admin_options_page' ) );
	}

	public function get_plugin_options() {

		return $this->options;

	}

	/**
	 * Register admin options page
	 *
	 */
	public function drim_share_register_admin_options_page() {

		// get plugin nice name
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

	public function drim_share_ui() {

		// get plugin nice name
		$drim      = new Drim_Share();
		$drim_name = $drim->get_plugin_nice_name();

		$this->options = get_option( 'drim_share_settings_options' ); ?>

	   <div class="wrap">
	   <h1 class="wp-heading">
			<?php echo $drim_name; ?>
	   </h1>

	   <div class="ds_grid">
		 <div class="ds_wrap ds_part_left">

		   <form method="post" action="options.php">
				<?php
				// This prints out all hidden setting fields
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

		<?php include_once 'drim-share-admin-display-help.php'; ?>

	 </div><!-- .wrap -->

		<?php
	}

	/**
	 * Register and add settings
	 */
	public function drim_share_options_page_init() {

		// include settings fileds file
		require_once 'drim-share-settings-fields.php';

		/*
	 	* Register Plugin Settings
		*/
		register_setting(
			'drim_share_settings', // Option group
			'drim_share_settings_options', // Option name
			array( $this, 'ds_validate_input_fields' ) // Sanitize
		);

		// main settings section
		add_settings_section(
			$dss_main_section[0], // ID
			$dss_main_section[1], // Title
			array( $this, 'print_' . $dss_main_section[0] . '_section_info' ), // Callback
			'drim_share_options' // Page
		);

		foreach ( $dss_main as $settings_field_main ) {

			add_settings_field(
				$settings_field_main[0], // ID
				$settings_field_main[1], // Title
				array( $this, $settings_field_main[0] . '_callback' ), // Callback
				'drim_share_options', // Page
				$dss_main_section[0] // Section
			);

		}

		// examples settings section
		add_settings_section(
			$dss_examples_section[0], // ID
			$dss_examples_section[1], // Title
			array( $this, 'print_' . $dss_examples_section[0] . '_section_info' ), // Callback
			'drim_share_options' // Page
		);

		// position settings section
		add_settings_section(
			$dss_position_section[0], // ID
			$dss_position_section[1], // Title
			array( $this, 'print_' . $dss_position_section[0] . '_section_info' ), // Callback
			'drim_share_options' // Page
		);

		foreach ( $dss_position as $settings_field_position ) {

			add_settings_field(
				$settings_field_position[0], // ID
				$settings_field_position[1], // Title
				array( $this, $settings_field_position[0] . '_callback' ), // Callback
				'drim_share_options', // Page
				$dss_position_section[0] // Section
			);

		}

		// mobile settings section
		add_settings_section(
			$dss_mobile_section[0], // ID
			$dss_mobile_section[1], // Title
			array( $this, 'print_' . $dss_mobile_section[0] . '_section_info' ), // Callback
			'drim_share_options' // Page
		);

		foreach ( $dss_mobile as $settings_field_mobile ) {

			add_settings_field(
				$settings_field_mobile[0], // ID
				$settings_field_mobile[1], // Title
				array( $this, $settings_field_mobile[0] . '_callback' ), // Callback
				'drim_share_options', // Page
				$dss_mobile_section[0] // Section
			);

		}

		// post types settings section
		add_settings_section(
			$dss_post_types_section[0], // ID
			$dss_post_types_section[1], // Title
			array( $this, 'print_' . $dss_post_types_section[0] . '_section_info' ), // Callback
			'drim_share_options' // Page
		);

		foreach ( $dss_post_types as $settings_field_post_types ) {

			add_settings_field(
				$settings_field_post_types[0], // ID
				$settings_field_post_types[1], // Title
				array( $this, $settings_field_post_types[0] . '_callback' ), // Callback
				'drim_share_options', // Page
				$dss_post_types_section[0] // Section
			);

		}

		// optional settings section
		add_settings_section(
			$dss_optional_section[0], // ID
			$dss_optional_section[1], // Title
			array( $this, 'print_' . $dss_optional_section[0] . '_section_info' ), // Callback
			'drim_share_options' // Page
		);

		foreach ( $dss_optional as $settings_field_optional ) {

			add_settings_field(
				$settings_field_optional[0], // ID
				$settings_field_optional[1], // Title
				array( $this, $settings_field_optional[0] . '_callback' ), // Callback
				'drim_share_options', // Page
				$dss_optional_section[0] // Section
			);

		}

	}


	/**
	 * Validate and sanitize input fields
	 *
	 */
	function ds_validate_input_fields( $input ) {

		// Create our array for storing the validated options
		$output = array();

		// Loop through each of the incoming options
		foreach ( $input as $key => $value ) {

			// Check to see if the current option has a value. If so, process it.
			if ( isset( $input[ $key ] ) ) {

				// Strip all HTML and PHP tags and properly handle quoted strings
				$output[ $key ] = strip_tags( stripslashes( $input[ $key ] ) );

			} // end if
		} // end foreach

		// Return the array processing any additional functions filtered by this action
		return apply_filters( 'ds_validate_input_fields', $output, $input );

	}


	/**
	 * Print the MAIN Section Content
	 */
	function print_ds_settings_main_section_info() {
		printf(
			'<p>' . __( 'Adjust general plugin settings here.', 'drim-share' ) . '</p>'
		);
	}


	/**
	 * Enable/Disable Drim Share Buttons callback function
	 */
	function ds_plugin_enable_callback() {

		$ds_opt      = isset( $this->options['ds_plugin_enable'] ) ? esc_attr( $this->options['ds_plugin_enable'] ) : '';
		$label_class = ( $ds_opt ) ? 'ds_enabled' : 'ds_disabled';

		printf(
			'<input type="checkbox" id="ds_plugin_enable" name="drim_share_settings_options[ds_plugin_enable]" value="1" %1$s />
			<label class="onoff %2$s" for="ds_plugin_enable">' . __( 'Enable', 'drim-share' ) . '</label>',
			checked( 1, $ds_opt, false ),
			$label_class
		);

		echo '<p class="description">' . __( 'Check the box to enable the plugin.', 'drim-share' ) . '</p>';
	}


	/**
	 * Social networks selection field callback function
	 */
	function ds_networks_callback() {

		// this function is declared in drim_share-admin-functions.php file
		$ds_networks = ds_get_available_social_networks();

		foreach ( $ds_networks as $ds_network => $ds_network_name ) {

			$ds_opt = isset( $this->options[ 'ds_networks_' . $ds_network ] ) ? esc_attr( $this->options[ 'ds_networks_' . $ds_network ] ) : '';

			printf(
				'<p><input type="checkbox" id="ds_networks_%1$s" name="drim_share_settings_options[ds_networks_%1$s]" value="1" %2$s />
				<label for="ds_networks_%1$s"> %3$s </label></p>',
				$ds_network,
				checked( 1, $ds_opt, false ),
				$ds_network_name
			);
		}
		echo '<p class="description">' . __( 'Choose the social networks.', 'drim-share' ) . '</p>';
	}


	/**
	 * Whatsapp button on mobile devices callback function
	 */
	function ds_network_whatsapp_callback() {

		$ds_opt = isset( $this->options['ds_network_whatsapp'] ) ? esc_attr( $this->options['ds_network_whatsapp'] ) : '';

		printf(
			'<input type="checkbox" id="ds_network_whatsapp" name="drim_share_settings_options[ds_network_whatsapp]" value="1" %s />
			<label for="ds_network_whatsapp">  ' . __( 'Include WhatsApp button on mobile devices.', 'drim-share' ) . '</label>',
			checked( 1, $ds_opt, false )
		);

	}

	/**
	 * Button Shapes selection callback function
	 */
	function ds_shape_callback() {

		$ds_opt = isset( $this->options['ds_shape'] ) ? esc_attr( $this->options['ds_shape'] ) : 'square';
		?>
		<select class="regular-text" id="ds_shape" name="drim_share_settings_options[ds_shape]">
		  <option value="square" <?php selected( $ds_opt, 'square' ); ?>> <?php _e( 'Square', 'drim-share' ); ?> </option>
		  <option value="round" <?php selected( $ds_opt, 'round' ); ?>> <?php _e( 'Round', 'drim-share' ); ?> </option>
		  <option value="circle" <?php selected( $ds_opt, 'circle' ); ?>> <?php _e( 'Circle', 'drim-share' ); ?> </option>
		</select>
		<?php
		echo '<p class="description">' . __( 'Choose the button shape.', 'drim-share' ) . '</p>';
		echo '<p class="description">' . __( '* Circle icons work only with "Icon Only" button type.', 'drim-share' ) . '</p>';

	}

	/**
	 * Button Types selection callback function
	 */
	function ds_button_type_callback() {

		$ds_opt = isset( $this->options['ds_button_type'] ) ? esc_attr( $this->options['ds_button_type'] ) : 'icon';
		?>
		<select class="regular-text" id="ds_button_type" name="drim_share_settings_options[ds_button_type]">
		  <option value="icon" <?php selected( $ds_opt, 'icon' ); ?>> <?php _e( 'Icon Only', 'drim-share' ); ?> </option>
		  <option value="text" <?php selected( $ds_opt, 'text' ); ?>> <?php _e( 'Text Only', 'drim-share' ); ?> </option>
		  <option value="mixed" <?php selected( $ds_opt, 'mixed' ); ?>> <?php _e( 'Icon & Text', 'drim-share' ); ?> </option>
		</select>
		<?php
		echo '<p class="description">' . __( 'Choose the button type.', 'drim-share' ) . '</p>';
	}


	/**
	 * Social buttons styles selection field callback function
	 */
	function ds_icon_set_callback() {

		// get the svg icons file
		include_once dirname( dirname( __FILE__ ) ) . '/inc/svg-functions.php';

		$ds_opt = isset( $this->options['ds_icon_set'] ) ? esc_attr( $this->options['ds_icon_set'] ) : '';
		?>
		<select class="regular-text ds_icon_set_select" id="ds_icon_set" name="drim_share_settings_options[ds_icon_set]">
		  <option value="ds_default" <?php selected( $ds_opt, 'ds_default' ); ?>> <?php _e( 'Default', 'drim-share' ); ?> </option>
		  <option value="ds_shadow" <?php selected( $ds_opt, 'ds_shadow' ); ?>> <?php _e( 'Outer Shadow', 'drim-share' ); ?> </option>
		  <option value="ds_shadow_inset" <?php selected( $ds_opt, 'ds_shadow_inset' ); ?>> <?php _e( 'Inner Shadow', 'drim-share' ); ?> </option>
		  <option value="ds_grey_default" <?php selected( $ds_opt, 'ds_grey' ); ?>> <?php _e( 'Grey & Corolful', 'drim-share' ); ?> </option>
		  <option value="ds_grey_white" <?php selected( $ds_opt, 'ds_grey_white' ); ?>> <?php _e( 'Grey & White', 'drim-share' ); ?> </option>
		  <option value="ds_grey_black" <?php selected( $ds_opt, 'ds_grey_black' ); ?>> <?php _e( 'Grey & Black', 'drim-share' ); ?> </option>
		  <option value="ds_black" <?php selected( $ds_opt, 'ds_black' ); ?>> <?php _e( 'Black & White', 'drim-share' ); ?> </option>
		  <option value="ds_white" <?php selected( $ds_opt, 'ds_white' ); ?>> <?php _e( 'White & Black', 'drim-share' ); ?> </option>
		  <option value="ds_nobg_default" <?php selected( $ds_opt, 'ds_nobg_default' ); ?>> <?php _e( 'Simple Colorful', 'drim-share' ); ?> </option>
		  <option value="ds_nobg_white" <?php selected( $ds_opt, 'ds_nobg_white' ); ?>> <?php _e( 'Simple White', 'drim-share' ); ?> </option>
		  <option value="ds_nobg_black" <?php selected( $ds_opt, 'ds_nobg_black' ); ?>> <?php _e( 'Simple Black', 'drim-share' ); ?> </option>
		</select>
		<?php
		echo '<p class="description">' . __( 'Choose the button style.', 'drim-share' ) . '</p>';
	}



	/******
	************************************************************
	******/


	/**
	 * Print the Examples Section Content
	 */
	function print_ds_icon_examples_section_info() {
		include_once 'drim-share-admin-display-icons.php';
	}


	/******
	************************************************************
	******/


	/**
	 * Print the Position Section Content
	 */
	function print_ds_settings_position_section_info() {
		printf(
			'<p>' . __( 'Choose where to display sharing buttons.', 'drim-share' ) . '</p>'
		);
	}


	/**
	 * IN CONTENT BUTTONS
	 */
	function ds_position_content_callback() {

		$ds_opt = isset( $this->options['ds_position_content'] ) ? esc_attr( $this->options['ds_position_content'] ) : 'none';
		?>
		<select class="regular-text" id="ds_position_content" name="drim_share_settings_options[ds_position_content]">
		  <option value="none" <?php selected( $ds_opt, 'none' ); ?>> <?php _e( 'None', 'drim-share' ); ?> </option>
		  <option value="above" <?php selected( $ds_opt, 'above' ); ?>> <?php _e( 'Above the content', 'drim-share' ); ?> </option>
		  <option value="below" <?php selected( $ds_opt, 'below' ); ?>> <?php _e( 'Below the content', 'drim-share' ); ?> </option>
		  <option value="both" <?php selected( $ds_opt, 'both' ); ?>> <?php _e( 'Both', 'drim-share' ); ?> </option>
		</select> <span class="q_open" data-open="in_content"> <?php echo ds_get_svg( array( 'icon' => 'question' ) ); ?> </span>
		<?php
	}

	/**
	 * STICKY BAR BUTTONS
	 */
	function ds_position_sticky_callback() {

		$ds_opt = isset( $this->options['ds_position_sticky'] ) ? esc_attr( $this->options['ds_position_sticky'] ) : 'none';
		?>
		<select class="regular-text" id="ds_position_sticky" name="drim_share_settings_options[ds_position_sticky]">
		  <option value="none" <?php selected( $ds_opt, 'none' ); ?>> <?php _e( 'None', 'drim-share' ); ?> </option>
		  <option value="left" <?php selected( $ds_opt, 'left' ); ?>> <?php _e( 'Left', 'drim-share' ); ?> </option>
		  <option value="right" <?php selected( $ds_opt, 'right' ); ?>> <?php _e( 'Right', 'drim-share' ); ?> </option>
		</select> <span class="q_open" data-open="fixed"> <?php echo ds_get_svg( array( 'icon' => 'question' ) ); ?> </span>
		<?php
	}


	/******
	************************************************************
	******/


	/**
	 * Print the Position on Mobile Section Content
	 */
	function print_ds_settings_mobile_section_info() {
		echo '<p>';
		_e( 'Choose where to display sharing buttons on mobile devices.', 'drim-share' );
		echo '</p>';
	}


	/**
	 * Mobile In Content Buttons callback function
	 */
	function ds_position_content_mobile_callback() {

		$ds_opt = isset( $this->options['ds_position_content_mobile'] ) ? esc_attr( $this->options['ds_position_content_mobile'] ) : '';

		printf(
			'<input type="checkbox" id="ds_position_content_mobile" name="drim_share_settings_options[ds_position_content_mobile]" value="1" %1$s/>
			<label for="ds_position_content_mobile">' . __( 'Display buttons inside the content area on mobile devices.', 'drim-share' ) . '</label>
			<span class="q_open" data-open="in_content_mobile"> %2$s </span>',
			checked( 1, $ds_opt, false ),
			ds_get_svg( array( 'icon' => 'question' ) )
		);

	}

	/**
	 * Mobile Fixed Buttons callback function
	 */
	function ds_position_sticky_mobile_callback() {

		$ds_opt = isset( $this->options['ds_position_sticky_mobile'] ) ? esc_attr( $this->options['ds_position_sticky_mobile'] ) : '';

		printf(
			'<input type="checkbox" id="ds_position_sticky_mobile" name="drim_share_settings_options[ds_position_sticky_mobile]" value="1" %1$s/>
			<label for="ds_position_sticky_mobile">' . __( 'Display buttons fixed bar on mobile devices.', 'drim-share' ) . '</label>
			<span class="q_open" data-open="fixed_mobile"> %2$s </span>',
			checked( 1, $ds_opt, false ),
			ds_get_svg( array( 'icon' => 'question' ) )
		);

	}

	/**
	 * Mobile Fixed & Full Buttons callback function
	 */
	function ds_position_sticky_mobile_full_callback() {

		$ds_opt = isset( $this->options['ds_position_sticky_mobile_full'] ) ? esc_attr( $this->options['ds_position_sticky_mobile_full'] ) : '';

		printf(
			'<input type="checkbox" id="ds_position_sticky_mobile_full" name="drim_share_settings_options[ds_position_sticky_mobile_full]" value="1" %1$s/>
			<label for="ds_position_sticky_mobile_full">' . __( 'Display stretched fixed bar on mobile devices.', 'drim-share' ) . '</label>
			<span class="q_open" data-open="full_mobile"> %2$s </span>',
			checked( 1, $ds_opt, false ),
			ds_get_svg( array( 'icon' => 'question' ) )
		);

	}



	/******
	************************************************************
	******/



	/**
	 * Print the Post Types Section Content
	 */
	function print_ds_settings_post_types_section_info() {

		printf(
			'<p>' . __( 'Choose in which post types to include the sharing buttons in the content area.', 'drim-share' ) . '
			<br />' . __( '* Fixed Bars are displayed on all post/page types.', 'drim-share' ) . '</p>'
		);
	}

	/**
	 * Post types: post field callback function
	 */
	function ds_post_type_post_callback() {

		$ds_opt = isset( $this->options['ds_post_type_post'] ) ? esc_attr( $this->options['ds_post_type_post'] ) : '';

		printf(
			'<input type="checkbox" id="ds_post_type_post" name="drim_share_settings_options[ds_post_type_post]" value="1" %s/>
			<label for="ds_post_type_post">' . __( 'Enable', 'drim-share' ) . '</label>',
			checked( 1, $ds_opt, false )
		);

	}

	/**
	 * Post types: page field callback function
	 */
	function ds_post_type_page_callback() {

		$ds_opt = isset( $this->options['ds_post_type_page'] ) ? esc_attr( $this->options['ds_post_type_page'] ) : '';

		printf(
			'<input type="checkbox" id="ds_post_type_page" name="drim_share_settings_options[ds_post_type_page]" value="1" %s/>
			<label for="ds_post_type_page">' . __( 'Enable', 'drim-share' ) . '</label>',
			checked( 1, $ds_opt, false )
		);

	}


	/**
	 * Post types: homepage field callback function
	 */
	function ds_post_type_page_home_callback() {

		$ds_opt = isset( $this->options['ds_post_type_page_home'] ) ? esc_attr( $this->options['ds_post_type_page_home'] ) : '';

		printf(
			'<input type="checkbox" id="ds_post_type_page_home" name="drim_share_settings_options[ds_post_type_page_home]" value="1" %s/>
			<label for="ds_post_type_page_home">' . __( 'Enable', 'drim-share' ) . '</label>',
			checked( 1, $ds_opt, false )
		);

	}



	/**
	 * Post types: archive page field callback function
	 */
	function ds_post_type_page_archive_callback() {

		$ds_opt = isset( $this->options['ds_post_type_page_archive'] ) ? esc_attr( $this->options['ds_post_type_page_archive'] ) : '';

		printf(
			'<input type="checkbox" id="ds_post_type_page_archive" name="drim_share_settings_options[ds_post_type_page_archive]" value="1" %s/>
			<label for="ds_post_type_page_archive">' . __( 'Enable', 'drim-share' ) . '</label>',
			checked( 1, $ds_opt, false )
		);

	}


	/**
	 * Post types: CPT field callback function
	 */
	function ds_post_type__callback() {

		$ds_pt_args = array(
			'public'   => true,
			'_builtin' => false,
		);

		$ds_pt_output   = 'names';
		$ds_pt_operator = 'and';

		$ds_no_post_types = __( 'It seems you do not have any custom post types.', 'drim-share' );
		$ds_post_types    = get_post_types( $ds_pt_args, $ds_pt_output, $ds_pt_operator );

		if ( $ds_post_types ) {

			foreach ( $ds_post_types as $ds_post_type ) {

				$ds_opt = isset( $this->options[ 'ds_post_type_' . $ds_post_type ] ) ? esc_attr( $this->options[ 'ds_post_type_' . $ds_post_type ] ) : '';

				printf(
					'<p><input type="checkbox" id="ds_post_type_%1$s" name="drim_share_settings_options[ds_post_type_%1$s]" value="1" %2$s/>
					<label for="ds_post_type_%1$s"> %3$s </label></p>',
					$ds_post_type,
					checked( 1, $ds_opt, false ),
					ucfirst( $ds_post_type )
				);
			}

			$ds_no_post_types = '';

		}

		echo $ds_no_post_types;

	}


	/******
	************************************************************
	******/


	/**
	 * Print the Optional Section Content
	 */
	function print_ds_settings_optional_section_info() {
		printf(
			'<p>' . __( 'Additional options.', 'drim-share' ) . '</p>'
		);
	}


	/**
	 * Sharing block borders callback function
	 */
	function ds_style_borders_callback() {

		$ds_opt = isset( $this->options['ds_style_borders'] ) ? esc_attr( $this->options['ds_style_borders'] ) : '';
		?>
		<select class="regular-text" id="ds_style_borders" name="drim_share_settings_options[ds_style_borders]">
		  <option value=""> <?php _e( 'No Border', 'drim-share' ); ?> </option>
		  <option value="ds_brdr_top" <?php selected( $ds_opt, 'ds_brdr_top' ); ?>> <?php _e( 'Top Border', 'drim-share' ); ?> </option>
		  <option value="ds_brdr_bottom" <?php selected( $ds_opt, 'ds_brdr_bottom' ); ?>> <?php _e( 'Bottom Border', 'drim-share' ); ?> </option>
		  <option value="ds_brdr_both" <?php selected( $ds_opt, 'ds_brdr_both' ); ?>> <?php _e( 'Top & Bottom Borders', 'drim-share' ); ?> </option>
		</select>
		<?php
		echo '<p class="description">' . __( 'Choose if you want to separate the buttons from the content with borders.', 'drim-share' ) . '</p>';
	}

	/**
	 * Sharing block borders callback function
	 */
	function ds_style_border_color_callback() {

		printf(
			'<input type="text" class="regular-text" id="ds_style_border_color" name="drim_share_settings_options[ds_style_border_color]" value="%s" />',
			isset( $this->options['ds_style_border_color'] ) ? sanitize_text_field( $this->options['ds_style_border_color'] ) : ''
		);
		echo '<p class="description">' . __( 'Border color (RGB, HEX values or color names). Leave empty to use your theme colors.', 'drim-share' ) . '</p>';

	}


	/**
	 * Sharing block alignment callback function
	 */
	function ds_style_align_callback() {

		$ds_opt = isset( $this->options['ds_style_align'] ) ? esc_attr( $this->options['ds_style_align'] ) : '';
		?>
		<select class="regular-text" id="ds_style_align" name="drim_share_settings_options[ds_style_align]">
		  <option value="ds_align_left"> <?php _e( 'Left', 'drim-share' ); ?> </option>
		  <option value="ds_align_center" <?php selected( $ds_opt, 'ds_align_center' ); ?>> <?php _e( 'Center', 'drim-share' ); ?> </option>
		  <option value="ds_align_right" <?php selected( $ds_opt, 'ds_align_right' ); ?>> <?php _e( 'Right', 'drim-share' ); ?> </option>
		</select>
		<?php
		echo '<p class="description">' . __( 'Choose the buttons alignment.', 'drim-share' ) . '</p>';
	}


	/**
	 * Heading before social buttons field callback function
	 */
	function ds_heading_callback() {

		printf(
			'<input type="text" class="regular-text" id="ds_heading" name="drim_share_settings_options[ds_heading]" value="%s" />',
			isset( $this->options['ds_heading'] ) ? sanitize_text_field( $this->options['ds_heading'] ) : ''
		);
		echo '<p class="description">' . __( 'Heading for the buttons. Leave empty for no heading.', 'drim-share' ) . '</p>';

	}
}

if ( is_admin() ) {
	$drim_share_settings_settings = new Drim_Share_Options();
}
