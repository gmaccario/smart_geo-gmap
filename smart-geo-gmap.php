<?php
/*
Plugin Name: Smart Geo GMap
Plugin URI: https://www.giuseppemaccario.com/wordpress-map-plugin-smart-geo-gmap/
Description: Embed Google Map in your WordPress website using GeoJSON for encoding geographic data structures.
Text Domain: smartgeogmap
Author: Giuseppe Maccario
Author URI: https://www.giuseppemaccario.com
Version: 1.6.2
Requires PHP: 8.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

require_once( 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php' );

use SmartGeoGMap\Dispatcher;
use SmartGeoGMap\Services\BackwardCompatibilityEngineService;

define( "SMARTGEOGMAP_SLUG", dirname( plugin_basename( __FILE__ ) ) );
// define( "SMARTGEOGMAP_PLUGIN_URL", plugins_url('', __FILE__) );

if (!get_option( 'smartgeogmap_backward_compatibility' )) {
	$bce = new BackwardCompatibilityEngineService();
	$bce->upgradeSmartGeoGMap();
}

(Dispatcher::getInstance())->dispatch();
