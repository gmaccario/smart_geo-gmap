<?php
/*
Plugin Name: Smart GEO GMap
Plugin URI: https://github.com/gmaccario/smart-geo-gmap
Description: Smart GEO GMap provides an easy way to integrate a Google Map over WordPress Page/Post using an easy Shortcode.
Version: 1.0
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

define( 'SMART_GEO_GMAP_PATH_DATA', SMART_GEO_GMAP_DIR_PATH . 'data' . DIRECTORY_SEPARATOR );
define( 'SMART_GEO_GMAP_PATH_SNAZZY_STYLE', SMART_GEO_GMAP_DIR_PATH . 'snazzy' . DIRECTORY_SEPARATOR );

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
