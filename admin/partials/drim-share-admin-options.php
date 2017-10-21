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
           <?php esc_html_e( 'Drim Share Options', 'drim-share' ); ?>
         </h1>
         <p> <?php _e( 'Adjust the plugin settings here.', 'drim-share' ); ?> </p>

         <form method="post" action="options.php">
           <?php
           // This prints out all hidden setting fields
           settings_fields( 'drim_share_settings' );
           do_settings_sections( 'drim_share_options' );

           submit_button();
           ?>
         </form>

         <style>
         .hidden-field {
           display: none;
         }
         </style>
         <script>
         /*
         jQuery(document).ready(function(){
           if (jQuery("#drim_share_style").val() != 'ds_custom') {
             jQuery(".form-table tr:nth-child(4)").addClass("hidden-field");
             jQuery(".form-table tr:nth-child(5)").addClass("hidden-field");
           }
         });
         jQuery("#drim_share_style").change(function(){
           if( jQuery(this).val() == 'ds_custom' ) {
             jQuery(".form-table tr:nth-child(4)").show();
             jQuery(".form-table tr:nth-child(5)").show();
           } else {
             jQuery(".form-table tr:nth-child(4)").hide();
             jQuery(".form-table tr:nth-child(5)").hide();
           }
         });
         */
         </script>

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

      // networks
			add_settings_field(
				'drim_share_networks', // ID
				__( 'Social Networks', 'drim-share' ), // Title
				array( $this, 'drim_share_networks_callback' ), // Callback
				'drim_share_options', // Page
				'drim_share_settings_main' // Section
			);

      // networks order
      add_settings_field(
        'drim_share_networks_order', // ID
        __( 'Social Networks Order', 'drim-share' ), // Title
        array( $this, 'drim_share_networks_order_callback' ), // Callback
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

      // custom button images
			add_settings_field(
				'drim_share_custom_images', // ID
				__( 'Custom Image Directory URL', 'drim-share' ), // Title
				array( $this, 'drim_share_custom_images_callback' ), // Callback
				'drim_share_options', // Page
				'drim_share_settings_main' // Section
			);

      // custom button image width
			add_settings_field(
				'drim_share_custom_image_width', // ID
				__( 'Custom Image Width', 'drim-share' ), // Title
				array( $this, 'drim_share_custom_image_width_callback' ), // Callback
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


      // other custom post types
      add_settings_field(
          'drim_share_post_types__',  // ID
          __( 'Include in Custom Post Types', 'drim-share' ), // Title
          // array( $this, 'drim_share_post_type_'.$ds_post_type.'_callback' ), // Callback
          array( $this, 'drim_share_post_types__callback'), // Callback
          'drim_share_options', // Page
          'drim_share_settings_post_types' // Section
      );


      // page: front_page
      add_settings_field(
          'drim_share_post_type_page_home',  // ID
          __( 'Include in HomePage', 'drim-share' ), // Title
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
      _e( 'Plugin settings', 'drim-share' );
			echo '<br><br>';
    }


    /**
     * Print the Post Types Section Content
     */
    function print_drim_share_settings_post_types_section_info() {
      _e( 'Choose in which post types to include the sharing buttons.', 'drim-share' );
      echo '<br><br>';
    }


    /**
     * Social networks selection field callback function
     */
    function drim_share_networks_callback() {

      $ds_networks = [
        'facebook' => 'Facebook',
        'twitter' => 'Twitter',
        'linkedin' => 'LinkedIn',
        'googleplus' => 'Google Plus',
        'pinterest' => 'Pinterest'
      ];

      foreach( $ds_networks as $ds_network => $ds_network_name) {

        $ds_opt = isset( $this->options['drim_share_networks_' . $ds_network] ) ? esc_attr( $this->options['drim_share_networks_' . $ds_network]) : '';

        $ds_check = '<p><input type="checkbox" id="drim_share_networks_' .  $ds_network . '" name="drim_share_settings_options[drim_share_networks_' . $ds_network . ']" value="1"' . checked( 1, $ds_opt, false ) . '/>
          <label for="drim_share_networks_' . $ds_network . '">'. __( $ds_network_name, 'drim-share' ) . '</label></p>';

        echo $ds_check;

      }
    }


    /**
     * Social networks order selection field callback function
     */
    function drim_share_networks_order_callback() {

      $ds_networks = [
        'facebook' => 'Facebook',
        'twitter' => 'Twitter',
        'linkedin' => 'LinkedIn',
        'googleplus' => 'Google Plus',
        'pinterest' => 'Pinterest'
      ];

      echo '<ul id="sortable">';

      $n = 0;
      foreach( $ds_networks as $ds_network => $ds_network_name) {
        $n++;

          $ds_opt = isset( $this->options['drim_share_networks_order_' . $ds_network] ) ? esc_attr( $this->options['drim_share_networks_order_' . $ds_network]) : '';

          echo '<li id="drim_share_networks_order_' .  $ds_network . '" name="drim_share_settings_options[drim_share_networks_order_' . $ds_network . ']" class="regular-text ui-state-default" data-place="' . $n . '">' . $ds_network_name . '</li>';

      }
      echo '</ul>'; ?>
      <script>
      jQuery( function() {
        jQuery( "#sortable" ).sortable({
          placeholder: "ui-state-highlight regular-text"
        });
        jQuery( "#sortable" ).disableSelection();
      });
  </script>
      <?php
    }

    /**
     * Social buttons position selection field callback function
     */
    function drim_share_position_callback() {

        $ds_opt = isset( $this->options['drim_share_position'] ) ? esc_attr( $this->options['drim_share_position']) : '';
        ?>
        <select class="regular-text" id="drim_share_position" name="drim_share_settings_options[drim_share_position]">
          <option value=""> <?php _e( 'Select the position', 'drim-share' ); ?> </option>
          <option value="above" <?php selected($ds_opt, "above"); ?>> <?php _e( 'Above', 'drim-share' ); ?> </option>
          <option value="below" <?php selected($ds_opt, "below"); ?>> <?php _e( 'Below', 'drim-share' ); ?> </option>
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
        <select class="regular-text" id="drim_share_style" name="drim_share_settings_options[drim_share_style]">
          <option value=""> <?php _e( 'Select the style', 'drim-share' ); ?> </option>
          <option value="ds_image" <?php selected($ds_opt, "ds_image"); ?>> <?php _e( 'Images', 'drim-share' ); ?> </option>
          <option value="ds_icon" <?php selected($ds_opt, "ds_icon"); ?>> <?php _e( 'Icons', 'drim-share' ); ?> </option>
          <option value="ds_text" <?php selected($ds_opt, "ds_text"); ?>> <?php _e( 'Names', 'drim-share' ); ?> </option>
          <option value="ds_custom" <?php selected($ds_opt, "ds_custom") ?>> <?php _e( 'Custom Images', 'drim-share' ); ?> </option>
        </select>
        <?php
        echo '<p class="description">' . __( 'Choose the button styles.', 'drim-share' ) . '</p>';
    }



    /**
     * Social buttons custom image directory field callback function
     */
    function drim_share_custom_images_callback() {

      printf(
          '<input type="url" class="regular-text" id="drim_share_custom_images" name="drim_share_settings_options[drim_share_custom_images]" value="%s" />',
          isset( $this->options['drim_share_custom_images'] ) ? esc_url( $this->options['drim_share_custom_images'] ) : ''
      );
      echo '<p class="description">' . __( 'Upload your custom images to any folder on your server and paste the folder URL here.', 'drim-share' ) . '</p>';
      echo '<p class="description">' . __( 'The image names <b>must</b> be <code><u>facebook</u>.png, <u>twitter</u>.png, <u>linkedin</u>.png, <u>googleplus</u>.png, <u>pinterest</u>.png</code>.', 'drim-share' ) . '</p>';
      echo '<p class="description">' . __( 'You can use any image type, it doesn\'t have to be .png (facebook.jpg would do). They just have to be all the same.', 'drim-share' ) . '</p>';
      echo '<p class="description">' . __( 'If an image URL is something like this: <code>' . get_home_url() . '/some-directory/images/facebook.png</code>', 'drim-share' ) . '</p>';
      echo '<p class="description">' . __( 'The value of this field would be something like this: <code>' . get_home_url() . '/some-directory/images/</code>.', 'drim-share' ) . '</p>';

    }


    /**
     * Social buttons custom image width field callback function
     */
    function drim_share_custom_image_width_callback() {

      printf(
          '<input type="number" class="regular-text" id="drim_share_custom_image_width" name="drim_share_settings_options[drim_share_custom_image_width]" value="%s" />',
          isset( $this->options['drim_share_custom_image_width'] ) ? intval( $this->options['drim_share_custom_image_width'] ) : ''
      );
      echo '<p class="description">' . __( 'The width of the custom image (in pixels).', 'drim-share' ) . '</p>';

    }



    /**
     * Heading before social buttons field callback function
     */
    function drim_share_heading_callback() {

      printf(
          '<input type="text" class="regular-text" id="drim_share_heading" name="drim_share_settings_options[drim_share_heading]" value="%s" />',
          isset( $this->options['drim_share_heading'] ) ? sanitize_text_field( $this->options['drim_share_heading'] ) : ''
      );
      echo '<p class="description">' . __( 'Heading before the buttons. Leave empty for no heading.', 'drim-share' ) . '</p>';

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

      foreach( $ds_post_types as $ds_post_type ) {

        $ds_opt = isset( $this->options['drim_share_post_type_' . $ds_post_type] ) ? esc_attr( $this->options['drim_share_post_type_' . $ds_post_type]) : '';

        $ds_check = '<p><input type="checkbox" id="drim_share_post_type_' .  $ds_post_type . '" name="drim_share_settings_options[drim_share_post_type_' . $ds_post_type . ']" value="1"' . checked( 1, $ds_opt, false ) . '/>
          <label for="drim_share_post_type_' . $ds_post_type . '">'. __( ucfirst($ds_post_type), 'drim-share' ) . '</label></p>';

        echo $ds_check;

      }

    }

}

		if ( is_admin() ) $drim_share_settings_settings = new Drim_Share_Options();
