<?php if ( isset ( $smartgeogmapDefaultWidth ) ): ?>
    <div>
        <input type="radio" class="default_width" value="full_width" name="smartgeogmap_default_width" id="smartgeogmap_default_width_full_width" <?php echo ($smartgeogmapDefaultWidth === 'full_width') ? 'checked' : ''; ?>>
        <label for="smartgeogmap_default_width_full_width" class="radio"><?php echo __( 'Full width' ); ?></label>
    </div>
    <div>
        <input type="radio" class="default_width" value="half_centered" name="smartgeogmap_default_width" id="smartgeogmap_default_width_half_centered" <?php echo ($smartgeogmapDefaultWidth === 'half_centered' || !$smartgeogmapDefaultWidth) ? 'checked' : ''; ?>>
        <label for="smartgeogmap_default_width_half_centered" class="radio"><?php echo __( 'Half centered' ); ?></label>
    </div>
<?php elseif ( isset ( $smartgeogmapMapType ) ): ?>
    <select id="smartgeogmap_map_type" name="smartgeogmap_map_type">
        <option value="" <?php echo ($smartgeogmapMapType === "1") ? 'selected' : ''; ?>><?php echo __( 'Map' ); ?></option>
        <option value="HYBRID" <?php echo ($smartgeogmapMapType === "HYBRID") ? 'selected' : ''; ?>><?php echo __( 'Hybrid' ); ?></option>
        <option value="ROADMAP" <?php echo ($smartgeogmapMapType === "ROADMAP") ? 'selected' : ''; ?>><?php echo __( 'Roadmap' ); ?></option>
        <option value="SATELLITE" <?php echo ($smartgeogmapMapType === "SATELLITE") ? 'selected' : ''; ?>><?php echo __( 'Satellite' ); ?></option>
        <option value="TERRAIN" <?php echo ($smartgeogmapMapType === "TERRAIN") ? 'selected' : ''; ?>><?php echo __( 'Terrain' ); ?></option>
    </select>
<?php elseif ( isset ( $smartgeogmapZoom ) ): ?>
    <select id="smartgeogmap_zoom" name="smartgeogmap_zoom">
        <option value="1" <?php echo ($smartgeogmapZoom === "1") ? 'selected' : ''; ?>><?php echo __( 'World' ); ?></option>
        <option value="5" <?php echo ($smartgeogmapZoom === "5") ? 'selected' : ''; ?>><?php echo __( 'Landmass/continent' ); ?></option>
        <option value="10" <?php echo ($smartgeogmapZoom === "10") ? 'selected' : ''; ?>><?php echo __( 'City' ); ?></option>
        <option value="15" <?php echo ($smartgeogmapZoom === "15") ? 'selected' : ''; ?>><?php echo __( 'Streets' ); ?></option>
        <option value="20" <?php echo ($smartgeogmapZoom === "20") ? 'selected' : ''; ?>><?php echo __( 'Buildings' ); ?></option>
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
