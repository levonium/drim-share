<?php
/**
 * Admin area sidebar content view
 *
 * @link       https://drim.io/drim-share/
 * @since      1.0.0
 *
 * @package    Drim_Share
 * @subpackage Drim_Share/admin/partials
 */
?>

<?php
// get plugin version
$drim         = new Drim_Share();
$drim_version = $drim->get_version();

// get the svg icons file
include_once dirname( dirname( __FILE__ ) ) . '/inc/svg-functions.php';

?>

<h2 class="no_margin_bottom"> <?php _e( 'DR!M SHARE', 'drim-share' ); ?> </h2>
<p>
<?php printf( 
	/* translators: 1. plugin version number. 2. plugin author name. */
	__( 'Version: %1$s | Author: %2$s', 'drim-share' ),
	$drim_version,
	'<a href="https://drim.io/" target="_blank">Levon Avetyan</a>' ); ?>
</p>

<p>
<?php _e( 'A simple light-weight and mobile-friendly social sharing plugin for WordPress.', 'drim-share' ); ?>
</p>

<hr />

<p class="ds_notice">
<?php _e( 'To make the plugin start, please make sure to select the following fields:', 'drim-share' ); ?>
</p>
<ol>
<li>
	<?php _e( 'Enable the plugin', 'drim-share' ); ?>
</li>
<li>
	<?php _e( 'Select social networks', 'drim-share' ); ?>
</li>
<li>
	<?php _e( 'Select the position', 'drim-share' ); ?>
</li>
<li>
	<?php _e( 'Select the post types.', 'drim-share' ); ?>
</li>
</ol>

<hr />

<p>
	<a class="no_decoration small-icon" href="https://drim.io/drim-share/" target="_blank">  <?php echo ds_get_svg( array( 'icon' => 'wordpress' ) ); _e( 'Plugin Homepage', 'drim-share' ); ?> </a>
  <br />
	<a class="no_decoration small-icon" href="https://github.com/levonium/drim-share" target="_blank">  <?php echo ds_get_svg( array( 'icon' => 'github' ) ); _e( 'View on GitHub', 'drim-share' ); ?> </a>
  <br />
	<a class="no_decoration small-icon" href="https://drim.io/contact/" target="_blank">  <?php echo ds_get_svg( array( 'icon' => 'envelope-o' ) ); _e( 'Any questions?', 'drim-share' ); ?> </a>
  </p>

  <hr />

  <p>
	<?php _e( 'Share this plugin:', 'drim-share' ); ?>
  </p>

  <div class="ds_wrapper ds_align_left ds_no_brdr ds_no_heading" style="grid-template-columns: repeat( 4, auto )">
	<div class="ds_bttn ds_square ds_icon ds_default ds_facebook">
	  <a target="_blank" rel="nofollow" title="Share on Facebook" href="https://www.facebook.com/sharer/sharer.php?u=https://drim.io/drim-share/">
			<?php echo ds_get_svg( array( 'icon' => 'ds_facebook' ) ); ?>
	  </a>
	</div>
	<div class="ds_bttn ds_square ds_icon ds_default ds_twitter">
	  <a target="_blank" rel="nofollow" title="Share on Twitter" href="https://twitter.com/home?status=https://drim.io/drim-share/%20A%20simple%20light-weight%20and%20mobile-friendly%20social%20sharing%20plugin%20for%20WordPress.">
		<?php echo ds_get_svg( array( 'icon' => 'ds_twitter' ) ); ?>
	  </a>
	</div>
	<div class="ds_bttn ds_square ds_icon ds_default ds_linkedin">
	  <a target="_blank" rel="nofollow" title="Share on LinkedIn" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://drim.io/drim-share/&amp;title=A simple light-weight and mobile-friendly social sharing plugin for WordPress.&amp;summary=">
		<?php echo ds_get_svg( array( 'icon' => 'ds_linkedin' ) ); ?>
	  </a>
	</div>
	<div class="ds_bttn ds_square ds_icon ds_default ds_googleplus">
	  <a target="_blank" rel="nofollow" title="Share on Google Plus" href="https://plus.google.com/share?url=https://drim.io/drim-share/">
		<?php echo ds_get_svg( array( 'icon' => 'ds_googleplus' ) ); ?>
	  </a>
	</div>
  </div>
  <hr />

  <p>
	<span class="medium-icon"> <?php echo ds_get_svg( array( 'icon' => 'happy' ) ); ?> </span>
	<?php 
	printf( 
		/* translators: %s: plugin name. */
		__( 'Thank you for using %s.', 'drim-share' ), 
		'<strong> DR!M SHARE </strong>' ); ?>
  </p>
