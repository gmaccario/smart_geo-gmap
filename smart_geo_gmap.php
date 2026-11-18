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

/**
 * Change the active plugin settings to make WP start using the new main file, and never come back here.
 *
 * @return bool True if the new main file isn't loaded yet
 */
function smartgeogmap_switch_to_new_main_file(): bool {
	$old = 'smart_geo_gmap.php';
	$new = 'smart-geo-gmap.php';

	$activePlugins = (array) get_option( 'active_plugins', [] );
	$activePlugins = array_diff( $activePlugins, [ basename( __DIR__ ) . DIRECTORY_SEPARATOR . $old ] );

	$newPlugin = basename( __DIR__ ) . DIRECTORY_SEPARATOR . $new;
	$loadNewMainFile = ! in_array( $newPlugin, $activePlugins );

	if ( $loadNewMainFile ) {
		$activePlugins[] = $newPlugin;
	}

	update_option( 'active_plugins', $activePlugins );

	return $loadNewMainFile;
}

if ( smartgeogmap_switch_to_new_main_file() ) {
	include_once __DIR__ . DIRECTORY_SEPARATOR . 'smart-geo-gmap.php';
}
