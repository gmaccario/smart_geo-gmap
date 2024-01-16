<?php

namespace SmartGeoGMap;

use SmartGeoGMap\Helpers\Constants;
use SmartGeoGMap\Helpers\Field;
use SmartGeoGMap\Helpers\AdminSettings;
use SmartGeoGMap\Helpers\Logger as SmartGeoGMapLogger;
use SmartGeoGMap\Filters\Admin\Filters as AdminFilters;
use SmartGeoGMap\Actions\Admin\Actions as AdminActions;
use SmartGeoGMap\Actions\Public\Actions as PublicActions;
use SmartGeoGMap\Actions\Ajax\Actions as AjaxActions;
use SmartGeoGMap\Http\Controllers\InstagramController;

class Dispatcher {
	/**
	 * @return bool
	 */
	public function dispatch(): bool {
		$logger = new SmartGeoGMapLogger();

		if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
			new AdminFilters();
			new AdminActions( new Field(), new AdminSettings() );
		} elseif ( is_admin() && ( defined( 'DOING_AJAX' ) || DOING_AJAX ) ) {
			new AjaxActions();
		} else {
			$logger->setAction( Constants::SMARTGEOGMAP_SIDE_PUBLIC );
			$logInstance = $logger->getInstance();

			new PublicActions();
		}

		return true;
	}
}
