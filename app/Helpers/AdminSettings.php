<?php

namespace SmartGeoGMap\Helpers;

use Parsedown;
use Exception;

class AdminSettings {
	/**
	 * @param array $args
	 *
	 * @return View
	 * @throws Exception
	 */
	public function smartgeogmap_welcome_description_field( array $args ): View {
		return new View( 'welcome_fields', [
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
		return new View( 'welcome_fields', [
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

		return new View( 'welcome_fields', [
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
		return new View( 'welcome_fields', [
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

		return new View( 'coordinates_fields', [
			'args' => $args,
			'smartgeogmapCoordinatesCity1' => $smartgeogmapCoordinatesCity1,
		] );
	}

	public function smartgeogmap_coordinates_lat_long_1_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$smartgeogmapCoordinatesLatLong1 = get_option( 'smartgeogmap_coordinates_lat_long_1' );

		return new View( 'coordinates_fields', [
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

		return new View( 'coordinates_fields', [
			'args' => $args,
			'smartgeogmapCoordinatesCity2' => $smartgeogmapCoordinatesCity2,
		] );
	}

	public function smartgeogmap_coordinates_lat_long_2_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$smartgeogmapCoordinatesLatLong2 = get_option( 'smartgeogmap_coordinates_lat_long_2' );

		return new View( 'coordinates_fields', [
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

		return new View( 'coordinates_fields', [
			'args' => $args,
			'smartgeogmapCoordinatesCity3' => $smartgeogmapCoordinatesCity3,
		] );
	}

	public function smartgeogmap_coordinates_lat_long_3_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$smartgeogmapCoordinatesLatLong3 = get_option( 'smartgeogmap_coordinates_lat_long_3' );

		return new View( 'coordinates_fields', [
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
	public function smartgeogmap_settings_default_width_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$smartgeogmapDefaultWidth = get_option( 'smartgeogmap_default_width' );

		return new View( 'settings_fields', [
			'args' => $args,
			'smartgeogmapDefaultWidth' => $smartgeogmapDefaultWidth,
		] );
	}

	/**
	 * @param array $args
	 *
	 * @return View
	 * @throws Exception
	 */
	public function smartgeogmap_settings_map_type_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$smartgeogmapMapType = get_option( 'smartgeogmap_map_type' );

		return new View( 'settings_fields', [
			'args' => $args,
			'smartgeogmapMapType' => $smartgeogmapMapType,
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

		return new View( 'settings_fields', [
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

		return new View( 'settings_fields', [
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

		return new View( 'files_fields', [
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
	public function smartgeogmap_settings_geojson_files_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$smartgeogmapGeoJSONFiles = get_option( 'smartgeogmap_geojson_files' );

		return new View( 'files_fields', [
			'args' => $args,
			'smartgeogmapGeoJSONFiles' => $smartgeogmapGeoJSONFiles,
		] );
	}

	/**
	 * @param array $args
	 *
	 * @return View
	 * @throws Exception
	 */
	public function smartgeogmap_legend_toggle_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$smartgeogmapLegendToggle = get_option( 'smartgeogmap_legend_toggle' );

		return new View( 'legend_fields', [
			'args' => $args,
			'smartgeogmapLegendToggle' => $smartgeogmapLegendToggle,
		] );
	}

	/**
	 * @param array $args
	 *
	 * @return View
	 * @throws Exception
	 */
	public function smartgeogmap_legend_position_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$smartgeogmapLegendPosition = get_option( 'smartgeogmap_legend_position' );

		return new View( 'legend_fields', [
			'args' => $args,
			'smartgeogmapLegendPosition' => $smartgeogmapLegendPosition,
		] );
	}

	/**
	 * @param array $args
	 *
	 * @return View
	 * @throws Exception
	 */
	public function smartgeogmap_legend_image_1_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$smartgeogmapLegendImage1 = get_option( 'smartgeogmap_legend_image_1' );

		return new View( 'legend_fields', [
			'args' => $args,
			'smartgeogmapLegendImage1' => $smartgeogmapLegendImage1,
		] );
	}

	/**
	 * @param array $args
	 *
	 * @return View
	 * @throws Exception
	 */
	public function smartgeogmap_legend_label_1_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$smartgeogmapLegendLabel1 = get_option( 'smartgeogmap_legend_label_1' );

		return new View( 'legend_fields', [
			'args' => $args,
			'smartgeogmapLegendLabel1' => $smartgeogmapLegendLabel1,
		] );
	}

	/**
	 * @param array $args
	 *
	 * @return View
	 * @throws Exception
	 */
	public function smartgeogmap_legend_image_2_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$smartgeogmapLegendImage2 = get_option( 'smartgeogmap_legend_image_2' );

		return new View( 'legend_fields', [
			'args' => $args,
			'smartgeogmapLegendImage2' => $smartgeogmapLegendImage2,
		] );
	}

	/**
	 * @param array $args
	 *
	 * @return View
	 * @throws Exception
	 */
	public function smartgeogmap_legend_label_2_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$smartgeogmapLegendLabel2 = get_option( 'smartgeogmap_legend_label_2' );

		return new View( 'legend_fields', [
			'args' => $args,
			'smartgeogmapLegendLabel2' => $smartgeogmapLegendLabel2,
		] );
	}

	/**
	 * @param array $args
	 *
	 * @return View
	 * @throws Exception
	 */
	public function smartgeogmap_legend_image_3_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$smartgeogmapLegendImage3 = get_option( 'smartgeogmap_legend_image_3' );

		return new View( 'legend_fields', [
			'args' => $args,
			'smartgeogmapLegendImage3' => $smartgeogmapLegendImage3,
		] );
	}

	/**
	 * @param array $args
	 *
	 * @return View
	 * @throws Exception
	 */
	public function smartgeogmap_legend_label_3_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$smartgeogmapLegendLabel3 = get_option( 'smartgeogmap_legend_label_3' );

		return new View( 'legend_fields', [
			'args' => $args,
			'smartgeogmapLegendLabel3' => $smartgeogmapLegendLabel3,
		] );
	}

    /**
     * @param array $args
     *
     * @return View
     * @throws Exception
     */
    public function smartgeogmap_setting_documentation_field( array $args ): View
    {
        $mdContent = file_get_contents (WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . SMARTGEOGMAP_SLUG . DIRECTORY_SEPARATOR . 'DOC.md');

        $doc = (new Parsedown())->text($mdContent);

        return new View('documentation_fields', [
            'doc' => $doc,
            'args' => $args,
        ]);
    }
}
