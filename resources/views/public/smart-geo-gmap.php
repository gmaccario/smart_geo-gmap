<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php if( empty( $smartgeogmapGoogleApiKey )): ?>

    <div id="smart-geo-gmap-error">
        <p><?php esc_html_e( 'Google Key missing' ); ?>.</p>
    </div>

<?php else: ?>

    <?php if ( $smartgeogmapDefaultWidth === 'full_width' ): ?>
        <style>.smart-geo-gmap-wrapper{max-width:100%!important;}</style>
    <?php endif; ?>

    <div class="smart-geo-gmap-wrapper">
        <div id="smart-geo-gmap"></div>
        <?php if ($legend['smartgeogmapLegendToggle'] === 'on'): ?>
            <div id="legend">
                <h3><?php esc_html_e( 'Legend' ); ?></h3>
            </div>
        <?php endif; ?>
    </div>

    <script type="text/javascript">

		<?php
		/**
		 * @note Use this part to create all the PHP-values-based needed js variables for the frontend.
		 */

		$uploadBaseUrl = isset( wp_upload_dir()['baseurl'] )
			? wp_upload_dir()['baseurl']
			: '/wp-content/uploads/';
		?>

        let smartGeoGmapDebug = <?php (WP_DEBUG) ? intval(esc_html_e(1)) : intval(esc_html_e(0));  ?>;

        let map;

        let markers = [];

        let map_type = "<?php (!empty( $smartgeogmapMapType )) ? esc_html_e($smartgeogmapMapType) : esc_html_e(''); ?>";

        let default_zoom = <?php (!empty( $smartgeogmapZoom )) ? esc_html_e($smartgeogmapZoom) : esc_html_e(10); ?>;

        let coord_center_1 = {
            lat: '<?php (!empty($coordinates['smartgeogmapCoordinatesLatLong1'])) ? esc_html_e(trim(explode(',', $coordinates['smartgeogmapCoordinatesLatLong1'])[0])) : esc_html_e(''); ?>',
            lng: '<?php (!empty($coordinates['smartgeogmapCoordinatesLatLong1'])) ? esc_html_e(trim(explode(',', $coordinates['smartgeogmapCoordinatesLatLong1'])[1])) : esc_html_e(''); ?>',
        };
        let coord_center_2 = {
            lat: '<?php (!empty($coordinates['smartgeogmapCoordinatesLatLong2'])) ? esc_html_e(trim(explode(',', $coordinates['smartgeogmapCoordinatesLatLong2'])[0])) : esc_html_e(''); ?>',
            lng: '<?php (!empty($coordinates['smartgeogmapCoordinatesLatLong2'])) ? esc_html_e(trim(explode(',', $coordinates['smartgeogmapCoordinatesLatLong2'])[1])) : esc_html_e(''); ?>',
        };
        let coord_center_3 = {
            lat: '<?php (!empty($coordinates['smartgeogmapCoordinatesLatLong3'])) ? esc_html_e(trim(explode(',', $coordinates['smartgeogmapCoordinatesLatLong3'])[0])) : esc_html_e(''); ?>',
            lng: '<?php (!empty($coordinates['smartgeogmapCoordinatesLatLong3'])) ? esc_html_e(trim(explode(',', $coordinates['smartgeogmapCoordinatesLatLong3'])[1])) : esc_html_e(''); ?>',
        };

        let custom_centers = [
            { "label": "<?php esc_html_e( $coordinates['smartgeogmapCoordinatesCity1'] ); ?>", "coord_center": coord_center_1 },
            { "label": "<?php esc_html_e( $coordinates['smartgeogmapCoordinatesCity2'] ); ?>", "coord_center": coord_center_2 },
            { "label": "<?php esc_html_e( $coordinates['smartgeogmapCoordinatesCity3'] ); ?>", "coord_center": coord_center_3 }
        ];

        let snazzyStyleJson = "<?php esc_html_e($uploadBaseUrl . '/' . \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_SNAZZY_FOLDER . '/' . basename($smartgeogmapSnazzyFile)); ?>";

        let js_evt_info_windows = "<?php ( !empty( $smartgeogmapJavascriptTooltip ) ) ? esc_html_e($smartgeogmapJavascriptTooltip) : esc_html_e('mouseover'); ?>";

        let sz_recenter_control = '<?php esc_html_e( 'Click to recenter the map' ); ?>';

        let geojson_files = [];

        <?php foreach( json_decode($smartgeogmapGeoJSONFiles, true) as $smartgeogmapGeoJSONFile ): ?>
            <?php if( file_exists( $smartgeogmapGeoJSONFile )): ?>
                geojson_files.push( "<?php esc_html_e($uploadBaseUrl . '/' . \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_DATA_FOLDER . '/' . basename($smartgeogmapGeoJSONFile)); ?>" );
            <?php endif; ?>
		<?php endforeach; ?>

        let showLegend = <?php ($legend['smartgeogmapLegendToggle'] === 'on') ? intval(esc_html_e(1)) : intval(esc_html_e(0)); ?>;
		<?php if ($legend['smartgeogmapLegendToggle'] === 'on'): ?>
            let legend_position = '<?php esc_html_e($legend['smartgeogmapLegendPosition']); ?>';

            const iconBase = "https://maps.google.com/mapfiles/kml/shapes/";

            const icons = {};
            <?php if ( !empty($legend['smartgeogmapLegendLabel1'])): ?>
                icons["<?php esc_html_e($legend['smartgeogmapLegendLabel1']); ?>"] = {
                    name: "<?php esc_html_e($legend['smartgeogmapLegendLabel1']); ?>",
                    icon: iconBase + "<?php esc_html_e($legend['smartgeogmapLegendImage1']); ?>.png",
                };
            <?php endif; ?>

            <?php if ( !empty($legend['smartgeogmapLegendLabel2'])): ?>
                icons["<?php esc_html_e($legend['smartgeogmapLegendLabel2']); ?>"] = {
                    name: "<?php esc_html_e($legend['smartgeogmapLegendLabel2']) ?>",
                    icon: iconBase + "<?php esc_html_e($legend['smartgeogmapLegendImage2']); ?>.png",
                };
            <?php endif; ?>

            <?php if ( !empty($legend['smartgeogmapLegendLabel3'])): ?>
                icons["<?php esc_html_e($legend['smartgeogmapLegendLabel3']) ?>"] = {
                    name: "<?php esc_html_e($legend['smartgeogmapLegendLabel3']) ?>",
                    icon: iconBase + "<?php esc_html_e($legend['smartgeogmapLegendImage3']) ?>.png",
                };
            <?php endif; ?>
        <?php endif; ?>
    </script>
<?php endif; ?>
