<?php
/* die when the file is called directly */
if ( !defined( 'WP_UNINSTALL_PLUGIN' ))
{
    die;
}

include('smart_geo_gmap.php');

delete_option( SMART_GEO_GMAP_OPT_DEBUG );
delete_option( SMART_GEO_GMAP_OPT_SETTINGS_FIELDS );
delete_option( SMART_GEO_GMAP_OPT_GOOGLE_API_KEY );
delete_option( SMART_GEO_GMAP_OPT_DEFAULT_ZOOM );
delete_option( SMART_GEO_GMAP_OPT_COORD_CENTER_1 );
delete_option( SMART_GEO_GMAP_OPT_COORD_CENTER_2 );
delete_option( SMART_GEO_GMAP_OPT_COORD_CENTER_3 );
delete_option( SMART_GEO_GMAP_OPT_COORD_CENTER_1_NAME );
delete_option( SMART_GEO_GMAP_OPT_COORD_CENTER_2_NAME );
delete_option( SMART_GEO_GMAP_OPT_COORD_CENTER_3_NAME );
delete_option( SMART_GEO_GMAP_OPT_JAVASCRIPT_EVENT_INFO_WINDOWS );
