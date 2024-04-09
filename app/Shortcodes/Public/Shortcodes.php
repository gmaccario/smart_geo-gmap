<?php

namespace SmartGeoGMap\Shortcodes\Public;

use SmartGeoGMap\Helpers\Constants;
use SmartGeoGMap\Helpers\SmartGeoGMapFrontend;

class Shortcodes {

	public string $side = Constants::SMARTGEOGMAP_SIDE_PUBLIC;

	public function __construct(SmartGeoGMapFrontend $smartGeoGMapFrontend) {
		add_shortcode( Constants::SMARTGEOGMAP_SHORTCODE, [ $smartGeoGMapFrontend, 'showSmartGEOGoogleMap' ] );
	}
}
