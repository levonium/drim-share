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

// get the whatssapp field value
$is_whatsapp_selected = isset( $this->options['drim_share_mobile_icons_whatsapp'] ) ? $this->options['drim_share_mobile_icons_whatsapp'] : '';
$show_hide_whatsapp = ( $is_whatsapp_selected ) ? ' ds_active' : '';


?>

<div class="separator"></div>

<div id="ds_example_mobile" class="ds_wrapper ds_align_left ds_no_brdr ds_no_heading <?php echo ( '' != $ds_opt ) ? $ds_opt : 'ds_icon_v1'; ?>">
  <div class="ds_bttn ds_facebook">
    <a target="_blank" rel="nofollow" title="Share on Facebook" href="#">
      <i class="demo-icon ds_icon icon-facebook"></i>
    </a>
  </div>
  <div class="ds_bttn ds_twitter">
    <a target="_blank" rel="nofollow" title="Share on Twitter" href="#">
      <i class="demo-icon ds_icon icon-twitter"></i>
    </a>
  </div>
  <div class="ds_bttn ds_linkedin">
    <a target="_blank" rel="nofollow" title="Share on LinkedIn" href="#">
      <i class="demo-icon ds_icon icon-linkedin"></i>
    </a>
  </div>
  <div class="ds_bttn ds_googleplus">
    <a target="_blank" rel="nofollow" title="Share on Google Plus" href="#">
      <i class="demo-icon ds_icon icon-gplus-1"></i>
    </a>
  </div>
  <div class="ds_bttn ds_pinterest">
    <a target="_blank" rel="nofollow" title="Share on Pinterest" href="#">
      <i class="demo-icon ds_icon icon-pinterest-1"></i>
    </a>
  </div>
  <div class="ds_bttn ds_whatsapp ds_hidden <?php echo $show_hide_whatsapp; ?>">
    <a target="_blank" rel="nofollow" title="Send via WhatsApp" href="#">
      <i class="demo-icon ds_icon icon-whatsapp"></i>
    </a>
  </div>
</div>
