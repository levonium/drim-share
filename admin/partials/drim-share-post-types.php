<?php
/**
 * Drim Share Post Types
 *
 * @package    Drim_Share
 * @subpackage Drim_Share/admin/partials
 *
 * @link  https://drim.io/drim-share/
 * @since 1.0.0
 */

/**
 * Drim Share Post Types
 *
 * @since 1.0.1
 *
 * @package    Drim_Share
 * @subpackage Drim_Share/admin/partials
 */
function ds_get_post_types() {

	// get plugin options.
	$ds_options = get_option( 'drim_share_settings_options' );

	// post type: post.
	$ds_opt = isset( $ds_options['ds_post_type_post'] ) ? esc_attr( $ds_options['ds_post_type_post'] ) : '';
	printf(
		'<input type="checkbox" id="ds_post_type_post" name="drim_share_settings_options[ds_post_type_post]" value="1" %s/>
		<label for="ds_post_type_post">' . esc_html__( 'Enable in Posts', 'drim-share' ) . '</label>',
		checked( 1, $ds_opt, false )
	);

	echo '<br />';

	// post types: page.
	$ds_opt_page = isset( $ds_options['ds_post_type_page'] ) ? esc_attr( $ds_options['ds_post_type_page'] ) : '';
	printf(
		'<input type="checkbox" id="ds_post_type_page" name="drim_share_settings_options[ds_post_type_page]" value="1" %s/>
		<label for="ds_post_type_page">' . esc_html__( 'Enable in Pages', 'drim-share' ) . '</label>',
		checked( 1, $ds_opt_page, false )
	);

	echo '<br /><br />';

	// custom post types.
	$ds_pt_args = array(
		'public'   => true,
		'_builtin' => false,
	);

	$ds_pt_output   = 'names';
	$ds_pt_operator = 'and';

	$ds_no_post_types = esc_html__( 'It seems you do not have any custom post types.', 'drim-share' );
	$ds_post_types    = get_post_types( $ds_pt_args, $ds_pt_output, $ds_pt_operator );

	if ( $ds_post_types ) {

		foreach ( $ds_post_types as $ds_post_type ) {

			$ds_opt_custom = isset( $ds_options[ 'ds_post_type_' . $ds_post_type ] ) ? esc_attr( $ds_options[ 'ds_post_type_' . $ds_post_type ] ) : '';

			printf(
				'<p><input type="checkbox" id="ds_post_type_%1$s" name="drim_share_settings_options[ds_post_type_%1$s]" value="1" %2$s/>
				<label for="ds_post_type_%1$s"> %3$s </label></p>',
				esc_html( $ds_post_type ),
				checked( 1, $ds_opt_custom, false ),
				esc_html( ucfirst( $ds_post_type ) )
			);
		}

		$ds_no_post_types = '';

	}

	echo esc_html( $ds_no_post_types );

	echo '<br /><br />';

	// front page.
	$ds_opt_homepage = isset( $ds_options['ds_post_type_page_home'] ) ? esc_attr( $ds_options['ds_post_type_page_home'] ) : '';

	printf(
		'<input type="checkbox" id="ds_post_type_page_home" name="drim_share_settings_options[ds_post_type_page_home]" value="1" %s/>
		<label for="ds_post_type_page_home">' . esc_html__( 'Enable for Static Front Page (Pages must be enabled)', 'drim-share' ) . '</label>',
		checked( 1, $ds_opt_homepage, false )
	);

	echo '<br />';

	// archive pages.
	$ds_opt_archive = isset( $ds_options['ds_post_type_page_archive'] ) ? esc_attr( $ds_options['ds_post_type_page_archive'] ) : '';

	printf(
		'<input type="checkbox" id="ds_post_type_page_archive" name="drim_share_settings_options[ds_post_type_page_archive]" value="1" %s/>
		<label for="ds_post_type_page_archive">' . esc_html__( 'Enable for Arhcive pages (Posts must be enabled)', 'drim-share' ) . '</label>',
		checked( 1, $ds_opt_archive, false )
	);

}
