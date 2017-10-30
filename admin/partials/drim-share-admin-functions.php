<?php

/**
 * Main admin functions of the plugin
 *
 * @link       https://drim.io/drim-share/
 * @since      1.0.0
 *
 * @package    Drim_Share
 * @subpackage Drim_Share/admin/partials
 */



/**
* Get options of the plugin.
*
* @since 1.0.0
* @return object Options object of the plugin.
*/
function ds_get_ds_options() {

  $plugin_options = get_option( 'drim_share_settings_options' );

  return $plugin_options;

}


/**
* Get option values
*
* @since 1.0.0
* @param array $ds_option Option name
* @return mixed
*/
function ds_get_option_values( $ds_option ){

  $ds_options = ds_get_ds_options();

  return isset( $ds_options[$ds_option] ) ? $ds_options[$ds_option] : '';

}


/**
* Check if it's a mobile browser (excludding tablets)
*
* @since 1.0.1
* @return bool
*/
function ds_is_mobile(){

  include_once dirname( dirname(__FILE__) ) . '/inc/Mobile_Detect.php';
  $is_mobile = new Mobile_Detect();


  // Check for any mobile device, excude tablets
  if ( $is_mobile->isMobile() && !$is_mobile->isTablet() ) {
    return true;
  }

  return false;
}


/**
* Check if to have a fixed bar on mobile browsers
*
* @since 1.0.1
* @return bool
*/
function ds_is_fixed_on_mobile() {

  $fixed_on_mobile = ds_get_option_values('drim_share_position_mobile');

  return ( 1 == $fixed_on_mobile && true === ds_is_mobile() ) ? true : false;

}


/**
* Check if it is 100% wide fixed bar
*
* @since 1.0.1
* @return bool
*/
function ds_is_full_width_on_mobile() {

  $full_width_on_mobile = ds_get_option_values('drim_share_position_mobile_full');

  return ( 1 == $full_width_on_mobile && true === ds_is_fixed_on_mobile() ) ? true : false;

}


/**
 * Get the post types allowed
 *
 * @since   1.0.0
 * @return  array
 *
 */
function ds_get_post_types_allowed(){

  $post_types_allowed = [];

  // posts
  $display_in_posts = ( ds_get_option_values('drim_share_post_type_post') == 1 ) ? true : false;
  if ( $display_in_posts ) {
   $post_types_allowed[] = 'post';
  }

  // pages
  $display_in_pages = ( ds_get_option_values('drim_share_post_type_page') == 1 ) ? true : false;
  if ( $display_in_pages ) {
   $post_types_allowed[] = 'page';
  }

  // custom post types
  $ds_post_types_args = [ 'public'   => true, '_builtin' => false ];
  $ds_post_types_output = 'names';
  $ds_post_types_operator = 'and';

  $ds_post_types = get_post_types( $ds_post_types_args, $ds_post_types_output, $ds_post_types_operator );

  foreach( $ds_post_types as $ds_post_type ) {

    ${"display_in_$ds_post_type"} = ( ds_get_option_values('drim_share_post_type_' . $ds_post_type ) == 1 ) ? true : false;
    if ( ${"display_in_$ds_post_type"} ) {
      $post_types_allowed[] = $ds_post_type;
    }

  }

  return $post_types_allowed;

}


/**
 * Available social networks
 *
 * @since   1.0.2
 * @return  array
 *
 */
 function ds_get_available_social_networks(){

   $ds_networks = [
     'facebook' => 'Facebook',
     'twitter' => 'Twitter',
     'linkedin' => 'LinkedIn',
     'googleplus' => 'Google Plus',
     'pinterest' => 'Pinterest',
     // 'whatsapp' => 'WhatsApp'
   ];

   return $ds_networks;
 }

/**
* Get selected social networks
*
* @since  1.0.0
* @return array
*/
function ds_get_selected_social_networks(){

  $ds_selected_networks = [];
  $ds_networks = ds_get_available_social_networks();

  foreach ($ds_networks as $ds_network => $ds_network_name) {
    $network_option = 'drim_share_networks_' . $ds_network;
    $use_network = ds_get_option_values( $network_option );

    if ( $use_network == 1 ) {
      $ds_selected_networks[] = $ds_network;
    }
  }

  // mobile only buttons
  $whatsapp_on_mobile = ds_get_option_values('drim_share_mobile_icons_whatsapp');
  if ( 1 == $whatsapp_on_mobile ) {
    $ds_selected_networks[] = 'whatsapp';
  }

  return $ds_selected_networks;
}

/**
* Get border options
*
* @since 1.0.0
* @return string
*
*/
function ds_get_border_options(){

  $borders = ds_get_option_values('drim_share_style_borders');

  return ( $borders ) ? $borders : 'ds_no_border';
}


/**
* Get heading options
*
* @since 1.0.0
* @return array
*
*/
function ds_get_heading_options() {

  $heading_options = [];

  $has_heading = 'ds_no_heading';
  $heading_wpml = '';
  $heading_tag = '';

  $heading  = ds_get_option_values('drim_share_heading');

  if ( $heading ) {
    $has_heading = 'ds_has_heading';

    do_action( 'wpml_register_single_string', 'drim-share', 'Block Heading', $heading );
    $heading_wpml = apply_filters( 'wpml_translate_single_string',  $heading, 'drim-share', 'Block Heading');

    $heading_tag = '<div class="ds_heading">' . sanitize_text_field( $heading_wpml ) . '</div>';

  }

  $heading_options['heading'] = $heading;
  $heading_options['has_heading'] = $has_heading;
  $heading_options['heading_tag'] = $heading_tag;

  return $heading_options;

}


/**
* Get buttons alignment
*
* @since 1.0.0
* @return string
*
*/
function ds_get_button_alignment(){

  $ds_alignment  = ds_get_option_values('drim_share_style_align');

  return ( $ds_alignment ) ? $ds_alignment : 'ds_align_left';
}


/**
 * Get the button styles
 *
 * @since 1.0.0
 * @return array
 *
 */
function ds_get_button_styles(){

  $ds_button_style = ds_get_option_values('drim_share_style');

  return $ds_button_style;

}


/**
 * Get mobile button styles
 *
 * @since 1.0.2
 * @return array
 *
 */
function ds_get_button_styles_mobile(){

  $ds_button_style = ds_get_option_values('drim_share_style_mobile');

  return $ds_button_style;

}


/**
 * Make social network Links
 *
 * @since 1.0.0
 * @param $network The social network name string
 * @return string
 *
 */
function ds_make_link_tags( $network ) {

  global $post;

  $thumb = ( has_post_thumbnail( $post ) ) ? get_the_post_thumbnail_url( $post ) : '';
  $title = get_the_title( $post );

  $style = ds_get_button_styles();

  switch ($network) {
    case 'facebook':
      $url = 'https://www.facebook.com/sharer/sharer.php?u=' . get_permalink( $post );
      $text = 'Facebook';
      $share = __( 'Share', 'drim-share' );
      $icon = '<i class="demo-icon ds_icon icon-facebook"></i>';
      break;
    case 'twitter':
      $url = 'https://twitter.com/home?status=' . get_permalink( $post ) . '%20' . $title;
      $text = 'Twitter';
      $share = __( 'Tweet', 'drim-share' );
      $icon = '<i class="demo-icon ds_icon icon-twitter"></i>';
      break;
    case 'linkedin':
      $url = 'https://www.linkedin.com/shareArticle?mini=true&url='. get_permalink( $post ) .'&title='. get_the_title( $post ) .'&summary=';
      $text = 'LinkedIn';
      $share = __( 'Share', 'drim-share' );
      $icon = '<i class="demo-icon ds_icon icon-linkedin"></i>';
      break;
    case 'pinterest':
      $url = 'https://pinterest.com/pin/create/button/?url=' . get_permalink( $post ) . '&media=' . $thumb . '&description=';
      $text = 'Pinterest';
      $share = __( 'Pin', 'drim-share' );
      $icon = '<i class="demo-icon ds_icon icon-pinterest-1"></i>';
      break;
    case 'googleplus':
      $url = 'https://plus.google.com/share?url=' . get_permalink( $post );
      $text = 'Google Plus';
      $share = __( 'Plus 1', 'drim-share' );
      $icon = '<i class="demo-icon ds_icon icon-gplus-1"></i>';
      break;
    case 'whatsapp':
      $url = 'whatsapp://send?text=' . get_permalink( $post );
      $text = 'WhatsApp';
      $share = __( 'Send', 'drim-share' );
      $icon = '<i class="demo-icon ds_icon icon-whatsapp"></i>';
      break;
  }

  $action = ($network === 'whatsapp') ? ' data-action="share/whatsapp/share"' : '';

  $anchor = $icon . '<span class="ds_network_name">' . $text . '</span>';

  if ( 'ds_icon_v2' === $style || 'ds_icon_v3' === $style ) {
    $anchor = $icon . '<span class="ds_network_name">' . $share . '</span>';
  }

  $link = '<a target="_blank" rel="nofollow" title="Share on ' . $text . '" href="' . $url . '"' . $action . '>' . $anchor . '</a>';

  return $link;
}


/**
* Make the ds_wrapper class
*
* @since 1.0.2
* @return string $ds_wrapper_class
*
*/
function ds_make_wrapper_class(){

  $ds_buttons_style = ds_get_button_styles();
  $ds_buttons_style_mobile = ds_get_button_styles_mobile();
  $ds_style = ( ds_is_mobile() === true ) ? $ds_buttons_style_mobile : $ds_buttons_style;

  $fixed_on_mobile = ( ds_is_fixed_on_mobile() === true ) ? 'ds_wrapper_fixed ' : '';
  $full_width_on_mobile = ( ds_is_full_width_on_mobile() === true ) ? 'ds_wrapper_full_width ' : '';

  $ds_alignment = ds_get_button_alignment();

  $ds_has_border = ds_get_border_options();

  $ds_heading_options = ds_get_heading_options();

  $ds_wrapper_class = $fixed_on_mobile . $full_width_on_mobile . $ds_style . ' ' . $ds_alignment . ' ' . $ds_has_border . ' ' . $ds_heading_options['has_heading'];

  return $ds_wrapper_class;

}



/**
* Make the individual icons
*
* @since 1.0.2
* @return string
*
*/
function ds_make_icons( $network ){

  if ( 'whatsapp' === $network && ds_is_mobile() !== true ) {
    return;
  }

  return '<div class="ds_bttn ds_' . $network . '">' . ds_make_link_tags( $network ) . '</div>';

}



/**
* Make the buttons
*
* @since 1.0.0
* @return string
*
*/
function ds_make_buttons(){

  $ds_wrapper_class = ds_make_wrapper_class();

  $heading_options = ds_get_heading_options();

  $buttons = '<div class="ds_wrapper ' . $ds_wrapper_class . '">';
  $buttons .= $heading_options['heading_tag'];

  $ds_selected_networks = ds_get_selected_social_networks();

  foreach ($ds_selected_networks as $ds_selected_network) {

    $button = ds_make_icons( $ds_selected_network );
    $buttons .= $button;

  }

  $buttons .= '</div>';

  return $buttons;

}


/**
* Make the style tag
*
* @since 1.0.2
* @return string
*
*/
function ds_make_style_tag() {

  $custom_styles = '';
  $ds_style_tag = '';

  $button_styles = ds_get_button_styles();

  $brdr_color = ds_get_option_values('drim_share_style_border_color');
  if ( $brdr_color ) {
    $custom_styles .= ' .ds_wrapper.ds_brdr_top, .ds_wrapper.ds_brdr_bottom, .ds_wrapper.ds_brdr_both { border-color: ' . sanitize_text_field( $brdr_color ) . '; } ';
  }

  if ( true === ds_is_full_width_on_mobile() ) {
    $ds_selected_networks = ds_get_selected_social_networks();
    $grid_items = count( $ds_selected_networks );
    $custom_styles .= ' .ds_wrapper.ds_wrapper_fixed.ds_wrapper_full_width { grid-template-columns: repeat( ' . $grid_items . ', 1fr); }';
  }

  if ( '' != $custom_styles ) {
    $ds_style_tag = '<style>' . $custom_styles . '</style>';
  }

  return $ds_style_tag;

}



/**
 * Button positions
 *
 * @since 1.0.0
 * @param $buttons The buttons part
 * @param $content The post content
 * @return string
 *
 */
function ds_get_button_positions( $buttons, $content ) {

  $output = '';

  $styles = ds_make_style_tag();

  // get the button positions
  $position = ds_get_option_values('drim_share_position');

  switch ($position) {
    case 'above':
      $output .= $buttons . $styles . $content;
      break;
    case 'below':
      $output .= $content . $buttons . $styles;
      break;
   case 'both':
      $output .= $buttons . $content . $buttons . $styles;
      break;
   default:
      $output .= $content;
      break;
  }

  // if is mobile browser and fixed mobile buttons option is selected
  if ( true === ds_is_fixed_on_mobile() ) {
    $output = $content . $buttons . $styles;
  }

  return $output;

}


/**
 * Display the buttons
 *
 * @since 1.0.0
 * @param $content The post content
 * @return
 *
 */
function ds_display_buttons( $content ) {

  global $post;

  // get the buttons
  $buttons = ds_make_buttons();

  // check for post_types
  $post_types_allowed = ds_get_post_types_allowed();
  $homepage_allowed = ds_get_option_values('drim_share_post_type_page_home');
  $is_archive_allowed = ds_get_option_values('drim_share_post_type_page_archive');

  if ( in_array( $post->post_type, $post_types_allowed, true ) ) {
    $output = ds_get_button_positions( $buttons, $content );
  } else {
    $output = $content;
  }

  if ( !is_singular() && ( 1 != $is_archive_allowed ) ) {
    $output = $content;
  }

  if ( is_front_page() && ( 1 != $homepage_allowed ) ) {
    $output = $content;
  }

  return $output;

}

/**
 * Enable/Disable the plugin
 *
 * @since 1.0.1
 * @return
 *
 */
 add_filter( 'the_content', function($c){

   $enabled = ds_get_option_values('drim_share_enable_buttons');
   return ( 1 == $enabled ) ? ds_display_buttons($c) : $c;

 });
