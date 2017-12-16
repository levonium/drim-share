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

// get plugin version and nice name.
$drim         = new Drim_Share();
$drim_version = $drim->get_version();
$drim_name    = $drim->get_plugin_nice_name();

// get the svg icons file.
require_once dirname( dirname( __FILE__ ) ) . '/inc/svg-functions.php';

?>

<h2 class="no_margin_bottom"> 
	<?php echo esc_attr( $drim_name ); ?>
</h2>
<p>
	<?php
	printf(
		/* translators: 1. plugin version number. 2. plugin author name. */
		esc_attr__( 'Version: %1$s | Author: %2$s', 'drim-share' ),
		esc_attr( $drim_version ),
		'<a href="https://drim.io/" target="_blank">Levon Avetyan</a>'
	);
	?>
</p>

<p>
	<?php esc_attr_e( 'A simple light-weight and mobile-friendly social sharing plugin for WordPress.', 'drim-share' ); ?>
</p>

<hr />

<p>
	<a class="no_decoration small-icon" href="https://drim.io/drim-share/" target="_blank">  
		<?php
		echo ds_get_svg( array( 'icon' => 'wordpress' ) );
		esc_attr_e( 'Plugin Homepage', 'drim-share' );
		?>
	</a>
	<br />
	<a class="no_decoration small-icon" href="https://github.com/levonium/drim-share" target="_blank">  
		<?php
		echo ds_get_svg( array( 'icon' => 'github' ) );
		esc_attr_e( 'View on GitHub', 'drim-share' );
		?>
	</a>
	<br />
	<a class="no_decoration small-icon" href="https://drim.io/contact/" target="_blank">  
		<?php
		echo ds_get_svg( array( 'icon' => 'envelope-o' ) );
		esc_attr_e( 'Any questions?', 'drim-share' );
		?>
	</a>
</p>

<hr />

<p>
	<?php esc_attr_e( 'Share this plugin:', 'drim-share' ); ?>
</p>

<div class="ds_wrapper ds_align_left ds_no_brdr ds_no_heading" style="grid-template-columns: repeat( 4, 2em )">
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
			esc_attr__( 'Thank you for using %s.', 'drim-share' ),
			'<strong>' . esc_attr( $drim_name ) . '</strong>'
		);
		?>
		</p>
