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

    public function __construct()
    {
        add_action( 'admin_init', array( $this, 'drim_share_options_page_init' ) );
        add_action( 'admin_menu', array( $this, 'drim_share_register_admin_options_page' ) );
    }

    /**
     * Register admin options page
     *
     */
     public function drim_share_register_admin_options_page() {
         add_menu_page(
           __( 'Drim Share', 'drim-share' ),
           __( 'Drim Share', 'drim-share' ),
           'manage_options',
           'drim_share_options',
           array( $this, 'drim_share_ui' ),
           'dashicons-share',
           99
         );
     }

     public function drim_share_ui(){

       $this->options = get_option( 'drim_share_settings_options' ); ?>

       <div class="wrap">
         <h1 class="wp-heading">
           <?php esc_html_e( 'Drim Share', 'drim-share' ); ?>
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
             <?php include_once 'drim-share-admin-display-part-right.php'; ?>
           </div>
         </div>

       </div><!-- .wrap -->

     <?php }

    /**
     * Register and add settings
     */
    public function drim_share_options_page_init() {

			/*
		 	* MAIN SETTINGS
			*/
			register_setting(
				'drim_share_settings', // Option group
				'drim_share_settings_options', // Option name
				array( $this, 'drim_share_validate_input_fields' ) // Sanitize
			);

			add_settings_section(
				'drim_share_settings_main', // ID
				__( 'Main Settings', 'drim-share' ), // Title
				array( $this, 'print_drim_share_settings_main_section_info' ), // Callback
				'drim_share_options' // Page
			);

      // enable/disaple
			add_settings_field(
				'drim_share_enable_buttons', // ID
				__( 'Drim Share Buttons', 'drim-share' ), // Title
				array( $this, 'drim_share_enable_buttons_callback' ), // Callback
				'drim_share_options', // Page
				'drim_share_settings_main' // Section
			);

      // networks
			add_settings_field(
				'drim_share_networks', // ID
				__( 'Social Networks', 'drim-share' ), // Title
				array( $this, 'drim_share_networks_callback' ), // Callback
				'drim_share_options', // Page
				'drim_share_settings_main' // Section
			);

			// buttons positions
			add_settings_field(
				'drim_share_position', // ID
				__( 'Buttons Positions', 'drim-share' ), // Title
				array( $this, 'drim_share_position_callback' ), // Callback
				'drim_share_options', // Page
				'drim_share_settings_main' // Section
			);

      // button styles
			add_settings_field(
				'drim_share_style', // ID
				__( 'Button Styles', 'drim-share' ), // Title
				array( $this, 'drim_share_style_callback' ), // Callback
				'drim_share_options', // Page
				'drim_share_settings_main' // Section
			);

      // block top/bottom borders
      add_settings_field(
        'drim_share_style_borders', // ID
        __( 'Borders', 'drim-share' ), // Title
        array( $this, 'drim_share_style_borders_callback' ), // Callback
        'drim_share_options', // Page
        'drim_share_settings_main' // Section
      );

      // block border color
      add_settings_field(
        'drim_share_style_border_color', // ID
        __( 'Border Color', 'drim-share' ), // Title
        array( $this, 'drim_share_style_border_color_callback' ), // Callback
        'drim_share_options', // Page
        'drim_share_settings_main' // Section
      );

      // block alignmebt
      add_settings_field(
        'drim_share_style_align', // ID
        __( 'Alignment', 'drim-share' ), // Title
        array( $this, 'drim_share_style_align_callback' ), // Callback
        'drim_share_options', // Page
        'drim_share_settings_main' // Section
      );

      // heading text
			add_settings_field(
				'drim_share_heading', // ID
				__( 'Heading Text', 'drim-share' ), // Title
				array( $this, 'drim_share_heading_callback' ), // Callback
				'drim_share_options', // Page
				'drim_share_settings_main' // Section
			);

      add_settings_section(
        'drim_share_settings_mobile', // ID
        __( 'Mobile Settings', 'drim-share' ), // Title
        array( $this, 'print_drim_share_settings_mobile_section_info' ), // Callback
        'drim_share_options' // Page
      );

      // fixed buttons on mobile
      add_settings_field(
        'drim_share_position_mobile', // ID
        __( 'Buttons on Mobile Browsers', 'drim-share' ), // Title
        array( $this, 'drim_share_position_mobile_callback' ), // Callback
        'drim_share_options', // Page
        'drim_share_settings_mobile' // Section
      );

      // whatssapp button on mobiles
      add_settings_field(
          'drim_share_mobile_whatsapp',  // ID
          __( 'WhatsApp Button on Mobile', 'drim-share' ), // Title
          array( $this, 'drim_share_mobile_whatsapp_callback' ), // Callback
          'drim_share_options', // Page
          'drim_share_settings_mobile' // Section
      );

      // mobile button styles
      add_settings_field(
        'drim_share_style_mobile', // ID
        __( 'Mobile Button Styles', 'drim-share' ), // Title
        array( $this, 'drim_share_style_mobile_callback' ), // Callback
        'drim_share_options', // Page
        'drim_share_settings_mobile' // Section
      );



      add_settings_section(
				'drim_share_settings_post_types', // ID
				__( 'Post Types', 'drim-share' ), // Title
				array( $this, 'print_drim_share_settings_post_types_section_info' ), // Callback
				'drim_share_options' // Page
			);

      // post types: post
      add_settings_field(
          'drim_share_post_type_post',  // ID
          __( 'Include in Posts', 'drim-share' ), // Title
      		array( $this, 'drim_share_post_type_post_callback' ), // Callback
          'drim_share_options', // Page
          'drim_share_settings_post_types' // Section
      );

      // post types: page
      add_settings_field(
          'drim_share_post_type_page',  // ID
          __( 'Include in Pages', 'drim-share' ), // Title
      		array( $this, 'drim_share_post_type_page_callback' ), // Callback
          'drim_share_options', // Page
          'drim_share_settings_post_types' // Section
      );


      // if there are custom post types registered
      $ds_pt_args = [ 'public'   => true, '_builtin' => false ];
      $ds_pt_output = 'names';
      $ds_pt_operator = 'and';
      $ds_post_types = get_post_types( $ds_pt_args, $ds_pt_output, $ds_pt_operator );

      if ( $ds_post_types ) {
        // other custom post types
        add_settings_field(
            'drim_share_post_types__',  // ID
            __( 'Include in Custom Post Types', 'drim-share' ), // Title
            // array( $this, 'drim_share_post_type_'.$ds_post_type.'_callback' ), // Callback
            array( $this, 'drim_share_post_types__callback'), // Callback
            'drim_share_options', // Page
            'drim_share_settings_post_types' // Section
        );
      }


      // page: front_page
      add_settings_field(
          'drim_share_post_type_page_home',  // ID
          __( 'Include in Homepage', 'drim-share' ), // Title
      		array( $this, 'drim_share_post_type_page_home_callback' ), // Callback
          'drim_share_options', // Page
          'drim_share_settings_post_types' // Section
      );


      // archive pages
      add_settings_field(
          'drim_share_post_type_page_archive',  // ID
          __( 'Include in Archive Pages', 'drim-share' ), // Title
      		array( $this, 'drim_share_post_type_page_archive_callback' ), // Callback
          'drim_share_options', // Page
          'drim_share_settings_post_types' // Section
      );

    }


    /**
     * Validate and sanitize input fields
     *
     */
    function drim_share_validate_input_fields( $input ) {

      // Create our array for storing the validated options
      $output = array();

      // Loop through each of the incoming options
      foreach( $input as $key => $value ) {

          // Check to see if the current option has a value. If so, process it.
          if( isset( $input[$key] ) ) {

              // Strip all HTML and PHP tags and properly handle quoted strings
              $output[$key] = strip_tags( stripslashes( $input[ $key ] ) );

          } // end if

      } // end foreach

      // Return the array processing any additional functions filtered by this action
      return apply_filters( 'drim_share_validate_input_fields', $output, $input );

    }


    /**
     * Print the MAIN Section Content
     */
    function print_drim_share_settings_main_section_info() {
      echo '<p>';
      _e( 'Adjust the plugin settings here.', 'drim-share' );
      echo '</p>';
    }


    /**
     * Enable/Disable Drim Share Buttons callback function
     */
    function drim_share_enable_buttons_callback() {

      $ds_opt = isset( $this->options['drim_share_enable_buttons'] ) ? esc_attr( $this->options['drim_share_enable_buttons']) : '';
      $label_class = ( $ds_opt ) ? 'ds_enabled' : 'ds_disabled';

      $ds_check = '<input type="checkbox" id="drim_share_enable_buttons" name="drim_share_settings_options[drim_share_enable_buttons]" value="1"' . checked( 1, $ds_opt, false ) . '/>
        <label class="onoff ' . $label_class . '" for="drim_share_enable_buttons">'. __( 'Enable', 'drim-share' ) . '</label>';

      echo $ds_check;

      echo '<p class="description">' . __( 'Check the box to enable the plugin.', 'drim-share' ) . '</p>';
    }

    /**
     * Social networks selection field callback function
     */
    function drim_share_networks_callback() {

      // this function is declared in drim_share-admin-functions.php file
      $ds_networks = ds_get_available_social_networks();

      foreach( $ds_networks as $ds_network => $ds_network_name) {

        $ds_opt = isset( $this->options['drim_share_networks_' . $ds_network] ) ? esc_attr( $this->options['drim_share_networks_' . $ds_network]) : '';

        $ds_check = '<p><input type="checkbox" id="drim_share_networks_' .  $ds_network . '" name="drim_share_settings_options[drim_share_networks_' . $ds_network . ']" value="1"' . checked( 1, $ds_opt, false ) . '/>
          <label for="drim_share_networks_' . $ds_network . '">'. __( $ds_network_name, 'drim-share' ) . '</label></p>';

        echo $ds_check;

      }
      echo '<p class="description">' . __( 'Choose the social network buttons to display.', 'drim-share' ) . '</p>';
    }


    /**
     * Social buttons position selection field callback function
     */
    function drim_share_position_callback() {

        $ds_opt = isset( $this->options['drim_share_position'] ) ? esc_attr( $this->options['drim_share_position']) : '';
        ?>
        <select class="regular-text" id="drim_share_position" name="drim_share_settings_options[drim_share_position]">
          <option value=""> <?php _e( 'Select the position', 'drim-share' ); ?> </option>
          <option value="above" <?php selected($ds_opt, "above"); ?>> <?php _e( 'Above the content', 'drim-share' ); ?> </option>
          <option value="below" <?php selected($ds_opt, "below"); ?>> <?php _e( 'Below the content', 'drim-share' ); ?> </option>
          <option value="both" <?php selected($ds_opt, "both") ?>> <?php _e( 'Both', 'drim-share' ); ?> </option>
        </select>
        <?php
        echo '<p class="description">' . __( 'Choose where the buttons should appear.', 'drim-share' ) . '</p>';
    }


    /**
     * Social buttons styles selection field callback function
     */
    function drim_share_style_callback() {

        $ds_opt = isset( $this->options['drim_share_style'] ) ? esc_attr( $this->options['drim_share_style']) : '';
        ?>
        <select class="regular-text drim_share_style_select" id="drim_share_style" name="drim_share_settings_options[drim_share_style]">
          <option value="ds_icon_v1" <?php selected($ds_opt, "ds_icon_v1"); ?>> <?php _e( 'Icons v1', 'drim-share' ); ?> </option>
          <option value="ds_icon_v2" <?php selected($ds_opt, "ds_icon_v2"); ?>> <?php _e( 'Icons v2', 'drim-share' ); ?> </option>
          <option value="ds_icon_v3" <?php selected($ds_opt, "ds_icon_v3"); ?>> <?php _e( 'Icons v3', 'drim-share' ); ?> </option>
          <option value="ds_icon_v4" <?php selected($ds_opt, "ds_icon_v4"); ?>> <?php _e( 'Icons v4', 'drim-share' ); ?> </option>
          <option value="ds_icon_v5" <?php selected($ds_opt, "ds_icon_v5"); ?>> <?php _e( 'Icons v5', 'drim-share' ); ?> </option>
          <option value="ds_icon_v6" <?php selected($ds_opt, "ds_icon_v6"); ?>> <?php _e( 'Icons v6', 'drim-share' ); ?> </option>
          <option value="ds_icon_v7" <?php selected($ds_opt, "ds_icon_v7"); ?>> <?php _e( 'Icons v7', 'drim-share' ); ?> </option>
          <option value="ds_icon_v8" <?php selected($ds_opt, "ds_icon_v8"); ?>> <?php _e( 'Icons v8', 'drim-share' ); ?> </option>
          <option value="ds_image_v1" <?php selected($ds_opt, "ds_image_v1"); ?>> <?php _e( 'Images v1', 'drim-share' ); ?> </option>
          <option value="ds_image_v2" <?php selected($ds_opt, "ds_image_v2"); ?>> <?php _e( 'Images v2', 'drim-share' ); ?> </option>
          <option value="ds_image_v3" <?php selected($ds_opt, "ds_image_v3"); ?>> <?php _e( 'Images v3', 'drim-share' ); ?> </option>
          <option value="ds_image_v4" <?php selected($ds_opt, "ds_image_v4"); ?>> <?php _e( 'Images v4', 'drim-share' ); ?> </option>
          <option value="ds_image_v5" <?php selected($ds_opt, "ds_image_v5"); ?>> <?php _e( 'Images v5', 'drim-share' ); ?> </option>
          <option value="ds_image_v6" <?php selected($ds_opt, "ds_image_v6"); ?>> <?php _e( 'Images v6', 'drim-share' ); ?> </option>
          <option value="ds_image_v7" <?php selected($ds_opt, "ds_image_v7"); ?>> <?php _e( 'Images v7', 'drim-share' ); ?> </option>
          <option value="ds_image_v8" <?php selected($ds_opt, "ds_image_v8"); ?>> <?php _e( 'Images v8', 'drim-share' ); ?> </option>
          <option value="ds_text_v1" <?php selected($ds_opt, "ds_text_v1"); ?>> <?php _e( 'Names v1', 'drim-share' ); ?> </option>
          <option value="ds_text_v2" <?php selected($ds_opt, "ds_text_v2"); ?>> <?php _e( 'Names v2', 'drim-share' ); ?> </option>
        </select>
        <?php
        echo '<p class="description">' . __( 'Choose the button styles.', 'drim-share' ) . '</p>';

        include_once 'drim-share-admin-display-icons.php';
    }


    /**
     * Sharing block borders callback function
     */
    function drim_share_style_borders_callback() {

        $ds_opt = isset( $this->options['drim_share_style_borders'] ) ? esc_attr( $this->options['drim_share_style_borders']) : '';
        ?>
        <select class="regular-text" id="drim_share_style_borders" name="drim_share_settings_options[drim_share_style_borders]">
          <option value=""> <?php _e( 'No Border', 'drim-share' ); ?> </option>
          <option value="ds_brdr_top" <?php selected($ds_opt, "ds_brdr_top"); ?>> <?php _e( 'Top Border', 'drim-share' ); ?> </option>
          <option value="ds_brdr_bottom" <?php selected($ds_opt, "ds_brdr_bottom"); ?>> <?php _e( 'Bottom Border', 'drim-share' ); ?> </option>
          <option value="ds_brdr_both" <?php selected($ds_opt, "ds_brdr_both"); ?>> <?php _e( 'Top & Bottom Borders', 'drim-share' ); ?> </option>
        </select>
        <?php
        echo '<p class="description">' . __( 'Choose if you want to separate the buttons from the content with borders.', 'drim-share' ) . '</p>';
    }

    /**
     * Sharing block borders callback function
     */
    function drim_share_style_border_color_callback() {

      printf(
          '<input type="text" class="regular-text" id="drim_share_style_border_color" name="drim_share_settings_options[drim_share_style_border_color]" value="%s" />',
          isset( $this->options['drim_share_style_border_color'] ) ? sanitize_text_field( $this->options['drim_share_style_border_color'] ) : '#c5c5c5'
      );
      echo '<p class="description">' . __( 'Border color (RGB, HEX values or color names). Leave empty to use your theme colors.', 'drim-share' ) . '</p>';

    }


    /**
     * Sharing block alignment callback function
     */
    function drim_share_style_align_callback() {

        $ds_opt = isset( $this->options['drim_share_style_align'] ) ? esc_attr( $this->options['drim_share_style_align']) : '';
        ?>
        <select class="regular-text" id="drim_share_style_align" name="drim_share_settings_options[drim_share_style_align]">
          <option value=""> <?php _e( 'Left', 'drim-share' ); ?> </option>
          <option value="ds_align_center" <?php selected($ds_opt, "ds_align_center"); ?>> <?php _e( 'Center', 'drim-share' ); ?> </option>
          <option value="ds_align_right" <?php selected($ds_opt, "ds_align_right"); ?>> <?php _e( 'Right', 'drim-share' ); ?> </option>
        </select>
        <?php
        echo '<p class="description">' . __( 'Choose the buttons alignment.', 'drim-share' ) . '</p>';
    }



    /**
     * Heading before social buttons field callback function
     */
    function drim_share_heading_callback() {

      printf(
          '<input type="text" class="regular-text" id="drim_share_heading" name="drim_share_settings_options[drim_share_heading]" value="%s" />',
          isset( $this->options['drim_share_heading'] ) ? sanitize_text_field( $this->options['drim_share_heading'] ) : ''
      );
      echo '<p class="description">' . __( 'Heading for the buttons. Leave empty for no heading.', 'drim-share' ) . '</p>';

    }


    /**
     * Print the Mobile Section Content
     */
    function print_drim_share_settings_mobile_section_info() {
      echo '<p>';
      _e( 'Adjust the mobile settings here.', 'drim-share' );
      echo '</p>';
    }


    /**
     * Mobile Fixed Buttons callback function
     */
    function drim_share_position_mobile_callback() {

      $ds_opt = isset( $this->options['drim_share_position_mobile'] ) ? esc_attr( $this->options['drim_share_position_mobile']) : '';

      $ds_check = '<input type="checkbox" id="drim_share_position_mobile" name="drim_share_settings_options[drim_share_position_mobile]" value="1"' . checked( 1, $ds_opt, false ) . '/>
        <label for="drim_share_position_mobile">'. __( 'Fixed Buttons at the Bottom.', 'drim-share' ) . '</label>';

      echo $ds_check;

      echo '<p class="description">' . __( 'Check the box to fix the buttons to bottom on mobile browsers.', 'drim-share' ) . '</p>';

      $ds_opt_f = isset( $this->options['drim_share_position_mobile_full'] ) ? esc_attr( $this->options['drim_share_position_mobile_full']) : '';

      echo '<div class="separator"></div>';

      $ds_check_f = '<input type="checkbox" id="drim_share_position_mobile_full" name="drim_share_settings_options[drim_share_position_mobile_full]" value="1"' . checked( 1, $ds_opt_f, false ) . '/>
        <label for="drim_share_position_mobile_full">'. __( '100% width for Buttons Area.', 'drim-share' ) . '</label>';

      echo $ds_check_f;

      echo '<p class="description">' . __( 'Check the box to make the buttons area 100% wide.', 'drim-share' ) . '</p>';
    }


    /**
     * Whatsapp button on mobile devices callback function
     */
    function drim_share_mobile_whatsapp_callback() {

        $ds_opt = isset( $this->options['drim_share_mobile_icons_whatsapp'] ) ? esc_attr( $this->options['drim_share_mobile_icons_whatsapp']) : '';

        $ds_check = '<input type="checkbox" id="drim_share_mobile_icons_whatsapp" name="drim_share_settings_options[drim_share_mobile_icons_whatsapp]" value="1"' . checked( 1, $ds_opt, false ) . '/>
          <label for="drim_share_mobile_icons_whatsapp"> <i class="demo-icon ds_icon icon-whatsapp content-icon"></i> '. __( 'Include', 'drim-share' ) . '</label>';

        echo $ds_check;

    }

    /**
     * Social buttons styles selection field callback function
     */
    function drim_share_style_mobile_callback() {

        $ds_opt = isset( $this->options['drim_share_style_mobile'] ) ? esc_attr( $this->options['drim_share_style_mobile']) : '';
        ?>
        <select class="regular-text drim_share_style_select" id="drim_share_style_mobile" name="drim_share_settings_options[drim_share_style_mobile]">
          <option value="ds_icon_v1" <?php // selected($ds_opt, "ds_icon_v1"); ?>> <?php _e( 'Icons v1', 'drim-share' ); ?> </option>
          <option value="ds_icon_v2" <?php // selected($ds_opt, "ds_icon_v2"); ?>> <?php _e( 'Icons v2', 'drim-share' ); ?> </option>
          <option value="ds_icon_v3" <?php selected($ds_opt, "ds_icon_v3"); ?>> <?php _e( 'Icons v3', 'drim-share' ); ?> </option>
          <option value="ds_icon_v4" <?php selected($ds_opt, "ds_icon_v4"); ?>> <?php _e( 'Icons v4', 'drim-share' ); ?> </option>
          <option value="ds_icon_v5" <?php selected($ds_opt, "ds_icon_v5"); ?>> <?php _e( 'Icons v5', 'drim-share' ); ?> </option>
          <option value="ds_icon_v6" <?php selected($ds_opt, "ds_icon_v6"); ?>> <?php _e( 'Icons v6', 'drim-share' ); ?> </option>
          <option value="ds_icon_v7" <?php selected($ds_opt, "ds_icon_v7"); ?>> <?php _e( 'Icons v7', 'drim-share' ); ?> </option>
          <option value="ds_icon_v8" <?php selected($ds_opt, "ds_icon_v8"); ?>> <?php _e( 'Icons v8', 'drim-share' ); ?> </option>
        </select>
        <?php
        echo '<p class="description">' . __( 'Choose the button styles.', 'drim-share' ) . '</p>';

        include_once 'drim-share-admin-display-icons-mobile.php';
    }


    /**
     * Print the Post Types Section Content
     */
    function print_drim_share_settings_post_types_section_info() {
      echo '<p>';
      _e( 'Choose in which post types to include the sharing buttons.', 'drim-share' );
      echo '</p>';
    }

    /**
     * Post types: post field callback function
     */
    function drim_share_post_type_post_callback() {

        $ds_opt = isset( $this->options['drim_share_post_type_post'] ) ? esc_attr( $this->options['drim_share_post_type_post']) : '';

        $ds_check = '<input type="checkbox" id="drim_share_post_type_post" name="drim_share_settings_options[drim_share_post_type_post]" value="1"' . checked( 1, $ds_opt, false ) . '/>
          <label for="drim_share_post_type_post">'. __( 'Yes', 'drim-share' ) . '</label>';

        echo $ds_check;

    }

    /**
     * Post types: page field callback function
     */
    function drim_share_post_type_page_callback() {

        $ds_opt = isset( $this->options['drim_share_post_type_page'] ) ? esc_attr( $this->options['drim_share_post_type_page']) : '';

        $ds_check = '<input type="checkbox" id="drim_share_post_type_page" name="drim_share_settings_options[drim_share_post_type_page]" value="1"' . checked( 1, $ds_opt, false ) . '/>
          <label for="drim_share_post_type_page">'. __( 'Yes', 'drim-share' ) . '</label>';

        echo $ds_check;

    }


    /**
     * Post types: homepage field callback function
     */
    function drim_share_post_type_page_home_callback() {

        $ds_opt = isset( $this->options['drim_share_post_type_page_home'] ) ? esc_attr( $this->options['drim_share_post_type_page_home']) : '';

        $ds_check = '<input type="checkbox" id="drim_share_post_type_page_home" name="drim_share_settings_options[drim_share_post_type_page_home]" value="1"' . checked( 1, $ds_opt, false ) . '/>
          <label for="drim_share_post_type_page_home">'. __( 'Yes', 'drim-share' ) . '</label>';

        echo $ds_check;

    }



    /**
     * Post types: archive page field callback function
     */
    function drim_share_post_type_page_archive_callback() {

        $ds_opt = isset( $this->options['drim_share_post_type_page_archive'] ) ? esc_attr( $this->options['drim_share_post_type_page_archive']) : '';

        $ds_check = '<input type="checkbox" id="drim_share_post_type_page_archive" name="drim_share_settings_options[drim_share_post_type_page_archive]" value="1"' . checked( 1, $ds_opt, false ) . '/>
          <label for="drim_share_post_type_page_archive">'. __( 'Yes', 'drim-share' ) . '</label>';

        echo $ds_check;

    }


    /**
     * Post types: CPT field callback function
     */
    function drim_share_post_types__callback() {

      $ds_pt_args = array(
        'public'   => true,
        '_builtin' => false
      );

      $ds_pt_output = 'names';
      $ds_pt_operator = 'and';

      $ds_post_types = get_post_types( $ds_pt_args, $ds_pt_output, $ds_pt_operator );

      if ( $ds_post_types ) {
        foreach( $ds_post_types as $ds_post_type ) {

          $ds_opt = isset( $this->options['drim_share_post_type_' . $ds_post_type] ) ? esc_attr( $this->options['drim_share_post_type_' . $ds_post_type]) : '';

          $ds_check = '<p><input type="checkbox" id="drim_share_post_type_' .  $ds_post_type . '" name="drim_share_settings_options[drim_share_post_type_' . $ds_post_type . ']" value="1"' . checked( 1, $ds_opt, false ) . '/>
            <label for="drim_share_post_type_' . $ds_post_type . '">'. __( ucfirst($ds_post_type), 'drim-share' ) . '</label></p>';

          echo $ds_check;
        }
      } else {
          _e( 'It seems you do not have any custom post types.', 'drim-share' );
      }

    }
}

		if ( is_admin() ) $drim_share_settings_settings = new Drim_Share_Options();
