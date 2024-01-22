<?php

namespace SmartGeoGMap\Helpers;

use Exception;

class AdminSettings {
	/**
	 * @param array $args
	 *
	 * @return View
	 * @throws Exception
	 */
	public function smartgeogmap_welcome_description_field( array $args ): View {
		return new View( 'show-smartgeogmap-admin-welcome_fields', [
			'args' => $args,
			'field' => 'description',
		] );
	}

	/**
	 * @param array $args
	 *
	 * @return View
	 * @throws Exception
	 */
	public function smartgeogmap_welcome_how_to_field( array $args ): View {
		return new View( 'show-smartgeogmap-admin-welcome_fields', [
			'args' => $args,
			'field' => 'how_to',
		] );
	}

	/**
	 * @param array $args
	 *
	 * @return View
	 * @throws Exception
	 */
	public function smartgeogmap_settings_google_api_key_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$smartgeogmapGoogleApiKey = get_option( 'smartgeogmap_google_api_key' );

		return new View( 'show-smartgeogmap-admin-welcome_fields', [
			'args' => $args,
			'field' => 'google_api_key',
			'smartgeogmapGoogleApiKey' => $smartgeogmapGoogleApiKey,
		] );
	}

	/**
	 * @param array $args
	 *
	 * @return View
	 * @throws Exception
	 */
	public function smartgeogmap_welcome_available_shortcodes_field( array $args ): View {
		return new View( 'show-smartgeogmap-admin-welcome_fields', [
			'args' => $args,
			'field' => 'available_shortcodes',
		] );
	}

	/**
	 * @param array $args
	 *
	 * @return View
	 * @throws Exception
	 */
	public function smartgeogmap_coordinates_city_1_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$smartgeogmapCoordinatesCity1 = get_option( 'smartgeogmap_coordinates_city_1' );

		return new View( 'show-smartgeogmap-admin-coordinates_fields', [
			'args' => $args,
			'smartgeogmapCoordinatesCity1' => $smartgeogmapCoordinatesCity1,
		] );
	}

	public function smartgeogmap_coordinates_lat_long_1_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$smartgeogmapCoordinatesLatLong1 = get_option( 'smartgeogmap_coordinates_lat_long_1' );

		return new View( 'show-smartgeogmap-admin-coordinates_fields', [
			'args' => $args,
			'smartgeogmapCoordinatesLatLong1' => $smartgeogmapCoordinatesLatLong1,
		] );
	}

	/**
	 * @param array $args
	 *
	 * @return View
	 * @throws Exception
	 */
	public function smartgeogmap_coordinates_city_2_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$smartgeogmapCoordinatesCity2 = get_option( 'smartgeogmap_coordinates_city_2' );

		return new View( 'show-smartgeogmap-admin-coordinates_fields', [
			'args' => $args,
			'smartgeogmapCoordinatesCity2' => $smartgeogmapCoordinatesCity2,
		] );
	}

	public function smartgeogmap_coordinates_lat_long_2_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$smartgeogmapCoordinatesLatLong2 = get_option( 'smartgeogmap_coordinates_lat_long_2' );

		return new View( 'show-smartgeogmap-admin-coordinates_fields', [
			'args' => $args,
			'smartgeogmapCoordinatesLatLong2' => $smartgeogmapCoordinatesLatLong2,
		] );
	}

	/**
	 * @param array $args
	 *
	 * @return View
	 * @throws Exception
	 */
	public function smartgeogmap_coordinates_city_3_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$smartgeogmapCoordinatesCity3 = get_option( 'smartgeogmap_coordinates_city_3' );

		return new View( 'show-smartgeogmap-admin-coordinates_fields', [
			'args' => $args,
			'smartgeogmapCoordinatesCity3' => $smartgeogmapCoordinatesCity3,
		] );
	}

	public function smartgeogmap_coordinates_lat_long_3_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$smartgeogmapCoordinatesLatLong3 = get_option( 'smartgeogmap_coordinates_lat_long_3' );

		return new View( 'show-smartgeogmap-admin-coordinates_fields', [
			'args' => $args,
			'smartgeogmapCoordinatesLatLong3' => $smartgeogmapCoordinatesLatLong3,
		] );
	}

	/**
	 * @param array $args
	 *
	 * @return View
	 * @throws Exception
	 */
	public function smartgeogmap_settings_zoom_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$smartgeogmapZoom = get_option( 'smartgeogmap_zoom' );

		return new View( 'show-smartgeogmap-admin-settings_fields', [
			'args' => $args,
			'smartgeogmapZoom' => $smartgeogmapZoom,
		] );
	}

	/**
	 * @param array $args
	 *
	 * @return View
	 * @throws Exception
	 */
	public function smartgeogmap_settings_javascript_tooltip_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$smartgeogmapJavascriptTooltip = get_option( 'smartgeogmap_javascript_tooltip' );

		return new View( 'show-smartgeogmap-admin-settings_fields', [
			'args' => $args,
			'smartgeogmapJavascriptTooltip' => $smartgeogmapJavascriptTooltip,
		] );
	}

	/**
	 * @param array $args
	 *
	 * @return View
	 * @throws Exception
	 */
	public function smartgeogmap_settings_snazzy_file_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$smartgeogmapSnazzyFile = get_option( 'smartgeogmap_snazzy_file' );

		return new View( 'show-smartgeogmap-admin-files_fields', [
			'args' => $args,
			'smartgeogmapSnazzyFile' => $smartgeogmapSnazzyFile,
		] );
	}

	/**
	 * @param array $args
	 *
	 * @return View
	 * @throws Exception
	 */
	public function smartgeogmap_settings_geojson_file_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$smartgeogmapGeoJSONFile = get_option( 'smartgeogmap_geojson_file' );

		return new View( 'show-smartgeogmap-admin-files_fields', [
			'args' => $args,
			'smartgeogmapGeoJSONFile' => $smartgeogmapGeoJSONFile,
		] );
	}
}
