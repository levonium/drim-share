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

  $buttons = '<div class="ds_wrapper ' . $buttons_style . '">';


  $heading  = drim_share_get_option_values('drim_share_heading');
  if ( $heading ) {
    $buttons .= '<div class="ds_heading">' . sanitize_text_field( $heading ) . '</div>';
  }

  foreach ($selected_networks as $network) {

    $button = '<div class="ds_bttn ds_'.$network.'">' . network_links( $network ) . '</div>';
    $buttons .= $button;
  }

  $buttons .= '</div>';

  $test = get_option('users_can_register');
  var_dump($test);

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

  $icon = '';
  $style = drim_share_get_button_styles();
  if ( 'ds_icon' === $style ) {
    $icondir = plugin_dir_url( dirname( dirname( __FILE__ ) ) ) . '/public/icons/';
    $iconurl = $icondir . $network . '.svg';
    $icon = '<img src="' . $iconurl . '" />';
  }

  switch ($network) {
    case 'facebook':
      $url = 'https://www.facebook.com/sharer/sharer.php?u=' . get_permalink( $post );
      $text = 'facebook';
      break;
    case 'twitter':
      $url = 'https://twitter.com/home?status=' . get_permalink( $post ) . ' ' . $title;
      $text = 'twitter';
      break;
    case 'linkedin':
      $url = 'https://www.linkedin.com/shareArticle?mini=true&url='. get_permalink( $post ) .'&title='. get_the_title( $post ) .'&summary=';
      $text = 'LinkedIn';
      break;
    case 'pinterest':
      $url = 'https://pinterest.com/pin/create/button/?url=' . get_permalink( $post ) . '&media=' . $thumb . '&description=';
      $text = 'Pinterest';
      break;
    case 'googleplus':
      $url = 'https://plus.google.com/share?url=' . get_permalink( $post );
      $text = 'Google Plus';
      break;
  }

  return '<a target="_blank" rel="nofollow" href="'.$url.'">' . $icon . '<span class="ds_network_name">'.$text.'</span></a>';
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

  // get the button positions
  $position = drim_share_get_option_values('drim_share_position');

  switch ($position) {
    case 'above':
      $output .= $buttons . $content;
      break;
    case 'below':
      $output .= $content . $buttons;
      break;
   case 'both':
      $output .= $buttons . $content . $buttons;
      break;
   default:
      $output .= $content;
      break;
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

  // new functions for buttons and their design
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

  if ( !is_singular() && ( 1 !== $is_archive_allowed ) ) {
    $output = $content;
  }

  if ( is_front_page() && ( 1 !== $homepage_allowed ) ) {
    $output = $content;
  }

  return $output;

}
add_filter( 'the_content', 'ds_display_social_buttons' );
