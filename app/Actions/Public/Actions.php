<?php

namespace SmartGeoGMap\Actions\Public;

use SmartGeoGMap\Helpers\Constants;

class Actions
{
    public string $side = Constants::SMARTGEOGMAP_SIDE_PUBLIC;

    public function __construct()
    {
	    add_action( 'init', [ $this, 'smartgeogmap_register_public_script' ] );
	    add_action( 'wp_footer', [ $this, 'smartgeogmap_public_enqueue_scripts' ] );
    }

	public function smartgeogmap_register_public_script(): void {
		$smartgeogmapGoogleApiKey = get_option( 'smartgeogmap_google_api_key' );

		wp_register_script(
			'smartgeogmap_maps_googleapis_com',
			   sprintf('https://maps.googleapis.com/maps/api/js?key=%s&amp;callback=initMap', $smartgeogmapGoogleApiKey),
		);

		wp_register_script(
			'smartgeogmap_custom_js',
			plugins_url( SMARTGEOGMAP_SLUG . '/resources/views/public/assets/js/smartgeogmap_custom.js' ),
			[],
			'1.0.1',
		);

		wp_register_style(
			'smartgeogmap_custom_css',
			plugins_url( SMARTGEOGMAP_SLUG . '/resources/views/public/assets/css/smartgeogmap_custom.css' ),
			false,
			'1.0.1',
			'all'
		);
	}

	public function smartgeogmap_public_enqueue_scripts(): void {

		wp_enqueue_script( 'smartgeogmap_custom_js' );

		wp_enqueue_script( 'smartgeogmap_maps_googleapis_com' );

		wp_enqueue_style( 'smartgeogmap_custom_css' );
	}
}
