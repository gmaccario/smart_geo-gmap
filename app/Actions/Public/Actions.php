<?php

namespace SmartGeoGMap\Actions\Public;

use SmartGeoGMap\Helpers\Constants;

class Actions
{
    public string $side = Constants::SMARTGEOGMAP_SIDE_PUBLIC;

    public function __construct()
    {
	    // Scripts are only registered here: the shortcode enqueues them (see SmartGeoGMapFrontend)
	    add_action( 'init', [ $this, 'smartgeogmap_register_public_script' ] );
    }

	public function smartgeogmap_register_public_script(): void {
		$smartgeogmapGoogleApiKey = get_option( 'smartgeogmap_google_api_key' );

		// Load in the footer, after the map container and smartgeogmap_custom_js (which defines smartGeoGMapInit)
		wp_register_script(
			'smartgeogmap_maps_googleapis_com',
			sprintf(
				'https://maps.googleapis.com/maps/api/js?key=%s&loading=async&callback=smartGeoGMapInit',
				rawurlencode( (string) $smartgeogmapGoogleApiKey )
			),
			[ 'smartgeogmap_custom_js' ],
			null,
			true
		);

		wp_register_script(
			'smartgeogmap_custom_js',
			plugins_url( SMARTGEOGMAP_SLUG . '/resources/views/public/assets/js/smartgeogmap_custom.js' ),
			[],
			'1.0.3',
			true
		);

		wp_register_style(
			'smartgeogmap_custom_css',
			plugins_url( SMARTGEOGMAP_SLUG . '/resources/views/public/assets/css/smartgeogmap_custom.css' ),
			false,
			'1.0.1',
			'all'
		);
	}
}
