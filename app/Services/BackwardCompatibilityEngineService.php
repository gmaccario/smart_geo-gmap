<?php

namespace SmartGeoGMap\Services;

use SmartGeoGMap\Helpers\Constants;

final class BackwardCompatibilityEngineService {
	private array $map = [];

	public function __construct() {
		$this->map = [
			'smart_geo_gmap_opt_google_api_key'                => 'smartgeogmap_google_api_key',
			'smart_geo_gmap_opt_default_zoom'                  => 'smartgeogmap_zoom',
			'smart_geo_gmap_opt_javascript_event_info_windows' => 'smartgeogmap_javascript_tooltip',
			'smart_geo_gmap_opt_coord_center_1_name'           => 'smartgeogmap_coordinates_city_1',
			'smart_geo_gmap_opt_coord_center_1'                => 'smartgeogmap_coordinates_lat_long_1',
			'smart_geo_gmap_opt_coord_center_2_name'           => 'smartgeogmap_coordinates_city_2',
			'smart_geo_gmap_opt_coord_center_2'                => 'smartgeogmap_coordinates_lat_long_2',
			'smart_geo_gmap_opt_coord_center_3_name'           => 'smartgeogmap_coordinates_city_3',
			'smart_geo_gmap_opt_coord_center_3'                => 'smartgeogmap_coordinates_lat_long_3',
		];
	}

	public function upgradeSmartGeoGMap(): bool {
		$this->upgradeOptions();
		$this->upgradeFiles();

		update_option( 'smartgeogmap_backward_compatibility', 1 );

		return true;
	}

	private function upgradeOptions(): void {
		foreach ( $this->map as $oldIndex => $newIndex ) {
			$option = get_option( $oldIndex );

			if ( $option !== false ) {
				update_option( $newIndex, $option );

				delete_option( $oldIndex );
			}
		}

		delete_option( 'smart_geo_gmap_opt_debug' );
	}

	private function upgradeFiles(): void {
		$uploadBaseDir = isset( wp_upload_dir()['basedir'] )
			? wp_upload_dir()['basedir']
			: DIRECTORY_SEPARATOR . 'uploads';

		$smartGeoGMapDataPath   = $uploadBaseDir . DIRECTORY_SEPARATOR . Constants::SMARTGEOGMAP_DATA_FOLDER . DIRECTORY_SEPARATOR;
		$smartGeoGMapSnazzyPath = $uploadBaseDir . DIRECTORY_SEPARATOR . Constants::SMARTGEOGMAP_SNAZZY_FOLDER . DIRECTORY_SEPARATOR;

		$filenames = [];
		foreach ( glob( $smartGeoGMapDataPath . "/*.*" ) as $filename) {
			if (in_array(pathinfo($filename, PATHINFO_EXTENSION), ['geojson', 'json'])) {
				$filenames[] = $filename;
			}
		}
		update_option( 'smartgeogmap_geojson_files', json_encode($filenames) );

		foreach ( glob( $smartGeoGMapSnazzyPath . "/*.*" ) as $filename) {
			if ( pathinfo( $filename, PATHINFO_EXTENSION ) == 'json' ) {
				update_option( 'smartgeogmap_snazzy_file', $filename );
			}
		}
	}
}
