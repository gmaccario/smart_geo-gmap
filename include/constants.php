<?php

/**
 * @note This file is intended as a repository of constants of name of options,
 * useful with filter_input and get_option methods to avoid human errors writing
 * the name of the variables.
 *
 */

/* PLUGIN OPTIONS */
define( 'SMART_GEO_GMAP_OPT_DEBUG', 'smart_geo_gmap_opt_debug' );
define( 'SMART_GEO_GMAP_OPT_SETTINGS_FIELDS', 'smart_geo_gmap_opt_settings_fields' );
define( 'SMART_GEO_GMAP_OPT_GOOGLE_API_KEY', 'smart_geo_gmap_opt_google_api_key' );
define( 'SMART_GEO_GMAP_OPT_DEFAULT_ZOOM', 'smart_geo_gmap_opt_default_zoom' );
define( 'SMART_GEO_GMAP_OPT_COORD_CENTER_1', 'smart_geo_gmap_opt_coord_center_1' );
define( 'SMART_GEO_GMAP_OPT_COORD_CENTER_2', 'smart_geo_gmap_opt_coord_center_2' );
define( 'SMART_GEO_GMAP_OPT_COORD_CENTER_3', 'smart_geo_gmap_opt_coord_center_3' );
define( 'SMART_GEO_GMAP_OPT_COORD_CENTER_1_NAME', 'smart_geo_gmap_opt_coord_center_1_name' );
define( 'SMART_GEO_GMAP_OPT_COORD_CENTER_2_NAME', 'smart_geo_gmap_opt_coord_center_2_name' );
define( 'SMART_GEO_GMAP_OPT_COORD_CENTER_3_NAME', 'smart_geo_gmap_opt_coord_center_3_name' );
define( 'SMART_GEO_GMAP_OPT_JAVASCRIPT_EVENT_INFO_WINDOWS', 'smart_geo_gmap_opt_javascript_event_info_windows' );

/* PLUGIN FILES FOLDERS */
$uploadDir = isset(wp_upload_dir()['basedir']) ? wp_upload_dir()['basedir'] : '/uploads';

define( 'SMART_GEO_GMAP_PATH_DATA', $uploadDir . DIRECTORY_SEPARATOR . 'smart-geo-gmap-data' . DIRECTORY_SEPARATOR );
define( 'SMART_GEO_GMAP_PATH_SNAZZY_STYLE', $uploadDir . DIRECTORY_SEPARATOR . 'smart-geo-gmap-snazzy' . DIRECTORY_SEPARATOR );

/* PLUGIN STRINGS */
define( 'SMART_GEO_GMAP_L10N', 'smart_geo_gmap_l10n' );
