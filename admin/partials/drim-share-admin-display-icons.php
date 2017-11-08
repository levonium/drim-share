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

 $whatsapp_enabled = ds_get_option_values('ds_network_whatsapp');
 $whatsapp_enabled_class = ( 1 == $whatsapp_enabled ) ? 'ds_active' : '';

 // get the initial values
 $icon_shape = ( '' != ds_get_button_shape() ) ? ds_get_button_shape() : 'ds_square';
 $icon_type = ( '' != ds_get_button_type() ) ? ds_get_button_type() : 'ds_icon';
 $icon_style = ( '' != ds_get_button_styles() ) ? ds_get_button_styles() : 'ds_default';

 $bttn_class = $icon_shape . ' ' . $icon_type . ' ' . $icon_style;

 $ds_mixed_open_tags = '';
 $ds_mixed_middle_tags = '';
 $ds_mixed_close_tags = '';

 if ( 'ds_mixed' === $icon_type ) {
   $ds_mixed_open_tags = '<div class="anchor-grid"><span class="anchor-item">';
   $ds_mixed_middle_tags = '</span><span class="anchor-item">';
   $ds_mixed_close_tags = '</span></div>';
 }

?>

<div class="ds_examples_container">

  <div id="ds_example" class="ds_wrapper ds_align_left ds_no_brdr ds_no_heading">
    <div class="ds_bttn ds_facebook <?php echo $bttn_class; ?>">
      <a target="_blank" rel="nofollow" title="Share on Facebook" href="#">
        <?php echo $ds_mixed_open_tags; ?>
        <?php echo ds_get_svg( array( 'icon' => 'ds_facebook' ) ); ?>
        <?php echo $ds_mixed_middle_tags; ?>
        <span class="ds_network_name">Facebook</span>
        <?php echo $ds_mixed_close_tags; ?>
      </a>
    </div>
    <div class="ds_bttn ds_twitter <?php echo $bttn_class; ?>">
      <a target="_blank" rel="nofollow" title="Share on Twitter" href="#">
        <?php echo $ds_mixed_open_tags; ?>
        <?php echo ds_get_svg( array( 'icon' => 'ds_twitter' ) ); ?>
        <?php echo $ds_mixed_middle_tags; ?>
        <span class="ds_network_name">Twitter</span>
        <?php echo $ds_mixed_close_tags; ?>
      </a>
    </div>
    <div class="ds_bttn ds_linkedin <?php echo $bttn_class; ?>">
      <a target="_blank" rel="nofollow" title="Share on LinkedIn" href="#">
        <?php echo $ds_mixed_open_tags; ?>
        <?php echo ds_get_svg( array( 'icon' => 'ds_linkedin' ) ); ?>
        <?php echo $ds_mixed_middle_tags; ?>
        <span class="ds_network_name">LinkedIn</span>
        <?php echo $ds_mixed_close_tags; ?>
      </a>
    </div>
    <div class="ds_bttn ds_googleplus <?php echo $bttn_class; ?>">
      <a target="_blank" rel="nofollow" title="Share on Google Plus" href="#">
        <?php echo $ds_mixed_open_tags; ?>
        <?php echo ds_get_svg( array( 'icon' => 'ds_googleplus' ) ); ?>
        <?php echo $ds_mixed_middle_tags; ?>
        <span class="ds_network_name">Google Plus</span>
        <?php echo $ds_mixed_close_tags; ?>
      </a>
    </div>
    <div class="ds_bttn ds_pinterest <?php echo $bttn_class; ?>">
      <a target="_blank" rel="nofollow" title="Share on Pinterest" href="#">
        <?php echo $ds_mixed_open_tags; ?>
        <?php echo ds_get_svg( array( 'icon' => 'ds_pinterest' ) ); ?>
        <?php echo $ds_mixed_middle_tags; ?>
        <span class="ds_network_name">Pinterest</span>
        <?php echo $ds_mixed_close_tags; ?>
      </a>
    </div>
    <div class="ds_hidden <?php echo $whatsapp_enabled_class; ?> ds_bttn ds_whatsapp <?php echo $bttn_class; ?>">
      <a target="_blank" rel="nofollow" title="Share on WhatsApp" href="#">
        <?php echo $ds_mixed_open_tags; ?>
        <?php echo ds_get_svg( array( 'icon' => 'ds_whatsapp' ) ); ?>
        <?php echo $ds_mixed_middle_tags; ?>
        <span class="ds_network_name">WhatsApp</span>
        <?php echo $ds_mixed_close_tags; ?>
      </a>
    </div>
  </div>

</div>
