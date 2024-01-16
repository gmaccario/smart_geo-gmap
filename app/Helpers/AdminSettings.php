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
	public function smartgeogmap_settings_coordinates_city_1_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$smartgeogmapCoordinatesCity1 = get_option( 'smartgeogmap_coordinates_city_1' );

		return new View( 'show-smartgeogmap-admin-settings_fields', [
			'args' => $args,
			'smartgeogmapCoordinatesCity1' => $smartgeogmapCoordinatesCity1,
		] );
	}

	public function smartgeogmap_settings_coordinates_lat_long_1_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$smartgeogmapCoordinatesLatLong1 = get_option( 'smartgeogmap_coordinates_lat_long_1' );

		return new View( 'show-smartgeogmap-admin-settings_fields', [
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
	public function smartgeogmap_settings_coordinates_city_2_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$smartgeogmapCoordinatesCity2 = get_option( 'smartgeogmap_coordinates_city_2' );

		return new View( 'show-smartgeogmap-admin-settings_fields', [
			'args' => $args,
			'smartgeogmapCoordinatesCity2' => $smartgeogmapCoordinatesCity2,
		] );
	}

	public function smartgeogmap_settings_coordinates_lat_long_2_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$smartgeogmapCoordinatesLatLong2 = get_option( 'smartgeogmap_coordinates_lat_long_2' );

		return new View( 'show-smartgeogmap-admin-settings_fields', [
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
	public function smartgeogmap_settings_coordinates_city_3_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$smartgeogmapCoordinatesCity3 = get_option( 'smartgeogmap_coordinates_city_3' );

		return new View( 'show-smartgeogmap-admin-settings_fields', [
			'args' => $args,
			'smartgeogmapCoordinatesCity3' => $smartgeogmapCoordinatesCity3,
		] );
	}

	public function smartgeogmap_settings_coordinates_lat_long_3_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$smartgeogmapCoordinatesLatLong3 = get_option( 'smartgeogmap_coordinates_lat_long_3' );

		return new View( 'show-smartgeogmap-admin-settings_fields', [
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
	public function smartgeogmap_setting_app_id_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$snapWizardAppId = get_option( 'snapwizard_app_id' );

		return new View( 'show-snapWizard-admin-settings_fields', [
			'snapWizardAppId' => $snapWizardAppId,
			'args'            => $args,
		] );
	}

	/**
	 * @param array $args
	 *
	 * @return View
	 * @throws Exception
	 */
	public function smartgeogmap_setting_app_secret_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$snapWizardAppSecret = get_option( 'snapwizard_app_secret' );

		return new View( 'show-snapWizard-admin-settings_fields', [
			'snapWizardAppSecret' => $snapWizardAppSecret,
			'args'                => $args,
		] );
	}

	/**
	 * @param array $args
	 *
	 * @return View
	 * @throws Exception
	 */
	public function smartgeogmap_setting_redirect_url_field( array $args ): View {
		// Get the value of the setting
		$snapWizardRedirectUrl = sprintf( '%s%s%s%s',
			site_url( '/', 'https' ),
			'wp-json/',
			Constants::SNAPWIZARD_API_NAMESPACE,
			Constants::SNAPWIZARD_API_AUTH
		);

		//get_option( 'snapwizard_redirect_url' );

		return new View( 'show-snapWizard-admin-settings_fields', [
			'snapWizardRedirectUrl' => $snapWizardRedirectUrl,
			'args'                  => $args,
		] );
	}

	/**
	 * @param array $args
	 *
	 * @return View
	 * @throws Exception
	 */
	public function smartgeogmap_setting_process_ig_feed_field( array $args ): View {
		$snapWizardToken = get_option( 'snapwizard_crypted_token' );

		$loggedIn = false;
		if ( $snapWizardToken ) {
			$loggedIn = true;
		}

		// Get the value of the setting
		$snapWizardProcessIGFeedUrl = sprintf( '%s%s%s%s?appid=%s',
			site_url( '/', 'https' ),
			'wp-json/',
			Constants::SNAPWIZARD_API_NAMESPACE,
			Constants::SNAPWIZARD_API_PROCESS,
			get_option( 'snapwizard_app_id' )
		);

		return new View( 'show-snapWizard-admin-settings_fields', [
			'loggedIn'                   => $loggedIn,
			'snapWizardProcessIGFeedUrl' => $snapWizardProcessIGFeedUrl,
			'args'                       => $args,
		] );
	}

	/**
	 * @param array $args
	 *
	 * @return View
	 * @throws Exception
	 */
//    public function smartgeogmap_setting_processing_type_field( array $args ): View
//    {
//        // Get the value of the setting we've registered with register_setting()
//        $snapWizardProcessingType = get_option( 'snapwizard_processing_type' );
//
//        return new View('show-snapWizard-admin-settings_fields', [
//            'snapWizardProcessingType' => $snapWizardProcessingType,
//            'args' => $args,
//        ]);
//    }

	/**
	 * @param array $args
	 *
	 * @return View
	 * @throws Exception
	 */
	public function smartgeogmap_setting_file_type_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$snapWizardFileType = get_option( 'snapwizard_file_type' );

		return new View( 'show-snapWizard-admin-settings_fields', [
			'snapWizardFileType' => $snapWizardFileType,
			'args'               => $args,
		] );
	}

	/**
	 * @param array $args
	 *
	 * @return View
	 * @throws Exception
	 */
	public function smartgeogmap_setting_author_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$snapwizardAuthor     = get_option( 'snapwizard_author' );
		$snapwizardAuthorsAll = $this->getAllAuthors();

		return new View( 'show-snapWizard-admin-settings_fields', [
			'snapwizardAuthor'     => $snapwizardAuthor,
			'snapwizardAuthorsAll' => $snapwizardAuthorsAll,
			'args'                 => $args,
		] );
	}

	/**
	 * @param array $args
	 *
	 * @return View
	 * @throws Exception
	 */
	public function smartgeogmap_setting_post_categories_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$snapwizardPostCategories    = get_option( 'snapwizard_post_categories' );
		$snapwizardPostCategoriesAll = $this->getCategories();

		return new View( 'show-snapWizard-admin-settings_fields', [
			'snapwizardPostCategories'    => $snapwizardPostCategories,
			'snapwizardPostCategoriesAll' => $snapwizardPostCategoriesAll,
			'args'                        => $args,
		] );
	}

	/**
	 * @param array $args
	 *
	 * @return View
	 * @throws Exception
	 */
	public function smartgeogmap_setting_media_categories_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$snapwizardMediaCategories    = get_option( 'snapwizard_media_categories' );
		$snapwizardMediaCategoriesAll = $this->getCategories();

		return new View( 'show-snapWizard-admin-settings_fields', [
			'snapwizardMediaCategories'    => $snapwizardMediaCategories,
			'snapwizardMediaCategoriesAll' => $snapwizardMediaCategoriesAll,
			'args'                         => $args,
		] );
	}

	/**
	 * @param array $args
	 *
	 * @return View
	 * @throws Exception
	 */
	public function smartgeogmap_setting_limit_per_page_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$snapWizardLimitPerPage = get_option( 'snapwizard_limit_per_page' );

		return new View( 'show-snapWizard-admin-settings_fields', [
			'snapWizardLimitPerPage' => $snapWizardLimitPerPage,
			'args'                   => $args,
		] );
	}

	/**
	 * @param array $args
	 *
	 * @return View
	 * @throws Exception
	 */
	public function smartgeogmap_setting_exclude_field( array $args ): View {
		// Get the value of the setting we've registered with register_setting()
		$snapWizardExclude = get_option( 'snapwizard_exclude' );

		return new View( 'show-snapWizard-admin-settings_fields', [
			'snapWizardExclude' => $snapWizardExclude,
			'args'              => $args,
		] );
	}

	/**
	 * @return array
	 */
	private function getAllAuthors(): array {
		$args = [
			'orderby'    => 'display_name',
			'order'      => 'DESC',
			'capability' => [ 'edit_posts' ],
		];

		// Capability queries were only introduced in WP 5.9.
		if ( version_compare( $GLOBALS['wp_version'], '5.9', '<' ) ) {
			$args['who'] = 'authors';
			unset( $args['capability'] );
		}

		// Get the results
		return get_users( $args );
	}

	/**
	 * @return array
	 */
	private function getCategories(): array {
		$args = [
			'orderby'    => 'name',
			'hide_empty' => false,
		];

		return get_categories( $args );
	}
}
