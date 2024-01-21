<?php

if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    return;
}

delete_option('smartgeogmap_google_api_key');
delete_option('smartgeogmap_zoom');
delete_option('smartgeogmap_coordinates_city_1');
delete_option('smartgeogmap_coordinates_lat_long_1');
delete_option('smartgeogmap_coordinates_city_2');
delete_option('smartgeogmap_coordinates_lat_long_2');
delete_option('smartgeogmap_coordinates_city_3');
delete_option('smartgeogmap_coordinates_lat_long_3');

delete_option('smartgeogmap_javascript_tooltip');
delete_option('smartgeogmap_welcome_description');
delete_option('smartgeogmap_welcome_how_to');
delete_option('smartgeogmap_welcome_available_shortcodes');
delete_option('smartgeogmap_snazzy_file');
delete_option('smartgeogmap_geojson_file');

// ...TODO... cancellare anche i file