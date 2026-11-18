<?php

use SmartGeoGMap\Helpers\Constants;

if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    return;
}

require_once( __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php' );

/**
 * In a function, so its variables don't leak into the global scope
 */
function smartgeogmap_uninstall(): void {
	// General
	delete_option('smartgeogmap_backward_compatibility');

	// Welcome
	delete_option('smartgeogmap_welcome_description');
	delete_option('smartgeogmap_welcome_how_to');
	delete_option('smartgeogmap_welcome_available_shortcodes');
	delete_option('smartgeogmap_google_api_key');

	// Settings
	delete_option('smartgeogmap_default_width');
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

	// Files (on db)
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

	// Documentation
	delete_option('smartgeogmap_documentation');

	// Files (on filesystem)
	$uploadBaseDir = isset( wp_upload_dir()['basedir'] )
		? wp_upload_dir()['basedir']
		: DIRECTORY_SEPARATOR . 'uploads';

	$smartGeoGMapDataPath = $uploadBaseDir . DIRECTORY_SEPARATOR . Constants::SMARTGEOGMAP_DATA_FOLDER . DIRECTORY_SEPARATOR;
	$smartGeoGMapSnazzyPath = $uploadBaseDir . DIRECTORY_SEPARATOR . Constants::SMARTGEOGMAP_SNAZZY_FOLDER . DIRECTORY_SEPARATOR;

	require_once ABSPATH . 'wp-admin/includes/file.php';

	global $wp_filesystem;
	$hasFilesystem = WP_Filesystem();

	// The folders may not exist (no file ever uploaded) or may have been removed already
	foreach ( [ $smartGeoGMapDataPath, $smartGeoGMapSnazzyPath ] as $smartGeoGMapPath ) {
		if ( ! is_dir( $smartGeoGMapPath ) ) {
			continue;
		}

		if ( $hasFilesystem ) {
			// Removes the folder and the files inside it
			$wp_filesystem->rmdir( $smartGeoGMapPath, true );

			continue;
		}

		// No filesystem access: delete the files at least
		foreach ( glob( $smartGeoGMapPath . '*' ) ?: [] as $file ) {
			if ( is_file( $file ) ) {
				wp_delete_file( $file );
			}
		}
	}
}

smartgeogmap_uninstall();
