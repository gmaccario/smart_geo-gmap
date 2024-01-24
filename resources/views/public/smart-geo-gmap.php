<?php if( empty( $smartgeogmapGoogleApiKey )): ?>

    <div id="smart-geo-gmap-error">
        <p><?php echo __( 'Google Key missing' ); ?>.</p>
    </div>

<?php else: ?>

    <?php if ( $smartgeogmapDefaultWidth === 'full_width' ): ?>
        <style>.smart-geo-gmap-wrapper{max-width:100%!important;}</style>
    <?php endif; ?>

    <div class="smart-geo-gmap-wrapper">
        <div id="smart-geo-gmap"></div>
        <?php if ($legend['smartgeogmapLegendToggle'] === 'on'): ?>
            <div id="legend">
                <h3><?php echo __( 'Legend' ); ?></h3>
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

        let smartGeoGmapDebug = <?php echo (WP_DEBUG) ? 1 : 0;  ?>;

        let map;

        let markers = [];

        let map_type = "<?php echo (!empty( $smartgeogmapMapType )) ? $smartgeogmapMapType : ''; ?>";

        let default_zoom = <?php echo (!empty( $smartgeogmapZoom )) ? $smartgeogmapZoom : 10; ?>;

        let coord_center_1 = {
            lat: '<?php echo (!empty($coordinates['smartgeogmapCoordinatesLatLong1'])) ? trim(explode(',', $coordinates['smartgeogmapCoordinatesLatLong1'])[0]) : ''; ?>',
            lng: '<?php echo (!empty($coordinates['smartgeogmapCoordinatesLatLong1'])) ? trim(explode(',', $coordinates['smartgeogmapCoordinatesLatLong1'])[1]) : ''; ?>',
        };
        let coord_center_2 = {
            lat: '<?php echo (!empty($coordinates['smartgeogmapCoordinatesLatLong2'])) ? trim(explode(',', $coordinates['smartgeogmapCoordinatesLatLong2'])[0]) : ''; ?>',
            lng: '<?php echo (!empty($coordinates['smartgeogmapCoordinatesLatLong2'])) ? trim(explode(',', $coordinates['smartgeogmapCoordinatesLatLong2'])[1]) : ''; ?>',
        };
        let coord_center_3 = {
            lat: '<?php echo (!empty($coordinates['smartgeogmapCoordinatesLatLong3'])) ? trim(explode(',', $coordinates['smartgeogmapCoordinatesLatLong3'])[0]) : ''; ?>',
            lng: '<?php echo (!empty($coordinates['smartgeogmapCoordinatesLatLong3'])) ? trim(explode(',', $coordinates['smartgeogmapCoordinatesLatLong3'])[1]) : ''; ?>',
        };

        let custom_centers = [
            { "label": "<?php echo __( $coordinates['smartgeogmapCoordinatesCity1'] ); ?>", "coord_center": coord_center_1 },
            { "label": "<?php echo __( $coordinates['smartgeogmapCoordinatesCity2'] ); ?>", "coord_center": coord_center_2 },
            { "label": "<?php echo __( $coordinates['smartgeogmapCoordinatesCity3'] ); ?>", "coord_center": coord_center_3 }
        ];

        let snazzyStyleJson = "<?php echo $uploadBaseUrl . '/' . \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_SNAZZY_FOLDER . '/' . basename($smartgeogmapSnazzyFile); ?>";

        let js_evt_info_windows = "<?php echo ( !empty( $smartgeogmapJavascriptTooltip ) ) ? $smartgeogmapJavascriptTooltip : 'mouseover'; ?>";

        let sz_recenter_control = '<?php echo __( 'Click to recenter the map' ); ?>';

        let geojson_files = [];

        <?php foreach( json_decode($smartgeogmapGeoJSONFiles, true) as $smartgeogmapGeoJSONFile ): ?>
            <?php if( file_exists( $smartgeogmapGeoJSONFile )): ?>
                geojson_files.push( "<?php echo $uploadBaseUrl . '/' . \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_DATA_FOLDER . '/' . basename($smartgeogmapGeoJSONFile); ?>" );
            <?php endif; ?>
		<?php endforeach; ?>

        let showLegend = <?php echo ($legend['smartgeogmapLegendToggle'] === 'on') ? 1 : 0; ?>;
		<?php if ($legend['smartgeogmapLegendToggle'] === 'on'): ?>
            let legend_position = '<?php echo $legend['smartgeogmapLegendPosition']; ?>';

            const iconBase = "https://maps.google.com/mapfiles/kml/shapes/";

            const icons = {};
            <?php if ( !empty($legend['smartgeogmapLegendLabel1'])): ?>
                icons["<?php echo $legend['smartgeogmapLegendLabel1'] ?>"] = {
                    name: "<?php echo $legend['smartgeogmapLegendLabel1'] ?>",
                    icon: iconBase + "<?php echo $legend['smartgeogmapLegendImage1'] ?>.png",
                };
            <?php endif; ?>

            <?php if ( !empty($legend['smartgeogmapLegendLabel2'])): ?>
                icons["<?php echo $legend['smartgeogmapLegendLabel2'] ?>"] = {
                    name: "<?php echo $legend['smartgeogmapLegendLabel2'] ?>",
                    icon: iconBase + "<?php echo $legend['smartgeogmapLegendImage2'] ?>.png",
                };
            <?php endif; ?>

            <?php if ( !empty($legend['smartgeogmapLegendLabel3'])): ?>
                icons["<?php echo $legend['smartgeogmapLegendLabel3'] ?>"] = {
                    name: "<?php echo $legend['smartgeogmapLegendLabel3'] ?>",
                    icon: iconBase + "<?php echo $legend['smartgeogmapLegendImage3'] ?>.png",
                };
            <?php endif; ?>
        <?php endif; ?>
    </script>
<?php endif; ?>
