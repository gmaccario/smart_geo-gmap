<?php
$uploadBaseUrl = isset( wp_upload_dir()['baseurl'] )
    ? wp_upload_dir()['baseurl']
    : '/wp-content/uploads/';
?>

<?php if ( isset ( $smartgeogmapSnazzyFile )): ?>
	<?php if ( empty ( $smartgeogmapSnazzyFile )): ?>
        <input type="file" id="smartgeogmap_snazzy_file" name="smartgeogmap_snazzy_file" accept="application/JSON" />
    <?php else: ?>
		<?php $basename = basename($smartgeogmapSnazzyFile); ?>
        <input type="checkbox" id="smartgeogmap_delete_snazzy_file" name="smartgeogmap_delete_snazzy_file"
               value="<?php echo $basename; ?>" title="<?php echo __( 'Tick the checkbox in order to delete the Snazzy file' ); ?>"
        <p>
            <a href="<?php echo $uploadBaseUrl . '/' . \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_SNAZZY_FOLDER . '/' . $basename; ?>" target="_blank">
                <span><?php echo $basename; ?></span>
            </a>
        </p>
        <p>
            <span><?php echo __( 'Tick the checkbox in order to delete the Snazzy file' ); ?></span>
        </p>
    <?php endif; ?>
<?php endif; ?>

<?php if ( isset ( $smartgeogmapGeoJSONFile )): ?>
    <?php $geoJSONFiles = json_decode( $smartgeogmapGeoJSONFile, true ); ?>
    <?php if ( $geoJSONFiles === null || count ( $geoJSONFiles ) < \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_MAX_GEOJSON_ALLOWED ): ?>
        <input type="file" id="smartgeogmap_geojson_file" name="smartgeogmap_geojson_file[]" multiple data-max-geojson-allowed="3" /> <?php // accept="application/JSON"  ?>
    <?php endif; ?>
	<?php if ( ! empty ( $geoJSONFiles )): ?>
        <br />
        <?php foreach ( $geoJSONFiles as $index => $geoJSONFile): ?>
            <?php $basename = basename($geoJSONFile); ?>
            <input type="checkbox" id="smartgeogmap_delete_geojson_file" name="smartgeogmap_delete_geojson_file[]"
                   value="<?php echo $basename; ?>" title="<?php echo __( 'Tick the checkboxes in order to delete the GeoJSON files' ); ?>"
            <p>
                <a href="<?php echo $uploadBaseUrl . '/' . \SmartGeoGMap\Helpers\Constants::SMARTGEOGMAP_DATA_FOLDER . '/' . $basename; ?>" target="_blank">
                    <span><?php echo $basename; ?></span>
                </a>
            </p>
            <?php endforeach; ?>
        <p>
            <span><?php echo __( 'Tick the checkboxes in order to delete the GeoJSON files' ); ?></span>
        </p>
    <?php endif; ?>
<?php endif; ?>
