<?php

/**
 * Admin area help views
 *
 * @link       https://drim.io/drim-share/
 * @since      1.0.0
 *
 * @package    Drim_Share
 * @subpackage Drim_Share/admin/partials
 */


 // get the svg icons file
 include_once dirname( dirname( __FILE__ ) ) . '/inc/svg-functions.php';
	?>

<div class="ds_help_popup">
  <p class="align-center">
	<span class="q_close">
		<?php echo ds_get_svg( array( 'icon' => 'close' ) ); ?>
	</span>
  </p>
  <img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . '/assets/images/ds_in_content.png'; ?>" class="ds_in_content ds_hidden" />
  <img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . '/assets/images/ds_fixed.png'; ?>" class="ds_fixed ds_hidden" />
  <img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . '/assets/images/ds_in_content_mobile.png'; ?>" class="ds_in_content_mobile ds_hidden" />
  <img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . '/assets/images/ds_fixed_mobile.png'; ?>" class="ds_fixed_mobile ds_hidden" />
  <img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . '/assets/images/ds_full_mobile.png'; ?>" class="ds_full_mobile ds_hidden" />
</div>
