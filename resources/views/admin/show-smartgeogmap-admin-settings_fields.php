<?php if ( isset ( $smartgeogmapCoordinatesCity1 )): ?>
    <input type="text" id="smartgeogmap_coordinates_city_1" name="smartgeogmap_coordinates_city_1" value="<?php echo $smartgeogmapCoordinatesCity1; ?>" placeholder="Amsterdam" />
<?php elseif ( isset ( $smartgeogmapCoordinatesLatLong1 )): ?>
    <input type="text" id="smartgeogmap_coordinates_lat_long_1" name="smartgeogmap_coordinates_lat_long_1" value="<?php echo $smartgeogmapCoordinatesLatLong1; ?>" placeholder="52.370216, 4.895168" />
<?php elseif ( isset ( $smartgeogmapCoordinatesCity2 )): ?>
    <input type="text" id="smartgeogmap_coordinates_city_2" name="smartgeogmap_coordinates_city_2" value="<?php echo $smartgeogmapCoordinatesCity2; ?>" placeholder="Rome" />
<?php elseif ( isset ( $smartgeogmapCoordinatesLatLong2 )): ?>
    <input type="text" id="smartgeogmap_coordinates_lat_long_2" name="smartgeogmap_coordinates_lat_long_2" value="<?php echo $smartgeogmapCoordinatesLatLong2; ?>" placeholder="41.890251, 12.492373" />
<?php elseif ( isset ( $smartgeogmapCoordinatesCity3 )): ?>
    <input type="text" id="smartgeogmap_coordinates_city_3" name="smartgeogmap_coordinates_city_3" value="<?php echo $smartgeogmapCoordinatesCity3; ?>" placeholder="New York" />
<?php elseif ( isset ( $smartgeogmapCoordinatesLatLong3 )): ?>
    <input type="text" id="smartgeogmap_coordinates_lat_long_3" name="smartgeogmap_coordinates_lat_long_3" value="<?php echo $smartgeogmapCoordinatesLatLong3; ?>" placeholder="40.730610, -73.935242" />
<?php elseif ( isset ( $smartgeogmapZoom ) ): ?>
    <select id="smartgeogmap_zoom" name="smartgeogmap_zoom">
        <option value="1" <?php echo ($smartgeogmapZoom == "1") ? 'selected' : ''; ?>><?php echo __( 'World' ); ?></option>
        <option value="5" <?php echo ($smartgeogmapZoom == "5") ? 'selected' : ''; ?>><?php echo __( 'Landmass/continent' ); ?></option>
        <option value="10" <?php echo ($smartgeogmapZoom == "10") ? 'selected' : ''; ?>><?php echo __( 'City' ); ?></option>
        <option value="15" <?php echo ($smartgeogmapZoom == "15") ? 'selected' : ''; ?>><?php echo __( 'Streets' ); ?></option>
        <option value="20" <?php echo ($smartgeogmapZoom == "20") ? 'selected' : ''; ?>><?php echo __( 'Buildings' ); ?></option>
    </select>
<?php elseif ( isset ( $smartgeogmapJavascriptTooltip ) ): ?>
    <div>
        <input type="radio" class="javascript_event" value="mouseover" name="smartgeogmap_javascript_tooltip" id="smartgeogmap_javascript_tooltip_mouseover" <?php echo ($smartgeogmapJavascriptTooltip === 'mouseover') ? 'checked' : ''; ?>>
        <label for="javascript_event_mouseover" class="radio"><?php echo __( 'Mouseover' ); ?></label>
    </div>
    <div>
        <input type="radio" class="javascript_event" value="click" name="smartgeogmap_javascript_tooltip" id="smartgeogmap_javascript_tooltip_click" <?php echo ($smartgeogmapJavascriptTooltip === 'click') ? 'checked' : ''; ?>>
        <label for="javascript_event_click" class="radio"><?php echo __( 'Click' ); ?></label>
    </div>
<?php endif; ?>
