<?php
/**
 * Provide a admin area view for the plugin
 *
 * @link       https://drim.io/drim-share/
 * @since      1.0.2
 *
 * @package    Drim_Share
 * @subpackage Drim_Share/admin/partials
 */
?>

<?php
// get plugin version
$drim = new Drim_Share();
$drim_version = $drim->get_version();
?>

<h2 class="no_margin_bottom"> Drim Share </h2>
<p>
  Version <?php echo $drim_version; ?>
</p>
<p>
  <?php _e( 'A simple light-weight and mobile-friendly social sharing plugin for WordPress.', 'drim-share' ); ?>
</p>

<p>
  <?php _e( 'Author: ', 'drim-share' ); ?> <a href="https://drim.io/" target="_blank">Levon Avetyan</a>
  <a class="no_decoration" href="https://drim.io/drim-share/" target="_blank"><i class="demo-icon ds_icon icon-wordpress"></i></a>
  <a class="no_decoration" href="https://github.com/levonium/drim-share" target="_blank"><i class="demo-icon ds_icon icon-github-1"></i></a>
  <a class="no_decoration" href="https://drim.io/contact/" target="_blank"><i class="demo-icon ds_icon icon-mail-alt"></i></a>
</p>

<hr />

<p>
  <?php _e( 'Share this plugin:', 'drim-share' ); ?>
</p>

<div class="ds_wrapper ds_icon_v1 ds_align_left ds_no_brdr ds_no_heading">
  <div class="ds_bttn ds_facebook">
    <a target="_blank" rel="nofollow" title="Share on Facebook" href="https://www.facebook.com/sharer/sharer.php?u=https://drim.io/drim-share/">
      <i class="demo-icon ds_icon icon-facebook"></i>
      <span class="ds_network_name">Facebook</span>
    </a>
  </div>
  <div class="ds_bttn ds_twitter">
    <a target="_blank" rel="nofollow" title="Share on Twitter" href="https://twitter.com/home?status=https://drim.io/drim-share/%20DRIM%20SHARE:%20a%20simple%20social%20sharing%20plugin%20for%20WP">
      <i class="demo-icon ds_icon icon-twitter"></i>
      <span class="ds_network_name">Twitter</span>
    </a>
  </div>
  <div class="ds_bttn ds_linkedin">
    <a target="_blank" rel="nofollow" title="Share on LinkedIn" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://drim.io/drim-share/&amp;title=DRIM%20SHARE&amp;summary=DRIM%20SHARE:%20a%20simple%20social%20sharing%20plugin%20for%20WP">
      <i class="demo-icon ds_icon icon-linkedin"></i>
      <span class="ds_network_name">LinkedIn</span>
    </a>
  </div>
  <div class="ds_bttn ds_googleplus">
    <a target="_blank" rel="nofollow" title="Share on Google Plus" href="https://plus.google.com/share?url=https://drim.io/drim-share/">
      <i class="demo-icon ds_icon icon-gplus-1"></i>
      <span class="ds_network_name">Google Plus</span>
    </a>
  </div>
</div>

<hr />

<p>
  <i class="demo-icon ds_icon icon-child highlight_red highlight_big"></i>
  <?php _e( 'Thank you for using ', 'drim-share' ); ?>
  <strong>Drim Share</strong>.
</p>
