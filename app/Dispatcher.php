<?php

namespace SmartGeoGMap;

use SmartGeoGMap\Helpers\Constants;
use SmartGeoGMap\Helpers\Field;
use SmartGeoGMap\Helpers\AdminSettings;
use SmartGeoGMap\Helpers\Logger;
use SmartGeoGMap\Helpers\MapFiles;
use SmartGeoGMap\Helpers\SmartGeoGMapFrontend;
use SmartGeoGMap\Filters\Admin\Filters as AdminFilters;
use SmartGeoGMap\Actions\Admin\Actions as AdminActions;
use SmartGeoGMap\Actions\Public\Actions as PublicActions;
use SmartGeoGMap\Actions\Ajax\Actions as AjaxActions;
use SmartGeoGMap\Shortcodes\Public\Shortcodes as PublicShortcodes;

class Dispatcher {
	/**
	 * @return bool
	 */
	public function dispatch(): bool
	{
		if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
			$logger = new Logger();
            $logger->setAction(Constants::SMARTGEOGMAP_SIDE_ADMIN);
            $logInstance = $logger->getInstance();

			new AdminFilters();
			new AdminActions( new Field(), new AdminSettings(), new MapFiles( $logInstance ) );
		} elseif ( is_admin() && ( defined( 'DOING_AJAX' ) || DOING_AJAX ) ) {
			new AjaxActions();
		} else {
			new PublicShortcodes( new SmartGeoGMapFrontend() );
			new PublicActions();
		}

		return true;
	}
}
