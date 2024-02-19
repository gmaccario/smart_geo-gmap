<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php if ( isset ( $smartgeogmapCoordinatesCity1 )): ?>
    <input type="text" id="smartgeogmap_coordinates_city_1" name="smartgeogmap_coordinates_city_1" value="<?php \SmartGeoGMap\Helpers\Intl::esc_attr_e($smartgeogmapCoordinatesCity1); ?>" placeholder="Amsterdam" />
<?php elseif ( isset ( $smartgeogmapCoordinatesLatLong1 )): ?>
    <input type="text" id="smartgeogmap_coordinates_lat_long_1" name="smartgeogmap_coordinates_lat_long_1" value="<?php \SmartGeoGMap\Helpers\Intl::esc_attr_e($smartgeogmapCoordinatesLatLong1); ?>" placeholder="52.370216, 4.895168" />
<?php elseif ( isset ( $smartgeogmapCoordinatesCity2 )): ?>
    <input type="text" id="smartgeogmap_coordinates_city_2" name="smartgeogmap_coordinates_city_2" value="<?php \SmartGeoGMap\Helpers\Intl::esc_attr_e($smartgeogmapCoordinatesCity2); ?>" placeholder="Rome" />
<?php elseif ( isset ( $smartgeogmapCoordinatesLatLong2 )): ?>
    <input type="text" id="smartgeogmap_coordinates_lat_long_2" name="smartgeogmap_coordinates_lat_long_2" value="<?php \SmartGeoGMap\Helpers\Intl::esc_attr_e($smartgeogmapCoordinatesLatLong2); ?>" placeholder="41.890251, 12.492373" />
<?php elseif ( isset ( $smartgeogmapCoordinatesCity3 )): ?>
    <input type="text" id="smartgeogmap_coordinates_city_3" name="smartgeogmap_coordinates_city_3" value="<?php \SmartGeoGMap\Helpers\Intl::esc_attr_e($smartgeogmapCoordinatesCity3); ?>" placeholder="New York" />
<?php elseif ( isset ( $smartgeogmapCoordinatesLatLong3 )): ?>
    <input type="text" id="smartgeogmap_coordinates_lat_long_3" name="smartgeogmap_coordinates_lat_long_3" value="<?php \SmartGeoGMap\Helpers\Intl::esc_attr_e($smartgeogmapCoordinatesLatLong3); ?>" placeholder="40.730610, -73.935242" />
<?php endif; ?>

