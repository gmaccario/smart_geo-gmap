<?php

if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    return;
}

// Welcome
delete_option('smartgeogmap_welcome_description');
delete_option('smartgeogmap_welcome_how_to');
delete_option('smartgeogmap_welcome_available_shortcodes');

delete_option('smartgeogmap_google_api_key');

// Settings
delete_option('smartgeogmap_map_type');
delete_option('smartgeogmap_zoom');
delete_option('smartgeogmap_javascript_tooltip');

// Coordinates
delete_option('smartgeogmap_coordinates_city_1');
delete_option('smartgeogmap_coordinates_lat_long_1');
delete_option('smartgeogmap_coordinates_city_2');
delete_option('smartgeogmap_coordinates_lat_long_2');
delete_option('smartgeogmap_coordinates_city_3');
delete_option('smartgeogmap_coordinates_lat_long_3');

// Files
delete_option('smartgeogmap_snazzy_file');
delete_option('smartgeogmap_geojson_files');

// Legend
delete_option('smartgeogmap_legend_toggle');
delete_option('smartgeogmap_legend_position');
delete_option('smartgeogmap_legend_image_1');
delete_option('smartgeogmap_legend_label_1');
delete_option('smartgeogmap_legend_image_2');
delete_option('smartgeogmap_legend_label_2');
delete_option('smartgeogmap_legend_image_3');
delete_option('smartgeogmap_legend_label_3');

// Files
// ...TODO... cancellare anche i file