<?php
/**
 * Drim Share Settings Fields
 *
 * @since 1.0.0
 *
 * @package    Drim_Share
 * @subpackage Drim_Share/admin/partials
 */

// main settings section.
$dss_main_section = array(
	'ds_settings_main',
	__( 'General Settings', 'drim-share' ),
);
$dss_main         = array(

	array(
		'ds_plugin_enable',
		__( 'Enable Plugin', 'drim-share' ),
	),

	array(
		'ds_networks',
		__( 'Social Networks', 'drim-share' ),
	),

);

// content area settings section.
$dss_content_section = array(
	'ds_content_settings',
	__( 'Content Area Icons', 'drim-share' ),
);
$dss_content         = array(
	array(
		'ds_position_content',
		__( 'Position', 'drim-share' ),
	),
	array(
		'ds_icon_type',
		__( 'Type', 'drim-share' ),
	),

	array(
		'ds_icon_shape',
		__( 'Shape', 'drim-share' ),
	),
	array(
		'ds_icon_style',
		__( 'Style', 'drim-share' ),
	),
	array(
		'ds_icons_padding',
		__( 'Padding', 'drim-share' ),
	),
	array(
		'ds_icons_size',
		__( 'Size', 'drim-share' ),
	),
	array(
		'ds_mixed_icons_split',
		__( 'Split into lines', 'drim-share' ),
	),
	array(
		'ds_mixed_icons_shorten',
		__( 'Hide some names', 'drim-share' ),
	),
	array(
		'ds_style_align',
		__( 'Alignment', 'drim-share' ),
	),

	array(
		'ds_style_borders',
		__( 'Separator Lines', 'drim-share' ),
	),

	array(
		'ds_heading',
		__( 'Heading Text', 'drim-share' ),
	),
	array(
		'ds_position_content_mobile',
		__( 'Hide on smaller screens', 'drim-share' ),
	),

	array(
		'ds_post_types',
		__( 'Post Types', 'drim-share' ),
	),
);


// fixed bars settings section.
$dss_fixed_section = array(
	'ds_fixed_settings',
	__( 'Fixed Bars Icons', 'drim-share' ),
);
$dss_fixed         = array(
	array(
		'ds_position_sticky',
		__( 'Position', 'drim-share' ),
	),
	array(
		'ds_icon_shape_fixed',
		__( 'Shape', 'drim-share' ),
	),
	array(
		'ds_icon_style_fixed',
		__( 'Style', 'drim-share' ),
	),
	array(
		'ds_icons_fixed_padding',
		__( 'Padding', 'drim-share' ),
	),
	array(
		'ds_icons_fixed_size',
		__( 'Size', 'drim-share' ),
	),
	array(
		'ds_position_sticky_mobile',
		__( 'Hide on smaller screens', 'drim-share' ),
	),

	array(
		'ds_position_sticky_mobile_full',
		__( 'Make Stretched on smaller screens', 'drim-share' ),
	),
);
