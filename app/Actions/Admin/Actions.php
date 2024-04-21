<?php

namespace SmartGeoGMap\Actions\Admin;

use Exception;
use SmartGeoGMap\Helpers\MapFiles;
use SmartGeoGMap\Helpers\View;
use SmartGeoGMap\Helpers\Field;
use SmartGeoGMap\Helpers\AdminSettings;
use SmartGeoGMap\Helpers\Constants;

class Actions {
	public Field $field;
	public AdminSettings $adminSettings;
	public MapFiles $mapFiles;

	public string $side = Constants::SMARTGEOGMAP_SIDE_ADMIN;

	public function __construct( Field $field, AdminSettings $adminSettings, MapFiles $mapFiles ) {
		$this->field = $field;
		$this->adminSettings = $adminSettings;
		$this->mapFiles = $mapFiles;

		add_action( 'admin_init', [ $this, 'smartgeogmap_register_admin_script' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'smartgeogmap_admin_enqueue_scripts' ] );

		add_action( 'admin_menu', [ $this, 'create_smartgeogmap_admin_menu' ] );
		add_action( 'admin_init', [ $this, 'create_smartgeogmap_admin_page_settings' ] );
	}

	public function smartgeogmap_register_admin_script(): void {
		wp_register_script(
			'smartgeogmap_custom_js',
			plugins_url( SMARTGEOGMAP_SLUG . '/resources/views/admin/assets/js/smartgeogmap_custom.js' ),
			[],
			'1.0.1',
		);

		wp_register_style(
			'smartgeogmap_custom_css',
			plugins_url( SMARTGEOGMAP_SLUG . '/resources/views/admin/assets/css/smartgeogmap_custom.css' ),
			false,
			'1.0.1',
			'all'
		);
	}

	public function smartgeogmap_admin_enqueue_scripts(): void {
		wp_enqueue_script( 'smartgeogmap_custom_js' );

		wp_enqueue_style( 'smartgeogmap_custom_css' );
	}

	public function create_smartgeogmap_admin_menu(): void {
		add_menu_page(
			'Smart Geo GMap Admin page',
			'SmartGeoGMap',
			'manage_options',
			Constants::SMARTGEOGMAP_MENU_SLUG,
			[ $this, 'show_smartgeogmap_admin_menu' ],
			'dashicons-admin-site',
		// 6
		);
	}

	/**
	 * @return View
	 * @throws Exception
	 */
	public function show_smartgeogmap_admin_menu(): View {
		return new View( 'admin-configuration', [
			'tab' => 'welcome',
		] );
	}

	public function create_smartgeogmap_admin_page_settings(): void {
		add_settings_section(
			Constants::SMARTGEOGMAP_WELCOME_SECTION,
			'', // '<span class="dashicons-before dashicons-admin-site"></span>' . __( 'Welcome' ),
			false, //[ $this, 'smartgeogmap_config_section_info' ],
			Constants::SMARTGEOGMAP_WELCOME_PAGE,
			[]
		);

		$this->addSettingsWelcomeDescription();
		$this->addSettingsWelcomeHowTo();
		$this->addSettingsFieldGoogleAPIKey();
		$this->addSettingsWelcomeAvailablesShortcodes();

		add_settings_section(
			Constants::SMARTGEOGMAP_SETTINGS_SECTION,
			'', //'<span class="dashicons-before dashicons-editor-customchar"></span>' . __( 'Custom Settings' ),
			false, //[ $this, 'smartgeogmap_config_section_info' ],
			Constants::SMARTGEOGMAP_SETTINGS_PAGE,
			[]
		);

		$this->addSettingsFieldDefaultWidth();
		$this->addSettingsFieldMapType();
		$this->addSettingsFieldZoom();
		$this->addSettingsFieldJavascriptTooltip();

		add_settings_section(
			Constants::SMARTGEOGMAP_COORDINATES_SECTION,
			'', //'<span class="dashicons-before dashicons-editor-customchar"></span>' . __( 'Custom Settings' ),
			false, //[ $this, 'smartgeogmap_config_section_info' ],
			Constants::SMARTGEOGMAP_COORDINATES_PAGE,
			[]
		);

		$this->addSettingsFieldCoordinateCity1();
		$this->addSettingsFieldCoordinateLatLong1();
		$this->addSettingsFieldCoordinateCity2();
		$this->addSettingsFieldCoordinateLatLong2();
		$this->addSettingsFieldCoordinateCity3();
		$this->addSettingsFieldCoordinateLatLong3();

		add_settings_section(
			Constants::SMARTGEOGMAP_FILES_SECTION,
			'', //'<span class="dashicons-before dashicons-editor-customchar"></span>' . __( 'Custom Settings' ),
			false, //[ $this, 'smartgeogmap_config_section_info' ],
			Constants::SMARTGEOGMAP_FILES_PAGE,
			[]
		);

		$this->addSettingsFieldSnazzyFile();
		$this->addSettingsFieldGeoJSONFile1();

		add_settings_section(
			Constants::SMARTGEOGMAP_LEGEND_SECTION,
			'', //'<span class="dashicons-before dashicons-editor-customchar"></span>' . __( 'Custom Settings' ),
			false, //[ $this, 'smartgeogmap_config_section_info' ],
			Constants::SMARTGEOGMAP_LEGEND_PAGE,
			[]
		);

		$this->addSettingsFieldLegendToggleLegend();
		$this->addSettingsFieldLegendPosition();
		$this->addSettingsFieldLegendImg1();
		$this->addSettingsFieldLegendLabel1();
		$this->addSettingsFieldLegendImg2();
		$this->addSettingsFieldLegendLabel2();
		$this->addSettingsFieldLegendImg3();
		$this->addSettingsFieldLegendLabel3();

        add_settings_section(
            Constants::SMARTGEOGMAP_DOCUMENTATION_SECTION,
            '', //'<span class="dashicons-before dashicons-editor-customchar"></span>' . __( 'Custom Settings' ),
            false, //[ $this, 'smartgeogmap_config_section_info' ],
            Constants::SMARTGEOGMAP_DOCUMENTATION_PAGE,
            []
        );

        $this->addSettingsFieldDocumentation();
	}

	/**
	 * @return void
	 */
	private function addSettingsWelcomeDescription(): void {
		$this->field->addSettingsField( 'smartgeogmap_welcome_description_field', 'Description', [
			$this->adminSettings,
			'smartgeogmap_welcome_description_field'
		], Constants::SMARTGEOGMAP_WELCOME_PAGE, Constants::SMARTGEOGMAP_WELCOME_SECTION );
		$this->field->registerSetting( Constants::SMARTGEOGMAP_WELCOME_GROUP, 'smartgeogmap_welcome_description' );
	}

	/**
	 * @return void
	 */
	private function addSettingsWelcomeHowTo(): void {
		$this->field->addSettingsField( 'smartgeogmap_welcome_how_to_field', 'How to', [
			$this->adminSettings,
			'smartgeogmap_welcome_how_to_field'
		], Constants::SMARTGEOGMAP_WELCOME_PAGE, Constants::SMARTGEOGMAP_WELCOME_SECTION );
		$this->field->registerSetting( Constants::SMARTGEOGMAP_WELCOME_GROUP, 'smartgeogmap_welcome_how_to' );
	}

	/**
	 * @return void
	 */
	private function addSettingsFieldGoogleAPIKey(): void {
		$this->field->addSettingsField( 'smartgeogmap_settings_google_api_key_field', 'Google API Key', [
			$this->adminSettings,
			'smartgeogmap_settings_google_api_key_field'
		], Constants::SMARTGEOGMAP_WELCOME_PAGE, Constants::SMARTGEOGMAP_WELCOME_SECTION );
		$this->field->registerSetting( Constants::SMARTGEOGMAP_WELCOME_GROUP, 'smartgeogmap_google_api_key' );
	}

	/**
	 * @return void
	 */
	private function addSettingsWelcomeAvailablesShortcodes(): void {
		$this->field->addSettingsField( 'smartgeogmap_welcome_available_shortcodes_field', 'Available Shortcodes', [
			$this->adminSettings,
			'smartgeogmap_welcome_available_shortcodes_field'
		], Constants::SMARTGEOGMAP_WELCOME_PAGE, Constants::SMARTGEOGMAP_WELCOME_SECTION );
		$this->field->registerSetting( Constants::SMARTGEOGMAP_WELCOME_GROUP,
			'smartgeogmap_welcome_available_shortcodes' );
	}

	/**
	 * @return void
	 */
	private function addSettingsFieldDefaultWidth(): void {
		$this->field->addSettingsField( 'smartgeogmap_settings_default_width_field', 'Map width', [
			$this->adminSettings,
			'smartgeogmap_settings_default_width_field'
		], Constants::SMARTGEOGMAP_SETTINGS_PAGE, Constants::SMARTGEOGMAP_SETTINGS_SECTION );
		$this->field->registerSetting( Constants::SMARTGEOGMAP_SETTINGS_GROUP, 'smartgeogmap_default_width' );
	}

	/**
	 * @return void
	 */
	private function addSettingsFieldMapType(): void {
		$this->field->addSettingsField( 'smartgeogmap_settings_map_type_field', 'Map type', [
			$this->adminSettings,
			'smartgeogmap_settings_map_type_field'
		], Constants::SMARTGEOGMAP_SETTINGS_PAGE, Constants::SMARTGEOGMAP_SETTINGS_SECTION );
		$this->field->registerSetting( Constants::SMARTGEOGMAP_SETTINGS_GROUP, 'smartgeogmap_map_type' );
	}

	/**
	 * @return void
	 */
	private function addSettingsFieldZoom(): void {
		$this->field->addSettingsField( 'smartgeogmap_settings_zoom_field', 'Zoom', [
			$this->adminSettings,
			'smartgeogmap_settings_zoom_field'
		], Constants::SMARTGEOGMAP_SETTINGS_PAGE, Constants::SMARTGEOGMAP_SETTINGS_SECTION );
		$this->field->registerSetting( Constants::SMARTGEOGMAP_SETTINGS_GROUP, 'smartgeogmap_zoom' );
	}

	/**
	 * @return void
	 */
	private function addSettingsFieldJavascriptTooltip(): void {
		$this->field->addSettingsField( 'smartgeogmap_settings_javascript_tooltip_field',
			'Javascript event for Info Windows (tooltip)',
			[
				$this->adminSettings,
				'smartgeogmap_settings_javascript_tooltip_field'
			],
			Constants::SMARTGEOGMAP_SETTINGS_PAGE,
			Constants::SMARTGEOGMAP_SETTINGS_SECTION );
		$this->field->registerSetting( Constants::SMARTGEOGMAP_SETTINGS_GROUP, 'smartgeogmap_javascript_tooltip' );
	}

	/**
	 * @return void
	 */
	private function addSettingsFieldCoordinateCity1(): void {
		$this->field->addSettingsField( 'smartgeogmap_coordinates_city_1_field', 'City 1', [
			$this->adminSettings,
			'smartgeogmap_coordinates_city_1_field'
		], Constants::SMARTGEOGMAP_COORDINATES_PAGE, Constants::SMARTGEOGMAP_COORDINATES_SECTION );
		$this->field->registerSetting( Constants::SMARTGEOGMAP_COORDINATES_GROUP, 'smartgeogmap_coordinates_city_1' );
	}

	/**
	 * @return void
	 */
	private function addSettingsFieldCoordinateLatLong1(): void {
		$this->field->addSettingsField( 'smartgeogmap_coordinates_lat_long_1_field',
			'Lat/Long 1',
			[
				$this->adminSettings,
				'smartgeogmap_coordinates_lat_long_1_field'
			],
			Constants::SMARTGEOGMAP_COORDINATES_PAGE,
			Constants::SMARTGEOGMAP_COORDINATES_SECTION );
		$this->field->registerSetting( Constants::SMARTGEOGMAP_COORDINATES_GROUP, 'smartgeogmap_coordinates_lat_long_1' );
	}

	/**
	 * @return void
	 */
	private function addSettingsFieldCoordinateCity2(): void {
		$this->field->addSettingsField( 'smartgeogmap_coordinates_city_2_field', 'City 2', [
			$this->adminSettings,
			'smartgeogmap_coordinates_city_2_field'
		], Constants::SMARTGEOGMAP_COORDINATES_PAGE, Constants::SMARTGEOGMAP_COORDINATES_SECTION );
		$this->field->registerSetting( Constants::SMARTGEOGMAP_COORDINATES_GROUP, 'smartgeogmap_coordinates_city_2' );
	}

	/**
	 * @return void
	 */
	private function addSettingsFieldCoordinateLatLong2(): void {
		$this->field->addSettingsField( 'smartgeogmap_coordinates_lat_long_2_field',
			'Lat/Long 2',
			[
				$this->adminSettings,
				'smartgeogmap_coordinates_lat_long_2_field'
			],
			Constants::SMARTGEOGMAP_COORDINATES_PAGE,
			Constants::SMARTGEOGMAP_COORDINATES_SECTION );
		$this->field->registerSetting( Constants::SMARTGEOGMAP_COORDINATES_GROUP, 'smartgeogmap_coordinates_lat_long_2' );
	}

	/**
	 * @return void
	 */
	private function addSettingsFieldCoordinateCity3(): void {
		$this->field->addSettingsField( 'smartgeogmap_coordinates_city_3_field', 'City 3', [
			$this->adminSettings,
			'smartgeogmap_coordinates_city_3_field'
		], Constants::SMARTGEOGMAP_COORDINATES_PAGE, Constants::SMARTGEOGMAP_COORDINATES_SECTION );
		$this->field->registerSetting( Constants::SMARTGEOGMAP_COORDINATES_GROUP, 'smartgeogmap_coordinates_city_3' );
	}

	/**
	 * @return void
	 */
	private function addSettingsFieldCoordinateLatLong3(): void {
		$this->field->addSettingsField( 'smartgeogmap_coordinates_lat_long_3_field',
			'Lat/Long 3',
			[
				$this->adminSettings,
				'smartgeogmap_coordinates_lat_long_3_field'
			],
			Constants::SMARTGEOGMAP_COORDINATES_PAGE,
			Constants::SMARTGEOGMAP_COORDINATES_SECTION );
		$this->field->registerSetting( Constants::SMARTGEOGMAP_COORDINATES_GROUP, 'smartgeogmap_coordinates_lat_long_3' );
	}

	/**
	 * @return void
	 */
	private function addSettingsFieldSnazzyFile(): void {
		$this->field->addSettingsField( 'smartgeogmap_settings_snazzy_file_field', 'Snazzy file', [
			$this->adminSettings,
			'smartgeogmap_settings_snazzy_file_field'
		], Constants::SMARTGEOGMAP_FILES_PAGE, Constants::SMARTGEOGMAP_FILES_SECTION );
		$this->field->registerSetting( Constants::SMARTGEOGMAP_FILES_GROUP,
			'smartgeogmap_snazzy_file',
			[ 'sanitize_callback' => [ $this->mapFiles, 'smartGeoGMapManageSnazzyMapFiles' ] ] );
	}

	/**
	 * @return void
	 */
	private function addSettingsFieldGeoJSONFile1(): void {
		$this->field->addSettingsField( 'smartgeogmap_settings_geojson_files_field', 'GeoJSON files (max. 3 files)', [
			$this->adminSettings,
			'smartgeogmap_settings_geojson_files_field'
		], Constants::SMARTGEOGMAP_FILES_PAGE, Constants::SMARTGEOGMAP_FILES_SECTION );
		$this->field->registerSetting( Constants::SMARTGEOGMAP_FILES_GROUP,
			'smartgeogmap_geojson_files',
			[ 'sanitize_callback' => [ $this->mapFiles, 'smartGeoGMapManageGeoJSONFiles' ] ] );
	}

	/**
	 * @return void
	 */
	private function addSettingsFieldLegendToggleLegend(): void {
		$this->field->addSettingsField( 'smartgeogmap_legend_toggle_field', 'Toggle (Tick for show)', [
			$this->adminSettings,
			'smartgeogmap_legend_toggle_field'
		], Constants::SMARTGEOGMAP_LEGEND_PAGE, Constants::SMARTGEOGMAP_LEGEND_SECTION );
		$this->field->registerSetting( Constants::SMARTGEOGMAP_LEGEND_GROUP, 'smartgeogmap_legend_toggle');
	}

	/**
	 * @return void
	 */
	private function addSettingsFieldLegendPosition(): void {
		$this->field->addSettingsField( 'smartgeogmap_legend_position_field', 'Position', [
			$this->adminSettings,
			'smartgeogmap_legend_position_field'
		], Constants::SMARTGEOGMAP_LEGEND_PAGE, Constants::SMARTGEOGMAP_LEGEND_SECTION );
		$this->field->registerSetting( Constants::SMARTGEOGMAP_LEGEND_GROUP, 'smartgeogmap_legend_position');
	}

	/**
	 * @return void
	 */
	private function addSettingsFieldLegendImg1(): void {
		$this->field->addSettingsField( 'smartgeogmap_legend_image_1_field', 'Icon 1', [
			$this->adminSettings,
			'smartgeogmap_legend_image_1_field'
		], Constants::SMARTGEOGMAP_LEGEND_PAGE, Constants::SMARTGEOGMAP_LEGEND_SECTION );
		$this->field->registerSetting( Constants::SMARTGEOGMAP_LEGEND_GROUP, 'smartgeogmap_legend_image_1');
	}

	/**
	 * @return void
	 */
	private function addSettingsFieldLegendLabel1(): void {
		$this->field->addSettingsField( 'smartgeogmap_legend_label_1_field', 'Label 1', [
			$this->adminSettings,
			'smartgeogmap_legend_label_1_field'
		], Constants::SMARTGEOGMAP_LEGEND_PAGE, Constants::SMARTGEOGMAP_LEGEND_SECTION );
		$this->field->registerSetting( Constants::SMARTGEOGMAP_LEGEND_GROUP, 'smartgeogmap_legend_label_1');
	}

	/**
	 * @return void
	 */
	private function addSettingsFieldLegendImg2(): void {
		$this->field->addSettingsField( 'smartgeogmap_legend_image_2_field', 'Icon 2', [
			$this->adminSettings,
			'smartgeogmap_legend_image_2_field'
		], Constants::SMARTGEOGMAP_LEGEND_PAGE, Constants::SMARTGEOGMAP_LEGEND_SECTION );
		$this->field->registerSetting( Constants::SMARTGEOGMAP_LEGEND_GROUP, 'smartgeogmap_legend_image_2');
	}

	/**
	 * @return void
	 */
	private function addSettingsFieldLegendLabel2(): void {
		$this->field->addSettingsField( 'smartgeogmap_legend_label_2_field', 'Label 2', [
			$this->adminSettings,
			'smartgeogmap_legend_label_2_field'
		], Constants::SMARTGEOGMAP_LEGEND_PAGE, Constants::SMARTGEOGMAP_LEGEND_SECTION );
		$this->field->registerSetting( Constants::SMARTGEOGMAP_LEGEND_GROUP, 'smartgeogmap_legend_label_2');
	}

	/**
	 * @return void
	 */
	private function addSettingsFieldLegendImg3(): void {
		$this->field->addSettingsField( 'smartgeogmap_legend_image_3_field', 'Icon 3', [
			$this->adminSettings,
			'smartgeogmap_legend_image_3_field'
		], Constants::SMARTGEOGMAP_LEGEND_PAGE, Constants::SMARTGEOGMAP_LEGEND_SECTION );
		$this->field->registerSetting( Constants::SMARTGEOGMAP_LEGEND_GROUP, 'smartgeogmap_legend_image_3');
	}

	/**
	 * @return void
	 */
	private function addSettingsFieldLegendLabel3(): void {
		$this->field->addSettingsField( 'smartgeogmap_legend_label_3_field', 'Label 3', [
			$this->adminSettings,
			'smartgeogmap_legend_label_3_field'
		], Constants::SMARTGEOGMAP_LEGEND_PAGE, Constants::SMARTGEOGMAP_LEGEND_SECTION );
		$this->field->registerSetting( Constants::SMARTGEOGMAP_LEGEND_GROUP, 'smartgeogmap_legend_label_3');
	}

    /**
     * @return void
     */
    private function addSettingsFieldDocumentation(): void
    {
        $this->field->addSettingsField('smartgeogmap_documentation_settings_field', 'Documentation', [
            $this->adminSettings,
            'smartgeogmap_setting_documentation_field'
        ], Constants::SMARTGEOGMAP_DOCUMENTATION_PAGE, Constants::SMARTGEOGMAP_DOCUMENTATION_SECTION);
        $this->field->registerSetting(Constants::SMARTGEOGMAP_DOCUMENTATION_GROUP,'smartgeogmap_documentation');
    }
}
