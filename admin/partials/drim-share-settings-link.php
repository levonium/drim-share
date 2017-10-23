<?php
/**
 * add a link to admin options page from plugins directory
 *
 * @since 1.0.0
 */
  add_filter( 'plugin_action_links', 'drim_share_add_action_plugin', 10, 5 );
  function drim_share_add_action_plugin( $links, $file ) {
  	static $plugin;
    $f = dirname(dirname(dirname(__FILE__))) . '/drim-share.php';

    if (!isset($plugin))
		  $plugin = plugin_basename($f);

    if ($plugin == $file) {
      $learn_more_link = array('settings' => '<a href="admin.php?page=drim_share_options">' . __('Settings', 'drim-share') . '</a>');
      $links = array_merge($learn_more_link, $links);
    }

    return $links;
  }
