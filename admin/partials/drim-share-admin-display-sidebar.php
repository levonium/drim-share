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

// get the svg icons file
include_once dirname( dirname(__FILE__) ) . '/inc/svg-functions.php';

?>

<div class="fixed-top">

  <h2 class="no_margin_bottom"> <?php _e( 'DR!M SHARE', 'drim-share' ); ?> </h2>
  <p>
    Version <?php echo $drim_version; ?> | <?php _e( 'Author: ', 'drim-share' ); ?> <a href="https://drim.io/" target="_blank">Levon Avetyan</a>
  </p>

  <p class="ds_notice">
    <?php _e( 'To make the plugin start, please make sure to select the following fields:', 'drim-share' ); ?>
  </p>
  <ol>
    <li>
      <?php _e( 'Enable the plugin', 'drim-share' ); ?>
    </li>
    <li>
      <?php _e( 'Select Social Networks', 'drim-share' ); ?>
    </li>
    <li>
      <?php _e( 'Select the position', 'drim-share' ); ?>
    </li>
    <li>
      <?php _e( 'Select the post types.', 'drim-share' ); ?>
    </li>
  </ol>

</div>

<div class="separator-big"></div>

<div class="fixed-middle">

  <p>
    <?php _e( 'A simple light-weight and mobile-friendly social sharing plugin for WordPress.', 'drim-share' ); ?>
  </p>

  <p>
    <a class="no_decoration small-icon" href="https://drim.io/drim-share/" target="_blank">  <?php echo ds_get_svg( array( 'icon' => 'wordpress' ) ); ?> Read more </a>
  <br />
    <a class="no_decoration small-icon" href="https://github.com/levonium/drim-share" target="_blank">  <?php echo ds_get_svg( array( 'icon' => 'github' ) ); ?> View on GitHub </a>
  <br />
    <a class="no_decoration small-icon" href="https://drim.io/contact/" target="_blank">  <?php echo ds_get_svg( array( 'icon' => 'envelope-o' ) ); ?> Any questions? </a>
  </p>

  <hr />

  <p>
    <?php _e( 'Share this plugin:', 'drim-share' ); ?>
  </p>

  <div class="ds_wrapper ds_align_center ds_no_brdr ds_no_heading" style="grid-template-columns: 1fr 1fr">
    <div class="ds_bttn ds_square ds_mixed ds_default ds_facebook">
      <a target="_blank" rel="nofollow" title="Share on Facebook" href="https://www.facebook.com/sharer/sharer.php?u=https://drim.io/drim-share/">
        <div class="anchor-grid">
          <span class="anchor-item">
            <?php echo ds_get_svg( array( 'icon' => 'ds_facebook' ) ); ?>
          </span>
          <span class="anchor-item">
            <span class="ds_network_name">Facebook</span>
          </span>
        </div>
      </a>
    </div>
    <div class="ds_bttn ds_square ds_mixed ds_default ds_twitter">
      <a target="_blank" rel="nofollow" title="Share on Twitter" href="https://twitter.com/home?status=https://drim.io/drim-share/%20A%20simple%20light-weight%20and%20mobile-friendly%20social%20sharing%20plugin%20for%20WordPress.">
        <div class="anchor-grid">
          <span class="anchor-item">
            <?php echo ds_get_svg( array( 'icon' => 'ds_twitter' ) ); ?>
          </span>
          <span class="anchor-item">
            <span class="ds_network_name">Twitter</span>
          </span>
        </div>
      </a>
    </div>
    <div class="ds_bttn ds_square ds_mixed ds_default ds_linkedin">
      <a target="_blank" rel="nofollow" title="Share on LinkedIn" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://drim.io/drim-share/&amp;title=A simple light-weight and mobile-friendly social sharing plugin for WordPress.&amp;summary=">
        <div class="anchor-grid">
          <span class="anchor-item">
            <?php echo ds_get_svg( array( 'icon' => 'ds_linkedin' ) ); ?>
          </span>
          <span class="anchor-item">
            <span class="ds_network_name">LinkedIn</span>
          </span>
        </div>
      </a>
    </div>
    <div class="ds_bttn ds_square ds_mixed ds_default ds_googleplus">
      <a target="_blank" rel="nofollow" title="Share on Google Plus" href="https://plus.google.com/share?url=https://drim.io/drim-share/">
        <div class="anchor-grid">
          <span class="anchor-item">
            <?php echo ds_get_svg( array( 'icon' => 'ds_googleplus' ) ); ?>
          </span>
          <span class="anchor-item">
            <span class="ds_network_name">Google Plus</span>
          </span>
        </div>
      </a>
    </div>
  </div>
  <hr />

  <p>
    <span class="medium-icon"> <?php echo ds_get_svg( array( 'icon' => 'happy' ) ); ?> </span>
    <?php _e( 'Thank you for using ', 'drim-share' ); ?>
    <strong> <?php _e( 'DR!M SHARE', 'drim-share' ); ?></strong>.
  </p>

</div>
