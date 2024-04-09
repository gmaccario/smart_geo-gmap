<?php

namespace SmartGeoGMap\Filters\Admin;

use SmartGeoGMap\Helpers\Constants;

class Filters {

	public string $side = Constants::SMARTGEOGMAP_SIDE_ADMIN;

	public function __construct() {

		add_filter(
			'plugin_action_links_' . SMARTGEOGMAP_SLUG . '/smart-geo-gmap.php',
			[$this, 'smartgeogmap_settings_link']
		);
	}

	/**
	 * @param array $links
	 *
	 * @return array
	 */
	function smartgeogmap_settings_link( array $links ): array {
		$url = get_admin_url() . "admin.php?page=" . Constants::SMARTGEOGMAP_MENU_SLUG;
		// target="_blank"

		$settings_link = sprintf( '<a href="%s">%s</a>', $url, __( 'Settings' ) );

		$links[] = $settings_link;

		return $links;
	}
}
