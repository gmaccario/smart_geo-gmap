<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<a href="?page=<?php echo esc_attr( \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_MENU_SLUG ); ?>" class="nav-tab <?php if ( $tab === \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_WELCOME_TAB ): ?>nav-tab-active<?php endif; ?>">
	<?php esc_html_e( 'Welcome', 'smart-geo-gmap' ); ?>
</a>
<a href="?page=<?php echo esc_attr( \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_MENU_SLUG ); ?>&tab=<?php echo esc_attr( \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_SETTINGS_TAB ); ?>" class="nav-tab <?php if ( $tab === \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_SETTINGS_TAB ): ?>nav-tab-active<?php endif; ?>">
	<?php esc_html_e( 'Settings', 'smart-geo-gmap' ); ?>
</a>
<a href="?page=<?php echo esc_attr( \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_MENU_SLUG ); ?>&tab=<?php echo esc_attr( \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_COORDINATES_TAB ); ?>" class="nav-tab <?php if ( $tab === \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_COORDINATES_TAB ): ?>nav-tab-active<?php endif; ?>">
	<?php esc_html_e( 'Coordinates', 'smart-geo-gmap' ); ?>
</a>
<a href="?page=<?php echo esc_attr( \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_MENU_SLUG ); ?>&tab=<?php echo esc_attr( \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_FILES_TAB ); ?>" class="nav-tab <?php if ( $tab === \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_FILES_TAB ): ?>nav-tab-active<?php endif; ?>">
	<?php esc_html_e( 'Files', 'smart-geo-gmap' ); ?>
</a>
<a href="?page=<?php echo esc_attr( \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_MENU_SLUG ); ?>&tab=<?php echo esc_attr( \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_LEGEND_TAB ); ?>" class="nav-tab <?php if ( $tab === \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_LEGEND_TAB ): ?>nav-tab-active<?php endif; ?>">
	<?php esc_html_e( 'Legend', 'smart-geo-gmap' ); ?>
</a>
<a href="?page=<?php echo esc_attr( \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_MENU_SLUG ); ?>&tab=<?php echo esc_attr( \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_DOCUMENTATION_TAB ); ?>" class="nav-tab <?php if ( $tab === \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_DOCUMENTATION_TAB ): ?>nav-tab-active<?php endif; ?>">
    <?php esc_html_e( 'Documentation', 'smart-geo-gmap' ); ?>
</a>
