<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php if ( isset ( $smartgeogmapDefaultWidth ) ): ?>
    <div>
        <input type="radio" class="default_width" value="full_width" name="smartgeogmap_default_width" id="smartgeogmap_default_width_full_width" <?php checked( $smartgeogmapDefaultWidth, 'full_width' ); ?>>
        <label for="smartgeogmap_default_width_full_width" class="radio"><?php esc_html_e( 'Full width', 'smart-geo-gmap' ); ?></label>
    </div>
    <div>
        <input type="radio" class="default_width" value="half_centered" name="smartgeogmap_default_width" id="smartgeogmap_default_width_half_centered" <?php checked( $smartgeogmapDefaultWidth === 'half_centered' || ! $smartgeogmapDefaultWidth ); ?>>
        <label for="smartgeogmap_default_width_half_centered" class="radio"><?php esc_html_e( 'Half centered', 'smart-geo-gmap' ); ?></label>
    </div>
<?php elseif ( isset ( $smartgeogmapMapType ) ): ?>
    <select id="smartgeogmap_map_type" name="smartgeogmap_map_type">
        <option value="" <?php selected( $smartgeogmapMapType, '' ); ?>><?php esc_html_e( 'Map', 'smart-geo-gmap' ); ?></option>
        <option value="HYBRID" <?php selected( $smartgeogmapMapType, 'HYBRID' ); ?>><?php esc_html_e( 'Hybrid', 'smart-geo-gmap' ); ?></option>
        <option value="ROADMAP" <?php selected( $smartgeogmapMapType, 'ROADMAP' ); ?>><?php esc_html_e( 'Roadmap', 'smart-geo-gmap' ); ?></option>
        <option value="SATELLITE" <?php selected( $smartgeogmapMapType, 'SATELLITE' ); ?>><?php esc_html_e( 'Satellite', 'smart-geo-gmap' ); ?></option>
        <option value="TERRAIN" <?php selected( $smartgeogmapMapType, 'TERRAIN' ); ?>><?php esc_html_e( 'Terrain', 'smart-geo-gmap' ); ?></option>
    </select>
<?php elseif ( isset ( $smartgeogmapZoom ) ): ?>
    <select id="smartgeogmap_zoom" name="smartgeogmap_zoom">
        <option value="1" <?php selected( $smartgeogmapZoom, '1' ); ?>><?php esc_html_e( 'World', 'smart-geo-gmap' ); ?></option>
        <option value="5" <?php selected( $smartgeogmapZoom, '5' ); ?>><?php esc_html_e( 'Landmass/continent', 'smart-geo-gmap' ); ?></option>
        <option value="10" <?php selected( $smartgeogmapZoom, '10' ); ?>><?php esc_html_e( 'City', 'smart-geo-gmap' ); ?></option>
        <option value="15" <?php selected( $smartgeogmapZoom, '15' ); ?>><?php esc_html_e( 'Streets', 'smart-geo-gmap' ); ?></option>
        <option value="20" <?php selected( $smartgeogmapZoom, '20' ); ?>><?php esc_html_e( 'Buildings', 'smart-geo-gmap' ); ?></option>
    </select>
<?php elseif ( isset ( $smartgeogmapJavascriptTooltip ) ): ?>
    <div>
        <input type="radio" class="javascript_event" value="mouseover" name="smartgeogmap_javascript_tooltip" id="smartgeogmap_javascript_tooltip_mouseover" <?php checked( $smartgeogmapJavascriptTooltip, 'mouseover' ); ?>>
        <label for="smartgeogmap_javascript_tooltip_mouseover" class="radio"><?php esc_html_e( 'Mouseover', 'smart-geo-gmap' ); ?></label>
    </div>
    <div>
        <input type="radio" class="javascript_event" value="click" name="smartgeogmap_javascript_tooltip" id="smartgeogmap_javascript_tooltip_click" <?php checked( $smartgeogmapJavascriptTooltip, 'click' ); ?>>
        <label for="smartgeogmap_javascript_tooltip_click" class="radio"><?php esc_html_e( 'Click', 'smart-geo-gmap' ); ?></label>
    </div>
<?php endif; ?>
