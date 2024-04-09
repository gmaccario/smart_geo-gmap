<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php if ( isset ( $smartgeogmapDefaultWidth ) ): ?>
    <div>
        <input type="radio" class="default_width" value="full_width" name="smartgeogmap_default_width" id="smartgeogmap_default_width_full_width" <?php ($smartgeogmapDefaultWidth === 'full_width') ? esc_attr_e('checked') : null; ?>>
        <label for="smartgeogmap_default_width_full_width" class="radio"><?php esc_html_e( 'Full width' ); ?></label>
    </div>
    <div>
        <input type="radio" class="default_width" value="half_centered" name="smartgeogmap_default_width" id="smartgeogmap_default_width_half_centered" <?php ($smartgeogmapDefaultWidth === 'half_centered' || !$smartgeogmapDefaultWidth) ? esc_attr_e('checked') : null; ?>>
        <label for="smartgeogmap_default_width_half_centered" class="radio"><?php esc_html_e( 'Half centered' ); ?></label>
    </div>
<?php elseif ( isset ( $smartgeogmapMapType ) ): ?>
    <select id="smartgeogmap_map_type" name="smartgeogmap_map_type">
        <option value="" <?php ($smartgeogmapMapType === "1") ? esc_attr_e('selected') : null; ?>><?php esc_html_e( 'Map' ); ?></option>
        <option value="HYBRID" <?php ($smartgeogmapMapType === "HYBRID") ? esc_attr_e('selected') : null; ?>><?php esc_html_e( 'Hybrid' ); ?></option>
        <option value="ROADMAP" <?php ($smartgeogmapMapType === "ROADMAP") ? esc_attr_e('selected') : null; ?>><?php esc_html_e( 'Roadmap' ); ?></option>
        <option value="SATELLITE" <?php ($smartgeogmapMapType === "SATELLITE") ? esc_attr_e('selected') : null; ?>><?php esc_html_e( 'Satellite' ); ?></option>
        <option value="TERRAIN" <?php ($smartgeogmapMapType === "TERRAIN") ? esc_attr_e('selected') : null; ?>><?php esc_html_e( 'Terrain' ); ?></option>
    </select>
<?php elseif ( isset ( $smartgeogmapZoom ) ): ?>
    <select id="smartgeogmap_zoom" name="smartgeogmap_zoom">
        <option value="1" <?php ($smartgeogmapZoom === "1") ? esc_attr_e('selected') : null; ?>><?php esc_html_e( 'World' ); ?></option>
        <option value="5" <?php ($smartgeogmapZoom === "5") ? esc_attr_e('selected') : null; ?>><?php esc_html_e( 'Landmass/continent' ); ?></option>
        <option value="10" <?php ($smartgeogmapZoom === "10") ? esc_attr_e('selected') : null; ?>><?php esc_html_e( 'City' ); ?></option>
        <option value="15" <?php ($smartgeogmapZoom === "15") ? esc_attr_e('selected') : null; ?>><?php esc_html_e( 'Streets' ); ?></option>
        <option value="20" <?php ($smartgeogmapZoom === "20") ? esc_attr_e('selected') : null; ?>><?php esc_html_e( 'Buildings' ); ?></option>
    </select>
<?php elseif ( isset ( $smartgeogmapJavascriptTooltip ) ): ?>
    <div>
        <input type="radio" class="javascript_event" value="mouseover" name="smartgeogmap_javascript_tooltip" id="smartgeogmap_javascript_tooltip_mouseover" <?php ($smartgeogmapJavascriptTooltip === 'mouseover') ? esc_attr_e('checked') : null; ?>>
        <label for="javascript_event_mouseover" class="radio"><?php esc_html_e( 'Mouseover' ); ?></label>
    </div>
    <div>
        <input type="radio" class="javascript_event" value="click" name="smartgeogmap_javascript_tooltip" id="smartgeogmap_javascript_tooltip_click" <?php ($smartgeogmapJavascriptTooltip === 'click') ? esc_attr_e('checked') : null; ?>>
        <label for="javascript_event_click" class="radio"><?php esc_html_e( 'Click' ); ?></label>
    </div>
<?php endif; ?>
