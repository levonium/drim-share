<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://drim.io/drim-share/
 * @since      1.0.0
 *
 * @package    Drim_Share
 * @subpackage Drim_Share/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php

function add_smth_to_content( $content ) {

  global $post;

  // a nwe function for locations
  $buttons_on_top = true;
  $buttons_on_bottom = true;

  $output = '';

  // new functions for buttons and their design 
  $buttons = 'share on facebook';

  // a new function for post_types
  $post_types_allowed = array( 'page' );
  if ( in_array( $post->post_type, $post_types_allowed ) ) {

    if ( $buttons_on_top ) {
      $output .= $buttons . $content;
    } else {
      $output .= $contnet;
    }

    if ( $buttons_on_bottom ) {
      $output .=  $buttons;
    }
  } else {
    $output .= $content;
  }

  return $output;
}
add_filter( 'the_content', 'add_smth_to_content' );
