<?php

namespace SmartGeoGMap\Helpers;

use Exception;

class SmartGeoGMapFrontend {

	public string $side = Constants::SMARTGEOGMAP_SIDE_PUBLIC;

	/**
	 * The map settings are printed once per page, even if the shortcode is used more than once
	 */
	private bool $scriptDataAdded = false;

	public function __construct() {
	}

	/**
	 * @throws Exception
	 */
	public function showSmartGEOGoogleMap( $args ): string {

		$smartgeogmapGoogleApiKey = get_option( 'smartgeogmap_google_api_key' );

		$smartgeogmapDefaultWidth = get_option( 'smartgeogmap_default_width' );

		$smartgeogmapLegendToggle = get_option( 'smartgeogmap_legend_toggle' );

		if ( empty( $smartgeogmapGoogleApiKey ) ) {
			// Only the site admins need to know the key is missing: visitors see nothing
			if ( ! current_user_can( 'manage_options' ) ) {
				return '';
			}
		} else {
			$this->enqueueAssets();
		}

		$view = new View( 'smart-geo-gmap', [
			'args' => $args,
			'to-string' => true,
			'smartgeogmapGoogleApiKey' => $smartgeogmapGoogleApiKey,
			'smartgeogmapDefaultWidth' => $smartgeogmapDefaultWidth,
			'legend' => [
				'smartgeogmapLegendToggle' => $smartgeogmapLegendToggle,
			],
		] );

		return $view->toString();
	}

	/**
	 * Load the map scripts only on the pages that use the shortcode.
	 * The Google Maps script depends on smartgeogmap_custom_js, so smartGeoGMapInit is defined before Google calls it.
	 *
	 * @return void
	 */
	private function enqueueAssets(): void {
		wp_enqueue_style( 'smartgeogmap_custom_css' );

		wp_enqueue_script( 'smartgeogmap_maps_googleapis_com' );

		if ( ! $this->scriptDataAdded ) {
			wp_add_inline_script( 'smartgeogmap_custom_js', $this->getScriptData(), 'before' );

			$this->scriptDataAdded = true;
		}
	}

	/**
	 * Build the window.smartGeoGMap settings object used by smartgeogmap_custom.js.
	 * One global object, so the settings can't clash with variables of the theme or other plugins.
	 * JSON encoded, so quotes, backslashes and new lines in the settings can't break the script.
	 *
	 * @return string
	 */
	private function getScriptData(): string {
		$smartgeogmapLegendToggle = get_option( 'smartgeogmap_legend_toggle' ) === 'on';

		$coordCenter1 = $this->getCoordinates( get_option( 'smartgeogmap_coordinates_lat_long_1' ) );
		$coordCenter2 = $this->getCoordinates( get_option( 'smartgeogmap_coordinates_lat_long_2' ) );
		$coordCenter3 = $this->getCoordinates( get_option( 'smartgeogmap_coordinates_lat_long_3' ) );

		$smartgeogmapZoom = get_option( 'smartgeogmap_zoom' );
		$smartgeogmapJavascriptTooltip = get_option( 'smartgeogmap_javascript_tooltip' );

		$data = [
			'debug' => WP_DEBUG ? 1 : 0,
			'map_type' => (string) get_option( 'smartgeogmap_map_type' ),
			'default_zoom' => ! empty( $smartgeogmapZoom ) ? (int) $smartgeogmapZoom : 10,
			'coord_center_1' => $coordCenter1,
			'custom_centers' => [
				[ 'label' => (string) get_option( 'smartgeogmap_coordinates_city_1' ), 'coord_center' => $coordCenter1 ],
				[ 'label' => (string) get_option( 'smartgeogmap_coordinates_city_2' ), 'coord_center' => $coordCenter2 ],
				[ 'label' => (string) get_option( 'smartgeogmap_coordinates_city_3' ), 'coord_center' => $coordCenter3 ],
			],
			'snazzyStyleJson' => $this->getSnazzyStyles( get_option( 'smartgeogmap_snazzy_file' ) ),
			'js_evt_info_windows' => ! empty( $smartgeogmapJavascriptTooltip ) ? (string) $smartgeogmapJavascriptTooltip : 'mouseover',
			'sz_recenter_control' => __( 'Click to recenter the map', 'smart-geo-gmap' ),
			'geojson_files' => $this->getGeoJSONFilesUrls( get_option( 'smartgeogmap_geojson_files' ) ),
			'showLegend' => $smartgeogmapLegendToggle ? 1 : 0,
			'legend_position' => (string) get_option( 'smartgeogmap_legend_position' ),
			'icons' => $smartgeogmapLegendToggle ? $this->getLegendIcons() : new \stdClass(),
		];

		return 'window.smartGeoGMap = ' . wp_json_encode( $data ) . ';';
	}

	/**
	 * "52.370216, 4.895168" => [ 'lat' => '52.370216', 'lng' => '4.895168' ]. Empty values if the format is wrong.
	 *
	 * @param mixed $latLong
	 *
	 * @return array
	 */
	private function getCoordinates( mixed $latLong ): array {
		$parts = array_map( 'trim', explode( ',', (string) $latLong ) );

		if ( count( $parts ) !== 2 ) {
			return [ 'lat' => '', 'lng' => '' ];
		}

		return [ 'lat' => $parts[0], 'lng' => $parts[1] ];
	}

	/**
	 * The Snazzy file is a JSON array of map styles: pass the array itself to Google Maps, not the file URL
	 *
	 * @param mixed $smartgeogmapSnazzyFile
	 *
	 * @return array|null
	 */
	private function getSnazzyStyles( mixed $smartgeogmapSnazzyFile ): ?array {
		$path = $this->getUploadedFilePath( Constants::SMARTGEOGMAP_SNAZZY_FOLDER, $smartgeogmapSnazzyFile );

		if ( $path === '' ) {
			return null;
		}

		$styles = json_decode( (string) file_get_contents( $path ), true );

		// Must be a JSON array (list), not an object
		return is_array( $styles ) && array_values( $styles ) === $styles ? $styles : null;
	}

	/**
	 * @param mixed $smartgeogmapGeoJSONFiles JSON list of file paths, or '' when all files were deleted
	 *
	 * @return array
	 */
	private function getGeoJSONFilesUrls( mixed $smartgeogmapGeoJSONFiles ): array {
		$uploadBaseUrl = isset( wp_upload_dir()['baseurl'] )
			? wp_upload_dir()['baseurl']
			: '/wp-content/uploads/';

		$urls = [];
		foreach ( (array) json_decode( (string) $smartgeogmapGeoJSONFiles, true ) as $smartgeogmapGeoJSONFile ) {
			if ( $this->getUploadedFilePath( Constants::SMARTGEOGMAP_DATA_FOLDER, $smartgeogmapGeoJSONFile ) !== '' ) {
				$urls[] = $uploadBaseUrl . '/' . Constants::SMARTGEOGMAP_DATA_FOLDER . '/' . basename( $smartgeogmapGeoJSONFile );
			}
		}

		return $urls;
	}

	/**
	 * The options store absolute paths, which break when the site moves to another server:
	 * look the file up by name in the current uploads folder instead.
	 *
	 * @param string $folder
	 * @param mixed $storedPath
	 *
	 * @return string The file path, or '' if the file doesn't exist
	 */
	private function getUploadedFilePath( string $folder, mixed $storedPath ): string {
		if ( ! is_string( $storedPath ) || basename( $storedPath ) === '' ) {
			return '';
		}

		$uploadBaseDir = isset( wp_upload_dir()['basedir'] )
			? wp_upload_dir()['basedir']
			: DIRECTORY_SEPARATOR . 'uploads';

		$path = $uploadBaseDir . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . basename( $storedPath );

		return is_file( $path ) ? $path : '';
	}

	/**
	 * @return array Icons keyed by label, as expected by setLegend()
	 */
	private function getLegendIcons(): array {
		$icons = [];
		foreach ( [ 1, 2, 3 ] as $index ) {
			$label = (string) get_option( 'smartgeogmap_legend_label_' . $index );

			if ( $label !== '' ) {
				$icons[ $label ] = [
					'name' => $label,
					'icon' => 'https://maps.google.com/mapfiles/kml/shapes/' . get_option( 'smartgeogmap_legend_image_' . $index ) . '.png',
				];
			}
		}

		return $icons;
	}
}
