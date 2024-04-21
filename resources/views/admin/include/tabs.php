<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<a href="?page=<?php \SmartGeoGMap\Helpers\Intl::esc_attr_e(\SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_MENU_SLUG); ?>" class="nav-tab <?php if ( $tab === \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_WELCOME_TAB ): ?>nav-tab-active<?php endif; ?>">
	<?php esc_html_e(ucfirst(\SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_WELCOME_TAB)); ?>
</a>
<a href="?page=<?php \SmartGeoGMap\Helpers\Intl::esc_attr_e(\SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_MENU_SLUG); ?>&tab=<?php \SmartGeoGMap\Helpers\Intl::esc_attr_e(\SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_SETTINGS_TAB); ?>" class="nav-tab <?php if ( $tab === \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_SETTINGS_TAB ): ?>nav-tab-active<?php endif; ?>">
	<?php esc_html_e(ucfirst(\SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_SETTINGS_TAB)); ?>
</a>
<a href="?page=<?php \SmartGeoGMap\Helpers\Intl::esc_attr_e(\SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_MENU_SLUG); ?>&tab=<?php \SmartGeoGMap\Helpers\Intl::esc_attr_e(\SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_COORDINATES_TAB); ?>" class="nav-tab <?php if ( $tab === \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_COORDINATES_TAB ): ?>nav-tab-active<?php endif; ?>">
	<?php esc_html_e(ucfirst(\SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_COORDINATES_TAB)); ?>
</a>
<a href="?page=<?php \SmartGeoGMap\Helpers\Intl::esc_attr_e(\SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_MENU_SLUG); ?>&tab=<?php \SmartGeoGMap\Helpers\Intl::esc_attr_e(\SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_FILES_TAB); ?>" class="nav-tab <?php if ( $tab === \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_FILES_TAB ): ?>nav-tab-active<?php endif; ?>">
	<?php esc_html_e(ucfirst(\SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_FILES_TAB)); ?>
</a>
<a href="?page=<?php \SmartGeoGMap\Helpers\Intl::esc_attr_e(\SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_MENU_SLUG); ?>&tab=<?php \SmartGeoGMap\Helpers\Intl::esc_attr_e(\SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_LEGEND_TAB); ?>" class="nav-tab <?php if ( $tab === \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_LEGEND_TAB ): ?>nav-tab-active<?php endif; ?>">
	<?php esc_html_e(ucfirst(\SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_LEGEND_TAB)); ?>
</a>
<a href="?page=<?php \SmartGeoGMap\Helpers\Intl::esc_attr_e(\SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_MENU_SLUG); ?>&tab=<?php \SmartGeoGMap\Helpers\Intl::esc_attr_e(\SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_DOCUMENTATION_TAB); ?>" class="nav-tab <?php if ( $tab === \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_DOCUMENTATION_TAB ): ?>nav-tab-active<?php endif; ?>">
    <?php esc_html_e(ucfirst(\SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_DOCUMENTATION_TAB)); ?>
</a>
