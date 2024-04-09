<?php

namespace SmartGeoGMap\Helpers;

use Exception;

class SmartGeoGMapFrontend {

	public string $side = Constants::SMARTGEOGMAP_SIDE_PUBLIC;

	public function __construct() {
	}

	/**
	 * @throws Exception
	 */
	public function showSmartGEOGoogleMap( $args ): string {

		$smartgeogmapGoogleApiKey = get_option( 'smartgeogmap_google_api_key' );

		$smartgeogmapCoordinatesCity1 = get_option( 'smartgeogmap_coordinates_city_1' );
		$smartgeogmapCoordinatesCity2 = get_option( 'smartgeogmap_coordinates_city_2' );
		$smartgeogmapCoordinatesCity3 = get_option( 'smartgeogmap_coordinates_city_3' );

		$smartgeogmapCoordinatesLatLong1 = get_option( 'smartgeogmap_coordinates_lat_long_1' );
		$smartgeogmapCoordinatesLatLong2 = get_option( 'smartgeogmap_coordinates_lat_long_2' );
		$smartgeogmapCoordinatesLatLong3 = get_option( 'smartgeogmap_coordinates_lat_long_3' );

		$smartgeogmapDefaultWidth = get_option( 'smartgeogmap_default_width' );
		$smartgeogmapMapType = get_option( 'smartgeogmap_map_type' );
		$smartgeogmapZoom = get_option( 'smartgeogmap_zoom' );
		$smartgeogmapJavascriptTooltip = get_option( 'smartgeogmap_javascript_tooltip' );

		$smartgeogmapSnazzyFile = get_option( 'smartgeogmap_snazzy_file' );
		$smartgeogmapGeoJSONFiles = get_option( 'smartgeogmap_geojson_files' );

		$smartgeogmapLegendToggle = get_option( 'smartgeogmap_legend_toggle' );
		$smartgeogmapLegendPosition = get_option( 'smartgeogmap_legend_position' );

		$smartgeogmapLegendImage1 = get_option( 'smartgeogmap_legend_image_1' );
		$smartgeogmapLegendImage2 = get_option( 'smartgeogmap_legend_image_2' );
		$smartgeogmapLegendImage3 = get_option( 'smartgeogmap_legend_image_3' );

		$smartgeogmapLegendLabel1 = get_option( 'smartgeogmap_legend_label_1' );
		$smartgeogmapLegendLabel2 = get_option( 'smartgeogmap_legend_label_2' );
		$smartgeogmapLegendLabel3 = get_option( 'smartgeogmap_legend_label_3' );

		$view = new View( 'smart-geo-gmap', [
			'args' => $args,
			'to-string' => true,
			'smartgeogmapGoogleApiKey' => $smartgeogmapGoogleApiKey,
			'coordinates' => [
				'smartgeogmapCoordinatesCity1' => $smartgeogmapCoordinatesCity1,
				'smartgeogmapCoordinatesCity2' => $smartgeogmapCoordinatesCity2,
				'smartgeogmapCoordinatesCity3' => $smartgeogmapCoordinatesCity3,
				'smartgeogmapCoordinatesLatLong1' => $smartgeogmapCoordinatesLatLong1,
				'smartgeogmapCoordinatesLatLong2' => $smartgeogmapCoordinatesLatLong2,
				'smartgeogmapCoordinatesLatLong3' => $smartgeogmapCoordinatesLatLong3,
			],
			'smartgeogmapDefaultWidth' => $smartgeogmapDefaultWidth,
			'smartgeogmapMapType' => $smartgeogmapMapType,
			'smartgeogmapZoom' => $smartgeogmapZoom,
			'smartgeogmapJavascriptTooltip' => $smartgeogmapJavascriptTooltip,
			'smartgeogmapSnazzyFile' => $smartgeogmapSnazzyFile,
			'smartgeogmapGeoJSONFiles' => $smartgeogmapGeoJSONFiles,
			'legend' => [
				'smartgeogmapLegendToggle' => $smartgeogmapLegendToggle,
				'smartgeogmapLegendPosition' => $smartgeogmapLegendPosition,
				'smartgeogmapLegendImage1' => $smartgeogmapLegendImage1,
				'smartgeogmapLegendImage2' => $smartgeogmapLegendImage2,
				'smartgeogmapLegendImage3' => $smartgeogmapLegendImage3,
				'smartgeogmapLegendLabel1' => $smartgeogmapLegendLabel1,
				'smartgeogmapLegendLabel2' => $smartgeogmapLegendLabel2,
				'smartgeogmapLegendLabel3' => $smartgeogmapLegendLabel3,
			],
		] );

		//echo "<pre>";print_r();wp_die();

		return $view->toString();
	}
}
