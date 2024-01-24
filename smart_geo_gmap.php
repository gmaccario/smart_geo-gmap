<?php
/**
 * My SmartGeoGMap old main file upgrade routine
 *
 * This is the old plugin main file.
 * Keep it for backward upgrade compatibility.
 *
 * @package SmartGeoGMap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$old = 'smart_geo_gmap.php'; // Change this.
$new = 'smart-geo-gmap.php'; // Change this.

// Change the active plugin settings to make WP start using the new one.
$active_plugins = (array) get_option( 'active_plugins', [] );

$old_plugin_array = [ basename( __DIR__ ) . DIRECTORY_SEPARATOR . $old ];
$active_plugins   = array_diff( $active_plugins, $old_plugin_array );

$new_plugin = basename( __DIR__ ) . DIRECTORY_SEPARATOR . $new;
if ( ! in_array( $new_plugin, $active_plugins ) ) {
	$active_plugins[] = $new_plugin;

	include_once __DIR__ . DIRECTORY_SEPARATOR . $new;
}

// Update active plugins and never come back here.
update_option( 'active_plugins', $active_plugins );
