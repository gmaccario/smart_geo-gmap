<?php
/*
Plugin Name: Smart GEO GMap
Plugin URI: https://github.com/gmaccario/smart-geo-gmap
Description: Smart GEO GMap provides an easy way to integrate a Google Map over WordPress Page/Post using an easy Shortcode.
Version: 1.2
Author: Giuseppe Maccario
Author URI: https://www.giuseppemaccario.com
License: GPLv2 or later
*/

if( defined( WP_DEBUG ) && WP_DEBUG )
{
    ini_set( 'display_errors', 1 );
    ini_set( 'display_startup_errors', 1 );
    error_reporting( E_ALL );
}

/* GENERAL CONSTANTS */
define( 'SMART_GEO_GMAP_NAME', 'Smart GEO GMap' );

/* BASIC CONSTANTS - MANDATORY HERE CAUSE __FILE__ */
define( 'SMART_GEO_GMAP_BASENAME', plugin_basename( __FILE__ ));
define( 'SMART_GEO_GMAP_URL', plugins_url( '', __FILE__ ));
define( 'SMART_GEO_GMAP_DIR_PATH', plugin_dir_path( __FILE__ ) );

$uploadDir = isset(wp_upload_dir()['basedir']) ? wp_upload_dir()['basedir'] : '/uploads';

define( 'SMART_GEO_GMAP_PATH_DATA', $uploadDir . DIRECTORY_SEPARATOR . 'smart-geo-gmap-data' . DIRECTORY_SEPARATOR );
define( 'SMART_GEO_GMAP_PATH_SNAZZY_STYLE', $uploadDir . DIRECTORY_SEPARATOR . 'smart-geo-gmap-snazzy' . DIRECTORY_SEPARATOR );

function smartGeoGmapInit()
{
	/* PSR-4: Autoloader - PHP-FIG */
	require SMART_GEO_GMAP_DIR_PATH . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

  /* DEFINE CONSTANTS	*/
	require_once SMART_GEO_GMAP_DIR_PATH . 'include' . DIRECTORY_SEPARATOR . 'constants.php';

	/* DISPATCHER */
	require_once SMART_GEO_GMAP_DIR_PATH . 'include' . DIRECTORY_SEPARATOR . 'dispatcher.php';
}

if( defined( 'ABSPATH' ))
{
    smartGeoGmapInit();
}
