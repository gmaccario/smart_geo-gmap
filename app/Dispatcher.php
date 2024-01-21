<?php

namespace SmartGeoGMap;

use SmartGeoGMap\Helpers\Constants;
use SmartGeoGMap\Helpers\Field;
use SmartGeoGMap\Helpers\AdminSettings;
use SmartGeoGMap\Helpers\LoggerAdapter;
use SmartGeoGMap\Helpers\MapFiles;
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

		if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
			$logger = new LoggerAdapter(Constants::SMARTGEOGMAP_SIDE_ADMIN);

			new AdminFilters();
			new AdminActions( new Field(), new AdminSettings(), new MapFiles( $logger ) );
		} elseif ( is_admin() && ( defined( 'DOING_AJAX' ) || DOING_AJAX ) ) {
			new AjaxActions();
		} else {
			$logger = new LoggerAdapter(Constants::SMARTGEOGMAP_SIDE_PUBLIC);

			new PublicActions($logger);
		}

		return true;
	}
}
