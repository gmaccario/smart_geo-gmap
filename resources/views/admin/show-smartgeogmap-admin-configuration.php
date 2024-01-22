<?php
if (isset($_GET['tab'])) {
	$tab = trim(strip_tags(htmlspecialchars($_GET['tab'])));
}
?>

<div class="wrap admin-homepage">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

    <?php // WordPress provides the styling for tabs ?>
    <h2 class="nav-tab-wrapper">
        <a href="?page=<?php echo \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_MENU_SLUG; ?>" class="nav-tab <?php if ( $tab === \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_WELCOME_TAB ): ?>nav-tab-active<?php endif; ?>">
	        <?php echo ucfirst(\SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_WELCOME_TAB); ?>
        </a>
        <a href="?page=<?php echo \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_MENU_SLUG; ?>&tab=<?php echo \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_SETTINGS_TAB; ?>" class="nav-tab <?php if ( $tab === \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_SETTINGS_TAB ): ?>nav-tab-active<?php endif; ?>">
	        <?php echo ucfirst(\SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_SETTINGS_TAB); ?>
        </a>
        <a href="?page=<?php echo \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_MENU_SLUG; ?>&tab=<?php echo \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_COORDINATES_TAB; ?>" class="nav-tab <?php if ( $tab === \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_COORDINATES_TAB ): ?>nav-tab-active<?php endif; ?>">
		    <?php echo ucfirst(\SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_COORDINATES_TAB); ?>
        </a>
        <a href="?page=<?php echo \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_MENU_SLUG; ?>&tab=<?php echo \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_FILES_TAB; ?>" class="nav-tab <?php if ( $tab === \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_FILES_TAB ): ?>nav-tab-active<?php endif; ?>">
	        <?php echo ucfirst(\SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_FILES_TAB); ?>
        </a>
    </h2>

    <form action="options.php" method="post" id="smartgeogmap_main_form" name="smartgeogmap_main_form"
          enctype="multipart/form-data">
		<?php

		switch ( $tab ) {
			case \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_SETTINGS_TAB:
				settings_fields( \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_SETTINGS_GROUP );

				do_settings_sections( \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_SETTINGS_PAGE );

				break;
			case \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_FILES_TAB:
				settings_fields( \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_FILES_GROUP );

				do_settings_sections( \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_FILES_PAGE );

				break;
			case \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_COORDINATES_TAB:
				settings_fields( \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_COORDINATES_GROUP );

				do_settings_sections( \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_COORDINATES_PAGE );

				break;
			default:
				settings_fields( \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_WELCOME_GROUP );

				do_settings_sections( \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_WELCOME_PAGE );

				break;
		}

		submit_button();
		?>
    </form>
</div>

<?php
include( 'include/contributors.php' ); ?>
