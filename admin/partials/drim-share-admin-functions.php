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
 * @return mixed
 *
 * @param string $option_name Option name.
 */
function ds_get_option_values( $option_name ) {

	$ds_options = ds_get_ds_options();
	return isset( $ds_options[ $option_name ] ) ? $ds_options[ $option_name ] : '';

}

/**
 * Available social networks
 *
 * @since   1.0.0
 * @return  array
 */
function ds_get_available_social_networks() {

	$_networks = [
		'facebook'    => __( 'Facebook', 'drim-share' ),
		'twitter'     => __( 'Twitter', 'drim-share' ),
		'linkedin'    => __( 'LinkedIn', 'drim-share' ),
		'pinterest'   => __( 'Pinterest', 'drim-share' ),
		'stumbleupon' => __( 'StumbleUpon', 'drim-share' ),
		'vk'          => __( 'VK', 'drim-share' ),
		'reddit'      => __( 'Reddit', 'drim-share' ),
		'buffer'      => __( 'Buffer', 'drim-share' ),
		'whatsapp'    => __( 'WhatsApp', 'drim-share' ),
	];

	return $_networks;
}


/**
 * Get selected social networks
 *
 * @since  1.0.0
 * @return array
 */
function ds_get_selected_social_networks() {

	$ds_networks_         = ds_get_option_values( 'ds_networks_' );
	$ds_selected_networks = explode( ',', $ds_networks_ );

	return $ds_selected_networks;
}


/**
 * Get allowed post types
 *
 * @since   1.0.0
 * @return  array
 */
function ds_get_post_types_allowed() {

	$post_types_allowed = [];

	// posts.
	$display_in_posts = ( ds_get_option_values( 'ds_post_type_post' ) == 1 ) ? true : false;
	if ( $display_in_posts ) {
		$post_types_allowed[] = 'post';
	}

	// pages.
	$display_in_pages = ( ds_get_option_values( 'ds_post_type_page' ) == 1 ) ? true : false;
	if ( $display_in_pages ) {
		$post_types_allowed[] = 'page';
	}

	// custom post types.
	$post_types_args     = [
		'public'   => true,
		'_builtin' => false,
	];
	$post_types_output   = 'names';
	$post_types_operator = 'and';

	$ds_post_types = get_post_types( $post_types_args, $post_types_output, $post_types_operator );

	foreach ( $ds_post_types as $ds_post_type ) {

		${"display_in_$ds_post_type"} = ( ds_get_option_values( 'ds_post_type_' . $ds_post_type ) == 1 ) ? true : false;
		if ( ${"display_in_$ds_post_type"} ) {
			$post_types_allowed[] = $ds_post_type;
		}
	}

	return $post_types_allowed;

}


/**
 * Check if it's a mobile browser (excludding tablets)
 *
 * @deprecated 1.0.1
 *
 * @since 1.0.0
 * @return bool
 */
function ds_is_mobile_device() {

	include_once dirname( dirname( __FILE__ ) ) . '/inc/class-mobile-detect.php';
	$is_mobile = new Mobile_Detect();

	if ( $is_mobile->isMobile() && ! $is_mobile->isTablet() ) {
		return true;
	}

	return false;
}


/**
 * Is Fixed bar option enabled
 *
 * @since 1.0.0
 * @return mixed
 */
function ds_fixed_bar() {

	$is_fixed = ds_get_option_values( 'ds_position_sticky' );
	return ( $is_fixed && 'none' != $is_fixed ) ? $is_fixed : '';

}


/**
 * Check if to have a fixed bar on mobile browsers
 *
 * @since 1.0.0
 * @return bool
 */
function ds_fixed_bar_mobile() {

	$is_fixed_on_mobile = ds_get_option_values( 'ds_position_sticky_mobile' );
	return ( 0 == $is_fixed_on_mobile ) ? true : false;

}


/**
 * Check if it is 100% wide fixed bar
 *
 * @since 1.0.0
 * @return bool
 */
function ds_fixed_bar_mobile_full() {

	$is_fixed_on_mobile_full = ds_get_option_values( 'ds_position_sticky_mobile_full' );
	return ( 1 == $is_fixed_on_mobile_full ) ? true : false;

}


/**
 * Get border options
 *
 * @since 1.0.0
 * @return string
 */
function ds_get_border_options() {

	$borders = ds_get_option_values( 'ds_style_borders' );
	return ( $borders ) ? $borders : 'ds_no_border';

}


/**
 * Get buttons alignment
 *
 * @since 1.0.0
 * @return string
 */
function ds_get_alignment() {

	$ds_alignment = ds_get_option_values( 'ds_style_align' );
	return ( $ds_alignment ) ? $ds_alignment : 'ds_align_left';

}


/**
 * Get heading options
 *
 * @since 1.0.0
 * @return array $heading_options['heading class', 'heading tag']
 */
function ds_get_heading_options() {

	$heading_options = [];

	$has_heading  = 'ds_no_heading';
	$heading_wpml = '';
	$heading_tag  = '';

	$heading = ds_get_option_values( 'ds_heading' );

	if ( $heading ) {
		$has_heading = 'ds_has_heading';

		do_action( 'wpml_register_single_string', 'drim-share', 'Block Heading', $heading );
		$heading_wpml = apply_filters( 'wpml_translate_single_string', $heading, 'drim-share', 'Block Heading' );

		$heading_tag = '<div class="ds_heading">' . sanitize_text_field( $heading_wpml ) . '</div>';

	}

	$heading_options['has_heading'] = $has_heading;
	$heading_options['heading_tag'] = $heading_tag;

	return $heading_options;

}


/**
 * Get the button types
 * add ds_ preffix (e.g. ds_icon, etc.)
 *
 * @since 1.0.0
 * @return string $icon_type
 */
function ds_get_button_type() {

	$icon_type = ds_get_option_values( 'ds_icon_type' );
	return ( '' != $icon_type ) ? 'ds_' . $icon_type : '';

}


/**
 * Get the button shapes
 * add ds_ preffix (e.g. ds_square, etc.)
 *
 * @since 1.0.0
 * @return string $icon_shape
 */
function ds_get_button_shape() {

	$icon_shape = ds_get_option_values( 'ds_icon_shape' );
	return ( '' != $icon_shape ) ? 'ds_' . $icon_shape : '';

}


/**
 * Get the button styles
 *
 * @since 1.0.0
 * @return string $icon_set (e.g. icons_v1, icons_v2, etc.)
 */
function ds_get_button_styles() {

	$icon_set = ds_get_option_values( 'ds_icon_style' );
	return ( '' != $icon_set ) ? $icon_set : '';

}


/**
 * Get the button shapes for fixed bars
 * add ds_ preffix (e.g. ds_square, etc.)
 *
 * @since 1.0.1
 * @return string $icon_shape
 */
function ds_get_button_shape_fixed() {

	$icon_shape = ds_get_option_values( 'ds_icon_shape_fixed' );
	return ( '' != $icon_shape ) ? 'ds_' . $icon_shape : '';

}


/**
 * Get the button styles for fixed bars
 *
 * @since 1.0.1
 * @return string $icon_set (e.g. icons_v1, icons_v2, etc.)
 */
function ds_get_button_styles_fixed() {

	$icon_set = ds_get_option_values( 'ds_icon_style_fixed' );
	return ( '' != $icon_set ) ? $icon_set : '';

}


/**
 * Make the ds_container tag
 * a wrapper div for fixed bar buttons only
 *
 * @since 1.0.0
 * @return array $ds_container_tag
 */
function ds_make_container_tag() {

	$fixed_bar       = ds_fixed_bar();
	$fixed_bar_class = ( $fixed_bar ) ? 'sticky_' . $fixed_bar : '';

	$fixed_bar_class_mobile      = ( true == ds_fixed_bar_mobile() ) ? '' : 'hide_on_mobie ';
	$fixed_bar_mobile_full_class = ( ds_fixed_bar_mobile_full() === true ) ? 'ds_container_full ' : '';

	$ds_container_class = $fixed_bar_class_mobile . $fixed_bar_mobile_full_class . $fixed_bar_class;

	$ds_container_open  = '<div class="ds_container ' . $ds_container_class . '">';
	$ds_container_close = '</div>';

	$ds_container_tag = [
		'open'  => $ds_container_open,
		'close' => $ds_container_close,
	];

	return $ds_container_tag;

}


/**
 * Make the ds_wrapper tag
 * the main buttons wrapper div tag
 *
 * @since 1.0.0
 * @return array $ds_wrapper_tag
 *
 * @param string $position defines the icons position: content or fixed bar.
 */
function ds_make_wrapper_tag( $position = null ) {

	$in_content_class = '';
	if ( 'content' === $position ) {

		$in_content_class = ' ds_in_content ';

		// if chosen to hide on smaller screens.
		// appends a new class - hide_on_mobile.
		$hide_on_mobie     = ds_get_option_values( 'ds_position_content_mobile' );
		$in_content_class .= ( 1 == $hide_on_mobie ) ? 'hide_on_mobie ' : '';

		// appends new classes for alignment, borders, heading.
		$ds_has_border      = ds_get_border_options();
		$ds_alignment       = ds_get_alignment();
		$ds_heading_options = ds_get_heading_options();

		// append new class if is mixed and some names are hidden.
		$make_shorter       = ds_get_option_values( 'ds_mixed_icons_shorten' );
		$icon_type          = ds_get_button_type();
		$make_shorter_class = ( 'ds_mixed' === $icon_type && 1 == $make_shorter ) ? ' shorter' : '';

		// append new class if it's splitted into rows.
		$split_into_lines = ds_get_option_values( 'ds_mixed_icons_split' );
		$splitted         = ( $split_into_lines && 0 !== $split_into_lines && 1 != $make_shorter ) ? ' splitted' : '';

		$in_content_class .= $ds_alignment . ' ' . $ds_has_border . ' ' . $ds_heading_options['has_heading'] . $splitted . $make_shorter_class;
	}

	$ds_wrapper_class = $in_content_class;

	$ds_wrapper_open  = '<div class="ds_wrapper' . $ds_wrapper_class . '">';
	$ds_wrapper_close = '</div>';

	$ds_wrapper_tag = [
		'open'  => $ds_wrapper_open,
		'close' => $ds_wrapper_close,
	];

	return $ds_wrapper_tag;

}


/**
 * Make the style tag
 *
 * @since 1.0.0
 * @return string
 */
function ds_make_style_tag() {

	$ds_style_tag  = '';
	$custom_styles = '';

	$button_styles = ds_get_button_styles();

	$ds_selected_networks = ds_get_selected_social_networks();
	$items                = count( $ds_selected_networks );

	// styles specific to content area.
	$border_color = ds_get_option_values( 'ds_style_border_color' );
	if ( $border_color ) {
		$custom_styles .= ' .ds_wrapper.ds_brdr_top, .ds_wrapper.ds_brdr_bottom, .ds_wrapper.ds_brdr_both { border-color: ' . sanitize_text_field( $border_color ) . '; } ';
	}
	$icon_size = ds_get_option_values( 'ds_icons_size' );
	if ( 100 !== $icon_size ) {
		$custom_styles .= '.ds_wrapper.ds_in_content { font-size: ' . $icon_size / 100 . 'em }';
	}
	$icon_padding = ds_get_option_values( 'ds_icons_padding' );
	if ( ( $icon_padding ) ) {
		$custom_styles .= '.ds_wrapper.ds_in_content { grid-gap: ' . $icon_padding . 'px }';
	}
	$icons_in_a_line = ds_get_option_values( 'ds_mixed_icons_split' );
	if ( $icons_in_a_line && 0 !== $icons_in_a_line ) {
		$custom_styles .= '.ds_wrapper.ds_in_content.splitted { grid-template-columns: repeat(' . $icons_in_a_line . ',auto) }';
	}

	// styles specific to fixed bars.
	$fixed_bar = ds_fixed_bar();
	if ( $fixed_bar ) {
		$custom_styles .= '.ds_container { top: calc((100% - ' . $items * 2 . 'em) / 2); }';

		$icon_size_fixed = ds_get_option_values( 'ds_icons_fixed_size' );
		if ( 100 !== $icon_size_fixed ) {
			$custom_styles .= '.ds_container .ds_wrapper { font-size: ' . $icon_size_fixed / 100 . 'em }';
		}
		$icon_padding_fixed = ds_get_option_values( 'ds_icons_fixed_padding' );
		if ( ( $icon_padding_fixed ) ) {
			$custom_styles .= '.ds_container .ds_wrapper .ds_bttn { margin: ' . $icon_padding_fixed / 2 . 'px }';
		}
		if ( true === ds_fixed_bar_mobile_full() ) {
			$custom_styles .= '@media screen and (max-width: 720px) { .ds_container.ds_container_full .ds_wrapper:not(.ds_in_content) { grid-template-columns: repeat(' . $items . ',1fr); } }';
		}
	}

	if ( '' != $custom_styles ) {
		$ds_style_tag = '<style>' . $custom_styles . '</style>';
	}

	return $ds_style_tag;

}


/**
 * Make social network Links
 *
 * @since 1.0.0
 * @return string $link
 *
 * @param string $network Social network name.
 */
function ds_make_link_tags( $network ) {

	global $post;

	$thumb = has_post_thumbnail( $post ) ? get_the_post_thumbnail_url( $post ) : '';
	$title = get_the_title( $post );

	switch ( $network ) {
		case 'facebook':
			$url  = 'https://www.facebook.com/sharer/sharer.php?u=' . get_permalink( $post );
			$text = 'Facebook';
			break;
		case 'twitter':
			$url  = 'https://twitter.com/intent/tweet?text=' . get_permalink( $post ) . '%20' . $title;
			$text = 'Twitter';
			break;
		case 'linkedin':
			$url  = 'https://www.linkedin.com/shareArticle?mini=true&url=' . get_permalink( $post ) . '&title=' . get_the_title( $post ) . '&summary=';
			$text = 'LinkedIn';
			break;
		case 'pinterest':
			$url  = 'https://pinterest.com/pin/create/button/?url=' . get_permalink( $post ) . '&media=' . $thumb . '&description=';
			$text = 'Pinterest';
			break;
		case 'reddit':
			$url  = 'https://reddit.com/submit?url=' . get_permalink( $post ) . '&title=' . get_the_title( $post );
			$text = 'Reddit';
			break;
		case 'stumbleupon':
			$url  = 'http://www.stumbleupon.com/submit?url=' . get_permalink( $post ) . '&title=' . get_the_title( $post );
			$text = 'StumbleUpon';
			break;
		case 'vk':
			$url  = 'http://vk.com/share.php?url=' . get_permalink( $post );
			$text = 'VK';
			break;
		case 'buffer':
			$url  = 'https://buffer.com/add?url=' . get_permalink( $post ) . '&text=' . get_the_title( $post );
			$text = 'Buffer';
			break;
		case 'whatsapp':
			$url  = 'whatsapp://send?text=' . get_permalink( $post );
			$text = 'WhatsApp';
			break;
	}

	// include icons file.
	include_once dirname( dirname( __FILE__ ) ) . '/inc/svg-functions.php';
	$icon = ds_get_svg( array( 'icon' => 'ds_' . $network ) );

	// link data-action attribute.
	$action = 'whatsapp' === $network ? ' data-action="share/whatsapp/share"' : '';

	// link anchor.
	$anchor = $icon . '<span class="ds_network_name">' . $text . '</span>';

	$icon_type = ds_get_button_type();
	if ( 'ds_mixed' === $icon_type ) {
		$anchor = '<div class="anchor-grid"><span class="anchor-item">' . $icon . '</span><span class="anchor-item"><span class="ds_network_name">' . $text . '</span></span></div>';
	}

	// link tag.
	$link = '<a target="_blank" rel="nofollow" title="Share on ' . $text . '" href="' . $url . '"' . $action . '>' . $anchor . '</a>';

	return $link;
}


/**
 * Make the individual icons
 *
 * @since 1.0.0
 * @return string
 *
 * @param string $network Social network name.
 */
function ds_make_icons( $network ) {

	$icon_shape       = ds_get_button_shape();
	$icon_type        = ds_get_button_type();
	$ds_buttons_style = ds_get_button_styles();

	return '<div class="ds_bttn ' . $icon_shape . ' ' . $icon_type . ' ' . $ds_buttons_style . ' ds_' . $network . '">' . ds_make_link_tags( $network ) . '</div>';

}

/**
 * Make the individual icons for fixed bars
 *
 * @since 1.0.0
 * @return string
 *
 * @param string $network Social network name.
 */
function ds_make_icons_fixed( $network ) {

	$icon_type        = 'ds_icon';
	$icon_shape       = ds_get_button_shape_fixed();
	$ds_buttons_style = ds_get_button_styles_fixed();

	return '<div class="ds_bttn ' . $icon_shape . ' ' . $icon_type . ' ' . $ds_buttons_style . ' ds_' . $network . '">' . ds_make_link_tags( $network ) . '</div>';

}


/**
 * Make the buttons
 *
 * @param string $position ( content || fixed ).
 *
 * @since 1.0.0
 * @return string
 */
function ds_make_buttons( $position ) {

	$buttons = '';

	$ds_wrapper_tag = ds_make_wrapper_tag( $position );
	$buttons       .= $ds_wrapper_tag['open'];

	if ( 'content' === $position ) {
		$heading_options = ds_get_heading_options();
		$buttons        .= $heading_options['heading_tag'];
	}

	$ds_selected_networks = ds_get_selected_social_networks();

	foreach ( $ds_selected_networks as $ds_selected_network ) {

		if ( 'content' === $position ) {
			$button = ds_make_icons( $ds_selected_network );
		} else {
			$button = ds_make_icons_fixed( $ds_selected_network );
		}

		$buttons .= $button;

	}

	$buttons .= $ds_wrapper_tag['close'];

	return $buttons;

}


/**
 * Get position of in content buttons
 *
 * @since 1.0.0
 *
 * @param string $buttons the buttons container.
 * @param string $content the post content.
 */
function ds_get_button_positions( $buttons, $content ) {

	$output = '';
	$styles = '';

	// if fixed bar is not enabled.
	// append styles to output.
	$is_fixed_bar_enabled = ds_fixed_bar();
	if ( ! $is_fixed_bar_enabled || 'none' === $is_fixed_bar_enabled ) {
		$styles = ds_make_style_tag();
	}

	// get the button positions.
	$position = ds_get_option_values( 'ds_position_content' );

	switch ( $position ) {
		case 'above':
			$output .= $buttons . $content;
			break;
		case 'below':
			$output .= $content . $buttons;
			break;
		case 'both':
			$output .= $buttons . $content . $buttons;
			break;
		case 'none':
		default:
			$output .= $content;
			break;
	}

	// append styles.
	$output .= $styles;

	return $output;

}


/**
 * Display in content buttons
 *
 * @since 1.0.0
 * @param string $content The post content.
 */
function ds_display_buttons_in_content( $content ) {

	global $post;

	$output = $content;

	// get the buttons.
	$buttons = ds_make_buttons( 'content' );

	// check for post_types/pages.
	$post_types_allowed  = ds_get_post_types_allowed();
	$is_homepage_allowed = ds_get_option_values( 'ds_post_type_page_home' );
	$is_archive_allowed  = ds_get_option_values( 'ds_post_type_page_archive' );

	if ( in_array( $post->post_type, $post_types_allowed, true ) ) {
		$output = ds_get_button_positions( $buttons, $content );
	}

	if ( ! is_singular() && ( 1 != $is_archive_allowed ) ) {
		$output = $content;
	}

	if ( is_front_page() && ( 1 != $is_homepage_allowed ) ) {
		$output = $content;
	}

	return $output;

}

/**
 * Check if the plugin is enabled
 *
 * @since 1.0.0
 * @return void
 */
add_filter(
	'the_content', function( $c ) {

		$enabled = ds_get_option_values( 'ds_plugin_enable' );
		return ( 1 == $enabled ) ? ds_display_buttons_in_content( $c ) : $c;

	}
);

 /**
  * Display fixed bar buttons
  *
  * @since 1.0.0
  * @return void
  */
function ds_display_buttons_fixed_bar() {

	$sticky_bar = ds_fixed_bar();
	if ( ( ! $sticky_bar ) ) {
		return;
	}

	   $ds_styles = ds_make_style_tag();

	   $ds_container = ds_make_container_tag();
	   $buttons      = ds_make_buttons( 'fixed' );

	   echo $ds_container['open'] . $buttons . $ds_styles . $ds_container['close'];
}

	/**
	* Check if the plugin is enabled
	*/
	add_action(
		'wp_footer', function( $c ) {

			$enabled = ds_get_option_values( 'ds_plugin_enable' );
			return ( 1 == $enabled ) ? ds_display_buttons_fixed_bar() : $c;

		}
	);
