<?php

/**
 * Provide a admin area view for the plugin
 *
 * @link       https://drim.io/drim-share/
 * @since      1.0.0
 *
 * @package    Drim_Share
 * @subpackage Drim_Share/admin/partials
 */


 // get the svg icons file
 include_once dirname( dirname(__FILE__) ) . '/inc/svg-functions.php';

?>

<div class="ds_icon_set ds_hidden">
  <span class="set_close small-icon">
    <?php echo ds_get_svg( array( 'icon' => 'close' ) ); ?>
  </span>
  <img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . '/assets/ds_icon_set.jpg'; ?>" />
</div>
