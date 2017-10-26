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
* Get the options of the plugin.
*
* @since     1.0.0
* @return    object    The options object of the plugin.
*/
function drim_share_get_ds_options() {

  $plugin_options = get_option( 'drim_share_settings_options' );
  return $plugin_options;

}


/**
* Get option values
*
* @since     1.0.0
*
* @return    string/int
*/
function drim_share_get_option_values( $ds_option ){

  $c_options = drim_share_get_ds_options();
  $c_option  = isset( $c_options[$ds_option] ) ? $c_options[$ds_option] : '';
  return $c_option;

}


/**
* Check if it is a mobile browser
*
* @since 1.0.1
*
* @return bool
*/
function ds_is_mobile(){

  include_once dirname( dirname(__FILE__) ) . '/inc/Mobile_Detect.php';
  $is_mobile = new Mobile_Detect();

  // Check for any mobile device.
  if ( $is_mobile->isMobile() ) {
    return true;
  }

  return false;
}


/**
* Check if to have a fix bar on mobile browsers
*
* @since 1.0.1
*
* @return bool
*/
function ds_fixed_on_mobile() {

  $fixed_on_mobile = drim_share_get_option_values('drim_share_position_mobile');
  if ( 1 == $fixed_on_mobile ) {
    return true;
  }

  return false;

}

/**
 * Get the post types allowed
 *
 * @since   1.0.0
 *
 * @return  array
 *
 */
function drim_share_get_post_types_allowed(){

  $post_types_allowed = [];

  // posts
  $display_in_posts = ( drim_share_get_option_values('drim_share_post_type_post') == 1 ) ? true : false;
  if ( $display_in_posts ) {
   $post_types_allowed[] = 'post';
  }

  // pages
  $display_in_pages = ( drim_share_get_option_values('drim_share_post_type_page') == 1 ) ? true : false;
  if ( $display_in_pages ) {
   $post_types_allowed[] = 'page';
  }

  // custom post types
  $ds_pt_args = [ 'public'   => true, '_builtin' => false ];
  $ds_pt_output = 'names';
  $ds_pt_operator = 'and';

  $ds_post_types = get_post_types( $ds_pt_args, $ds_pt_output, $ds_pt_operator );

  foreach( $ds_post_types as $ds_post_type ) {

    ${"display_in_$ds_post_type"} = ( drim_share_get_option_values('drim_share_post_type_' . $ds_post_type ) == 1 ) ? true : false;
    if ( ${"display_in_$ds_post_type"} ) {
      $post_types_allowed[] = $ds_post_type;
    }

  }

  return $post_types_allowed;

}



/**
* Get the buttons
*
* @since   1.0.0
*
* @return  string
*
*/
function drim_share_get_buttons(){

  $ds_networks = [
    'facebook' => 'Facebook',
    'twitter' => 'Twitter',
    'linkedin' => 'LinkedIn',
    'googleplus' => 'Google Plus',
    'pinterest' => 'Pinterest'
  ];

  $selected_networks = [];

  foreach ($ds_networks as $ds_network => $ds_network_name) {
    $network_option = 'drim_share_networks_' . $ds_network;
    $use_network = drim_share_get_option_values( $network_option );

    if ( $use_network == 1 ) {
      $selected_networks[] = $ds_network;
    }
  }

  $buttons_style = drim_share_get_button_styles();

  $borders = drim_share_get_option_values('drim_share_style_borders');
  $has_border = ( $borders ) ? $borders : 'ds_no_border';

  $heading  = drim_share_get_option_values('drim_share_heading');

  // wpml
  do_action( 'wpml_register_single_string', 'drim-share', 'Block Heading', $heading );
  $heading_wpml = apply_filters( 'wpml_translate_single_string',  $heading, 'drim-share', 'Block Heading');

  $has_heading =  ( $heading ) ? 'ds_has_heading' : 'ds_no_heading';

  $alignment  = drim_share_get_option_values('drim_share_style_align');
  $ds_align = ( $alignment ) ? $alignment : 'ds_align_left';

  $fixed_on_mobile = ( ds_fixed_on_mobile() === true && ds_is_mobile() === true ) ? 'ds_wrapper_fixed ' : '';

  $buttons = '<div class="ds_wrapper ' . $fixed_on_mobile . $buttons_style . ' ' . $ds_align . ' ' . $has_border . ' ' . $has_heading . '">';

  if ( $heading ) {
    $buttons .= '<div class="ds_heading">' . sanitize_text_field( $heading_wpml ) . '</div>';
  }

  foreach ($selected_networks as $network) {

    $button = '<div class="ds_bttn ds_'.$network.'">' . network_links( $network ) . '</div>';
    $buttons .= $button;
  }

  $buttons .= '</div>';

  return $buttons;

}


/**
 * Social Network Links
 *
 * @since   1.0.0
 *
 * @return  string
 *
 */
function network_links( $network ) {
  global $post;

  $thumb = ( has_post_thumbnail( $post ) ) ? get_the_post_thumbnail_url( $post ) : '';
  $title = get_the_title( $post );

  $style = drim_share_get_button_styles();

  switch ($network) {
    case 'facebook':
      $url = 'https://www.facebook.com/sharer/sharer.php?u=' . get_permalink( $post );
      $text = 'Facebook';
      $share = __( 'Share', 'drim-share' );
      $icon = '<i class="demo-icon ds_icon icon-facebook-1"></i>';
      break;
    case 'twitter':
      $url = 'https://twitter.com/home?status=' . get_permalink( $post ) . '%20' . $title;
      $text = 'Twitter';
      $share = __( 'Tweet', 'drim-share' );
      $icon = '<i class="demo-icon ds_icon icon-twitter-1"></i>';
      break;
    case 'linkedin':
      $url = 'https://www.linkedin.com/shareArticle?mini=true&url='. get_permalink( $post ) .'&title='. get_the_title( $post ) .'&summary=';
      $text = 'LinkedIn';
      $share = __( 'Share', 'drim-share' );
      $icon = '<i class="demo-icon ds_icon icon-linkedin-1"></i>';
      break;
    case 'pinterest':
      $url = 'https://pinterest.com/pin/create/button/?url=' . get_permalink( $post ) . '&media=' . $thumb . '&description=';
      $text = 'Pinterest';
      $share = __( 'Pin', 'drim-share' );
      $icon = '<i class="demo-icon ds_icon icon-pinterest"></i>';
      break;
    case 'googleplus':
      $url = 'https://plus.google.com/share?url=' . get_permalink( $post );
      $text = 'Google Plus';
      $share = __( 'Plus 1', 'drim-share' );
      $icon = '<i class="demo-icon ds_icon icon-gplus"></i>';
      break;
  }

  $anchor = $icon . '<span class="ds_network_name">' . $text . '</span>';

  if ( 'ds_icon_v2' === $style || 'ds_icon_v3' === $style ) {
    $anchor = $icon . '<span class="ds_network_name">' . $share . '</span>';
  }

  $link = '<a target="_blank" rel="nofollow" title="Share on ' . $text . '" href="' . $url . '">' . $anchor . '</a>';

  return $link;
}


/**
 * Get the button styles
 *
 * @since   1.0.0
 *
 * @return  array
 *
 */
function drim_share_get_button_styles(){

  $btn_style = drim_share_get_option_values('drim_share_style');

  return $btn_style;

}


/**
 * Button positions
 *
 * @since   1.0.0
 *
 * @return  array
 *
 */
function drim_share_button_positions( $buttons, $content ){

  $output = '';
  $custom_styles = '';

  $brdr_color = drim_share_get_option_values('drim_share_style_border_color');
  if ( $brdr_color ) {
    $custom_styles .= '<style> .ds_wrapper.ds_brdr_top, .ds_wrapper.ds_brdr_bottom, .ds_wrapper.ds_brdr_both { border-color: ' . sanitize_text_field( $brdr_color ) . '; } </style>';
  }

  // get the button positions
  $position = drim_share_get_option_values('drim_share_position');

  switch ($position) {
    case 'above':
      $output .= $buttons . $custom_styles . $content;
      break;
    case 'below':
      $output .= $content . $buttons . $custom_styles;
      break;
   case 'both':
      $output .= $buttons . $content . $buttons . $custom_styles;
      break;
   default:
      $output .= $content;
      break;
  }

  // if is mobile browser and fixed mobile buttons option is selected
  if ( ds_is_mobile() === true && ds_fixed_on_mobile() === true ) {
    $output = $content . $buttons . $custom_styles;
  }

  return $output;

}


/**
 * Display the buttons
 *
 * @since   1.0.0.
 *
 * @return
 *
 */
function ds_display_social_buttons( $content ) {

  global $post;

  // get the buttons
  $buttons = drim_share_get_buttons();

  // check for post_types
  $post_types_allowed = drim_share_get_post_types_allowed();
  $homepage_allowed = drim_share_get_option_values('drim_share_post_type_page_home');
  $is_archive_allowed = drim_share_get_option_values('drim_share_post_type_page_archive');

  if ( in_array( $post->post_type, $post_types_allowed, true ) ) {
    $output = drim_share_button_positions( $buttons, $content );

  } else {
    $output = $content;
  }

  if ( !is_singular() && ( 1 != $is_archive_allowed ) ) {
    $output = $content;
  }

  if ( is_front_page() && ( 1 != $homepage_allowed ) ) {
    $output = $content;
  }

  // $fixed_on_mobile = drim_share_get_option_values('drim_share_position_mobile');
  // if ( 1 == $fixed_on_mobile ) {}

  return $output;

}

/**
 * Enable/Disable the plugin
 *
 * @since   1.0.0.
 *
 * @return
 *
 */
 add_filter( 'the_content', function($c){

   $enabled = drim_share_get_option_values('drim_share_enable_buttons');
   return ( 1 == $enabled ) ? ds_display_social_buttons($c) : $c;

 });
