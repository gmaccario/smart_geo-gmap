<?php
/*
Plugin Name: Smart Geo GMap
Plugin URI: https://www.giuseppemaccario.com/wordpress-map-plugin-smart-geo-gmap/
Description: Smart GEO GMap free plugin simplifies the process of embedding a Google Map on your WordPress website using GeoJSON for encoding geographic data structures.
Author: Giuseppe Maccario
Author URI: http://www.giuseppemaccario.com
Version: 1.5
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

require_once( 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php' );

use SmartGeoGMap\Dispatcher;
use SmartGeoGMap\Helpers\BackwardCompatibilityEngine;

define( "SMARTGEOGMAP_SLUG", dirname( plugin_basename( __FILE__ ) ) );
// define( "SMARTGEOGMAP_PLUGIN_URL", plugins_url('', __FILE__) );

if (!get_option( 'smartgeogmap_backward_compatibility' )) {
	$bce = new BackwardCompatibilityEngine();
	$bce->upgradeSmartGeoGMap();
}

$dispatcher = new Dispatcher();
$dispatcher->dispatch();
